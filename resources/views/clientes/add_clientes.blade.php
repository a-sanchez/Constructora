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
        <h4 style="color:gray;font-size:20px;">-Agregar</h4>
        <hr style="color: orange;">
        <p>
        </p>
    </div>
</div>

<form id="form-cliente" class="row g-3" onSubmit='insert_cliente();'>
@csrf
<div class="row">
    <div class="col-md-4">
    <label for="cliente" >RFC</label>
    <input type="text" class="form-control" id="cliente" name='cliente'placeholder="Nombre" required>
  </div>
  <div class="col-md-4">
    <label for="razon_social" >Razon social</label>
    <input type="text" class="form-control" id="razon_social" placeholder="Razon Social" name="razon_social" required>
  </div>
  <div class="col-md-4">
    <label for="alias" >Alias</label>
    <input type="text" class="form-control" id="alias" placeholder="Alias" name="alias" required>
  </div>
</div>
  <!--div class="col-md-6">
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
        <label for="email_pago">Email</label>
        <input type="email" class="form-control" style="height: 40px;" id="email_pago" name="email_pago">
      </div>
      <div class="col-md-6">
        <label for="telefono_pago">Telefono</label>
        <input type="text" class="form-control" style="height: 40px;"  id="telefono_pago" name="telefono_pago">
      </div>
    </div>
    <table id="contacto_pagos" class="table" width="100%" name="contactos_pago">
      <thead>
        <th>Email</th>
        <th>Telefono</th>
      </thead>
    </table>
  </div-->
</div>

<hr style="color: orange;">



<div class="row">
<h7 style="font-weight:bold;">Direccion</h7>
      <div class="col-md-4">
            <label for="calle" >Calle</label>
        <input type="text" class="form-control" id="calle" placeholder="Calle" name="calle" required>
      </div>
      <div class="col-md-4">
        <label for="numero" >Numero</label>
        <input type="text" class="form-control" id="numero" placeholder="Numero" name="numero" >
      </div>
      <div class="col-md-4">
        <label for="colonia" >Colonia</label>
        <input type="text" class="form-control" id="colonia" placeholder="Colonia" name="colonia" required>
      </div>
      <div class="col-auto">
        <label for="cp" >CP</label>
        <input type="text" class="form-control" id="cp" placeholder="CP" name="cp" >
      </div>
      <div class="col-md-4">
        <label for="localidad" >Localidad</label>
        <input type="text" class="form-control" id="localidad" placeholder="Localidad" name="localidad" required>
      </div>
</div>
</form>
<div class="row">
<h7 style="font-weight:bold;">Contacto</h7>
<div class="col-md-12">
  <div class="row">
    <div class="col-sm-9">
      <h7>Contacto Clientes</h7>
    </div>
    <div class="col-sm-3" style="text-align: end;">
      <button class="btn btn-success" onclick="agregarContactoCliente();" >Agregar</button>
    </div>
  </div>
  <div class="row">
    <div class="col-md-4">
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
    </div>
  </div>
  <table id="contacto_cliente" class="table" name="contacto_cliente" width="100%" >
    <thead>
      <th>Email</th>
      <th>Telefono</th>
      <th>Área</th>
    </thead>
  </table>
</div>
<div class="form-row ">
    <div class="form-group float-end">
        <button type="submit" form="form-cliente" class="btn" id="btnGuardar" style="background:blue;color:white;">Guardar</button>
        <a type="button" class="btn" id="btnCancelar" href="{{ url('/clientes') }}" style="background:red;color:white;" >Cancelar</a>
    </div>
</div>

@endsection

@section("scripts")
<script src={{asset("lib/DataTables/DataTables-1.10.25/js/jquery.dataTables.min.js")}}></script>
<script src={{asset("lib/DataTables/DataTables-1.10.25/js/dataTables.bootstrap5.min.js")}}></script>
<script src={{asset("lib/DataTables/Responsive-2.2.9/js/dataTables.responsive.js")}}></script>
<script>


  let contacto_cliente=$("#contacto_cliente").DataTable({
    paging:false,
    searching:false,
    info:false
  });
  /*let contacto_pagos=$("#contacto_pagos").DataTable({
    paging:false,
    searching:false,
    info:false
  });*/

  function arrayToJson(array) {
	let jsonArray = [];
	array.forEach(element => {
		json = {
			"email":element[0],
			"telefono":element[1],
      "area":element[2],
		};
		jsonArray.push(json);
	});
	return JSON.stringify(jsonArray);
  }


  async function insert_cliente(){
    event.preventDefault();
    let form = new FormData(document.getElementById("form-cliente"));
    let contacto = contacto_cliente.rows().data().toArray();
    if(contacto.length == 0 ){
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: "Favor de insertar al menos un contacto"
        });
        return false;
    }
    let jsonClientes = arrayToJson(contacto);
    form.append("contacto_cliente",jsonClientes);

    /*let contactos = contacto_pagos.rows().data().toArray();
    let jsonPagos = arrayToJson(contactos);
    form.append("contacto_pagos",jsonPagos);*/

    let url = "{{ url('/clientes') }}";
    let init = {
      method:"POST",
      body:form
    }
    let req = await fetch(url, init);
    console.log(req);
    if (req.ok) {
      window.location.href = "{{ url('/clientes') }}";
    }
    else{
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: "Error al registrar cliente"
      });
    }
  }

  /*function agregarContactoPago() {
        event.preventDefault();
        let pagoEmail= document.getElementById("email_pago");
        let pagoTelefono=  document.getElementById("telefono_pago");
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
*/

  function agregarContactoCliente(){
    event.preventDefault();
    let clienteEmail=document.getElementById("email_cliente");
    let clienteTelefono=document.getElementById("telefono_cliente");
    let area=document.getElementById("area");
    if(clienteEmail.value.trim()==""
      ||clienteTelefono.value.trim()==""
      ||area.value.trim()==""
      ){
        Swal.fire(
            'Error',
            'Favor de rellenar todos los campos',
            'error'
            );
            return false;
      }
      contacto_cliente.row.add([
        clienteEmail.value.trim().toUpperCase(),
        clienteTelefono.value.trim().toUpperCase(),
        area.value.trim().toUpperCase()
      ]).draw(false);
      clienteEmail.value="";
      clienteTelefono.value="";
      area.value="";
  }

  $('#contacto_cliente').on('click','.remove',function(){
    var table=$('#contacto_cliente').DataTable();
    table
    .row($(this).parents('tr'))
    .remove()
    .draw();
  });

</script>
@endsection
