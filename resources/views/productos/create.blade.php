@extends('layouts.app')

@section('titulo', 'Nuevo producto')

@section('contenido')
    <h1 class="h3 mb-3">Nuevo producto</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('productos.store') }}" method="POST" class="bg-white p-4 rounded shadow-sm">
        @csrf

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control"
                   value="{{ old('nombre') }}" maxlength="100" required>
        </div>

        <div class="mb-3">
            <label for="precio" class="form-label">Precio</label>
            <input type="number" step="0.01" min="0" name="precio" id="precio" class="form-control"
                   value="{{ old('precio') }}" required>
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" min="0" name="stock" id="stock" class="form-control"
                   value="{{ old('stock', 0) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('productos.index') }}" class="btn btn-outline-secondary">Cancelar</a>
    </form>
@endsection
