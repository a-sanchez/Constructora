<?php

namespace App\Http\Controllers;

use App\Models\proveedor;
use Illuminate\Http\Request;
use App\Models\credito_cuentas;
use App\Models\relacion_cuentas;
use Yajra\DataTables\DataTables;
use App\Models\PDF_CUENTAS_NUEVAS;
use Illuminate\Support\Facades\DB;

class RelacionCuentasController extends Controller
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
    public function create()
    {
        //
    }

    public function vista_cuentas(){
        $proveedores = proveedor::all();
        return view("cuentas_pagar.vista_proveedores",compact("proveedores"));
    }

    public function historial($id,$ciclo){
        // $uniones = DB::select("select contratos.descripcion,proveedores.razon_social,
        // orden_productos.concepto,
        // orden_productos.cantidad,
        // pagos_proveedores.folio_factura,
        // pagos_proveedores.fecha_emision,
        // pagos_proveedores.fecha_vencimiento,
        // pagos_proveedores.total,
        // pagos_proveedores.comentarios_pagos,
        // date_format(pagos_proveedores.fecha_emision,'%Y') as ciclo,
        // date_format(pagos_proveedores.fecha_pago,'TRANSFER %d/%M/%Y') as transfer
        //  FROM constructora.orden_compras
        //  join contratos on contratos.id = orden_compras.id_contrato
        //  join orden_productos on orden_productos.orden_id = orden_compras.id
        //  join pagos_proveedores 
        //  join proveedores on proveedores.id = orden_compras.id_proveedor
        //  where id_proveedor = '$id' and date_format(pagos_proveedores.fecha_emision,'%Y') = '$ciclo'");

        $historiales = DB::select("select contratos.descripcion,proveedores.razon_social,
        orden_productos.concepto,
        orden_productos.cantidad,
        pagos_proveedores.folio_factura,
        pagos_proveedores.fecha_emision,
        pagos_proveedores.fecha_vencimiento,
        pagos_proveedores.total,
        pagos_proveedores.comentarios_pagos,
        date_format(pagos_proveedores.fecha_emision,'%Y') as ciclo,
        date_format(pagos_proveedores.fecha_pago,'TRANSFER %d/%M/%Y') as transfer
        FROM constructora.orden_compras
        join contratos on contratos.id = orden_compras.id_contrato
        join orden_productos on orden_productos.orden_id = orden_compras.id
        join pagos_proveedores 
        join proveedores on proveedores.id = orden_compras.id_proveedor
        where id_proveedor = '$id' and date_format(pagos_proveedores.fecha_emision,'%Y') = '$ciclo'
        UNION
        SELECT contratos.descripcion,proveedores.razon_social,orden_productos.concepto,orden_productos.cantidad,folio_factura,fecha_emision,fecha_vencimiento,total,comentarios_pagos,
		date_format(pagos_proveedores2s.fecha_emision,'%Y') as ciclo,
		date_format(pagos_proveedores2s.fecha_pago,'TRANSFER %d/%M/%Y') as transfer
		from pagos_proveedores2s
		inner join orden_pagos on orden_pagos.id_pago = pagos_proveedores2s.id
		inner join orden_compras on orden_compras.id = orden_pagos.id_orden
		inner join contratos on contratos.id = pagos_proveedores2s.id_contrato
		inner join orden_productos on orden_productos.orden_id = orden_pagos.id_orden
		inner join proveedores on proveedores.id = orden_compras.id_proveedor
        where id_proveedor = '$id' and date_format(pagos_proveedores2s.fecha_emision,'%Y') = '$ciclo'");
        return view('cuentas_pagar.vista_historial',compact("historiales"));
        
    }

    public function detalles($id){
        $proveedores = relacion_cuentas::where('cuenta_id',$id)->get();
        return view("cuentas_pagar.detalles",compact("proveedores"));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request){
       if (isset($request->action)) {
           $update = $this->update($request,$request->id);
           return $update;
       }
    }
    public function agregar(Request $request)
    {
        $validation = $request->all();
        $proveedores = relacion_cuentas::create($validation);
        return response()->json($proveedores,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\relacion_cuentas  $relacion_cuentas
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $proveedor = relacion_cuentas::where('cuenta_id',$id)->get();
        return Datatables::of($proveedor)->make();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\relacion_cuentas  $relacion_cuentas
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cuentas= relacion_cuentas::where('cuenta_id',$id)->get();
        $suma_monto = relacion_cuentas::setSumaMonto($id);
        $suma_programado = relacion_cuentas::setSumaProgramado($id);
        $suma_total = relacion_cuentas::setSumaTotal($id);
        return view("cuentas_pagar.editar",compact('cuentas',"id",'suma_monto','suma_total','suma_programado'));
    }


    public function PDF_CUENTAS_NUEVAS($id){
        return PDF_CUENTAS_NUEVAS::create($id);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\relacion_cuentas  $relacion_cuentas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $proveedor = relacion_cuentas::find($request->id);
        $proveedor->update($request->except("action"));
        $proveedor->setTotalTotalAttributes();
        $suma_monto = $proveedor->setSumaMonto($proveedor->cuenta_id);
        $suma_programado = $proveedor->setSumaProgramado($proveedor->cuenta_id);
        $suma_total = $proveedor->setSumaTotal($proveedor->cuenta_id);
        return compact('proveedor','suma_monto','suma_programado','suma_total');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\relacion_cuentas  $relacion_cuentas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cuenta = credito_cuentas::find($id);
        credito_cuentas::destroy($id);
        return $cuenta;
    }
}
