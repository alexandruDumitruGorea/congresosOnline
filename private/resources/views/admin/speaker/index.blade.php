@extends('basic')

@section('content')

    @if(\Request::get('alertMessage') !== null)
        @include('include.menssages')
    @endif

    <div class="buttons">
        <a href="{{ url('speaker/create') }}" class="button button_info button_small button_margin">Añadir Ponente</a>
        <a href="{{ url('admin') }}" class="button button_info button_small button_margin">Volver</a>
    </div>
    
    <div class="speaker-content">
        @foreach ($speakers as $speaker)
            <div class="card-item card-item_large">
                <div class="card-img-container">
                    <img class="card-img" src="{{ url('user/file/' . $speaker->img) }}" alt="IMG PONENTE">
                </div>
                <div class="card-content">
                    <div class="card-title-container">
                        <p class="card-title">Antonio Ramirez</p>
                    </div>
                    <ul class="social-menu">
                        <li class="social-item">
                            <img src="{{ url('assets/img/icono-facebook.svg') }}" alt="">
                        </li>
                        <li class="social-item">
                            <img src="{{ url('assets/img/icono-twitter.svg') }}" alt="">
                        </li>
                        <li class="social-item">
                            <img src="{{ url('assets/img/icono-instagram.svg') }}" alt="">
                        </li>
                        <li class="social-item">
                            <img src="{{ url('assets/img/icono-youtube.svg') }}" alt="">
                        </li>
                    </ul>
                    <div class="card-excerpt-container">
                        <p class="card-excerpt">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Iusto tempore ratione maiores. Deleniti vero ullam facilis optio assumenda, animi nihil, quidem expedita aperiam, esse voluptatum! Cumque sint perferendis tempora veniam!</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
    {{ $speakers->appends(['sort' => 'votes'])->onEachSide(2)->links() }}

@endsection