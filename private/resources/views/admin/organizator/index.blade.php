@extends('basic')

@section('content')

    @if(\Request::get('alertMessage') !== null)
        @include('include.menssages')
    @endif

    <div class="buttons">
        <a href="{{ url('organizator/create') }}" class="button button_info button_small button_margin">Añadir Organizador</a>
        <a href="{{ url('admin') }}" class="button button_info button_small button_margin">Volver</a>
    </div>

    @foreach ($organizators as $organizator)
        <div class="organizators">
            <div class="card-item card-item_large">
                <div class="card-img-container">
                    <img class="card-img" src="{{ url('assets/img/team4.jpg') }}" alt="IMG PONENTE">
                </div>
                <div class="card-content">
                    <div class="card-title-container">
                        <p class="card-title">{{ $organizator->name }}</p>
                        <a href="#" class="button button_info">Editar</a>
                        <a href="#" class="button button_pay">Borrar</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    
    {{ $organizators->appends(['sort' => 'votes'])->onEachSide(2)->links() }}
    

@endsection