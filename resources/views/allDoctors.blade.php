@extends('app.app')
<div class="home"><a  href="{{route('Home')}}">Главная</a></div>
<div class="first">
</div>
@foreach($doctors as $doctor)
    <div >{{$doctor->name}} {{$doctor->surname}}</div>
    <div>{{$doctor->specialization}}</div>
    <form class="form" action="{{route('appointment')}}">
        <button type="submit">Записаться на прием</button>
        <input type="hidden" name="d_id" value="{{$doctor->id}}">
    </form>
@endforeach
