@extends('layouts.app')

@section('title', 'Listado de Cargos')

@section('content')

    @if(session("status"))
    <div class="alert alert-success">
        {{ session("status") }}
    </div>
    @endif

    <a class="btn btn-primary m-2" href="{{ route('cargos.create') }}">Agregar</a>

    @if ($cargos->count())
    <table class="table table-striped mx-auto m-3">
        <thead class="table-dark">
            <tr>
                <th>Id</th>
                <th>Nombre de Cargos</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody class="table-primary">
            @foreach ($cargos as $cargo)
            <tr>
                <td>{{ $cargo->id }}</td>
                <td>{{ $cargo->nombre_cargo }}</td>
                <td>
                    <div class="btn-group" role="group">
                        
                        <a class="btn btn-warning" href="{{ route('cargos.edit', $cargo->id) }}">Editar</a>
                        
                        <form action="{{ route('cargos.destroy', $cargo->id) }}" method='POST'>
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
    <h4>¡No hay cargos cargadas!</h4>
    @endif
    @endsection
