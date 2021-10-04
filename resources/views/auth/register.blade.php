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
    <div class="row justify-content-center">
        <div class="col-md-5 offset-md-7 ">
            <div class="card p-4 mt-4 ">

                <div class="card-body">
                <div class="form-group col-md-6 mb-4 row">
                        <h4>Sign Up</h4>
                    </div>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">

                            <div class="col-md-11 mx-auto">
                                <input id="name" placeholder="Full Name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">

                        <div class="col-md-11 mb-1 mx-auto">
                                <input id="phone" placeholder="Phone Number" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone">

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <hr style="width:70%">
                        <div class="form-group row ">

                            <div class="col-md-11 mt-1 mx-auto">
                                <input id="email" placeholder="Email Address" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">

                            <div class="col-md-11 mx-auto">
                                <input id="password" placeholder="Create Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">

                            <div class="col-md-11 mx-auto">
                                <input id="password-confirm" placeholder="Confirm Password" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0 mt-5">
                            <div class="col-md-11 mx-auto">
                                <button type="submit" class="btn btn-primary btn-block ">
                                    {{ __('SIGN UP') }}
                                </button>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-7 mt-4 mx-auto">
                                Have an account? <strong><a class="" href="{{ route('login') }}">{{ __('Log In') }}</a></strong>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
