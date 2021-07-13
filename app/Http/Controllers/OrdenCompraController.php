<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrdenCompraController extends Controller
{
    public function index()
    {
        return view('ordenes_compras.compras_opciones');
    }

    public function create()
    {
        return view('ordenes_compras.add_compra');
    }

    public function store()
    {

    }
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
