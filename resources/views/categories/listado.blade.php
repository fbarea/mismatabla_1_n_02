@extends ('layouts.main-layout')

@section ('page-title', 'Listado de categorías')

@section ('content-area')
    @if ($type == 'A')
        <h2>Listado alfabético de categorías</h2>
    @else
        <h2>Listado de categorías por niveles</h2>
    @endif
    <table class="table table-striped table-bordered table-sm">
        <thead class="thead-dark">
            <tr>
                <th>CATEGORIA</th>
                <th class="columna-de-boton">EDITAR</th>
                <th class="columna-de-boton">BORRAR</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($categorias as $categoria)
            <tr>
                <td>
                    @if ($type == 'A')
                        {{ $categoria->category_name }} (Nivel: {{$categoria->nivel}})
                    @else
                        {!! $categoria->category_name !!}
                    @endif
                </td>
                <td class="table-primary celda-de-icono">
                    <a href="{{ route('categories.edit', ['id'=>$categoria->id]) }}" title="Editar">
                        <i class="material-icons icono-editar">build</i>
                    </a>
                </td>
                <td class="table-danger celda-de-icono">
                    <a href="{{ route('categories.previous_delete', ['id'=>$categoria->id]) }}" title="Borrar">
                        <i class="material-icons icono-borrar">delete</i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
        </table>
@endsection


