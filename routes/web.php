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
use App\Http\Controllers\ContratoController;
use App\Http\Controllers\proveedores;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ConfiguracionController;
use App\Http\Controllers\ContactoClienteClientesController;
use App\Http\Controllers\OrdenCompraController;
use App\Http\Controllers\OrdenProductoController;
use App\Http\Controllers\ProveedorContactoVentasController;
use App\Models\OrdenProducto;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/opciones', function () {
    return view('opciones');
});
#---------------------CONTRATOS--------------------------------#
Route::get('/opcion_contrato',function(){
    return view('contrato.contrato_opciones');
});

// Route::get('editar_contrato/{id}',function($id){
//     return view('contrato.contrato_editar');
// });

Route::resource('contratos',ContratoController::class);
#-----------------PROVEEDORES---------------------------------#
Route::get('/opcion_proveedores',function(){
    return view('proveedores.opcion_proveedor');
});

//Route::delete('proveedores/{id}','proveedores@destroy')->name('proveedor.destroy');

Route::resource('proveedores',proveedores::class);
#---------------------proveedores contactos------------------------------------------#
Route::resource('contacto_proveedor',ProveedorContactoVentasController::class);
#----------------CLIENTES-----------------------------#

Route::get('/clientes_opciones',function(){
    return view('clientes.clientes_opciones');
});

Route::resource('clientes',ClienteController::class);
#----------------Clientes_Contacto-----------------------------#
Route::resource('contacto_cliente', ContactoClienteClientesController::class);
#------------ORDENES DE COMPRA------------------------#
Route::get('/compras_opciones',function(){
    return view('ordenes_compras.compras_opciones');
});

/*Route::get('ordenes_compra/agregar_compra',function(){
    return view('ordenes_compras.add_compra');
});

Route::get('ordenes_compra/catalago_compra',function(){
    return view('ordenes_compras.cat_compras');
});*/
Route::resource('compras',OrdenCompraController::class);
Route::get("compras_pdf/{id}",[OrdenCompraController::class, 'OrdenPdf']);
#----------------ORDENES PRODUCTOS-----------------------------#
Route::resource('orden_productos',OrdenProductoController::class);


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

Route::get('configuracion/listado',[ConfiguracionController::class,"listado"]);

Route::resource('configuracion',ConfiguracionController::class);
#-----------------PROVEEDORES----------------------------