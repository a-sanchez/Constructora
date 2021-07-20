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
require (__DIR__.'/../../../public/lib/xcrud/xcrud_1.7.15_2/xcrud/xcrud.php');
//include 'C:\Users\EVOTEK\Desktop\EVOTEK\constructora\public\lib\xcrud\xcrud_1.7.15_2\xcrud\xcrud.php'; //path to xcrud.php
//include '../public/lib/xcrud/xcrud_1.7.15_2/xcrud/xcrud.php';
$xcrud = Xcrud::get_instance(); //instantiate xCRUD
$xcrud->table('proveedores'); //employees - MySQL table name
$xcrud->table_name(' ');
$xcrud->columns('alias,razon_social,localidad,rfc');
$xcrud->unset_add();

echo $xcrud->render(); //magic
?>
@endsection