@extends('layouts.base_html')
@section('tittle') OPERAR ORDEN DE COMPRA
@endsection

@section('body')

<div class="container">
    <div class="col-md-12">
        <h1 class="animate-box fadeInLeft animated" data-animate-effect="fadeInLeft">
            OPERAR ORDEN DE COMPRA
        </h1>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h4 style="color:gray;font-size:20px;">-Rellena los siguientes campos</h4>
            <hr style="color: orange;">
            <p>  
            </p>
        </div>
    </div>
    <form  class="row g-3" id="form-operar" onSubmit='insert_operar()'>
        @csrf
        <div class="row">
            <div class="col-md-4">
                <label for="folio_factura" >Folio de factura</label>
                <input type="text"  class="form-control" id="folio_factura" name='folio_factura' required>  
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-6">
                <label for="fecha_emision">Fecha de emisión</label>
                <input type="date" class="form-control" id="fecha_emision" name="fecha_emision">
            </div>
            <div class="col-md-6">
                <label for="fecha_vencimiento">Fecha de vencimiento</label>
                <input type="date" class="form-control" id="fecha_vencimiento" name="fecha_vencimiento">
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-4">
                <label for="subtotal">SubTotal</label>
                <input type="text" class="form-control" id="subtotal" name="subtotal">
            </div>
            <div class="col-md-4">
                <label for="impuestos">Impuestos</label>
                <input type="text" class="form-control" id="impuestos" name="impuestos">
            </div>
            <div class="col-md-4">
                <label for="total">Total</label>
                <input type="text" class="form-control" id="total" name="total">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h4 class="mt-4" style="color:white;background-color:orange;font-size:23px;font-weight:bold;text-align:center">Observaciones y comentarios</h4>
            </div>
            </div>
        <div class="row mt-3" style="text-align:center">
            <div class="col-md-12">
                <label for="comentario" class="label">Ingrese las observaciones y comentarios</label>
                <input type="text"  class="form-control input-sm"  id="comentario" name='comentario' >
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-6" style="text-align:end;">
                <a type="button" href="{{url('/pagos_proveedores')}}" class="btn" id="btnGuardar" style="background:rgb(13, 194, 13);color:white;">Guardar</a>
            </div>
            <div class="col-md-6">
                <a type="button" class="btn" id="btnCancelar" href="{{url("/compras")}}" style="background:red;color:white;" >Cancelar</a>
            </div>
        </div>
    </form>
</div>
@endsection