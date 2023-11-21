@extends('adminlte::page')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Editar Usuario</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Nombre:</label>
                    <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Correo Electrónico:</label>
                    <input type="email" name="email" class="form-control" value="{{ $user->email }}">
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Contraseña:</label>
                    <input type="password" name="password" class="form-control" placeholder="Deja vacío para mantener la contraseña actual">
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Agrega más campos según sea necesario --}}

                <button type="submit" class="btn btn-primary" onclick="confirmUpdate()">Actualizar</button>
            </form>

            <!-- Botón para la alerta de confirmación de eliminación -->
            <a href="{{ route('users.index') }}" class="btn btn-secondary mt-2">Volver al Inicio</a>
        </div>
    </div>

    <script>
        function confirmUpdate() {
            // Muestra una alerta de confirmación de actualización
            alert('Usuario actualizado exitosamente');
        }

        function confirmDelete(userId) {
            // Muestra una alerta de confirmación de eliminación
            if (confirm('¿Estás seguro de que deseas eliminar este usuario?')) {
                // Envía el formulario de eliminación si el usuario confirma
                document.getElementById('delete-form').submit();
            }
        }
    </script>
@endsection
