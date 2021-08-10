<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\proveedor_contacto_ventas;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
class ProveedorContactoVentasController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        if(isset($request->action)){
            $update=$this->update($request);
            return $update;
        }
        $contacto=proveedor_contacto_ventas::create($request->all());
        return $contacto;
    }


    public function show($id)
    {
        $proveedor=proveedor_contacto_ventas::where("id_proveedor",$id)->get();
        return DataTables::of($proveedor)->make();
    }

    public function edit(proveedor_contacto_ventas $proveedor)
    {
        //
    }

    public function update(Request $request)
    {
        $contacto=proveedor_contacto_ventas::find($request->id);
        $contacto->update($request->except("action"));
        return $contacto;
    }

    public function destroy(int $id)
    {
        // $contacto=proveedor_contacto_ventas::find($id);
        // proveedor_contacto_ventas::destroy($id);
        // return $contacto;
    }
}
