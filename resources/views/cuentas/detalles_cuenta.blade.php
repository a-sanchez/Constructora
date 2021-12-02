@extends('layouts.base_html')
@section('tittle')Actualizar cuenta @endsection
@section('styles')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="{{ asset('lib/DataTables/Responsive-2.2.9/css/responsive.dataTables.min.css') }}">

<style>
    table {
            text-transform: uppercase;
            text-align: center;
        }

    .dataTables_filter{
    margin-bottom:0.5rem;
    }
    .colorlib-contact{
        padding-top:1rem;
    }
    table.dataTable.no-footer {
    border-bottom: 1px solid #fff;
    }
    table.dataTable thead th{
        background-color:#ff9c00;
        color:white;
    }
    table.dataTable tbody tr {
    background-color: #FFF2CC;
    }
    table.dataTable {
    border-collapse:collapse;
    border-spacing: 0;
    }
    th,td{
        border-color: white;
        border-style:solid;
        border-width:1px;
        vertical-align: middle;
    }
  
</style>
@endsection
@section('body')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="animate-box fadeInLeft animated" data-animate-effect="fadeInLeft">
                Detalles de cuenta
            </h1>
            <hr style="color:orange">
        </div>
    </div>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <label for="costo">Gasto de operación</label>
            <input type="text" class="form-control"  id="costo" name="costo" disabled value="{{$historial->costo_operacion}}">
        </div>
        <div class="col-md-4"></div>
    </div>
    <table class="table mt-2" id="cuentas" name="cuentas" width="100%">
        <thead >
            <th width="14%">Forma pago</th>
            <th>Beneficiario</th>
            <th width="18%">Concepto pago</th>
            <th>Fecha</th>
            <th>Ingresos</th>
            <th>Egresos</th>
            <th>Saldo</th>
        </thead>
        <tfoot style="background-color: #fff2cc;">
            <tr>
                <th>
                    <th></th>
                    <th></th>
                    <th style="font-weight: bold">Total </th>
                    <th id="ingresos">{{$ingresos_egresos["ingresos"]}}</th>
                    <th id="egresos">{{$ingresos_egresos["egresos"]}}</th>
                    <th></th>
                </th>
            </tr>
        </tfoot>
    </table>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <label for="total">TOTAL</label>
            <input type="text" class="form-control" id="total" name="total" readonly value="{{$historial->total}}">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group">
            <a type="button" class="btn" id="btnCancelar" href="{{ url('/cuentas') }}" style="background:red;color:white;" >REGRESAR</a>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/plug-ins/1.11.3/api/sum().js"></script>
<script>
    let id_historial = @json($historial->id);
    let temp = parseFloat(document.getElementById("costo").value);
    let cuentas = $("#cuentas").DataTable({
        responsive:true,
        paging:false,
        searching:false,
        ordering:false,
        info:false,
        ajax:`{{url('/nuevas_cuentas/${id_historial}')}}`,
        drawCallback: function () {
            var sum = this.api().column(6,{page:'current'}).data().sum();
            let res = parseFloat(document.getElementById("costo").value) + parseFloat(sum);
            document.getElementById("total").value=res;
        },
        columns:[
            {
                "data":"forma_pago.forma"
            },
            {
                "data":"beneficiario"
            },
            {
                "data":"pago"
            },
            {
                "data":"fecha"
            },
            {
                "data":"saldo",
                "render":function(data,type,row){
                    if(!data.includes('-')){
                        return data;
                    }
                    else{
                        return ' ';
                    }
                }
            },
            {
                "data":"saldo",
                "render":function(data,type,row){
                    if(data.includes('-')){
                        return data;
                    }
                    else{
                        return ' ';
                    }
                }
            },
            {
                "data":"saldo",
                "render": function (data) {
                    temp = temp + parseFloat(data);
                    return temp;

                }
            }
        ]
    });
</script>
@endsection
