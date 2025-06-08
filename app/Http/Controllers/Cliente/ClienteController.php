<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cliente;
use Barryvdh\DomPDF\Facade\Pdf;

class ClienteController extends Controller
{
    /**
     * Mostrar la lista de clientes.
     */
    public function index(Request $request)
    {
        $clientes = Cliente::latest()->get();
        return view('clientes.index', compact('clientes'));
    }

    /**
     * Mostrar el formulario de creación.
     */
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Almacenar un nuevo cliente.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombres' => 'required|string|max:255',
            'pri_ape' => 'required|string|max:255',
            'seg_ape' => 'required|string|max:255',
            'docu_tip' => 'required|string|max:9',
            'docu_num' => 'required|string|max:255|unique:clientes,docu_num',
            'telefono' => 'nullable|string|max:255',
            'direccion' => 'nullable|string|max:255',
        ]);

        Cliente::create($request->all());

        return redirect()->route('clientes.index')->with('success', 'Cliente creado correctamente.');
    }

    /**
     * Mostrar el formulario de edición.
     */
    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('clientes.edit', compact('cliente'));
    }

    /**
     * Actualizar cliente.
     */
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:clientes,id',
            'nombres' => 'required|string|max:255',
            'pri_ape' => 'required|string|max:255',
            'seg_ape' => 'required|string|max:255',
            'docu_tip' => 'required|string|max:9',
            'docu_num' => 'required|string|max:255|unique:clientes,docu_num,' . $request->id,
            'telefono' => 'nullable|string|max:255',
            'direccion' => 'nullable|string|max:255',
        ]);

        $cliente = Cliente::findOrFail($request->id);
        $cliente->update($request->except('id'));

        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado correctamente.');
    }

    /**
     * Mostrar vista de confirmación de eliminación.
     */
    public function delete($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('clientes.delete', compact('cliente'));
    }

    /**
     * Eliminar un cliente.
     */
    public function destroy(Request $request)
    {
        $cliente = Cliente::findOrFail($request->id);
        $cliente->delete();

        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado correctamente.');
    }

    /**
     * Exportar listado de clientes a PDF.
     */
    public function exportarPDF()
    {
        $clientes = Cliente::all();
        $pdf = Pdf::loadView('clientes.pdf', compact('clientes'));
        return $pdf->download('clientes.pdf');
    }
}


