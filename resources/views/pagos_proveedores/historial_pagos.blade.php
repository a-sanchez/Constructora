@extends('layouts.base_html')
@section('tittle') PAGOS A PROVEEDORES
@endsection
@section("styles") 
<link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="{{ asset('lib/DataTables/Responsive-2.2.9/css/responsive.dataTables.min.css') }}">    <style>
        table {
            text-transform: uppercase;
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
<table style="padding-top:10px;" id="pagos_table" width="100%">
    <thead style="background-color:#ff9c00;text-align:center">
        <th >Folio factura</th>
        <th>Fecha emisión</th>
        <th>Fecha vencimiento</th>
        <th>SubTotal</th>
        <th>Impuestos</th>
        <th width="3%">Total</th>
        <th>Observaciones y comentarios</th>
        <th></th>
    </thead>
    <tbody>
        <td>0001/2021</td>
        <td>15/09/2021</td>
        <td>15/10/2021</td>
        <td>30000</td>
        <td>50000</td>
        <td>80000</td>
        <td>Prueba de sistema para verificar tamaño de las celdas</td>
        <td>
            <a  type="button" style="color: green; " class="btn"  href="{{url('pagos_proveedores/create')}}"><i style="font-size:1.5rem;" id="dollar-sign"  class="fas fa-dollar-sign"></i></a>
            <a  style="color: blue;" href="{{url('pagos_proveedores/detalles_pago')}}" class="btn" ><i style="font-size:1.5rem" id="info-circle"  class="fas fa-info-circle"></i></a>

        </td>

    </tbody>
</table>
@endsection
@section('scripts')
<script>
let table = $("#pagos_table").dataTable({
    responsive:true
});
</script>

@endsection