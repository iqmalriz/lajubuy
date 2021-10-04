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
                    <div class="card-horizontal" id="defaultAddress">
                        <div class="card-body">
                            <div class="card-text">
                                <i class="fa fa-map-marker"></i> Delivery Address
                            </div>
                            <div class="card-text mt-2">
                                <strong>{{ $default->aname }}</strong> &emsp; <strong>{{ $default->aphone }}</strong> &emsp; {{ $default->street }}, {{ $default->city }}, {{ $default->zip }} {{ $default->state }}
                                <span class="badge badge-pill badge-success">Default</span>
                                <button class="btn btn-primary btn-sm ml-3" onclick="changeAddress()">Change</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-horizontal" id="allAddress" style="display: none;">
                        <div class="card-body">
                            <div class="card-text">
                                <div class="row">
                                    <div class="col-md-3">
                                        <i class="fa fa-map-marker"></i> Delivery Address
                                    </div>                   
                                    <div class="offset-md-7">
                                    <a class="" href="/address">
                                    <button type="button" class="btn btn-primary btn-sm p-2" data-toggle="modal" data-target="#addaddressmodal">
                                            Manage Address
                                        </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-text mt-4">
                                <form id="checkoutForm" action="/placeorder/{{ $order->id }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                {{ method_field('PUT') }}
                                    @foreach($addresses as $address)
                                    <div class="form-check mt-2">
                                        <input class="form-check-input" type="radio" name="address" value="{{ $address->id }}" id="{{ $address->id }}" {{ ($address->default=='1')? "checked" : '' }} >
                                        <label class="form-check-label" for="{{ $address->id }}">
                                            <strong>{{ $address->aname }}</strong> &emsp; <strong>{{ $address->aphone }}</strong> &emsp; {{ $address->street }}, {{ $address->city }}, {{ $address->zip }} {{ $address->state }}
                                        </label>
                                        @if ($address->default == 1)
                                        <span class="badge badge-pill badge-success">Default</span>
                                        @endif
                                    </div>
                                    @endforeach
                                </form>
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
                                    <input class="form-check-input" type="radio" name="bank" id="Maybank2u">
                                    <label class="form-check-label" for="Maybank2u">
                                        Maybank2u
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="bank" id="CIMB">
                                    <label class="form-check-label" for="CIMB">
                                        CIMB Clicks
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="bank" id="Public">
                                    <label class="form-check-label" for="Public">
                                        Public Bank
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="bank" id="RHB">
                                    <label class="form-check-label" for="RHB">
                                        RHB Now
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="bank" id="Leong">
                                    <label class="form-check-label" for="Leong">
                                        Hong Leong Connect
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="bank" id="Ambank">
                                    <label class="form-check-label" for="Ambank">
                                        Ambank
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="bank" id="MyBSN">
                                    <label class="form-check-label" for="MyBSN">
                                        MyBSN
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="bank" id="Rakyat">
                                    <label class="form-check-label" for="Rakyat">
                                        Bank Rakyat
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="bank" id="HSBC">
                                    <label class="form-check-label" for="HSBC">
                                        HSBC Online
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="bank" id="Affin">
                                    <label class="form-check-label" for="Affin">
                                        Affin Bank
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="bank" id="Islam" checked>
                                    <label class="form-check-label" for="Islam">
                                        Bank Islam
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="bank" id="OCBC">
                                    <label class="form-check-label" for="OCBC">
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
                                        <button class="btn btn-primary btn-lg" type="submit" form="checkoutForm">Place Order</button>
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

<script>
function changeAddress() {
    var all = document.getElementById("allAddress");
    var def = document.getElementById("defaultAddress");
    if (all.style.display === "none") {
        all.style.display = "block";
        def.style.display = "none";
    } else {
        def.style.display = "block";
        all.style.display = "none";
    }
}
</script>
@endsection