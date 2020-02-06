@extends('basic')

@section('content')

    @if(\Request::get('alertMessage') !== null)
        @include('include.menssages')
    @endif

    <div class="buttons">
        <a href="{{ url('congress/create') }}" class="button button_info button_small button_margin">Añadir Congreso</a>
        <a href="{{ url('admin') }}" class="button button_info button_small button_margin">Volver</a>
    </div>

    @foreach ($congress as $con)
        <div class="congress-content congress-content_center">
            <div class="card-item">
                <div class="card-img-container">
                    <img class="card-img" src="{{ url('assets/img/congreso-web.jpg') }}" alt="IMG CONGRESO">
                </div>
                <div class="card-content">
                    <div class="card-title-container">
                        <p class="card-title">{{ $con->title }}</p>
                    </div>
                    <div class="card-excerpt-container">
                        <p class="card-excerpt">{{ $con->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    
    {{ $congress->appends(['sort' => 'votes'])->onEachSide(2)->links() }}
    

@endsection