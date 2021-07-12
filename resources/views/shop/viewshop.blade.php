@extends('layouts.app')

@section('content')
<style>
    .cards-deck {
        margin-top: 10px;
        margin-left: auto;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        grid-gap: 10px;
        padding: 10px;
    }

    .cards {
        border-radius: 4px;
        background: #fff;
        box-shadow: 0 6px 10px rgba(0, 0, 0, .08), 0 0 6px rgba(0, 0, 0, .05);
        transition: .3s transform cubic-bezier(.155, 1.105, .295, 1.12), .3s box-shadow, .3s -webkit-transform cubic-bezier(.155, 1.105, .295, 1.12);
        cursor: pointer;
    }

    .cards:hover {
        transform: scale(1.05);
        box-shadow: 0 10px 20px rgba(0, 0, 0, .12), 0 4px 8px rgba(0, 0, 0, .06);
    }

    .cards-img-top {
        width: 100%;
        height: 10vw;
        object-fit: cover;
    }

    .card-horizontal {
        display: flex;
        flex: 1 1 auto;
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
</style>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-horizontal">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 row offset-md-1 text-center">
                                    <div class="avatar-big" style="margin-left: 50px !important;">
                                        <img class="avatar-img rounded-circle text-center " src="{{ asset('uploads/user/' . $user->image) }}">
                                    </div>
                                    <div class="col-md-6 mt-5">
                                        <h3>{{ $shop->sname }}</h3>
                                    </div>
                                </div>
                                <div class="col-md-4 row offset-md-1 mt-5">
                                    <div class="col-md-8 row ">
                                        <i class="fas fa-boxes fa-2x mr-3"></i>
                                        <h5 class="mt-1">Products: {{ $count }}</h5>
                                    </div>
                                    <div class="col-md-8 row ">
                                        <i class="fas fa-star fa-2x mr-3"></i>
                                        <h5 class="mt-1">Rating: {{ $shop->rating }} Ratings</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="cards-deck">
                    @foreach($products as $product)
                    <div class="cards">
                        <a href="/detailproduct/{{ $product->id }}" style="text-decoration: none;">
                            <img class="cards-img-top" src="{{ asset('uploads/product/' . $product->image) }}" alt="">

                            <div class="card-body">
                                <h6 class="card-title">{{$product->name}}</h6>
                                <p class="card-text">RM {{number_format((float)$product->price, 2, '.', '')}}</p>
                                <p class="card-text float-right"><small class="text-muted">
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        888 sold
                                        <p class="float-right offset-md-3 ">Negeri Sembilan</p>
                                    </small>
                                </p>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</body>
@endsection