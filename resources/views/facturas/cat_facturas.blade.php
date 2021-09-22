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
            <th width="15%">PRE-FACTURA</th>
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
                    <a  type="button" style="color: red;" href="#" class="btn"><i style="font-size:2rem" id="file-pdf"  class="fas fa-file-pdf"></i></a>

                </td>
                <td>
                    <div class="dropdown" >
                        <button style="background-color:#f16532;text-align:center;border-color:orange" class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            Opciones
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="{{url('facturas/create')}}">Facturar</a></li>
                            <li><a class="dropdown-item" href="{{url('facturas/pagar')}}">Pagar Factura</a></li>
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
