<?php

namespace App\Http\Controllers;

use App\Models\proveedor;

use App\Models\orden_compra;
use Illuminate\Http\Request;
use App\Models\proveedor_contacto_ventas;
use App\Http\Requests\proveedores_request;

class proveedores extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('proveedores.cat_proveedores');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('proveedores.addproveedor');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation=$request->all();
        $prov = proveedor::create($validation);
        proveedor::contactos($prov->id,$validation['contacto_ventas']/*,$validation['contacto_pagos']*/);
        return response()->json($prov,201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $proveedor=proveedor::find($id);
        return view("proveedores.detalles_proveedores",compact("proveedor"));;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $proveedor=proveedor::find($id);
        return view("proveedores.edit_proveedores",compact("proveedor"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $proveedor=proveedor::find($id);
        $update=$proveedor->update($request->all());
        return $update;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ordenes = orden_compra::where("id_proveedor",$id)->get();
        if($ordenes->first() != NULL){
            return response()->json("Error, Existen ordenes de compra ligadas al proveedor",409);
        }
        proveedor_contacto_ventas::where("id_proveedor",$id)->delete();
        $proveedor = proveedor::find($id);
        $proveedor->delete();
    }
}
