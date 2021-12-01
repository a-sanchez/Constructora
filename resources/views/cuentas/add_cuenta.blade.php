@extends('layouts.base_html')
@section('tittle')Agregar cuenta @endsection
@section('styles')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="{{ asset('lib/DataTables/Responsive-2.2.9/css/responsive.dataTables.min.css') }}">


<style>
    table{
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
    border-collapse:unset;
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
<div class="row">
    <div class="col-md-12">
        <h1 class="animate-box fadeInLeft animated" data-animate-effect="fadeInLeft">
            AGREGAR NUEVA CUENTA
        </h1>
        <hr style="color:orange">
    </div>
</div>
<form id="form-cuentas" class="row g-3" onsubmit="agregarForma()">
    @csrf
<h1 style="text-align:center;font-weight: bold;font-size: 32px;background: #ff9c00;color: black;">{{$historial->banco}}</h1>
<h1 style="text-align:center;font-weight: bold;bold;font-size: 22px;background: #f16532;color: white;">FLUJO DIARIO</h1>
<div class="row mt-4">
    <div class="col-md-4">
        <label for="id_forma" name="id_forma">Forma de Pago</label>
                <select class="form-control" id="id_forma" name="id_forma">
                  <option selected disabled value="0" >Seleccione forma de pago</option> 
                  @foreach($formas as $forma)
                  <option value="{{$forma->id}}">{{$forma->forma}}</option>
                  @endforeach
                </select>
    </div>
    <div class="col-md-4">
        <label for="beneficiario">Beneficiario</label>
        <input type="text" class="form-control" id="beneficiario" name="beneficiario">
    </div>
    <div class="col-md-4">
        <label for="pago">Concepto de pago</label>
        <input type="text" class="form-control" id="pago" name="pago" required>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <label for="fecha">Fecha</label>
        <input type="date" class="form-control" id="fecha" name="fecha">
    </div>
    <div class="col-md-4">
        <label for="saldo">Importe</label>
        <input type="text" class="form-control" id="saldo" name="saldo">
    </div>
    <div class="col-md-4">
        <button type="submit" class="btn btn-success"  style="margin-top: 36px;">Agregar</button>
    </div>
</div>
{{-- <div class="row">
    <div class="col-md-4">
        <label for="importe">Importe</label>
        <input type="text" class="form-control" id="importe" name="importe">
    </div>
    <div class="col-md-4">
        <label for="saldo">Importe</label>
        <input type="text" class="form-control" id="saldo" name="saldo">
    </div>
    <div class="col-md-4">
        <button type="submit" class="btn btn-success"  style="margin-top: 36px;">Agregar</button>
    </div>
</div> --}}
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <label for="costo">Gasto de operación</label>
        <input type="text" class="form-control"  id="costo" name="costo" value="{{$historial->costo_operacion}}">
    </div>
</div>

<table class="table" id="cuentas" name="cuentas" width="100%">
    <thead>
        <th width="14%">Forma pago</th>
        <th>Beneficiario</th>
        <th width="18%">Concepto pago</th>
        <th>Fecha</th>
        <th>Ingresos</th>
        <th>Egresos</th>
        <th>Saldo</th>
        <th width="8%"></th>
    </thead>
    <tfoot style="background-color: #fff2cc;">
        <tr>
            <th>
                <th></th>
                <th></th>
                <th style="font-weight: bold">Total </th>
                <th id="ingresos">{{number_format($ingresos_egresos["ingresos"],2)}}</th>
                <th id="egresos">{{number_format($ingresos_egresos["egresos"],2)}}</th>
                <th></th>
                <th></th>
            </th>
        </tr>
    </tfoot>
</table>
</form>
<form id="form-total" onsubmit="update_total({{$historial->id}})">
    @csrf
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <label for="total">TOTAL</label>
        <input type="text" class="form-control" id="total" name="total" value="{{$historial->total}}">
    </div>
</div>
<div class="form-row">
    <div class="form-group">
        <button type="submit" class="btn" id="btnGuardar" style="background:blue;color:white;">Guardar</button>
        <a type="button" class="btn" id="btnCancelar" href="{{ url('/cuentas') }}" style="background:red;color:white;" >Cancelar</a>
    </div>
</div>
</form>

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
            document.getElementById("total").value=(res).toFixed(2);
        },
        columns:[{
            data:"forma_pago.forma"
            },
            {
                data:"beneficiario"
            },
            {
                data:"pago"
            },
            {
                data:"fecha"
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
                    return temp.toFixed(2);

                }
            },
            {
                data:"id",render:function(id){
                    return `<a  class="d-flex w-100 justify-content-center" style="color:black" href="#" class="btn" onclick='borrarCuenta(${id})'><i style="font-size:1.5rem" id="trash-alt"  class="fas fa-trash-alt"></i></a>`
                }
            }
        ]
    });
    async function borrarCuenta(id) {
            let url = `{{url('/nuevas_cuentas/{id}')}}`.replace('{id}',id);
            let init = {
                method: "DELETE"
                , headers: {
                    'X-CSRF-TOKEN': "{{csrf_token()}}"
                }
            }

            let req = await fetch(url, init);
            if (req.ok) {
                cuentas.ajax.reload();
                res = await req.json();
                temp=parseFloat(document.getElementById("costo").value);
                document.getElementById("ingresos").innerHTML = res.ingresos;
                document.getElementById("egresos").innerHTML=res.egresos;
            } else {
                Swal.fire(
                    "error"
                );
            }
        }

        async function agregarForma(){
            event.preventDefault();
            let form = new FormData(document.getElementById("form-cuentas"));
            form.append('id_costo',id_historial);
            let url="{{url('/nuevas_cuentas')}}";
            let init = {
                method:"POST",
                body:form
            }
            let req= await fetch(url,init);
            if(req.ok){
                await cuentas.ajax.reload();
                res = await req.json();
                temp=parseFloat(document.getElementById("costo").value);
                document.getElementById("ingresos").innerHTML = res.egr.ingresos;
                document.getElementById("egresos").innerHTML=res.egr.egresos;
            }
            else{
              Swal.fire({
              icon: 'error',
              title: 'Error',
              text: "ERROR AL REGISTRAR LA CUENTA"
            });
            }
        document.getElementById("form-cuentas").reset();
    }

    async function update_total(id){
            event.preventDefault();
            let url = `{{url('/cuentas/{id}')}}`.replace('{id}',id);
            let form = new FormData(document.getElementById("form-total"));
            form.append("total",document.getElementById("total").value);
            let init={
                method:"PUT",
                headers:{
                    'X-CSRF-Token': document.getElementsByName("_token")[0].value,
                    "Content-Type":"application/json"
                },
                body:JSON.stringify(Object.fromEntries(form))
            }
            let req = await fetch(url,init);
            if (req.ok) {
            window.location.href = "{{url('/cuentas')}}";
            } else {
                Swal.fire({
                    icon: 'error'
                    , title: 'Error'
                    , text: 'Error al actualizar el total'
                , });
            }
        }

</script>
@endsection