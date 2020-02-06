@foreach($presentation as $p)
    <h1>{{ $p->title }}</h1>
    <p>Precio: {{ $p->price }}</p>
    <p>Hora: {{ $p->hour }}</p>
    <h1>ENHORABUENA YA TIENES TU CERTIFICADO</h1>
@endforeach