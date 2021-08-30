@extends('layouts.base_html')
@section('tittle') CONFIGURACIÓN @endsection 


@section('body')
<div class="row">
    <div class="col-md-12">
        <h1 class="animate-box fadeInLeft animated" data-animate-effect="fadeInLeft">
        PERMISOS
        </h1>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <h4 style="color:gray;font-size:20px;">-Agregar permisos</h4>
        <hr style="color: orange;">
        <p>
        </p>
    </div>
</div>
<a type="button" class="btn btn-warning" href="{{url("/configuracion/listado")}}" style="color:white;">Listado de Usuarios</a>
<a type="button" class="btn btn-danger" href="#" style="color:white;">Guardar</a>
<form>
<hr style="color: orange;">
    <div class="form-row" >
        <div class="col-md-6" style="text-align:center">
        <select class="form-select" id="id_usuario" name="id_usuario">
            <option value="0">Seleccione usuario</option>
            @foreach($users as $user)
            <option value="{{$user->id}}">{{$user->name}}</option>
            @endforeach
        </select>
        </div>
    </div>
    <p></p>
    <div class="form-row">
        <div class="form-group">
            <label><input type="checkbox" id="check_cliente" value=""> CLIENTE </label><br>
            <label><input type="checkbox" id="check_contrato" value=""> CONTRATO</label><br>
            <label><input type="checkbox" id="check_orden" value=""> ORDEN DE COMPRA</label><br>
            <label><input type="checkbox" id="check_estimacion" value=""> PRE-FACTURAS</label><br>
            <label><input type="checkbox" id="check_pagos" value=""> PAGOS</label><br>
            <label><input type="checkbox" id="check_prov" value=""> PROVEEDORES</label><br>
            <label><input type="checkbox" id="check_conf" value=""> CONFIGURACION</label><br>
        </div>
    </div>

</form>

@endsection

@section('scripts')

@endsection