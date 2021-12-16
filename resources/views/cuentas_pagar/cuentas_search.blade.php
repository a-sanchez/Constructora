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
<form action="" onSubmit="guardar_datos();" id="cuentas_credito">
    @csrf
<div class="row">
    <div class="col-md-4">
        
    </div>
    <div class="col-md-4">
        
    </div>
    <div class="col-md-4">
        <div class="row">
            <div class="col-md-5" >
                <button type="submit" class="form-control btn" style="background-color:green;font-size:12px;text-align:center;color:white;font-weight:bold">Guardar Registro</button>
            </div>
            <div class="col-md-5">
                <a class="form-control btn" target="_blank"  href = "{{url("pdf_cuentas/{$from}/{$to}")}}" style="background-color:red;font-size:13px;text-align:center;color:white;font-weight:bold">Descargar PDF</a>
            </div>
        </div>
    </div>
</div>
<table id="table_cuentas" width="100%" style="text-align:center" class="display">
    <thead style="background-color:#ff9c00;color:white;text-align:center">
        <th>PROVEEDOR</th>
        <th>MONTO</th>
        <th>PROGRAMADO A PAGAR</th>
        <th>TOTAL</th>    
    </thead>
    <tbody>
        @foreach($cuentas as $cuenta)
            <tr>
                <td value="{{$cuenta->razon_social}}" id="proveedor">{{$cuenta->razon_social}}</td>
                <td id="monto-{{$cuenta->razon_social}}" value="{{$cuenta->monto}}" name="monto">
                    {{$cuenta->monto}}
                </td>
                <td>
                    <span id="res-{{$cuenta->razon_social}}" style="display:none;" name="programado">0</span>
                    <input disabled type="number" class="form-control" id="cash" onchange="suma(this, '{{$cuenta->razon_social}}')">
                </td>
                <td id="totales-{{$cuenta->razon_social}}" name="total">
                </td>
            </tr>
        @endforeach
    </tbody>
    <tfoot style ="font-weight:bold">
        <td style="text-align:end">TOTAL</td>
        <td id="total_monto"></td>
        <td id="total_monto2"></td>
        <td id="total_monto3"></td>
    </tfoot>
</table>
</form>
@endsection

@section("scripts")
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
        }
        
    });

});
let cuentas2 = @json($cuentas);
console.log(cuentas2);
let id = {{$id}};
let flag=0;
async function guardar_datos(){
    event.preventDefault();
    if (cuentas2.length == 0) {
    alert("NO SE PUEDE GUARDAR REGISTRO,NO CONTIENE DATOS");
    }
    else
    {
        let form = new FormData(document.getElementById("cuentas_credito"));
        cuentas2.forEach(async(element) => {
            event.preventDefault();
            t = element.razon_social;
            x=element.monto;
            form.append('cuenta_id',id);
            form.append('proveedor',t);
            form.append('monto',x);
            form.append('programado',null);
            form.append('total',null);

            let url="{{url('relacion_cuentas/agregar')}}";
            let init = {
                method:"POST",
                body:form
            }
            let req = await fetch(url,init);
            if(req.ok){
                if(flag==0){
                window.location.href = "{{url('relacion_cuentas/{id}/edit')}}".replace("{id}",id);
                flag++;
                }

            }
            else{
                Swal.fire({
                    icon:'error',
                    tittle:'Error',
                    text:"ERROR AL REGISTAR"
                });
            }


        });
    }
}


let cuentas = @json($cuentas);
let n = cuentas.length;
let temp=0;
let temp2=0;

function suma(input,razon_social){
    let a = parseFloat(input.parentElement.children[0].innerHTML=input.value);
    let b = parseFloat(document.getElementById(`monto-${razon_social}`).innerHTML);
    document.getElementById(`totales-${razon_social}`).innerHTML =((a-b)*-1).toFixed(2);  

    for (let i = 1; i < n; i++) {
        if(isNaN(document.getElementById(`totales-${razon_social}`).innerHTML)){
            document.getElementById(`totales-${razon_social}`).innerHTML = document.getElementById(`monto-${razon_social}`).innerHTML;
            if (input.parentElement.children[0].innerHTML==0) {
                input.value=0;
            }
        }
        else{
        let c = parseFloat(document.getElementById(`res-${razon_social}`).innerHTML);
        temp = temp+c;
        document.getElementById("total_monto2").innerHTML = (temp).toFixed(2);
        input.disabled;
        }

    }
    

    for (let i = 1; i < n; i++) {
        let c = parseFloat(document.getElementById(`totales-${razon_social}`).innerHTML);
        temp2 = temp2+c;
        document.getElementById("total_monto3").innerHTML = (temp2).toFixed(2);

    }

}





</script>
@endsection
