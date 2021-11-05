<?php

namespace App\Http\Controllers;

use App\Models\status;
use App\Models\contrato;
use App\Models\OrdenPdf;
use App\Models\proveedor;
use App\Models\REPORTEPDF;
use App\Models\orden_compra;
use Illuminate\Http\Request;
use App\Models\OrdenProducto;
use App\Models\pagos_proveedores;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\orden_request;
use App\Models\orden_pago;
use App\Models\pagos_proveedores2;
use Illuminate\View\ViewServiceProvider;

class OrdenCompraController extends Controller
{
    public function index()
    {
        $orden=orden_compra::all();
        $contratos=contrato::all();
        $proveedores=contrato::all();
        $pagos=pagos_proveedores2::max('id')+1;
        $views = DB::table('orden_compras')
                ->select('orden_compras.id','folio_orden','solicitado','iva','fecha_orden','contratos.costo','fecha_entrega','descripcion_orden',
                'contratos.folio','proveedores.razon_social','estatus_facturas.status',DB::raw('(SUM(orden_productos.importe)*(iva/100))+(SUM(orden_productos.importe)) as importe_total'))
                ->leftJoin('orden_productos','orden_productos.orden_id','=','orden_compras.id')
                ->leftJoin('estatus_facturas','estatus_facturas.id',"=","orden_compras.id_status")
                ->leftJoin('contratos','contratos.id','=','orden_compras.id_contrato')
                ->leftJoin('proveedores','proveedores.id','=','orden_compras.id_proveedor')
                ->where('orden_compras.status','!=','0')
                ->groupBy('orden_compras.id')
                ->get();
          //$views->dump();
          //die;
        //  dump($pagos);
        //  die;
        return view('ordenes_compras.cat_compras',compact("orden","contratos","proveedores","views","pagos"));
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        $validation=$request->all();
        $orden = orden_compra::create($validation);
        $productos = orden_compra::setProductos($validation["productos"],$orden->id);
        return response()->json($orden,201);
    }
    public function show($id)
    {
        $provedores = proveedor::all();
        $compras_contrato=contrato::find($id);
        $orden=orden_compra::max('id')+1;
        $ctx =[
            "contrato"=>$compras_contrato,
            "proveedores"=>$provedores,
            "folio_orden"=>str_pad($orden."/".date("Y"),10,"0",STR_PAD_LEFT) 
        ];

        return view('ordenes_compras.add_compra',$ctx);
    }


    public function edit($id)
    {
        $orden_compra = orden_compra::find($id);
        return view("ordenes_compras.edit_compra",compact("orden_compra"));
    }

    public function update(Request $request, $id)
    {   
        $operada = pagos_proveedores::where('id_orden',$id)->get();
        if($operada->first()!=NULL){
            return response()->json('Error, esta orden ya tiene registros en pagos proveedores',409);
        }
        else{
        $orden_compra = orden_compra::find($id);
        $update = $orden_compra->update($request->all());
        return $update;
        }
    }

    public function destroy($id)
    {//
    }

  

    public function OrdenPdf($id)
    {
        return OrdenPdf::create($id);
    }


    public function reporte(){
        $proveedores = DB::select("select `razon_social` ,`proveedores`.`id` ,`proveedores`.`rfc`
        from 		`proveedores` 
        left join 	`orden_compras` on `orden_compras`.`id_proveedor` = `proveedores`.`id` 
        where 		`orden_compras`.`id_proveedor` = `proveedores`.`id` 
        group by `razon_social`");
        $contratos = DB::select("select `folio`,`contratos`.`id` 
        from 		`contratos` 
        left join 	`orden_compras` on `orden_compras`.`id_contrato` = `contratos`.`id` 
        where 		`orden_compras`.`id_contrato` = `contratos`.`id`
        group by `folio`;");
        $estatus=status::all();
        return view('ordenes_compras.reporte',compact("proveedores","contratos","estatus"));
    }
    public function generar_reporte($id_proveedor, $id_contrato,$id_status){
        $proveedores=proveedor::all();
        if ($id_status == 0 and $id_contrato!=0) {
            $views = DB::table('orden_compras')
        ->select('folio_orden','fecha_orden','fecha_entrega','descripcion_orden','solicitado','contratos.folio as folio','proveedores.razon_social as razon_social','estatus_facturas.status','observaciones','vobo','autorizacion','iva')
        ->leftJoin('estatus_facturas','estatus_facturas.id',"=","orden_compras.id_status")
        ->leftJoin('contratos','contratos.id','=','orden_compras.id_contrato')
        ->leftJoin('proveedores','proveedores.id','=','orden_compras.id_proveedor')
        ->where('id_contrato','=',$id_contrato)
        ->where('id_proveedor','=',$id_proveedor)
        ->get();
        //return view('ordenes_compras.reportePDF',compact('views'));
        REPORTEPDF::create($id_proveedor, $id_contrato,$id_status,$views,$proveedores);
        }
        elseif ($id_status==0 && $id_contrato==0) {
            $views=DB::select("select folio_orden,fecha_orden,fecha_entrega,descripcion_orden,solicitado,contratos.folio as folio,
            proveedores.razon_social as razon_social,estatus_facturas.status,observaciones
            from orden_compras
            left join estatus_facturas on estatus_facturas.id = orden_compras.id_status
            left join contratos on contratos.id = orden_compras.id_contrato
            left join proveedores on proveedores.id = orden_compras.id_proveedor
            where id_proveedor = $id_proveedor");

            REPORTEPDF::create($id_proveedor, $id_contrato,$id_status,$views,$proveedores);
        }
        elseif ($id_status!=0 && $id_contrato==0) {
            $views=DB::select("select folio_orden,fecha_orden,fecha_entrega,descripcion_orden,solicitado,contratos.folio as folio,
            proveedores.razon_social as razon_social,estatus_facturas.status,observaciones
            from orden_compras
            left join estatus_facturas on estatus_facturas.id = orden_compras.id_status
            left join contratos on contratos.id = orden_compras.id_contrato
            left join proveedores on proveedores.id = orden_compras.id_proveedor
            where id_proveedor = $id_proveedor and id_status=$id_status");

            REPORTEPDF::create($id_proveedor, $id_contrato,$id_status,$views,$proveedores);
        }
        else{
            $views = DB::table('orden_compras')
        ->select('folio_orden','fecha_orden','fecha_entrega','descripcion_orden','solicitado','contratos.folio','proveedores.razon_social','estatus_facturas.status','observaciones','vobo','autorizacion','iva')
        ->leftJoin('estatus_facturas','estatus_facturas.id',"=","orden_compras.id_status")
        ->leftJoin('contratos','contratos.id','=','orden_compras.id_contrato')
        ->leftJoin('proveedores','proveedores.id','=','orden_compras.id_proveedor')
        ->where('id_contrato','=',$id_contrato)
        ->where('id_proveedor','=',$id_proveedor)
        ->where('id_status','=',$id_status)
        ->get();
        //return  view('ordenes_compras.reportePDF',compact('views'));
        REPORTEPDF::create($id_proveedor, $id_contrato,$id_status, $views,$proveedores);
        }

        

    }

    


}
