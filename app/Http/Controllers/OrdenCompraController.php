<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\orden_request;
use App\Models\orden_compra;
use App\Models\OrdenProducto;
use App\Models\proveedor;
use App\Models\contrato;
use App\Models\OrdenPdf;

class OrdenCompraController extends Controller
{
    public function index()
    {
        return view('ordenes_compras.cat_compras');
    }

    public function create()
    {
    }

    public function store(orden_request $request)
    {
        $validation=$request->validated();
        $orden = orden_compra::create($validation)->id;
        $productos = orden_compra::setProductos($validation["productos"],$orden);
        return response()->json($orden,201);
    }
    public function show($id)
    {
        $provedores = proveedor::all();
        $compras_contrato=contrato::find($id);
        $ctx =[
            "contrato"=>$compras_contrato,
            "proveedores"=>$provedores
        ];
        
        return view('ordenes_compras.add_compra',$ctx);
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

    public function OrdenPdf($id)
    {
        return OrdenPdf::create($id);
    }
}
