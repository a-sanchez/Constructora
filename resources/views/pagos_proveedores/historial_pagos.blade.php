@extends('layouts.base_html')
@section('tittle') PAGOS A PROVEEDORES
@endsection
@section("styles") 
<link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="{{ asset('lib/DataTables/Responsive-2.2.9/css/responsive.dataTables.min.css') }}">    <style>
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
            PAGOS A PROVEEDORES
        </h1>
        <hr style="color: orange;">
    </div>
</div>
<table style="width: 100%;border: 1px solid black;" id="pagos_table" class ="display" width="100%">
    <thead style="background-color:#ff9c00;color:white;text-align:center">
        <th >Folio factura</th>
        <th>Contrato</th>
        <th >Proveedor</th>
        <th>Folio Orden</th>
        <th>Fecha emisión</th>
        <th>Fecha vencimiento</th>
        <th >SubTotal</th>
        <th >Impuestos</th>
        <th >Total</th>
        <th>Saldo Pendiente</th>
        <th>Estatus de la orden</th>
        <th>Estatus del pago</th>
        <th >Observaciones y comentarios orden</th>
        <th >Observaciones y comentarios del pago</th>
        <th></th>
    </thead>
    <tbody style="text-align:center">
        @foreach($operadas as $operar)
        <tr style="text-align:center">
            <td>{{$operar->folio_factura}}</td>
            <td>{{$operar->folio}}</td>
            <td> {{$operar->razon_social}} </td>
            <td>{{$operar->folio_orden}}</td>
            <td>{{date("d-m-Y",strtotime($operar->fecha_emision))}}</td>
            <td>{{date("d-m-Y",strtotime($operar->fecha_vencimiento))}}</td>
            <td>{{number_format($operar->sub_total,2)}}</td>
            <td>{{number_format($operar->impuestos,2)}}</td>
            <td>{{number_format($operar->total,2)}}</td>
            <td>${{number_format($operar->saldo_pendiente,2)}}</td>
            <td>@if($operar->estatus_pago=="PENDIENTE" && $operar->id_status==3)
                {{$operar->status}}-PENDIENTE
                @else
                {{$operar->status}} 
                @endif
            </td>
            <td>@if($operar->estatus_pago==null)
                Aún no se ha seleccionado
                @else
                {{$operar->estatus_pago}}
                @endif
            </td>
            <td>{{$operar->comentarios}}</td>
            <td>{{$operar->comentarios_pagos}}</td>
            <td style="text-align:center">
                @if($operar->estatus_pago=="PAGADO" && $operar->id_status==2)
                <a  type="button" style="color: green; " class="btn" onclick="update_pago_orden({{$operar->id_orden}},{{$operar->id}});" href=""><i style="font-size:1.5rem;" id="dollar-sign"  class="fas fa-dollar-sign"></i></a> 
                <a  style="color: red;" href="" class="btn" ><i style="font-size:1.5rem" id="trash-alt" onclick='update_pago({{$operar->id}}),back_status({{$operar->id_orden}});'  class="fas fa-trash-alt"></i></a>
                @elseif($operar->estatus_pago=="PENDIENTE")
                <a  type="button" style="color: green; " class="btn" onclick="update_pago_pendiente({{$operar->id_orden}},{{$operar->id}});" href=""><i style="font-size:1.5rem;" id="dollar-sign"  class="fas fa-dollar-sign"></i></a> 
                <a  style="color: red;" href="" class="btn" ><i style="font-size:1.5rem" id="trash-alt" onclick='update_pago({{$operar->id}}),back_status({{$operar->id_orden}});'  class="fas fa-trash-alt"></i></a>
                @elseif($operar->estatus_pago==null)
                <a  type="button" style="color: green; " class="btn" onclick="update_pago_orden({{$operar->id_orden}},{{$operar->id}});" href=""><i style="font-size:1.5rem;" id="dollar-sign"  class="fas fa-dollar-sign"></i></a> 
                <a  style="color: red;" href="" class="btn" ><i style="font-size:1.5rem" id="trash-alt" onclick='borrar_pago({{$operar->id}}),back_status({{$operar->id_orden}});'  class="fas fa-trash-alt"></i></a>
                @elseif($operar->estatus_pago=="PENDIENTE" && $operar->id_estatus==3)
                <a  type="button" style="color: green; " class="btn" onclick="update_pago_pendiente({{$operar->id_orden}},{{$operar->id}});" href=""><i style="font-size:1.5rem;" id="dollar-sign"  class="fas fa-dollar-sign"></i></a> 
                <a  style="color: red;" href="" class="btn" ><i style="font-size:1.5rem" id="trash-alt" onclick='update_pago({{$operar->id}}),back_status({{$operar->id_orden}});'  class="fas fa-trash-alt"></i></a>
                @elseif($operar->id_status==3 && $operar->estatus_pago=="PAGADO")
                <a  style="color: blue;" href="{{url("pagos_proveedores/detalles/{$operar->id}")}}" class="btn" ><i style="font-size:1.5rem" id="info-circle"  class="fas fa-info-circle"></i></a>
                <a  style="color: red;" href="" class="btn" ><i style="font-size:1.5rem" id="trash-alt" onclick='update_pago({{$operar->id}}),back_status({{$operar->id_orden}});'  class="fas fa-trash-alt"></i></a>
                {{-- CREADO INICIALMENTE --}}
                {{-- @elseif($operar->estatus_pago==null && $operar->id_status==2)
                <a  type="button" style="color: green; " class="btn" onclick="update_pago_pendiente({{$operar->id_orden}},{{$operar->id}});" href=""><i style="font-size:1.5rem;" id="dollar-sign"  class="fas fa-dollar-sign"></i></a> 
                <a  style="color: red;" href="" class="btn" ><i style="font-size:1.5rem" id="trash-alt" onclick='borrar_pago({{$operar->id}}),back_status({{$operar->id_orden}});'  class="fas fa-trash-alt"></i></a> --}}
                @else
                <a  style="color: blue;" href="{{url("pagos_proveedores/detalles/{$operar->id}")}}" class="btn" ><i style="font-size:1.5rem" id="info-circle"  class="fas fa-info-circle"></i></a>
                <a  style="color: red;" href="" class="btn" ><i style="font-size:1.5rem" id="trash-alt" onclick='update_pago({{$operar->id}})' class="fas fa-trash-alt"></i></a>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="row mt-4">
