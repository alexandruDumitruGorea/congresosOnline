@extends('basic')

@section('content')

<div class="container mt">
    <iframe src="{{ url('assistant-presentation/pdf/' . $assistantPresentation->document) }}" frameborder="0" width="100%" height="600px" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    <a href="{{ url('assistant-presentation') }}" class="button button_info button_small button_margin">Volver</a>
</div>

@endsection