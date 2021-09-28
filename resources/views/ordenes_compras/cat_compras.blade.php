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
//require (__DIR__.'/../../../public/lib/xcrud/xcrud_1.7.15_2/xcrud/xcrud.php');// solo para localhost
require (__DIR__.'/../../../../public_html/lib/xcrud/xcrud_1.7.15_2/xcrud/xcrud.php'); //servidor
$xcrud = Xcrud::get_instance(); 



$xcrud->query('select oc.id as id,folio_orden,solicitado,fecha_orden,fecha_entrega,descripcion_orden,c.folio as Contrato,p.razon_social as Proveedor,importe_total as "Importe_Total_(sin IVA)"
from orden_compras oc
left join (SELECT orden_id,sum(importe) as importe_total  from orden_productos  group by orden_id) as op
ON op.orden_id=oc.id
left join contratos c
on c.id = oc.id_contrato
left join proveedores p
on   p.id=oc.id_proveedor
where oc.status != 0');
$xcrud->button(URL::to('compras_pdf/{id}'),'PDF',false,"P",array('target'=>'_blank'));
$xcrud->button(URL::to('compras/{id}/edit'),'Editar',false,"P");
$xcrud->button(URL::to('pagos_proveedores/orden/{id}'),'Operar Orden',false,"P");
$xcrud->button('#','Eliminar',false,"P",array('onclick'=>'update_status({id})'));
$xcrud->unset_add();
$xcrud->unset_edit();
$xcrud->unset_numbers();



try{

    echo $xcrud->render(); //magic
}
catch(Exception $e){
    $xcrud = Xcrud::get_instance(); //instantiate xCRUD
    $xcrud->table('orden_compras'); //employees - MySQL table name
    $xcrud->columns("folio_orden,solicitado,fecha_orden,fecha_entrega,descripcion_orden,id_contrato,id_proveedor");
    $xcrud->columns("folio_orden,solicitado,fecha_orden,fecha_entrega,descripcion_orden,id_contrato,id_proveedor");
    $xcrud->relation('id_proveedor','proveedores','id', 'razon_social');
    $xcrud->relation("id_contrato","contratos","id","folio");
    $xcrud->relation("id_status","estatus_facturas","id","status");
    $xcrud->column_name('id_estatus','Estatus');
    $xcrud->column_name('id_contrato','Contrato');
    $xcrud->column_name('id_proveedor','Proveedor');

    $xcrud->where('status !=', 0);
    echo $xcrud->render(); //magic
}
?>
@endsection
@section('scripts')
<script>


async function update_status(id) {
    event.preventDefault();
    let url = "{{url('/compras/{N°}')}}".replace("{N°}",id);
    let init = {
        method:"PUT",
        headers:{
            'X-CSRF-Token' : "{{ csrf_token() }}",
            'Content-Type':'application/json'
        },
        body:JSON.stringify({'status':0})
    };
    let req = await fetch(url,init);
    if (req.ok) {
       window.location.reload();
    }
    else{
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Error al eliminar',
        });
    }
}
</script>
@endsection
