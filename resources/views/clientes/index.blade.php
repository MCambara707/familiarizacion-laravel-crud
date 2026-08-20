@extends('layouts.app')

@section('titulo', 'Listado de clientes')

@section('contenido')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Clientes</h1>
        <a href="{{ route('clientes.create') }}" class="btn btn-primary">Nuevo cliente</a>
    </div>

    <table class="table table-striped table-bordered bg-white">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>DPI</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th class="text-end">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->id }}</td>
                    <td>{{ $cliente->nombre }}</td>
                    <td>{{ $cliente->dpi }}</td>
                    <td>{{ $cliente->direccion }}</td>
                    <td>{{ $cliente->telefono }}</td>
                    <td>{{ $cliente->email }}</td>
                    <td class="text-end">
                        <a href="{{ route('clientes.edit', $cliente) }}" class="btn btn-sm btn-outline-secondary">Editar</a>
                        <form action="{{ route('clientes.destroy', $cliente) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('¿Eliminar este cliente?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">No hay clientes registrados todavía.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection