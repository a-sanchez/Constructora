@extends('layouts.base_html')
@section('tittle') CONTRATOS <@endsection

@section('body')
<?php

//include 'C:\Users\EVOTEK\Desktop\EVOTEK\constructora\public\lib\xcrud\xcrud_1.7.15_2\xcrud\xcrud.php'; //path to xcrud.php
//include '../public/lib/xcrud/xcrud_1.7.15_2/xcrud/xcrud.php';
require (__DIR__.'/../../../public/lib/xcrud/xcrud_1.7.15_2/xcrud/xcrud.php');
$xcrud = Xcrud::get_instance(); //instantiate xCRUD
$xcrud->table('orden_compras'); //employees - MySQL table name
$xcrud->change_type('fecha','date');


$xcrud->columns("folio_orden,solicitado,fecha_orden,fecha_entrega,descripcion_orden,id_contrato,id_proveedor");
$xcrud->relation('id_proveedor','proveedores','id', 'razon_social');
$xcrud->relation("id_contrato","contratos","id","folio");
//$xcrud->button('http://example.com','EXCEL',false,"",array('target'=>'_blank'));
$xcrud->button(/*asset("/storage/docs/ordenes_adjuntos/{adjunto_compra}")*/"#",'EXCEL',false,"P");
$xcrud->unset_add();


echo $xcrud->render(); //magic
?>
@endsection