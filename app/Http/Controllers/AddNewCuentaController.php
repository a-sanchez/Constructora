<?php

namespace App\Http\Controllers;

use App\Models\PDF_CUENTAS;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\add_new_cuenta;
use App\Models\credito_cuentas;
use App\Models\proveedor;
use App\Models\relacion_cuentas;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class AddNewCuentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = credito_cuentas::max('id')+1;
        $vistas=credito_cuentas::all();
        return view('cuentas_pagar.cuentas_totales',compact("id","vistas"));
    }


    public function generate_cuentas($fecha1,$fecha2){

        $id = credito_cuentas::max('id');
        $from = date($fecha1);
        $to = date($fecha2);
        $cuentas = DB::select("select proveedores.razon_social, 
        estatus_facturas.status, pagos_proveedores.estatus_pago, proveedores.pagos, orden_compras.fecha_orden,orden_compras.id_status,
        sum(pagos_proveedores.total) as monto from orden_compras 
        inner join pagos_proveedores 
        on pagos_proveedores.id_orden = orden_compras.id 
        inner join proveedores on proveedores.id = orden_compras.id_proveedor
        inner join estatus_facturas on estatus_facturas.id = orden_compras.id_status 
        where (pagos_proveedores.estatus_pago = 'PENDIENTE' or pagos_proveedores.estatus_pago is null)
        and proveedores.pagos = 'CRÉDITO'
        and orden_compras.status !=0
        and orden_compras.fecha_orden between '$fecha1' and '$fecha2'
        group by proveedores.razon_social
        UNION
        Select proveedores.razon_social,estatus_facturas.status,estatus_pago,proveedores.pagos,orden_compras.fecha_orden,orden_compras.id_status,
        sum(pagos_proveedores2s.total) as monto
        from pagos_proveedores2s
        inner join orden_pagos on orden_pagos.id_pago = pagos_proveedores2s.id
        inner join orden_compras on orden_compras.id = orden_pagos.id_orden
        inner join proveedores on proveedores.id = orden_compras.id_proveedor
        inner join estatus_facturas on estatus_facturas.id = orden_compras.id_status
        where (pagos_proveedores2s.estatus_pago = 'PENDIENTE' or pagos_proveedores2s.estatus_pago is null)
        and proveedores.pagos = 'CRÉDITO'
        and orden_compras.status !=0
        and orden_compras.fecha_orden between '$fecha1' and '$fecha2'
        group by proveedores.razon_social;");
        return view('cuentas_pagar.cuentas_search',compact('cuentas','id','from','to'));
    }

    public function PDF_CUENTAS($fecha1,$fecha2){
        return PDF_CUENTAS::create($fecha1,$fecha2);
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
    
        $validation = $request->all();
        if (isset($validation["action"])){
            unset($validation["action"]);
            $this->update($validation);
            return $validation;
        }
        
        $cuentas=add_new_cuenta::create($validation)->toArray();
        
        $egr = add_new_cuenta::getEgresosAtrribute($cuentas["id_costo"])->toArray();
        $cuentas = array_merge($cuentas,["egr"=>$egr]);
        return response()->json($cuentas,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\add_new_cuenta  $add_new_cuenta
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cuentas=add_new_cuenta::where("id_costo",$id)->get();
        $ingresos_egresos=add_new_cuenta::getEgresosAtrribute($id);
        // $cuentas->merge($ingresos_egresos);

        return DataTables::of($cuentas)->addColumn("egresos",$ingresos_egresos['egresos'])->addColumn("ingresos",$ingresos_egresos['ingresos'])->make();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\add_new_cuenta  $add_new_cuenta
     * @return \Illuminate\Http\Response
     */
    public function edit(add_new_cuenta $add_new_cuenta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\add_new_cuenta  $add_new_cuenta
     * @return \Illuminate\Http\Response
     */
    public function update($request)
    {
        $historial=add_new_cuenta::find($request["id"]);
        $update=$historial->update($request);
        return $update;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\add_new_cuenta  $add_new_cuenta
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $cuenta=add_new_cuenta::find($id);
        $costo_id = $cuenta->id_costo;
        add_new_cuenta::destroy($id);
        return response()->json(add_new_cuenta::getEgresosAtrribute($costo_id),200);
    }
}
