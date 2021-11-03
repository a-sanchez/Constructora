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
<div class="row">
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
        <input type="text" class="form-control" id="pago" name="pago">
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <label for="fecha">Fecha</label>
        <input type="date" class="form-control" id="fecha" name="fecha">
    </div>
    <div class="col-md-4">
        <label for="posfechadas">PosFechadas</label>
        <input type="date" class="form-control" id="posfechadas" name="posfechadas">
    </div>
    <div class="col-md-4">
        <label for="deposito">Depósitos</label>
        <input type="text" class="form-control" id="deposito" name="deposito">
    </div>
</div>
<div class="row">
    {{-- <div class="col-md-4">
        <label for="importe">Importe</label>
        <input type="text" class="form-control" id="importe" name="importe">
    </div> --}}
    <div class="col-md-4">
        <label for="saldo">Importe</label>
        <input type="text" class="form-control" id="saldo" name="saldo">
    </div>
    <div class="col-md-4">
        <button type="submit" class="btn btn-success"  style="margin-top: 36px;">Agregar</button>
    </div>
</div>
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
        <th>Forma de pago</th>
        <th>Beneficiario</th>
        <th>Concepto de pago</th>
        <th>Fecha</th>
        <th>PosFechadas</th>
        <th>Depósitos</th>
        <th>Importe</th>
        <th>Saldo</th>
        <th></th>
    </thead>
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
    let cuentas = $("#cuentas").DataTable({
        responsive:true,
        paging:false,
        searching:false,
        ordering:false,
        info:false,
        ajax:`{{url('/nuevas_cuentas/${id_historial}')}}`,
        drawCallback: function () {
            var sum = this.api().column(6,{page:'current'}).data().sum();
            console.log(sum);
            console.log(document.getElementById("costo").value);
            let res = parseFloat(document.getElementById("costo").value) + parseFloat(sum);
            document.getElementById("total").value=res;
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
                data:"posfechadas"
            },
            {
                data:"deposito"
            },
            {
                data:"saldo"
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