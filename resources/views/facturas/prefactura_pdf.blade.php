<table width="100%"  >
    <tr style = "text-align: center;font-weight:bold">
        <td></td> 
        <td >BUENO POR: $ {{number_format($factura->monto_total,2)}}</td>   
    </tr>
    <tr style = "text-align: center;font-weight:bold">
        <td></td>
        <td>FECHA: {{date_create('now')->format('d-m-Y')}}</td>
    </tr>
    <tr style = "text-align: center;font-weight:bold">
        <td></td> 
        <td >CONTRATO:{{$factura->contrato->folio}}</td>
    </tr>
    <tr style = "text-align: center;font-weight:bold">
        <td></td> 
        <td  style="height:25px">PERIODO: DEL {{date("d-m-Y", strtotime($factura->fecha_inicio))}} AL {{date("d-m-Y", strtotime($factura->fecha_final))}}</td>
    </tr>
    <tr>
        <td colspan="3" style="text-align:end"  style="height:80px">RECIBI DE {{$factura->contrato->cliente->razon_social}} la cantidad de: $ <b>{{$factura->monto_total}} </b>
            POR CONCEPTO DE PAGO DE ESTIMACION <b>DEL CONTRATO</b> {{$factura->contrato->folio}}  DE LA OBRA: <b>{{$factura->concepto}}</b>
        </td>
        
    </tr>
    <tr>
        <td  colspan="3" style="text-align: center"><b>IMPORTE DE ESTIMACION.......... $  {{number_format($factura->importe_estimacion,2)}}</b></td>
    </tr>
    <tr>
        <td colspan="3" style="text-align: center">(-)ANTICIPO ENTREGADO(30%).. $     -      {{number_format($factura->anticipo,2)}}</td>
    </tr>
    <tr>
        <td colspan="3" style="text-align: center">SUB-TOTAL ESTIMACION..............$    {{number_format($factura->sub_total,2)}}</td>
    </tr>
    <tr>
        <td colspan="3" style="text-align: center"> {{$factura->iva}} % IVA..................................$    {{number_format($factura->subtotal_iva,2)}}</td>
    </tr>
    <tr>
        <td colspan="3" style="text-align: center"><b>TOTAL ESTIMACION......................${{number_format($factura->total_estimacion,2)}}</b></td>
    </tr> 
    <tr>
        <td colspan="3" style="text-align: center">
        </td>
    </tr>
    <tr>
        <td colspan="3"  style="text-align: center">RETENCION</td>
    </tr>
    <tr>
        <td colspan="3" style="text-align: center" >  I.V.Y.C {{$factura->ivyc}} % ................................ - {{number_format($factura->monto_ivyc,2)}}</td>
    </tr>
    <tr>
        <td colspan="3" style="text-align: center">I.C.I.C {{$factura->icic}} % ................................... - {{number_format($factura->monto_icic,2)}}</td>
    </tr>
    <tr>
        <td colspan="3" style="text-align: center">TOTAL RETENCIONES ......................- <b>{{number_format($factura->total_retenciones,2)}}</b></td>
    </tr>
    <tr>
        <td colspan="3" style="text-align: center"></td>
    </tr>
    <tr>
        <td colspan="3" style="text-align: center">
            <b>NETO ESTA ESTIMACION...............$ {{number_format($factura->neto,2)}}</b></td>
    </tr>
</table>


