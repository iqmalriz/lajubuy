@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('List of Product') }} 
                <a href="/product" class="btn btn-primary float-right">Add New Product</a>
                </div>
                
                <table class="table table-stripped table-bordered">
                    <thead class="thread-dark">
                        <tr>
                            <th scope="col">Image</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Stock</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        <tr>
                            <td> <img src="{{ asset('uploads/product/' . $product->image) }}" width="200px" height="auto" alt="image"></td>
                            <td> {{ $product->name }}</td>
                            <td>RM {{ $product->price }}</td>
                            <td> {{ $product->stock }}</td>
                            <td><a href="/editproduct/{{ $product->id }}" class="btn btn-success">Update</a>
                            <a href="/deleteproduct/{{ $product->id }}" class="btn btn-danger">Delete</a></td>
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection