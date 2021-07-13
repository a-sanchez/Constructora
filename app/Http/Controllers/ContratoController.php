<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\contratos_request;
use App\Models\contrato;
use App\Models\cliente;

class ContratoController extends Controller
{
    public function index()
    {
        return view('contrato.cat_contratos');

    }

    public function create()
    {
        $clientes_contrato = cliente::all();
        return view('contrato.contrato',["clientes"=>$clientes_contrato]);
    }

    public function store(contratos_request $request)
    {
        $validation=$request->validated();
        $validation["file"]=contrato::setFile($validation["file"]);
        contrato::create($validation);
        return response()->json("Contrato creado con exito",201);
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
