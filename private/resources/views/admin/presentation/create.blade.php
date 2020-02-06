@extends('basic')

@section('content')
    @if(\Request::get('alertMessage') !== null)
        @include('include.menssages')
    @endif
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Crear ponencia</div>
    
                    <div class="card-body">
                        <form method="POST" action="{{ url('presentation') }}">
                            @csrf
    
                            <div class="form-group row">
                                <label for="title" class="col-md-4 col-form-label text-md-right">Title</label>
    
                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" minlength="10" maxlength="100" required autofocus>
    
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>
    
                                <div class="col-md-6">
                                    <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description') }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="extract" class="col-md-4 col-form-label text-md-right">Extracto</label>
    
                                <div class="col-md-6">
                                    <textarea class="form-control" id="extract" name="extract" rows="3" minlength="10" maxlength="200" required>{{ old('extract') }}</textarea>
                                    @error('extract')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="price" class="col-md-4 col-form-label text-md-right">Precio</label>
    
                                <div class="col-md-6">
                                    <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" min="0.00" max="9999.99" step="0.01" required>
    
                                    @error('price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="hour" class="col-md-4 col-form-label text-md-right">Hora</label>
    
                                <div class="col-md-6">
                                    <input id="hour" type="time" class="form-control @error('hour') is-invalid @enderror" name="hour" value="{{ old('hour') }}" required>
    
                                    @error('hour')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="video_url" class="col-md-4 col-form-label text-md-right">URL Video</label>
    
                                <div class="col-md-6">
                                    <input id="video_url" type="text" class="form-control" name="video_url" value="{{ old('video_url') }}">
    
                                    @error('video_url')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="id_speaker" class="col-md-4 col-form-label text-md-right">Ponente</label>
                                <div class="col-md-6">
                                    <select class="form-control @error('id_speaker') is-invalid @enderror" id="id_speaker" name="id_speaker" required>
                                        <option value="0"></option>
                                        @foreach ($speakers as $speaker)
                                            <option value="{{ $speaker->id }}" @if (old('id_speaker') == $speaker->id) selected @endif >{{ $speaker->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="ponente-ponencia">
                                        <a href="{{ url('speaker/create') }}" class="button button_info button_small button_margin" target="_blank">Añadir Ponente</a>
                                        <a href="" class="actualizar-img-container" id="actualizar-ponentes"><img src="{{ url('assets/img/actualizar.svg') }}" class="actualizar-img"></img></a>
                                    </div>
                                    @error('id_speaker')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            
    
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Crear ponencia
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <a href="{{ url('presentation') }}" class="button button_info button_small button_margin">Cancelar</a>
    </div>
@endsection