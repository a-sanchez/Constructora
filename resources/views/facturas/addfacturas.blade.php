@extends('layouts.base_html')

@section('title')
    PRE-FACTURAS
@endsection

@section('styles')
@endsection


@section('body')
<div class="container">
<div class="row">
    <div class="col-md-12">
        <h4 style="color:gray;font-size:20px;">-Crear Pre-Factura Cliente</h4>
        <hr style="color: orange;">
    </div>
</div>


<form id="form-prefactura" class="row g-3" onSubmit='insert_prefactura();'>
@csrf
  <div class="row">
    <div class="col-md-6">
      <label form="contrato">Contrato</label>
        <select class="form-control" name="id_contrato" id="id_contrato">
          <option disabled value="0" selected>Seleccione</option>
            <option value="0">p1</option>
        </select>
    </div>
    <div class="col-md-6">
        <label for="folio_prefactura" >Folio de Prefactura</label>
        <input type="text" class="form-control" id="folio_prefactura" name='folio_prefactura'placeholder="Folio de Pre-Factura" required>
    </div>
  </div>
  <!--div class="row mt-3" >
    <div class="col-md-6 d-flex align-items-center">
  <label for="semana_prefactura" style="white-space: nowrap;">Semana del </label>
    <input type="date" style="margin-left: 10px;"class="form-control" id="semana_prefactura" name="semana_prefactura" >
    </div>
    <div class="col-md-6 d-flex align-items-center" >
      <label for="semanafin_pefactura" style="margin-right: 10px;" >al </label>
      <input type="date" class="form-control" id="semanafin_pefactura"  name="semanafin_pefactura">
    </div>
  </div-->

  <div class="row">
    <div class="col-md-6">
      <label for="monto_total" >Monto Total del Contrato</label>
      <input type="text" disabled class="form-control" id="monto_total" name='monto_total'>
    </div>
    <div class="col-md-6">
    <label for="fecha_elaboracion" >Fecha Elaboracion Pre-Factura</label>
      <input type="date" class="form-control" id="fecha_elaboracion" name="Fecha_Elaboracion" required>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <label for="importe_estimacion" >Importe de estimacion</label>
      <input type="text" class="form-control" id="importe_estimacion" placeholder="Ingrese Importe" name="importe_estimacion" required>
    </div>
    <div class="col-md-6">
        <label for="anticipo" >(-) Anticipo Entregado</label>
        <input type="text" disabled class="form-control" id="anticipo" name='anticipo'>
    </div>
</div>

  <div class="row">
  <h7 style="font-weight:bold;">Retenciones</h7>
  </div>

  <div class="row">
    <div class="col-md-6">
      <label for="IVYC" >I.V.Y.C (0.05%)</label>
      <input type="text" class="form-control" id="IVYC" name="IVYC" >
    </div>
    <div class="col-md-6">
      <label for="ICIC" >I.C.I.C (0.02%)</label>
      <input type="text" class="form-control" id="ICIC"  name="ICIC" >
    </div>
  </div>
  <div class="row">
    <p> </p>
  </div>
  <div class="row">
    <div class="col-md-6">
    <label for="file" >Adjuntar Pre-Factura:</label>
      <input type="file" class="form-control" id="file" name="file" style="border:none;">
    </div>
  </div>

  <div class="form-row">
    <div class="form-group">
        <a type="button" class="btn" id="btnGuardar" style="background:blue;color:white;">Guardar</button>
        <a type="button" class="btn" id="btnCancelar" href="facturas/cat_facturas" style="background:red;color:white;" >Cancelar</a>
    </div>
  </div>

</form>
</div>

@endsection