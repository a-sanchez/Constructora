@extends('layouts.base_html')

@section ('tittle')AGREGAR CLIENTE @endsection
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
            <h4 style="color:gray;font-size:20px;">-Editar</h4>
            <hr style="color: orange;">
            <p>
            </p>
        </div>
    </div>

    <form id="form-cliente" class="row g-3" onsubmit='update_cliente({{$cliente->id}});'>
        @csrf
        <div class="row mb-2">
            <div class="col-md-4">
                <label for="cliente">RFC</label>
                <input type="text" class="form-control" id="cliente" name='cliente' value="{{$cliente->cliente}}" required>
            </div>
            <div class="col-md-4">
                <label for="razon_social">Razon social</label>
                <input type="text" class="form-control" id="razon_social" value="{{$cliente->razon_social}}" name="razon_social" required>
            </div>
            <div class="col-md-4">
                <label for="alias">Alias</label>
                <input type="text" class="form-control" id="alias" value="{{$cliente->alias}}" name="alias" required>
            </div>
        </div>

        <hr style="color: orange;">



        <div class="row">
            <h5 style="font-weight:bold;">Direccion</h5>
            <div class="col-md-4">
                <label for="calle">Calle</label>
                <input type="text" class="form-control" id="calle" value="{{$cliente->calle}}" name="calle" required>
            </div>
            <div class="col-md-4">
                <label for="numero">Numero</label>
                <input type="text" class="form-control" id="numero" value="{{$cliente->numero}}" name="numero">
            </div>
            <div class="col-md-4">
                <label for="colonia">Colonia</label>
                <input type="text" class="form-control" id="colonia" value="{{$cliente->colonia}}" name="colonia" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="cp">CP</label>
                <input type="text" class="form-control" id="cp" value="{{$cliente->cp}}" name="cp">
            </div>
            <div class="col-md-4">
                <label for="localidad">Localidad</label>
                <input type="text" class="form-control" id="localidad" value="{{$cliente->localidad}}" name="localidad" required>
            </div>
        </div>
    </form>

        <hr style="color: orange;">

    <form id="contactos" onsubmit="agregarContacto();">
        @csrf
        <input type="text" name="id_cliente" id="id_cliente" value='{{$cliente->id}}' hidden>
        <div class="row">
            <h5 style="font-weight:bold;">Contactos</h5>
            <div class="row">
                <div class="col-md-4">
                    <label for="email_cliente">Email</label>
                    <input type="email" class="form-control" style="height: 40px;" id="email" name="email">
                </div>
                <div class="col-md-4">
                    <label for="telefono_cliente">Telefono</label>
                    <input type="text" class="form-control" style="height: 40px;" id="telefono" name="telefono">
                </div>
                <div class="col-md-4">
                    <label for="area">Area</label>
                    <input type="text" class="form-control" style="height: 40px;" id="area" name="area">
                </div>
                <div class="col-md-12">
                    <button class="btn btn-success float-end mt-3">Agregar contacto</button>
                </div>
            </div>
          </div>
    </form>
    <div class="row">
        <table id="contacto_cliente" class="table table-bordered align-middle" width="100%">
            <thead style="background-color:#e9ecef">
                <th></th>
                <th>Email</th>
                <th >Telefono</th>
                <th>Área</th>
                <th style="width:8%"> </th>
            </thead>
        </table>
    </div>
    <p></p>
    <div class="row">
        <div class="form-group float-end">
            <button type="submit" form="form-cliente" class="btn" id="btnGuardar" style="background:blue;color:white;">Actualizar</button>
            <a type="button" class="btn" id="btnCancelar" href="{{ url('/clientes') }}" style="background:red;color:white;">Regresar</a>
        </div>
    </div>

    @endsection


    @section("scripts")
    <script src={{asset("lib/DataTables/DataTables-1.10.25/js/jquery.dataTables.min.js")}}></script>
    <script src={{asset("lib/DataTables/DataTables-1.10.25/js/dataTables.bootstrap5.min.js")}}></script>
    <script src={{asset("lib/DataTables/Responsive-2.2.9/js/dataTables.responsive.js")}}></script>
    <script src="{{asset('lib/jquery-tabledit/jquery.tabledit.min.js')}}"></script>
    <script src="https://kit.fontawesome.com/b4cf0d1143.js" crossorigin="anonymous"></script>

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
                    "data": "id"
                }
                , {
                    "data": "email"
                }
                , {
                    "data": "telefono"
                }
                , {
                    "data": "area"
                }
                , {
                    "data": "id"
                    , render: function(id) {
                        return `<a  class="d-flex w-100 justify-content-center" style="color:black" href="#" class="btn" onclick='borrarContacto(${id})'><i style="font-size:1.5rem" id="trash-alt"  class="fas fa-trash-alt"></i></a>`


                        
                    }
                }
            ]
        });

        $('#contacto_cliente').on('draw.dt', function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': document.getElementsByName("_token")[0].value
                }
            });
            $('#contacto_cliente').Tabledit({
                url: '{{url("/contacto_cliente")}}'
                , editButton: false
                , deleteButton: false
                , hideIdentifier: true
                , columns: {
                    identifier: [0, 'id']
                    , editable: [
                        [1, 'email']
                        , [2, 'telefono']
                        , [3, 'area']
                    ]
                },
                //ON SUCCESS, RECARGA LA TABLA DE LOS PRODUCTOS
                onSuccess: function() {
                    contacto_cliente.ajax.reload();
                }
            });
        });


        async function update_cliente(id) {
            event.preventDefault();
            let form = new FormData(document.getElementById("form-cliente"));
            let url = "{{url('/clientes/actualizar/{id}')}}".replace("{id}", id);
            let init = {
                method: "POST"
                , headers: {
                    'X-CSRF-Token': document.getElementsByName("_token")[0].value
                    , "Content-Type": "application/json"
                }
                , body: JSON.stringify(Object.fromEntries(form))
            }
            let req = await fetch(url, init);
            if (req.ok) {
                alert("Se ha actualizado correctamente");
                window.location.href = "{{url('/clientes')}}";
            } else {
                Swal.fire({
                    icon: 'error'
                    , title: 'Error'
                    , text: 'Error al actualizar el cliente'
                });
            }

        }

        async function agregarContacto() {
            event.preventDefault();
            let form = new FormData(document.getElementById("contactos"));
            let url = "{{url('/contacto_cliente')}}";
            let init = {
                method: "POST"
                , body: form
            }
            let req = await fetch(url, init);
            if (req.ok) {
                await contacto_cliente.ajax.reload();
                document.getElementById("contactos").reset();

            } else {
                Swal.fire({
                    icon: "error"
                    , title: "Error"
                    , text: "Error al agregar contacto"
                });
            }

        }
        async function borrarContacto(id) {
            let url = '{{url("/contacto_cliente/{id}")}}'.replace('{id}', id);
            let init = {
                method: "DELETE"
                , headers: {
                    'X-CSRF-TOKEN': "{{csrf_token()}}"
                }
            }

            let req = await fetch(url, init);
            if (req.ok) {
                contacto_cliente.ajax.reload();
            } else {
                Swal.fire(
                    "error"
                );
            }
        }

    </script>
    @endsection
