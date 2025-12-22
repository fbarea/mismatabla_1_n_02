@extends ('layouts.main-layout')

@section('page-title', 'Eliminar categoría')

@section('content-area')
    <h2>Eliminar categoría</h2>
    <div class="row">
        <p class="alert alert-danger">
            La categoría <strong>{{ $categoria->category_name }}</strong> va a ser eliminada.
            <br>
            Si tiene subcategorías, estas también se eliminarán.
        </p>
    </div>
    <div class="row"><br></div>
    <div class="row">
        <div class="col col-sm-3">
            <a class="btn btn-primary btn-sm" href="{{ route('categories.list', ['type'=>'N']) }}">No eliminar. Volver al listado</a>
        </div>
        <div class="col col-sm-3">
            <a class="btn btn-danger btn-sm" href="{{ route('categories.delete', ['id'=>$id]) }}">La elimino, y que sea lo que tenga que ser.</a>
        </div>
    </div>
@endsection