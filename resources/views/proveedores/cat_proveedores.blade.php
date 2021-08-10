@extends('layouts.base_html')
@section('tittle') PROVEEDORES <@endsection

@section('body')

<div class="row">
    <div class="col-md-12">
        <h1 class="animate-box fadeInLeft animated" data-animate-effect="fadeInLeft">
            PROVEEDORES
            <div class="col-md-8 col-md-offset-2">
            <a type="button" class="btn" id="btnAgregar" href={{url('/proveedores/create')}} style="background:#8d8d8d;color:white;">Nuevo Proveedor</a>
            </div>
        </h1>
    </div>
</div>



<?php
//use App\public\lib\xcrud\xcrud_1.7.15_2\xcrud\xcrud.php;
require (__DIR__.'/../../../public/lib/xcrud/xcrud_1.7.15_2/xcrud/xcrud.php');// solo para localhost
//require (__DIR__.'/../../../../public_html/lib/xcrud/xcrud_1.7.15_2/xcrud/xcrud.php'); //servidor
//include 'C:\Users\EVOTEK\Desktop\EVOTEK\constructora\public\lib\xcrud\xcrud_1.7.15_2\xcrud\xcrud.php'; //path to xcrud.php
//include '../public/lib/xcrud/xcrud_1.7.15_2/xcrud/xcrud.php';
$xcrud = Xcrud::get_instance(); //instantiate xCRUD
$xcrud->table('proveedores'); //employees - MySQL table name
$xcrud->table_name(' ');
$xcrud->columns('alias,razon_social,localidad,rfc');
//$xcrud->column_name('proveedor_contacto_ventas.email','Email');
//$xcrud->column_name('proveedor_contacto_pagos.email','Email Pagos');
//$xcrud->join('id','proveedor_contacto_ventas','id_proveedor');
//$xcrud->join('id','proveedor_contacto_pagos','id_proveedor');
$xcrud->unset_add();
$xcrud->unset_view();
$xcrud->unset_edit();
$xcrud->button(asset("/proveedores/{id}"),"Detalles");
$xcrud->button(asset("/proveedores/{id}/edit"),"Editar");
echo $xcrud->render(); //magic
?>
@endsection