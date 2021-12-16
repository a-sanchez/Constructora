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
                <div class="col-md-6">
                  <label for="referencia" >Referencia(caracter)</label>
                  <input type="text"  class="form-control"  id="referencia" name='referencia'>
                </div>
                <div class="col-md-6">
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
                    <a type="button" class="btn" id="btnCancelar" onclick="cancelar({{$pagos->id_orden}});" href="" style="background:red;color:white;" >Cancelar</a>
                </div>
            </div>
        {{-- al actualizar datos se actualizara el estatus de pagado a pagado  --}}
        @endsection
 @section('scripts')
 <script>
 async function pago_proveedor(id){
     event.preventDefault();
     let form = new FormData(document.getElementById("form-pago"));
     form.append("id_status",3);
     let url = "{{url('/pagos_proveedores/{id}')}}".replace("{id}",id);
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
         window.location.href="{{url('/pagos_proveedores')}}";
     }
     else{
         Swal.fire({
                 icon: 'error'
                 , title: 'Error'
                 , text: 'Error al generar pago'
             });
     }
}

async function cancelar(id){
    event.preventDefault();
    let url="{{url('/compras/{id}')}}".replace("{id}",id);
    console.log(url);
    let init={
        method:"PUT",
        headers:{
            'X-CSRF-Token' : "{{ csrf_token() }}",
            'Content-Type':'application/json'
        },
        body:JSON.stringify({'id_status':2})        
    };
    let req = await fetch(url,init);
    if (req.ok) {
       window.location.href="{{url('/pagos_proveedores')}}";
    }
    else{
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'ERROR AL ACTUALIZAR ESTATUS DE ORDEN'
        });
    }  
}
 </script>
 @endsection