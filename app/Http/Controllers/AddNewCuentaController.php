<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\add_new_cuenta;
use Yajra\DataTables\DataTables;

class AddNewCuentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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

        $cuentas=add_new_cuenta::create($validation);
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
        return DataTables::of($cuentas)->make();
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
        add_new_cuenta::destroy($id);
        return $cuenta;
    }
}
