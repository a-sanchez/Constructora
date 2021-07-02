@extends('layouts.base_html')

@section ('tittle')CONTRATOS @endsection

@section('styles')
@endsection

@section('body')

<div class="row">
    <div class="col-md-12">
        <h1 class="animate-box fadeInLeft animated" data-animate-effect="fadeInLeft">
            CONTRATO
        </h1>

    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <h4 style="color:gray;font-size:20px;">-Agregar</h4>
        <hr style="color:orange;">
    </div>
</div>

<form>
<div class="form-row" >
    <div class="form-group col-md-6">
        <label for="inputhora">Fecha y hora de creacion</label>
        <input type="datetime-local" class="form-control" id="inputhora" >
    </div>
</div>
<div class="form-row" >
    <div class="form-group col-md-6">
        <label for="inputNombre">Nombre</label>
        <input type="text" class="form-control" id="inputNombre" >
    </div>
    <h7>Domicilio</h7>
    <div class="col-auto">
        <label for="inputcalle" >Calle</label>
        <input type="password" class="form-control" id="inputcalle" placeholder="Calle">
    </div>
    <div class="col-auto">
        <label for="inputnumero" >Numero</label>
        <input type="password" class="form-control" id="inputnumero" placeholder="Numero">
    </div>
    <div class="col-auto">
        <label for="inputcolonia" >Colonia</label>
        <input type="password" class="form-control" id="inputcolonia" placeholder="Colonia">
    </div>
    <div class="col-auto">
        <label for="inputcp" >CP</label>
        <input type="password" class="form-control" id="inputcp" placeholder="CP">
    </div>
    <div class="form-row" >
        <div class="form-group col-md-6">
            <label for="inputpago">Pago Acordado</label>
            <input type="text" class="form-control" id="inputpago" >
        </div>
    </div>
</div>
    <div class="form-row">
        <div class="form-group">
            <a type="button" class="btn" id="btnGuardar" style="background:blue;color:white;">Guardar</button>
            <a type="button" class="btn" id="btnCancelar" href="/contrato" style="background:red;color:white;" >Cancelar</a>
        </div>
    </div>
</form>

@endsection
