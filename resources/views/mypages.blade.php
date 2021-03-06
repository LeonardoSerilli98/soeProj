@extends('layout')

@section('content')

<!-- informazioni riguardanti l'utente -->

    <div class="profilo">
        <h4> hai caricato {{ $num_caricamenti }} appunti<h4>
    </div>
<!-- form per creare una nuova pagina -->
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
<!-- pagine create dall'utente -->
    <h1>Le mie pagine</h1>
        
        @foreach($pages as $page)
        <ul class ="appunto">
            <a href="/mypages/{{$page->id}}"> {{$page->nome_pagina}} <br> </a>
        </ul>
        @endforeach
    

    

@endsection
