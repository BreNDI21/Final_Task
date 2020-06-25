@extends('app.app')
<div class="template">
<div class="home"><a href="{{route('Home')}}">Главная</a></div>
<h1>Талон № {{$seance->id}}</h1>
<div>Фамилия, имя</div>
<div>{{$patient->name}} {{$patient->surname}}</div>
<div>Время приема: {{$seance->time}}, {{$seance->date}}</div>
<div>Обращение по поводу:</div>
<div>К врачу: {{$doctor->specialization}} - {{$doctor->name}} {{$doctor->surname}}</div>
<div>Вид приема: Консультация первичная</div>
    <div></div>
<div>Подпись врача: ___________</div>
</div>
