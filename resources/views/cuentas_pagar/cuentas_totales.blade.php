@extends('layouts.base_html')
@section('tittle') CUENTAS POR PAGAR @endsection
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
    table.dataTable.no-footer {
    border-bottom: 1px solid #fff;
    }
    table.dataTable thead th {
    border-bottom: 1px solid white;
    }
    td{
        background-color:#FFF2CC;
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
        <h1 class="animate-box fadeInLeft animated mt-5" data-animate-effect="fadeInLeft">
            CUENTAS POR PAGAR
        </h1>
         <hr style="color: orange;">
    </div>
</div>
<div class="row">
    <h1 class="animate-box fadeInLeft animated" data-animate-effect="fadeInLeft" style="font-size:24px;color:gray">
        -Generar nuevas cuentas por pagar
    </h1>
</div>
<form id="form-cuentas" onsubmit="insert_credito();">
@csrf
<div class="row mt-3" style="text-align:center">
    @csrf
    <label for="estatus">Ingrese las fechas correspondientes   (Fecha Inicio - Fecha Final)</label>
    <div class="col-md-1 mt-2">
    </div>
    <div class="col-md-5 mt-2">


        <input type="date" class="form-control" id="fecha1" name="fecha_inicio" style="text-align:center">
    </div>
    <div class="col-md-5 mt-2">
        <input type="date" class="form-control" id="fecha2" name="fecha_final" style="text-align:center">
    </div>
    <div class="col-md-1 mt-2">
        <button  type="submit" form="form-cuentas"  class ="btn" style="color: blue; display: flex;flex-direction: column;align-items: center;justify-content: center;" >
            <i style="font-size:1.5rem;" id="search"  class="fas fa-search"></i>
        </button> 
    </div>
</div>
</form>
{{-- CATALOGO DE REPORTES GENERADOS EN CUENTAS POR PAGAR --}}

<div class="row mt-3">
    <div class="col-md-12">
        <h5>CATALAGO DE REPORTES GENERADOS</h5>
    </div>
</div>
<div class="row mt-3">
    <div class="col-md-12">
        <table id="table_cuentas" width="100%" style="text-align:center" class="display">
            <thead style="background-color:#ff9c00;color:white;text-align:center">
                <th>FECHA INICIO</th>
                <th>FECHA FINAL</th>
                <th>OPCIONES</th>
            </thead>
            <tbody>
                @foreach ($vistas as $vista)
                    <tr>
                        <td>
                            <?php 
                            $date = $vista->fecha_inicio;
                            $mes1 = "";
                            switch (date("m", strtotime($date))) {
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
                            switch (date("l", strtotime($date))) {
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
                            {{$dia}} {{date("j",strtotime($date))}} {{$mes1}} {{date("Y",strtotime($date))}}

                        </td>
                        <td>
                            <?php 
                            $date = $vista->fecha_final;
                            $mes1 = "";
                            switch (date("m", strtotime($date))) {
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
                            switch (date("l", strtotime($date))) {
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
                            {{$dia}} {{date("j",strtotime($date))}} {{$mes1}} {{date("Y",strtotime($date))}}
                        </td>
                        <td>
                            <a  type="button" style="color: green; " class="btn" href="{{url("relacion_cuentas/{$vista->id}/edit")}}" ><i style="font-size:1.5rem;" id="pencil-alt"  class="fas fa-pencil-alt"></i></a> 
                            <a  style="color: black;" href="" class="btn" onclick="borrarRegistro({{$vista->id}})" ><i style="font-size:1.5rem" id="trash-alt"  class="fas fa-trash-alt"></i></a>
                            <a  style="color: blue;"  class="btn" href="{{url("relacion_cuentas/detalles/{$vista->id}")}}" ><i style="font-size:1.5rem" id="info-circle"  class="fas fa-info-circle"></i></a>
                            <a  target="_blank" style="color: red;" href = "{{url("pdf_cuentas_nuevas/{$vista->id}")}}" class="btn" ><i style="font-size:1.5rem" id="file-pdf"  class="fas fa-file-pdf"></i></a>
            
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

@section("scripts")
<script>

// let table = $("#cuenta_pagar").DataTable({
//     responsive:true,
//     searching:false,
//     ordering:false,
//     info:false,
//     paging:false
// });



async function insert_credito() {
    event.preventDefault();
    let form = new FormData(document.getElementById("form-cuentas"));
    let url="{{url('credito_cuentas/agregar')}}";
    let init ={
        method:"POST",
        body:form
    }
    let req = await fetch(url,init);
    if(req.ok){
        cuentas();
    }
    else{
        Swal.fire({
              icon: 'error',
              title: 'Error',
              text: "Error al insertar"
            });
    }


}
async function cuentas(){
    let fecha1=document.getElementById("fecha1").value;
    let fecha2=document.getElementById("fecha2").value;
    let id = {{$id}};
    let form = new FormData(document.getElementById("form-cuentas"));
    let url = "{{url('fecha/{fecha1}/fecha/{fecha2}/{id}/Cuentas_Pagar')}}";
    let url2 = url.replace("{fecha1}",fecha1);
    let url3 = url2.replace("{fecha2}",fecha2);
    let url4 = url3.replace("{id}",id);
    let init = {
        method:"GET"
    }
    let req = await fetch(url4,init);
    if(req.ok){
        window.location.href = url4;
    }
    else{
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'ERROR ',
        });
    }

}
async function borrarRegistro(id){
  event.preventDefault();
  let url = '{{url("relacion_cuentas/{id}")}}'.replace('{id}',id);
  let init={
            method:"DELETE",
            headers: {  'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
        }
        let req=await fetch(url,init);
        if (req.ok){
            location.reload();
        }
        else{
            Swal.fire({
                icon:"error",
                title:"Error",
                text:"ERROR AL ELIMINAR"
            });
        }

}
</script>
@endsection