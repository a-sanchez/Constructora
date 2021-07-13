@extends('layouts.base_html')

@section ('tittle')AGREGAR CLIENTE @endsection
@section('styles')

@endsection

@section('body')

<div class="container">
<div class="col-md-12">
                <h1 class="animate-box fadeInLeft animated" data-animate-effect="fadeInLeft">
                    CLIENTES
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

<form id="form-cliente" class="row g-3" onSubmit='insert_cliente();'>
@csrf
<div class="row">
    <div class="col-md-4">
    <label for="cliente" >Nombre del Cliente o Empresa</label>
    <input type="text" class="form-control" id="cliente" name='cliente'placeholder="Nombre" required>
  </div>
  <div class="col-md-4">
    <label for="razon_social" >Razon social</label>
    <input type="text" class="form-control" id="razon_social" placeholder="Razon Social" name="razon_social" required>
  </div>
  <div class="col-auto">
    <label for="alias" >Alias</label>
    <input type="text" class="form-control" id="alias" placeholder="Alias" name="alias" required>
  </div>
  <div class="col-auto">
    <label for="telefono" >Telefono</label>
    <input type="text" class="form-control" id="telefono" placeholder="Telefono" name="telefono" required>
  </div>
  <div class="col-auto">
    <label for="telefono2" >Telefono</label>
    <input type="text" class="form-control" id="telefono2" placeholder="Telefono" name="telefono2" required>
  </div>
  <div class="col-md-4">
    <label for="email" >Email</label>
    <input type="email" class="form-control" id="email" placeholder="Email" name="email" required>
  </div>
  <div class="col-md-4">
    <label for="contacto_pago" >Contacto Pago</label>
    <input type="text" class="form-control" id="contacto_pago" placeholder="Contacto Pago" name="contacto_pago" required>
  </div>
</div>
<div class="row">
<h7 style="font-weight:bold;">Direccion</h7>
      <div class="col-md-4">
        <label for="localidad" >Localidad</label>
        <input type="text" class="form-control" id="localidad" placeholder="Localidad" name="localidad" required>
      </div>
      <div class="col-md-4">
            <label for="calle" >Calle</label>
        <input type="text" class="form-control" id="calle" placeholder="Calle" name="calle" required>
      </div>
      <div class="col-auto">
        <label for="numero" >Numero</label>
        <input type="text" class="form-control" id="numero" placeholder="Numero" name="numero" required pattern="[0-9\.]+">
      </div>
      <div class="col-md-4">
        <label for="colonia" >Colonia</label>
        <input type="text" class="form-control" id="colonia" placeholder="Colonia" name="colonia" required>
      </div>
      <div class="col-auto">
        <label for="cp" >CP</label>
        <input type="text" class="form-control" id="cp" placeholder="CP" name="cp" required pattern="[0-9\.]+">
    </div>
</div>
<div class="form-row">
        <div class="form-group">
            <button type="submit" class="btn" id="btnGuardar" style="background:blue;color:white;">Guardar</button>
            <a type="button" class="btn" id="btnCancelar" href="/clientes_opciones" style="background:red;color:white;" >Cancelar</a>
        </div>
  </div>
</form>

@endsection

@section("scripts")
<script>
  async function insert_cliente(){
    event.preventDefault();
    let form = new FormData(document.getElementById("form-cliente"));
    let url = "{{ url('/clientes') }}";
    let init = {
      method:"POST",
      body:form
    }
    let req = await fetch(url, init);
    console.log(req);
    if (req.ok) {
      window.location.href = "{{ url('/clientes') }}";
    }
    else{
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: "Error al registrar cliente"
      });
    }
  }
</script>
@endsection