@extends('layouts.app')

@section('content')
<script>
    function readVideo(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('.myvideo').css('display', 'block');
                $('.myvideo').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    function PreviewAudio(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('.myaudio').css('display', 'block');
                $('.myaudio').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Reviews & Comments') }}</div>

                    <div class="card-body">
                        <form method="POST" action="/postcommentproduct/{{ $products->id }}" enctype="multipart/form-data">
                            @csrf
                            {{ method_field('PUT') }}
                            <input type="hidden" name="id" id="id" value="{{ $products->id }}">
                            <div class="form-group row">
                                <label for="comment" class="col-md-4 col-form-label text-md-right">{{ __('Comment') }}</label>

                                <div class="col-md-6">
                                    <textarea id="comment" type="text" class="form-control" name="comment" value="{{ $products->comment }}" required autofocus></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="video" class="col-md-4 col-form-label text-md-right">{{ __('Video') }}</label>

                                <div class="col-md-6">
                                    <input id="video" type="file" class="form-control" name="video" value="{{ $products->video }}" onchange="readVideo(this)">
                                    <video width="100%" controls class="myvideo" style="display:none;">
                                        <source src="{{ asset('uploads/product/' . $products->video) }}" id="video_here">
                                    </video>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="audio" class="col-md-4 col-form-label text-md-right">{{ __('Audio') }}</label>

                                <div class="col-md-6">
                                    <input id="audio" type="file" class="form-control" name="audio" value="{{ $products->audio }}" onchange="PreviewAudio(this, $('#audioPreview'))">
                                    <audio controls class="myaudio" style="display:none;">
                                        <source src="{{ asset('uploads/product/' . $products->audio) }}" type="audio/mp4" id="audio_here"/>
                                    </audio>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-success">
                                        {{ __('Post') }}
                                    </button>
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