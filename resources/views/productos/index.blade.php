@extends('layouts.app')

@section('titulo', 'Listado de productos')

@section('contenido')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Productos</h1>
        <a href="{{ route('productos.create') }}" class="btn btn-primary">Nuevo producto</a>
    </div>

    <table class="table table-striped table-bordered bg-white">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Stock</th>
                <th class="text-end">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($productos as $producto)
                <tr>
                    <td>{{ $producto->id }}</td>
                    <td>{{ $producto->nombre }}</td>
                    <td>Q{{ number_format($producto->precio, 2) }}</td>
                    <td>{{ $producto->stock }}</td>
                    <td class="text-end">
                        <a href="{{ route('productos.edit', $producto) }}" class="btn btn-sm btn-outline-secondary">Editar</a>
                        <form action="{{ route('productos.destroy', $producto) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('¿Eliminar este producto?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">No hay productos registrados todavía.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
