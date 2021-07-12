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

    .track {
        position: relative;
        background-color: #ddd;
        height: 7px;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        margin-bottom: 60px;
        margin-top: 50px
    }

    .track .step {
        -webkit-box-flex: 1;
        -ms-flex-positive: 1;
        flex-grow: 1;
        width: 25%;
        margin-top: -18px;
        text-align: center;
        position: relative
    }

    .track .step.active:before {
        background: #0275d8
    }

    .track .step::before {
        height: 7px;
        position: absolute;
        content: "";
        width: 100%;
        left: 0;
        top: 18px
    }

    .track .step.active .icon {
        background: #0275d8;
        color: #fff
    }

    .track .icon {
        display: inline-block;
        width: 40px;
        height: 40px;
        line-height: 40px;
        position: relative;
        border-radius: 100%;
        background: #ddd
    }

    .track .step.active .text {
        font-weight: 400;
        color: #000
    }

    .track .text {
        display: block;
        margin-top: 7px
    }
</style>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-horizontal">
                        <div class="card-body">
                            <div class="card-text">
                                
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-horizontal">
                        <div class="card-body">
                            <div class="track">
                                @if ($cart->status == 'completed')
                                <div class="step active"> <span class="icon"> <i class="fa fa-receipt"></i> </span> <span class="text">Order Placed</span> </div>
                                <div class="step active"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> Order Shipped Out</span> </div>
                                <div class="step active"> <span class="icon"> <i class="fa fa-box-open"></i> </span> <span class="text"> Order Received </span> </div>
                                <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Order Completed</span> </div>
                                @elseif ($cart->status == 'toship')
                                <div class="step active"> <span class="icon"> <i class="fa fa-receipt"></i> </span> <span class="text">Order Placed</span> </div>
                                <div class="step "> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> Order Shipped Out</span> </div>
                                <div class="step"> <span class="icon"> <i class="fa fa-box-open"></i> </span> <span class="text"> Order Received </span> </div>
                                <div class="step"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Order Completed</span> </div>
                                @elseif ($cart->status == 'toreceive')
                                <div class="step active"> <span class="icon"> <i class="fa fa-receipt"></i> </span> <span class="text">Order Placed</span> </div>
                                <div class="step active"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> Order Shipped Out</span> </div>
                                <div class="step"> <span class="icon"> <i class="fa fa-box-open"></i> </span> <span class="text"> Order Received </span> </div>
                                <div class="step"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Order Completed</span> </div>
                                @elseif ($cart->status == 'pcancel')
                                <div class="step active"> <span class="icon"> <i class="fa fa-receipt"></i> </span> <span class="text">Order Placed</span> </div>
                                <div class="step"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> Order Shipped Out</span> </div>
                                <div class="step"> <span class="icon"> <i class="fa fa-box-open"></i> </span> <span class="text"> Order Received </span> </div>
                                <div class="step"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Order Completed</span> </div>
                                @elseif ($cart->status == 'cancel')
                                <div class="step active"> <span class="icon"> <i class="fa fa-receipt"></i> </span> <span class="text">Order Placed</span> </div>
                                <div class="step active"> <span class="icon"> <i class="fa fa-receipt"></i> </span> <span class="text"> Order Cancelled</span> </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-horizontal">
                        <div class="card-body">
                            <div class="card-text float-right">
                                @if ($cart->status == 'completed')
                                <button class="btn btn-primary btn-lg">Buy Again</button>
                                @elseif ($cart->status == 'toship')
                                <button class="btn btn-danger btn-lg">Cancel Order</button>
                                @elseif ($cart->status == 'toreceive')
                                <button class="btn btn-success btn-lg">Order Received</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-horizontal">
                        <div class="card-body">
                            <div class="card-text">
                                <h5><strong>Delivery Address</strong></h5>
                            </div>
                            <div class="card-text mt-4">
                                <h6><strong>{{ $cart->aname }}</strong></h6>
                                <h6>{{ $cart->aphone }}</h6>
                                <h6>{{ $cart->street }}, {{ $cart->city }}, </h6>
                                <h6>{{ $cart->zip }} {{ $cart->state }} </h6>
                            </div>
                        </div>
                    </div>
                </div>

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
                                    <h6>x{{ $cart->quantity }}</h6>
                                </div>
                                <div class="col-md-2 offset-md-2 mt-3"><strong>RM {{number_format((float)$cart->price, 2, '.', '')}}</strong></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-horizontal">
                        <div class="card-body">
                            <div class="card-text float-right">
                           <h4> Order Total: <strong>RM {{number_format((float)$cart->subtotal, 2, '.', '')}}</strong> </h4>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>
@endsection