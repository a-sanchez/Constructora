<?php

namespace App\Http\Controllers;

use App\Models\pagos_proveedores;
use Illuminate\Http\Request;

class PagosProveedoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pagos_proveedores.historial_pagos');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pagos_proveedores.add_pago');    
    }

    public function detalles_pago(){
        return view('pagos_proveedores.detalles_pago');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pagos_proveedores  $pagos_proveedores
     * @return \Illuminate\Http\Response
     */
    public function show(Request $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pagos_proveedores  $pagos_proveedores
     * @return \Illuminate\Http\Response
     */
    public function edit(pagos_proveedores $pagos_proveedores)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\pagos_proveedores  $pagos_proveedores
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, pagos_proveedores $pagos_proveedores)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pagos_proveedores  $pagos_proveedores
     * @return \Illuminate\Http\Response
     */
    public function destroy(pagos_proveedores $pagos_proveedores)
    {
        //
    }
}
