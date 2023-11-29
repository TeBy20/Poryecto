@extends('adminlte::page')

@section('title', 'Eliminar Cocheras por Piso')

@section('content_header')
    <h1>Eliminar Cocheras</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('panel.cocheras.destroyByPiso') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="piso" class="form-label">Seleccionar Piso:</label>
                                <select class="form-select" name="piso" id="piso" required>
                                    @foreach($pisos as $piso)
                                        <option value="{{ $piso }}">{{ $piso }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-danger">Eliminar Cocheras</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
