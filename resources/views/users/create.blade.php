@extends('adminlte::page')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Crear Usuario</h3>
        </div>
        <div class="card-body">
            <!-- Formulario de creación de usuario -->
            <form action="{{ route('users.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="name">Nombre:</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="email">Correo Electrónico:</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="password">Contraseña:</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <!-- Agrega otros campos del formulario según sea necesario -->

                <button type="submit" class="btn btn-primary">Crear Usuario</button>
            </form>
            <a href="{{ route('users.index') }}" class="btn btn-secondary mt-2">Volver al Inicio</a>
        </div>
    </div>
@endsection
