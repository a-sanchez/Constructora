<table width="100%" >
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
    <tr style = "text-align: center;font-weight:bold;font-size:10px;">
        <td style="width:25%"></td> 
        <td  style="height:25px;width:75%">
            <?php 
                $mes1 = "";
                switch (date("m", strtotime($factura->fecha_inicio))) {
                    case '01':
                        $mes1 = "ENERO";
                        break;
                    case '02':
                        $mes1 = "FEBRERO";
                        break;
                    case '03':
                        $mes1 = "MARZO";
                        break;
                    case '04':
                        $mes1 = "ABRIL";
                        break;
                    case '05':
                        $mes1 = "MAYO";
                        break;
                    case '06':
                        $mes1 = "JUNIO";
                        break;
                    case '07':
                        $mes1 = "JULIO";
                        break;
                    case '08':
                        $mes1 = "AGOSTO";
                        break;
                    case '09':
                        $mes1 = "SEPTIEMBRE";
                        break;
                    case '10':
                        $mes1 = "OCTUBRE";
                        break;
                    case '11':
                        $mes1 = "NOVIEMBRE";
                        break;
                    case '12':
                        $mes1 = "DICIEMBRE";
                        break;
                }
                $mes2 = "";
                switch (date("m", strtotime($factura->fecha_final))) {
                    case '01':
                        $mes2 = "ENERO";
                        break;
                    case '02':
                        $mes2 = "FEBRERO";
                        break;
                    case '03':
                        $mes2 = "MARZO";
                        break;
                    case '04':
                        $mes2 = "ABRIL";
                        break;
                    case '05':
                        $mes2 = "MAYO";
                        break;
                    case '06':
                        $mes2 = "JUNIO";
                        break;
                    case '07':
                        $mes2 = "JULIO";
                        break;
                    case '08':
                        $mes2 = "AGOSTO";
                        break;
                    case '09':
                        $mes2 = "SEPTIEMBRE";
                        break;
                    case '10':
                        $mes2 = "OCTUBRE";
                        break;
                    case '11':
                        $mes2 = "NOVIEMBRE";
                        break;
                    case '12':
                        $mes2 = "DICIEMBRE";
                        break;
                }
            ?>
            PERIODO: DEL {{date("j", strtotime($factura->fecha_inicio))}} DE {{$mes1}} DE {{date("Y", strtotime($factura->fecha_inicio))}} AL {{date("j", strtotime($factura->fecha_final))}} DE {{$mes2}} DE  {{date("Y", strtotime($factura->fecha_final))}}</td>
    </tr>
    <tr>
        <td colspan="3" style="text-align:start"  style="height:80px">RECIBI DE {{$factura->contrato->cliente->razon_social}} la cantidad de: $ <b>{{$factura->monto_total}} </b>
            <br>
            <b>{{$factura->concepto}}</b>
            <br>
            POR CONCEPTO DE PAGO DE ESTIMACION <b>{{$factura->concepto_pago}}</b>
        <br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>DEL CONTRATO &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b> {{$factura->contrato->folio}}  
        <br>DE LA OBRA: 
        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>{{$factura->contrato->descripcion}}</b>
        </td>
        
    </tr>
    <tr>
        <td  colspan="3" style="text-align: center"><b>IMPORTE DE ESTIMACION.......... $  {{number_format($factura->importe_estimacion,2)}}</b></td>
    </tr>
    <tr>
        <td colspan="3" style="text-align: center">(-)ANTICIPO ENTREGADO({{$factura->porcentaje}}%).. $     -      {{number_format($factura->anticipo,2)}}</td>
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


