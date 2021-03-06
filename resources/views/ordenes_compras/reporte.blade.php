@extends('layouts.base_html')
@section('tittle') REPORTE DE LA ORDEN DE COMPRA @endsection 
@section('styles')
<style></style>
@endsection
@section('body')
<div class="container mt-5" >
    <div class="row">
        <h1 class="animate-box fadeInLeft animated" data-animate-effect="fadeInLeft">
            REPORTE DE LA ORDEN DE COMPRA
        </h1>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h4 style="color:gray;font-size:20px;">-Generar reporte</h4>
            <hr style="color: orange;">
            <p>  
            </p>
        </div>
    </div>
    <form id="form-reporte" class="row g-3" onSubmit="reportes();">
        @csrf
        <div class="row">
            <div class="col-md-3">
                
            </div>
            <div class="col-md-6">
                <label for="contrato">Obra</label>
                <select autocomplete="on" class="form-control" name="id_contrato" id="id_contrato">
                    <option value="0" selected disabled>SELECCIONE</option>
                    @foreach($contratos as $contrato)
                      <option value="{{$contrato->id}}">{{$contrato->descripcion}}</option>
                    @endforeach
                  </select>
            </div>
            <div class="col-md-3">
                
            </div>
        </div>
        <div class="row mt-2" style="text-align:center">
            <label for="estatus">Ingrese las fechas correspondientes   (Fecha Inicio - Fecha Final)</label>
            <div class="col-md-6 mt-2">
                <input type="date" class="form-control" id="fecha1" name="fecha_orden" required>
            </div>
            <div class="col-md-6 mt-2">
                <input type="date" class="form-control" id="fecha2" name="fecha_orden" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
            </div>
            <div class="col-md-6">
                <label for="estatus">Estatus de la Orden</label>
                <select class="form-control" name="id_status" id="id_status">
                <option value="0" selected>Todos</option>
                    @foreach($estatus as $estatu)
                      <option value="{{$estatu->id}}">{{$estatu->status}}</option>
                    @endforeach
                  </select>
            </div>
            <div class="col-md-3">
            </div>
        </div>
        <div class="row mt-3"style="text-align:center">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <button type="submit"  form="form-reporte" class="btn btn-success" id="btngenerar">Generar</button>
                <a href="{{url('/compras')}}" type="button" class="btn btn-danger" id="btnCancelar">Cancelar</a>
            </div>
            <div class="col-md-4"></div>
        </div>

    </form>
</div>
@endsection
@section('scripts')
<script>
async function reportes(){
    event.preventDefault();
    let contrato = document.getElementById("id_contrato").value;
    let status=document.getElementById("id_status").value;
    let fecha1=document.getElementById("fecha1").value;
    let fecha2=document.getElementById("fecha2").value;
    let form = new FormData(document.getElementById("form-reporte"));
    let url="{{url('contrato/{id_contrato}/estatus/{id_status}/fecha/{fecha1}/fecha/{fecha2}/REPORTE')}}";
    let url2 = url.replace("{id_contrato}",contrato);
    let url3 = url2.replace("{id_status}",status);
    let url4 = url3.replace("{fecha1}",fecha1);
    let url5 = url4.replace("{fecha2}",fecha2);
    let init = {
        method:"GET"
    }
    let req = await fetch(url5,init);
        if(req.ok){
         //let res = await req.json();
         window.open(req.url);
     }
     else{
         alert("NO CONTIENE ORDENES DE COMPRA, FAVOR DE VERIFICAR LOS DATOS");
     }
}
</script>
@endsection