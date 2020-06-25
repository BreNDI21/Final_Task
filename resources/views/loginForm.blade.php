@extends('app.app')
<div class="home"><a href="{{route('Home')}}">Главная</a></div>
@if(\Illuminate\Support\Facades\Session::has('error'))
    <script>
        alert('Пользователь не найден!')
    </script>
@endif
<form class="logForm" action="{{route('loginCheck')}}">
    @csrf
    <input type="text" name="email" placeholder="Email">
    <input type="password" name="password" placeholder="Пароль">
    <button type="submit">Войти</button>
</form>
<div class="login">
    <a  href="{{route('register')}}">Регистрация</a>
</div>
