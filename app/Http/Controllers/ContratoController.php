<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\contratos_request;
use App\Models\contrato;
use App\Models\cliente;
use App\Models\orden_compra;

class ContratoController extends Controller
{
    public function index()
    {
        $contratos=contrato::all();
        return view('contrato.cat_contratos',compact('contratos'));

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
        $contrato = contrato::find($id);
        //var_dump($contrato->cliente->razon_social);
        return view("contrato.contrato_detalle",compact("contrato"));
    }

    public function edit($id)
    {
        $contrato=contrato::find($id);
        return view("contrato.contrato_editar",compact("contrato"));

    }

    public function update(Request $request, $id)
    {
        $contrato=contrato::find($id);
        $update=$contrato->update($request->all());
        return $update;
    }

    public function destroy($id)
    {
        if (orden_compra::where("id_contrato",$id)){
            return response()->json("Error al eliminar el contrato,contiene orden de compra",409);
        }
        else{
        $contrato = contrato::find($id);
        contrato::destroy($id);
        return $contrato;
    }
    }
}
