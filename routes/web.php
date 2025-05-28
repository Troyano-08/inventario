<?php

use App\Models\Cliente;
use App\Models\Categoria;
use App\Models\Producto;
use App\Http\Controllers\Cliente\ClienteController;
use App\Http\Controllers\Categoria\CategoriaController;
use App\Http\Controllers\Producto\ProductoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {


    //return $cliente->nombres." ".$cliente->pri_ape;*/

    /*$categoria = Categoria::create([
        'nombre' => 'HOGAR',
        'descripcion' => 'Categoria Hogar'
    ]);

    $categoria->productos()->create([
        'codigo' => '101',
        'nombre' => 'Mesa',
        'descripcion' => 'Hermosa mesa de buena calidad'
    ]);

    return $categoria;*/

    return view('welcome');
});



Route::get('/', function () {
    return view('welcome'); // Esta es tu vista de inicio
})->name('inicio');


Route::get('/clientes/index', [ClienteController::class, 'index'])->name('clientes.index');
Route::get('/clientes/create', [ClienteController::class, 'create'])->name('clientes.create');
Route::post('/clientes/store', [ClienteController::class, 'store'])->name('clientes.store');
Route::get('/clientes/edit/{id}', [ClienteController::class, 'edit'])->name('clientes.edit');
Route::post('/clientes/update', [ClienteController::class, 'update'])->name('clientes.update');
Route::get('/clientes/delete/{id}', [ClienteController::class, 'delete'])->name('clientes.delete');
Route::post('/clientes/destroy', [ClienteController::class, 'destroy'])->name('clientes.destroy');


Route::get('/categorias/index', [CategoriaController::class, 'index'])->name('categorias.index');
Route::get('/categorias/create', [CategoriaController::class, 'create'])->name('categorias.create');
Route::post('/categorias/store', [CategoriaController::class, 'store'])->name('categorias.store');
Route::get('/categorias/edit/{id}', [CategoriaController::class, 'edit'])->name('categorias.edit');
Route::post('/categorias/update', [CategoriaController::class, 'update'])->name('categorias.update');
Route::get('/categorias/delete/{id}', [CategoriaController::class, 'delete'])->name('categorias.delete');
Route::post('/categorias/destroy', [CategoriaController::class, 'destroy'])->name('categorias.destroy');

Route::get('/productos/index', [ProductoController::class, 'index'])->name('productos.index');
Route::get('/productos/create', [ProductoController::class, 'create'])->name('productos.create');
Route::post('/productos/store', [ProductoController::class, 'store'])->name('productos.store');
Route::get('/productos/edit/{id}', [ProductoController::class, 'edit'])->name('productos.edit');
Route::post('/productos/update', [ProductoController::class, 'update'])->name('productos.update');
Route::get('/productos/delete/{id}', [ProductoController::class, 'delete'])->name('productos.delete');
Route::post('/productos/destroy', [ProductoController::class, 'destroy'])->name('productos.destroy');