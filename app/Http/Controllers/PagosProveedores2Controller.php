<?php

namespace App\Http\Controllers;

use App\Models\orden_pago;
use Illuminate\Http\Request;
use App\Models\create_forma_pago;
use App\Models\pagos_proveedores2;

class PagosProveedores2Controller extends Controller
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pagos_proveedores2  $pagos_proveedores2
     * @return \Illuminate\Http\Response
     */
    public function show(pagos_proveedores2 $pagos_proveedores2)
    {
        //
    }
    public function pagar($id){
        $pagos = pagos_proveedores2::find($id);
        $forma=create_forma_pago::all();
        return view('pagos_proveedores.add_pago',compact("pagos"),["formas"=>$forma]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pagos_proveedores2  $pagos_proveedores2
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $operar=pagos_proveedores2::find($id);
        $ordenes = orden_pago::where("id_pago",$id)->get();
        return view("pagos_proveedores.operar_grupal",compact("operar","ordenes"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\pagos_proveedores2  $pagos_proveedores2
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $operar=pagos_proveedores2::find($id);
        $update=$operar->update($request->all());
        return $update;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pagos_proveedores2  $pagos_proveedores2
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pagos = pagos_proveedores2::find($id);
        pagos_proveedores2::destroy($id);
        return $pagos;
    }
}
