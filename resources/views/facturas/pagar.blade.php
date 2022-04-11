@extends('layouts.base_html')
@section('title')
@endsection
@section('body')

<div class="container pt-1">

<div class="col-md-12">
    <h1 class="animate-box fadeInLeft animated" data-animate-effect="fadeInLeft">
        PAGOS
    </h1>
</div>
<div class="row">
    <div class="col-md-12">
        <h4 style="color:gray;font-size:20px;">-Pago pre-factura</h4>
        <hr style="color: orange;">
    </div>
</div>

<form id="form-pago" class="row g-3" onsubmit='update_pago({{$prefactura->id}});'>
    @csrf
        <div class="row mt-3">
            <div class="col-md-6">
              <label for="fecha_pago" >Fecha de pago</label>
              <input type="date"  class="form-control"  id="fecha_pago" name='fecha_pago'>
            </div>
            <div class="col-md-6">
                <label for="id_forma" name="id_forma">Forma de Pago</label>
                <select class="form-control" id="id_forma" name="id_forma">
                  <option selected disabled value="0" >Seleccione forma de pago:</option> 
                  @foreach($formas as $forma)
                  <option value="{{$forma->id}}">{{$forma->forma}}</option>
                  @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h4 class="mt-4" style="color:white;background-color:orange;font-size:23px;font-weight:bold;text-align:center">Observaciones y comentarios</h4>
            </div>
        </div>
        <div class="row mt-3" style="text-align:center">
            <div class="col-md-12">
                <input type="text"  class="form-control input-sm"  id="comentario" name='comentario' >
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-6" style="text-align:end;">
                <button type="submit" class="btn" id="btnGuardar" style="background:rgb(13, 194, 13);color:white;">Guardar</button>
            </div>
            <div class="col-md-6">
                <a type="button" class="btn" id="btnCancelar" href="{{url("/facturas")}}" style="background:red;color:white;" >Cancelar</a>
            </div>
        </div>
    @endsection


    @section('scripts')
    <script>
        async function update_pago(id){
        event.preventDefault();
        let form = new FormData(document.getElementById("form-pago"));
        form.append("id_status",3);
        let url = "{{url('facturas/actualizar_factura/{id}')}}".replace("{id}",id);
        let init={
            method:"POST",
            headers:{
                'X-CSRF-Token': document.getElementsByName("_token")[0].value
                , "Content-Type": "application/json"
            }
            ,body:JSON.stringify(Object.fromEntries(form))
        }
        let req = await fetch (url,init);
        if(req.ok){
            window.location.href="{{url('/facturas')}}";
        }
        else{
            Swal.fire({
                    icon: 'error'
                    , title: 'Error'
                    , text: 'Error al generar pago'
                , });
        }
    }
    </script>
    @endsection