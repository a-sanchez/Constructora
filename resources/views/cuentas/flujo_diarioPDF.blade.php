
<table >
    <tr style=" line-height:20px;">
        <td width="10%"style="border-top-width:0.8px;border-bottom-width:0.8px;border-left-width:0.8px;text-align:center;font-weight:bold;"></td>
        <td width="18%"style="border-top-width:0.8px;border-bottom-width:0.8px;text-align:center;font-weight:bold;"></td>
        <td width="39%"style="border-top-width:0.8px;border-bottom-width:0.8px;text-align:center;font-weight:bold;">{{$historial->banco}} <br>REPORTE DIARIO DE FLUJO<br></td>
        <td width="1%" style="border-top-width:0.8px;border-bottom-width:0.8px;text-align:center;font-weight:bold;"></td>
        <td width="1%" style="border-top-width:0.8px;border-bottom-width:0.8px;text-align:center;font-weight:bold;"></td>
        <td width="31%"style="border-top-width:0.8px;border-bottom-width:0.8px;border-right-width:0.8px;font-size:9px;text-align:center">
            <img style="border-top-width: 0.8px " src="images/constructura2.jpg" width="100" height="60px">
            <br>
            <?php
            $mes1 = "";
                switch (date("m", strtotime($historial->created_at))) {
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

                $dia = "";
                switch (date("l", strtotime($historial->created_at))) {
                    case 'Monday':
                        $dia = "LUNES";
                        break;
                    case 'Tuesday':
                        $dia = "MARTES";
                        break;
                    case 'Wednesday':
                        $dia = "MIERCOLES";
                        break;
                    case 'Thursday':
                        $dia = "JUEVES";
                        break;
                    case 'Friday':
                        $dia = "VIERNES";
                        break;
                    case 'Saturday':
                        $dia = "SABADO";
                        break;
                    case 'Sunday':
                        $dia = "DOMINGO";
                        break;
                }
                ?>
                
                <b>{{$dia}} {{date("j",strtotime($historial->created_at))}} {{$mes1}} {{date("Y",strtotime($historial->created_at))}}</b>
        </td>
    </tr>
    <br>
    <tr>
        <td width="18%"></td>
        <td width="18%"></td>
        <td width="16%"></td>
        <td width="24%"></td>
        <td width="14%" style="font-size:10px"><b>SALDO INICIAL</b></td>
        <td width="10%" style="font-size:10px;text-align:center"><b>${{$historial->costo_operacion}}</b></td>
    </tr>
</table>
<table >
    <tr style=" line-height:20px;text-align:center;font-size:8px;background-color:#FFE699;font-weight:bold">
        <td border=".5" width="20%">TIPO DE PAGO</td>
        <td border=".5" width="20%">MOTIVO</td>
        <td border=".5" width="25%">BENEFICIARIO</td>
        <td border=".5" width="13%" >INGRESO</td>
        <td border=".5" width="10%" >EGRESO</td>
        <td border=".5" width="12%">SALDO</td>
    </tr>
@php
    $temp = $historial->costo_operacion
@endphp
    @foreach($cuentas as $cuenta)
        <tr style="text-align:center;font-size:10px;">
            <td border=".5">{{$cuenta->forma}}</td>
            <td border=".5">{{$cuenta->pago}}</td>
            <td border=".5">{{$cuenta->beneficiario}}</td>
            <td border=".5">
                @if(!(str_contains($cuenta->saldo,'-')))
                    ${{number_format($cuenta->saldo,2)}}
                @endif
            </td>
            <td border=".5">
                @if(str_contains($cuenta->saldo,'-'))
                    ${{number_format($cuenta->saldo,2)}}
                @endif
            </td>
            <td border=".5">
                ${{number_format($temp = $temp+$cuenta->saldo,2)}}
            </td>
        </tr>        
    @endforeach
    <tr style="text-align:center;font-size:10px;">
        <td border=".5" width="20%"></td>
        <td border=".5" width="20%"></td>
        <td border=".5" width="25%"></td>
        <td border=".5" width="13%" ><b>${{number_format($ingresos_egresos["ingresos"],2)}}</b></td>
        <td border=".5" width="10%" ><b>${{number_format($ingresos_egresos["egresos"],2)}}</b></td>
        <td border=".5" width="12%"></td>
    </tr>
    <tr style="text-align:center;font-size:10px;">
        <td border=".5" width="20%"></td>
        <td border=".5" width="20%"></td>
        <td border=".5" width="25%"></td>
        <td border=".5" width="13%" ></td>
        <td border=".5" width="10%"><b>TOTAL</b></td>
        <td border=".5" width="12%"><b>${{number_format($historial->total,2)}}</b></td>
    </tr>
</table>