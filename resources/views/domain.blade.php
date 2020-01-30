<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Создание объекта с информацией о домене</title>

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
    <form method="POST" action="/domain">
        @csrf
        <div class="row mt-5">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="clientId">Введите № клиента к которому привязать домен</label>
                    <input type="text" class="form-control" id="clientId" name="clientId" placeholder="Введите № клиента">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Введите название домена</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Введите название домена">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="comment">Введите комментарий</label>
            <input type="text" class="form-control" id="comment" name="comment" placeholder="Введите комментарий">
        </div>
        <button type="submit" class="btn btn-primary">Создать объект</button>
    </form>
</div>
<script src="{{ asset('js/app.js') }}"></script>
<script src="https://webstool.ru/js/jquery.maskedinput.min.js"></script>
</body>
</html>
