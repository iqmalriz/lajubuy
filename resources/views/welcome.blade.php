@extends('layouts.app')

@section('content')
<style>
.card-deck{
    margin-top: 10px;
    margin-left: auto;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    grid-gap: 10px;
    padding: 10px;
}
.card{
    border-radius: 4px;
    background: #fff;
    box-shadow: 0 6px 10px rgba(0,0,0,.08), 0 0 6px rgba(0,0,0,.05);
      transition: .3s transform cubic-bezier(.155,1.105,.295,1.12),.3s box-shadow,.3s -webkit-transform cubic-bezier(.155,1.105,.295,1.12);
  cursor: pointer;
}

.card:hover{
     transform: scale(1.05);
  box-shadow: 0 10px 20px rgba(0,0,0,.12), 0 4px 8px rgba(0,0,0,.06);
}

.card-img-top {
    width: 100%;
    height: 10vw;
    object-fit: cover;
}
</style>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12" >
                <div class="card-deck">
                    @foreach($products as $product)
                    <div class="card">
                        <a href="/detailproduct/{{ $product->id }}" style="text-decoration: none;">
                        <img class="card-img-top" src="{{ asset('uploads/product/' . $product->image) }}" alt="">
                        
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
                                <p class="float-right">Negeri Sembilan</p>
                            </small></p>
                            <!-- <p class="card-text"><small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum dicta voluptas quia dolor fuga odit.</small></p> -->
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