<table style="width: 100%;border: 1px solid black;margin-top: 2rem;" id="grupales_table" class="display" width="100%">
    <thead style="background-color:#ff9c00;color:white;text-align:center">
        <th >Folio factura</th>
        <th>Contrato</th>
        <th >Proveedor</th>
        <th>Folio Orden</th>
        <th>Fecha emisión</th>
        <th>Fecha vencimiento</th>
        <th >SubTotal</th>
        <th >Impuestos</th>
        <th >Total</th>
        <th>Saldo Pendiente</th>
        <th>Estatus de la orden</th>
        <th>Estatus del pago</th>
        <th >Observaciones y comentarios de la orden</th>
        <th>Observaciones y comentarios del pago</th>
        <th></th>
    </thead>
    <tbody style="text-align:center">
        @foreach($views as $view)
        <tr style="text-align:center">
            <td>{{$view->folio_factura}}</td>
            <td>{{$view->contrato}}</td>
            <td>{{$view->razon_social}}</td>
            <td>{{$view->folio_orden}}</td>
            <td>
                {{date("d-m-Y",strtotime($view->fecha_emision))}}
            </td>
            <td>{{date("d-m-Y",strtotime($view->fecha_vencimiento))}}</td>
            <td>{{number_format($view->sub_total,2)}}</td>
            <td>{{number_format($view->impuestos,2)}}</td>
            <td>{{number_format($view->total,2)}}</td>
            <td>$ {{number_format($view->saldo_pendiente,2)}}</td>
            <td>
                @if($view->estatus_pago=="PENDIENTE" && $view->status="Pagada")
                {{$view->status}}-PENDIENTE
                @else
                {{$view->status}}
                @endif
            </td>
            <td>@if($view->estatus_pago==null)
                Aún no se selecciona
                @endif
                {{$view->estatus_pago}}</td>
            <td>{{$view->comentarios}}</td>
            <td>{{$view->comentarios_pagos}}</td>
            <td style="text-align:center">
                @if($view->status =="Operada")
                <a  type="button" style="color: green; " class="btn" onclick="Update_estatus_grupales('{{$view->folios}}',{{$view->id}});" ><i style="font-size:1.5rem;" id="dollar-sign"  class="fas fa-dollar-sign"></i></a> 
                <a  style="color: red;" href="" class="btn" ><i style="font-size:1.5rem" id="trash-alt"  onclick="borrar_pago2({{$view->id}});back_status2('{{$view->folios}}',{{$view->id}});" class="fas fa-trash-alt"></i></a>
                @endif
                @if($view->status=="Pagada")
                    @if($view->estatus_pago=="PENDIENTE")
                        <a  type="button" style="color: green; " class="btn" onclick="Update_estatus_grupales_pendiente('{{$view->folios}}',{{$view->id}});" ><i style="font-size:1.5rem;" id="dollar-sign"  class="fas fa-dollar-sign"></i></a> 
                        <a  style="color: red;" href="" class="btn" ><i style="font-size:1.5rem" id="trash-alt" onclick='update_pago2({{$view->id}});back_status3("{{$view->folios}}",{{$view->id}});' class="fas fa-trash-alt"></i></a>
                    @endif
                    @if($view->estatus_pago=="PAGADO" )
                        <a  style="color: blue;" href="{{url("pagos_proveedores2/detalles/{$view->id}")}}" class="btn" ><i style="font-size:1.5rem" id="info-circle"  class="fas fa-info-circle"></i></a>
                        <a  style="color: red;" href="" class="btn" ><i style="font-size:1.5rem" id="trash-alt" onclick='update_pago2({{$view->id}});back_status3("{{$view->folios}}",{{$view->id}});' class="fas fa-trash-alt"></i></a>
                    @endif

                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
