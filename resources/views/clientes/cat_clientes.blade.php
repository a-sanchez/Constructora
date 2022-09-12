@extends('layouts.base_html')
@section('tittle') CLIENTES @endsection
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
    table.dataTable.no-footer {
    border-bottom: 1px solid #fff;
    }
    table.dataTable thead th {
    border-bottom: 1px solid white;
    }
    td{
        background-color:#FFF2CC;
        }

    tbody, td,th, tr {
    border-color: white;
    border-style: solid;
    border-width: 1px;
    border-bottom:white;
    }
        

    </style>

@endsection

@section('body')

<div class="row">
    <div class="col-md-12">
        <h1 class="animate-box fadeInLeft animated mt-5" data-animate-effect="fadeInLeft">
            CLIENTES
            <div class="col-md-8 col-md-offset-2">
            <a type="button" class="btn" id="btnAgregar" href={{url('/clientes/create')}} style="background:#8d8d8d;color:white;">Nuevo Cliente</a>
            </div>
        </h1>
         <hr style="color: orange;">
    </div>
</div>
<table id="cliente_table" width="100%">
    <thead style="background-color:#ff9c00;text-align:center;color:white">
        <th>RFC</th>
        <th>CLIENTE</th>
        <th>ALIAS</th>
        <th width="15%">OPCIONES</th>
    </thead>
    <tbody>
        @foreach($clientes as $cliente)
        <tr style="text-align:center">
            <td class="align-middle">{{$cliente->cliente}}</td>
            <td class="align-middle">{{$cliente->razon_social}}</td>
            <td class="align-middle">{{$cliente->alias}}</td>
            <td class="align-middle">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-" type="button" id="dropdownMenuButton1" data-bs-="dropdown" 
                    aria-expanded="false" style="background-color: black;
                    border-color: black;">
                    Seleccione
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="{{url("/clientes/{$cliente->id}")}}">Detalles</a></li>
                        <li><a class="dropdown-item" href="{{url("/clientes/{$cliente->id}/edit")}}">Editar</a></li>
                        <li><a  class="dropdown-item" href="" onclick='eliminar({{$cliente->id}})'>Eliminar</a></li>
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

    let table = $("#cliente_table").dataTable({
            responsive:true
    });
         async function eliminar(id) {
        event.preventDefault();
          let url='{{url("/clientes/{id}")}}'.replace('{id}',id);
            let init = {
                method: "DELETE",
                headers: {  'X-CSRF-TOKEN': "{{csrf_token()}}",
                 'Content-Type':'application/json'
                }
            }

            let req=await fetch(url,init);
            if (req.ok){
                location.reload();
            }
            else
            {
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
