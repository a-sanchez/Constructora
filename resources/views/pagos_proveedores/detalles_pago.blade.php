@extends('layouts.base_html')
@section('tittle') INFORMACION DEL PAGO
@endsection
@section("styles") 
<link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="{{ asset('lib/DataTables/Responsive-2.2.9/css/responsive.dataTables.min.css') }}">    <style>
        table {
            text-transform: uppercase;
        }

    </style>
@endsection
@section('body')
<div class="container pt-1"  >

    <div class="col-md-12">
        <h1 class="animate-box fadeInLeft animated" data-animate-effect="fadeInLeft">
            PAGO A ROVEEDOR
            {{-- <img src="{{ asset('images/pagado.png') }}"  class="img-fluid" height="150" alt="ConbeLogo"> --}}
        </h1>
    </div>
    <div class="row" >
        <div class="col-md-12">
            <h4 style="color:gray;font-size:20px;">-Detalles del pago</h4>
            <hr style="color: orange;">
        </div>
    </div>

    <form id="form-pago" class="row g-3 " onSubmit='pago_proveedor();'  >
        @csrf
            <div class="row mt-3">
                <div class="col-md-6">
                  <label for="fecha_pago" >Fecha de pago</label>
                  <input type="date" disabled class="form-control"  id="fecha_pago" name='fecha_pago'>
                </div>
                <div class="col-md-6">
                    <label for="fecha_pago" >Forma de Pago</label>
                    <input type="text" disabled class="form-control"  id="forma_pago" name='forma_pago'>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-6">
                  <label for="referencia" >Rerencia(caracter)</label>
                  <input type="text" disabled class="form-control"  id="referencia" name='referencia'>
                </div>
                <div class="col-md-6">
                    <label for="importe" >Importe del pago</label>
                    <input type="text" disabled class="form-control"  id="importe" name='importe'>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h4 class="mt-4" style="color:white;background-color:orange;font-size:23px;font-weight:bold;text-align:center">Observaciones y comentarios</h4>
                </div>
            </div>
            <div class="row mt-3" style="text-align:center">
                <div class="col-md-12">
                    <input type="text" disabled class="form-control input-sm"  id="comentario" name='comentario' >
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-12" style="text-align:center">
                    <a type="button" class="btn" id="btnCancelar" href="{{url("/pagos_proveedores")}}" style="background:red;color:white;" >Regresar</a>
                </div>
            </div>
@endsection