@extends('layouts.base_html')

@section ('tittle')PAGO DETALLE
@endsection

@section('body')
<div class="container">
    <div class="col-md-12">
        <h1 class="animate-box fadeInLeft animated" data-animate-effect="fadeInLeft">
            PAGOS 
        </h1>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h4 style="color:gray;font-size:20px;">-DETALLES</h4>
            <hr style="color: orange;">
        </div>
    </div>
    <form id="form-pago" class="row g-3" onsubmit='update_pago({{$prefactura->id}});'>
        @csrf
        <div class="row mt-3">
            <div class="col-md-6">
              <label for="fecha_pago" >Fecha de pago</label>
              <input type="date" disabled class="form-control"  value="{{$prefactura->fecha_pago}}" id="fecha_pago" name='fecha_pago'>
            </div>
            <div class=" col-md-6">
                <label for="id_forma" name="id_forma">Forma de pago</label>
                <input type="text" class="form-control" readonly value="{{$prefactura->forma_pago->forma}}">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h4 class="mt-4" style="color:white;background-color:orange;font-size:23px;font-weight:bold;text-align:center">Observaciones y comentarios</h4>
            </div>
        </div>
        <div class="row mt-3" style="text-align:center">
            <div class="col-md-12">
                <input type="text"  disabled class="form-control"  value="{{$prefactura->comentario}}" id="comentario" name='comentario' >
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-6">
                <a type="button" class="btn" id="btnCancelar" href="{{url("/facturas")}}" style="background:red;color:white;" >Regresar</a>
            </div>
        </div>
    @endsection