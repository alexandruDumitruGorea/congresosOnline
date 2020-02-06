@extends('basic')

@section('content')
<div class="container mt">
    <a href="{{ url('congress') }}">Congresos</a><br>
    <a href="{{ url('presentation') }}">Ponencias</a><br>
    <a href="{{ url('organizator') }}">Usuarios Comite Organizador</a><br>
    <a href="{{ url('speaker') }}">Usuarios Ponente</a><br>
    <a href="{{ url('assistant-presentation') }}">Comprobar Justificantes</a>
</div>
    
@endsection