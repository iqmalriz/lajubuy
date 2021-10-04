@extends('layouts.appseller')

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
                        <a class="nav-link" href="/accountseller">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/addressseller">Addresses</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/passwordseller">Change Password</a>
                    </li>
                </ul>
                <div class="card" style="margin-left: 150px;">
                    <div class="card-horizontal">
                        <div class="card-body">
                            <div class="card-text">
                                <div class="row">
                                    <div class="col-md-5">
                                        <h5 class="font-weight-bold">My Addresses</h5>
                                    </div>
                                    <div class="col-md-3 offset-md-4">
                                        <button type="button" class="btn btn-primary btn-block p-2" data-toggle="modal" data-target="#addaddressmodal">
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                            Add New Address
                                        </button>
                                    </div>
                                </div>
                            </div>

                            @for($i=0; $i < $addresses->count(); $i++)
                            <hr>
                            <div class="card-text">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group row mb-0">
                                            <label class="col-md-3 offset-md-1 col-form-label text-md-right">{{ __('Full Name') }}</label>
                                            <div class="col-md-6">
                                                <label class="col-form-label text-md-left">{{ $addresses[$i]->aname }}</label>
                                                @if ($addresses[$i]->default == 1)
                                                <span class="badge badge-pill badge-success">Default</span>
                                                @endif
                                                @if ($addresses[$i]->shopadd == 1)
                                                <span class="badge badge-pill badge-danger">Pickup</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row mb-0">
                                            <label class="col-md-3 offset-md-1 col-form-label text-md-right">{{ __('Phone') }}</label>
                                            <div class="col-md-6">
                                                <label class="col-form-label text-md-left">{{ $addresses[$i]->aphone }}</label>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-0">
                                            <label class="col-md-3 offset-md-1 col-form-label text-md-right">{{ __('Address') }}</label>
                                            <div class="col-md-6">
                                                <label class="col-form-label text-md-left">{{ $addresses[$i]->street }}</label>
                                                <label class="col-form-label text-md-left">{{ $addresses[$i]->city }},</label>
                                                <label class="col-form-label text-md-left">{{ $addresses[$i]->zip }} {{ $addresses[$i]->state }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group row mt-3">
                                            <a href="#" class="col-md-3 offset-md-5" data-toggle="modal" data-target="#editaddress{{$i}}">Edit</a>
                                            <div>
                                                @if ($addresses[$i]->default == 0 && $addresses[$i]->shopadd == 0)
                                                <a href="/deleteaddressseller/{{ $addresses[$i]->id }}" class="col-md-4 delete-confirm">Delete</a>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <a href="/setasdefaultseller/{{ $addresses[$i]->id }}" class="col-md-6 offset-md-5" style="text-decoration: none;">
                                                @if ($addresses[$i]->default == 1)
                                                <button class="btn btn-secondary btn-block" disabled>Set as Default</button>
                                                @else
                                                <button class="btn btn-success btn-block">Set as Default</button>
                                                @endif
                                               
                                            </a>
                                            <a href="/setaspickupseller/{{ $addresses[$i]->id }}" class="col-md-6 offset-md-5"  style="text-decoration: none;">
                                            @if ($addresses[$i]->shopadd == 1)
                                                <button class="btn btn-secondary btn-block mt-1" disabled>Set as Pickup</button>
                                                @else
                                                <button class="btn btn-danger btn-block mt-1">Set as Pickup</button>
                                                @endif
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="editaddress{{$i}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">New Address</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form method="POST" action="#" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <input id="aname" type="text" class="form-control" name="aname" placeholder="Full Name" value="{{$addresses[$i]->aname}}" required autofocus>
                                                </div>
                                                <div class="form-group">
                                                    <input id="aphone" type="text" class="form-control" name="aphone" placeholder="Phone Number" value="{{$addresses[$i]->aphone}}" required>
                                                </div>
                                                <div class="form-group">
                                                    <input id="zip" type="text" class="form-control" name="zip" placeholder="Postal Code" value="{{$addresses[$i]->zip}}" required>
                                                </div>
                                                <div class="form-group">
                                                    <input id="state" type="text" class="form-control" name="state" placeholder="State" value="{{$addresses[$i]->state}}" required>
                                                </div>
                                                <div class="form-group">
                                                    <input id="city" type="text" class="form-control" name="city" placeholder="City" value="{{$addresses[$i]->city}}" required>
                                                </div>
                                                <div class="form-group">
                                                    <input id="street" type="text" class="form-control" name="street" placeholder="Building, Street and etc..." required value="{{$addresses[$i]->street}}">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="button submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="addaddressmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">New Address</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="/addaddressseller" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <input id="aname" type="text" class="form-control" name="aname" placeholder="Full Name" required autofocus>
                        </div>
                        <div class="form-group">
                            <input id="aphone" type="text" class="form-control" name="aphone" placeholder="Phone Number" required>
                        </div>
                        <div class="form-group">
                            <input id="zip" type="text" class="form-control" name="zip" placeholder="Postal Code" required>
                        </div>
                        <div class="form-group">
                            <input id="state" type="text" class="form-control" name="state" placeholder="State" required>
                        </div>
                        <div class="form-group">
                            <input id="city" type="text" class="form-control" name="city" placeholder="City" required>
                        </div>
                        <div class="form-group">
                            <input id="street" type="text" class="form-control" name="street" placeholder="Building, Street and etc..." required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>




</body>
<script>
            $('.delete-confirm').on('click', function(event) {
            event.preventDefault();
            const url = $(this).attr('href');
            Swal.fire({
                title: 'Are you sure?',
                text: 'This record and it`s details will be permanently deleted!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        });
    </script>

@endsection