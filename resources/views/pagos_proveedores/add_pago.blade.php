@extends('layouts.base_html')

@section ('tittle')PAGOS PROVEEDORES @endsection

@section('body')
<div class="container pt-1">

    <div class="col-md-12">
        <h1 class="animate-box fadeInLeft animated" data-animate-effect="fadeInLeft">
            PAGO A ROVEEDOR
        </h1>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h4 style="color:gray;font-size:20px;">-Registrar los siguientes datos para el pago</h4>
            <hr style="color: orange;">
        </div>
    </div>

    <form id="form-pago" class="row g-3" onSubmit='pago_proveedor();'>
        @csrf
            <div class="row mt-3">
                <div class="col-md-6">
                  <label for="fecha_pago" >Fecha de pago</label>
                  <input type="date"  class="form-control"  id="fecha_pago" name='fecha_pago'>
                </div>
                <div class="col-md-6">
                    <label for="fecha_pago" >Forma de Pago</label>
                    <input type="text"  class="form-control"  id="forma_pago" name='forma_pago'>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-6">
                  <label for="referencia" >Rerencia(caracter)</label>
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
                    <input type="text"  class="form-control input-sm"  id="comentario" name='comentario' >
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-6" style="text-align:end;">
                    <a type="button" class="btn" id="btnGuardar" style="background:rgb(13, 194, 13);color:white;">Guardar</a>
                </div>
                <div class="col-md-6">
                    <a type="button" class="btn" id="btnCancelar" href="{{url("/pagos_proveedores")}}" style="background:red;color:white;" >Cancelar</a>
                </div>
            </div>
        {{-- al actualizar datos se actualizara el estatus de pagado a pagado  --}}
        @endsection