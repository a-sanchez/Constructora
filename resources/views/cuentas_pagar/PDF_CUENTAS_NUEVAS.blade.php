<table border="0.5">
    <tr style="text-align:center">
        <th width="29%">PROVEEDOR</th>
        <th width="25%">MONTO</th>
        <th width="25%">PROGRAMADO A PAGAR</th>
        <th width="25%" style="font-weight:bold">TOTAL</th>
    </tr>
    @foreach ($cuentas as $cuenta)
        <tr style="text-align:center">
            <td>{{$cuenta->proveedor}}</td>
            <td>{{$cuenta->monto}}</td>
            <td>{{$cuenta->programado}}</td>
            <td style="font-weight:bold">{{$cuenta->total_total}}</td>
        </tr>
    @endforeach
        <tr style="text-align:center">
            <tfoot >
                <td style="font-weight:bold">TOTAL</td>
                <td style="font-weight:bold">{{$suma_monto}}</td>
                <td style="font-weight:bold">{{$suma_programado}}</td>
                <td style="font-weight:bold">{{$suma_total}}</td>
            </tfoot>
        </tr>
</table>