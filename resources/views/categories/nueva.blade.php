@extends ('layouts.main-layout')

@section ('page-title', 'Crear categoría')

@section ('content-area')
    <h2>Crear nueva categoría</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li><strong>{{ $error }}</strong></li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('categories.store') }}" method="post">
        @csrf
        <div class="row">
            <div class="col col-sm-12">
                <label for="category_name">Nueva categoría</label>
                <input type="text" class="form-control" id="category_name" name="category_name" value="{{ old('category_name') }}">
            </div>
            <div class="row"><br></div>
            <div class="col col-sm-12">
                <label for="category_description">Descripción de categoría</label>
                <textarea rows="4" class="form-control" id="category_description" name="category_description">{{ old('category_description') }}</textarea>
            </div>
        </div>
        <div class="row"><br></div>
        <div class="row">
            <div class="col col-sm-8">
                <label for="parent_id">Clase padre</label>
                <select class="form-control" id="parent_id" name="parent_id" size="10">
                    <option value="00" class="sin-dependencia" selected>SIN DEPENDENCIA</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}" {{ (old('parent_id') == $categoria->id) ? " selected":"" }}>
                            {!! $categoria->category_name !!}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col col-sm-4 text-right">
                <input type="submit" class="btn btn-success btn-sm" value="Grabar">
            </div>
        </div>
    </form>
@endsection