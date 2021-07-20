@extends('layouts.base_html')

@section ('tittle')AGREGAR PROVEEDOR @endsection
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
        <h4 style="color:gray;font-size:20px;">-Agregar</h4>
        <hr style="color: orange;">
        <p>  
        </p>
    </div>
</div>

<form id="form-proveedor" class="row g-3" onSubmit='insert_proveedor();'>
@csrf

<div class="row">
  <div class="col-md-6">
    <label for="rfc" >R.F.C</label>
    <input type="text" class="form-control" id="rfc" placeholder="R.F.C" name="rfc" required>
  </div>
</div>
<div class="row">
  <div class="col-md-4">
    <label for="alias" >Alias</label>
    <input type="text" class="form-control" id="alias" placeholder="Alias" name="alias" required>
  </div>
  <div class="col-md-4">
    <label for="razon_social" >Razon social</label>
    <input type="text" class="form-control" id="razon_social" placeholder="Razon Social" name="razon_social" required>
  </div>
  <div class="col-md-4">
    <label for="localidad" >Localidad</label>
    <input type="text" class="form-control" id="localidad" placeholder="Localidad" name="localidad" required>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <label for="banco">Banco</label>
    <input type="text" class="form-control" id="banco" name="banco">
  </div>
  <div class="col-md-6">
    <label for="cuenta">Cuenta</label>
    <input type="text" class="form-control" id="cuenta" name="cuenta">
  </div>
</div>

<div class="row">
  <h7 style="font-weight:bold;">Contacto</h7>
  <div class="col-md-6">
    <div class="row">
      <div class="col-sm-9">
        <h7>Contacto Ventas</h7>
      </div>
      <div class="col-sm-3">
        <button class="btn btn-success" onclick="agregarContactoVenta();" >Agregar</button>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <label for="contacto_venta_email">Email</label>
        <input type="text" class="form-control" style="height: 40px;" id="contacto_venta_email">
      </div>
      <div class="col-md-6">
        <label for="contacto_venta_telefono">Telefono</label>
        <input type="text" class="form-control" style="height: 40px;"  id="contacto_venta_telefono">
      </div>
    </div>
    <table id="contacto_ventas" class="table" name="contacto_ventas" width="100%" >
      <thead>
        <th>Email</th>
        <th>Telefono</th>
      </thead>      
    </table>
  </div>
  <div class="col-md-6">
    <div class="row">
      <div class="col-sm-9">
        <h7>Contacto Pagos</h7>
      </div>
      <div class="col-sm-3">
        <button class="btn btn-success" onclick="agregarContactoPago();" >Agregar</button>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <label for="contacto_pago_email">Email</label>
        <input type="text" class="form-control" style="height: 40px;" id="contacto_pago_email">
      </div>
      <div class="col-md-6">
        <label for="contacto_pago_telefono">Telefono</label>
        <input type="text" class="form-control" style="height: 40px;"  id="contacto_pago_telefono">
      </div>
    </div>
    <table id="contacto_pagos" class="table" width="100%">
      <thead>
        <th>Email</th>
        <th>Telefono</th>
      </thead>
    </table>
  </div>
</div>
<div class="form-row">
        <div class="form-group">
            <button type="submit" class="btn" id="btnGuardar" style="background:blue;color:white;">Guardar</button>
            <a type="button" class="btn" id="btnCancelar" href="{{ url('/proveedores') }}" style="background:red;color:white;" >Cancelar</a>
        </div>
  </div>
</form>

@endsection
@section("scripts")
<script src={{asset("lib/DataTables/DataTables-1.10.25/js/jquery.dataTables.min.js")}}></script>
<script src={{asset("lib/DataTables/DataTables-1.10.25/js/dataTables.bootstrap5.min.js")}}></script>
<script src={{asset("lib/DataTables/Responsive-2.2.9/js/dataTables.responsive.js")}}></script>
<script>

  let contacto_ventas = $("#contacto_ventas").DataTable({
    paging:false,
    searching:false,
    info:false
  });
  let contacto_pagos = $("#contacto_pagos").DataTable({
    paging:false,
    searching:false,
    info:false
  });

  function arrayToJson(array) {
	let jsonArray = [];
	array.forEach(element => {
		json = {
			"email":element[0],
			"telefono":element[1],
		};
		jsonArray.push(json);
	});
	return JSON.stringify(jsonArray);
}

  async function insert_proveedor(){
    event.preventDefault();
    let form = new FormData(document.getElementById("form-proveedor"));
    let contacto = contacto_ventas.rows().data().toArray();
    let jsonVentas = arrayToJson(contacto);
    form.append("contacto_ventas",jsonVentas);

    let contactos = contacto_pagos.rows().data().toArray();
    let jsonPagos = arrayToJson(contactos);
    form.append("contacto_pagos",jsonPagos);


    let url = "{{ url('/proveedores') }}";
    let init = {
      method:"POST",
      body:form
    }
    let req = await fetch(url, init);
    if (req.ok) {
      //window.location.href = "{{ url('/proveedores') }}";
    }
    else{
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: "Error al registrar proveedor"
      });
    }
  }




  function agregarContactoPago() {
        event.preventDefault();
        let pagoEmail= document.getElementById("contacto_pago_email");
        let pagoTelefono=  document.getElementById("contacto_pago_telefono");
        if (pagoEmail.value.trim() == ""
            || pagoTelefono.value.trim() == ""
        ){
            Swal.fire(
            'Error',
            'Favor de rellenar todos los campos',
            'error'
            );
            return false;
        }

        contacto_pagos.row.add([
            pagoEmail.value.trim().toUpperCase(),
            pagoTelefono.value.trim().toUpperCase()
        ]).draw(false);
        pagoEmail.value = "";
        pagoTelefono.value = "";
    }

    //BORRAR FILA DE LA TABLA
    $('#contacto_pagos').on('click', '.remove', function () {
        var table = $('#contacto_pagos').DataTable();
        table
        .row($(this).parents('tr'))
        .remove()
        .draw();
    });


 
    function agregarContactoVenta() {
        event.preventDefault();
        let ventaEmail= document.getElementById("contacto_venta_email");
        let ventaTelefono=  document.getElementById("contacto_venta_telefono");
        if (ventaEmail.value.trim() == ""
            || ventaTelefono.value.trim() == ""
        ){
            Swal.fire(
            'Error',
            'Favor de rellenar todos los campos',
            'error'
            );
            return false;
        }

        contacto_ventas.row.add([
            ventaEmail.value.trim().toUpperCase(),
            ventaTelefono.value.trim().toUpperCase()
        ]).draw(false);
        ventaEmail.value = "";
        ventaTelefono.value = "";
    }

    //BORRAR FILA DE LA TABLA
    $('#contacto_ventas').on('click', '.remove', function () {
        var table = $('#contacto_ventas').DataTable();
        table
        .row($(this).parents('tr'))
        .remove()
        .draw();
    });

</script>
@endsection