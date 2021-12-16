<table border="0.5">
    <tr style="text-align:center">
        <th width="29%">PROVEEDOR</th>
        <th width="25%">MONTO</th>
        <th width="25%">PROGRAMADO A PAGAR</th>
        <th width="25%">TOTAL</th>
    </tr>
    @foreach ($cuentas as $cuenta)
        <tr style="text-align:center">
            <td>{{$cuenta->razon_social}}</td>
            <td>{{$cuenta->monto}}</td>
            <td></td>
            <td></td>
        </tr>
    @endforeach
        <tr style="text-align:center">
            <tfoot>
                <td>TOTAL</td>
                <td></td>
                <td></td>
                <td></td>
            </tfoot>
        </tr>
</table>