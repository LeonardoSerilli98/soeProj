@extends('layout')

@section('content')

    <!— la view mostra un singolo appunto con l'anteprima del suo contenuto-->

    @foreach($content as $con)
        <h1>Nome Appunto: {{$con->nome_contenuto}}</h1>

        <h3>Anteprima <h5>(da implementare: l'utente vedra solo un numero fissato di pagine, con l'acquisto avra anche un opzione di download)</h5></h3>

        <embed src="{{asset($con->path_contenuto)}}" type="{{$con->tipo_file}}" height="380px" width="500px"/>

    @endforeach

@endsection
