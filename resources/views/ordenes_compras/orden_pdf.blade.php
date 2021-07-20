@php
    $subtotal = 0;
@endphp
<table>
    <tr>
        <th style="text-align:center;">
            <h4>CALLE CORREO MARITIMO No. 3054 COL. POSTAL CERRITOS  TEL. 432-52-14 FAX 432-0663    SALTILLO, COAHUILA   C.P 25019</h4>
        </th>
    </tr>
    <tr>
        <td  border=".5" style="text-align:center;">DATOS GENERALES</td>
    </tr>
    <tr>
        <td border=".5" style="background-color:#F79646;">
            <table>
                <tr>
                    <td width="15%">OBRA:</td>
                    <td width="35%">{{$orden->contrato->descripcion}}</td>
                    <td width="15%">SOLICITO:</td>
                    <td width="35%">{{$orden->solicitado}}</td>
                </tr>
                <tr >
                    <td width="15%">UBICACION:</td>
                    <td width="35%">{{Str::upper($orden->contrato->calle_contraparte)}} #{{$orden->contrato->numero_contraparte}}, {{Str::upper($orden->contrato->colonia_contraparte)}} C.P. {{$orden->contrato->cp_contraparte}} {{Str::upper($orden->contrato->localidad)}}</td>
                    <td width="15%">NO. REQUISICION:</td>
                    <td width="35%">{{$orden->folio_orden}}</td>
                </tr>
                {{-- <tr>
                    <td>ESPECIALIDAD:</td>
                    <td>[ESPECIALIDAD]</td>
                </tr> --}}
                <tr style="font-size: 11px;">
                    <td style="text-align:center; font" colspan="2">
                        <i style="text-decoration: underline; ">{{$orden->proveedor->razon_social}}</i>
                    </td>
                </tr>
                <tr>
                    <td width="20%">FECHA DE ELABORACION:</td>
                    <td width="30%">{{date("d/m/Y", strtotime($orden->fecha_orden))}}</td>
                    <td width="20%">FECHA ENTREGA SOLICITADA:</td>
                    <td width="30%">{{date("d/m/Y", strtotime($orden->fecha_entrega))}}</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td><table style="text-align:center; " >
                <tr style="background-color:#969696; color:white;">
                    <td border=".5"width="50%">CONCEPTO</td>
                    <td border=".5" width="12.5%">UNIDAD</td>
                    <td border=".5" width="12.5%">CANTIDAD</td>
                    <td border=".5" width="12.5%">PRECIO UNITARIO</td>
                    <td border=".5" width="12.5%">IMPORTE</td>
                </tr>
                @foreach($productos as $producto)
                    <tr style="line-height: 20px;">
                        <td border=".5">{{$producto->concepto}}</td>
                        <td border=".5">{{$producto->unidad}}</td>
                        <td border=".5">{{$producto->cantidad}}</td>
                        <td border=".5">$ {{$producto->precio_unitario}}</td>
                        <td border=".5">$ {{$producto->importe}}</td>
                    </tr>
                    @php
                        $subtotal += $producto->importe;
                    @endphp
                @endforeach
                @php
                    $iva = ($orden->iva/100)*$subtotal;
                @endphp
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td border=".5">SUB-TOTAL</td>
                    <td border=".5">$ {{$subtotal}}</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td border=".5">IVA</td>
                    <td border=".5">$ {{$iva}}</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td border=".5">TOTAL</td>
                    <td border=".5">$ {{$subtotal + $iva}}</td>
                </tr>
            </table>
        </td>
    </tr>
</table> 