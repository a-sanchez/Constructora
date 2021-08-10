@extends('layouts.base_html')

@section ('tittle')DETALLES CLIENTE @endsection
@section('styles')
<link rel="stylesheet" href="{{asset("lib/DataTables/DataTables-1.10.25/css/dataTables.bootstrap5.min.css")}}">
<link rel="stylesheet" href="{{asset("lib/DataTables/Responsive-2.2.9/css/responsive.dataTables.min.css")}}">

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
            <h4 style="color:gray;font-size:20px;">-DETALLES</h4>
            <hr style="color: orange;">
            <p>
            </p>
        </div>
    </div>

    <form id="form-cliente" class="row g-3">
        @csrf
        <div class="row mb-2">
            <div class="col-md-4">
                <label for="cliente">RFC</label>
                <input type="text" class="form-control" id="cliente" name='cliente' readonly value="{{$cliente->cliente}}" required>
            </div>
            <div class="col-md-4">
                <label for="razon_social">Razon social</label>
                <input type="text" class="form-control" id="razon_social" readonly value="{{$cliente->razon_social}}" name="razon_social" required>
            </div>
            <div class="col-md-4">
                <label for="alias">Alias</label>
                <input type="text" class="form-control" id="alias" readonly value="{{$cliente->alias}}" name="alias" required>
            </div>
        </div>

        <hr style="color: orange;">



        <div class="row">
            <h5 style="font-weight:bold;">Direccion</h5>
            <div class="col-md-4">
                <label for="calle">Calle</label>
                <input type="text" class="form-control" id="calle" readonly value="{{$cliente->calle}}" name="calle" required>
            </div>
            <div class="col-md-4">
                <label for="numero">Numero</label>
                <input type="text" class="form-control" id="numero" readonly value="{{$cliente->numero}}" name="numero">
            </div>
            <div class="col-md-4">
                <label for="colonia">Colonia</label>
                <input type="text" class="form-control" id="colonia" readonly value="{{$cliente->colonia}}" name="colonia" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="cp">CP</label>
                <input type="text" class="form-control" id="cp" readonly value="{{$cliente->cp}}" name="cp">
            </div>
            <div class="col-md-4">
                <label for="localidad">Localidad</label>
                <input type="text" class="form-control" id="localidad" readonly value="{{$cliente->localidad}}" name="localidad" required>
            </div>
        </div>

        <hr style="color: orange;">
    </form>
    <div class="row">
        <input type="text" name="cliente_id" id="cliente_id" value='{{$cliente->id}}' hidden>
        <h5 style="font-weight:bold;">Contacto</h5>
        <br>
        <div class="col-md-12">
            <div class="row">
                <div class="col-sm-9">
                    {{-- <h6>Contacto Clientes</h6> --}}
                </div>
                <div class="col-sm-3" style="text-align: end;">
                    {{-- <button class="btn btn-success" onclick="agregarContactoCliente();" >Agregar</button> --}}
                </div>
            </div>
            <div class="row">
                {{-- <div class="col-md-4">
      <label for="email_cliente">Email</label>
      <input type="email" class="form-control" style="height: 40px;" id="email_cliente" name="email_cliente">
    </div>
    <div class="col-md-4">
      <label for="telefono_cliente">Telefono</label>
      <input type="text" class="form-control" style="height: 40px;"  id="telefono_cliente" name="telefono_cliente">
    </div>
    <div class="col-md-4">
      <label for="area">Area</label>
      <input type="text" class="form-control" style="height: 40px;"  id="area" name="area">
    </div> --}}
            </div>
            <table id="contacto_cliente" class="table table-bordered" name="contacto_cliente" width="100%">
                <thead style="background-color:#e9ecef">
                    <th>Email</th>
                    <th>Telefono</th>
                    <th>Área</th>
                </thead>
            </table>
        </div>
        <p></p>
        <div class="form-row ">
            <div class="form-group">
                {{-- <button type="submit" form="form-cliente" class="btn" id="btnGuardar" style="background:blue;color:white;">Guardar</button> --}}
                <a class="d-flex align-items-center" style="color: blue;text-decoration: none;font-size: 1rem;" href="{{ url('/clientes') }}"><i style="font-size:18px;" id="arrow-left" class="fas fa-arrow-left"></i>Regresar</a>
            </div>
        </div>

        @endsection


        @section("scripts")
        <script src={{asset("lib/DataTables/DataTables-1.10.25/js/jquery.dataTables.min.js")}}></script>
        <script src={{asset("lib/DataTables/DataTables-1.10.25/js/dataTables.bootstrap5.min.js")}}></script>
        <script src={{asset("lib/DataTables/Responsive-2.2.9/js/dataTables.responsive.js")}}></script>
        <script src={{asset("lib/DataTables/jquery.dataTables.spanish.js")}}></script>
        <script>
            let contacto_cliente = $("#contacto_cliente").DataTable({
                paging: false
                , searching: false
                , info: false
                , ajax: {
                    url: '{{url("contacto_cliente/{$cliente->id}")}}'
                    , type: 'GET'
                }
                , columns: [{
                        "data": "email"
                    }
                    , {
                        "data": "telefono"
                    }
                    , {
                        "data": "area"
                    }
                ]
            });

        </script>
        @endsection
