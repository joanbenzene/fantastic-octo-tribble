<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link href={{ url('/css/app.css') }} rel="stylesheet">

    <title> TEST</title>
  </head>
  <body>
       <nav class="navbar navbar-expand-lg navbar-light bg-light">
         <div class="container-fluid">
           <a class="navbar-brand" href="#"><h3><b>Projet</b></h3></a>
           <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
             <span class="navbar-toggler-icon"></span>
           </button>
           <div class="collapse navbar-collapse" id="navbarSupportedContent">
             <ul class="navbar-nav me-auto mb-2 mb-lg-0">
             </ul>
             @guest
             <div class="form-inline my-2 my-lg-0">
                <a class="btn btn-primary" href="/register">Sign Up</a>
                <a class="btn btn-outline-primary" href="/login">Log In</a>
             </div>
             @endguest
             @auth
                   <div class="nav-item dropdown">
                       <a href="#" class="nav-link dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                           {{ Auth::user()->name }}
                       </a>
                       <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                           <li><a class="dropdown-item" href="{{ route('booking') }}">Reservation</a></li>
                           <li><a class="dropdown-item" onclick="myFunction()" href="#">Copier mon Lien</a></li>
                           <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">{{ __('Logout') }}</a></li>
                       </ul>
                   </div>
                   <input type="text" value="http://localhost:8000/register?key={{ Auth::user()->username }}" id="myInput"
                          style="opacity: 0; position: absolute; left: -1000px; top: -1000px">
                   <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                       @csrf
                   </form>
             @endauth
           </div>
         </div>
       </nav>
       <div class="pt-6 mt-6">
           @yield('content')
       </div>

    <!-- Optional JavaScript; choose one of the two! -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src={{ url("js/app.js") }}></script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

       <script>
           function myFunction() {
               var copyText = document.getElementById("myInput");
               copyText.select();
               copyText.setSelectionRange(0, 99999)
               document.execCommand("copy");
               alert("Copied the text: " + copyText.value);
           }
       </script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    -->
  </body>
</html>
