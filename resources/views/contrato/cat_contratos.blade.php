@extends('layouts.base_html')
@section('tittle') CONTRATOS <@endsection
@section("styles")
<link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<style>
table{
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
<table class="table" id="contrato_table" width="100%">
    <thead>
        <th >RFC</th>
        <th width="30%" >Razon Social</th>
        <th width="8%">Folio</th>
        <th width="60%">Descripcion</th>
        <th >Monto</th>
        <th >Inicio</th>
        <th >Final</th>
        <th width="5%" ></th>
    </thead>
    <tbody>
    @foreach($contratos as $contrato)
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
                  <li><a class="dropdown-item" href="#">Editar</a></li>
                  <li><a class="dropdown-item" href="{{url("/contratos/{$contrato->id}")}}">Detalles</a></li>
                  <li><a class="dropdown-item" href="#">Eliminar</a></li>
                </ul>
              </div>
           </td>
    @endforeach
    </tbody>
</table>
@endsection

@section("scripts")
<script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script>

    let table = $("#contrato_table").dataTable();

</script>
@endsection