
@extends('layout')

@section('content')


    <h1>Filtro avanzato</h1>
    <h3>filtra tra le pagine dell'utente e/o materia che hai selezionato</h3>
    @if($hasResults != 0)
<!-- form per effettuare un filtraggio avanzato sulla ricerca preliminare ( effettuata su un utente o una materia) -->
    <form method="GET" action="/search/advancedFilter">
        <div class ="filtro">
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
                    <option value="image/jpeg"> jpeg </option>
                    <option value="image/png"> png </option>

                </select>

                <button type="submit">Filtra i risultati</button>
                </form>

        </div>

        <h1>I tuoi risultati </h1>
    <!-- Risultati della ricerca avanzata -->
        <div class="Risultati">
            @foreach($risultati as $page)
                <div class="appunto">
                <a href="/page/{{$page->id}}"> {{$page->nome_pagina}} <br> </a>
                </div>
            @endforeach

        </div>
    @else
    <!-- se i campi selezionati nella ricerca avanzata non matchano con nessun appunto nel database -->
        <h5>il filtraggio non ha prodotto risultati</h5>
     @endif
    


    


@endsection