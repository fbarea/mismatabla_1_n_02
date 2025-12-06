@extends ('layouts.main-layout')

@section('page-title', 'Categoría creada')

@section('content-area')
    <h2>Categoría creada</h2>
    <div class="row">
        <p class="alert alert-success">
            La categoría {{ $category }} ha sido creada correctamente.
        </p>
    </div>
    <div class="row"><br></div>
    <div class="row">
        <a class="btn btn-success btn-sm" href="{{ route('categories.list', ['type'=>'N']) }}">Volver al listado</a>
    </div>
@endsection