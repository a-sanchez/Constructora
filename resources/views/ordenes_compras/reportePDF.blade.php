
<table>
    <tr>
        <th style="text-align:center;">
            <h4>CALLE CORREO MARITIMO No. 3054 COL. POSTAL CERRITOS  TEL. 432-52-14 FAX 432-0663    SALTILLO, COAHUILA   C.P 25019</h4>
        </th>
    </tr>
    <tr style="text-align:right">
        <td ><b>FECHA:</b> @php
            $fecha = date('d-m-Y');
            $mes1 = "";
                switch (date("m",  strtotime($fecha))) {
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
               @endphp
               {{date("j",strtotime($fecha))}} DE {{$mes1}} DE {{date("Y",strtotime($fecha))}}
            </td>
    </tr>
    <tr>
        <td></td>
    </tr>
    <tr>
        <td >
            <table>
                <tr>
                    <td width="9%"></td>
                    <td width="30%" style="text-align:center;"><b>CONTRATO:
                        <?php
                        $contrato = $ordenes[0]->folio;
                        ?>
                        {{$contrato}}
                    </b>
                    </td>
                    <td width="60%"><b>OBRA:</b>
                        <?php
                        $obra = $ordenes[0]->descripcion;
                        ?>
                        {{$obra}}
                    </td>
                    <td width="1%"></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td></td>
    </tr>
    <tr>
        <td>
            <table>
                <tr style="text-align:center;vertical-align:middle;background-color:#fab84e;font-weight:bold;">
                    <td width="17%" height="20" border=".5">NO.REQUISICIÓN</td>
                    <td width="12%" border=".5">FECHA</td>
                    <td width="25%" border=".5">PROVEEDOR</td>
                    <td width="15%" border=".5">SUBTOTAL</td>
                    <td width="11%" border=".5">IVA</td>
                    <td width="20%" border=".5">TOTAL</td>
                </tr>
                    @foreach($ordenes as $orden)
                        <tr style="text-align:center;">
                            <td border=".5">{{$orden->folio_orden}}</td>
                            <td border=".5">{{date("d/m/y",strtotime($orden->fecha_orden))}}</td>
                            <td border=".5">{{$orden->razon_social}}</td>
                            <td border=".5">{{number_format($orden->importe,2)}}</td>
                            <td border=".5">{{number_format($orden->IVA,2)}}</td>
                            <td border=".5">{{number_format($orden->total,2)}}</td>
                        </tr>
                    @endforeach
            </table>
        </td>
    </tr>
</table>