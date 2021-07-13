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

//$xcrud->relation("id_contrato","contratos","id","contrato");
//$xcrud->columns("id_cliente,nombre_contraparte,folio,descripcion");
$xcrud->button('http://example.com','PDF',false,"",array('target'=>'_blank'));

echo $xcrud->render(); //magic
?>
@endsection