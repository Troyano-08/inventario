<?php

namespace App\Http\Controllers\Proyecto;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Proyecto;
use App\Models\Cliente;
use Barryvdh\DomPDF\Facade\Pdf;

class ProyectoController extends Controller
{
    /**
     * Mostrar listado de proyectos.
     */
    public function index()
    {
        $proyectos = Proyecto::with('cliente')->get();
        return view('proyectos.index', compact('proyectos'));
    }

    /**
     * Mostrar formulario de creación.
     */
    public function create()
    {
        $clientes = Cliente::all()->map(function ($cliente) {
            return (object) [
                'id' => $cliente->id,
                'nombre' => $cliente->nombres . ' ' . $cliente->pri_ape . ' ' . $cliente->seg_ape,
            ];
        });

        return view('proyectos.create', compact('clientes'));
    }

    /**
     * Almacenar nuevo proyecto.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'descripcion' => 'required|string|max:255',
            'estado' => 'required|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
        ]);

        Proyecto::create($request->all());

        return redirect()->route('proyectos.index')->with('success', 'Proyecto creado exitosamente.');
    }

    /**
     * Mostrar detalles de un proyecto.
     */
    public function show($id)
    {
        $proyecto = Proyecto::with('cliente')->findOrFail($id);
        return view('proyectos.show', compact('proyecto'));
    }

    /**
     * Mostrar formulario de edición.
     */
    public function edit($id)
    {
        $proyecto = Proyecto::findOrFail($id);
        $clientes = Cliente::all()->map(function ($cliente) {
            return (object) [
                'id' => $cliente->id,
                'nombre' => $cliente->nombres . ' ' . $cliente->pri_ape . ' ' . $cliente->seg_ape,
            ];
        });

        return view('proyectos.edit', compact('proyecto', 'clientes'));
    }

    /**
     * Actualizar proyecto.
     */
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:proyectos,id',
            'cliente_id' => 'required|exists:clientes,id',
            'descripcion' => 'required|string|max:255',
            'estado' => 'required|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
        ]);

        $proyecto = Proyecto::findOrFail($request->id);
        $proyecto->update($request->all());

        return redirect()->route('proyectos.index')->with('success', 'Proyecto actualizado correctamente.');
    }

    /**
     * Confirmar eliminación (vista opcional).
     */
    public function delete($id)
    {
        $proyecto = Proyecto::findOrFail($id);
        return view('proyectos.delete', compact('proyecto'));
    }

    /**
     * Eliminar proyecto.
     */
    public function destroy(Request $request)
    {
        Proyecto::destroy($request->id);
        return redirect()->route('proyectos.index')->with('success', 'Proyecto eliminado.');
    }
    public function exportarPDF()
{
    $proyectos = \App\Models\Proyecto::with('cliente')->get();
    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('proyectos.pdf', compact('proyectos'));
    return $pdf->download('proyectos.pdf');
}
}
