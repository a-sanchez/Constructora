@extends('layouts.base_html')

@section ('tittle')CONTRATOS
@endsection

@section('styles')
<style>
  input{
    text-transform: uppercase;
  }
</style>
@endsection

@section('body')
<div class="container">
<div class="col-md-12">
                <h1 class="animate-box fadeInLeft animated" data-animate-effect="fadeInLeft">
                    CONTRATOS
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
  <h5>Cliente</h5>

    <form class="row g-3" id="form-contrato" onsubmit='edit_contrato({{$contrato->id}});'  >
    @csrf
        <div class="form-row" >
            <div class="form-group col-md-6">
                <label for="id_cliente" name="id_cliente">Nombre</label>
                <input type="text" class="form-control"  value="{{$contrato->cliente->razon_social}} - {{$contrato->cliente->cliente}}">
            </div>
          </div>
      <hr style="color: orange;">
      <h5>Contraparte</h5>
      <div class="form-row" >
            <div class="form-group col-md-6">
                <label for="nombre_contraparte">Nombre</label>
                <input type="text" class="form-control"  id="nombre_contraparte" name="nombre_contraparte" value="{{$contrato->nombre_contraparte}}">
            </div>
      </div>
      <hr style="color:orange;">
        <h5>Informacion Contrato </h5>
        <div class="form-row" >
            <div class="form-group col-md-4">
                <label for="folio">Folio del Contrato</label>
                <input type="text" class="form-control" id="folio" name="folio"  value="{{$contrato->folio}}" >
            </div>
        </div>
        <div class="row">
          <div class="col-md-12">
          <label for="descripcion" >Descripcion</label>
          <input type="text" class="form-control" id="descripcion" name="descripcion" raadonly value="{{$contrato->descripcion}}">
        </div>
        <div class="row">
          <div class="col-md-4">
            <label for="anticipo">Anticipo</label>
            <input type="text" class="form-control" name="anticipo" id="anticipo" value="{{$contrato->anticipo}}">
          </div>
          <div class="col-md-4">
            <label for="fecha_anticipo">Fecha Anticipo</label>
            <input type="date" class="form-control" name="fecha_anticipo" id="fecha_anticipo"  value="{{$contrato->fecha_anticipo}}">
          </div>
          <div class="col-md-4">
            <label for="monto" >Monto Total</label>
            <input type="text" class="form-control" id="monto"  name="monto" value="{{$contrato->monto}}">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <label for="fecha_inicio" >Fecha Inicio</label>
          <input type="date" class="form-control" id="fecha_inicio"  name="fecha_inicio" value="{{$contrato->fecha_inicio}}"  >
        </div>
        <div class="col-md-6">
          <label for="fecha_final" >Fecha Final</label>
          <input type="date" class="form-control" id="fecha_final"  name="fecha_final" value="{{$contrato->fecha_final}}" >
        </div>
      </div>
      <h5>DIRECCIÓN DE OBRA</h5>
      <div class="row">
        <div class="col-md-4">
          <label for="inputcalle2" >Calle</label>
          <input type="text" class="form-control"  id="inputcalle2"  name="calle_contraparte"  value="{{$contrato->calle_contraparte}}">
        </div>
        <div class="col-md-4">
          <label for="numero_contraparte" >Numero</label>
          <input type="text" class="form-control"  id="numero_contraparte"  name="numero_contraparte"  value="{{$contrato->numero_contraparte}}" >
        </div>
        <div class="col-md-4">
          <label for="colonia_contraparte" >Colonia</label>
          <input type="text" class="form-control" id="colonia_contraparte"  name="colonia_contraparte" value="{{$contrato->colonia_contraparte}}">
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <label for="localidad" >Localidad</label>
          <input type="text" class="form-control" id="localidad" name="localidad" value="{{$contrato->localidad}}" >
        </div>
        <div class="col-md-2">
          <label for="cp_contratante" >CP</label>
          <input type="text" class="form-control"  id="cp_contratante" name="cp_contratante" value="{{$contrato->cp_contratante}}">
        </div>
      </div>
      <hr style="color:orange;">


      <div class="form-row mt-2">
                <button type="submit" class="btn" id="btnGuardar" style="background:green;color:white;">Actualizar</button>
               <a type="button" class="btn" id="btnCancelar" href="{{ url('/contratos') }}" style="background:red;color:white;" >Cancelar</a>
           </div>
       </div>
    </form>


@endsection
@section('scripts')

<script>
async function edit_contrato(id) {
  event.preventDefault();
    let form = new FormData(document.getElementById("form-contrato"));
    let url = "{{url('/contratos/{id}')}}".replace("{id}",id);
    let init = {
        method:"PUT",
        headers:{
            'X-CSRF-Token' : document.getElementsByName("_token")[0].value,
            "Content-Type":"application/json"
        },
        body:JSON.stringify(Object.fromEntries(form))
    }
    let req = await fetch(url,init);
    if (req.ok) {
        window.location.href = "{{url('/contratos')}}";
    }
    else{
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Error al actualizar el contrato',
        });
    }
}
</script>
@endsection