@endsection
@section('scripts')
<script>
$(document).ready(function(){
    $('table.display').DataTable({
        responsive:true
    });
});

async function update_pago_pendiente(id,id2){
    event.preventDefault();
    let url="{{url('/compras/actualizar/{id}')}}".replace("{id}",id);
    // console.log(url);
    let init={
        method:"POST",
        headers:{
            'X-CSRF-Token' : "{{ csrf_token() }}",
            'Content-Type':'application/json'
        },
        body:JSON.stringify({'id_status':3})        
    };
    let req = await fetch(url,init);
    if (req.ok) {
       window.location.href="{{url('pagos_proveedores/pagar_pendiente/{id}')}}".replace("{id}",id2);
    }
    else{
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'ERROR AL ACTUALIZAR ESTATUS DE ORDEN'
        });
    }    
}
async function back_status3(id,id2) {
    let grupales = id.split(",");
    grupales.forEach(async element => {
    let url = "{{url('/compras/actualizar/{id}')}}".replace("{id}",element);
    let init = {
        method:"POST",
        headers:{
            'X-CSRF-Token' : "{{ csrf_token() }}",
            'Content-Type':'application/json'
        },
        body:JSON.stringify({'id_status':1})
    };
    let req =await fetch (url,init);
    if(req.ok){
        alert("La orden ha regresado a estatus operada");
        window.location.reload();
    }
    else{
        Swal.fire({
           icon: 'error',
           title: 'Error',
           text: "Error al actualizar estatus"
         });
    }
    });

}
async function back_status2(id,id2) {
    let grupales = id.split(",");
    grupales.forEach(async element => {
    let url = "{{url('/compras/actualizar/{id}')}}".replace("{id}",element);
    let init = {
        method:"POST",
        headers:{
            'X-CSRF-Token' : "{{ csrf_token() }}",
            'Content-Type':'application/json'
        },
        body:JSON.stringify({'id_status':1})
    };
    let req =await fetch (url,init);
    if(req.ok){
        alert("Ha eliminado el proceso de operar");
        // window.location.href="{{url('/compras')}}";
    }
    else{
        Swal.fire({
           icon: 'error',
           title: 'Error',
           text: "Error al actualizar estatus"
         });
    }
    });

}
let flag=0;
async function Update_estatus_grupales(id,id2) {
    let grupales = id.split(",");
    grupales.forEach(async element => {
    let url = "{{url('/compras/actualizar/{id}')}}".replace("{id}",element);
    let init = {
        method:"POST",
        headers:{
            'X-CSRF-Token' : "{{ csrf_token() }}",
            'Content-Type':'application/json'
        },
        body:JSON.stringify({'id_status':3})
    };
    let req =await fetch (url,init);
    if(req.ok){
        if(flag==0){
            window.location.href="{{url('pagos_proveedores2/pagar/{id}')}}".replace("{id}",id2);
            flag++;
        }
    }
    else{
        Swal.fire({
           icon: 'error',
           title: 'Error',
           text: "Error al actualizar estatus"
         });
    }
    });

}

