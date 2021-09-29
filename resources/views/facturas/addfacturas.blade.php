@extends('layouts.base_html')

@section('title')
    PRE-FACTURAS
@endsection

@section('styles')
@endsection


@section('body')
<div class="container pt-1">
<div class="row">
    <div class="col-md-12">
        <h4 style="color:gray;font-size:20px;">-Crear Pre-Factura Contrato</h4>
        <hr style="color: orange;">
    </div>
    <div class="div"></div>
</div>


<form id="form-prefactura" class="row g-3" onSubmit='insert_prefactura();'>
@csrf
  <div class="row mt-3">
    <div class="col-md-4">
      <label for="folio_prefactura" >Folio de Prefactura</label>
      <input type="text" readonly class="form-control" value="{{$folio_prefactura}}" id="folio_prefactura" name='folio_prefactura'>
  </div>
    <div class="col-md-4">
      <label form="contrato">Folio del Contrato</label>
        <select class="form-control"readonly name="id_contrato" id="id_contrato">
          <option value="{{$contrato->id}}">{{$contrato->folio}}</option>
        </select>
    </div>
    <div class="col-md-4">
      <label for="monto_total" >Monto Total del Contrato</label>
      <input type="text"  class="form-control" id="monto_total" name='monto_total' readonly value="{{$contrato->monto}}">
    </div>
  </div>
  <h4 style="color:white;background-color:orange;font-size:23px;font-weight:bold;text-align:center">Estimación</h4>
  <div class="row">
    <div class="col-md-6">
    <label for="fecha_elaboracion" >Fecha de Inicio</label>
      <input type="date" class="form-control" id="fecha_elaboracion" name="fecha_inicio" required>
    </div>
      <div class="col-md-6">
        <label for="fecha_elaboracion" >Fecha Final</label>
          <input type="date" class="form-control" id="fecha_final" name="fecha_final" required>
        </div>
  </div>
  <div class="row">
    <div class="col-md-4">
      <label for="importe_estimacion" >Importe de estimacion</label>
      <input type="text" class="form-control" id="importe_estimacion" oninput="cal()" placeholder="Ingrese Importe" name="importe_estimacion" id="importe_estimacion" required>
    </div>
    <div class="col-md-4">
        <label for="anticipo" >(-) Anticipo Entregado</label>
        <input type="text"  class="form-control" id="anticipo" name='anticipo' oninput="cal()" disabled value="{{$contrato->anticipo}}">
    </div>
    <div class="col-md-4">
      <label for="sub-total" >Sub-Total</label>
      <input type="text" disabled class="form-control" id="sub_total" name='sub_total' value="0.00">
  </div>
</div>
  <div class="row">
    <div class="col-md-12">
      <label for="concepto">Concepto de la estimación</label>
      <input type="text" class="form-control" id="concepto" name="concepto">
    </div>
  </div>

  <div class="row mt-2">
    <div class="col-md-6">
      <label for="iva" >% de I.V.A</label>
      <input type="text" class="form-control" id="iva" oninput="total()" placeholder="Ingrese el iva correspondiente" name="iva" required>
    </div>
    <div class="col-md-6">
      <label for="sub_iva" >SubTotal con IVA</label>
      <input type="text"disabled class="form-control" id="subtotal_iva"    name="subtotal_iva" required value="0.00">
    </div>
  </div>
  <div class="row mt-2">
    <div class="col-md-6">

    </div>
    <div class="col-md-6">
        <label for="total_estimacion" >Total de estimación</label>
        <input type="text" disabled  class="form-control" id="total_estimacion"  name='total_estimacion' value="0.00">
    </div>
  </div>

  <h4 style="color:white;background-color:orange;font-size:23px;font-weight:bold;text-align:center">Retenciones</h4>
  <div class="row mt-3">
    <div class="col-md-6">
      <label for="IVYC" >I.V.Y.C </label>
      <input type="text" class="form-control" oninput="retencion()" id="ivyc" name="ivyc" >
    </div>
    <div class="col-md-6">
      <label for="primer_monto" >Monto con I.V.Y.C </label>
      <input type="text" disabled class="form-control" id="monto_ivyc" name="monto_ivyc" value="0.00" >
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <label for="ICIC" >I.C.I.C</label>
      <input type="text"  class="form-control" oninput="retencion()" id="icic" name="icic"  >
    </div>
    <div class="col-md-6">
      <label for="segundo_monto" >Monto con I.C.I.C </label>
      <input type="text" disabled class="form-control"  id="monto_icic"  name="monto_icic" value="0.00" >
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
    </div>
    <div class="col-md-6">
      <label for="retenciones" >Total de retenciones </label>
      <input type="text" disabled class="form-control"  id="total_retenciones"  name="total_retenciones" value="0.00" >
    </div>
  </div>

  <h4 style="color:white;background-color:orange;font-size:23px;font-weight:bold;text-align:center">Total neto de la estimación</h4>
  <div class="row mt-3">
    <div class="col-md-4">
    </div>
    <div class="col-md-4" style="text-align:center">
      <label for="neto" >Neto de la estimación &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="btn btn-success " style="color:white;" onclick="Sumar();">Calcular</a> </label>
      <input type="text" disabled class="form-control" id="neto" name="neto" value="0.00">
    </div>
    <div class="col-md-4">
    </div>
  </div>

  <div class="form-row">
    <div class="form-group">
        <button type="submit" class="btn" id="btnGuardar" style="background:blue;color:white;">Guardar</button>
        <a type="button" class="btn" id="btnCancelar" href="{{url("/contratos")}}" style="background:red;color:white;" >Cancelar</a>
    </div>
  </div>

