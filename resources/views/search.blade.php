@extends('layout')

@section('content')

    <h1>Risultati ricerca:</h1>
    @if($hasResults != 0)
        <div class="Risultati">
            @foreach($risultati as $page)
                <a href="/page/{{$page->id}}"> {{$page->nome_pagina}} <br> </a>
            @endforeach

        </div>
    @else



        <h5>il filtraggio non ha prodotto risultati</h5>


    @endif
    <div><h4>Filtro Avanzato</h4></div>
    <h6>filtra tra le pagine dell'utente e/o materia che hai selezionato</h6>


    <form method="GET" action="/search/advancedFilter">

        <input name="user" type="hidden" value="{{$data->user}}">
        <input name="subject" type="hidden" value="{{$data->subject}}">

        <select name="language">
            <option value="0">lingua:</option>

            <option value="italiano">ita</option>

            <option value="inglese">eng</option>

        </select>
        <select name="course">
            <option value="0">corso:</option>
            @foreach($corsi as $corso)
                <option value="{{$corso->id}}"> {{$corso->corso_laurea}}</option>
            @endforeach

        </select>
        <select name="category">

            <option value="0">categoria:</option>
            @foreach($categorie as $categoria)
                <option value="{{$categoria->id}}"> {{$categoria->categoria}}</option>
            @endforeach

        </select>
        <select name="fileType">
            <option value="0">tipo di file:</option>
            <option value="audio/mp3"> mp3 </option>
            <option value="application/pdf"> pdf </option>

        </select>

        <button type="submit">Filtra i risultati</button>
    </form>



@endsection
