@extends('layouts.base_html')
@section('tittle') CUENTAS POR PAGAR @endsection
@section('styles')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="{{ asset('lib/DataTables/Responsive-2.2.9/css/responsive.dataTables.min.css') }}">
<style>
    table {
    text-transform: uppercase;
    }
    .colorlib-contact{
        padding-top:1rem;
    }
    table.dataTable.no-footer {
    border-bottom: 1px solid #fff;
    }
    table.dataTable thead th {
    border-bottom: 1px solid white;
    }
    .display{
        background-color:#FFF2CC;
    }

    tbody, td,th, tr {
    border-color: white;
    border-style: solid;
    border-width: 1px;
    border-bottom:white;
    }

    input[type=number] { -moz-appearance:textfield; } 
</style>
@endsection

@section('body')

<div class="row">
    <div class="col-md-12">
        <h1 class="animate-box fadeInLeft animated mt-3" data-animate-effect="fadeInLeft">
            CUENTAS POR PAGAR
        </h1>
         <hr style="color: orange;">
    </div>
</div>
<form  id="cuentas_credito">
    @csrf
<div class="row">
    <div class="col-md-4">
        
    </div>
    <div class="col-md-4">
        <div class="row" style="text-align:end">
        </div>
    </div>
    <div class="col-md-4">
        <div class="row" style="text-align:end">
            <div class="col-md-12" >
                <a type="btn" target="_blank" class="btn" href = "{{url("pdf_cuentas_nuevas/{$proveedores[0]->cuenta_id}")}}" style="background-color:red;font-size:11px;text-align:center;color:white">PDF</a>
                <a type="btn" class="btn" href = "{{url("/nuevas_cuentas")}}" style="background-color:green;font-size:11px;text-align:center;color:white">REGRESAR</a>
            </div>
        </div>
    </div>
</div>
</form>
<table id="table_cuentas" width="100%" style="text-align:center" class="display">
    <thead style="background-color:#ff9c00;color:white;text-align:center">
        <th>PROVEEDOR</th>
        <th>MONTO</th>
        <th>PROGRAMADO A PAGAR</th>
        <th>TOTAL</th>    
    </thead>
    <tbody>
        @foreach($proveedores as $proveedor)
        <tr>
            <td>{{$proveedor->proveedor}}</td>
            <td>{{$proveedor->monto}}</td>
            <td>{{$proveedor->programado}}</td>
            <td>{{$proveedor->total_total}}</td>
        </tr>
            
        @endforeach
    </tbody>
    <tfoot style ="font-weight:bold">
        <td>TOTAL</td>
        <td id="total_monto"></td>
        <td id="total_monto1"></td>
        <td id="total_monto2"></td>
    </tfoot>
</table>
@endsection

@section('scripts')
    <script src={{asset("lib/DataTables/DataTables-1.10.25/js/jquery.dataTables.min.js")}}></script>
    <script src="{{asset("lib/DataTables/DataTables-1.10.25/js/dataTables.bootstrap5.min.js")}}"></script>
    <script src="{{asset("lib/DataTables/Responsive-2.2.9/js/dataTables.responsive.js")}}"></script>
    <script src="{{asset('lib/jquery-tabledit/jquery.tabledit.min.js')}}"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.11.3/api/sum().js"></script>
<script>
$(document).ready(function(){
    $('table.display').DataTable({
        responsive:true,
        searching:false,
        ordering:false,
        info:false,
        
        paging:false,
        drawCallback: function () {
          var api = this.api();
          var uno = (api.column(1,{"filter":"applied"}).data().sum()).toFixed(2);
          $('#total_monto').html(uno);

          var dos = (api.column(2,{"filter":"applied"}).data().sum()).toFixed(2);
          $('#total_monto1').html(dos);

          var tres = (api.column(3,{"filter":"applied"}).data().sum()).toFixed(2);
          $('#total_monto2').html(tres);
        }
        
    });

});
</script>
@endsection