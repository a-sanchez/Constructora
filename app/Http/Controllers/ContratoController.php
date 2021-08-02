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

    public function store(Request $request)
    {
        $validation=$request->all();
        $contrato = contrato::create($validation);

        if (isset($request["file"])) {
           $contrato->setFile($validation["file"]);
        }
        if (isset($request["file2"])) {
            $contrato->setFile2($validation["file2"]);
        }
        if (isset($request["file3"])) {
            $contrato->setFile3($validation["file3"]);
        }
        if (isset($request["file4"])) {
            $contrato->setFile4($validation["file4"]);
        }

        // if (isset($request["file3"])) {
        //     $contrato->setFile($validation["file3"]);
        // }

        // if (isset($request["file4"])) {
        //     $contrato->setFile($validation["file4"]);
        // }
        
        return response()->json("Contrato creado con exito",201);
    }

    public function show($id)
    {
        $contrato = contrato::find(2);
        $ruta = $contrato->getRuta();
        var_dump($ruta);
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
