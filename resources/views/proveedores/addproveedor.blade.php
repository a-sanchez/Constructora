@extends('layouts.base_html')

@section ('tittle')AGREGAR PROVEEDOR @endsection
@section('styles')

@endsection

@section('body')
<div class="row">
    <div class="col-md-12">
        <h1 class="animate-box fadeInLeft animated" data-animate-effect="fadeInLeft">
            PROVEEDORES
        </h1>

    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <h4>-Agregar</h4>
        <hr style="color:orange;">
</div> 

<form>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputnombre">Nombre/Empresa</label>
      <input type="text" class="form-control" id="nombre" placeholder="Nombre/Empresa">
    </div>
    <div class="form-group col-md-6">
      <label for="inputalias">Alias</label>
      <input type="text" class="form-control" id="alias" placeholder="Alias">
    </div>
  </div>
  <div class="form-group col-md-6">
    <label for="inputsocial">Razon social</label>
    <input type="text" class="form-control" id="inputsocial" placeholder="Razon Social">
  </div>
  <div class="form-row">
    <div class="form-group col-md-3">
      <label for="inputCalle">Calle</label>
      <input type="text" class="form-control" id="inputCalle" placeholder="Calle">
    </div>
    <div class="form-group col-md-3">
      <label for="inputnumero">Numero</label>
      <input type="text" class="form-control" id="inputnumero" placeholder="Numero" >
    </div>
    <div class="form-group col-md-3">
      <label for="inputcolonia">Colonia</label>
      <input type="text" class="form-control" id="inputcolonia" placeholder="Colonia" >
    </div>
    <div class="form-group col-md-3">
      <label for="inputCP">CP</label>
      <input type="text" class="form-control" id="inputCP" placeholder="CP" >
    </div>
  </div>

     <div class="form-row">
        <div class="form-group col-md-2">
          <label for="inputstatus">Estatus</label>
          <select name="select" class="form-control">
            <option value="value1" selected>Activo</option>
            <option value="value2">Cancelado</option>
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="col-md-12">
            <p>         </p>
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
