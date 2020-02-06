@extends('basic')

@section('content')
    @if(\Request::get('alertMessage') !== null)
        @include('include.menssages')
    @endif
    @foreach($presentation as $p)
        <?php
            $request->session()->put('id_presentation', $p->id);
        ?>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Asistir a ponencia</div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">Title</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" value="{{ $p->title }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">Price</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" value="{{ $p->price }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">Hour</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" value="{{ $p->hour }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ url('paycorrect') }}">
                                @csrf
                                
                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            Asistir a la ponencia
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <a href="{{ url('presentation/' . $p->id) }}" class="button button_info button_small button_margin">Cancelar</a>
        @endforeach
    </div>
@endsection