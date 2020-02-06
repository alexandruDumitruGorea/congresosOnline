@extends('basic')

@section('content')
<div class="container mt">
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">ID Asistente</th>
          <th scope="col">ID Ponencia</th>
          <th scope="col">Título Ponencia</th>
          <th scope="col">Documento</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($assistantsPresentations as $assistantPresentation)
            <tr>
              <th scope="row">{{ $assistantPresentation->id }}</th>
              <td>{{ $assistantPresentation->id_assistant }}</td>
              <td>{{ $assistantPresentation->id_presentation }}</td>
              <td>{{ $assistantPresentation->presentation->title }}</td>
              <td>
                  @if ($assistantPresentation->document !== null)
                      <a href="{{ url('assistant-presentation/' . $assistantPresentation->id) }}">{{ basename(url('assistant-presentation/pdf/' . $assistantPresentation->document)) }}</a>
                  @endif
              </td>
            </tr>
        @endforeach
      </tbody>
    </table>
    {{ $assistantsPresentations->appends(['sort' => 'votes'])->onEachSide(2)->links() }}
    <a href="{{ url('admin') }}" class="button button_info button_small button_margin">Volver</a>
</div>
@endsection