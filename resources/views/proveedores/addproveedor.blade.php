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
    <input type="text" class="form-control" id="nombre_empresa" name='nombre_empresa'placeholder="Nombre/Empresa" required>
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
    <label for="rfc" >R.F.C.</label>
    <input type="text" class="form-control" id="rfc" placeholder="Razon Social" name="rfc" required>
  </div>
</div>
<div class="row">
<h7 style="font-weight:bold;">Direccion</h7>
  <div class="col-auto">
        <label for="calle" >Calle</label>
    <input type="text" class="form-control" id="calle" placeholder="Calle" name="calle" required>
  </div>
      <div class="col-auto">
        <label for="numero" >Numero</label>
        <input type="text" class="form-control" id="numero" placeholder="Numero" name="numero" required pattern="[0-9\.]+">
      </div>
      <div class="col-auto">
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