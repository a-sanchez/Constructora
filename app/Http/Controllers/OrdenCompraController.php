<?php

namespace App\Http\Controllers;

use App\Models\contrato;
use App\Models\OrdenPdf;
use App\Models\proveedor;
use App\Models\orden_compra;
use Illuminate\Http\Request;
use App\Models\OrdenProducto;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\orden_request;
use App\Models\pagos_proveedores;

class OrdenCompraController extends Controller
{
    public function index()
    {
        $orden=orden_compra::all();
        $contratos=contrato::all();
        $proveedores=contrato::all();
        $views = DB::table('orden_compras')
                ->select('orden_compras.id','folio_orden','solicitado','fecha_orden','fecha_entrega','descripcion_orden',
                'contratos.folio','proveedores.razon_social','estatus_facturas.status',DB::raw('SUM(orden_productos.importe) as importe_total'))
                ->leftJoin('orden_productos','orden_productos.orden_id','=','orden_compras.id')
                ->leftJoin('estatus_facturas','estatus_facturas.id',"=","orden_compras.id_status")
                ->leftJoin('contratos','contratos.id','=','orden_compras.id_contrato')
                ->leftJoin('proveedores','proveedores.id','=','orden_compras.id_proveedor')
                ->where('orden_compras.status','!=','0')
                ->groupBy('orden_compras.id')
                ->get();
         //var_dump($views->toSql());
         //die;
        return view('ordenes_compras.cat_compras',compact("orden","contratos","proveedores","views"));
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
}
