<?php

namespace App\Http\Controllers;

use App\Models\contrato;
use App\Models\orden_compra;
use Illuminate\Http\Request;
use App\Models\create_forma_pago;
use App\Models\pagos_proveedores;

class PagosProveedoresController extends Controller
{
    public function index()
    {
        $operadas=pagos_proveedores::all();
        return view('pagos_proveedores.historial_pagos',compact('operadas'));
    }
    public function orden($id)
    {
        $orden_compra = orden_compra::find($id);
        return view("pagos_proveedores.operar",compact("orden_compra"));
    }

    public function operar_grupal(){
        return view("pagos_proveedores.operar_grupal");
    }

    //agregar validation al crear
    public function new_orden(Request $request)
    {
        $proveedor_pago = pagos_proveedores::create($request->all());
        return ($proveedor_pago);
    }

    public function create(){
       
       // $formas=create_forma_pago::all();
        //return view('pagos_proveedores.add_pago',compact('formas'));    
    }

    public function pagar($id){
        $pagos = pagos_proveedores::find($id);
        $forma=create_forma_pago::all();
        return view('pagos_proveedores.add_pago',compact("pagos"),["formas"=>$forma]);
    }

    public function update(Request $request,$id)
    {
       
        $pagos=pagos_proveedores::find($id);
        $update=$pagos->update($request->all());
        return $update;
    }

    public function detalles($id){
        $pagos=pagos_proveedores::find($id);
        return view('pagos_proveedores.detalles_pago',compact("pagos"));
    }

    public function store(Request $request)
    {
        // $proveedor_pago = pagos_proveedores::find($id);
        // return ($proveedor_pago);
    }

    public function show(Request $id)
    {
       $contrato=contrato::find($id);
       $orden=orden_compra::find($id);
       return view ('pagos_proveedores.operar',compact('contrato'),compact('orden'));
        
    }
    public function edit(pagos_proveedores $pagos_proveedores)
    {
        //
    }

    
    public function destroy($id)
    {
        $pagos = pagos_proveedores::find($id);
        pagos_proveedores::destroy($id);
        return $pagos;
    }
}
