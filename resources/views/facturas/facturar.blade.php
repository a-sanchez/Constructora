@extends('layouts.base_html')

@section('title')
@endsection

@section('styles')
<style>
    input {
        text-transform: uppercase;
    }

    .loader-background{
        width: 100%;
        height: 100%;
        top: 0%;
        left: 0%;
        position: fixed;
        z-index: 1;
        background-color: black;
        opacity: 0.3;
    }

    .spinner-border{
        top: 44%;
        left: 60%;
        position: fixed;
        color: #FF9C00;
    }
</style>
@endsection


@section('body')
<div class="loader-background" style="display: none;" id="loader">
    <div class="spinner-border">
        <span class="sr-only">Loading...</span>
    </div>
</div>
<div class="container pt-1">
<div class="col-md-12">
    <h1 class="animate-box fadeInLeft animated" data-animate-effect="fadeInLeft">
        FACTURAR
    </h1>
</div>


<form id="form-factura" class="row g-3"  onsubmit='update_factura({{$prefactura->id}});'>
@csrf
    <div class="row mt-4">
        <div class="col-md-12">
            <h4 style="color:gray;font-size:20px;">-Crear Factura</h4>
            
        </div>
        <div class="col-md-12 mt-2" >
            <button type="submit" class="btn" id="btnGuardar" style="background:rgb(13, 194, 13);color:white;">Guardar</button>
            <a type="button" class="btn" id="btnCancelar" href="{{url("/facturas")}}" style="background:red;color:white;" >Cancelar</a>
            <hr style="color: orange;">
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-6">
          <label for="folio_factura" >Folio de factura</label>
          <input type="text"  class="form-control"  id="folio_factura" name='folio_factura'>
        </div>
        <div class="col-md-6">
            <label for="estatus" >Seleccione nuevo estatus</label>
            <select disabled name="estatus" class="form-control">
                <option value="2" >Operada</option>
              </select>
        </div>
    </div>
</form>
    <h4 class="mt-4" style="color:white;background-color:orange;font-size:23px;font-weight:bold;text-align:center">Adjuntar archivos</h4>
    <div class="row mt-3" style="text-align:center">
        <div class="col-md-6">
            <label for="file" >Adjuntar PDF de la factura oficial:</label>
            <input type="file" class="form-control" id="pdf_oficial" name="pdf_oficial" onchange=update_file(this); style="border:none;text-align:center">
        </div>
        <div class="col-md-6" style="text-align:center">
            <label for="file" >Adjuntar XML de la factura oficial:</label>
            <input type="file" class="form-control" id="xml_oficial" name="xml_oficial" onchange=update_file(this); style="border:none;text-align:center">
        </div>
    </div>

@endsection

@section('scripts')
<script>
    async function update_factura(id){
        event.preventDefault();
        let form = new FormData(document.getElementById("form-factura"));
        form.append("id_status",2);
        let url = "{{url('/facturas/{id}')}}".replace("{id}",id);
        let init={
            method:"PUT",
            headers:{
                'X-CSRF-Token': document.getElementsByName("_token")[0].value
                , "Content-Type": "application/json"
            }
            ,body:JSON.stringify(Object.fromEntries(form))
        }
        let req = await fetch (url,init);
        if(req.ok){
            //window.location.href="{{url('/facturas')}}";
        }
        else{
            Swal.fire({
                    icon: 'error'
                    , title: 'Error'
                    , text: 'Error al crear factura'
                , });
        }
    }

    async function update_file(file){
        document.getElementById("loader").style.display = "block";
        let form = new FormData();
        form.append('file',file.id);
        form.append('file_info',file.files[0]);
        let id = {{$prefactura->id}}
        let url='{{url("/facturas/actualizar/{id}")}}'.replace('{id}',id);
        let init={
            method:"POST",
            headers:{
                'X-CSRF-Token':document.getElementsByName("_token")[0].value
            },
            body:form
        }
        let req = await fetch(url,init);
        document.getElementById("loader").style.display = "none";
        
    }
</script>
@endsection