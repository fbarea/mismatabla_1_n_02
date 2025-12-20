@extends ('layouts.main-layout')

@section ('page-title', 'Editar categoría')

@section ('content-area')
    <h2>Editar categoría</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li><strong>{{ $error }}</strong></li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('categories.update') }}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{ $actual->id }}">
        <input type="hidden" name="idsDisponibles" value="{{ $disponibles }}">
        <div class="row">
            <div class="col col-sm-12">
                <label for="category_name">Nueva categoría</label>
                <input type="text" class="form-control" id="category_name" name="category_name" value="{{ $errors->any() ? old('category_name') : $actual->category_name }}">
            </div>
            <div class="row"><br></div>
            <div class="col col-sm-12">
                <label for="category_description">Descripción de categoría</label>
                <textarea rows="4" class="form-control" id="category_description" name="category_description">{{ old('category_description') ? : $actual->category_description }}</textarea>
            </div>
        </div>
        <div class="row"><br></div>
        <div class="row">
            <div class="col col-sm-8">
                <label for="parent_id">Clase padre</label>
                <select class="form-control" id="parent_id" name="parent_id" size="10">
                  <option value="" class="sin-dependencia" {{ old('parent_id', $actual->parent_id) === null ? 'selected' : '' }}>
                    SIN DEPENDENCIA
                  </option>
                @foreach ($categoriasDisponibles as $categoria)
                  <option value="{{ $categoria->id }}" {{ old('parent_id', $actual->parent_id) == $categoria->id ? 'selected' : '' }}>
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
