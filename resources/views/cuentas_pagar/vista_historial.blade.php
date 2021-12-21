
@extends('layouts.base_html')
@section('title')
    HISTORIAL DE CUENTAS
@endsection

@section('styles')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="{{ asset('lib/DataTables/Responsive-2.2.9/css/responsive.dataTables.min.css') }}"> 

<style>
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
<div class="container pt-1">
    <div class="row">
        <div class="col-md-12">
            <h1 class="animate-box fadeInLeft animated mt-3" data-animate-effect="fadeInLeft">
                PROVEEDOR: <b>{{$historiales[0]->razon_social}}</b>
            </h1>
             <hr style="color: orange;">
        </div>
    </div>
</div>
<table id="table_cuentas" width="100%" style="text-align:center" class="display">
    <thead style="background-color:#ff9c00;color:white;text-align:center">
        <th>FACTURA</th>
        <th>EMISIÓN</th>
        <td>VENCIMIENTO</td>
        <th>TOTAL</th>
        <th>OBRA</th>
        <th>DESCRIPCIÓN</th>
        <th>OBSERVACIÓN</th>    
    </thead>
    <tbody>
        @foreach($historiales as $historial)
            <tr>
                <td>{{$historial->folio_factura}}</td>
                <td>{{$historial->fecha_emision}}</td>
                <td>{{$historial->fecha_vencimiento}}</td>
                <td>{{$historial->total}}</td>
                <td>{{$historial->descripcion}}</td>
                <td>{{$historial->cantidad}} {{$historial->concepto}}</td>
                <td>{{Carbon\Carbon::parse($historial->date)->formatLocalized('TRANSFER %d/%B/%Y')}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection

@section("scripts")
<script>
    let table = $("#table_cuentas").DataTable({
        responsive:true,
        paging:false,
        searching:false
    });

</script>
@endsection