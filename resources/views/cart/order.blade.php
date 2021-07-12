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
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="nav-all-tab" data-toggle="tab" href="#nav-all" role="tab" aria-controls="nav-all" aria-selected="true">All</a>
                                    <a class="nav-item nav-link" id="nav-toship-tab" data-toggle="tab" href="#nav-toship" role="tab" aria-controls="nav-toship" aria-selected="false">To Ship</a>
                                    <a class="nav-item nav-link" id="nav-toreceive-tab" data-toggle="tab" href="#nav-toreceive" role="tab" aria-controls="nav-toreceive" aria-selected="false">To Receive</a>
                                    <a class="nav-item nav-link" id="nav-completed-tab" data-toggle="tab" href="#nav-completed" role="tab" aria-controls="nav-completed" aria-selected="false">Completed</a>
                                    <a class="nav-item nav-link" id="nav-cancelled-tab" data-toggle="tab" href="#nav-cancelled" role="tab" aria-controls="nav-cancelled" aria-selected="false">Cancelled</a>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-all" role="tabpanel" aria-labelledby="nav-all-tab">
                        @if ($sum == 0)
                        <div class="text-center">
                            <img src="{{ asset('uploads/cart/noorder.png') }}">
                        </div>
                        @else
                        @foreach($carts as $cart)
                        <div class="card mt-3">
                            <div class="card-horizontal">
                                <div class="card-body pt-2 pb-2 bg-secondary text-white">
                                    <div class="row">
                                        <div class="col-md-6">
                                            {{ $cart->sname }}
                                            <a href="/shop/{{ $cart->shopid }}" class="ml-3">
                                                <button class="btn btn-light btn-sm">View Shop</button>
                                            </a>
                                        </div>
                                        <div class="col-md-6">
                                            @if ($cart->status == 'completed')
                                            <h6 class="float-right">STATUS: <strong>ORDER COMPLETED</strong></h6>
                                            @elseif ($cart->status == 'toship')
                                            <h6 class="float-right">STATUS: <strong>TO SHIP</strong></h6>
                                            @elseif ($cart->status == 'toreceive')
                                            <h6 class="float-right">STATUS: <strong>TO RECEIVE</strong></h6>
                                            @elseif ($cart->status == 'pcancel')
                                            <h6 class="float-right">STATUS: <strong>PENDING CANCEL</strong></h6>
                                            @elseif ($cart->status == 'cancel')
                                            <h6 class="float-right">STATUS: <strong>CANCELLED</strong></h6>
                                            @endif
                                    </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <a href="/orderdetail/{{ $cart->cartid }}" style="text-decoration: none; color:black">
                            <div class="card">
                                <div class="card-horizontal">
                                    <div class="card-body p-2">
                                        <div class="row">
                                            <div class="col-md-2"><img class="card-img-top" src="{{ asset('uploads/product/' . $cart->image) }}"></div>
                                            <div class="col-md-6 mt-3">
                                                <h6>{{ $cart->name }}</h6>
                                                <h6>x{{$cart->quantity}}</h6>
                                            </div>
                                            <div class="col-md-2 offset-md-2 mt-3"><strong>RM {{number_format((float)$cart->price, 2, '.', '')}}</strong></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <div class="card">
                            <div class="card-horizontal">
                                <div class="card-body">
                                    <div class="row offset-md-7">
                                        <div class="row col-md-6">
                                            @if ($cart->status == 'completed' || $cart->status == 'cancel')
                                            <a href="#" class="mr-2">
                                                <button class="btn btn-primary btn-lg">Buy Again</button>
                                            </a>
                                            @elseif ($cart->status == 'toship')
                                            <a href="/cancelorder/{{ $cart->cartid }}" class="mr-2">
                                                <button class="btn btn-danger btn-lg">Cancel Order</button>
                                            </a>
                                            @elseif ($cart->status == 'toreceive')
                                            <a href="/receiveorder/{{ $cart->cartid }}" class="mr-2">
                                                <button class="btn btn-success btn-lg">Order Received</button>
                                            </a>
                                            @elseif ($cart->status == 'pcancel')
                                            <a class="mr-2">
                                                <button class="btn btn-warning btn-lg" disabled>Pending Cancel</button>
                                            </a>
                                            @endif
                                            <!-- <a href="#" class="mr-2">
                                                <button class="btn btn-light btn-lg">Contact Seller</button>
                                            </a> -->
                                        </div>
                                        <div class="">
                                            Order Total:&nbsp;
                                        </div>
                                        <div class="col-md-4">
                                            <h5 class="text"><strong>RM {{number_format((float)$cart->subtotal, 2, '.', '')}}</strong></h5>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                    <div class="tab-pane fade" id="nav-toship" role="tabpanel" aria-labelledby="nav-toship-tab">
                        @if ($sum2 == 0)
                        <div class="text-center">
                            <img src="{{ asset('uploads/cart/noorder.png') }}">
                        </div>
                        @else
                        @foreach($toshipCart as $cart)
                        <div class="card mt-3">
                            <div class="card-horizontal">
                                <div class="card-body pt-2 pb-2 bg-secondary text-white">
                                    <div class="row">
                                        <div class="col-md-6">
                                            {{ $cart->sname }}
                                            <a href="/shop/{{ $cart->shopid }}" class="ml-3">
                                                <button class="btn btn-light btn-sm">View Shop</button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="#" style="text-decoration: none; color:black">
                            <div class="card">
                                <div class="card-horizontal">
                                    <div class="card-body p-2">
                                        <div class="row">
                                            <div class="col-md-2"><img class="card-img-top" src="{{ asset('uploads/product/' . $cart->image) }}"></div>
                                            <div class="col-md-6 mt-3">
                                                <h6>{{ $cart->name }}</h6>
                                                <h6>x{{$cart->quantity}}</h6>
                                            </div>
                                            <div class="col-md-2 offset-md-2 mt-3"><strong>RM {{number_format((float)$cart->price, 2, '.', '')}}</strong></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <div class="card">
                            <div class="card-horizontal">
                                <div class="card-body">
                                    <div class="row offset-md-7">
                                        <div class="row col-md-6">
                                            @if ($cart->status == 'completed')
                                            <a href="#" class="mr-2">
                                                <button class="btn btn-primary btn-lg">Buy Again</button>
                                            </a>
                                            @elseif ($cart->status == 'toship')
                                            <a href="#" class="mr-2">
                                                <button class="btn btn-danger btn-lg">Cancel Order</button>
                                            </a>
                                            @elseif ($cart->status == 'toreceive')
                                            <a href="#" class="mr-2">
                                                <button class="btn btn-success btn-lg">Order Received</button>
                                            </a>
                                            @endif
                                            <!-- <a href="#" class="mr-2">
                                                <button class="btn btn-light btn-lg">Contact Seller</button>
                                            </a> -->
                                        </div>
                                        <div class="">
                                            Order Total:&nbsp;
                                        </div>
                                        <div class="col-md-4">
                                            <h5 class="text"><strong>RM {{number_format((float)$cart->subtotal, 2, '.', '')}}</strong></h5>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                    <div class="tab-pane fade" id="nav-toreceive" role="tabpanel" aria-labelledby="nav-toreceive-tab">
                        @if ($sum3 == 0)
                        <div class="text-center">
                            <img src="{{ asset('uploads/cart/noorder.png') }}">
                        </div>
                        @else
                        @foreach($toreceiveCart as $cart)
                        <div class="card mt-3">
                            <div class="card-horizontal">
                                <div class="card-body pt-2 pb-2 bg-secondary text-white">
                                    <div class="row">
                                        <div class="col-md-6">
                                            {{ $cart->sname }}
                                            <a href="/shop/{{ $cart->shopid }}" class="ml-3">
                                                <button class="btn btn-light btn-sm">View Shop</button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-horizontal">
                                <div class="card-body p-2">
                                    <div class="row">
                                        <div class="col-md-2"><img class="card-img-top" src="{{ asset('uploads/product/' . $cart->image) }}"></div>
                                        <div class="col-md-6 mt-3">
                                            <h6>{{ $cart->name }}</h6>
                                            <h6>x{{$cart->quantity}}</h6>
                                        </div>
                                        <div class="col-md-2 offset-md-2 mt-3"><strong>RM {{number_format((float)$cart->price, 2, '.', '')}}</strong></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-horizontal">
                                <div class="card-body">
                                    <div class="row offset-md-7">
                                        <div class="row col-md-6">
                                            @if ($cart->status == 'completed')
                                            <a href="#" class="mr-2">
                                                <button class="btn btn-primary btn-lg">Buy Again</button>
                                            </a>
                                            @elseif ($cart->status == 'toship')
                                            <a href="#" class="mr-2">
                                                <button class="btn btn-danger btn-lg">Cancel Order</button>
                                            </a>
                                            @elseif ($cart->status == 'toreceive')
                                            <a href="#" class="mr-2">
                                                <button class="btn btn-success btn-lg">Order Received</button>
                                            </a>
                                            @endif
                                            <!-- <a href="#" class="mr-2">
                                                <button class="btn btn-light btn-lg">Contact Seller</button>
                                            </a> -->
                                        </div>
                                        <div class="">
                                            Order Total:&nbsp;
                                        </div>
                                        <div class="col-md-4">
                                            <h5 class="text"><strong>RM {{number_format((float)$cart->subtotal, 2, '.', '')}}</strong></h5>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                    <div class="tab-pane fade" id="nav-completed" role="tabpanel" aria-labelledby="nav-completed-tab">
                        @if ($sum4 == 0)
                        <div class="text-center">
                            <img src="{{ asset('uploads/cart/noorder.png') }}">
                        </div>
                        @else
                        @foreach($completedCart as $cart)
                        <div class="card mt-3">
                            <div class="card-horizontal">
                                <div class="card-body pt-2 pb-2 bg-secondary text-white">
                                    <div class="row">
                                        <div class="col-md-6">
                                            {{ $cart->sname }}
                                            <a href="/shop/{{ $cart->shopid }}" class="ml-3">
                                                <button class="btn btn-light btn-sm">View Shop</button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-horizontal">
                                <div class="card-body p-2">
                                    <div class="row">
                                        <div class="col-md-2"><img class="card-img-top" src="{{ asset('uploads/product/' . $cart->image) }}"></div>
                                        <div class="col-md-6 mt-3">
                                            <h6>{{ $cart->name }}</h6>
                                            <h6>x{{$cart->quantity}}</h6>
                                        </div>
                                        <div class="col-md-2 offset-md-2 mt-3"><strong>RM {{number_format((float)$cart->price, 2, '.', '')}}</strong></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-horizontal">
                                <div class="card-body">
                                    <div class="row offset-md-7">
                                        <div class="row col-md-6">
                                            @if ($cart->status == 'completed')
                                            <a href="#" class="mr-2">
                                                <button class="btn btn-primary btn-lg">Buy Again</button>
                                            </a>
                                            @elseif ($cart->status == 'toship')
                                            <a href="#" class="mr-2">
                                                <button class="btn btn-danger btn-lg">Cancel Order</button>
                                            </a>
                                            @elseif ($cart->status == 'toreceive')
                                            <a href="#" class="mr-2">
                                                <button class="btn btn-success btn-lg">Order Received</button>
                                            </a>
                                            @endif
                                            <!-- <a href="#" class="mr-2">
                                                <button class="btn btn-light btn-lg">Contact Seller</button>
                                            </a> -->
                                        </div>
                                        <div class="">
                                            Order Total:&nbsp;
                                        </div>
                                        <div class="col-md-4">
                                            <h5 class="text"><strong>RM {{number_format((float)$cart->subtotal, 2, '.', '')}}</strong></h5>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                    <div class="tab-pane fade" id="nav-cancelled" role="tabpanel" aria-labelledby="nav-cancelled-tab">
                        @if ($sum5 == 0)
                        <div class="text-center">
                            <img src="{{ asset('uploads/cart/noorder.png') }}">
                        </div>
                        @else
                        @foreach($cancelledCart as $cart)
                        <div class="card mt-3">
                            <div class="card-horizontal">
                                <div class="card-body pt-2 pb-2 bg-secondary text-white">
                                    <div class="row">
                                        <div class="col-md-6">
                                            {{ $cart->sname }}
                                            <a href="/shop/{{ $cart->shopid }}" class="ml-3">
                                                <button class="btn btn-light btn-sm">View Shop</button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-horizontal">
                                <div class="card-body p-2">
                                    <div class="row">
                                        <div class="col-md-2"><img class="card-img-top" src="{{ asset('uploads/product/' . $cart->image) }}"></div>
                                        <div class="col-md-6 mt-3">
                                            <h6>{{ $cart->name }}</h6>
                                            <h6>x{{$cart->quantity}}</h6>
                                        </div>
                                        <div class="col-md-2 offset-md-2 mt-3"><strong>RM {{number_format((float)$cart->price, 2, '.', '')}}</strong></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-horizontal">
                                <div class="card-body">
                                    <div class="row offset-md-7">
                                        <div class="row col-md-6">
                                            @if ($cart->status == 'completed')
                                            <a href="#" class="mr-2">
                                                <button class="btn btn-primary btn-lg">Buy Again</button>
                                            </a>
                                            @elseif ($cart->status == 'toship')
                                            <a href="#" class="mr-2">
                                                <button class="btn btn-danger btn-lg">Cancel Order</button>
                                            </a>
                                            @elseif ($cart->status == 'toreceive')
                                            <a href="#" class="mr-2">
                                                <button class="btn btn-success btn-lg">Order Received</button>
                                            </a>
                                            @endif
                                            <!-- <a href="#" class="mr-2">
                                                <button class="btn btn-light btn-lg">Contact Seller</button>
                                            </a> -->
                                        </div>
                                        <div class="">
                                            Order Total:&nbsp;
                                        </div>
                                        <div class="col-md-4">
                                            <h5 class="text"><strong>RM {{number_format((float)$cart->subtotal, 2, '.', '')}}</strong></h5>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>


</body>

@endsection