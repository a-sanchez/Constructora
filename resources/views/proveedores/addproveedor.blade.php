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

<form class="row g-3">
<div class="row">
    <div class="col-md-4">
    <label for="inputempresa" >Nombre/Empresa</label>
    <input type="text" class="form-control" id="inputempresa" placeholder="Nombre/Empresa">
  </div>
  <div class="col-md-4">
    <label for="inputalias" >Alias</label>
    <input type="text" class="form-control" id="inputalias" placeholder="Alias">
  </div>
  <div class="col-md-4">
    <label for="inputrazon" >Razon social</label>
    <input type="text" class="form-control" id="inputrazon" placeholder="Razon Social">
  </div>
</div>
<div class="row">
<h7 style="font-weight:bold;">Direccion</h7>
  <div class="col-auto">
        <label for="inputcalle2" >Calle</label>
    <input type="text" class="form-control" id="inputcalle2" placeholder="Calle">
  </div>
      <div class="col-auto">
        <label for="inputnumero2" >Numero</label>
        <input type="text" class="form-control" id="inputnumero2" placeholder="Numero">
      </div>
      <div class="col-auto">
        <label for="inputcolonia2" >Colonia</label>
        <input type="text" class="form-control" id="inputcolonia2" placeholder="Colonia">
      </div>
      <div class="col-auto">
        <label for="inputcp2" >CP</label>
        <input type="text" class="form-control" id="inputcp2" placeholder="CP">
    </div>
</div>
<div class="form-row">
        <div class="form-group">
            <a type="button" class="btn" id="btnGuardar" style="background:blue;color:white;">Guardar</button>
            <a type="button" class="btn" id="btnCancelar" href="/proveedores" style="background:red;color:white;" >Cancelar</a>
        </div>
  </div>
</form>




  


@endsection
