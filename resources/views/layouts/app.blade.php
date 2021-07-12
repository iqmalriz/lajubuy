<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>LajuBUY</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>



    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- <script src="https://use.fontawesome.com/1a5b22afa5.js"></script> -->
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
    <link rel='stylesheet' href='https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css'>

    <style>
    body{min-width: 1280px;}

    .avatar-small {
        height: 20px;
        width: 20px;
    }


    .avatar-img {
        width: 100%;
        height: 100%;
        -o-object-fit: cover;
        object-fit: cover;
    }


    </style>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="float-left">
        <a href="{{ url('/home') }}" target="_blank" style="text-decoration: none; color:black">Seller Centre</a>
        </div>

            <div class="container">

                <a class="navbar-brand" href="{{ url('/') }}">
                    Laju<b>BUY</b>
                    <!--{{ config('app.name', 'Laravel') }}-->
                </a>

                <form class="form-inline">
                    <div class="input-group">
                    <input class="form-control mr-sm-2" size="70" type="search" placeholder="Search" aria-label="Search">
                    <span>
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fas fa-search" aria-hidden="true"></i></button>
                    </span>
                    </div>
                </form>

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
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Sign Up') }}</a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        
                        @if (Route::has('register'))
                        <li class="nav-item">
                        </li>
                        @endif
                        @else
                        <li class="nav-item mr-2">
                            <a href="/showcart" class="nav-link link-dark">
                                <i class="fas fa-shopping-cart fa-2x"></i>&emsp;
                            </a>
                        </li>
                        <li class="nav-item">
                            <div class="avatar-small mt-2">
                                <img class="avatar-img rounded-circle text-center" src="{{ asset('uploads/user/' . Auth::user()->image) }}">
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/account">
                                    {{ __('My Account') }}
                                </a>
                                <a class="dropdown-item mt-2" href="/order">
                                    {{ __('My Purchase') }}
                                </a>
                                <a class="dropdown-item mt-2" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>