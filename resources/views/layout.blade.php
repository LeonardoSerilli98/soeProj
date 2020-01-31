<html lang="zxx" class="no-js">

<head>

  <!-- meta character set -->
  <meta charset="UTF-8" />
  <!-- Site Title -->
  <title>Sharing Appunti</title>
  <link rel="stylesheet" href="{{asset('css\nuovo.css')}}" />
  
</head>

</head>

<body>

<header>
<div>
  
<ul class="ul">
    <li>
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
    </li>
    

            
                <form method="GET" action="/search">
                    @csrf
                  <li><a>
                    Ricerca per materia:

                    <select name="subject">
                            <option value="0">Materie:</option>
                        @foreach($materie as $materia)
                            <option value="{{$materia->id}}"> {{$materia->materia}}</option>
                            @endforeach
                    </select>
                  </a></li>
                  <li><a>
                    oppure per utente

                    <input name="user" type="text" class="searchTerm" placeholder="inserisci nome utente">

                    <button type="submit" class="searchButton"> search </button>
                    </a> </li>
                </form>
              

            

            <li><a href="{{route('master')}}">Home</a></li>

            @if(Auth::check())

            <li> <a href="{{route('mypages')}}">Profile</a></li>

            @endif
            
  </ul>

    </header>
</div>

  <!-- ================ End Header Area ================= -->

  @yield("content")



</body>

</html>
