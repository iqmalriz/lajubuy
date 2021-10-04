<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>LajuBUY</title>
    <link rel="shortcut icon" href="uploads/lajubuy/lajubuywhite.png" />

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <!-- <script src="https://use.fontawesome.com/1a5b22afa5.js"></script> -->
    <!-- <script src="https://use.fontawesome.com/3850f97ccd.js"></script> -->
    <script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="//www.tracking.my/track-button.js"></script>



    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css"> -->
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
    <link rel='stylesheet' href='https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css'>

    <style>
        body {
            min-width: 1280px;
        }

        .avatar-small {
            height: 20px;
            width: 20px;
        }

        .avatar-big {
            height: 30px;
            width: 30px;
        }


        .avatar-img {
            width: 100%;
            height: 100%;
            -o-object-fit: cover;
            object-fit: cover;
        }

        .badge {
  padding-left: 9px;
  padding-right: 9px;
  -webkit-border-radius: 9px;
  -moz-border-radius: 9px;
  border-radius: 9px;
}

.label-warning[href],
.badge-warning[href] {
  background-color: #c67605;
}
#lblCartCount {
    font-size: 12px;
    background: #ff0000;
    color: #fff;
    padding: 0 5px;
    vertical-align: top;
    margin-left: -10px; 
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

                <form method="POST" action="/searchproduct" enctype="multipart/form-data" class="form-inline">
                @csrf
                    <div class="input-group">
                        <input class="form-control mr-sm-2" size="70" name="search" type="search" placeholder="Search" aria-label="Search">
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
                            <a class="nav-link"  href="{{ route('register') }}">{{ __('Sign Up') }}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>

                        @if (Route::has('register'))
                        <li class="nav-item">
                        </li>
                        @endif
                        @else
                        <?php
                            $countCart = \App\Order::join('carts', 'orders.id', '=', 'carts.orderid')->where('orders.userid', \Illuminate\Support\Facades\Auth::id())->where('orders.completed', 0)->count();
                        ?>
                        <li class="nav-item mr-2">
                            <a href="/showcart" class="nav-link link-dark">
                                <i class="fas fa-shopping-cart fa-2x"></i>@if($countCart > 0)<span class='badge badge-warning' id='lblCartCount'> {{ $countCart }} </span>@endif &emsp;
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

        <!-- Modal Login -->
        <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body p-3 text-center">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="top: -5px;right: 15px;">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <img class="center-block " alt="Brand" width="100" src="uploads/lajubuy/lajubuy.png">

                                <h1 class="p-4 mt-0">Welcome to LajuBUY</h1>

                                <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <div class="form-group row">
                                        <!-- <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label> -->

                                        <div class="col-md-7 mx-auto">
                                            <input id="email" placeholder="Email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <!-- <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label> -->

                                        <div class="col-md-7 mx-auto">
                                            <input id="password" placeholder="Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-6 offset-md-2">
                                            @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class=" col-md-5 mx-auto">
                                            <button type="submit" class="btn btn-primary btn-block rounded-pill">
                                                {{ __('Login') }}
                                            </button>


                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class=" col-md-6 mx-auto">
                                            <small>By continuing, you agree to LajuBUY's <strong>Terms of Service</strong> and
                                                acknowledge you've read our <strong>Privacy Policy</strong></small>
                                        </div>

                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class=" col-md-2 mx-auto">
                                            <hr style="border-top: 1px solid white;">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class=" col-md-6 mx-auto">
                                            <a data-toggle="modal" data-target="#registerModal" href="#" data-dismiss="modal"><small><strong>New to LajuBUY? Sign
                                                        up</strong></small></a>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- @if (count($errors) > 0)
        <script>
            $( document ).ready(function() {
                $('#loginModal').modal('show');
            });
       </script>
        @endif -->

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>