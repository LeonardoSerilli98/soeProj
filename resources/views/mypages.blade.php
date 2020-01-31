@extends('layout')

@section('content')

    <h1>Le mie pagine</h1>

        @foreach($pages as $page)
        <ul>
            <h4><a href="/mypages/{{$page->id}}"> {{$page->nome_pagina}} <br> </a></h4>
    </ul>
        @endforeach
    <div class="crea">
        <h3>Crea una nuova pagina</h3>

    <form method="POST" action="/page">
        @csrf

        <div><label>nome pagina: </label><input type="text" name="nome" ></div>

        <div class="select">

            <label>materia</label>

            <select name="materia">


                @foreach($materie as $materia)
                    <option value="{{ $materia->id }}"> {{ $materia->materia }}</option>
                @endforeach

            </select>

        </div>

        <button type="submit">Crea pagina</button>
    </form>
</div>

@endsection
