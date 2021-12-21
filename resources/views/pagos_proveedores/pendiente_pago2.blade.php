@extends('layouts.base_html')

@section ('tittle')PAGOS PROVEEDORES @endsection

@section('body')
<div class="container pt-1">

    <div class="col-md-12">
        <h1 class="animate-box fadeInLeft animated" data-animate-effect="fadeInLeft">
            PAGO A PROVEEDOR
        </h1>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h4 style="color:gray;font-size:20px;">-Registrar los siguientes datos para el pago</h4>
            <hr style="color: orange;">
        </div>
    </div>

    <form id="form-pago" class="row g-3" onsubmit='pago_proveedor({{$pagos->id}});'>
        @csrf
            <div class="row mt-3">
                <div class="col-md-4">
                    <label for="fecha_pago" >Fecha de pago</label>
                    <input type="date" disabled class="form-control" value="{{$pagos->fecha_pago}}" id="fecha_pago" name='fecha_pago'>
                  </div>
                <div class="col-md-4">
                    <label for="id_forma" name="id_forma">Forma de Pago</label>
                    <select disabled class="form-control" id="id_forma" name="id_forma">
                      <option selected value="{{$pagos->forma_pago->id}}">{{$pagos->forma_pago->forma}}</option>
                    </select>
                </div>
                
                <div class="col-md-4">
                    <label for="id_forma" name="id_forma">Estatus del pago</label>
                    <select class="form-control" id="estatus_pago" name="estatus_pago">
                      <option  value="PAGADO" >PAGADO</option> 
                      <option  selected value="PENDIENTE" >PENDIENTE</option> 
                    </select>
                </div>
                
            </div>
            <div class="row mt-3">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                  <label for="referencia" >Referencia(caracter)</label>
                  <input type="text" disabled class="form-control"  id="referencia" name='referencia' value="{{$pagos->referencia}}">
                </div>
                <div class="col-md-4"></div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="importe" >Total</label>
                    <input type="text"  disabled  class="form-control"  id="importe" name='importe' value="{{$pagos->total}}">
                </div>
                <div class="col-md-4">
                    <label for="importe_dado">Saldo Pendiente </label>
                    <input type="text" class="form-control" disabled id="saldo_anterior" value="{{$pagos->saldo_pendiente}}" oninput="cal()">
                </div>
                <div class="col-md-4">
                    <label for="importe" >Nuevo importe</label>
                    <input type="text"  class="form-control" id="nuevo_importe" oninput="cal()">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                </div>
                <div class="col-md-4">
                    <label for="importe" >Nuevo Saldo Pendiente</label>
                    <input type="text"  class="form-control"  id="saldo_pendiente" name='saldo_pendiente'>
                </div>
                <div class="col-md-4">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h4 class="mt-4" style="color:white;background-color:orange;font-size:23px;font-weight:bold;text-align:center">Observaciones y comentarios</h4>
                </div>
            </div>
            <div class="row mt-3" style="text-align:center">
                <div class="col-md-12">
                    <input type="text"  alue="{{$pagos->comentarios}}" class="form-control input-sm"  id="comentarios_pagos" name='comentarios_pagos' >
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-6" style="text-align:end;">
                    <button type="submit" class="btn" id="btnGuardar" style="background:rgb(13, 194, 13);color:white;">Guardar</button>
                </div>
                <div class="col-md-6">
                    <a type="button" class="btn" id="btnCancelar" onclick="Update_status({{$pagos->id_orden}});" href="" style="background:red;color:white;" >Cancelar</a>
                </div>
            </div>
        {{-- al actualizar datos se actualizara el estatus de pagado a pagado  --}}
        @endsection
        @section('scripts')
        <script>

        function cal(){
                try{
                    var a = parseFloat(document.getElementById("saldo_anterior").value)||0.00,
                        b = parseFloat(document.getElementById("nuevo_importe").value)||0.00

                    var resultado = (a-b).toFixed(2);
                    document.getElementById("saldo_pendiente").value = resultado;
                }
                catch(e){}
            }
        async function pago_proveedor(id){
        event.preventDefault();
        if (document.getElementById("saldo_pendiente").value!=0.00 && document.getElementById("estatus_pago").value=='PAGADO') {
                 alert("No se puede cambiar el estatus, contiene un saldo pendiente");
            }
        else{
            let form = new FormData(document.getElementById("form-pago"));
            form.append("id_status",3);
            form.append("saldo_pendiente",document.getElementById("saldo_pendiente").value);
            let url = "{{url('/pagos_proveedores2/{id}')}}".replace("{id}",id);
            let init={
                method:"PUT",
                headers:{
                    'X-CSRF-Token': document.getElementsByName("_token")[0].value
                    , "Content-Type": "application/json"
                }
                ,body:JSON.stringify(Object.fromEntries(form))
            }
            let req = await fetch (url,init);
            if(req.ok){
                alert("Pago Realizado");
                window.location.href="{{url('/pagos_proveedores')}}";
            }
            else{
                Swal.fire({
                        icon: 'error'
                        , title: 'Error'
                        , text: 'Error al generar pago'
                    , });
            }
        }
    }
    let flag=0;
    async function Update_status(id){
        let ordenes = id.split(",");
        ordenes.forEach( async element => {
            let url = "{{url('/compras/{id}')}}".replace("{id}",element);
            console.log(url);
            let init = {
            method:"PUT",
            headers:{
                'X-CSRF-Token' : "{{ csrf_token() }}",
                'Content-Type':'application/json'
            },
            body:JSON.stringify({'id_status':2})
            };
            let req =await fetch (url,init);
            if(req.ok){
                if(flag==0){
                    window.location.href="{{url('/pagos_proveedores')}}";
                flag++;}
            }
            else{
            Swal.fire({
                           icon: 'error',
                           title: 'Error',
                           text: "Error al actualizar estatus"
                         });
            }
        });
    }
        </script>
        @endsection