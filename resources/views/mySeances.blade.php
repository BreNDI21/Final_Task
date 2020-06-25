@extends('app.app')
<div class="home"><a href="{{route('Home')}}">Главная</a></div>
<h1>Мои сеансы</h1>
<table border="3 px solid black">
    <th>Сеанс</th>
    <th>Время</th>
    <th>Дата</th>
    <th> </th>
    @for($i = 0; $i<$num; $i++)
        <tr>
            <td>Сеанс №{{$i + 1}}</td>
            <td>{{$data['time'][$i]}}</td>
            <td>{{$data['date'][$i]}}</td>
            <td>
               <?php $id = $data['ids'][$i];?>
                <form action="{{route('findSeance', compact('id'))}}">
                    <input  type="hidden" name="id" value="{{$data['ids'][$i]}}">
                    <button type="submit">More</button>
                </form>
            </td>
        </tr>
    @endfor
</table>





