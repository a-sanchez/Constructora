@extends('layouts.base_html')

@section('title')
    FACTURAS
@endsection

@section('styles')
@endsection


@section('body')
<div class="container">
<div class="row">
    <div class="col-md-12">
        <h4 style="color:gray;font-size:20px;">-Crear Factura</h4>
        <hr style="color: orange;">
    </div>
</div>
<h5>Contratante</h5>

<form class="row g-3">
    <div class="form-row" >
        <div class="form-group col-md-6">
            <label for="inputNombre">Nombre</label>
            <input type="text" class="form-control" id="inputNombre" >
        </div>
    </div>
    <h7>Direccion</h7>
    <div class="col-auto">
    <label for="inputcalle" >Calle</label>
    <input type="text" class="form-control" id="inputcalle" placeholder="Calle">
  </div>
  <div class="col-auto">
    <label for="inputnumero" >Numero</label>
    <input type="text" class="form-control" id="inputnumero" placeholder="Numero">
  </div>
  <div class="col-auto">
    <label for="inputcolonia" >Colonia</label>
    <input type="text" class="form-control" id="inputcolonia" placeholder="Colonia">
  </div>
  <div class="col-auto">
    <label for="inputcp" >CP</label>
    <input type="text" class="form-control" id="inputcp" placeholder="CP">
  </div>




  <hr style="color: orange;">
  <h5>Contraparte</h5>
  <div class="form-row" >
        <div class="form-group col-md-6">
            <label for="inputNombre2">Nombre</label>
            <input type="text" class="form-control" id="inputNombre2" >
        </div>
    </div>
    <h7>Direccion</h7>
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

    <hr style="color:orange;">
    <h5>Construccion</h5>
    <div class="form-row" >
        <div class="form-group col-md-6">
            <label for="inputhora">Fecha y hora emision</label>
            <input type="datetime-local" class="form-control" id="inputhora" >
        </div>
    </div>
    <h7>Direccion de la construccion</h7>
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
    <div class="form-row" >
        <div class="form-group col-md-6">
            <label for="inputpago">Pago Acordado</label>
            <input type="text" class="form-control" id="inputpago" >
        </div>
    </div>
    <div class="form-row" >
        <div class="form-group col-md-6">
            <label for="inputImporte">Importe</label>
            <input type="text" class="form-control" id="inputImporte" >
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
            <a type="button" class="btn" id="btnCancelar" href="/facturas" style="background:red;color:white;" >Cancelar</a>
        </div>
  </div>

</form>
</div>

@endsection