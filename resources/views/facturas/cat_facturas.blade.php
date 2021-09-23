@extends('layouts.base_html')

@section('title')
    OPERAR PRE-FACTURAS
@endsection

@section('styles')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<style>
    table {
        text-transform: uppercase;
    }
    
    .dataTables_filter{
        margin-bottom:0.5rem;
    }
    .colorlib-contact{
        padding-top:1rem;
    }

</style>

@endsection

@section('body')
    <h4 style="color:gray;font-size:20px;">-Listado de Pre-Facturas</h4>
    <hr style="color: orange;">
    <table  id="facturas_table" width="100%" style="width: 100%;border: 1px solid black;">
        <thead style="background-color:#ff9c00;color:white;text-align:center">
            <th width="30%">Razon Social</th>
            <th>Inicio</th>
            <th>Final</th>
            <th >Estatus</th>
            <th width="15%">Archivos</th>
            <th width="5%">Facturar</th>
        </thead>
        <tbody style="text-align:center">
            @foreach($pre_facturas as $prefactura)
            <tr>
                <td class="align-middle">{{$prefactura->contrato->cliente->razon_social}}</td>
                <td class="align-middle">{{date('d/m/Y', strtotime($prefactura->fecha_inicio))}}</td>
                <td class="align-middle">{{date('d/m/Y', strtotime($prefactura->fecha_final))}}</td>
                <td class="align-middle">{{$prefactura->status}}</td>
                <td>   
                    <div class="dropdown" >
                        <button style="background-color:black;text-align:center;border-color:black" class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            Seleccione
                        </button>
                        <?php
                        $fecha = str_replace("/","_",$prefactura->folio_prefactura);
                        ?>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="{{url("prefacturas_pdf/{$prefactura->id}")}}">Pre-Factura</a></li>
                            @if($prefactura->id_status==2)
                                <li><a class="dropdown-item" href={{url("/storage/docs/facturas_oficiales/{$fecha}/{$prefactura->pdf_oficial}")}}>Factura Oficial</a></li>
                                <li><a class="dropdown-item" href="{{url("/storage/docs/facturas_oficiales/{$fecha}/{$prefactura->xml_oficial}")}}">XML Oficial</a></li>
                            @endif
                            @if($prefactura->id_status==3)
                                <li><a class="dropdown-item" href={{url("/storage/docs/facturas_oficiales/{$fecha}/{$prefactura->pdf_oficial}")}}>Factura Oficial</a></li>
                                <li><a class="dropdown-item" href="{{url("/storage/docs/facturas_oficiales/{$fecha}/{$prefactura->xml_oficial}")}}">XML Oficial</a></li>
                                <li><a class="dropdown-item" href="#">Detalles del pago</a></li>
                            @endif
                        </ul>
                    </div>
                </td>
                <td>
                    <div class="dropdown" >
                        <button style="background-color:#f16532;text-align:center;border-color:orange" class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            Opciones
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            @if($prefactura->id_status==1)
                            <li><a class="dropdown-item" href="{{url("facturas/{$prefactura->id}/edit")}}">Facturar</a></li>
                            @endif                            
                            @if($prefactura->id_status==2)
                            <li><a class="dropdown-item" href="{{url('facturas/pagar')}}">Pagar Factura</a></li>                                
                            @endif  
                            <li><a class="dropdown-item" href="#">Eliminar</a></li>
                        </ul>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endsection

    @section("scripts")
    <script>
        let table = $("#facturas_table").dataTable();

    </script>
    @endsection
