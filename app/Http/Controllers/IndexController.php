<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IndexController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function dns()
    {
        return view('dns');
    }

    public function getToken()
    {
        $token = json_decode(file_get_contents('https://vrdemo.virtreg.ru/vr-api?method=authLogin&params={"operator":"demo","password":"demo"}'));
        return $token->result->token;
    }

    public function create(Request $request)
    {
        // Валидация данных
        $rules = [
            'nameLocal' => 'required|string',
            'email' => 'required|string|regex:/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}/',
            'phone' => 'required',
            'birthday' => 'required|string',
            'series' => 'required|string|min:4|max:4',
            'number' => 'required|string|min:6|max:6',
            'issuer' => 'required|string',
            'issued' => 'required|string',
            'index' => 'required|string',
            'city' => 'required|string',
            'street' => 'required|string',
        ];
        $niceNames = [
            'nameLocal' => 'ФИО',
            'email' => 'Email',
            'phone' => 'Телефон',
            'birthday' => 'День рождения',
            'series' => 'Серия',
            'number' => 'Номер',
            'issuer' => 'Место выдачи',
            'issued' => 'Дата выдачи',
            'index' => 'Почтовый индекс',
            'city' => 'Город',
            'street' => 'Улица',
        ];
        $validator = Validator::make($request->all(), [
            'nameLocal' => 'required|string',
            'email' => 'required|string|regex:/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}/',
            'phone' => 'required',
            'birthday' => 'required|string',
            'series' => 'required|string|min:4|max:4',
            'number' => 'required|string|min:6|max:6',
            'issuer' => 'required|string',
            'issued' => 'required|string',
            'index' => 'required|string',
            'city' => 'required|string',
            'street' => 'required|string',
        ], $rules, $niceNames);

        if($validator->fails()){
            return redirect('/')->withErrors($validator->errors());
        }else{
            //Если валидация прошла успешно, получаем токен и отправляем заявку
            $token = $this->getToken();
            $nameLocal = $request->input('nameLocal');
            $email = $request->input('email');
            $phone = str_replace('+', urlencode('+'), $request->input('phone'));
            $birthday = $request->input('birthday');
            $series = $request->input('series');
            $number = $request->input('number');
            $issuer = $request->input('issuer');
            $issued = $request->input('issued');
            $index = $request->input('index');
            $city = $request->input('city');
            $street = $request->input('street');

            $array = [
                "auth" => [
                    "token" => $token,
                ]   ,
                "client" => [
                    "legal" => 'person',
                    "nameLocal" => $nameLocal,
                    "birthday" => $birthday,
                    "identity" => [
                            "type" => "passport",
                            "series" => $series,
                            "number" => $number,
                            "issuer" => $issuer,
                            "issued" => $issued,
                        ],
                    "emails" => [$email],
                    "phones" => [$phone],
                    "addressLocal" => [
                        "index" => $index,
                        "country" => 'RU',
                        "city" => $city,
                        "street" => $street
                    ],
                ],
            ];

            $client = new \GuzzleHttp\Client();
            $headers = [
                'Content-Type' => 'application/json; charset=utf8',
                'Accept', 'application/json'
            ];
            $client->request('GET', 'https://vrdemo.virtreg.ru/vr-api?method=clientCreate&params=' . json_encode($array), ['headers' => $headers]);
            return redirect()->back()->with('success', 'Заявка успешно подана!');
        }
    }

    public function update(Request $request)
    {
        // Валидация данных
        $rules = [
            'domainId' => 'required',
            'clientId' => 'required',
            'comment' => 'required',
        ];
        $niceNames = [
            'domainId' => '№ домена',
            'clientId' => '№ клиента',
            'comment' => 'Комментарий',
        ];
        $validator = Validator::make($request->all(), [
            'domainId' => 'required',
            'clientId' => 'required',
            'comment' => 'required',
        ], $rules, $niceNames);
        if($validator->fails()){
            return redirect('/dns')->withErrors($validator->errors());
        }else{
            $domainId = $request->input('domainId');
            $clientId = $request->input('clientId');
            $comment = $request->input('comment');
            $token = $this->getToken();

            $array = [
                "auth" => [
                    "token" => $token,
                ]   ,
                "id" => $domainId,
                "clientId" => $clientId,
                "domain" => [
                    "comment" => $comment
                ]
            ];

            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', 'https://vrdemo.virtreg.ru/vr-api?method=domainUpdate&params=' . json_encode($array));

            $out = json_decode($response->getBody()->getContents());

            if(!empty($out->error)){
                return redirect()->back()->with('success', $out->error->message);
            }else{
                return redirect()->back()->with('success', 'DNS успешно обновлен.');
            }
        }
    }
}
