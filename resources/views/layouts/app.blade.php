<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset("plugins/bootstrap/css/bootstrap.min.css")}}" >
    <link rel="stylesheet" href="{!! asset('CSS/plantillamain.css')!!}" >

    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="//fonts.googleapis.com/css?family=Lato:300,400,700,900,300italic,400italic,700italic,900italic" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Plataforma CIM</title>
</head>
<body class="back">
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
           <!-- <div class="container">-->
               <div class="">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="{{asset('images/logo.png')}}" alt="#" class = "logoUASLP-ING">
                    </a>
                    <a class="navbar-brand" href="{{ route('mainUsuario') }}">
                        Home
                    </a>
               </div>
               
                
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-right" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}  <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
           <!-- </div>-->
        </nav>

        <main class="py-4">
            <br><br><br>
            @yield('content')
        </main>
        <br><br><br><br>
        <footer class="page-footer font-small border-top pt-4  ">
            <div class="footer-copyright text-center py-3">© 2019 Copyright:
                <a href="#" class="text-white " >UASLP</a>
              </div>
          </footer>

          <!--Scripts-->
          <script src="{{ asset('js/functions.js') }}" ></script>
    </div>
</body>
</html>
