@extends('layouts.base_html')
@section('tittle')CUENTAS @endsection
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
        padding-top:3rem;
    }
    table.dataTable.no-footer {
    border-bottom: 1px solid #fff;
    }
    table.dataTable thead th {
    border-bottom: 1px solid white;
    }
    td{
        background-color:#FFF2CC;
        }
        .modal-dialog {
    max-width: 500px;
    margin: 8rem auto;
}
    tbody, td,th, tr {
    border-color: white;
    border-style: solid;
    border-width: 1px;
    border-bottom:white;
    }
</style>
@endsection

@section('body')
<div class="row">
    <div class="col-md-12">
        <h1 class="animate-box fadeInLeft animated" data-animate-effect="fadeInLeft">
            Historial de cuentas por pagar
        </h1>
    </div>
    <hr style="color:orange" class="mt-3">
</div>
<form id="form-gasto" onsubmit="insert_gasto()">
@csrf
<div class="row">
    <div class="col-md-4">
        <button type="button" id="myBtn" class="btn btn-success">Agregar nueva cuenta</button>
        <div id="myModal" class="modal fade" tabindex="-50">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Gasto de operacion</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <label for="gasto">Ingrese gasto de operacion</label>
                        <input type="text" id="costo_operacion" name="costo_operacion" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Agregar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
<table id="cuentas_table" width="100%" style="text-align:center">
    <thead style="background-color:#ff9c00;text-align:center;color:white">
    <th>Dia de creación</th>
    <th>Gasto de operación actual</th>
    <th>Opciones</th>
    </thead>
    <tbody>
        @foreach($cuentas as $cuenta)
        <tr>
            <td><?php
            $mes1 = "";
                switch (date("m", strtotime($cuenta->created_at))) {
                    case '01':
                        $mes1 = "ENERO";
                        break;
                    case '02':
                        $mes1 = "FEBRERO";
                        break;
                    case '03':
                        $mes1 = "MARZO";
                        break;
                    case '04':
                        $mes1 = "ABRIL";
                        break;
                    case '05':
                        $mes1 = "MAYO";
                        break;
                    case '06':
                        $mes1 = "JUNIO";
                        break;
                    case '07':
                        $mes1 = "JULIO";
                        break;
                    case '08':
                        $mes1 = "AGOSTO";
                        break;
                    case '09':
                        $mes1 = "SEPTIEMBRE";
                        break;
                    case '10':
                        $mes1 = "OCTUBRE";
                        break;
                    case '11':
                        $mes1 = "NOVIEMBRE";
                        break;
                    case '12':
                        $mes1 = "DICIEMBRE";
                        break;
                }

                $dia = "";
                switch (date("l", strtotime($cuenta->created_at))) {
                    case 'Monday':
                        $dia = "LUNES";
                        break;
                    case 'Tuesday':
                        $dia = "MARTES";
                        break;
                    case 'Wednesday':
                        $dia = "MIERCOLES";
                        break;
                    case 'Thursday':
                        $dia = "JUEVES";
                        break;
                    case 'Friday':
                        $dia = "VIERNES";
                        break;
                    case 'Saturday':
                        $dia = "SABADO";
                        break;
                    case 'Sunday':
                        $dia = "DOMINGO";
                        break;
                }
                ?>
                
                {{$dia}} {{date("j",strtotime($cuenta->created_at))}} {{$mes1}} {{date("Y",strtotime($cuenta->created_at))}}
            </td>
            <td>{{$cuenta->total}}</td>
            <td>
                <a  type="button" style="color: green; " class="btn"  href="{{url("cuentas/{$cuenta->id}/edit")}}"><i style="font-size:1.5rem;" id="pencil-alt"  class="fas fa-pencil-alt"></i></a> 
                <a  style="color: red;" href="" class="btn"  onclick='borrarCuenta({{$cuenta->id}})' ><i style="font-size:1.5rem" id="trash-alt"  class="fas fa-trash-alt"></i></a>
                <a  style="color: blue;" href="{{url("cuentas/{$cuenta->id}")}}" class="btn" ><i style="font-size:1.5rem" id="info-circle"  class="fas fa-info-circle"></i></a>
            </td>
            @endforeach
        </tr>
    </tbody>

</table>
@endsection
@section('scripts')
<script>
    let table = $("#cuentas_table").dataTable({
        responsive:true
    });

    document.addEventListener("DOMContentLoaded", function() {
        var btn = document.getElementById("myBtn");

        btn.addEventListener("click", function() {
            var myModal = new bootstrap.Modal(document.getElementById("myModal"));
            myModal.show();
        });
    });

    async function insert_gasto(){
        event.preventDefault();
        let form = new FormData(document.getElementById("form-gasto"));
        form.append("total",document.getElementById("costo_operacion").value);
        let url="{{url('cuentas/agregar')}}";
        let init={
            method:"POST",
            body:form
        }
        let req = await fetch (url,init);
        if(req.ok){
            let res = await req.json();
            window.location.href="{{url('cuentas/costo/{id}')}}".replace("{id}",res.id);
        }
        else{
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: "Error al insertar el gasto de operacion"
            });
        }
    }

    async function borrarCuenta(id){
        event.preventDefault();
        let url='{{url("/cuentas/{id}")}}'.replace('{id}',id);
        let init={
            method:"DELETE",
            headers:{
                'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
        }

        let req = await fetch(url,init);
        if(req.ok){
            //location.reload();
        }
        else{
            let res = await req.json();
                Swal.fire({
                    icon:"error",
                    title:"Error",
                    text:res
                });
        }
    }
</script>
@endsection