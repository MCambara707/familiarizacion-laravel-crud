<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::orderBy('nombre')->get();

        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'nombre' => 'required|max:100',
            'dpi' => 'required|max:20|unique:clientes,dpi',
            'direccion' => 'nullable|max:150',
            'telefono' => 'nullable|max:15',
            'email' => 'nullable|email|max:100',
        ]);

        Cliente::create($datos);

        return redirect()->route('clientes.index')->with('mensaje', 'Cliente creado correctamente.');
    }

    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request, Cliente $cliente)
    {
        $datos = $request->validate([
            'nombre' => 'required|max:100',
            'dpi' => 'required|max:20|unique:clientes,dpi,' . $cliente->id,
            'direccion' => 'nullable|max:150',
            'telefono' => 'nullable|max:15',
            'email' => 'nullable|email|max:100',
        ]);

        $cliente->update($datos);

        return redirect()->route('clientes.index')->with('mensaje', 'Cliente actualizado correctamente.');
    }

    public function destroy(Cliente $cliente)
    {
        $cliente->delete();

        return redirect()->route('clientes.index')->with('mensaje', 'Cliente eliminado correctamente.');
    }
}