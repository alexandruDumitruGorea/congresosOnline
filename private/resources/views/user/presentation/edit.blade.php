@extends('basic')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Presentation Edit</div>
                <div class="card-body">
                    <form method="POST" action="{{ url('presentation/' . $presentation->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="video_url" class="col-md-4 col-form-label text-md-right">Video URL</label>

                            <div class="col-md-6">
                                <input id="video_url" type="text" class="form-control @error('video_url') is-invalid @enderror" name="video_url" value="{{ old('video_url', $presentation->video_url) }}" required autocomplete="video_url" autofocus>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Edit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <a href="{{ url('/') }}" class="button button_info button_small button_margin">Cancelar</a>
        </div>
    </div>
</div>
@endsection