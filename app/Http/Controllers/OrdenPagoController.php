<?php

namespace App\Http\Controllers;

use App\Models\orden_compra;
use App\Models\orden_pago;
use App\Models\pagos_proveedores2;
use Illuminate\Http\Request;

class OrdenPagoController extends Controller
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
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
        $ordenes = explode(",",$request->id_orden);
        $contrato = orden_compra::find($ordenes[0])->id_contrato;
        $pagos=pagos_proveedores2::create(["id_contrato"=>$contrato]);
        foreach ($ordenes as $orden) {
            orden_pago::create(["id_orden"=>$orden,"id_pago"=>$pagos->id,"id_status"=>$request->id_status]);
        }

        return response()->json($pagos->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\orden_pago  $orden_pago
     * @return \Illuminate\Http\Response
     */
    public function show(orden_pago $orden_pago)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\orden_pago  $orden_pago
     * @return \Illuminate\Http\Response
     */
    public function edit(orden_pago $orden_pago)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\orden_pago  $orden_pago
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, orden_pago $orden_pago)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\orden_pago  $orden_pago
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
