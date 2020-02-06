@extends('basic')

@section('content')
    @if(\Request::get('alertMessage') !== null)
        @include('include.menssages')
    @endif
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Subir Justificante</div>
                <div class="card-body">
                    <form method="POST" action="{{ url('assistant-presentation/' . $assistantPresentation->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-input-container">
                            <label for="document">Documento</label>
                            <input type="file" name="document" id="document" class="document">
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Subir
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
