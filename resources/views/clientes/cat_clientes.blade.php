@extends('layouts.base_html')
@section('tittle') CLIENTES <@endsection

@section('body')
<div class="row">
    <div class="col-md-12">
        <h1 class="animate-box fadeInLeft animated" data-animate-effect="fadeInLeft">
            CLIENTES
            <div class="col-md-8 col-md-offset-2">
            <a type="button" class="btn" id="btnAgregar" href={{url('/clientes/create')}} style="background:#8d8d8d;color:white;">Nuevo Cliente</a>
            </div>
        </h1>
    </div>
</div>
<?php

//include 'C:\Users\EVOTEK\Desktop\EVOTEK\constructora\public\lib\xcrud\xcrud_1.7.15_2\xcrud\xcrud.php'; //path to xcrud.php
//include '../public/lib/xcrud/xcrud_1.7.15_2/xcrud/xcrud.php';
require (__DIR__.'/../../../public/lib/xcrud/xcrud_1.7.15_2/xcrud/xcrud.php'); // solo para localhost
//require (__DIR__.'/../../../../public_html/lib/xcrud/xcrud_1.7.15_2/xcrud/xcrud.php'); //servidor
$xcrud = Xcrud::get_instance(); //instantiate xCRUD
$xcrud->table('clientes'); //employees - MySQL table name
$xcrud->table_name(' ');
$xcrud->columns("cliente,alias,razon_social,contacto_cliente_clientes.email,contacto_cliente_clientes.telefono,contacto_cliente_clientes.area");
$xcrud->label(array('cliente'=>'RFC'));
$xcrud->label(array('contacto_cliente_clientes.email'=>'Email'));
$xcrud->label(array('contacto_cliente_clientes.telefono'=>' Telefono'));
$xcrud->label(array('contacto_cliente_clientes.area'=>' Área'));
//$xcrud->label(array('contacto_pago_clientes.email'=>'Email Contacto Pago'));
//$xcrud->label(array('contacto_pago_clientes.telefono'=>' Telefono Contacto Pago'));
$xcrud->join('id','contacto_cliente_clientes','id_cliente');
//$xcrud->join('id','contacto_pago_clientes','id_cliente');
$xcrud->unset_add();
echo $xcrud->render(); //magic
?>
@endsection
