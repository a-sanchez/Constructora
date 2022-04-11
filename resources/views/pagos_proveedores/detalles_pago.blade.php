@extends('layouts.base_html')
@section('tittle') INFORMACION DEL PAGO
@endsection
@section("styles") 
<link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="{{ asset('lib/DataTables/Responsive-2.2.9/css/responsive.dataTables.min.css') }}">    <style>
        table {
            text-transform: uppercase;
        }

    </style>
@endsection
@section('body')
<div class="container pt-1"  >

    <div class="col-md-12">
        <h1 class="animate-box fadeInLeft animated" data-animate-effect="fadeInLeft">
            PAGO A ROVEEDOR
            {{-- <img src="{{ asset('images/pagado.png') }}"  class="img-fluid" height="150" alt="ConbeLogo"> --}}
        </h1>
    </div>
    <div class="row" >
        <div class="col-md-12">
            <h4 style="color:gray;font-size:20px;">-Detalles del pago</h4>
            <hr style="color: orange;">
        </div>
    </div>

    <form id="form-pago" class="row g-3 " onsubmit='pago_proveedor({{$pagos->id}});'  >
        @csrf
            <div class="row mt-3">
                <div class="col-md-6">
                  <label for="fecha_pago" >Fecha de pago</label>
                  <input type="date" disabled class="form-control" value="{{$pagos->fecha_pago}}" id="fecha_pago" name='fecha_pago'>
                </div>
                <div class="col-md-6">
                    <label for="fecha_pago" >Forma de Pago</label>
                    <input type="text" disabled class="form-control" value="{{$pagos->forma_pago->forma}}" id="forma_pago" name='forma_pago'>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-6">
                  <label for="referencia" >Referencia(caracter)</label>
                  <input type="text" disabled class="form-control" value="{{$pagos->referencia}}" id="referencia" name='referencia'>
                </div>
                <div class="col-md-6">
                    <label for="importe" >Total del pago</label>
                    <input type="text" disabled class="form-control" value="{{$pagos->total}}" id="importe" name='importe'>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h4 class="mt-4" style="color:white;background-color:orange;font-size:23px;font-weight:bold;text-align:center">Observaciones y comentarios</h4>
                </div>
            </div>
            <div class="row mt-3" style="text-align:center">
                <div class="col-md-12">
                    <input type="text"  class="form-control input-sm" value="{{$pagos->comentarios_pagos}}" id="comentario" name='comentarios_pagos' >
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-12" style="text-align:center">
                    <button type="submit" class="btn" id="guardar" style="background:blue;color:white;" >Guardar Cambios</button>
                    <a type="button" class="btn" id="btnCancelar" href="{{url("/pagos_proveedores")}}" style="background:red;color:white;" >Regresar</a>
                </div>
            </div>
    </form>
</div>

@endsection
@section('scripts')
<script>
     async function pago_proveedor(id){
     event.preventDefault();
     let form = new FormData(document.getElementById("form-pago"));
     let url = "{{url('/pagos_proveedores/editar_pago/{id}')}}".replace("{id}",id);
     let init={
         method:"POST",
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
</script>
@endsection