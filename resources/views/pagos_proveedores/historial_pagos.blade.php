@extends('layouts.base_html')
@section('tittle') PAGOS A PROVEEDORES
@endsection
@section("styles") 
<link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="{{ asset('lib/DataTables/Responsive-2.2.9/css/responsive.dataTables.min.css') }}">    <style>
        table {
        text-transform: uppercase;
    }
    
    .dataTables_filter{
        margin-bottom:0.5rem;
    }
    .colorlib-contact{
        padding-top:1rem;
    }

    </style>
@endsection
@section('body')
<div class="row">
    <div class="col-md-12">
        <h1 class="animate-box fadeInLeft animated" data-animate-effect="fadeInLeft">
            PAGOS A PROVEEDORES
        </h1>
        <hr style="color: orange;">
    </div>
</div>
<table style="width: 100%;border: 1px solid black;" id="pagos_table" width="100%">
    <thead style="background-color:#ff9c00;color:white;text-align:center">
        <th >Folio factura</th>
        <th>Fecha emisión</th>
        <th>Fecha vencimiento</th>
        <th width="10%">SubTotal</th>
        <th width="10%">Impuestos</th>
        <th width="3%">Total</th>
        <th width="20%">Observaciones y comentarios</th>
        <th>Estatus</th>
        <th width="3%"></th>
    </thead>
    <tbody>
        @foreach($operadas as $operar)
        <tr style="text-align:center">
            <td>{{$operar->folio_factura}}</td>
            <td>{{$operar->fecha_emision}}</td>
            <td>{{$operar->fecha_vencimiento}}</td>
            <td>{{number_format($operar->sub_total,2)}}</td>
            <td>{{number_format($operar->impuestos,2)}}</td>
            <td>{{number_format($operar->total,2)}}</td>
            <td>{{$operar->comentarios}}</td>
            <td>{{$operar->status}}</td>
            <td>
                @if($operar->id_status ==2)
                <a  type="button" style="color: green; " class="btn"  href="{{url("pagos_proveedores/pagar/{$operar->id}")}}"><i style="font-size:1.5rem;" id="dollar-sign"  class="fas fa-dollar-sign"></i></a> 
                <a  style="color: red;" href="" class="btn" ><i style="font-size:1.5rem" id="trash-alt" onclick='borrar_pago({{$operar->id}})' class="fas fa-trash-alt"></i></a>
                @endif
                @if($operar->id_status==3)
                <a  style="color: blue;" href="{{url("pagos_proveedores/detalles/{$operar->id}")}}" class="btn" ><i style="font-size:1.5rem" id="info-circle"  class="fas fa-info-circle"></i></a>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
@section('scripts')
<script>
let table = $("#pagos_table").dataTable({
    responsive:true
});

async function borrar_pago(id){
    event.preventDefault();
    let url='{{url("/pagos_proveedores/{id}")}}'.replace('{id}',id);
    let init = {
        method:"DELETE",
        headers: {  'X-CSRF-TOKEN': "{{csrf_token()}}"
                }
}
let req = await fetch(url,init);
if (req.ok){
    location.reload();
}
else{
    
    Swal.fire({
        icon:"error",
        title:"Error",
        text:"Error al eliminar"
    });
}
}
</script>

@endsection