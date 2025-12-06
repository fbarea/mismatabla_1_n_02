@extends ('layouts.main-layout')

@section ('page-title', 'Listado de categorías')

@section ('content-area')
    @if ($type == 'A')
        <h2>Listado alfabético de categorías</h2>
    @else
        <h2>Listado de categorías por niveles</h2>
    @endif

    @foreach ($categorias as $categoria)
        @if ($type == 'A')
            {{ $categoria->category_name }} (Nivel: {{$categoria->nivel}})
        @else
            {!! $categoria->category_name !!}
        @endif
        <br>
    @endforeach
@endsection
