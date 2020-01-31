@extends('layout')

@section('content')
    <h1>I miei appunti</h1>

    @foreach($contents as $content)
        <a href="/content/{{$content->id}}"> {{$content->nome_contenuto}}</a>
    @endforeach


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

@endsection
