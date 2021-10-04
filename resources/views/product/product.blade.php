@extends('layouts.appseller')

@section('content')

<style>
    .card-img-top {
        width: 7vw;
        height: 100%;
        object-fit: cover;
    }

    .card-horizontal {
        display: flex;
        flex: 1 1 auto;
    }
</style>
@if (session('status'))
<script>
    Swal.fire("", "{{ session('status') }}", "{{ session('icon') }}");
</script>
@endif

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-horizontal">
                        <div class="card-body">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">In Stock</a>
                                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Sold out</a>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="card mt-3">
                            <div class="card-horizontal">
                                <div class="card-body">
                                    <a href="/product" class="btn btn-primary float-right mb-2">Add New Product</a>
                                    <table class="table table-stripped table-bordered" id="productlist">
                                        <thead class="thread-dark">
                                            <tr>
                                                <!-- <th scope="col">#</th> -->
                                                <!-- <th scope="col">Image</th> -->
                                                <th scope="col">Name</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Stock</th>
                                                <th>Edit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($products as $product)
                                            <tr>
                                                <!-- <td> <img src="{{ asset('uploads/product/' . $product->image) }}" width="100px" height="auto" alt="image"></td> -->
                                                <td> {{ $product->name }}</td>
                                                <td>RM {{number_format((float)$product->price, 2, '.', '')}}</td>
                                                <td> {{ $product->stock }}</td>
                                                <td><a href="/editproduct/{{ $product->id }}" class="btn btn-success">Update</a>
                                                    <a href="/deleteproduct/{{ $product->id }}" class="btn btn-danger delete-confirm">Delete</a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <div class="card mt-3">
                            <div class="card-horizontal">
                                <div class="card-body">
                                    <a href="/product" class="btn btn-primary float-right mb-2">Add New Product</a>
                                    <table class="table table-stripped table-bordered" id="productlistsold">
                                        <thead class="thread-dark">
                                            <tr>
                                                <!-- <th scope="col">#</th> -->
                                                <!-- <th scope="col">Image</th> -->
                                                <th scope="col">Name</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Stock</th>
                                                <th>Edit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($products2 as $product)
                                            <tr>
                                                <!-- <td> <img src="{{ asset('uploads/product/' . $product->image) }}" width="100px" height="auto" alt="image"></td> -->
                                                <td> {{ $product->name }}</td>
                                                <td>RM {{number_format((float)$product->price, 2, '.', '')}}</td>
                                                <td> {{ $product->stock }}</td>
                                                <td><a href="/editproduct/{{ $product->id }}" class="btn btn-success">Update</a>
                                                    <a href="/deleteproduct/{{ $product->id }}" class="btn btn-danger">Delete</a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#productlist').DataTable();
        });

        $(document).ready(function() {
            $('#productlistsold').DataTable();
        });

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
</body>
@endsection