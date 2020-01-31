<html lang="zxx" class="no-js">

<head>

  <!-- meta character set -->
  <meta charset="UTF-8" />
  <!-- Site Title -->
  <title>Sharing Appunti</title>

</head>

<body>

<header>

        @if(Auth::check())
            <a href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                          <span class="icon-lock icons"></span>
                            {{ __('Logout') }}
             </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> @csrf </form>

          @else

          <a href="{{route('auth')}}" > Login / SingUp </a>
          @endif

            <div>
                <form method="GET" action="/search">
                    @csrf

                    Ricerca per materia:

                    <select name="subject">
                            <option value="0">Materie:</option>
                        @foreach($materie as $materia)
                            <option value="{{$materia->id}}"> {{$materia->materia}}</option>
                            @endforeach
                    </select>

                    oppure per utente

                    <input name="user" type="text" class="searchTerm" placeholder="inserisci nome utente">

                    <button type="submit" class="searchButton"> search </button>

                </form>

            </div>

            <li><a href="{{route('master')}}">Home</a></li>

            @if(Auth::check())

            <li><a href="{{route('mypages')}}">MyPages</a></li>

            @endif

    </header>

  <!-- ================ End Header Area ================= -->

  @yield("content");



</body>

</html>
