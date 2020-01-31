@extends('layout')

@section('content')

    <h1>Appunti di {{$nome_pagina -> nome_pagina}}</h1>

    @foreach($contents as $content)
    <ul class="appunto">
        <a href="/content/{{$content->id}}"> {{$content->nome_contenuto}} <br></a>
    </ul>
    @endforeach

@endsection


