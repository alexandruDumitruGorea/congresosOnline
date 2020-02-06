@extends('basic')

@section('content')

    @if(\Request::get('alertMessage') !== null)
        @include('include.menssages')
    @endif
    <div class="buttons">
        <a href="{{ url('presentation/create') }}" class="button button_info button_small button_margin">Añadir Ponencia</a>
        <a href="{{ url('admin') }}" class="button button_info button_small button_margin">Volver</a>
    </div>

    @foreach ($presentations as $presentation)
        <div class="congress-content congress-content_center">
            <div class="card-item">
                <div class="card-img-container">
                    <img class="card-img" src="{{ url('assets/img/congreso-web.jpg') }}" alt="IMG CONGRESO">
                </div>
                <div class="card-content">
                    <div class="card-title-container">
                        <p class="card-title">{{ $presentation->title }}</p>
                    </div>
                    <div class="card-excerpt-container">
                        <p class="card-excerpt">{{ $presentation->extract }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    
    {{ $presentations->appends(['sort' => 'votes'])->onEachSide(2)->links() }}

@endsection