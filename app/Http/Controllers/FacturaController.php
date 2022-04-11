<?php

namespace App\Http\Controllers;

use App\Models\status;
use App\Models\cliente;
use App\Models\factura;
use App\Models\contrato;
use App\Models\create_forma_pago;
use App\Models\prefacturaPdf;
use Illuminate\Http\Request;

class FacturaController extends Controller
{
    public function index()
    {
        $pre_facturas=factura::all();
        return view('facturas.cat_facturas',compact('pre_facturas'));
    }
    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $validation=$request->all();
        $prefacturas=factura::create($validation);
        return response()->json($prefacturas,201);
    }
    public function show($id)
    {
        $contrato=contrato::find($id);
        $prefactura=factura::max('id')+1;
            $ctx=[
                "folio_prefactura"=>str_pad($prefactura."/".date("Y"),10,"0",STR_PAD_LEFT)
        ];
        return view('facturas.addfacturas',compact('contrato'),$ctx);
    }

    public function pagar($id){
        $prefactura=factura::find($id);
        $forma=create_forma_pago::all();
        return view('facturas.pagar',compact("prefactura"),["formas"=>$forma]);
    }

    public function detalles_pago($id){
        $prefactura=factura::find($id);
        return view("facturas.pago_detalle",compact("prefactura"));
    }


    public function edit($id)
    {
        $prefactura=factura::find($id);
        $contrato=contrato::find($id);
        return view('facturas.facturar',compact("prefactura"));
    }


    public function update(Request $request, $id)
    {
        //$prefactura=factura::find($id);
        //$update=$prefactura->update($request->all());
        //return $update;
    }
    public function actualizar_factura(Request $request, $id)
    { 
        var_dump($id);die;
        $prefactura=factura::find($id);
        $update=$prefactura->update($request->all());
        return $update;
    }

    public function editar($id){
        $prefactura=factura::find($id);
        return view('facturas.editarfacturas',compact("prefactura"));
    }

    public function actualizar(Request $request,$id){
        $prefactura=factura::find($id);
        switch($request->file){
            case 'pdf_oficial':
                $prefactura->setFile($request->file_info);
                break;
            case 'xml_oficial':
                $prefactura->setFile2($request->file_info);
                break;
        }

    }
        
    public function destroy($id)
    {   $factura = factura::find($id);
        if($factura->id_status==3){
            return response()->json("ERROR,Existen pagos en esta factura",409);
        }
        else{
            $factura = factura::find($id);
            factura::destroy($id);
            return $factura;
        }
    }

    public function PrefacturaPDF($id)
    {
        return prefacturaPdf::create($id);
    }


}
