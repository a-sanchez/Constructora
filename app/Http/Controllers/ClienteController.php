<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\clientes_request;
use App\Models\cliente;
use App\Models\contrato;

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

    public function store(Request $request)
    {
        $validation=$request->all();

        $cliente=cliente::create($validation);
        cliente::contactos($cliente->id,$validation['contacto_cliente']/*,$validation['contacto_pagos']*/);
        return response()->json($cliente,201);
    }
    public function show($id)
    {
        $cliente = cliente::find($id);
        return view("clientes.detalles_cliente",compact("cliente"));
    }

    public function edit($id)
    {
        $cliente=cliente::find($id);
        return view("clientes.edit_clientes",compact("cliente"));
    }

    public function update(Request $request, $id)
    {
        $cliente = cliente::find($id);
        $update = $cliente->update($request->all());
        return $update;
    }

    public function destroy($id)
    {   
        if(contrato::where ("id_cliente",$id)){
            return response()->json("Error al eliminar cliente, contiene un contrato",409);
        }
        else{
        $cliente = cliente::find($id);
        cliente::destroy($id);
        return $cliente;
    }
    }


}
