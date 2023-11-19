<!-- resources/views/users/show.blade.php -->

{{-- Extiende la plantilla de app.blade.php --}}
@extends('adminlte::page')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Detalles del Usuario</h3>
        </div>
        <div class="card-body">
            <p><strong>Nombre:</strong> {{ $user->name }}</p>
            <p><strong>Correo Electrónico:</strong> {{ $user->email }}</p>
            <p><strong>Creado en:</strong> {{ $user->created_at }}</p>
            {{-- Agrega más campos según sea necesario --}}
            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Editar</a>

            <!-- Formulario para eliminar al usuario -->
            <form id="delete-form" action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-danger" onclick="confirmDelete()">Eliminar</button>
            </form>
            <a href="{{ route('users.index') }}" class="btn btn-secondary ms-2">Volver al Inicio</a>
        </div>
    </div>

    <script>
        function confirmDelete() {
            // Muestra una alerta de confirmación de eliminación
            if (confirm('¿Estás seguro de que deseas eliminar este usuario?')) {
                // Envía el formulario de eliminación si el usuario confirma
                document.getElementById('delete-form').submit();
            }
        }
    </script>
@endsection
