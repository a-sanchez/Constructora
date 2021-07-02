<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/opciones', function () {
    return view('opciones');
});
#---------------------CONTRATOS--------------------------------#
Route::get('/contrato',function(){
    return view('contrato.contrato_opciones');
});

Route::get('contrato/contrato_agregar',function(){
    return view('contrato.contrato');
});

Route::get('contrato/cat_contratos',function(){
    return view('contrato.cat_contratos');
});
#-----------------PROVEEDORES---------------------------------#
Route::get('/proveedores',function(){
    return view('proveedores.opcion_proveedor');
});

Route::get('proveedores/addproveedor',function(){
    return view('proveedores.addproveedor');
});

Route::get('proveedores/cat_proveedores',function(){
    return view('proveedores.cat_proveedores');
});
#----------------FACTURAS------------------------------#

Route::get('/facturas',function(){
    return view('facturas.facturas_opciones');
});

Route::get('facturas/addfacturas',function(){
    return view('facturas.addfacturas');
});

Route::get('facturas/cat_facturas',function(){
    return view('facturas.cat_facturas');
});
#----------------PAGOS---------------------------------#

Route::get('/pagos',function(){
    return view('pagos.opciones_pago');
});

Route::get('pagos/realizapago',function(){
    return view('pagos.realizapago');
});

Route::get('pagos/historial_pagos',function(){
    return view('pagos.historial_pagos');
});

#-----------------CONFIGURACION-----------------------#

Route::get('/configuracion',function(){
    return view('configuracion.conf_opciones');
});