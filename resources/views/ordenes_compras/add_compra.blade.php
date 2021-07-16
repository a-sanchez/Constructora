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
                    ORDEN DE COMPRA
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

<form id="form-orden" class="row g-3" onSubmit='insert_orden();'>
@csrf
<div class="row">
  <div class="col-md-4">
    <label for="folio_orden" >Folio de Contrato</label>
    <select class="form-control" disabled name="id_contrato" id="id_contrato">
      <option value="{{$contrato->id}}">{{$contrato->folio}}</option>
    </select>
  </div>
    <div class="col-md-4">
    <label for="folio_orden" >Folio de Orden de Compra</label>
    <input type="text" class="form-control" id="folio_orden" name='folio_orden'placeholder="Folio de Orden de Compra" required>
  </div>
  <div class="col-md-4">
    <label form="proveedor">Proveedor</label>
    <select class="form-control" name="id_proveedor" id="id_proveedor">
      <option disabled value="0">Seleccione</option>
      @foreach($proveedores as $proveedor)
        <option value="{{$proveedor->id}}">{{$proveedor->rfc}} - {{$proveedor->razon_social}}</option>
      @endforeach
    </select>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <label for="solicitado" >Solicitado Por:</label>
    <input type="text" class="form-control" id="solicitado" placeholder="Ingrese Nombre" name="solicitado" required>
  </div>
</div>
<div class="row">
  <p> </p>
</div>
<div class="row">
<h7 style="font-weight:bold;">Información:</h7>
  <div class="col-md-6">
    <label for="fecha_orden" >Fecha de Elaboracion</label>
    <input type="date" class="form-control" id="fecha_orden"  name="fecha_orden" required>
  </div>
  <div class="col-md-6">
    <label for="fecha_entrega">Fecha de Entrega</label>
    <input type="date" class="form-control" id="fecha_entrega" name="fecha_entrega" required>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <label for="descripcion_orden" >Descripcion orden de compra</label>
    <input type="text" class="form-control" id="descripcion_orden" placeholder="Descripcion orden de compra" name="descripcion_orden" required >
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <label for="observaciones" >Observaciones</label>
    <input type="text" class="form-control" id="observaciones" placeholder="Observaciones" name="observaciones" required>
  </div>
</div>
</form>
<form id="form_productos" onsubmit="agregarProducto();">
<h7 style="font-weight:bold;">Productos:</h7>
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
  <table id="orden_productos" class="table text-center" width="100%">
    <thead>
      <th>Concepto</th>
      <th>Unidad</th>
      <th>Cantidad</th>
      <th>Precio unitario</th>
      <th>Importe</th>
    </thead>
  </table>
</div>
<div class="form-row">
        <div class="form-group">
            <button type="submit" form="form-orden" class="btn" id="btnGuardar" style="background:blue;color:white;">Guardar</button>
            <a type="button" class="btn" id="btnCancelar" href="/compras_opciones" style="background:red;color:white;" >Cancelar</a>
        </div>
  </div>
@endsection

@section("scripts")
  <script src={{asset("lib/DataTables/DataTables-1.10.25/js/jquery.dataTables.min.js")}}></script>
  <script src={{asset("lib/DataTables/DataTables-1.10.25/js/dataTables.bootstrap5.min.js")}}></script>
  <script src={{asset("lib/DataTables/Responsive-2.2.9/js/dataTables.responsive.js")}}></script>
<script>
//INICIALIZACION DATATABLE
  let orden_productos = $("#orden_productos").DataTable({
    paging:false,
    info:false,
    searching:false
  });

  function agregarProducto(){
    event.preventDefault();
    let concepto = document.getElementById("concepto");
    let unidad =  document.getElementById("unidad");
    let cantidad = document.getElementById("cantidad");
    let precio_unitario = document.getElementById("precio_unitario");
    let importe =  parseFloat(parseFloat(precio_unitario.value)*parseFloat(cantidad.value)).toFixed(2);
    if (cantidad.value.trim() == ""
        || unidad.value.trim() == ""
        || concepto.value.trim() == ""
        || precio_unitario.value.trim() == ""
    ){
        Swal.fire(
          'Error',
          'Favor de rellenar todos los campos',
          'error'
        )
        return false;
    }
    orden_productos.row.add([
        concepto.value.trim().toUpperCase(),
        unidad.value.trim().toUpperCase(),
        cantidad.value.trim().toUpperCase(),
        precio_unitario.value.trim().toUpperCase(),
        importe
    ]).draw(false);
    document.getElementById("form_productos").reset();
    concepto.focus();
  }

  async function insert_orden(){
    event.preventDefault();
    let form = new FormData(document.getElementById("form-orden"));
    let productos = orden_productos.rows().data().toArray();
    let jsonProductos = arrayToJson(productos);
    form.append("id_contrato",document.getElementById("id_contrato").value);
    form.append("productos",jsonProductos);
    let url = "{{ url('/compras') }}";
    let init = {
      method:"POST",
      body:form
    }
    let req = await fetch(url, init);
    console.log(req);
    if (req.ok) {
      //window.location.href = "{{ url('/compras') }}";
    }
    else{
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: "Error al registrar la orden de compra"
      });
    }
  }
</script>
@endsection