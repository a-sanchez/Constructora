<?php

namespace App\Http\Controllers;

use App\Models\cliente;
use App\Models\factura;
use App\Models\contrato;
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
        return view('facturas.facturar');
    }

    public function store(Request $request)
    {
        //
    }
    public function show($id)
    {
        $contrato=contrato::find($id);
        $prefactura=factura::max('numero_factura')+1;
        $ctx=[
            "folio_prefactura"=>str_pad($prefactura."/".date("Y"),10,"0",STR_PAD_LEFT)
        ];
        return view('facturas.addfacturas',compact('contrato'),$ctx);
    }

    public function pagar(){
        return view('facturas.pagar');
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        
        //
    }

    public function destroy($id)
    {   
        //
    }


}
