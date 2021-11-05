@extends('layouts.base_html')
@section('tittle') OPERAR ORDEN DE COMPRA
@endsection

                @php
                    $operaciones = [];
                    foreach ($ordenes as $orden) {
                        array_push($operaciones,$orden->orden->folio_orden);
                    }
                    $operaciones = implode("-",$operaciones);
                    
                @endphp
@section('body')

<div class="container">
    <div class="col-md-12">
        <h1 class="animate-box fadeInLeft animated" data-animate-effect="fadeInLeft">
            OPERAR ORDEN DE COMPRA
        </h1>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h4 style="color:gray;font-size:20px;">-Rellena los siguientes campos</h4>
            <hr style="color: orange;">
            <p>  
            </p>
        </div>
    </div>
    <form  class="row g-3" id="form-operar" onsubmit="update_operar({{$operar->id}})">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <label for="folio_factura" >Folio de factura</label>
                <input type="text"  class="form-control" id="folio_factura" name='folio_factura' required>  
            </div>
            <div class="col-md-4">
                <label for="folio_orden" >Folio de Orden</label>
                <input type="text"  disabled class="form-control" value= '{{$operaciones}}' required> 
            </div>
            <div class="col-md-4">
                <label for="folio_factura" >Folio del Contrato</label>
                <input type="text"  class="form-control" id="id_contrato" value ='{{$operar->contrato->folio}}' name='id_contrato' disabled>  
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-6">
                <label for="fecha_emision">Fecha de emisión</label>
                <input type="date" class="form-control" id="fecha_emision" name="fecha_emision">
            </div>
            <div class="col-md-6">
                <label for="fecha_vencimiento">Fecha de vencimiento</label>
                <input type="date" class="form-control" id="fecha_vencimiento" name="fecha_vencimiento">
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-4">
                <label for="sub_total">SubTotal</label>
                <input type="text" class="form-control" id="sub_total"  oninput="resta();" name="sub_total">
            </div>
            <div class="col-md-4">
                <label for="impuestos">Impuestos</label>
                <input type="text"  class="form-control" id="impuestos"  oninput="resta();" name="impuestos">
            </div>
            <div class="col-md-4">
                <label for="total">Total</label>
                <input type="text" disabled  class="form-control" id="total" name="total">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h4 class="mt-4" style="color:white;background-color:orange;font-size:23px;font-weight:bold;text-align:center">Observaciones y comentarios</h4>
            </div>
            </div>
        <div class="row mt-3" style="text-align:center">
            <div class="col-md-12">
                <label for="comentario" class="label">Ingrese las observaciones y comentarios</label>
                <input type="text"  class="form-control input-sm"  id="comentarios" name='comentarios' >
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-6" style="text-align:end;">
                <button type="submit"  class="btn" id="btnGuardar" style="background:rgb(13, 194, 13);color:white;">Guardar</button>
            </div>
            <div class="col-md-6">
                <a type="button" class="btn" id="btnCancelar" href="{{url("/compras")}}" style="background:red;color:white;" >Cancelar</a>
            </div>
        </div>

    </form>
</div>
@endsection

@section('scripts')
<script>

 function resta(){
         var subtotal = parseFloat(document.getElementById("sub_total").value),
         impuestos = parseFloat(document.getElementById("impuestos").value)||0.00;
         document.getElementById("total").value = parseFloat(subtotal+impuestos).toFixed(2);
         }


  async function update_operar(id){
       event.preventDefault();
       let form = new FormData(document.getElementById("form-operar"));
       form.append("id_status",2);
       form.append("id_forma",1);
       form.append("sub_total",document.getElementById("sub_total").value);
       form.append("impuestos",document.getElementById("impuestos").value);
       form.append("total",document.getElementById("total").value);
       let url="{{url('/pagos_proveedores2/{id}')}}".replace("{id}",id);
       let init = {
           method:"PUT",
           headers:{
              'X-CSRF-Token' : document.getElementsByName("_token")[0].value,
              "Content-Type":"application/json"
          },
           body:JSON.stringify(Object.fromEntries(form))
         }
       let req = await fetch(url,init);
       if(req.ok){
          window.location.href="{{url('/pagos_proveedores')}}"
       }
       else{
           Swal.fire({
                       icon: 'error'
                       , title: 'Error'
                       , text: 'Error al operar'
                   , });
       }
  }
</script>
@endsection