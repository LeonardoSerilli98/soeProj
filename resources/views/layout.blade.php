<html lang="zxx" class="no-js">

<head>
  
  <!-- meta character set -->
  <meta charset="UTF-8" />
  <!-- Site Title -->
  <title>ContentUni</title>

  
  <!--
      CSS
      =============================================
    -->
  <link rel="stylesheet" href="{{asset('css/linearicons.css')}}" />
  <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}" />
  <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}" />
  <link rel="stylesheet" href="{{asset('css/main.css')}}" />
</head>

<body>
  <!-- ================ Start Header Area ================= -->
  <header class="default-header">
    <nav class="navbar navbar-expand-lg  navbar-light">
      <div class="container">
        <a class="navbar-brand" href="index.html">
        @if(Auth::check())                                       
            <a href="{{ route('logout') }}" 
                  onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                          <span class="icon-lock icons"></span>
                            {{ __('Logout') }}
          </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
             
              @csrf
             </form>

            
          @else
          
          <a href="{{route('auth')}}" > Login / SingUp </a>
          @endif
          
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="lnr lnr-menu"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end align-items-center" id="navbarSupportedContent">
          <ul class="navbar-nav">
            <li><a href="{{route('master')}}">Home</a></li>
            
            @if(Auth::check())

            <li><a href="{{route('mypages')}}">MyPages</a></li>
            
            @endif

            <li><a href="courses.html">Popoular</a></li>
            <!-- Dropdown -->
            
            
            </li>
            <li><a href="contacts.html">Contacts</a></li>

            <li>
              <button class="search">
                <span class="lnr lnr-magnifier" id="search"></span>
              </button>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="search-input" id="search-input-box">
      <div class="container">
        <form class="d-flex justify-content-between">
          <input type="text" class="form-control" id="search-input" placeholder="Search Here" />
          <button type="submit" class="btn"></button>
          <span class="lnr lnr-cross" id="close-search" title="Close Search"></span>
        </form>
      </div>
    </div>
  </header>
  <!-- ================ End Header Area ================= -->
  
  @yield("content");

  <script src="{{asset('js/vendor/jquery-2.2.4.min.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
    crossorigin="anonymous"></script>
  <script src="{{asset('js/vendor/bootstrap.min.js')}}"></script>
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
  <script src="{{asset('js/jquery.magnific-popup.min.js')}}"></script>
  <script src="{{asset('js/jquery.nice-select.min.js')}}"></script>
  <script src="{{asset('js/main.js')}}"></script>
</body>

</html>