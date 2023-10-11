@extends('layouts.app')

@section('title', 'Listado de Servicios')

@section('content')

    @if(session("status"))
    <div class="alert alert-success">
        {{ session("status") }}
    </div>
    @endif

    <a class="btn btn-primary m-2" href="{{ route('servicios.create') }}">Agregar</a>

    @if ($servicios->count())
    <table class="table table-striped mx-auto m-3">
        <thead class="table-dark">
            <tr>
                <th>Id</th>
                <th>Nombre de Servicio</th>
                <th>Precio</th>
                <th>Fecha de vencimiento</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody class="table-primary">
            @foreach ($servicios as $servicio)
            <tr>
                <td>{{ $servicio->id }}</td>
                <td>{{ $servicio->nombre_servicio }}</td>
                <td>{{ $servicio->precio }}</td>
                <td>{{ $servicio->updated_at }}</td>
                <td>
                    <div class="btn-group" role="group">
                        
                        <a class="btn btn-warning" href="{{ route('servicios.edit', $servicio->id) }}">Editar</a>
                        
                        <form action="{{ route('servicios.destroy', $servicio->id) }}" method='POST'>
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
    <h4>¡No hay servicios cargadas!</h4>
    @endif
    @endsection
