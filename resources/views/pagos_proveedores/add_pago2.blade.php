@extends('layouts.base_html')

@section ('tittle')PAGOS PROVEEDORES @endsection
@php
        $grupales=[];
            foreach ($ordenes as $orden) {
                array_push($grupales,$orden->orden->id);
            }
            $grupales = implode(",",$grupales);
            // var_dump($grupales);
            // die;
@endphp
@section('body')
<div class="container pt-1">

    <div class="col-md-12">
        <h1 class="animate-box fadeInLeft animated" data-animate-effect="fadeInLeft">
            PAGO A PROVEEDOR
        </h1>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h4 style="color:gray;font-size:20px;">-Registrar los siguientes datos para el pago </h4>
            <hr style="color: orange;">
        </div>
    </div>
    <form id="form-pago" class="row g-3" onsubmit='pago_proveedor({{$pagos->id}});'>
        @csrf
            <div class="row mt-3">
                <div class="col-md-4">
                  <label for="fecha_pago" >Fecha de pago</label>
                  <input type="date"  class="form-control"  id="fecha_pago" name='fecha_pago'>
                </div>
                <div class="col-md-4">
                    <label for="id_forma" name="id_forma">Forma de Pago</label>
                    <select class="form-control" id="id_forma" name="id_forma">
                      <option selected disabled value="0" >Seleccione forma de pago:</option>
                      @foreach($formas as $forma)
                      <option value="{{$forma->id}}">{{$forma->forma}}</option>
                      @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="id_forma" name="id_forma">Estatus del pago</label>
                    <select class="form-control" id="estatus_pago" name="estatus_pago">
                      <option selected  value="PAGADO" >PAGADO</option> 
                      <option  value="PENDIENTE" >PENDIENTE</option> 
                    </select>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-4">
                    <label for="referencia" >Referencia(caracter)</label>
                    <input type="text"  class="form-control"  id="referencia" name='referencia'>
                  </div>
                  <div class="col-md-4">
                      <label for="total" >Total a pagar</label>
                      <input type="text" disabled class="form-control" id="total" name="total" value="{{$pagos->total}}">
                  </div>
                  <div class="col-md-4">
                      <label for="importe" >Importe del pago</label>
                      <input type="text"  class="form-control"  id="importe" name='importe'>
                  </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h4 class="mt-4" style="color:white;background-color:orange;font-size:23px;font-weight:bold;text-align:center">Observaciones y comentarios</h4>
                </div>
            </div>
            <div class="row mt-3" style="text-align:center">
                <div class="col-md-12">
                    <input type="text"  class="form-control input-sm"  id="comentarios_pagos" name='comentarios_pagos' >
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-6" style="text-align:end;">
                    <button type="submit" class="btn" id="btnGuardar" style="background:rgb(13, 194, 13);color:white;">Guardar</button>
                </div>
                <div class="col-md-6">
                    
                <a type="button" class="btn" id="btnCancelar" onclick="Update_status('{{$grupales}}');"  style="background:red;color:white;" >Cancelar</a>
                </div>
            </div>
        {{-- al actualizar datos se actualizara el estatus de pagado a pagado  --}}
        @endsection
        @section('scripts')
        <script>
        async function pago_proveedor(id){
        event.preventDefault();
        let res = (document.getElementById("total").value)-(document.getElementById("importe").value);
        let form = new FormData(document.getElementById("form-pago"));
        form.append("id_status",3);
        form.append("saldo_pendiente",res);
        let url = "{{url('pagos_proveedores2/editar_pago/{id}')}}".replace("{id}",id);
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
    let flag=0;
    async function Update_status(id){
        let ordenes = id.split(",");
        ordenes.forEach( async element => {
            let url = "{{url('compras/actualizar/{id}')}}".replace("{id}",element);
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