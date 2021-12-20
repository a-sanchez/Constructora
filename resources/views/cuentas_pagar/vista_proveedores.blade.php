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
<div class="row mt-4">
    <div class="col-md-12">
        <h1 class="animate-box fadeInLeft animated mt-2" data-animate-effect="fadeInLeft">
            HISTORIAL DE CUENTAS POR PAGAR (POR PROVEEDORES)
        </h1>
        <hr style="color: orange;">
    </div>
</div>
<table id="proveedor_table" width="100%">
    <thead style="background-color:#ff9c00;text-align:center;color:white">
        <th>RAZON SOCIAL</th>
        <th>OPCIONES</th>
    </thead>
    <tbody>
        @foreach($proveedores as $proveedor)
            <tr style="text-align:center">
                <td class="align-middle">{{$proveedor->razon_social}}</td>
                <td>                            
                    <div class="">
                        <div class="col-md-12">
                            <button  type="button" id = "myBtn" style="color: #000000;" class="btn"  onclick ="modal({{$proveedor->id}})"><i style="font-size:1.5rem;" id="box-tissue"  class="fas fa-box-tissue"></i></button> 
                            <form id="form-cuentas">
                                <div id="myModal-{{$proveedor->id}}" class="modal fade mt-5" tabindex="-50">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">BUSCAR AÑO</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <label for="gasto">Ingrese año que desea visualizar</label>
                                                <div class="row">
                                                    <div class="col-md-4"></div>
                                                    <div class="col-md-4">
                                                        <input type="text" style="text-align:center"  class="form-control" required  id="ciclo-{{$proveedor->id}}">
                                                    </div>
                                                    <div class="col-md-4"></div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-success" onclick = "buscar('{{$proveedor->id}}');">Buscar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection

@section('scripts')
<script>
let table = $("#proveedor_table").DataTable({
    responsive:true
});
    function modal(id){
        var myModal = new bootstrap.Modal(document.getElementById(`myModal-${id}`));
            myModal.show();
    }

async function buscar(id){
    event.preventDefault();
    let ciclo = document.getElementById(`ciclo-${id}`).value;
    let form = new FormData();
    form.append("id",id);
    form.append("ciclo",ciclo);
    let url = "{{url('proveedor/{id}/ciclo/{ciclo}/historial')}}";
    let url1= url.replace("{id}",id);
    let url2 = url1.replace("{ciclo}",ciclo);
    let init = {
        method:"GET"
    }
    let req = await fetch(url2,init);
    if (req.ok){
        window.location.href= url2;
    }
    else{
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'NO CONTIENE DATOS EN EL AÑO ESPECIFICADO',
        });
    }


}
</script>
@endsection