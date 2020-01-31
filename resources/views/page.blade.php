@extends('layout')

@section('content')

    <h1>I miei appunti</h1>

    @foreach($contents as $content)
        <a href="/content/{{$content->id}}"> {{$content->nome_contenuto}} <br></a>
    @endforeach

@endsection


