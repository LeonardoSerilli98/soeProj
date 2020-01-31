
@extends('layout')

@section('content')

    <!-- la view mostra un singolo appunto con l'anteprima del suo contenuto-->

    @foreach($content as $con)
        <h1>Nome Appunto: {{$con->nome_contenuto}}</h1>

        <h3>Anteprima <h5>(da implementare: l'utente vedra solo un numero fissato di pagine)</h5></h3>

        @if($con->tipo_file == "audio/mpeg")
            @if(Auth::check() && $bought)
                <embed src="{{asset($con->path_contenuto)}}" type="{{$con->tipo_file}}" />
            @else
                <embed src="{{asset($con->path_contenuto).'#toolbar=0'}}" type="{{$con->tipo_file}}" />
                @if(Auth::check())
                    <form method="POST" action="/content/{{ $con->id }}">
                        <button type="submit">Acquista</button>
                    </form>
                @endif
            @endif

        @else

            @if(Auth::check() && $bought)
                <embed src="{{asset($con->path_contenuto)}}" type="{{$con->tipo_file}}" height="380px" width="500px"/>
            @else
                <embed src="{{asset($con->path_contenuto).'#toolbar=0'}}" type="{{$con->tipo_file}}" height="380px" width="500px"/>
                @if(Auth::check())
                    <form method="POST" action="/content/{{ $con->id }}">
                        <button type="submit">Acquista</button>
                    </form>
                @endif
            @endif



        @endif
    @endforeach

@endsection
