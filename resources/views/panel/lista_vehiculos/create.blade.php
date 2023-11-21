@extends('adminlte::page')

@section('plugins.Datatables', true)

@section('title', 'Registro de Vehiculo')

@section('content_header')
<h1>Registro de Vehiculo</h1>
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
                    <form action="{{ route('vehiculo.store') }}" method="POST" novalidate>
                        @csrf

                        <div class="form-group">
                            <label for="placa_vehiculo">Número de placa del vehículo:</label>
                            <input class="form-control" type="text" name="placa_vehiculo" value="{{ old('placa_vehiculo') }}">
                            @error('placa_vehiculo')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <br>
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
                        <br>

                        <!-- Info Box para mostrar la hora actual -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="info-box bg-info">
                                    <span class="info-box-icon"><i class="far fa-clock"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Hora Actual</span>
                                        <span class="info-box-number">{{ \Carbon\Carbon::now()->format('H:i:s') }}</span>
                                    </div>
                                </div>
                            </div>
                            <!-- Info Box para mostrar la fecha actual -->
                            <div class="col-md-6">
                                <div class="info-box bg-success">
                                    <span class="info-box-icon"><i class="far fa-calendar"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Fecha Actual</span>
                                        <span class="info-box-number">{{ \Carbon\Carbon::now()->format('Y-m-d') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br>

                        <button class="btn btn-primary" type="submit">Crear Vehiculo</button>
                        <a class="btn btn-secondary" href="{{ route('vehiculo.index') }}">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop