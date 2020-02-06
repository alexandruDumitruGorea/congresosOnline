<?php
    $request->session()->put('id_presentation', $presentation->id);
?>
@extends('basic')

@section('content')
    <div class="container">
        <div class="video">
            @if ($presentation->video_url === null)
                <img src="{{ url('assets/img/play-default.png') }}"></img>
                <p>No hay ningún video porfavor contacte con el ponente o el organizador</p>
            @else
                @if (!Auth::check())
                    <img src="{{ url('assets/img/play-default.png') }}"></img>
                    <p>No puede ver el video si no se registra para la ponencia</p>
                @else
                    @if (Auth::user()->id == $presentation->id_speaker)
                        <iframe src="{{$presentation->video_url}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    @else
                        @if ($yourPresentation != null)
                            @foreach ($yourPresentation as $asistence)
                                @if (!$asistence->document)
                                    <img src="{{ url('assets/img/play-default.png') }}"></img>
                                    <p>No puede ver el video si no sube el justificante</p>
                                @elseif(Auth::user()->id == $asistence->id_assistant)
                                    <!--<iframe id="video" src="{{$presentation->video_url}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>-->
                                    <div id="video" data-url="{{$presentation->video_url}}"></div>
                                @else
                                    <img src="{{ url('assets/img/play-default.png') }}"></img>
                                    <p>No puede ver el video si no se registra para la ponencia</p>
                                @endif
                            @endforeach
                        @else
                            <img src="{{ url('assets/img/play-default.png') }}"></img>
                            <p>No puede ver el video si no se registra para la ponencia</p>
                        @endif
                    @endif
                @endif
            @endif
        </div>
        <h1><span id="titulo">{{ $presentation->title }}</span> | {{ $presentation->price }}€</h1>
        <h3>{{ $presentation->congress->date }} {{ $presentation->hour }}</h3>
        <p>{{ $presentation->description }}</p>
        @if (Auth::check())
            @if (Auth::user()->id == $presentation->id_speaker)
                @if ($presentation->video_url === null)
                    <a href="{{ url('presentation/' . $presentation->id . '/edit') }}" class="button button_without-video button_small button_margin">Subir Video</a>
                @else
                    <a href="{{ url('presentation/' . $presentation->id . '/edit') }}" class="button button_without-video button_small button_margin">Editar Video</a>
                @endif
            @else
                @if ($yourPresentation != null)
                    @foreach ($yourPresentation as $asistence)
                        @if (Auth::user()->id !== $asistence->id_assistant || $asistence->id_presentation !== $presentation->id)
                            <a href="{{ url('pay') }}" class="button button_info button_small button_margin">Asistir</a>
                        @elseif(!$asistence->document)
                            <a href="{{ url('assistant-presentation/' . $asistence->id . '/edit') }}" class="button button_pay button_info button_small button_margin">Subir Justificante</a>
                        @endif
                    @endforeach
                @else
                    <a href="{{ url('pay') }}" class="button button_info button_small button_margin">Asistir</a>
                @endif
            @endif
        @else
            <a href="{{ url('register') }}" class="button button_info button_small button_margin">Asistir</a>
        @endif
        <a href="{{ url('/') }}" class="button button_info button_small button_margin">Volver</a>
    </div>
@endsection