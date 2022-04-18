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

use App\Http\Controllers\AddNewCuentaController;
use App\Models\OrdenProducto;
use App\Http\Controllers\proveedores;
use App\Http\Controllers\usercontroller;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\ContratoController;
use App\Http\Controllers\PermisosController;
use phpDocumentor\Reflection\Types\Resource_;
use App\Http\Controllers\OrdenCompraController;
use App\Http\Controllers\ConfiguracionController;
use App\Http\Controllers\OrdenProductoController;
use App\Http\Controllers\HistorialCuentasController;
use App\Http\Controllers\PagosProveedoresController;
use App\Http\Controllers\ContactoClienteClientesController;
use App\Http\Controllers\CreditoCuentasController;
use App\Http\Controllers\OrdenPagoController;
use App\Http\Controllers\PagosProveedores2Controller;
use App\Http\Controllers\ProveedorContactoVentasController;
use App\Http\Controllers\RelacionCuentasController;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/opciones', function () {
//     return view('opciones');
// });

Route::get('/', [usercontroller::class,"index"])->name("login");
Route::post('/login', [usercontroller::class,"inicioSesion"]);

Route::post('/compras/actualizar/{id}',[OrdenCompraController::class,"actualizar"]);
Route::group(['middleware'=>['auth']],function(){

Route::get('/salir',[usercontroller::class,"salir"]);
#---------------------CONTRATOS--------------------------------#
Route::get('/opcion_contrato',function(){
    return view('contrato.contrato_opciones');
});

// Route::get('editar_contrato/{id}',function($id){
//     return view('contrato.contrato_editar');
// });
Route::delete('contratos/eliminar1/{id}/{file}', [ContratoController::class,"eliminar1"]);
Route::delete('contratos/eliminar2/{id}/{file2}', [ContratoController::class,"eliminar2"]);
Route::delete('contratos/eliminar3/{id}/{file3}', [ContratoController::class,"eliminar3"]);
Route::delete('contratos/eliminar/{id}/{file4}', [ContratoController::class,"eliminar"]);
Route::post('contratos/actualizar/{id}',[ContratoController::class,'actualizar']);
Route::post('contratos/update/{id}',[ContratoController::class,'actualizar_contrato']);
Route::resource('contratos',ContratoController::class);
#-----------------PROVEEDORES---------------------------------#
Route::get('/opcion_proveedores',function(){
    return view('proveedores.opcion_proveedor');
});

//Route::delete('proveedores/{id}','proveedores@destroy')->name('proveedor.destroy');
Route::post('proveedores/editar_proveedor/{id}',[proveedores::class,'editar_proveedor']);
Route::resource('proveedores',proveedores::class);
#---------------------proveedores contactos------------------------------------------#
Route::resource('contacto_proveedor',ProveedorContactoVentasController::class);
#----------------CLIENTES-----------------------------#

Route::get('/clientes_opciones',function(){
    return view('clientes.clientes_opciones');
});
Route::post('/clientes/actualizar/{id}',[ClienteController::class,'actualizar']);
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
//Route::get("compras/orden/{id}",[OrdenCompraController::class,'orden']);

Route::get('compras/reporte',[OrdenCompraController::class,'reporte']);

//Route::get('compras/generar',function(){
//    dd("hola");


Route::get('contrato/{id_contrato}/estatus/{id_status}/fecha/{fecha1}/fecha/{fecha2}/REPORTE',[OrdenCompraController::class,'generar_reporte']);
//Route::resource('compras',OrdenCompraController::class);
Route::get("compras_pdf/{id}",[OrdenCompraController::class, 'OrdenPdf']);
#----------------ORDENES PRODUCTOS-----------------------------#
Route::resource('orden_productos',OrdenProductoController::class);


#----------------FACTURAS------------------------------#

// Route::get('facturas/registro_factura',function(){
//     return view('facturas.registro_factura');
// });
Route::get('facturas/pagar/{id}',[FacturaController::class,'pagar']);
Route::get("prefacturas_pdf/{id}",[FacturaController::class,'PrefacturaPDF']);

Route::post("facturas/actualizar_factura/{id}",[FacturaController::class,'actualizar_factura']);



Route::post("facturas/actualizar/{id}",[FacturaController::class,'actualizar']);
Route::get("facturas/editar/{id}",[FacturaController::class,'editar']);
Route::get("facturas/detalles_pago/{id}",[FacturaController::class,'detalles_pago']);
Route::resource('facturas',FacturaController::class);
#----------------PAGOS---------------------------------#

Route::get('pagos_proveedores/pagar/{id}',[PagosProveedoresController::class,'pagar']);
Route::get('pagos_proveedores/pagar_pendiente/{id}',[PagosProveedoresController::class,'pagar_pendiente']);
Route::get('pagos_proveedores/detalles_pago/{id}',[PagosProveedoresController::class,"detalles_pago"]);
Route::get("pagos_proveedores/orden/{id}",[PagosProveedoresController::class,'orden']);
Route::post("pagos_proveedores/orden/",[PagosProveedoresController::class,'new_orden']);
Route::get("pagos_proveedores/detalles/{id}",[PagosProveedoresController::class,'detalles']);
Route::post("pagos_proveedores/editar_pago/{id}",[PagosProveedoresController::class,'editar_pago']);

#-----------------CONFIGURACION-----------------------#

Route::get('configuracion/listado',[ConfiguracionController::class,"listado"]);

Route::resource('configuracion',ConfiguracionController::class);

});
#-----------------PERMISOS--------------------------------------#

