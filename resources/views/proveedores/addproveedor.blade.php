@extends('layouts.base_html')

@section ('tittle')AGREGAR PROVEEDOR @endsection
@section('styles')

@endsection

@section('body')

<div class="container">
<div class="col-md-12">
                <h1 class="animate-box fadeInLeft animated" data-animate-effect="fadeInLeft">
                    PROVEEDORES
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

<form id="form-proveedor" class="row g-3" onSubmit='insert_proveedor();'>
@csrf
<div class="row">
    <div class="col-md-3">
    <label for="nombre_empresa" >Nombre/Empresa</label>
    <input type="text" class="form-control" id="nombre_empresa" name='nombre_empresa'placeholder="Nombre/Empresa" >
  </div>
  <div class="col-md-3">
    <label for="alias" >Alias</label>
    <input type="text" class="form-control" id="alias" placeholder="Alias" name="alias" required>
  </div>
  <div class="col-md-3">
    <label for="razon_social" >Razon social</label>
    <input type="text" class="form-control" id="razon_social" placeholder="Razon Social" name="razon_social" required>
  </div>
  <div class="col-md-3">
    <label for="localidad" >Localidad</label>
    <input type="text" class="form-control" id="localidad" placeholder="Localidad" name="localidad" required>
  </div>
</div>
<div class="row">
<h7 style="font-weight:bold;">Contacto</h7>
  <div class="col-md-3">
        <label for="telefono" >Telefono</label>
    <input type="text" class="form-control" id="telefono" placeholder="Telefono" name="telefono" required>
  </div>
      <div class="col-md-3">
        <label for="telefono2" >Telefono</label>
        <input type="text" class="form-control" id="telefono2" placeholder="Telefono" name="telefono2" >
      </div>
      <div class="col-md-3">
        <label for="email" >Email</label>
        <input type="email" class="form-control" id="email" placeholder="Email" name="email" required>
      </div>
      <div class="col-md-3">
        <label for="email2" >Email</label>
        <input type="email" class="form-control" id="email2" placeholder="Email" name="email2" >
    </div>
</div>
<div class="row">
  <div class="col-md-6">
  <label for="contacto_ventas" >Contacto Ventas</label>
    <input type="text" class="form-control" id="contacto_ventas" placeholder="Contacto Ventas" name="contacto_ventas" >
  </div>
  <div class="col-md-6">
  <label for="contacto_pagos" >Contacto Pagos</label>
    <input type="text" class="form-control" id="contacto_pagos" placeholder="Contacto Pagos" name="contacto_pagos" >
  </div>
</div>
<div class="form-row">
        <div class="form-group">
            <button type="submit" class="btn" id="btnGuardar" style="background:blue;color:white;">Guardar</button>
            <a type="button" class="btn" id="btnCancelar" href="/proveedores" style="background:red;color:white;" >Cancelar</a>
        </div>
  </div>
</form>

@endsection
@section("scripts")
<script>
  async function insert_proveedor(){
    event.preventDefault();
    let form = new FormData(document.getElementById("form-proveedor"));
    let url = "{{ url('/proveedores') }}";
    let init = {
      method:"POST",
      body:form
    }
    let req = await fetch(url, init);
    if (req.ok) {
      window.location.href = "{{ url('/proveedores') }}";
    }
    else{
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: "Error al registrar proveedor"
      });
    }
  }
</script>
@endsection