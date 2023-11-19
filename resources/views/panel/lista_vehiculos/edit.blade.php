@extends('adminlte::page')

@section('plugins.Datatables', true)

@section('title', 'Vehiculos')

@section('content_header')
    <h1>Lista de Vehiculos</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        
        
        @if (session('alert'))
            <div class="col-12">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('alert') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('vehiculo.update', $vehiculo->id) }}" method="POST" novalidate>
                    @csrf
                    @method("PUT")

                    <label class="form-label" for="name">Numero de placa:</label><br>
                    <input class="form-control" type="num" name="num_placa" value="{{ old('placa_vehiculo', $vehiculo->placa_vehiculo) }}">

                    <br>

                    <div class="form-group">
                            <label for="categoria_id">Categoría del vehículo:</label>
                            <select name="categoria_id" class="form-control">
                                @foreach($categorias as $categoria)
                                    <option value="{{ $categoria->id }}">{{ $categoria->nombre_categoria }}</option>
                                @endforeach
                            </select>
                            @error('categoria_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                    </div>

                    <br>

                    

                    <button class="btn btn-primary" type="submit">Guardar Vehiculos</button>
                    <a class="btn btn-secondary" href="{{ route('vehiculo.index') }}">Cancelar</a>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
    
@stop

@section('js')
    <script src="{{ asset('js/productos.js') }}"></script>
@stop
