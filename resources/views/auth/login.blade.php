@extends('layouts.app')

@section('content')
<style>
    .btn-block {
        padding: 3% 0;
    }

    a {
        text-decoration: none !important
    }

    .mycustom {
        position: relative;
    }

    .mycustom input[type=text] {
        border: none;
        width: 100%;
        padding-right: 123px;
    }

    .mycustom .input-group-prepend {
        position: absolute;
        right: 12px;
        top: 4px;
        bottom: 4px;
        z-index: 9;
    }
</style>
<div class="container">
    <div class="row  ">
        <!-- <div class="col-md-3">
            <img style="margin-top: 100px;" src="uploads/lajubuy/lajubuy.png">
        </div> -->
        <div class="col-md-5 offset-md-7 ">
            <div class="card p-4 mt-5 ">
                <!-- <div class="card-header">{{ __('Login') }}</div> -->

                <div class="card-body">
                    <div class="form-group col-md-6 mb-4 row">
                        <h4>Log In</h4>
                    </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">

                            <div class="col-md-11 mx-auto">
                                <input id="email" type="email" class="form-control input-lg @error('email') is-invalid @enderror " name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mt-4">

                            <div class="col-md-11 mx-auto input-group mycustom">
                                <input id="login_password" type="password" class="form-control @error('password') is-invalid @enderror pwd" name="password" placeholder="Password" required autocomplete="current-password">
                                <span class="input-group-prepend" id="eyeSlash">
                                    <button class="btn btn-default " onclick="visibility3()" type="button"><i class="fa fa-eye-slash" aria-hidden="true"></i></button>
                                </span>
                                <span class="input-group-prepend" id="eyeShow" style="display: none;">
                                    <button class="btn btn-default " onclick="visibility3()" type="button"><i class="fa fa-eye" aria-hidden="true"></i></button>
                                </span>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row mb-0 mt-5">
                            <div class="col-md-11 mx-auto">
                                <button type="submit" class="btn btn-primary btn-block ">
                                    {{ __('LOG IN') }}
                                </button>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-11 mt-1 mx-auto">
                                @if (Route::has('password.request'))
                                <a class="form-check-label" href="{{ route('password.request') }}">
                                    {{ __('Forgot Password?') }}
                                </a>
                                @endif

                                <div class="form-check float-right ">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-7 mt-4 mx-auto">
                                New to LajuBUY? <strong><a class="" href="{{ route('register') }}">{{ __('Sign Up') }}</a></strong>

                            </div>
                        </div>

                    </form>



                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function visibility3() {
        var x = document.getElementById('login_password');
        if (x.type === 'password') {
            x.type = "text";
            $('#eyeShow').show();
            $('#eyeSlash').hide();
        } else {
            x.type = "password";
            $('#eyeShow').hide();
            $('#eyeSlash').show();
        }
    }
</script>
@endsection