Route::post('permisos/remove', [PermisosController::class,"removePermisos"]);
Route::resource('permisos',PermisosController::class);


#------////MODULO DE ALBA CUENTAS POR PAGAR Y FLUJO DIARIO
#----------------FLUJO DIARIO-----------------------------------#
Route::post('cuentas/agregar',[HistorialCuentasController::class,"agregar"]);
Route::get('cuentas/costo/{id}',[HistorialCuentasController::class,"nuevacuenta"]);
Route::get('cuentas/update_vista',[HistorialCuentasController::class,"update_vista"]);
Route::post('/cuentas/editar_cuenta/{id}',[HistorialCuentasController::class,"editar_cuenta"]);
Route::get('cuentas/detalles',[HistorialCuentasController::class,"detalles"]);
Route::resource('cuentas', HistorialCuentasController::class);

Route::get("flujo_diarioPDF/{id}",[HistorialCuentasController::class,'flujo_diarioPDF']);
Route::get('fecha/{fecha1}/fecha/{fecha2}/{id}/Cuentas_Pagar',[AddNewCuentaController::class,'generate_cuentas']);
Route::get("pdf_cuentas/{fecha1}/{fecha2}",[AddNewCuentaController::class,'PDF_CUENTAS']);
Route::resource('nuevas_cuentas', AddNewCuentaController::class);

/*---------------*CUENTAS POR PROVEEDOR = CREDITO ----------------*/

Route::post('credito_cuentas/agregar',[CreditoCuentasController::class,"agregar_id"]);
Route::resource('credito_cuentas', CreditoCuentasController::class);

Route::post('relacion_cuentas/agregar',[RelacionCuentasController::class,"agregar"]);
Route::get('relacion_cuentas/detalles/{id}',[RelacionCuentasController::class,"detalles"]);
Route::get("pdf_cuentas_nuevas/{id}",[RelacionCuentasController::class,"PDF_CUENTAS_NUEVAS"]);
Route::get("relacion_cuentas/proveedores",[RelacionCuentasController::class,"vista_cuentas"]);
Route::get("proveedor/{id}/ciclo/{ciclo}/historial",[RelacionCuentasController::class,"historial"]);
Route::resource('relacion_cuentas', RelacionCuentasController::class);

#----------------ORDEN_PAGO---------------------------------------#

Route::resource('orden_pago',OrdenPagoController::class);
Route::get("pagos_proveedores2/detalles/{id}",[PagosProveedores2Controller::class,'detalles']);
Route::get("pagos_proveedores2/pagar/{id}",[PagosProveedores2Controller::class,'pagar']);
Route::get('pagos_proveedores2/pagar_pendiente/{id}',[PagosProveedores2Controller::class,'pagar_pendiente']);
Route::post('pagos_proveedores2/editar_pago/{id}', [PagosProveedores2Controller::class,'editar_pago']);
//});
Route::resource('/compras',OrdenCompraController::class);
Route::resource('pagos_proveedores2', PagosProveedores2Controller::class);
Route::resource('pagos_proveedores',PagosProveedoresController::class);