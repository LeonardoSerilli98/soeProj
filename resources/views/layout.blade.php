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
    
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
          
        
        

        
          
            <div class="search">
              <input type="text" class="searchTerm" placeholder="What are you looking for?">
                <button type="submit" class="searchButton">
                  <i class="fa fa-search"></i>
                </button>
            </div>
          
        
          
          
            <li><a href="{{route('master')}}">Home</a></li>
            
            @if(Auth::check())

            <li><a href="{{route('mypages')}}">MyPages</a></li>
            
            @endif

            <li><a href="courses.html">Popoular</a></li>
            <!-- Dropdown -->
            
            
            </li>
            <li><a href="contacts.html">Contacts</a></li>
            
          
          
        
      </div>
      
    </nav>
    
    </header>
    
  <!-- ================ End Header Area ================= -->
  
  @yield("content");

  <script src="js/vendor/jquery-2.2.4.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
    crossorigin="anonymous"></script>
  <script src="js/vendor/bootstrap.min.js"></script>
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
  <script src="js/jquery.ajaxchimp.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/parallax.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.sticky.js"></script>
  <script src="js/hexagons.min.js"></script>
  <script src="js/jquery.counterup.min.js"></script>
  <script src="js/waypoints.min.js"></script>
  <script src="js/jquery.nice-select.min.js"></script>
  <script src="js/main.js"></script>

</html>
