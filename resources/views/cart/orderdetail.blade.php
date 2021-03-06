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

    .mycontent-right {
        border-left: 1px solid #d3d3d3;

    }

    div.stars {
        width: 270px;
        display: inline-block;
    }

    input.star {
        display: none;
    }

    label.star {
        float: right;
        padding: 10px;
        font-size: 30px;
        color: #444;
        transition: all .2s;
    }

    input.star:checked~label.star:before {
        content: '\f005';
        color: #FD4;
        transition: all .25s;
        font-family: Font Awesome\ 5 Free;
        font-weight: 900;    
    }

    input.star-5:checked~label.star:before {
        color: #FE7;
        text-shadow: 0 0 20px #952;
    }

    input.star-1:checked~label.star:before {
        color: #F62;
    }

    label.star:hover {
        transform: rotate(-15deg) scale(1.3);
    }

    label.star:before {
        content: '\f005';
        font-family: Font Awesome\ 5 Free;
        font-weight: 200;
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
                        <div class="card-body">
                            <div class="card-text">
                                <a href="/order" style="text-decoration: none;"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                                @if ($cart->status == 'completed')
                                <h6 class="float-right">STATUS: <strong>ORDER COMPLETED</strong></h6>
                                @elseif ($cart->status == 'toship')
                                <h6 class="float-right">STATUS: <strong>TO SHIP</strong></h6>
                                @elseif ($cart->status == 'toreceive')
                                <h6 class="float-right">STATUS: <strong>TO RECEIVE</strong></h6>
                                @elseif ($cart->status == 'torate')
                                <h6 class="float-right">STATUS: <strong>TO RATE</strong></h6>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-horizontal">
                        <div class="card-body">
                            <div class="track">
                                @if ($cart->status == 'completed')
                                <div class="step active"> <span class="icon"> <i class="fas fa-receipt"></i> </span> <span class="text">Order Placed</span> </div>
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
                                @elseif ($cart->status == 'torate')
                                <div class="step active"> <span class="icon"> <i class="fa fa-receipt"></i> </span> <span class="text">Order Placed</span> </div>
                                <div class="step active"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> Order Shipped Out</span> </div>
                                <div class="step active"> <span class="icon"> <i class="fa fa-box-open"></i> </span> <span class="text"> Order Received </span> </div>
                                <div class="step"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Order Completed</span> </div>
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
                                <a href="/detailproduct/{{ $cart->productid }}" class="btn btn-primary btn-lg">Buy Again</a>
                                @elseif ($cart->status == 'toreceive')
                                <a href="/receiveorder/{{ $cart->cartid }}" class="btn btn-success btn-lg confirm">Order Received</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-horizontal">
                        <div class="card-body">
                            <div class="row">
                                <div class="card-text col-md-4">
                                    <h5><strong>Delivery Address</strong></h5>
                                </div>

                                <div class="card-text col-md-8">
                                    <h6>Tracking Number: @if ($cart->tracknum == null) <strong>Pending seller to update</strong> @else <strong>{{ $cart->tracknum }}</strong></h6> @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="card-text mt-4 col-md-4 mycontent-left">
                                    <h6><strong>{{ $cart->aname }}</strong></h6>
                                    <h6>{{ $cart->aphone }}</h6>
                                    <h6>{{ $cart->street }}, {{ $cart->city }}, </h6>
                                    <h6>{{ $cart->zip }} {{ $cart->state }} </h6>
                                </div>

                                @if ($cart->tracknum != null)
                                <div id="embedTrack" class="card-text mt-4 col-md-8 mycontent-right">
                                </div>
                                @endif

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

    <div class="modal fade" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="reviewModal" aria-hidden="true" data-backdrop="static" data-keyboard="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body p-5 text-center">
                    <div class="justify-content-center">
                            <h3><strong>Reviews & Comments</strong></h3>
                        <div class="stars">
                            <form method="POST" action="/addreview/{{ $cart->cartid }}" enctype="multipart/form-data">
                            @csrf
                                <input class="star star-5" id="star-5" value="5" type="radio" name="star" onclick="enableButton()"/>
                                <label class="star star-5" for="star-5"></label>

                                <input class="star star-4" id="star-4" value="4" type="radio" name="star" onclick="enableButton()"/>
                                <label class="star star-4" for="star-4"></label>

                                <input class="star star-3" id="star-3" value="3" type="radio" name="star" onclick="enableButton()"/>
                                <label class="star star-3" for="star-3"></label>

                                <input class="star star-2" id="star-2" value="2" type="radio" name="star" onclick="enableButton()"/>
                                <label class="star star-2" for="star-2"></label>

                                <input class="star star-1" id="star-1" value="1" type="radio" name="star" required onclick="enableButton()"/>
                                <label class="star star-1" for="star-1"></label>
                            
                        </div>
                        <div class="form-group row">
                            <textarea rows="7" id="comment" type="text" class="form-control" name="comment" placeholder="Please give a reviews and comments. Thank you!"></textarea>
                        </div>
                        <div class="form-group row mb-0 float-right">
                            <button type="submit" id="submitRating" class="btn btn-primary" disabled>
                                {{ __('Submit') }}
                            </button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    TrackButton.embed({
        selector: "#embedTrack",
        tracking_no: "{{$cart->tracknum}}"
    });

    $('.confirm').on('click', function(event) {
        event.preventDefault();
        const url = $(this).attr('href');
        Swal.fire({
            title: 'Are you sure?',
            text: 'This order will be marked as completed!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#5cb85c',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, order received!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    });

    if ("{{$cart->status}}" == 'torate') {
        $(window).on('load', function() {
            $('#reviewModal').modal('show');
        });
    }

    function enableButton() {
        document.getElementById("submitRating").disabled = false;
    }
</script>
@endsection