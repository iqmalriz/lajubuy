@extends('layouts.app')

@section('content')
<style>
    .card-horizontal {
        display: flex;
        flex: 1 1 auto;
    }

    .img-center {
        margin: 0 auto;
    }
</style>

<body>
@if (session('status'))
    <script>
      Swal.fire("{{ session('status') }}", "", "{{ session('icon') }}");
    </script>
@endif
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-12">
                <ul class="nav flex-column float-left">
                    <li class="nav-item">
                        <a class="nav-link" href="/account">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/address">Addresses</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/password">Change Password</a>
                    </li>
                </ul>
                <div class="card" style="margin-left: 150px;">
                    <div class="card-horizontal">
                        <div class="card-body">

                            <div class="card-text">
                                <h5 class="font-weight-bold">Change Password</h4>
                                    <h6>For your account's security, do not share your password with anyone else
                                </h5>
                            </div>
                            <hr>
                            <form method="POST" action="/password" enctype="multipart/form-data">
                                @csrf
                                {{ method_field('PUT') }}

                                <div class="row ">
                                    <div class="col-md-8 offset-md-1">

                                        <div class="form-group row ">
                                            <label for="currentpassword" class="col-md-3 col-form-label text-md-right">{{ __('Current Password') }}</label>

                                            <div class="col-md-6">
                                                <input id="currentpassword" type="password" class="form-control" name="currentpassword" required>
                                            </div>
                                        </div>
                                        <div class="form-group row ">
                                            <label for="newpassword" class="col-md-3 col-form-label text-md-right">{{ __('New Password') }}</label>

                                            <div class="col-md-6">
                                                <input id="newpassword" type="password" class="form-control" name="newpassword" required>
                                            </div>
                                        </div>
                                        <div class="form-group row ">
                                            <label for="confirmpassword" class="col-md-3 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                            <div class="col-md-6">
                                                <input id="confirmpassword" type="password" class="form-control" name="confirmpassword" required>
                                            </div>
                                        </div>
                                        <div class="form-group row mt-2 ">
                                            <div class="col-md-6 offset-md-3">
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('Confirm') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

</body>

@endsection