@extends('layouts.base_html')

@section ('tittle')CONTRATOS
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
<div class="container">
    <div class="col-md-12">
        <h1 class="animate-box fadeInLeft animated" data-animate-effect="fadeInLeft">
            CONTRATOS
        </h1>
    </div>
    

    <form class="row g-3" enctype="multipart/form-data" id="form-contrato" onsubmit='edit_contrato({{$contrato->id}});'>
        @csrf
        <div class="row mt-2">
            <div class="col-md-6 mt-3">
                <h4 style="color:gray;font-size:20px;">-Agregar</h4>
            </div>
            <div class="col-md-6 mt-3" style="text-align:end">
                <button type="submit" class="btn" id="btnGuardar" style="background:green;color:white;">Actualizar</button>
                <a type="button" class="btn" id="btnCancelar" href="{{ url('/contratos') }}" style="background:red;color:white;">Cancelar</a>
            </div>
        </div>
        <hr style="color: orange;">
        <h5>Cliente</h5>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="id_cliente" name="id_cliente">Nombre</label>
                <input type="text" class="form-control" value="{{$contrato->cliente->razon_social}} - {{$contrato->cliente->cliente}}">
            </div>
        </div>
        <hr style="color: orange;">
        <h5>Contraparte</h5>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="nombre_contraparte">Nombre</label>
                <input type="text" class="form-control" id="nombre_contraparte" name="nombre_contraparte" value="{{$contrato->nombre_contraparte}}">
            </div>
        </div>
        <hr style="color:orange;">
        <h5>Informacion Contrato </h5>
        <div class="row" >
            <div class="form-group col-md-1">
            </div>
              <div class="form-group col-md-4">
                  <label for="folio">Folio del Contrato</label>
                  <input type="text" class="form-control" id="folio" name="folio"  value="{{$contrato->folio}}" >
              </div>
              <div class="form-group col-md-2">
              </div>
              <div class="form-group col-md-4">
                <label for="folio">Costo de Operación</label>
                <input type="text" class="form-control" id="costo" name="costo"  value="{{$contrato->costo}}" >
             </div>
             <div class="form-group col-md-1">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label for="descripcion">Descripcion</label>
                {{-- <input type="text" class="form-control" id="descripcion" name="descripcion"  value="{{$contrato->descripcion}}"> --}}
                <textarea style="height: 113px;resize:none" id="descripcion" name="descripcion" class="form-control">{{$contrato->descripcion}}</textarea>

            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label for="monto">Monto Total</label>
                <input type="text" class="form-control" id="monto" name="monto" value="{{$contrato->monto}}">
            </div>
            <div class="col-md-4">
                <label for="fecha_inicio">Fecha Inicio</label>
                <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" value="{{$contrato->fecha_inicio}}">
            </div>
            <div class="col-md-4">
                <label for="fecha_final">Fecha Final</label>
                <input type="date" class="form-control" id="fecha_final" name="fecha_final" value="{{$contrato->fecha_final}}">
            </div>
        </div>
        <h5>DIRECCIÓN DE OBRA</h5>
        <div class="row">
            <div class="col-md-4">
                <label for="inputcalle2">Calle</label>
                <input type="text" class="form-control" id="inputcalle2" name="calle_contraparte" value="{{$contrato->calle_contraparte}}">
            </div>
            <div class="col-md-4">
                <label for="numero_contraparte">Numero</label>
                <input type="text" class="form-control" id="numero_contraparte" name="numero_contraparte" value="{{$contrato->numero_contraparte}}">
            </div>
            <div class="col-md-4">
                <label for="colonia_contraparte">Colonia</label>
                <input type="text" class="form-control" id="colonia_contraparte" name="colonia_contraparte" value="{{$contrato->colonia_contraparte}}">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="localidad">Localidad</label>
                <input type="text" class="form-control" id="localidad" name="localidad" value="{{$contrato->localidad}}">
            </div>
            <div class="col-md-2">
                <label for="cp_contratante">CP</label>
                <input type="text" class="form-control" id="cp_contratante" name="cp_contratante" value="{{$contrato->cp_contratante}}">
            </div>
        </div>
    </form>
    <form>
        <hr style="color:orange;">
        <div class="row">
            <h5>ARCHIVOS ADJUNTOS DEL CONTRATO</h5>
        </div>
        <br>
        <div class="row mt-2">
            @if($contrato->file)
            <div class="col-md-3">
                <a class="btn btn-secondary" href={{url("/storage/docs/contrato_adjuntos/{$contrato->folio}/{$contrato->file}")}} target="_blank">Contrato</a>
                <a  style="color: black" href="#"  class="btn"><i style="font-size:1.5rem" id="trash-alt"  onclick='borrarFile1("{{$contrato->file}}")' class="fas fa-trash-alt"></i></a>
            </div>
            @else
            <div class="col-md-6">
            <label for="file">Adjuntar PDF de Contrato: </label>
            <input type="file" class="form-control" id="file" name="file" onchange = updatefile(this); style="border:none;">
            </div>
            @endif
            @if($contrato->file2)
            <div class="col-md-3">
                <a class="btn btn-secondary" href={{url("/storage/docs/contrato_adjuntos/{$contrato->folio}/{$contrato->file2}")}} target="_blank">Anticipo</a>
                <a  style="color: black" href="#"  class="btn"><i style="font-size:1.5rem" onclick='borrarFile2("{{$contrato->file2}}")' id="trash-alt"  class="fas fa-trash-alt"></i></a>
            </div>
            @else
            <div class="col-md-6">
            <label for="file2">Adjuntar PDF de Anticipo: </label>
            <input type="file" class="form-control" id="file2" name="file2" onchange = updatefile(this); style="border:none;">
            </div>
            @endif
            @if($contrato->file3)
            <div class="col-md-3">
                <a class="btn btn-secondary" href={{url("/storage/docs/contrato_adjuntos/{$contrato->folio}/{$contrato->file3}")}} target="_blank">Cumplimiento</a>
                <a  style="color: black" href="#"  class="btn"><i style="font-size:1.5rem" id="trash-alt" onclick='borrarFile3("{{$contrato->file3}}")' class="fas fa-trash-alt"></i></a>
            </div>
            @else
            <div class="col-md-6">
            <label for="file3">Adjuntar PDF de Cumplimiento:  </label>
            <input type="file" class="form-control" id="file3" name="file3" onchange = updatefile(this); style="border:none;">
            </div>
            @endif
            @if($contrato->file4)
            <div class="col-md-3">
                <a class="btn btn-secondary" href={{url("/storage/docs/contrato_adjuntos/{$contrato->folio}/{$contrato->file4}")}} target="_blank">Vicios Ocultos</a>
                <a  style="color: black" class="btn"><i style="font-size:1.5rem" id="trash-alt" onclick='borrarFile("{{$contrato->file4}}")' class="fas fa-trash-alt"></i></a>
            </div>
            @else
            <div class="col-md-6">
            <label for="file4">Adjuntar PDF de Vicios Ocultos:  </label>
            <input type="file" class="form-control" id="file4" name="file4" onchange = updatefile(this); style="border:none;">
            </div>
            @endif
        </div>
        </div>
    </form>


    @endsection
    @section('scripts')

    <script>
        async function edit_contrato(id) {
            event.preventDefault();
            let form = new FormData(document.getElementById("form-contrato"));
            let url = "{{url('/contratos/{id}')}}".replace("{id}", id);
            let init = {
                method: "PUT"
                , headers: {
                    'X-CSRF-Token': document.getElementsByName("_token")[0].value
                    , "Content-Type": "application/json"
                }
                , body: JSON.stringify(Object.fromEntries(form))
            }
            let req = await fetch(url, init);
            if (req.ok) {
            window.location.href = "{{url('/contratos')}}";
            } else {
                Swal.fire({
                    icon: 'error'
                    , title: 'Error'
                    , text: 'Error al actualizar el contrato'
                , });
            }
        }


        async function borrarFile1(file){
            event.preventDefault();
            let id =   {{ $contrato->id }}
            let url='{{url("/contratos/eliminar1/{id}/{file}")}}'.replace("{file}",file);
            url = url.replace("{id}",id);
            let init={
                method:"DELETE",
                headers: {
                    'X-CSRF-Token': document.getElementsByName("_token")[0].value
                    , "Content-Type": "application/json"
                }
            }
            let req = await fetch(url,init);
            if(req.ok){
               location.reload();
            }
            else{
                Swal.fire({
                    icon: 'error'
                    , title: 'Error'
                    , text: 'Error al borrar el archivo'
                , });
            }

        }

        async function borrarFile2(file2){
            event.preventDefault();
            let id =   {{ $contrato->id }}
            let url='{{url("/contratos/eliminar2/{id}/{file2}")}}'.replace("{file2}",file2);
            url = url.replace("{id}",id);
            let init={
                method:"DELETE",
                headers: {
                    'X-CSRF-Token': document.getElementsByName("_token")[0].value
                    , "Content-Type": "application/json"
                }
            }
            let req = await fetch(url,init);
            if(req.ok){
               location.reload();
            }
            else{
                Swal.fire({
                    icon: 'error'
                    , title: 'Error'
                    , text: 'Error al borrar el archivo'
                , });
            }

        }

        async function borrarFile3(file3){
            event.preventDefault();
            let id =   {{ $contrato->id }}
            let url='{{url("/contratos/eliminar3/{id}/{file3}")}}'.replace("{file3}",file3);
            url = url.replace("{id}",id);
            // console.log(url);
            let init={
                method:"DELETE",
                headers: {
                    'X-CSRF-Token': document.getElementsByName("_token")[0].value
                    , "Content-Type": "application/json"
                }
            }
            let req = await fetch(url,init);
            if(req.ok){
               location.reload();
            }
            else{
                Swal.fire({
                    icon: 'error'
                    , title: 'Error'
                    , text: 'Error al borrar el archivo'
                , });
            }

        }

        async function updatefile(file){
            document.getElementById("loader").style.display = "block";
            let form = new FormData();
            form.append('file',file.id);
            form.append('file_info',file.files[0]);
            let id =   {{ $contrato->id }}
            let url='{{url("/contratos/actualizar/{id}")}}'.replace('{id}',id);
            let init ={
                method:"POST",
                headers:{
                    'X-CSRF-Token': document.getElementsByName("_token")[0].value
                },
                body:form
            }

            let req = await fetch(url,init);
            document.getElementById("loader").style.display = "none";
        }


        async function borrarFile(file4){
            event.preventDefault();
            let id =   {{ $contrato->id }}
            let url='{{url("/contratos/eliminar/{id}/{file4}")}}'.replace("{file4}",file4);
            url = url.replace("{id}",id);
            let init={
                method:"DELETE",
                headers: {
                    'X-CSRF-Token': document.getElementsByName("_token")[0].value
                    , "Content-Type": "application/json"
                }
            }
            let req = await fetch(url,init);
            if(req.ok){
               location.reload();
            }
            else{
                Swal.fire({
                    icon: 'error'
                    , title: 'Error'
                    , text: 'Error al borrar el archivo'
                , });
            }

        }

    </script>
    @endsection
