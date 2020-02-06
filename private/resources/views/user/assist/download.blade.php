<?php
    $request->session()->put('id_presentation', $presentationid);
?>
@extends('basic')

@section('content')
    @if(\Request::get('alertMessage') !== null)
        @include('include.menssages')
    @endif
    <div class="container mt">
        <h1 style="text-align: center;">Pasa poder asistir al curso es necesario subir un justificante</h1>
        <a href="{{ url('download') }}" class="button button_pay button_small button_margin">Descargar Justificante</a>
        <a href="{{ url('presentation/' . $presentationid) }}" class="button button_info button_small button_margin">Volver</a>
    </div>
@endsection