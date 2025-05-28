<?php

namespace App\Http\Controllers\Cliente;

use App\Models\Cliente;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index(Request $request) {

        $clientes = Cliente::get();
        $clientes = Cliente::latest()->get();

        return view('clientes.index', compact('clientes'));
    }

    public function create() {

        return view('clientes.create');
    }

    public function store(Request $request) {

        $cliente = Cliente::create($request->all());

        return redirect()->route('clientes.index');
    }

    public function edit($id) {

        $cliente = Cliente::find($id);

        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request) {

        $cliente = Cliente::find($request->id);

        $cliente->update($request->except('id'));

        return redirect()->route('cliente.index');
    }

    public function delete($id) {

        $cliente = Cliente::find($id);

        return view('clientes.delete', compact('cliente'));
    }

    public function destroy(Request $request) {

        $cliente = Cliente::find($request->id);

        $cliente->delete();

        return redirect()->route('cliente.index');
    }
}

