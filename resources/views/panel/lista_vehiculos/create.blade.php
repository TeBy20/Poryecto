@extends('adminlte::page')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Crear Vehiculo</h3>
    </div>
    <div class="card-body">
        <!-- Formulario de creación de vehículo -->
        <form action="{{ route('vehiculo.store') }}" method="POST" novalidate>
            @csrf

            <div class="form-group">
                <label for="placa_vehiculo">Número de placa del vehículo:</label>
                <input class="form-control @error('placa_vehiculo') is-invalid @enderror" type="text" name="placa_vehiculo" value="{{ old('placa_vehiculo') }}">
                @error('placa_vehiculo')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <br>
            <br>

            <div class="form-group">
                <label for="categoria_id">Categoría del vehículo:</label>
                <select name="categoria_id" class="form-control @error('categoria_id') is-invalid @enderror">
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
            <div class="row d-flex justify-content-center">
                <div class="col-5">
                    <!-- Info Box para mostrar la fecha actual -->
                    <div class="info-box bg-info">
                        <span class="info-box-icon"><i class="far fa-calendar"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Fecha Actual</span>
                            <span class="info-box-number">{{ \Carbon\Carbon::now()->format('Y-m-d') }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-5">
                    <!-- Info Box para mostrar la hora actual -->
                    <div class="info-box bg-success">
                        <span class="info-box-icon"><i class="far fa-clock"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Hora Actual</span>
                            <span class="info-box-number">{{ \Carbon\Carbon::now()->format('H:i:s') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <button class="btn btn-primary" type="submit">Crear Vehiculo</button>
            <a class="btn btn-secondary" href="{{ route('vehiculo.index') }}">Cancelar</a>
        </form>
    </div>
</div>
@endsection