async function Update_estatus_grupales_pendiente(id,id2) {
    let grupales = id.split(",");
    grupales.forEach(async element => {
    let url = "{{url('/compras/actualizar/{id}')}}".replace("{id}",element);
    let init = {
        method:"POST",
        headers:{
            'X-CSRF-Token' : "{{ csrf_token() }}",
            'Content-Type':'application/json'
        },
        body:JSON.stringify({'id_status':3})
    };
    let req =await fetch (url,init);
    if(req.ok){
        if(flag==0){
            window.location.href="{{url('pagos_proveedores2/pagar_pendiente/{id}')}}".replace("{id}",id2);
            flag++;
        }
    }
    else{
        Swal.fire({
           icon: 'error',
           title: 'Error',
           text: "Error al actualizar estatus"
         });
    }
    });

}

async function borrar_pago(id){
    event.preventDefault();
    let url='{{url("/pagos_proveedores/{id}")}}'.replace('{id}',id);
    let init = {
        method:"DELETE",
        headers: {  'X-CSRF-TOKEN': "{{csrf_token()}}"
                }
        }
        let req = await fetch(url,init);
        if (req.ok){
            location.reload();
        }
        else{

            Swal.fire({
                icon:"error",
                title:"Error",
                text:"Error al eliminar"
            });
        }
}
async function back_status(id) {
        event.preventDefault();
            let url = "{{url('/compras/actualizar/{id}')}}".replace("{id}",id);
            let init = {
                method:"POST",
                headers:{
                    'X-CSRF-Token' : "{{ csrf_token() }}",
                    'Content-Type':'application/json'
                },
                body:JSON.stringify({'id_status':1})

            };
            
            let req = await fetch(url,init);
            if (req.ok) {
               alert("Se ha eliminado correctamente");
            }
            else{
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'ERROR AL ACTUALIZAR ESTATUS DE ORDEN'
                });
            }
        
    }

async function update_pago_orden(id,id2){
    event.preventDefault();
    let url="{{url('/compras/actualizar/{id}')}}".replace("{id}",id);
    console.log(url);
    let init={
        method:"POST",
        headers:{
            'X-CSRF-Token' : "{{ csrf_token() }}",
            'Content-Type':'application/json'
        },
        body:JSON.stringify({'id_status':3})        
    };
    let req = await fetch(url,init);
    if (req.ok) {
       window.location.href="{{url('pagos_proveedores/pagar/{id}')}}".replace("{id}",id2);
    }
    else{
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'ERROR AL ACTUALIZAR ESTATUS DE ORDEN'
        });
    }    
}


async function update_pago(id){
    event.preventDefault();
    let url='{{url("pagos_proveedores/editar_pago/{id}")}}'.replace('{id}',id);
    let init = {
                method:"POST",
                headers:{
                    'X-CSRF-Token' : "{{ csrf_token() }}",
                    'Content-Type':'application/json'
                },
                body:JSON.stringify({'id_status':2,'saldo_pendiente':null,'estatus_pago':null,'comentarios_pagos':null})
            };
let req = await fetch(url,init);
if (req.ok){
    location.reload();
}
else{
    
    Swal.fire({
        icon:"error",
        title:"Error",
        text:"Error al eliminar"
    });
}
}
async function update_pago2(id){
    event.preventDefault();
    let url='{{url("pagos_proveedores2/editar_pago/{id}")}}'.replace('{id}',id);
    let init = {
                method:"POST",
                headers:{
                    'X-CSRF-Token' : "{{ csrf_token() }}",
                    'Content-Type':'application/json'
                },
                body:JSON.stringify({'id_status':2,'saldo_pendiente':null,'estatus_pago':null,'comentarios_pagos':null})
            };
    let req = await fetch(url,init);
    if (req.ok){
        location.reload();
    }
    else{
        
        Swal.fire({
            icon:"error",
            title:"Error",
            text:"Error al eliminar"
        });
    }
}


async function borrar_pago2(id){
    event.preventDefault();
    let url='{{url("/pagos_proveedores2/{id}")}}'.replace('{id}',id);
    let init = {
        method:"DELETE",
        headers: {  'X-CSRF-TOKEN': "{{csrf_token()}}"
                }
        }
let req = await fetch(url,init);
if (req.ok){
    alert("se ha eliminado la orden operada")
    location.reload();
}
else{
    
    Swal.fire({
        icon:"error",
        title:"Error",
        text:"Error al eliminar"
    });
}
}
</script>

@endsection