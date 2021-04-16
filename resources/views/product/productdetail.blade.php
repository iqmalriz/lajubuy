@extends('layouts.app')

@section('content')

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <img class="card-img-top" src="{{ $product->imagebinary }}" width="100%" height="auto" alt="">
                    <div class="card-body">
                        <h5 class="card-title">{{$product->name}}</h5>
                        <p class="card-text">RM {{$product->price}}</p>
                        <p class="card-text"><small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum dicta voluptas quia dolor fuga odit.</small></p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Review & Comments</h5><i class="fa fa-star" aria-hidden="true"></i>

                        @if ($product->comment != null)
                        <a href="/deletecommentproduct/{{ $product->id }}" class="btn btn-danger float-right">Delete</a>
                        <a href="/commentproduct/{{ $product->id }}" class="btn btn-success float-right">Edit</a>
                        <p class="card-text">by Iqmal Rizal</p>
                        <p class="card-text">Description: {{ $product->comment }}</p>
                        @else
                        <a href="/commentproduct/{{ $product->id }}" class="btn btn-primary float-right">Add Comment</a>
                        @endif

                        @if ($product->video != null)
                        <video width="30%" controls class="myvideo">
                            <source src="{{ asset('uploads/product/' . $product->video) }}" id="video_here">
                        </video>
                        @endif
                        @if ($product->audio != null)
                        <audio controls class="myaudio">
                            <source src="{{ asset('uploads/product/' . $product->audio) }}" type="audio/mp4" id="audio_here" />
                        </audio>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

@endsection