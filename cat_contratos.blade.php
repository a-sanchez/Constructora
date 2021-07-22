@extends('layouts.base_html')
@section('tittle') CONTRATOS <@endsection

@section('body')
<div class="row">
    <div class="col-md-12">
        <h1 class="animate-box fadeInLeft animated" data-animate-effect="fadeInLeft">
            CONTRATOS
        </h1>
        <hr style="color: orange;">
    </div>
</div>
<a type="button" class="btn" id="btnAgregar" href={{url('/contratos/create')}} style="background:#8d8d8d;color:white;">Nuevo Contrato</a>
<p></p>
@php
require (__DIR__.'/../../../../public_html/lib/xcrud/xcrud_1.7.15_2/xcrud/xcrud.php');
$xcrud = Xcrud::get_instance(); //instantiate xCRUD
$xcrud->table('contratos'); //employees - MySQL table name
$xcrud->change_type('fecha','date');

$xcrud->relation("id_cliente","clientes","id","cliente");
$xcrud->columns("id_cliente,nombre_contraparte,folio,descripcion");

$xcrud->button(asset("/storage/docs/contrato_adjuntos/{file}"),'PDF',false,"P",array('target'=>'_blank'));
$xcrud->button(url("compras/{id}"),'Orden de Compra',false,"P");
$xcrud->unset_add();
$xcrud -> unset_title ();
echo $xcrud->render(); //magic
@endphp
@endsection