</form>
</div>

@endsection

@section('scripts')
<script>
  function cal(){
    try{
      var a=parseFloat(document.getElementById("importe_estimacion").value)||0.00,
          b=parseFloat(document.getElementById("anticipo").value);

          document.getElementById("sub_total").value=(a-b).toFixed(2);
      }
      catch(e){}
    }
    function total(){
      try{
        var a = parseFloat(document.getElementById("sub_total").value),
            b = ((parseFloat(document.getElementById("iva").value))/100)||0;
            
            let c = (a*b).toFixed(2);
            document.getElementById("subtotal_iva").value=c;

            document.getElementById("total_estimacion").value= parseFloat(+c + +a).toFixed(2);
      }
      catch(e){}
    }
    
    function retencion(){
      try{
        var a= ((parseFloat(document.getElementById("ivyc").value))/100)||0,
            c=((parseFloat(document.getElementById("icic").value))/100)||0,
            b=parseFloat(document.getElementById("importe_estimacion").value);

            let x=(a*b).toFixed(2);
            document.getElementById("monto_ivyc").value=x;
            let y = (b*c).toFixed(2);
            document.getElementById("monto_icic").value=y;

            document.getElementById("total_retenciones").value=parseFloat(+x + +y).toFixed(2);
      }
      }
      catch(e){}
    }
    function Sumar(){
      var estimacion = document.getElementById("total_estimacion").value;
      var retenciones = document.getElementById("total_retenciones").value;
      document.getElementById("neto").value=(estimacion-retenciones).toFixed(2);
    }


    async function insert_prefactura(){
      event.preventDefault();
      let form= new FormData(document.getElementById("form-prefactura"));
      form.append("id_status",1);
      form.append("id_forma",1);
      form.append("anticipo",document.getElementById("anticipo").value);
      form.append("sub_total",document.getElementById("sub_total").value);
      form.append("subtotal_iva",document.getElementById("subtotal_iva").value);
      form.append("total_estimacion",document.getElementById("total_estimacion").value);
      form.append("monto_ivyc",document.getElementById("monto_ivyc").value);
      form.append("monto_icic",document.getElementById("monto_icic").value);
      form.append("total_retenciones",document.getElementById("total_retenciones").value);
      form.append("neto",document.getElementById("neto").value);
      let url="{{url('/facturas')}}";
      let init = {
        method:"POST",
        body:form
      }
      let req = await fetch(url,init);
      //console.log(JSON.stringify(Object.fromEntries(form))
      if(req.ok){
        let res =await req.json();
        window.open(`{{url('/prefacturas_pdf/${res.id}')}}`, '_blank');
        window.location.href="{{url('/facturas')}}";
      }
      else{
        Swal.fire({
        icon: 'error',
        title: 'Error',
        text: "ERROR AL REGISTRAR LA PREFACTURA"
      });
      }
    }
</script>
@endsection