@extends('layouts.app')

@section('content')

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card-deck">
                    @foreach($products as $product)
                    <div class="card">
                        <a href="/detailproduct/{{ $product->id }}">
                        <img class="card-img-top" src="{{ asset('uploads/product/' . $product->image) }}" width="30%" height="auto" alt="">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title">{{$product->name}}</h5>
                            <p class="card-text">RM {{$product->price}}</p>
                            <p class="card-text"><small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum dicta voluptas quia dolor fuga odit.</small></p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</body>

@endsection