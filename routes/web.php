<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Cliente\ClienteController;
use App\Http\Controllers\Categoria\CategoriaController;
use App\Http\Controllers\Producto\ProductoController;
use App\Http\Controllers\Proyecto\ProyectoController;

// Página de inicio protegida (welcome.blade.php)
Route::get('/', function () {
    return view('welcome');
})->middleware(['auth'])->name('inicio');

// Agrupar todas las rutas internas detrás del middleware auth
Route::middleware(['auth'])->group(function () {
    // CLIENTES
    Route::get('/clientes/index', [ClienteController::class, 'index'])->name('clientes.index');
    Route::get('/clientes/create', [ClienteController::class, 'create'])->name('clientes.create');
    Route::post('/clientes/store', [ClienteController::class, 'store'])->name('clientes.store');
    Route::get('/clientes/edit/{id}', [ClienteController::class, 'edit'])->name('clientes.edit');
    Route::post('/clientes/update', [ClienteController::class, 'update'])->name('clientes.update');
    Route::get('/clientes/delete/{id}', [ClienteController::class, 'delete'])->name('clientes.delete');
    Route::post('/clientes/destroy', [ClienteController::class, 'destroy'])->name('clientes.destroy');
    Route::get('/clientes/exportar/pdf', [ClienteController::class, 'exportarPDF'])->name('clientes.exportarPDF');


    // CATEGORÍAS
    Route::get('/categorias/index', [CategoriaController::class, 'index'])->name('categorias.index');
    Route::get('/categorias/create', [CategoriaController::class, 'create'])->name('categorias.create');
    Route::post('/categorias/store', [CategoriaController::class, 'store'])->name('categorias.store');
    Route::get('/categorias/edit/{id}', [CategoriaController::class, 'edit'])->name('categorias.edit');
    Route::post('/categorias/update', [CategoriaController::class, 'update'])->name('categorias.update');
    Route::get('/categorias/delete/{id}', [CategoriaController::class, 'delete'])->name('categorias.delete');
    Route::post('/categorias/destroy', [CategoriaController::class, 'destroy'])->name('categorias.destroy');
    Route::get('/categorias/exportar-pdf', [CategoriaController::class, 'exportarPDF'])->name('categorias.exportarPDF');

    // PRODUCTOS
    Route::get('/productos/index', [ProductoController::class, 'index'])->name('productos.index');
    Route::get('/productos/create', [ProductoController::class, 'create'])->name('productos.create');
    Route::post('/productos/store', [ProductoController::class, 'store'])->name('productos.store');
    Route::get('/productos/edit/{id}', [ProductoController::class, 'edit'])->name('productos.edit');
    Route::post('/productos/update', [ProductoController::class, 'update'])->name('productos.update');
    Route::get('/productos/delete/{id}', [ProductoController::class, 'delete'])->name('productos.delete');
    Route::post('/productos/destroy', [ProductoController::class, 'destroy'])->name('productos.destroy');
    Route::get('/productos/exportar-pdf', [ProductoController::class, 'exportarPDF'])->name('productos.exportarPDF');

    // PROYECTOS
    Route::get('/proyectos/index', [ProyectoController::class, 'index'])->name('proyectos.index');
    Route::get('/proyectos/create', [ProyectoController::class, 'create'])->name('proyectos.create');
    Route::post('/proyectos/store', [ProyectoController::class, 'store'])->name('proyectos.store');
    Route::get('/proyectos/edit/{id}', [ProyectoController::class, 'edit'])->name('proyectos.edit');
    Route::post('/proyectos/update', [ProyectoController::class, 'update'])->name('proyectos.update');
    Route::get('/proyectos/show/{id}', [ProyectoController::class, 'show'])->name('proyectos.show');
    Route::get('/proyectos/delete/{id}', [ProyectoController::class, 'delete'])->name('proyectos.delete');
    Route::post('/proyectos/destroy', [ProyectoController::class, 'destroy'])->name('proyectos.destroy');
    Route::get('/proyectos/exportarPDF', [ProyectoController::class, 'exportarPDF'])->name('proyectos.exportarPDF');


    

});


// Ruta requerida por Breeze
Route::get('/dashboard', function () {
    return redirect()->route('inicio');
})->middleware(['auth'])->name('dashboard');

// Breeze (login/register)
require __DIR__.'/auth.php';
