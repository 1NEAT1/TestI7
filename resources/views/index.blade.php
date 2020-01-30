<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Создание объекта с информацией о клиенте</title>

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body>
    @include("layouts.header")
    <div class="container">
        @if (session()->has('success'))
            <div class="alert alert-success pt-2">
                {{ session('success') }}
            </div>
        @endif
        @if (count($errors) > 0)
            <div class="alert alert-danger pt-2">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="/">
            @csrf
            <div class="row mt-5">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nameLocal">ФИО</label>
                        <input type="text" class="form-control" id="nameLocal" name="nameLocal" placeholder="Введите ФИО">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Введите Email">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="birthday">Дата рождения</label>
                        <input type="text" class="form-control" id="birthday" name="birthday" placeholder="Выберите дату рождения">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="phone">Номер телефона</label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Введите номер телефон">
                        <small id="phoneHelp" class="form-text text-muted">Пример: +7 999 9999999</small>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="series">Серия паспорта</label>
                        <input type="text" class="form-control" id="series" name="series" placeholder="Введите серию паспорта">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="number">Номер паспорта</label>
                        <input type="text" class="form-control" id="number" name="number" placeholder="Введите номер паспорта">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="issuer">Место выдачи</label>
                        <input type="text" class="form-control" id="issuer" name="issuer" placeholder="Введите адрес места выдачи">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="issued">Дата выдачи</label>
                        <input type="text" class="form-control" id="issued" name="issued" placeholder="Выберите дату выдачи">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="index">Индекс</label>
                        <input type="text" class="form-control" id="index" name="index" placeholder="Введите почтовый индекс">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="city">Город</label>
                        <input type="text" class="form-control" id="city" name="city" placeholder="Введите город">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="street">Улица</label>
                <input type="text" class="form-control" id="street" name="street" placeholder="Введите улицу">
            </div>
            <button type="submit" class="btn btn-primary">Создать объект</button>
        </form>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://webstool.ru/js/jquery.maskedinput.min.js"></script>
    </body>
</html>
