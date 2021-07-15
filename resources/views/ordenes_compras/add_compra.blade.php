@extends('layouts.base_html')

@section ('tittle')AGREGAR ORDEN DE COMPRA @endsection
@section('styles')

@endsection

@section('body')

<div class="container">
<div class="col-md-12">
                <h1 class="animate-box fadeInLeft animated" data-animate-effect="fadeInLeft">
                    ORDEN DE COMPRA
                </h1>
            </div>
<div class="row">
    <div class="col-md-12">
        <h4 style="color:gray;font-size:20px;">-Agregar</h4>
        <hr style="color: orange;">
        <p>  
        </p>
    </div>
</div>

<form id="form-orden" class="row g-3" onSubmit='insert_orden();'>
@csrf
<div class="row">
  <div class="col-md-4">
    <label for="folio_orden" >Folio de Contrato</label>
    <select class="form-control" disabled name="id_contrato" id="id_contrato">
      <option value="{{$contrato->id}}">{{$contrato->folio}}</option>
    </select>
  </div>
    <div class="col-md-4">
    <label for="folio_orden" >Folio de Orden de Compra</label>
    <input type="text" class="form-control" id="folio_orden" name='folio_orden'placeholder="Folio de Orden de Compra" required>
  </div>
  <div class="col-md-4">
    <label form="proveedor">Proveedor</label>
    <select class="form-control" name="id_proveedor" id="id_proveedor">
      <option disabled value="0">Seleccione</option>
    </select>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <label for="solicitado" >Solicitado Por:</label>
    <input type="text" class="form-control" id="solicitado" placeholder="Ingrese Nombre" name="solicitado" required>
  </div>
</div>
<div class="row">
  <p> </p>
</div>
<div class="row">
<h7 style="font-weight:bold;">Información:</h7>
  <div class="col-md-6">
    <label for="fecha_orden" >Fecha de Elaboracion</label>
    <input type="date" class="form-control" id="fecha_orden"  name="fecha_orden" required>
  </div>
  <div class="col-md-6">
    <label for="fecha_entrega">Fecha de Entrega</label>
    <input type="date" class="form-control" id="fecha_entrega" name="fecha_entrega" required>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <label for="descripcion_orden" >Descripcion orden de compra</label>
    <input type="text" class="form-control" id="descripcion_orden" placeholder="Descripcion orden de compra" name="descripcion_orden" required >
  </div>
</div>
<h7 style="font-weight:bold;">Productos:</h7>
<div class="row">
  <div class="col-md-4">
    <label for="importe_orden" >Importe</label>
    <input type="text" class="form-control" id="importe_orden" placeholder="Importe" name="importe_orden" required>
  </div>

</div>
      <div class="col-auto">
        <label for="adjunto_compra" >Ajuntar Orden de Compra</label>
        <input type="file" class="form-control" id="adjunto_compra" placeholder="Adjuntar Orden de Compra" name="adjunto_compra" style="border:none">
    </div>
</div>
<div class="form-row">
        <div class="form-group">
            <button type="submit" class="btn" id="btnGuardar" style="background:blue;color:white;">Guardar</button>
            <a type="button" class="btn" id="btnCancelar" href="/compras_opciones" style="background:red;color:white;" >Cancelar</a>
        </div>
  </div>
</form>
@endsection

@section("scripts")
<script>
  async function insert_orden(){
    event.preventDefault();
    let form = new FormData(document.getElementById("form-orden"));
    form.append("id_contrato",document.getElementById("id_contrato").value);
    let url = "{{ url('/compras') }}";
    let init = {
      method:"POST",
      body:form
    }
    let req = await fetch(url, init);
    console.log(req);
    if (req.ok) {
      window.location.href = "{{ url('/compras') }}";
    }
    else{
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: "Error al registrar la orden de compra"
      });
    }
  }
</script>
@endsection