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
        <div class="row">
            <div class="col-md-5" >
                <a type="btn" target="_blank" class="form-control btn" href = "{{url("pdf_cuentas_nuevas/{$id}")}}" style="background-color:red;font-size:11px;text-align:center;color:white">Descargar PDF</a>
            </div>
            <div class="col-md-5" >
                <a type="btn" class="form-control btn" onclick="cambios();"style="background-color:green;font-size:11px;text-align:center;color:white">Guardar Cambios</a>
            </div>
        </div>
    </div>
</div>
</form>
<table id="table_cuentas" width="100%" style="text-align:center" class="display">
    <thead style="background-color:#ff9c00;color:white;text-align:center">
        <th></th>
        <th>PROVEEDOR</th>
        <th>MONTO</th>
        <th>PROGRAMADO A PAGAR</th>
        <th>TOTAL</th>    
    </thead>
    <tfoot>
        <td>TOTAL</td>
        <td id="total_monto">{{$suma_monto}}</td>
        <td id="total_monto1">{{$suma_programado}}</td>
        <td id="total_monto2">{{$suma_total}}</td>
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
    let idProveedor = @json($id);
    let cuentas_proveedor = $("#table_cuentas").DataTable(
        {
        paging:false,
        searching:false,
        info:false,
        ajax:{
            url:'{{url("relacion_cuentas/{id}")}}'.replace('{id}',idProveedor),
            type:'GET'
        },
        columns:[
            {
                "data":"id"
            },
            {
                "data":"proveedor"
            },
            {
                "data":"monto"
            },
            {
                "data":"programado"
            },
            {
                "data":"total_total"
            }
        ]
    });
    $('#table_cuentas').on('draw.dt',function () {
        $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': document.getElementsByName("_token")[0].value
                }
            });
        $('#table_cuentas').Tabledit({
            url:'{{url("/relacion_cuentas")}}'
            , editButton: false
            , deleteButton: false
            , hideIdentifier: true
            ,columns:{
                identifier:[0,'id'],
                editable:[
                    [3,'programado']
                ]
            },
            onSuccess:function(data){
               console.log(data);
                document.getElementById("total_monto1").innerHTML = data.suma_programado;
                document.getElementById("total_monto2").innerHTML = data.suma_total;
                cuentas_proveedor.ajax.reload();
                
            }
        });
    });

    function cambios(){
        alert("CAMBIOS GUARDADOS CORRECTAMENTE");
        window.location.replace("{{url('/nuevas_cuentas')}}");
    }
</script>
@endsection