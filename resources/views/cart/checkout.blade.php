@extends('layouts.app')

@section('content')
<style>
    .card-img-top {
        width: 4vw;
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
                            <div class="card-text">
                                <i class="fa fa-map-marker"></i> Delivery Address
                            </div>
                            <div class="card-text mt-2">
                                <strong>{{ $default->aname }}</strong> &emsp; <strong>{{ $default->aphone }}</strong> &emsp; {{ $default->street }}, {{ $default->city }}, {{ $default->zip }} {{ $default->state }}
                                <button class="btn btn-primary btn-sm ml-3">Change</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-horizontal">
                        <div class="card-body pt-2 pb-2">
                            <div class="card-text">
                                <div class="row">
                                    <div class="col-md-6">Product Ordered</div>
                                    <div class="col-md-2">Unit Price</div>
                                    <div class="col-md-2">Amount</div>
                                    <div class="col-md-2">Item Subtotal</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @foreach($carts as $cart)
                <div class="card">
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
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-2"><img class="card-img-top" src="{{ asset('uploads/product/' . $cart->image) }}"></div>
                                <div class="col-md-4">{{ $cart->name }}</div>
                                <div class="col-md-2">RM {{number_format((float)$cart->price, 2, '.', '')}}</div>
                                <div class="col-md-2">{{ $cart->quantity }}</div>
                                <div class="col-md-2">RM {{number_format((float)$cart->subtotal, 2, '.', '')}}</div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

                <div class="card mt-3">
                    <div class="card-horizontal">
                        <div class="card-body">
                            <div class="card-text">
                                <i class="fa fa-credit-card"></i> Payment Method: <strong>Online Banking</strong>
                            </div>
                            <div class="card-text ml-3 mt-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Maybank2u
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" >
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        CIMB Clicks
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" >
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Public Bank
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" >
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        RHB Now
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" >
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Hong Leong Connect
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" >
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Ambank
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" >
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        MyBSN
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" >
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Bank Rakyat
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" >
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        HSBC Online
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" >
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Affin Bank
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Bank Islam
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" >
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        OCBC Online
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

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
                                <div class="col-md-2 d-grid gap-2 col-2 mx-auto">
                                    <a href="/placeorder/{{ $order->id }}">
                                        <button class="btn btn-primary btn-lg ">Place Order</button>
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


</body>

@endsection