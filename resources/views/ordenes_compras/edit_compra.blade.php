@extends('layouts.base_html')

@section ('tittle')AGREGAR ORDEN DE COMPRA @endsection
@section('styles')

<link rel="stylesheet" href="{{asset("lib/DataTables/DataTables-1.10.25/css/dataTables.bootstrap5.min.css")}}">
<link rel="stylesheet" href="{{asset("lib/DataTables/Responsive-2.2.9/css/responsive.dataTables.min.css")}}">
@endsection

@section('body')

<div class="container">
<div class="col-md-12">
                <h1 class="animate-box fadeInLeft animated" data-animate-effect="fadeInLeft">
                    EDITAR ORDEN DE COMPRA
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

<form id="form-orden" class="row g-3" onsubmit='edit_orden({{$orden_compra->id}});'>
@csrf
<div class="row">
  <div class="col-md-4">
    <label for="folio_orden" >Folio de Contrato</label>
    <select class="form-control" disabled name="id_contrato" id="id_contrato">
      <option value="{{$orden_compra->id_contrato}}">{{$orden_compra->contrato->folio}}</option>
    </select>
  </div>
    <div class="col-md-4">
    <label for="folio_orden" >Folio de Orden de Compra</label>
    <input type="text" class="form-control" id="folio_orden" name='folio_orden'placeholder="Folio de Orden de Compra" value="{{$orden_compra->folio_orden}}" required>
  </div>
  <div class="col-md-4">
    <label form="proveedor">Proveedor</label>
    <select class="form-control" name="id_proveedor" id="id_proveedor" disabled>
      <option value="{{$orden_compra->id_proveedor}}" selected>{{$orden_compra->proveedor->rfc}} - {{$orden_compra->proveedor->razon_social}}</option>
    </select>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <label for="solicitado" >Solicitado Por:</label>
    <input type="text" class="form-control" id="solicitado" placeholder="Ingrese Nombre" name="solicitado" value="{{$orden_compra->solicitado}}" required>
  </div>
  <div class="col-md-12">
    <label for="vobo" >Visto Bueno Por:</label>
    <input type="text" class="form-control" id="vobo" placeholder="Ingrese Nombre" name="vobo" value="{{$orden_compra->vobo}}" required>
  </div>
  <div class="col-md-12">
    <label for="autorizacion" >Autorizacion Por:</label>
    <input type="text" class="form-control" id="autorizacion" placeholder="Ingrese Nombre" value="{{$orden_compra->autorizacion}}" name="autorizacion" required>
  </div>
</div>
<div class="row">
  <p> </p>
</div>
<div class="row">
<h6 style="font-weight:bold;">Información:</h6>
  <div class="col-md-6">
    <label for="fecha_orden" >Fecha de Elaboracion</label>
    <input type="date" class="form-control" id="fecha_orden"  name="fecha_orden"  value="{{$orden_compra->fecha_orden}}" required>
  </div>
  <div class="col-md-6">
    <label for="fecha_entrega">Fecha de Entrega</label>
    <input type="date" class="form-control" id="fecha_entrega" name="fecha_entrega" value="{{$orden_compra->fecha_entrega}}"  required>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <label for="descripcion_orden" >Descripcion orden de compra</label>
    <input type="text" class="form-control" id="descripcion_orden" placeholder="Descripcion orden de compra" name="descripcion_orden"  value="{{$orden_compra->descripcion_orden}}"  required >
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <label for="observaciones" >Observaciones</label>
    <input type="text" class="form-control" id="observaciones" placeholder="Observaciones" name="observaciones" value="{{$orden_compra->observaciones}}" required>
  </div>
</div>
<div class="row">
  <div class="form-group col-md-2">
    <label for="iva">I.V.A. %</label>
    <input type="text" name="iva" id="iva" class="form-control"  pattern="[0-9\.]+"  oninput="setCustomValidity('')" value="{{$orden_compra->iva}}" oninvalid="this.setCustomValidity('Solo valores numericos')">
  </div>
</div>
</form>
<form id="form_productos" onsubmit="agregarProducto();">
@csrf
<input type="text" name="orden_id" id="orden_id" value='{{$orden_compra->id}}' hidden>
<h6 style="font-weight:bold;">Productos:</h6>
<div class="row">
  <div class="form-group col-md-3">
    <label for="concepto">Concepto</label>
    <input type="text" name="concepto" id="concepto" class="form-control">
  </div>
  <div class="form-group col-md-3">
    <label for="unidad">Unidad</label>
    <input type="text" name="unidad" id="unidad" class="form-control">
  </div>
  <div class="form-group col-md-3">
    <label for="cantidad">Cantidad</label>
    <input type="text" name="cantidad" id="cantidad" class="form-control"  pattern="[0-9\.]+"  oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('Solo valores numericos')">
  </div>
  <div class="form-group col-md-3">
    <label for="precio_unitario">Precio unitario</label>
    <input type="text" name="precio_unitario" id="precio_unitario" class="form-control"  pattern="[0-9\.]+"  oninput="setCustomValidity('')" oninvalid="this.setCustomValidity('Solo valores numericos')">
  </div>
  <div class="col-md-12">
    <button type="submit" class="btn btn-success float-end mt-3" >Agregar producto</button>
  </div>
