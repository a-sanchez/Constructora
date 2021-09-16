@extends('layouts.base_html')

@section('title')
    PRE-FACTURAS
@endsection

@section('styles')
@endsection


@section('body')
<div class="container pt-1">
<div class="row">
    <div class="col-md-12">
        <h4 style="color:gray;font-size:20px;">-Crear Pre-Factura Contrato</h4>
        <hr style="color: orange;">
    </div>
</div>


<form id="form-prefactura" class="row g-3" onSubmit='insert_prefactura();'>
@csrf
  <div class="row mt-3">
    <div class="col-md-4">
      <label for="folio_prefactura" >Folio de Prefactura</label>
      <input type="text" readonly class="form-control" value="{{$folio_prefactura}}" id="folio_prefactura" name='folio_prefactura'>
  </div>
    <div class="col-md-4">
      <label form="contrato">Folio del Contrato</label>
        <select class="form-control"readonly name="id_contrato" id="id_contrato">
          <option value="{{$contrato->id}}">{{$contrato->folio}}</option>
        </select>
    </div>
    <div class="col-md-4">
      <label for="monto_total" >Monto Total del Contrato</label>
      <input type="text"  class="form-control" id="monto_total" name='monto_total' readonly value="{{$contrato->monto}}">
    </div>
  </div>
  <h4 style="color:white;background-color:orange;font-size:23px;font-weight:bold;text-align:center">Estimación</h4>
  <div class="row">
    <div class="col-md-6">
    <label for="fecha_elaboracion" >Fecha de Inicio</label>
      <input type="date" class="form-control" id="fecha_elaboracion" name="Fecha_Elaboracion" required>
    </div>
      <div class="col-md-6">
        <label for="fecha_elaboracion" >Fecha Final</label>
          <input type="date" class="form-control" id="fecha_final" name="Fecha_final" required>
        </div>
  </div>
  <div class="row">
    <div class="col-md-4">
      <label for="importe_estimacion" >Importe de estimacion</label>
      <input type="text" class="form-control" id="importe_estimacion" placeholder="Ingrese Importe" name="importe_estimacion" required>
    </div>
    <div class="col-md-4">
        <label for="anticipo" >(-) Anticipo Entregado</label>
        <input type="text"  class="form-control" id="anticipo" name='anticipo' readonly value="{{$contrato->anticipo}}">
    </div>
    <div class="col-md-4">
      <label for="sub-total" >Sub-Total</label>
      <input type="text" disabled class="form-control" id="subtotal" name='subtotal' value="0.00">
  </div>
</div>
  <div class="row">
    <div class="col-md-12">
      <label for="concepto">Concepto de la estimación</label>
      <input type="text" class="form-control" id="concepto" name="concepto">
    </div>
  </div>

  <div class="row mt-2">
    <div class="col-md-6">
      <label for="iva" >% de I.V.A</label>
      <input type="text" class="form-control" id="iva" placeholder="Ingrese el iva correspondiente" name="iva" required>
    </div>
    <div class="col-md-6">
        <label for="total_estimacion" >Total de estimación</label>
        <input type="text" disabled  class="form-control" id="total_estimacion" name='total_estimacion' value="0.00">
    </div>
  </div>

  <h4 style="color:white;background-color:orange;font-size:23px;font-weight:bold;text-align:center">Retenciones</h4>
  <div class="row mt-3">
    <div class="col-md-6">
      <label for="IVYC" >I.V.Y.C (0.05%)</label>
      <input type="text" class="form-control" id="IVYC" name="IVYC" >
    </div>
    <div class="col-md-6">
      <label for="primer_monto" >Monto con I.V.Y.C </label>
      <input type="text" disabled class="form-control" id="primer_monto" name="primer_monto" value="0.00" >
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <label for="ICIC" >I.C.I.C (0.02%)</label>
      <input type="text"  class="form-control" id="ICIC" name="ICIC"  >
    </div>
    <div class="col-md-6">
      <label for="segundo_monto" >Monto con I.C.I.C </label>
      <input type="text" disabled class="form-control" id="segundo_monto"  name="segundo_monto" value="0.00" >
    </div>
  </div>

  <h4 style="color:white;background-color:orange;font-size:23px;font-weight:bold;text-align:center">Total neto de la estimación</h4>
  <div class="row mt-3">
    <div class="col-md-4">
    </div>
    <div class="col-md-4" style="text-align:center">
      <label for="neto" >Neto de la estimación </label>
      <input type="text" disabled class="form-control" id="neto" name="neto" value="0.00">
    </div>
    <div class="col-md-4">
    </div>
  </div>

  <div class="form-row">
    <div class="form-group">
        <a type="button" class="btn" id="btnGuardar" style="background:blue;color:white;">Guardar</button>
        <a type="button" class="btn" id="btnCancelar" href="{{url("/contratos")}}" style="background:red;color:white;" >Cancelar</a>
    </div>
  </div>

</form>
</div>

@endsection