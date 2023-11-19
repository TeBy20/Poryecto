@extends('adminlte::page')

@section('plugins.Datatables', true)

@section('title', 'Usuarios')

@section('content_header')
    <h1>Lista de Usuarios</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 mb-3">
                <a href="{{ route('users.create') }}" class="btn btn-success text-uppercase">
                    Nuevo Usuario
                </a>
            </div>

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
                        <table id="tabla-usuarios" class="table table-striped table-hover w-100">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col" class="text-uppercase">Nombre</th>
                                    <th scope="col" class="text-uppercase">Correo</th>
                                    <th scope="col" class="text-uppercase">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('users.show', $user->id) }}"
                                                    class="btn btn-sm btn-info text-white text-uppercase me-1">
                                                    Mostrar
                                                </a>
                                                <a href="{{ route('users.edit', $user->id) }}"
                                                    class="btn btn-sm btn-warning text-white text-uppercase me-1">
                                                    Editar
                                                </a>
                                                <button class="btn btn-sm btn-danger text-uppercase"
                                                    onclick="confirmDelete({{ $user->id }})">
                                                    Eliminar
                                                </button>
                                                <form id="delete-form-{{ $user->id }}"
                                                    action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                    style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(userId) {
            if (confirm('¿Estás seguro de que deseas eliminar este usuario?')) {
                // Envía el formulario de eliminación si el usuario confirma
                document.getElementById('delete-form-' + userId).submit();
            }
        }
    </script>
@stop

@section('css')

@stop

@section('js')
    <script src="{{ asset('js/usuarios.js') }}"></script>
@stop