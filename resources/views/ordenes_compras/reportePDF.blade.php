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
        <td >
            <table>
                <tr style="text-align:center">
                    <td width="60%"><b>Proveedor:</b> {{$proveedor->razon_social}}</td>
                    <td></td>
                    <td></td>
                    <td></td>
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
                <tr style="text-align:center;background-color:#f16532">
                    <td width="11%" border=".5">FOLIO ORDEN</td>
                    <td width="11%" border=".5">CONTRATO</td>
                    <td width="11%" border=".5">FECHA ORDEN</td>
                    <td width="23%" border=".5">DESCRIPCION</td>
                    <td width="11%" border=".5">FECHA ENTREGA</td>
                    <td width="23%" border=".5">OBSERVACIONES</td>
                    <td width="10%" border=".5">ESTATUS</td>
                </tr>
                    @foreach($ordenes as $orden)
                        <tr style="text-align:center;">
                            <td border=".5">{{$orden->folio_orden}}</td>
                            <td border=".5">{{$orden->folio}}</td>
                            <td border=".5">{{$orden->fecha_orden}}</td>
                            <td border=".5">{{$orden->descripcion_orden}}</td>
                            <td border=".5">{{$orden->fecha_entrega}}</td>
                            <td border=".5">{{$orden->observaciones}}</td>
                            <td border=".5">{{$orden->status}}</td>
                        </tr>
                    @endforeach
            </table>
        </td>
    </tr>
</table>