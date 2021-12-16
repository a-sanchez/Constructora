<?php

namespace App\Http\Controllers;

use App\Models\credito_cuentas;
use App\Models\relacion_cuentas;
use Illuminate\Http\Request;

class CreditoCuentasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function agregar_id(Request $request){
        $validation=$request->all();
        $cuenta=credito_cuentas::create($validation);
        return response()->json($cuenta,201);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\credito_cuentas  $credito_cuentas
     * @return \Illuminate\Http\Response
     */
    public function show(credito_cuentas $credito_cuentas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\credito_cuentas  $credito_cuentas
     * @return \Illuminate\Http\Response
     */
    public function edit(credito_cuentas $credito_cuentas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\credito_cuentas  $credito_cuentas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, credito_cuentas $credito_cuentas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\credito_cuentas  $credito_cuentas
     * @return \Illuminate\Http\Response
     */
    public function destroy(credito_cuentas $credito_cuentas)
    {
        //
    }
}
