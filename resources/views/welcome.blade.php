<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>
@extends('app.app')
    @if(\Illuminate\Support\Facades\Session::has('seance'))
        <script>
            alert('У вас еще нет сеансов!')
        </script>
    @endif
    <body>
    <header>
    @if(isset($name))
        <div class="container">
            <nav>
                <ul>
                    <li> <div>Hello, {{$name}}</div></li>
                    <li>
                        <div><a  href="{{route('personalArea', compact('id'))}}">Мои сеанси</a></div>
                    </li>
                    <li>
                        <div><a  href="{{route('logout')}}">Выйти</a></div>
                    </li>
                </ul>
            </nav>
        </div>

    @endif
        <div class="login">
            <a href="{{route('login')}}" hi>Войти</a>
        </div>
    <div class="login">
        <a  href="{{route('register')}}">Зарегистрироваться</a>
    </div>
    </header>
    <div>
        <a class="doctors" href="{{route('doctors')}}">Наши врачи</a>
    </div>
    </body>
    @if(isset($name))
    <script>
        $('.login').css("display", "none");
    </script>
        @endif
</html>
