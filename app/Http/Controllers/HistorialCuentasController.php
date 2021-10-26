<?php

namespace App\Http\Controllers;

use App\Models\add_new_cuenta;
use App\Models\create_forma_pago;
use App\Models\historial_cuentas;
use Illuminate\Http\Request;

class HistorialCuentasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cuenta=historial_cuentas::max('id')+1;
        $cuentas=historial_cuentas::all();
        return view('cuentas.historial_cuentas',compact("cuenta","cuentas"));
    }

    public function agregar(Request $request){
        $validation=$request->all();
        $cuenta=historial_cuentas::create($validation);
        return response()->json($cuenta,201);
    }

    public function nuevacuenta($id){
        $formas=create_forma_pago::all();
        $historial=historial_cuentas::find($id);
        return view('cuentas.add_cuenta',compact("formas","historial"));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validation=$request->all();
        $new_cuenta=add_new_cuenta::create($validation);
        return response()->json($new_cuenta,201);
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
     * @param  \App\Models\historial_cuentas  $historial_cuentas
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $historial=historial_cuentas::find($id);
        $formas=create_forma_pago::all();
        return view("cuentas.detalles_cuenta",compact("historial","formas"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\historial_cuentas  $historial_cuentas
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $historial=historial_cuentas::find($id);
        $formas=create_forma_pago::all();
        return view("cuentas.update_cuenta",compact("historial","formas"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\historial_cuentas  $historial_cuentas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $historial=historial_cuentas::find($id);
        $update=$historial->update($request->all());
        return $update;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\historial_cuentas  $historial_cuentas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(add_new_cuenta::where("id_costo",$id)->exists()){
            return response()->json("Error al eliminar la cuenta,contiene datos");
        }
        else{
            $cuenta=historial_cuentas::find($id);
            historial_cuentas::destroy($id);
            return $cuenta;
        }
    }
}
