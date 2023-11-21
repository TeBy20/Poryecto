@extends('layouts.app')

@section('title', 'Listado de Zonas')

@section('content')

@if(session("status"))
    <div class="alert alert-success">
        {{ session("status") }}
    </div>
    @endif

    <a class="btn btn-primary m-2" href="{{ route('zonas.create') }}">Agregar</a>

    @if ($zonas->count())
    <table class="table table-striped mx-auto m-3">
        <thead class="table-dark">
            <tr>
                <th>Id</th>
                <th>Nombre de Zona</th>
                <th>Capacidad</th>
                <th>Piso</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody class="table-primary">
            @foreach ($zonas as $zona)
            <tr>
                <td>{{ $zona->id }}</td>
                <td>{{ $zona->nombre_zona }}</td>
                <td>{{ $zona->capacidad }}</td>
                <td>{{ $zona->piso_zona }}</td>
                <td>
                    <div class="btn-group" role="group">
                        
                        <a class="btn btn-warning" href="{{ route('zonas.edit', $zona->id) }}">Editar</a>
                        
                        <form action="{{ route('zonas.destroy', $zona->id) }}" method='POST'>
                            @csrf @method('DELETE')
                            
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
   
    @else
    <h4>¡No hay zonas cargadas!</h4>
    @endif
    @endsection
