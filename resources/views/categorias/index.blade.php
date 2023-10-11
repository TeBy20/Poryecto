@extends('layouts.app')

@section('title', 'Listado de Categoiras')

@section('content')

    @if(session("status"))
    <div class="alert alert-success">
        {{ session("status") }}
    </div>
    @endif

    <a class="btn btn-primary m-2" href="{{ route('categorias.create') }}">Agregar</a>

    @if ($categorias->count())
    <table class="table table-striped mx-auto m-3">
        <thead class="table-dark">
            <tr>
                <th>Id</th>
                <th>Nombre de Categoiras</th>
                <th>Tarifas</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody class="table-primary">
            @foreach ($categorias as $categoria)
            <tr>
                <td>{{ $categoria->id }}</td>
                <td>{{ $categoria->nombre_categoria }}</td>
                <td>{{ $categoria->tarifas }}</td>
                <td>
                    <div class="btn-group" role="group">
                        
                        <a class="btn btn-warning" href="{{ route('categorias.edit', $categoria->id) }}">Editar</a>
                        
                        <form action="{{ route('categorias.destroy', $categoria->id) }}" method='POST'>
                            @csrf @method('DELETE')
                            
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </div>
                </td>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
   
    @else
    <h4>¡No hay categorias cargadas!</h4>
    @endif
    @endsection
