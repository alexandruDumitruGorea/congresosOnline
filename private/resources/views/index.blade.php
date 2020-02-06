@extends('basic')

@section('content')

    <section class="slider">
        <div class="container">
            <div class="slider-text">Congresos Online!</div>
            <p class="slider-description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus cum corrupti iste perferendis vel quisquam, dolores, nesciunt dolor suscipit quasi error. Molestiae ab voluptas nesciunt rerum numquam praesentium maxime nisi.</p>
        </div>
    </section>
    @if(\Request::get('alertMessage') !== null)
        @include('include.menssages')
    @endif
    <div class="main-content container">
        <div class="congress-container">
            @if ($yourPresentations != null)
                <div class="congress your-congress">
                    <div class="text-intro-container">
                        <div class="text-intro-icon">
                            <img src="{{ url('assets/img/congress-icon.svg') }}" alt="">
                        </div>
                        <p class="text-intro">Tus ponencias</p>
                    </div>
                    <div class="congress-content">
                        @if ($userPrivilege === 3)
                            @foreach ($yourPresentations as $presentation)
                                <div class="card-item">
                                    <div class="card-img-container">
                                        @if ($presentation->video_url == null)
                                            <div class="card-menssage card-menssage_without-video">
                                                <span class="menssage">A este congreso le falta el video. Metase para poder editarlo. Gracias.</span>
                                            </div>
                                        @endif
                                        <img class="card-img" src="{{ url('assets/img/congreso-web.jpg') }}" alt="IMG CONGRESO">
                                    </div>
                                    <div class="card-content">
                                        <div class="card-title-container">
                                            <p class="card-title">{{ $presentation->title }}</p>
                                        </div>
                                        <div class="card-excerpt-container">
                                            <p class="card-excerpt">{{ $presentation->extract }}</p>
                                        </div>
                                        @if ($presentation->video_url == null)
                                            <a href="{{ url('presentation/' . $presentation->id) }}" class="button button_without-video">Saber más</a>
                                        @else
                                            <a href="{{ url('presentation/' . $presentation->id) }}" class="button button_info">Saber más</a>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        @if ($userPrivilege === 4)
                            @foreach ($yourPresentations as $yourPresentation)
                                <div class="card-item">
                                    <div class="card-img-container">
                                        @if ($yourPresentation->document == false)
                                            <div class="card-menssage card-menssage_pay">
                                                <span class="menssage">Te recordamos que debe subir el justificante de pago para poder asistir. Gracias.</span>
                                            </div>
                                        @endif
                                        <img class="card-img" src="{{ url('assets/img/congreso-web.jpg') }}" alt="IMG CONGRESO">
                                    </div>
                                    <div class="card-content">
                                        <div class="card-title-container">
                                            <p class="card-title">{{ $yourPresentation->presentation->title }}</p>
                                        </div>
                                        <div class="card-excerpt-container">
                                            <p class="card-excerpt">{{ $yourPresentation->presentation->extract }}</p>
                                        </div>
                                        @if ($yourPresentation->document == false)
                                            <a href="{{ url('assistant-presentation/' . $yourPresentation->id . '/edit') }}" class="button button_pay">Subir Justificante</a>
                                        @else
                                            <a href="{{ url('presentation/' . $yourPresentation->id_presentation) }}" class="button button_info">Saber más</a>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @endif
                </div>
                {{ $yourPresentations->appends(['sort' => 'votes'])->onEachSide(2)->links() }}
            </div>
            @endif
            <div class="congress" id="congress">
                <div class="text-intro-container">
                    <div class="text-intro-icon">
                        <img src="{{ url('assets/img/congress-icon.svg') }}" alt="">
                    </div>
                    <p class="text-intro">Ponencias</p>
                </div>
                <div class="congress-content">
                    @foreach($presentations as $presentation)
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
                                <a href="{{ url('presentation/' . $presentation->id) }}" class="button button_info">Saber más</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            {{ $presentations->appends(['sort' => 'votes'])->onEachSide(2)->links() }}
        </div>
        <div class="speaker" id="speaker">
            <div class="text-intro-container">
                <div class="text-intro-icon">
                    <img src="{{ url('assets/img/speaker-icon.svg') }}" alt="">
                </div>
                <p class="text-intro">Ponentes</p>
            </div>
            <div class="speaker-content">
                @foreach ($speakers as $speaker)
                    <div class="card-item card-item_large">
                        <div class="card-img-container">
                            <img class="card-img" src="{{ url('user/file/' . $speaker->img) }}" alt="IMG PONENTE">
                        </div>
                        <div class="card-content">
                            <div class="card-title-container">
                                <p class="card-title">{{ $speaker->name }}</p>
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
        </div>
    </div>

@endsection