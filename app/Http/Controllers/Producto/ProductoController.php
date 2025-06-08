<?php

namespace App\Http\Controllers\Producto;

use App\Models\{Producto, Categoria};
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ProductoController extends Controller
{
    public function index(Request $request)
    {
        $productos = Producto::latest()->get();
        return view('productos.index', compact('productos'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        return view('productos.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        // ✅ Validación de datos antes de guardar
        $request->validate([
            'categoria_id' => 'required|exists:categorias,id',
            'codigo' => 'required|string|max:255|unique:productos,codigo',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:255',
        ]);

        // ✅ Registro del producto
        Producto::create([
            'categoria_id' => $request->categoria_id,
            'codigo'       => $request->codigo,
            'nombre'       => $request->nombre,
            'descripcion'  => $request->descripcion,
        ]);

        return redirect()->route('productos.index')->with('success', 'Producto creado correctamente.');
    }

    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        $categorias = Categoria::all();
        return view('productos.edit', compact('producto', 'categorias'));
    }

    public function update(Request $request)
    {
        $producto = Producto::findOrFail($request->id);

        // ✅ Validación para actualización
        $request->validate([
            'categoria_id' => 'required|exists:categorias,id',
            'codigo' => 'required|string|max:255|unique:productos,codigo,' . $producto->id,
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:255',
        ]);

        $producto->update([
            'categoria_id' => $request->categoria_id,
            'codigo' => $request->codigo,
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente.');
    }

    public function delete($id)
    {
        $producto = Producto::findOrFail($id);
        return view('productos.delete', compact('producto'));
    }

    public function destroy(Request $request)
    {
        $producto = Producto::findOrFail($request->id);
        $producto->delete();

        return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente.');
    }
    public function exportarPDF()
{
    $productos = Producto::all();
    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('productos.pdf', compact('productos'));
    return $pdf->download('productos.pdf');
}
}
