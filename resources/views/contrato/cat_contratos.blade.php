@extends('layouts.base_html')
@section('tittle') CONTRATOS <@endsection

@section('body')
<?php

//include 'C:\Users\EVOTEK\Desktop\EVOTEK\constructora\public\lib\xcrud\xcrud_1.7.15_2\xcrud\xcrud.php'; //path to xcrud.php
include '../public/lib/xcrud/xcrud_1.7.15_2/xcrud/xcrud.php';
$xcrud = Xcrud::get_instance(); //instantiate xCRUD
$xcrud->table('contratos'); //employees - MySQL table name

echo $xcrud->render(); //magic
?>
@endsection
