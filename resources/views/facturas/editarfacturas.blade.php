@extends('layouts.base_html')

@section('title')
PRE-FACTURAS
@endsection
@section('body')
<div class="container pt-1">
    <div class="row">
        <div class="col-md-12">
            <h4 style="color:gray;font-size:20px;">-Editar Pre-Factura Contrato</h4>
            <hr style="color: orange;">
        </div>
    </div>
    <form id="form-editar" class="row g-3">
        @csrf
        <div class="row mt-3">
            <div class="col-md-4">
                <label for="folio_prefactura">Folio Prefactura</label>
                <input type="text" readonly class="form-control" value="{{$prefactura->folio_prefactura}}"
                    name="folio_prefactura" id="folio_prefactura">
            </div>
            <div class="col-md-4">
                <label for="id_contrato">Folio del Contrato</label>
                <select class="form-control" readonly name="id_contrato" id="id_contrato">
                    <option value="{{$prefactura->id_contrato}}">{{$prefactura->contrato->folio}}</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="monto_total">Monto Total del Contrato</label>
                <input type="text" class="form-control" id="monto_total" name='monto_total' readonly
                    value="{{$prefactura->monto_total}}">
            </div>
        </div>
        <h4 style="color:white;background-color:orange;font-size:23px;font-weight:bold;text-align:center">Estimación
        </h4>
        <div class="row">
            <div class="col-md-6">
                <label for="fecha_elaboracion">Fecha de Inicio</label>
                <input type="date" class="form-control" id="fecha_elaboracion" name="fecha_inicio"
                    value="{{$prefactura->fecha_inicio}}">
            </div>
            <div class="col-md-6">
                <label for="fecha_elaboracion">Fecha Final</label>
                <input type="date" class="form-control" id="fecha_final" name="fecha_final"
                    value="{{$prefactura->fecha_final}}">
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <label for="importe_estimacion">Importe de estimacion</label>
                <input type="text" class="form-control" id="importe_estimacion" oninput="cal()"
                    placeholder="Ingrese Importe" name="importe_estimacion" id="importe_estimacion"
                    value="{{$prefactura->importe_estimacion}}">
            </div>
            <div class="col-md-3">
                <label for="porcentaje">(%) Anticipo Entregado</label>
                <input type="text" class="form-control" id="porcentaje" name="porcentaje" oninput="cal()" value="{{$prefactura->porcentaje}}">
            </div>
            <div class="col-md-3">
                <label for="anticipo">(-) Anticipo Entregado</label>
                <input type="text" class="form-control" id="anticipo" name='anticipo' oninput="cal()" disabled
                    value="{{$prefactura->anticipo}}">
            </div>
            <div class="col-md-3">
                <label for="sub-total">Sub-Total</label>
                <input type="text" readonly class="form-control" id="sub_total" name='sub_total'
                    value="{{$prefactura->sub_total}}">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label for="concepto">Concepto de pago de estimación</label>
                <input type="text" class="form-control" value="{{$prefactura->concepto_pago}}" id="concepto_pago"
                    name="concepto_pago">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label for="concepto">Concepto de la estimación</label>
                <input type="text" class="form-control" value="{{$prefactura->concepto}}" id="concepto" name="concepto">
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-6">
                <label for="iva">% de I.V.A</label>
                <input type="text" class="form-control" id="iva" oninput="cal()"
                    placeholder="Ingrese el iva correspondiente" name="iva" value="{{$prefactura->iva}}">
            </div>
            <div class="col-md-6">
                <label for="sub_iva">SubTotal con IVA</label>
                <input type="text" readonly class="form-control" id="subtotal_iva" name="subtotal_iva"
                    value="{{$prefactura->subtotal_iva}}">
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-6">

            </div>
            <div class="col-md-6">
                <label for="total_estimacion">Total de estimación</label>
                <input type="text" readonly class="form-control" id="total_estimacion" name='total_estimacion'
                    value="{{$prefactura->total_estimacion}}">
            </div>
        </div>
        <h4 style="color:white;background-color:orange;font-size:23px;font-weight:bold;text-align:center">Retenciones
        </h4>
        <div class="row mt-3">
            <div class="col-md-6">
                <label for="IVYC">I.V.Y.C </label>
                <input type="text" class="form-control" value="{{$prefactura->ivyc}}" oninput="retencion()" id="ivyc"
                    name="ivyc">
            </div>
            <div class="col-md-6">
                <label for="primer_monto">Monto con I.V.Y.C </label>
                <input type="text" readonly class="form-control" id="monto_ivyc" name="monto_ivyc"
                    value="{{$prefactura->monto_ivyc}}">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="ICIC">I.C.I.C</label>
                <input type="text" class="form-control" value="{{$prefactura->icic}}" oninput="retencion()" id="icic"
                    name="icic">
            </div>
            <div class="col-md-6">
                <label for="segundo_monto">Monto con I.C.I.C </label>
                <input type="text" readonly class="form-control" id="monto_icic" name="monto_icic"
                    value="{{$prefactura->monto_icic}}">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
            </div>
            <div class="col-md-6">
                <label for="retenciones">Total de retenciones </label>
                <input type="text" readonly class="form-control" id="total_retenciones" name="total_retenciones"
                    value="{{$prefactura->total_retenciones}}">
            </div>
        </div>
        <h4 style="color:white;background-color:orange;font-size:23px;font-weight:bold;text-align:center">Total neto de
            la estimación</h4>
        <div class="row mt-3">
            <div class="col-md-4">
            </div>
            <div class="col-md-4" style="text-align:center">
                <label for="neto">Neto de la estimación &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="btn btn-success "
                        style="color:white;" onclick="Sumar();">Calcular</a> </label>
                <input type="text" readonly class="form-control" id="neto" name="neto" value="{{$prefactura->neto}}">
            </div>
            <div class="col-md-4">
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <button type="submit" class="btn" id="btnGuardar" style="background:blue;color:white;">Guardar</button>
                <a type="button" class="btn" id="btnCancelar" href="{{url("/facturas")}}"
                    style="background:red;color:white;">Cancelar</a>
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
          porcentaje=parseFloat(document.getElementById("porcentaje").value)||0,
          iva= ((parseFloat(document.getElementById("iva").value))/100)||0;

          document.getElementById("anticipo").value=a*(porcentaje/100);
          let b =  document.getElementById("anticipo").value=(a*(porcentaje/100)).toFixed(2);

          document.getElementById("sub_total").value=(a-b).toFixed(2);

          let sub_total= document.getElementById("sub_total").value=(a-b).toFixed(2);

          let c = (sub_total*iva).toFixed(2);
          document.getElementById("subtotal_iva").value=c;

          document.getElementById("total_estimacion").value= parseFloat(+c + +sub_total).toFixed(2);
      }
      catch(e){}
    }

    // function total(){
    //   try{
    //     var a = parseFloat(document.getElementById("sub_total").value),
    //         b = ((parseFloat(document.getElementById("iva").value))/100)||0;
            
    //         let c = (a*b).toFixed(2);
    //         document.getElementById("subtotal_iva").value=c;

    //         document.getElementById("total_estimacion").value= parseFloat(+c + +a).toFixed(2);
    //   }
    //   catch(e){}
    // }
    
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
      
      catch(e){}
    }

    function Sumar(){
      var estimacion = document.getElementById("total_estimacion").value;
      var retenciones = document.getElementById("total_retenciones").value;
      document.getElementById("neto").value=(estimacion-retenciones).toFixed(2);
    }

    document.getElementById("form-editar").onsubmit = async() => {
        event.preventDefault();
         let form = new FormData(document.getElementById("form-editar"));
        form.append("sub_total",document.getElementById("sub_total").value);
        form.append("subtotal_iva",document.getElementById("subtotal_iva").value);
        form.append("total_estimacion",document.getElementById("total_estimacion").value);
        form.append("monto_ivyc",document.getElementById("monto_ivyc").value);
        form.append("monto_icic",document.getElementById("monto_icic").value);
        form.append("total_retenciones",document.getElementById("total_retenciones").value);
        form.append("neto",document.getElementById("neto").value);
         let id = "{{$prefactura->id}}";
         let url="{{url('/facturas/{id}')}}".replace("{id}",id);
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
             console.log(await req.json());
             window.location.href = "{{url('/facturas')}}";
         }
         else{
             Swal.fire({
                 icon: 'error',
                 title: 'Error',
                 text: 'No fue posible la prefactura',
             });
         }
    }

</script>
@endsection