@extends('layouts.base_html')
@section('tittle') PROVEEDORES @endsection

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
        <h1 class="animate-box fadeInLeft animated" data-animate-effect="fadeInLeft">
            PROVEEDORES
            <div class="col-md-8 col-md-offset-2">
            <a type="button" class="btn" id="btnAgregar" href={{url('/proveedores/create')}} style="background:#8d8d8d;color:white;">Nuevo Proveedor</a>
            </div>
        </h1>
        <hr style="color: orange;">
    </div>
</div>
<table id="proveedor_table" width="100%">
    <thead style="background-color:#ff9c00;text-align:center;color:white">
        <th>RAZON SOCIAL</th>
        <th>ALIAS</th>
        <th>LOCALIDAD</th>
        <th>RFC</th>
        <th>OPCIONES</th>
    </thead>
    <tbody>
        @foreach($proveedores as $proveedor)
            <tr style="text-align:center">
                <td class="align-middle">{{$proveedor->razon_social}}</td>
                <td class="align-middle">{{$proveedor->alias}}</td>
                <td class="align-middle">{{$proveedor->localidad}}</td>
                <td class="align-middle">{{$proveedor->rfc}}</td>
                <td class="align-middle">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" 
                        aria-expanded="false" style="background-color: black;
                        border-color: black;">
                        Seleccione
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="{{url("/proveedores/{$proveedor->id}")}}">Detalles</a></li>
                            <li><a class="dropdown-item" href="{{url("/proveedores/{$proveedor->id}/edit")}}">Editar</a></li>
                            <li><a  class="dropdown-item" href="" onclick='eliminar({{$proveedor->id}})'>Eliminar</a></li>
                        </ul>
                    </div>
                </td>
                </tr>
        @endforeach
    </tbody>
</table>
@endsection

@section('scripts')
<script>
    let table = $("#proveedor_table").dataTable({
        responsive:true
    });
    async function eliminar(id) {
   event.preventDefault();
     let url='{{url("/proveedores/{id}")}}'.replace('{id}',id);
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