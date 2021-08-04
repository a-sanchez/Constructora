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
        //
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

    public function update(Request $request, ContactoClienteClientes $cliente)
    {
        //
    }

    public function destroy(ContactoClienteClientes $cliente)
    {
        //
    }
}
