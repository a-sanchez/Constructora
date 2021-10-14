@extends('layouts.base_html')

@section ('tittle')CONTRATOS
@endsection

@section("scripts")
<script src="https://kit.fontawesome.com/b4cf0d1143.js" crossorigin="anonymous"></script>
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
        <h4 style="color:gray;font-size:20px;">-DETALLES</h4>
        <hr style="color: orange;">
        <p>  
        </p>
    </div>
</div>
  <h5>Cliente</h5>

    <form class="row g-3"  >
    @csrf
        <div class="form-row" >
            <div class="form-group col-md-6">
                <label for="id_cliente" name="id_cliente">Nombre</label>
                <input type="text" class="form-control" readonly value="{{$contrato->cliente->razon_social}} - {{$contrato->cliente->cliente}}">
            </div>
          </div>
      <hr style="color: orange;">
      <h5>Contraparte</h5>
      <div class="form-row" >
            <div class="form-group col-md-6">
                <label for="nombre_contraparte">Nombre</label>
                <input type="text" class="form-control" readonly value="{{$contrato->nombre_contraparte}}">
            </div>
      </div>
      <hr style="color:orange;">
        <h5>Informacion Contrato </h5>
        <div class="row" >
            <div class="form-group col-md-1">
            </div>
              <div class="form-group col-md-4">
                  <label for="folio">Folio del Contrato</label>
                  <input type="text" class="form-control" id="folio" name="folio" readonly value="{{$contrato->folio}}" >
              </div>
              <div class="form-group col-md-2">
              </div>
              <div class="form-group col-md-4">
                <label for="folio">Costo de Operación</label>
                <input type="text" class="form-control" id="costo" name="costo" readonly value="$ {{number_format($contrato->costo,2)}}" >
             </div>
             <div class="form-group col-md-1">
            </div>
        </div>
        <div class="row">
          <div class="col-md-12">
          <label for="descripcion" >Descripcion</label>
          <textarea style="height: 113px;resize:none" class="form-control" readonly >{{$contrato->descripcion}}</textarea>
        </div>
        {{-- <div class="row">
          <div class="col-md-4">
            <label for="anticipo">Anticipo</label>
            <input type="text" class="form-control" readonly value="{{$contrato->anticipo}}">
          </div>
          <div class="col-md-4">
            <label for="fecha_anticipo">Fecha Anticipo</label>
            <input type="date" class="form-control" readonly value="{{$contrato->fecha_anticipo}}">
          </div>
          <div class="col-md-4">
            <label for="monto" >Monto Total</label>
            <input type="text" class="form-control" readonly value="{{$contrato->monto}}">
          </div>
        </div> --}}
      </div>
      <div class="row">
        <div class="col-md-4">
          <label for="monto" >Monto Total</label>
          <input type="text" class="form-control" readonly value="{{$contrato->monto}}">
        </div>
        <div class="col-md-4">
          <label for="fecha_inicio" >Fecha Inicio</label>
          <input type="text" class="form-control" readonly value="{{date('d/m/Y', strtotime($contrato->fecha_inicio))}}" >
        </div>
        <div class="col-md-4">
          <label for="fecha_final" >Fecha Final</label>
          <input type="text" class="form-control" readonly value="{{date('d/m/Y', strtotime($contrato->fecha_final))}}"  >
        </div>
      </div>
      <h5>DIRECCIÓN DE OBRA</h5>
      <div class="row">
        <div class="col-md-4">
          <label for="inputcalle2" >Calle</label>
          <input type="text" class="form-control" readonly value="{{$contrato->calle_contraparte}}">
        </div>
        <div class="col-md-4">
          <label for="numero_contraparte" >Numero</label>
          <input type="text" class="form-control" readonly value="{{$contrato->numero_contraparte}}" >
        </div>
        <div class="col-md-4">
          <label for="colonia_contraparte" >Colonia</label>
          <input type="text" class="form-control" readonly value="{{$contrato->colonia_contraparte}}">
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <label for="localidad" >Localidad</label>
          <input type="text" class="form-control" readonly value="{{$contrato->localidad}}" >
        </div>
        <div class="col-md-2">
          <label for="cp_contratante" >CP</label>
          <input type="text" class="form-control" readonly value="{{$contrato->cp_contratante}}" >
        </div>
      </div>
      <hr style="color:orange;">
      <div class="row">
        <h5>ARCHIVOS ADJUNTOS DEL CONTRATO</h5>
      </div>
      <br>
    <div class="row mt-2">
      @if($contrato->file)
      <div class="col-md-3">
        <a class="btn btn-secondary"  href={{url("/storage/docs/contrato_adjuntos/{$contrato->folio}/{$contrato->file}")}} target="_blank" >Contrato</a>
      </div>
      @endif
      @if($contrato->file2)
      <div class="col-md-3">
        <a class="btn btn-secondary"  href={{url("/storage/docs/contrato_adjuntos/{$contrato->folio}/{$contrato->file2}")}} target="_blank" >Anticipo</a> 
      </div>
      @endif
      @if($contrato->file3)
      <div class="col-md-3">
      <a class="btn btn-secondary"  href={{url("/storage/docs/contrato_adjuntos/{$contrato->folio}/{$contrato->file3}")}} target="_blank" >Cumplimiento</a>
      </div>
      @endif
      @if($contrato->file4)
      <div class="col-md-3">
      <a class="btn btn-secondary"  href={{url("/storage/docs/contrato_adjuntos/{$contrato->folio}/{$contrato->file4}")}} target="_blank" >Vicios Ocultos</a>   
      </div>
      @endif

      <div class="form-row mt-2">

           <div class="col-md-12">
            <a  class="d-flex align-items-center" style="color: blue;text-decoration: none;font-size: 1rem;" href="{{ url('/contratos') }}"><i style="font-size:18px;" id="arrow-left" class="fas fa-arrow-left"></i>Regresar</a>
           </div>
       </div>
    </form>
  </div>
</div>

@endsection