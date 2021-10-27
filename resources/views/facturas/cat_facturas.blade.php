@extends('layouts.base_html')

@section('styles')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="{{ asset('lib/DataTables/Responsive-2.2.9/css/responsive.dataTables.min.css') }}"> 

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
<div class="row">
    <div class="col-md-12">
        <h1 class="animate-box fadeInLeft animated mt-5" data-animate-effect="fadeInLeft">
            OPERAR PRE-FACTURAS
        </h1>
    </div>
</div>
    <h4 style="color:gray;font-size:20px;">-Listado de Pre-Facturas</h4>
    <hr style="color: orange;">
    <table  id="facturas_table" width="100%" style="width: 100%;border: 1px solid black;">
        <thead style="background-color:#ff9c00;color:white;text-align:center">
            <th width="30%">Razon Social</th>
            <th width="8%">Contrato</th>
            <th>Inicio</th>
            <th>Final</th>
            <th>Total</th>
            <th >Estatus</th>
            <th width="5%">Facturar</th>
            <th width="15%">Archivos</th>
        </thead>
        <tbody style="text-align:center">
            @foreach($pre_facturas as $prefactura)
            <tr>
                <td class="align-middle">{{$prefactura->contrato->cliente->razon_social}}</td>
                <td class="align-middle">{{$prefactura->contrato->folio}}</td>
                <td class="align-middle">{{date('d/m/Y', strtotime($prefactura->fecha_inicio))}}</td>
                <td class="align-middle">{{date('d/m/Y', strtotime($prefactura->fecha_final))}}</td>
                <td class="align-middle">{{number_format($prefactura->neto,2)}}</td>
                <td class="align-middle">{{$prefactura->status}}</td>
                <td>
                    <div class="dropdown" >
                        <button style="background-color:#f16532;text-align:center;border-color:orange" class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            Opciones
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="{{url("facturas/editar/{$prefactura->id}")}}">Editar Prefactura</a></li>
                            @if($prefactura->id_status==1)
                            <li><a class="dropdown-item" href="{{url("facturas/{$prefactura->id}/edit")}}">Facturar</a></li>
                            @endif                            
                            @if($prefactura->id_status==2)
                            <li><a class="dropdown-item" href="{{url("facturas/pagar/{$prefactura->id}")}}">Pagar Factura</a></li>                                
                            @endif  
                            <li><a class="dropdown-item" href="" onclick='borrarFactura({{$prefactura->id}})'>Eliminar</a></li>
                        </ul>
                    </div>
                </td>
                <td>   
                    <div class="dropdown" >
                        <button style="background-color:black;text-align:center;border-color:black" class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            Seleccione
                        </button>
                        <?php
                        $fecha = str_replace("/","_",$prefactura->folio_prefactura);
                        ?>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            @if($prefactura->id_status==1)
                            <li><a target="_blank" class="dropdown-item" href="{{url("prefacturas_pdf/{$prefactura->id}")}}">Pre-Factura</a></li>
                            @endif
                            @if($prefactura->id_status==2)
                            <li><a target="_blank" class="dropdown-item" href="{{url("prefacturas_pdf/{$prefactura->id}")}}">Factura</a></li>
                                @if($prefactura->pdf_oficial!=null)
                                <li><a target="_blank" class="dropdown-item" href={{url("/storage/docs/facturas_oficiales/{$fecha}/{$prefactura->pdf_oficial}")}}>Factura Oficial</a></li>
                                @endif
                                @if($prefactura->xml_oficial!=null)
                                    <li><a class="dropdown-item" target="_blank" href="{{url("/storage/docs/facturas_oficiales/{$fecha}/{$prefactura->xml_oficial}")}}">XML Oficial</a></li> 
                                @endif
                            @endif
                            @if($prefactura->id_status==3)
                                <li><a target="_blank" class="dropdown-item" href="{{url("prefacturas_pdf/{$prefactura->id}")}}">Factura</a></li>
                                @if($prefactura->pdf_oficial!=null)
                                <li><a class="dropdown-item" target="_blank" href={{url("/storage/docs/facturas_oficiales/{$fecha}/{$prefactura->pdf_oficial}")}}>Factura Oficial</a></li>
                                @endif
                                @if($prefactura->xml_oficial!=null)
                                    <li><a class="dropdown-item" target="_blank" href="{{url("/storage/docs/facturas_oficiales/{$fecha}/{$prefactura->xml_oficial}")}}">XML Oficial</a></li>
                                @endif
                                <li><a class="dropdown-item" target="_blank" href="{{url("facturas/detalles_pago/{$prefactura->id}")}}">Detalles del pago</a></li>
                            @endif
                        </ul>
                    </div>
                </td>
            </tr>
            @endforeach
            <div class="row d-flex justify-content-center align-middle align-items-center mb-3" >
                <div class="col-md-4">
                </div>
                <div class="col-md-3" style="text-align:end;padding-right: 0px;">
                    {{-- <label>Total</label> --}}
                </div>
                <div class="col-md-3" style="text-align:end;">
                     {{-- <input id="total-factura" type="text" name="total-factura" class="form-control" value="0" style="margin-left:10px"> --}}
                </div> 
            </div>

        </tbody>
    </table>
    @endsection

    @section("scripts")
    <script>
        let table = $("#facturas_table").dataTable({
            responsive:true
        });

        async function borrarFactura(id){
            event.preventDefault();
            let url='{{url("/facturas/{id}")}}'.replace('{id}',id);
            let init={
                method:"DELETE",
                headers: {  'X-CSRF-TOKEN': "{{csrf_token()}}"
                }
            }
            let req=await fetch(url,init);
            if (req.ok){
                location.reload();
            }
            else{
                let res = await req.json();
                Swal.fire({
                    icon:"error",
                    title:"Error",
                    text:res
                });
            }

        }
    </script>
    @endsection
