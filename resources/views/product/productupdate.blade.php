@extends('layouts.app')

@section('content')
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#img').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#image").change(function() {
        readURL(this);
    });

    function PreviewPDF(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('.doc').css('display', 'block');
                $('.doc').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">{{ __('Basic Information') }}</div>

                    <div class="card-body">
                        <form method="POST" action="/updateproduct/{{ $products->id }}" enctype="multipart/form-data">
                            @csrf
                            {{ method_field('PUT') }}
                            <input type="hidden" name="id" id="id" value="{{ $products->id }}">
                            <div class="form-group row">
                                <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Product Name') }}</label>

                                <div class="col-md-8">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ $products->name }}" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="price" class="col-md-2 col-form-label text-md-right">{{ __('Price (RM)') }}</label>

                                <div class="col-md-8">
                                    <input id="price" type="text" class="form-control" name="price" value="{{ $products->price }}" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="stock" class="col-md-2 col-form-label text-md-right">{{ __('Stock') }}</label>

                                <div class="col-md-8">
                                    <input id="stock" type="number" class="form-control" name="stock" value="{{ $products->stock }}" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-md-2 col-form-label text-md-right">{{ __('Description') }}</label>

                                <div class="col-md-8">
                                    <textarea rows="7" id="description" type="text" class="form-control" name="description">{{ $products->description }}</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="price" class="col-md-2 col-form-label text-md-right">{{ __('Image') }}</label>

                                <div class="col-md-8">
                                    <input id="image" type="file" class="form-control" name="image" value="{{ $products->image }}" onchange="readURL(this)">
                                    <img src="{{ asset('uploads/product/' . $products->image) }}" id="img" width="200px" height="auto" style="padding: 10px;" />
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-2">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Save') }}
                                    </button>
                                    <a href="{{ url('/listproduct') }}" class="btn btn-danger">
                                        {{ __('Cancel') }}
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

@endsection