<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\contacto_cliente_clientes;
use App\Http\Controllers\Controller;

class ContactoClienteClientesController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        if (isset($request->action)) {
            $update = $this->update($request);
            return $update;
        }

        $contacto=contacto_cliente_clientes::create($request->all());
        return $contacto;
    }


    public function show($id)
    {
        $cliente = contacto_cliente_clientes::where("id_cliente",$id)->get();
        return Datatables::of($cliente)->make();
    }

    public function edit(ContactoClienteClientes $cliente)
    {
        //
    }

    public function update(Request $request)
    {
        
        $contacto=contacto_cliente_clientes::find($request->id);
        $contacto->update($request->except("action"));
        return $contacto;
    }

    public function destroy(int $id)
    {
        $contacto=contacto_cliente_clientes::find($id);
        contacto_cliente_clientes::destroy($id);
        return $contacto;
    }
}
