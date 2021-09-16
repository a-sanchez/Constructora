@extends('layouts.base_html')

@section('title')
@endsection
@section('body')
<div class="container pt-1">
<div class="col-md-12">
    <h1 class="animate-box fadeInLeft animated" data-animate-effect="fadeInLeft">
        FACTURAR
    </h1>
</div>
<div class="row">
    <div class="col-md-12">
        <h4 style="color:gray;font-size:20px;">-Crear Factura</h4>
        <hr style="color: orange;">
    </div>
</div>

<form id="form-factura" class="row g-3" onSubmit='update_factura();'>
@csrf
    <div class="row mt-3">
        <div class="col-md-6">
          <label for="folio_factura" >Folio de factura</label>
          <input type="text"  class="form-control"  id="folio_factura" name='folio_factura'>
        </div>
        <div class="col-md-6">
            <label for="estatus" >Seleccione nuevo estatus</label>
            <select name="estatus" class="form-control">
                <option value="0" >Vigente</option>
                <option value="1" >Operada</option>
              </select>
        </div>
    </div>
    <h4 class="mt-4" style="color:white;background-color:orange;font-size:23px;font-weight:bold;text-align:center">Adjuntar archivos</h4>
    <div class="row mt-3" style="text-align:center">
        <div class="col-md-6">
            <label for="file" >Adjuntar PDF de la factura oficial:</label>
            <input type="file" class="form-control" id="file" name="file" style="border:none;text-align:center">
        </div>
        <div class="col-md-6">
            <label for="file" >Adjuntar XML de la factura oficial:</label>
            <input type="file" class="form-control" id="file2" name="file2" style="border:none;text-align:center">
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-6" style="text-align:end;">
            <a type="button" class="btn" id="btnGuardar" style="background:rgb(13, 194, 13);color:white;">Guardar</a>
        </div>
        <div class="col-md-6">
            <a type="button" class="btn" id="btnCancelar" href="{{url("/facturas")}}" style="background:red;color:white;" >Cancelar</a>
        </div>
    </div>
    {{-- estatus de pagado estara en faltante --}}

@endsection