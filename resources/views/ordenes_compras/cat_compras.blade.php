@extends('layouts.base_html')
@section('tittle') ORDENES DE COMPRA <@endsection

@section('body')
<div class="row">
    <div class="col-md-12">
        <h1 class="animate-box fadeInLeft animated" data-animate-effect="fadeInLeft">
            ORDENES DE COMPRA
        </h1>
    </div>
</div>

<?php
//include 'C:\Users\EVOTEK\Desktop\EVOTEK\constructora\public\lib\xcrud\xcrud_1.7.15_2\xcrud\xcrud.php'; //path to xcrud.php
//include '../public/lib/xcrud/xcrud_1.7.15_2/xcrud/xcrud.php';
require (__DIR__.'/../../../public/lib/xcrud/xcrud_1.7.15_2/xcrud/xcrud.php');// solo para localhost
//require (__DIR__.'/../../../../public_html/lib/xcrud/xcrud_1.7.15_2/xcrud/xcrud.php'); //servidor
$xcrud = Xcrud::get_instance(); //instantiate xCRUD
// $xcrud->table('orden_compras'); //employees - MySQL table name
//$xcrud->change_type('fecha','date');



// $xcrud->columns("folio_orden,solicitado,fecha_orden,fecha_entrega,descripcion_orden,id_contrato,id_proveedor");
// $xcrud->relation('id_proveedor','proveedores','id', 'razon_social');
// $xcrud->relation("id_contrato","contratos","id","folio");
// $xcrud->column_name('id_contrato','Contrato');
// $xcrud->column_name('id_proveedor','Proveedor');
//$xcrud->button('http://example.com','EXCEL',false,"",array('target'=>'_blank'));
$xcrud->query('select oc.id as N°,folio_orden,solicitado,fecha_orden,fecha_entrega,descripcion_orden,c.folio as Contrato,p.razon_social as Proveedor,importe_total as "Importe_Total_(sin IVA)"
from constructora.orden_compras oc
join (SELECT orden_id,sum(importe) as importe_total  from constructora.orden_productos  group by orden_id) as op
ON op.orden_id=oc.id
left join constructora.contratos c
on c.id = oc.id_contrato
left join constructora.proveedores p
on   p.id=oc.id_proveedor');
$xcrud->button(URL::to('compras_pdf/{N°}'),'PDF',false,"P",array('target'=>'_blank'));
$xcrud->button(URL::to('compras/{N°}/edit'),'Editar',false,"P");
$xcrud->button(URL::to('compras/{N°}/destroy'),'Eliminar',false,"P");
$xcrud->unset_add();
$xcrud->unset_edit();
$xcrud->unset_numbers();




echo $xcrud->render(); //magic
?>

@endsection
