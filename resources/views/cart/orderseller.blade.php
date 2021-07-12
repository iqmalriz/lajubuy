@extends('layouts.appseller')

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
                                    <a class="nav-item nav-link" id="nav-shipping-tab" data-toggle="tab" href="#nav-shipping" role="tab" aria-controls="nav-shipping" aria-selected="false">Shipping</a>
                                    <a class="nav-item nav-link" id="nav-completed-tab" data-toggle="tab" href="#nav-completed" role="tab" aria-controls="nav-completed" aria-selected="false">Completed</a>
                                    <a class="nav-item nav-link" id="nav-cancel-tab" data-toggle="tab" href="#nav-cancel" role="tab" aria-controls="nav-cancel" aria-selected="false">Cancellation</a>

                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-all" role="tabpanel" aria-labelledby="nav-all-tab">
                        <div class="card mt-3">
                            <div class="card-horizontal">
                                <div class="card-body">
                                    <table class="table table-stripped table-bordered " id="all">
                                        <thead class="thread-dark">
                                            <tr>
                                                <th scope="col">Product(s)</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col">Total Price</th>
                                                <th scope="col">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($carts as $cart)
                                            <tr>
                                                <td> {{ $cart->name }}</td>
                                                <td>RM {{number_format((float)$cart->price, 2, '.', '')}}</td>
                                                <td>x{{ $cart->quantity }}</td>
                                                <td>RM {{number_format((float)$cart->subtotal, 2, '.', '')}}</td>
                                                <td>
                                                    @if ($cart->status == 'toship')
                                                    <a href="/detailorder/{{ $cart->cartid }}" class="btn btn-warning">To Ship</a>
                                                    @elseif ($cart->status == 'completed')
                                                    <a href="#" class="btn btn-success">Completed</a>
                                                    @elseif ($cart->status == 'toreceive')
                                                    <a href="#" class="btn btn-info">In Shipping</a>
                                                    @elseif ($cart->status == 'pcancel')
                                                    <a href="/approvecancel/{{ $cart->cartid }}" class="btn btn-warning">To Cancel</a>
                                                    @elseif ($cart->status == 'cancel')
                                                    <a href="#" class="btn btn-danger">Cancelled</a>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-toship" role="tabpanel" aria-labelledby="nav-toship-tab">
                        <div class="card mt-3">
                            <div class="card-horizontal">
                                <div class="card-body">
                                    <table class="table table-stripped table-bordered " id="toship">
                                        <thead class="thread-dark">
                                            <tr>
                                                <th scope="col">Product(s)</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col">Total Price</th>
                                                <th scope="col">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($toshipCart as $cart)
                                            <tr>
                                                <td> {{ $cart->name }}</td>
                                                <td>RM {{number_format((float)$cart->price, 2, '.', '')}}</td>
                                                <td>x{{ $cart->quantity }}</td>
                                                <td>RM {{number_format((float)$cart->subtotal, 2, '.', '')}}</td>
                                                <td>
                                                    @if ($cart->status == 'toship')
                                                    <a href="#" class="btn btn-warning">To Ship</a>
                                                    @elseif ($cart->status == 'completed')
                                                    <a href="#" class="btn btn-success">Completed</a>
                                                    @elseif ($cart->status == 'toreceive')
                                                    <a href="#" class="btn btn-info">In Shipping</a>
                                                    @elseif ($cart->status == 'pcancell')
                                                    <a href="#" class="btn btn-danger">To Cancek</a>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-shipping" role="tabpanel" aria-labelledby="nav-shipping-tab">
                        <div class="card mt-3">
                            <div class="card-horizontal">
                                <div class="card-body">
                                    <table class="table table-stripped table-bordered " id="shipping">
                                        <thead class="thread-dark">
                                            <tr>
                                                <th scope="col">Product(s)</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col">Total Price</th>
                                                <th scope="col">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($shippingCart as $cart)
                                            <tr>
                                                <td> {{ $cart->name }}</td>
                                                <td>RM {{number_format((float)$cart->price, 2, '.', '')}}</td>
                                                <td>x{{ $cart->quantity }}</td>
                                                <td>RM {{number_format((float)$cart->subtotal, 2, '.', '')}}</td>
                                                <td>
                                                    @if ($cart->status == 'toship')
                                                    <a href="#" class="btn btn-warning">To Ship</a>
                                                    @elseif ($cart->status == 'completed')
                                                    <a href="#" class="btn btn-success">Completed</a>
                                                    @elseif ($cart->status == 'toreceive')
                                                    <a href="#" class="btn btn-info">In Shipping</a>
                                                    @elseif ($cart->status == 'pcancell')
                                                    <a href="#" class="btn btn-danger">To Cancek</a>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-completed" role="tabpanel" aria-labelledby="nav-completed-tab">
                        <div class="card mt-3">
                            <div class="card-horizontal">
                                <div class="card-body">
                                    <table class="table table-stripped table-bordered " id="completed">
                                        <thead class="thread-dark">
                                            <tr>
                                                <th scope="col">Product(s)</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col">Total Price</th>
                                                <th scope="col">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($completedCart as $cart)
                                            <tr>
                                                <td> {{ $cart->name }}</td>
                                                <td>RM {{number_format((float)$cart->price, 2, '.', '')}}</td>
                                                <td>x{{ $cart->quantity }}</td>
                                                <td>RM {{number_format((float)$cart->subtotal, 2, '.', '')}}</td>
                                                <td>
                                                    @if ($cart->status == 'toship')
                                                    <a href="#" class="btn btn-warning">To Ship</a>
                                                    @elseif ($cart->status == 'completed')
                                                    <a href="#" class="btn btn-success">Completed</a>
                                                    @elseif ($cart->status == 'toreceive')
                                                    <a href="#" class="btn btn-info">In Shipping</a>
                                                    @elseif ($cart->status == 'pcancel')
                                                    <a href="#" class="btn btn-danger">To Cancel</a>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-cancel" role="tabpanel" aria-labelledby="nav-cancel-tab">
                        <div class="card mt-3">
                            <div class="card-horizontal">
                                <div class="card-body">
                                    <table class="table table-stripped table-bordered " id="cancel">
                                        <thead class="thread-dark">
                                            <tr>
                                                <th scope="col">Product(s)</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col">Total Price</th>
                                                <th scope="col">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($cancelCart as $cart)
                                            <tr>
                                                <td> {{ $cart->name }}</td>
                                                <td>RM {{number_format((float)$cart->price, 2, '.', '')}}</td>
                                                <td>x{{ $cart->quantity }}</td>
                                                <td>RM {{number_format((float)$cart->subtotal, 2, '.', '')}}</td>
                                                <td>
                                                    @if ($cart->status == 'toship')
                                                    <a href="#" class="btn btn-warning">To Ship</a>
                                                    @elseif ($cart->status == 'completed')
                                                    <a href="#" class="btn btn-success">Completed</a>
                                                    @elseif ($cart->status == 'toreceive')
                                                    <a href="#" class="btn btn-info">In Shipping</a>
                                                    @elseif ($cart->status == 'pcancel')
                                                    <a href="#" class="btn btn-danger">To Cancel</a>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#all').DataTable();
        });

        $(document).ready(function() {
            $('#toship').DataTable();
        });

        $(document).ready(function() {
            $('#shipping').DataTable();
        });

        $(document).ready(function() {
            $('#completed').DataTable();
        });

        $(document).ready(function() {
            $('#cancel').DataTable();
        });
    </script>
</body>
@endsection