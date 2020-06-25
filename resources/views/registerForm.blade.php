@extends('app.app')
<div><a href="{{route('Home')}}">Главная</a></div>
<h1>Регистрация нового пользователя</h1>
@if(\Illuminate\Support\Facades\Session::has('message'))
    <script>
        alert('Неверные данные')
    </script>
    @endif
<form action="{{route('rConfirm')}}" method="post">
    @method('POST')
    @csrf
    <input type="text" name="name" placeholder="Имя" required>
    <input type="text" name="surname" placeholder="Фамилия" required>
    <input type="text" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Пароль" required>
    <button type="submit">Подтвердить</button>
</form>
