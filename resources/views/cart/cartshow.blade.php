@extends('layouts.app')

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

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-horizontal">
                        <div class="card-body">
                            @if ($sum == 0)
                            <div class="text-center">
                                <img src="{{ asset('uploads/cart/emptycart.png') }}">
                            </div>
                            <div class="text-center">
                                <a type="button" class="btn btn-primary" href="{{ url('/') }}">
                                    Go Shopping Now
                                </a>
                            </div>
                            @else
                            <div class="card-text">
                                <div class="row">
                                    <div class="col-md-5">Product</div>
                                    <div class="col-md-2">Unit Price</div>
                                    <div class="col-md-2">Quantity</div>
                                    <div class="col-md-2">Total Price</div>
                                    <div class="col-md-1">Action</div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @foreach($carts as $cart)
                <div class="card mt-3">
                    <div class="card-horizontal">
                        <div class="card-body pt-2 pb-2 bg-secondary text-white">
                            <div class="row">
                                <div class="col-md-5">{{ $cart->sname }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-horizontal">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2"><img class="card-img-top" src="{{ asset('uploads/product/' . $cart->image) }}"></div>
                                <div class="col-md-3">{{ $cart->name }}</div>
                                <div class="col-md-2">RM {{number_format((float)$cart->price, 2, '.', '')}}</div>
                                <div class="col-md-2 input-group">
                                    <span class="input-group-btn">
                                        <a href="/minusone/{{ $cart->cartid }}">
                                            <button type="button" style=" height:30px" class="quantity-left-minus btn btn-danger btn-number" data-type="minus" data-field="">
                                                <i class="fa fa-minus" aria-hidden="true"></i>
                                            </button>
                                        </a>
                                    </span>
                                    <input type="text" id="quantity" name="quantity" size="3" style="text-align: center; height:30px" value="{{ $cart->quantity }}" min="1" max="100" readonly>
                                    <span class="input-group-btn">
                                        <a href="/addone/{{ $cart->cartid }}">
                                            <button type="button" style=" height:30px" class="quantity-right-plus btn btn-success btn-number" data-type="plus" data-field="">
                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                            </button>
                                        </a>
                                    </span>
                                </div>
                                <div class="col-md-2">RM {{number_format((float)$cart->subtotal, 2, '.', '')}}</div>
                                <div class="col-md-1"><a href="/deletecart/{{ $cart->cartid }}">Delete</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @if ($sum != 0)
                <div class="card mt-3">
                    <div class="card-horizontal">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-7"></div>
                                <div class="col-md-1.5">
                                    <h4>Total ({{$sum}} item):</h4>
                                </div>
                                <div class="col-md-1.5">
                                    <h3>RM {{number_format((float)$order->total, 2, '.', '')}}</h3>
                                </div>
                                <div class="col-md-1 d-grid gap-2 col-2 mx-auto">
                                    <a href="/checkout/{{ $order->id }}">
                                    <button class="btn btn-primary btn-lg ">Checkout</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- <script>
        $(document).ready(function() {

            var quantitiy = 0;
            $('.quantity-right-plus').click(function(e) {

                // Stop acting like a button
                e.preventDefault();
                // Get the field name
                var quantity = parseInt($('#quantity').val());

                // If is not undefined

                $('#quantity').val(quantity + 1);


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
    </script> -->
</body>

@endsection