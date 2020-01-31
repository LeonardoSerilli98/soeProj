@extends('layout')

@section('content')
<!-- form per caricare un nuovo appunto all'interno della pagina -->
    <h1>La mia pagina di {{ $nome_pagina }}</h1>
    <h3> Carica un nuovo appunto </h3>
    <ul class ="upload">
        <form method="POST" action="/content" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="pagina" value="{{ $idPagina }}">
            <label>carica un file</label><input type="file" name="appunto" >
            <label>lingua</label><input type="text" name="lingua">
            <label>nome appunto</label><input type="text" name="nome_contenuto">
            <label>argomento</label><input type="text" name="argomento">
            <label>categoria</label>
            <select name="categoria">
                @foreach($categorie as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->categoria }}</option>
                @endforeach
            </select>
            <label>corso di laurea</label>
            <select name="corso_laurea">
                @foreach($corsi as $corso)
                    <option value="{{ $corso->id }}">{{ $corso->corso_laurea }}</option>
                @endforeach
            </select>
            <input type="submit">
        </form>
    </ul>

    <!-- appunti caricati in precedenza dall'utente nella pagina -->
    <h3>Appunti caricati riguardanti {{ $nome_pagina }} </h3>
    @foreach($contents as $content)

    <ul class = "appunto">
        <a href="/content/{{$content->id}}"> {{$content->nome_contenuto}}</a>
    </ul>

    @endforeach




@endsection
