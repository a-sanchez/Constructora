@extends('layouts.base_html')
@section('tittle') CONTRATOS <@endsection @section("styles") <link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <style>
        table {
            text-transform: uppercase;
        }

    </style>

    @endsection
    @section('body')
    <div class="row">
        <div class="col-md-12">
            <h1 class="animate-box fadeInLeft animated" data-animate-effect="fadeInLeft">
                CONTRATOS
            </h1>
            <hr style="color: orange;">
        </div>
    </div>
    <a type="button" class="btn" id="btnAgregar" href={{url('/contratos/create')}} style="background:#8d8d8d;color:white;">Nuevo Contrato</a>
    <table style="padding-top: 10px;" id="contrato_table" width="100%">
        <thead style="background-color:#b4b4b4">
            <th>RFC</th>
            <th width="30%">Razon Social</th>
            <th width="8%">Folio</th>
            <th width="60%">Descripcion</th>
            <th>Monto</th>
            <th>Inicio</th>
            <th>Final</th>
            <th width="5%"></th>
        </thead>
        <tbody>
            @foreach($contratos as $contrato)
            <tr>
                <td class="align-middle">{{$contrato->cliente->cliente}}</td>
                <td class="align-middle">{{$contrato->cliente->razon_social}}</td>
                <td class="align-middle">{{$contrato->folio}}</td>
                <td class="align-middle">{{$contrato->descripcion}}</td>
                <td class="align-middle">{{$contrato->monto}}</td>
                <td class="align-middle">{{date('d/m/Y', strtotime($contrato->fecha_inicio))}}</td>
                <td class="align-middle">{{date('d/m/Y', strtotime($contrato->fecha_final))}}</td>
                <td class="align-middle">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">

                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

                            <li><a class="dropdown-item" href="{{url("compras/{$contrato->id}")}}">Orden de Compra</a></li>
                            <li><a class="dropdown-item" href="#">Pre-Factura</a></li>
                            <li><a class="dropdown-item" href="{{url("/contratos/{$contrato->id}/edit")}}">Editar</a></li>
                            <li><a class="dropdown-item" href="{{url("/contratos/{$contrato->id}")}}">Detalles</a></li>
                            <li><a  class="dropdown-item" href="" onclick='borrarContrato({{$contrato->id}})'>Eliminar</a></li>
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
        let table = $("#contrato_table").dataTable();

         async function borrarContrato(id) {
            event.preventDefault();
          let url='{{url("/contratos/{id}")}}'.replace('{id}',id);
            let init = {
                method: "DELETE",
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

//imrpotar js y css de tables responsive 

            
       

    </script>
    @endsection