</div>
</form>

<div class="row">
  <table id="orden_productos" class="table table-bordered text-center" width="100%">
    <thead>
        <th>id</th>
        <th>Concepto</th>
        <th>Unidad</th>
        <th>Cantidad</th>
        <th>Precio unitario</th>
        <th>Importe</th>
        <th></th>
    </thead>
  </table>
</div>
<div class="form-row float-end">
        <div class="form-group">
            <button type="submit" form="form-orden" class="btn" id="btnGuardar" style="background:blue;color:white;">Guardar</button>
            <a type="button" class="btn" id="btnCancelar" href="{{url('/compras')}}" style="background:red;color:white;" >Cancelar</a>
        </div>
  </div>
@endsection

@section('scripts')
<script src={{asset("lib/DataTables/DataTables-1.10.25/js/jquery.dataTables.min.js")}}></script>
<script src={{asset("lib/DataTables/DataTables-1.10.25/js/dataTables.bootstrap5.min.js")}}></script>
<script src={{asset("lib/DataTables/Responsive-2.2.9/js/dataTables.responsive.js")}}></script>
<script src={{asset("lib/jquery-tabledit/jquery.tabledit.min.js")}}></script>
<script>
let orden_productos = $("#orden_productos").DataTable({
    paging:false,
    info:false,
    searching:false,
    ajax:{
        url:'{{url("orden_productos/{$orden_compra->id}")}}',
        type:'GET'
    },
    columns: [
        //DATOS OBTENIDOS DEL CONTROLADOR
        {"data":"id"},
        {"data":"concepto"},
        {"data":"unidad"},
        {"data":"cantidad"},
        {"data":"precio_unitario",
            render:function(precio_unitario){
                return parseFloat(precio_unitario).toFixed(2);
            }
        },
        {"data":"importe",
            render:function(importe){
                return parseFloat(importe).toFixed(2);
            }
        },
        {"data":"id",
            render:function(id){
                return `<a href="#:" class="float-right" onclick="borrarProducto(${id});"><i class="far fa-trash-alt  fa-lg"></i></a>`;
            }
        }
    ]
});

 //TABLA PARA EDITAR LOS PRODUCTOS DE LA REQUISICION
 $('#orden_productos').on('draw.dt', function(){
    $.ajaxSetup({
        headers:{
            'X-CSRF-Token' : document.getElementsByName("_token")[0].value
        }
    });
    $("#orden_productos").Tabledit({
        //LINK PARA MANDAR ACCIONES AL CONTROLADOR
        url: '{{url("orden_productos")}}',
        editButton: false,
        deleteButton: false,
        hideIdentifier: true,
        columns: {
            //SET IDENTIFICADOR
            identifier: [0, 'id'],
            //CAMPOS EDITABLES
            editable: [[1, 'concepto'], [2, 'unidad'],[3, 'cantidad'],[4,"precio_unitario"]]
        },
        //ON SUCCESS, RECARGA LA TABLA DE LOS PRODUCTOS
        onSuccess: function() {
            orden_productos.ajax.reload();
        }
    });
});

 //BORRAR PRODUCTOS DE ORDEN DE COMRA
async function borrarProducto(id) {
    let url = "{{url('/orden_productos/{id}')}}".replace("{id}",id);
    let init = {
        method:"DELETE",
        headers:{
            'X-CSRF-Token' : document.getElementsByName("_token")[0].value
        }
    }
    let req = await fetch(url,init);
    if (req.ok) {
        await orden_productos.ajax.reload();
    }
    else{
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'No fue posible borrar el producto seleccionado',
        })
    }
}

//AGREGAR PRODUCTO
async function agregarProducto() {
    event.preventDefault();
    let form = new FormData(document.getElementById("form_productos"));
    let url = "{{url('/orden_productos')}}";
    let init = {
        method:"POST",
        body:form
    }

    let req = await fetch(url,init);
    if (req.ok) {
        document.getElementById("form_productos").reset();
        await orden_productos.ajax.reload();
    }
    else{
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'No fue posible agregar el producto',
        })
    }
}

async function edit_orden(id) {
    event.preventDefault();
    let form = new FormData(document.getElementById("form-orden"));
    let url = "{{url('/compras/actualizar/{id}')}}".replace("{id}",id);
    let init = {
        method:"POST",
        headers:{
            'X-CSRF-Token' : document.getElementsByName("_token")[0].value,
            "Content-Type":"application/json",
            "accept":"application/json",
        },
        body:JSON.stringify(Object.fromEntries(form))
    }
    let req = await fetch(url,init);
    if (req.ok) {
        window.location.href = "{{url('/compras')}}";
    }
    else{
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'ERROR AL ACTUALIZAR LA ORDEN',
        });
    }
}
</script>

@endsection
