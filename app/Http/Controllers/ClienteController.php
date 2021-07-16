<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\clientes_request;
use App\Models\cliente;

class ClienteController extends Controller
{
    public function index()
    {
        return view('clientes.cat_clientes');
    }
    public function create()
    {
        return view('clientes.add_clientes');
    }

    public function store(clientes_request $request)
    {
        $validation=$request->validated();
        cliente::create($validation);
        return response()->json("Cliente creado con exito",201);
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