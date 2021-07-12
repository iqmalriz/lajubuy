@extends('layouts.app')

@section('content')
<style>
    .card-horizontal {
        display: flex;
        flex: 1 1 auto;
    }

    .mycontent-right {
        border-left: 1px solid #d3d3d3;

    }

    .no-margin {
        margin: 0px !important;
    }

    .avatar-big {
        height: 150px;
        width: 150px;
    }


    .avatar-img {
        width: 100%;
        height: 100%;
        -o-object-fit: cover;
        object-fit: cover;
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
                                <h5 class="font-weight-bold">My Profile</h4>
                                    <h6>Manage and protect your account
                                </h5>
                            </div>
                            <hr>
                            <form method="POST" action="/updateaccount" enctype="multipart/form-data">
                                @csrf
                                {{ method_field('PUT') }}

                                <div class="row ">
                                    <div class="col-md-8 mycontent-left">

                                        <div class="form-group row ">
                                            <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('Name') }}</label>

                                            <div class="col-md-6">
                                                <input id="name" type="text" class="form-control" value="{{ $user->name}}" name="name" required>
                                            </div>
                                        </div>
                                        <div class="form-group row ">
                                            <label for="email" class="col-md-3 col-form-label text-md-right">{{ __('Email') }}</label>

                                            <div class="col-md-6">
                                                <input id="email" type="text" class="form-control" value="{{ $user->email}}" name="email" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row ">
                                            <label for="phone" class="col-md-3 col-form-label text-md-right">{{ __('Phone Number') }}</label>

                                            <div class="col-md-6">
                                                <input id="phone" type="text" class="form-control" value="{{ $user->phone}}" name="phone" required>
                                            </div>
                                        </div>
                                        <div class="form-group row ">
                                            <label for="sname" class="col-md-3 col-form-label text-md-right">{{ __('Shop Name') }}</label>

                                            <div class="col-md-6">
                                                <input id="sname" type="text" class="form-control" value="{{ $shop->sname}}" name="sname" required>
                                            </div>
                                        </div>
                                        <div class="form-group row ">
                                            <label for="dob" class="col-md-3 col-form-label text-md-right">{{ __('Date Of Birth') }}</label>

                                            <div class="col-md-6">
                                                <input id="dob" type="date" class="form-control" value="{{ $user->dob}}" name="dob" required>
                                            </div>
                                        </div>
                                        <div class="form-group row mt-2 ">
                                            <div class="col-md-6 offset-md-3">
                                                <button type="submit" class="btn btn-primary save">
                                                    {{ __('Save') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mycontent-right">
                                        <div class="avatar-big mb-3" style="margin-left: 70px !important;">
                                            <img id="img" class="avatar-img rounded-circle text-center" src="{{ asset('uploads/user/' . $user->image) }}">
                                        </div>
                                        <div class="text-center">
                                            <label class="btn btn-primary">
                                                Select Image <input type="file" id="image" name="image" onchange="readURL(this)" hidden>
                                            </label>

                                        </div>
                                        <div class="text-center">File extension: .JPEG, .PNG</div>
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
    <script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#img').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#image").change(function() {
            readURL(this);
        });

        // document.querySelector(".save").addEventListener('click', function() {
        //     Swal.fire("Profile Updated", "", "success");
        // });
    </script>

</body>

@endsection