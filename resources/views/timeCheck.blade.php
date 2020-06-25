
@extends('app.app')
<div class="home"><a  href="{{route('Home')}}">Главная</a></div>
@if(\Illuminate\Support\Facades\Session::has('key')&& \Illuminate\Support\Facades\Session::get('key') == 'success')
    <script>
        alert('Вы успешно записались на прием!')
    </script>
    @endif
<div class="first">
</div>
<div class="timeC">
<div>{{$doctor->name}} {{$doctor->surname}}</div>
<div>{{$doctor->specialization}}</div>
</div>
<form action="{{route('submitApp')}}">
    <div><input type="radio" name="time" value="1" required>10:00-11:00 </div>
    <div>  <input type="radio" name="time" value="2">11:00-12:00</div>
    <div> <input type="radio" name="time" value="3">12:00-13:00</div>
    <div> <input type="radio" name="time" value="4">13:00-14:00</div>
    <div>  <input type="radio" name="time" value="5">14:00-15:00</div>
    <div> <input type="radio" name="time" value="6">15:00-16:00</div>
    <div>  <input type="radio" name="time" value="7">16:00-17:00</div>
    <div><input type="radio" name="time" value="8">17:00-18:00</div>
    <input type="hidden" name="d_id" value="{{$doctor->u_id}}">
    <input type="date" name="date" class="date" required>
    <div></div>
    <button type="submit">Подтвердить</button>
</form>
