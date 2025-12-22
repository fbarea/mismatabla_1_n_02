@extends ('layouts.main-layout')

@section('page-title', 'Categorías eliminadas')

@section('content-area')
    <h2>Categorías eliminadas</h2>
    <div class="row alert alert-danger">
        Las siguientes categorías han sido eliminadas.
        <br><br><br>
        <ul class="alert alert-danger">
            @foreach($eliminadas as $eliminada)
                <li>
                    {{ $eliminada->category_name }}
                    @if ($eliminada->id == $id)
                        (SOLICITADA)
                    @else
                        (DEPENDIENTE)
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
    <div class="row"><br></div>
    <div class="row">
        <div class="col col-sm-3">
            <a class="btn btn-primary btn-sm" href="{{ route('categories.list', ['type'=>'N']) }}">Volver al listado</a>
        </div>
    </div>
@endsection