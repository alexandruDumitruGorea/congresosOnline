@foreach($presentation as $p)
    <h1>{{ $p->title }}</h1>
    <p>Precio: {{ $p->price }}</p>
    <p>Hora: {{ $p->hour }}</p>
@endforeach