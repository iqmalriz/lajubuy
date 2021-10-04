@extends('layouts.app')

@section('content')
<style>
    .card-img-top {
        width: 30vw;
        height: 100%;
        object-fit: cover;
    }

    .card-horizontal {
        display: flex;
        flex: 1 1 auto;
    }

    .avatar-big {
        height: 70px;
        width: 70px;
    }

    .avatar-med {
            height: 40px;
            width: 40px;
    }


    .avatar-img {
        width: 100%;
        height: 100%;
        -o-object-fit: cover;
        object-fit: cover;
    }
</style>

<body>
    @if (session('status'))
    <script>
        Swal.fire("", "{{ session('status') }}", "{{ session('icon') }}");
    </script>
    @endif
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-horizontal">
                        <div class="img-square-wrapper">
                            <img class="card-img-top" src="{{ asset('uploads/product/' . $product->image) }}" alt="">
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">{{$product->name}}</h4>
                            <p class="card-text">
                                @if($productrate == 0)
                                    No Ratings Yet 
                                @else
                                    <strong>{{number_format((float)$productrate, 1, '.', '')}}</strong>
                                    @php $rating = $productrate; @endphp

                                    @foreach(range(1,5) as $i)
                                    <span class="fa-stack" style="width:1em; margin-top:-5px">
                                        <i class="far fa-star fa-stack-1x" style="color:#ffc40c;"></i>

                                        @if($rating >0)
                                            @if($rating >0.5)
                                                <i class="fas fa-star fa-stack-1x" style="color:#ffc40c;"></i>
                                            @else
                                                <i class="fas fa-star-half fa-stack-1x" style="color:#ffc40c;"></i>
                                            @endif
                                        @endif
                                        @php $rating--; 
                                    @endphp
                                    </span>
                                    @endforeach
                                
                                @endif
                                &emsp;|&emsp; <strong>{{$totalstar}}</strong> Ratings
                                &emsp;|&emsp; <strong>{{$product->sold}}</strong> Sold
                            </p>
                            <p>&emsp;</p>
                            <div style="background-color: whitesmoke; padding:10px;">
                                <h2 class="card-text">RM {{number_format((float)$product->price, 2, '.', '')}}</h2>
                            </div>
                            <p>&emsp;</p>
                            <form method="POST" action="/addtocart" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" id="productid" name="productid" value="{{ $product->id }}">
                                <div class="input-group">
                                    <h3 class="card-text">Quantity</h3>&emsp;
                                    <span class="input-group-btn">
                                        <button type="button" class="quantity-left-minus btn btn-danger btn-number" data-type="minus" data-field="">
                                            <i class="fa fa-minus" aria-hidden="true"></i>
                                        </button>
                                    </span>
                                    <input type="text" id="quantity" name="quantity" size="5" style="text-align: center;" value="1" min="1" readonly>
                                    <span class="input-group-btn">
                                        <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus" data-field="">
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                        </button>
                                    </span>
                                </div>

                                <p>&emsp;</p>
                                <button type="submit" class="btn btn-primary"><i class="fa fa-cart-plus"></i> Add to Cart</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-horizontal">
                        <div class="card-body">
                            <div class="row">

                                <a href="/shop/{{ $shop->id }}" class="col-md-6 row text-center" style="text-decoration: none; color:black">
                                    <div class="avatar-big" style="margin-left: 50px !important;">
                                        <img class="avatar-img rounded-circle text-center " src="{{ asset('uploads/user/' . $user->image) }}">
                                    </div>
                                    <div class="col-md-4 mt-4">
                                        <h5>{{ $shop->sname }}</h5>
                                    </div>
                                </a>

                                <div class="col-md-3 row  mt-2">
                                    <div class="col-md-8 row ">
                                        <!-- <i class="fas fa-boxes fa-2x mr-3"></i> -->
                                        <h6 class="mt-1">Products: <strong>{{ $count }} units</strong></h6>
                                    </div>
                                    <div class="col-md-8 row ">
                                        <!-- <i class="fas fa-star fa-2x mr-3"></i> -->
                                        <h6 class="mt-1">Rating: <strong>{{ $shop->rating }} Ratings</strong></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-body">
                        <h4 style="background-color: whitesmoke; padding:10px;" class="card-title">Product Specification</h4>
                        <div class="card-text">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group row mb-0">
                                        <label class="col-md-3 ml-5 col-form-label text-md-left">{{ __('Brand') }}</label>
                                        <div class="col-md-6">
                                            <label class="col-form-label text-md-left">{{ __('-') }}</label>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-0">
                                        <label class="col-md-3 ml-5 col-form-label text-md-left">{{ __('Model') }}</label>
                                        <div class="col-md-6">
                                            <label class="col-form-label text-md-left">{{ __('-') }}</label>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-0">
                                        <label class="col-md-3 ml-5 col-form-label text-md-left">{{ __('Stock') }}</label>
                                        <div class="col-md-6">
                                            <label class="col-form-label text-md-left"><strong>{{ $product->stock }}</strong></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h4 style="background-color: whitesmoke; padding:10px;" class="card-title mt-2">Product Description</h4>
                        <p class="ml-5"> <?php echo nl2br($product->description) ?></p>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-body">
                        <h4 style="background-color: whitesmoke; padding:10px;" class="card-title">Product Ratings</h4>

                        @foreach($reviews as $review)
                        <div class="row">
                        <div class="avatar-med mt-2 ml-5">
                            <img class="avatar-img rounded-circle text-center" src="{{ asset('uploads/user/' . $review->image) }}">
                            
                        </div>
                        <div class="col-md-6 mt-2">
                                {{$review->name}}
                                <p>
                                @php $rating = $review->rating; @endphp

                                    @foreach(range(1,5) as $i)
                                    <span class="fa-stack" style="width:1em; margin-top:-5px">
                                        <i class="far fa-star fa-stack-1x" style="color:#ffc40c;"></i>

                                        @if($rating >0)
                                            @if($rating >0.5)
                                                <i class="fas fa-star fa-stack-1x" style="color:#ffc40c;"></i>
                                            @else
                                                <i class="fas fa-star-half fa-stack-1x" style="color:#ffc40c;"></i>
                                            @endif
                                        @endif
                                        @php $rating--; 
                                    @endphp
                                    </span>
                                    @endforeach
                                </p>
                                <p>
                                <?php echo nl2br($review->comment) ?>
                                </p>
                                <p><small class="text-muted">{{$review->date}}</small></p>
                            </div>
                        </div>
                        <hr>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            var quantitiy = 0;
            $('.quantity-right-plus').click(function(e) {

                // Stop acting like a button
                e.preventDefault();
                // Get the field name
                var quantity = parseInt($('#quantity').val());

                // If is not undefined
                if (quantity < '{{$product->stock}}') {
                    $('#quantity').val(quantity + 1);
                }
                // Increment

            });

            $('.quantity-left-minus').click(function(e) {
                // Stop acting like a button
                e.preventDefault();
                // Get the field name
                var quantity = parseInt($('#quantity').val());

                // If is not undefined

                // Increment
                if (quantity > 1) {
                    $('#quantity').val(quantity - 1);
                }
            });

        });
    </script>
</body>

@endsection