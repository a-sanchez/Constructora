@extends('layouts.base_html')

@section ('tittle')DETALLES PROVEEDOR @endsection
@section('styles')
<link rel="stylesheet" href="{{asset("lib/DataTables/DataTables-1.10.25/css/dataTables.bootstrap5.min.css")}}">
<link rel="stylesheet" href="{{asset("lib/DataTables/Responsive-2.2.9/css/responsive.dataTables.min.css")}}">
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
            <h4 style="color:gray;font-size:20px;">-DETALLES</h4>
            <hr style="color: orange;">
            <p>
            </p>
        </div>
    </div>

    <form id="form-proveedor" class="row g-3">
        @csrf

        <div class="row">
            <div class="col-md-6">
                <label for="rfc">R.F.C</label>
                <input type="text" class="form-control" id="rfc" readonly value="{{$proveedor->rfc}}" name="rfc" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label for="alias">Alias</label>
                <input type="text" class="form-control" id="alias" readonly value="{{$proveedor->alias}}"  name="alias" required>
            </div>
            <div class="col-md-4">
                <label for="razon_social">Razon social</label>
                <input type="text" class="form-control" id="razon_social" readonly value="{{$proveedor->razon_social}}"  name="razon_social" required>
            </div>
            <div class="col-md-4">
                <label for="localidad">Localidad</label>
                <input type="text" class="form-control" id="localidad" readonly value="{{$proveedor->localidad}}"  name="localidad" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="banco">Banco</label>
                <input type="text" class="form-control" id="banco" name="banco" readonly value="{{$proveedor->banco}}" >
            </div>
            <div class="col-md-6">
                <label for="cuenta">Cuenta</label>
                <input type="text" class="form-control" id="cuenta" name="cuenta" readonly value="{{$proveedor->cuenta}}" >
            </div>
        </div>

        <div class="row">
            <h6 style="font-weight:bold;">Contacto</h6>
                <table id="contacto_ventas" class="table table-bordered" name="contacto_ventas" width="100%">
                    <thead style="background-color:#e9ecef">
                        <th>Email</th>
                        <th>Telefono</th>
                        <th>Área</th>
                    </thead>
                </table>

            <div class="form-row">
                <div class="form-group">
                    {{-- <button type="submit" class="btn" id="btnGuardar" style="background:blue;color:white;">Guardar</button> --}}
                     <a class="d-flex align-items-center" style="color: blue;text-decoration: none;font-size: 1rem;" href="{{ url('/proveedores') }}"><i style="font-size:18px;" id="arrow-left" class="fas fa-arrow-left"></i>Regresar</a>
                   </div>
            </div>
        </div>
    </form>
    @endsection

    @section("scripts")
    <script src={{asset("lib/DataTables/DataTables-1.10.25/js/jquery.dataTables.min.js")}}></script>
    <script src={{asset("lib/DataTables/DataTables-1.10.25/js/dataTables.bootstrap5.min.js")}}></script>
    <script src={{asset("lib/DataTables/Responsive-2.2.9/js/dataTables.responsive.js")}}></script>
    <script src={{asset("lib/DataTables/jquery.dataTables.spanish.js")}}></script>
     <script>
            let contacto_cliente = $("#contacto_ventas").DataTable({
                paging: false
                , searching: false
                , info: false
                , ajax: {
                    url: '{{url("contacto_proveedor/{$proveedor->id}")}}'
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
