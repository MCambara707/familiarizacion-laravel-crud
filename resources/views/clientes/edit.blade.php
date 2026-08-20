@extends('layouts.app')

@section('titulo', 'Editar cliente')

@section('contenido')
    <h1 class="h3 mb-3">Editar cliente</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('clientes.update', $cliente) }}" method="POST" class="bg-white p-4 rounded shadow-sm">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control"
                   value="{{ old('nombre', $cliente->nombre) }}" maxlength="100" required>
        </div>

        <div class="mb-3">
            <label for="dpi" class="form-label">DPI</label>
            <input type="text" name="dpi" id="dpi" class="form-control"
                   value="{{ old('dpi', $cliente->dpi) }}" maxlength="20" required>
        </div>

        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección</label>
            <input type="text" name="direccion" id="direccion" class="form-control"
                   value="{{ old('direccion', $cliente->direccion) }}" maxlength="150">
        </div>

        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" name="telefono" id="telefono" class="form-control"
                   value="{{ old('telefono', $cliente->telefono) }}" maxlength="15">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control"
                   value="{{ old('email', $cliente->email) }}" maxlength="100">
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('clientes.index') }}" class="btn btn-outline-secondary">Cancelar</a>
    </form>
@endsection