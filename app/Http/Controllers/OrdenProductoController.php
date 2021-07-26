<?php

namespace App\Http\Controllers;

use App\Models\OrdenProducto;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class OrdenProductoController extends Controller
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
        if (isset($request->action)) {
            $update = $this->update($request);
            return $update;
        }
        $producto = $request->all();
        var_dump($request->all());
        $producto["importe"] = floatval($request->cantidad * $request->precio_unitario);
        $producto = OrdenProducto::create($producto);
        return $producto;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $productos = OrdenProducto::where("orden_id",$id)->get();
        return Datatables::of($productos)->make();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrdenProducto  $ordenProducto
     * @return \Illuminate\Http\Response
     */
    public function edit(OrdenProducto $ordenProducto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $producto = OrdenProducto::find($request->id);
        $producto->update($request->except("action"));
        $producto->setImporte();
        return $producto;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $producto = OrdenProducto::find($id);
        OrdenProducto::destroy($id);
        return $producto;
    }
}
