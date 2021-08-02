@extends('layouts.base_html')

@section ('tittle')CONTRATOS @endsection

@section('styles')
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

    <form class="row g-3" onSubmit='insert_contrato();' id="form-contrato" >
    @csrf
        <div class="form-row" >
            <div class="form-group col-md-6">
                <label for="id_cliente" name="id_cliente">Nombre</label>
                <select class="form-select" id="id_cliente" name="id_cliente">
                  <option selected disabled value="0" >Seleccione:</option> 
                  @foreach($clientes as $cliente)
                  <option value="{{$cliente->id}}">{{$cliente->razon_social}} - {{$cliente->cliente}}</option>
                  @endforeach
                </select>
            </div>

      <hr style="color: orange;">
      <h5>Contraparte</h5>
      <div class="form-row" >
            <div class="form-group col-md-6">
                <label for="nombre_contraparte">Nombre</label>
                <input type="text" class="form-control" id="nombre_contraparte" name="nombre_contraparte" required>
            </div>
      </div>
      <hr style="color:orange;">
        <h5>Informacion Contrato </h5>
        <div class="form-row" >
            <div class="form-group col-md-4">
                <label for="folio">Folio del Contrato</label>
                <input type="text" class="form-control" id="folio" name="folio"placeholder="Ingrese folio de contrato" required >
            </div>
        </div>
        <div class="row">
          <div class="col-md-12">
          <label for="descripcion" >Descripcion</label>
          <input type="text" class="form-control" id="descripcion" placeholder="Descripcion" name="descripcion" required>
        </div>
        <div class="row">
          <div class="col-md-4">
            <label for="anticipo">Anticipo</label>
            <input type="text" class="form-control" name="anticipo" id="anticipo" value="0.00">
          </div>
          <div class="col-md-4">
            <label for="fecha_anticipo">Fecha Anticipo</label>
            <input type="date" class="form-control" name="fecha_anticipo" id="fecha_anticipo">
          </div>
          <div class="col-md-4">
            <label for="monto" >Monto Total</label>
            <input type="text" class="form-control" id="monto" placeholder="Monto Total" name="monto" required>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <label for="fecha_inicio" >Fecha Inicio</label>
          <input type="date" class="form-control" id="fecha_inicio" placeholder="Fecha de Inicio" name="fecha_inicio">
        </div>
        <div class="col-md-6">
          <label for="fecha_final" >Fecha Final</label>
          <input type="date" class="form-control" id="fecha_final" placeholder="Fecha de Fin" name="fecha_final" >
        </div>
      </div>
      <h7>Direccion de obra</h7>
      <div class="row">
        <div class="col-md-4">
          <label for="inputcalle2" >Calle</label>
          <input type="text" class="form-control" id="inputcalle2" placeholder="Calle" name="calle_contraparte" required>
        </div>
        <div class="col-md-4">
          <label for="numero_contraparte" >Numero</label>
          <input type="text" class="form-control" id="numero_contraparte" placeholder="Numero" name="numero_contraparte" >
        </div>
        <div class="col-md-4">
          <label for="colonia_contraparte" >Colonia</label>
          <input type="text" class="form-control" id="colonia_contraparte" placeholder="Colonia" name="colonia_contraparte" required>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <label for="localidad" >Localidad</label>
          <input type="text" class="form-control" id="localidad" placeholder="Localidad" name="localidad" >
        </div>
        <div class="col-md-2">
          <label for="cp_contratante" >CP</label>
          <input type="text" class="form-control" id="cp_contratante" placeholder="CP" name="cp_contratante" >
        </div>
      </div>
      <p> </p>
    <div class="row">
      <div class="col-md-3">
      <label for="file" >Adjuntar PDF del contrato:</label>
        <input type="file" class="form-control" id="file" name="file" style="border:none;">
      </div>
      <div class="col-md-3">
      <label for="file" >Adjuntar PDF del Anticipo:</label>
        <input type="file" class="form-control" id="file2" name="file2" style="border:none;">
      </div>
      <div class="col-md-3">
      <label for="file" >Adjuntar PDF del Cumplimiento:</label>
        <input type="file" class="form-control" id="file3" name="file3" style="border:none;">
      </div>
      <div class="col-md-3">
      <label for="file" >Adjuntar PDF de Vicios Ocultos:</label>
        <input type="file" class="form-control" id="file4" name="file4" style="border:none;">
      </div>
    </div>


      <div>
        <p> </p>
    </div>
      <div class="form-row">
           <div class="form-group">
               <button type="submit" class="btn" id="btnGuardar" style="background:blue;color:white;">Guardar</button>
               <a type="button" class="btn" id="btnCancelar" href="{{ url('/contratos') }}" style="background:red;color:white;" >Cancelar</a>
           </div>
       </div>
    </form>
  </div>
</div>

@endsection

@section("scripts")
<script>
  async function insert_contrato(){
    event.preventDefault();
    let form = new FormData(document.getElementById("form-contrato"));
    form.append("id_cliente",document.getElementById("id_cliente").value);
    let url = "{{ url('/contratos') }}";
    let init = {
      method:"POST",
      body:form
    }
    let req = await fetch(url, init);
    console.log(req);
    if (req.ok) {
      //window.location.href = "{{ url('/contratos') }}";
    }
    else{
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: "Error al registrar contrato"
      });
    }
  }
</script>

@endsection
