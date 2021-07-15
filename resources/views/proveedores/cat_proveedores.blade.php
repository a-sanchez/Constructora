@extends('layouts.base_html')
@section('tittle') CONTRATOS <@endsection

@section('body')


<?php
//use App\public\lib\xcrud\xcrud_1.7.15_2\xcrud\xcrud.php;
require (__DIR__.'/../../../public/lib/xcrud/xcrud_1.7.15_2/xcrud/xcrud.php');
//include 'C:\Users\EVOTEK\Desktop\EVOTEK\constructora\public\lib\xcrud\xcrud_1.7.15_2\xcrud\xcrud.php'; //path to xcrud.php
//include '../public/lib/xcrud/xcrud_1.7.15_2/xcrud/xcrud.php';
$xcrud = Xcrud::get_instance(); //instantiate xCRUD
$xcrud->table('proveedores'); //employees - MySQL table name
$xcrud->columns('alias,razon_social,localidad,rfc,telefono,email');

echo $xcrud->render(); //magic
?>
@endsection