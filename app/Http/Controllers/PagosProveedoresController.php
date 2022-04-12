<?php

namespace App\Http\Controllers;

use App\Models\contrato;
use App\Models\orden_pago;
use App\Models\orden_compra;
use Illuminate\Http\Request;
use App\Models\create_forma_pago;
use App\Models\pagos_proveedores;
use App\Models\pagos_proveedores2;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Exists;

class PagosProveedoresController extends Controller
{
    public function index()
    {
        $operadas=pagos_proveedores::all();
        $proveedores = pagos_proveedores2::all();
    
        if($proveedores->isEmpty()){
            $views=[];
        }
        else{
        $views=DB::select ("select pagos_proveedores2s.id,folio_factura,contratos.folio as contrato,estatus_pago,
        proveedores.razon_social,fecha_emision,fecha_vencimiento,sub_total,impuestos,total,
        group_concat(orden_compras.id SEPARATOR ',') as folios,
        group_concat(orden_compras.folio_orden SEPARATOR '\n') as folio_orden, estatus_facturas.status,
        comentarios,comentarios_pagos,saldo_pendiente
        from pagos_proveedores2s
        join orden_pagos
        on pagos_proveedores2s.id = orden_pagos.id_pago
        join orden_compras
        on orden_pagos.id_orden = orden_compras.id
        join contratos
        on pagos_proveedores2s.id_contrato = contratos.id
        join estatus_facturas
        on pagos_proveedores2s.id_status = estatus_facturas.id 
        join proveedores
        on proveedores.id = orden_compras.id_proveedor
        where folio_factura <>  '' 
        group by folio_factura;"
        );}
        return view('pagos_proveedores.historial_pagos',compact('operadas','views'));
    }
    
    public function orden($id)
    {
        $orden_compra = orden_compra::find($id);
        $views = DB::table('orden_compras')
        ->select(DB::raw('((SUM(orden_productos.importe))*(orden_compras.iva/100)) as iva,(SUM(orden_productos.importe)) as importe_total'))
                ->join('orden_productos','orden_productos.orden_id','=','orden_compras.id')
                ->where('orden_compras.status','!=','0')
                ->where('orden_compras.id','=',$id)
                ->get();
                $impuestos = DB::table('orden_compras')
                ->select(DB::raw('(orden_compras.retencion_iva + orden_compras.retencion_isr) as impuesto'))
                        ->join('orden_productos','orden_productos.orden_id','=','orden_compras.id')
                        ->where('orden_compras.status','!=','0')
                        ->where('orden_compras.id','=',$id)
                        ->groupBy('orden_compras.id')
                        ->get();
        $impuesto = $views[0]->iva - $impuestos[0]->impuesto;
        $total = $views[0]->importe_total + $impuesto;
        return view("pagos_proveedores.operar",compact("orden_compra",'views','impuesto','total'));
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

    public function pagar_pendiente($id){
        $pagos=pagos_proveedores::find($id);
        $forma=create_forma_pago::all();
        return view('pagos_proveedores.pendiente_pago',compact("pagos"),["formas"=>$forma]);
    }

    public function pagar($id){
        $pagos = pagos_proveedores::find($id);
        $forma=create_forma_pago::all();
        return view('pagos_proveedores.add_pago',compact("pagos"),["formas"=>$forma]);
    }

    public function update(Request $request,$id){
        //$pagos=pagos_proveedores::find($id);
        //$update=$pagos->update($request->all());
        //return $update;
    }
    
    public function editar_pago(Request $request,$id){
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
