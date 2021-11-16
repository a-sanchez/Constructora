@extends('layouts.base_html')
@section('tittle') COMPRAS @endsection 
@section("styles") 
<link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="{{ asset('lib/DataTables/Responsive-2.2.9/css/responsive.dataTables.min.css') }}">

    <style>
        table {
        text-transform: uppercase;
    }
    
    .dataTables_filter{
        margin-bottom:0.5rem;
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
    @section('body')
    <div class="row">
        <div class="col-md-10">
            <h1 class="animate-box fadeInLeft animated" data-animate-effect="fadeInLeft">
                ORDENES DE COMPRA
            </h1>
        </div>
        <div class="col-md-2 mt-2" style="text-align:center">
            <a type="button" href="{{url('compras/reporte')}}" class="btn" style="background-color: #1b1b97;color:white">Generar Reporte</a>
        </div>
        <hr class="mt-4" style="color: orange;">
    </div>
    <table style="text-align:center;width: 100%;" id="orden_table" width="100%">
        <thead style="background-color:#ff9c00;color:white;text-align:center">
            <th>Folio Orden</th>
            <th>Solicitado</th>
            <th>Fecha Orden</th>
            <th>Fecha Entrega</th>
            <th>Descripcion Orden</th>
            <th>Contrato</th>
            <th>Proveedor</th>
            <th>Importe Total(Sin IVA)</th>
            <th>Factura Grupal</th>
            <th>Estatus</th>
            <th></th>
        </thead>
        <tbody>
            @foreach($views as $view)
                <tr style="text-align:center">
                    <td>{{$view->folio_orden}}</td>
                    <td>{{$view->solicitado}}</td>
                    <td>{{$view->fecha_orden}}</td>
                    <td>{{$view->fecha_entrega}}</td>
                    <td>{{$view->descripcion_orden}}</td>
                    <td>{{$view->folio}}</td>                    
                    <td>{{$view->razon_social}}</td>
                    <td> $ {{number_format($view->importe_total,2)}}</td>
                    <td>
                        <form id="grupal" name="grupal">
                            @csrf
                        @if($view->status=='En proceso..')
                        <input type="checkbox" name="grupal[]" step="{{$view->id}}" contrato="{{$view->folio}}" class="{{$view->razon_social}}-{{$view->folio}}" value="{{$view->importe_total}}" id="{{$view->costo}}" onchange="seleccionado(this);" style="text-align:center">
                        @endif
                        </form>
                    </td>
                    <td>{{$view->status}}</td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" style="background-color: black;
                            border-color: black;" aria-expanded="false">Opciones
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                @if($view->id_status==1)
                                <li><a class="dropdown-item" target ="_blank" href="{{url("compras_pdf/{$view->id}")}}">PDF ORDEN</a></li>
                                <li><a class="dropdown-item" href="{{url("compras/{$view->id}/edit")}}">Editar</a></li>
                                <li><a class="dropdown-item" onclick='orden_estatus({{$view->id}})' href="">Operar Orden</a></li>
                                <li><a  class="dropdown-item" href="" onclick='update_status({{$view->id}})'>Eliminar</a></li>
                                @elseif($view->id_status==2)
                                <li><a class="dropdown-item" target ="_blank" href="{{url("compras_pdf/{$view->id}")}}">PDF ORDEN</a></li>
                                <li><a class="dropdown-item" href="{{url("compras/{$view->id}/edit")}}">Editar</a></li>
                                <li><a  class="dropdown-item" href="" onclick='update_status({{$view->id}})'>Eliminar</a></li>
                                @else
                                <li><a class="dropdown-item" target ="_blank" href="{{url("compras_pdf/{$view->id}")}}">PDF ORDEN</a></li>
                                @endif
                            </ul>
                        </div>
                    </td>
                </tr>
            @endforeach
            <div class="row mb-3 d-flex justify-content-center">
                <div class="col-md-3">
                    <label for="gasto_operacion">Gasto de operacion del contrato</label>
                    <input type="text" class="form-control" id="gasto_operacion" name="gasto_operacion">
                </div>
                <div class="col-md-3">
                    <label for="total_orden">Sub-total de Ordenes</label>
                    <input type="text" class="form-control" id="ordenes" name="ordenes">
                </div>
                <div class="col-md-3">
                    <label for="subtotal">Total</label>
                    <input type="text" class="form-control" id="total" name="total" value="0.00">
                </div>
                <div class=" col-md-3 " >
                    <button class="btn btn-success" id="btn_grupal" style="margin-top: 2.1rem;" onclick ="Updates_Grupal();" >Orden Grupal</button>
                </div>
            </div>
        </tbody>
    </table>
    <h6>Si va operar varias ordenes seleccionar al mismo proveedor y el mismo contrato</h6>
    @endsection

    @section('scripts')
    <script>
        let table = $("#orden_table").dataTable({
            responsive:true,
            columnDefs:[{responsivePriority:1,targets:8}]
        });
        var checkbox = document.querySelectorAll("input[type=checkbox]");
        checkbox.forEach(check => {
            check.addEventListener('change', function() {
                if (this.checked) {
                    checkbox.forEach(element => {
                        if (this.className != element.className) {
                            element.disabled = true;
                        }
                    });
                    
                }
                else {
                    if(!$("input:checkbox:checked").length > 0){
                        checkbox.forEach(element => {
                            if (this.className != element.className) {
                                element.disabled = false;
                            }
                        });
                    }
                }
            });
        });

        let flag = 0;
        async function Updates_Grupal() {
            let check=getCheckedBox();
            check.forEach(async (element) => {
                event.preventDefault();
                let url = "{{url('/compras/{id}')}}".replace("{id}",element);
                let init = {
                    method:"PUT",
                    headers:{
                        'X-CSRF-Token' : "{{ csrf_token() }}",
                        'Content-Type':'application/json'
                    },
                    body:JSON.stringify({'id_status':2})
                };
                let req =await fetch (url,init);
                 if(req.ok){
                     if(flag==0){
                    Ordenes();
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

        var contrato = document.getElementById("id_contrato");
        var gasto = document.getElementById("gasto_operacion");
        var sub_total = document.getElementById("ordenes");
        var total = document.getElementById("total");
        
        function seleccionado(casilla){
            gasto.value=parseFloat(casilla.id).toFixed(2);
            if(casilla.checked){
                suma(casilla)
            } 
            else {
            resta(casilla)
            }
        function suma(casilla){ 
            sub_total.value = parseFloat(sub_total.value*1 + casilla.value*1).toFixed(2);
            }
        
        function resta(casilla){ 
            sub_total.value = parseFloat(sub_total.value*1 - casilla.value*1).toFixed(2);
            }

        total.value = parseFloat(gasto.value-sub_total.value).toFixed(2);
            if(total.value < 0){
                total.style.color = "#ff0000";
                document.getElementById("btn_grupal").disabled=true;
            }
            else{
                total.style.color = "black";
                document.getElementById("btn_grupal").disabled=false;
            }
        }

        async function Ordenes(){
            let check = getCheckedBox();
            let form= new FormData();
            form.append("id_contrato",contrato);
            form.append("id_orden",check);
            form.append("id_status",2);
            form.append("id_pago",{{$pagos}});
            url="{{url('/orden_pago')}}";
            let init = {
                method:"POST",
                headers:{
                    'X-CSRF-Token' : "{{ csrf_token() }}",
                },
                body:form
            }
            let req =await fetch (url,init);
            if(req.ok){
                let res = await req.json();
                window.location.href="{{url('pagos_proveedores2/{id}/edit')}}".replace("{id}",res);
            }
            else{
                Swal.fire({
                  icon: 'error',
                  title: 'Error',
                  text: "Error al registrar las ordenes operadas"
                });
            }

        }

        function getCheckedBox() {
            let checked = [];
            checks = $("input:checkbox:checked");
            checks.each(function( index ) {
                checked.push(checks[index].step);
            });
            return checked;
        }
        
        async function orden_estatus(id) {
            event.preventDefault();
            let url = "{{url('/compras/{id}')}}".replace("{id}",id);
            let init = {
                method:"PUT",
                headers:{
                    'X-CSRF-Token' : "{{ csrf_token() }}",
                    'Content-Type':'application/json'
                },
                body:JSON.stringify({'id_status':2})

            };
            
            let req = await fetch(url,init);
            if (req.ok) {
               window.location.href="{{url('/pagos_proveedores/orden/{id}')}}".replace("{id}",id);
            }
            else{
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'ERROR AL ACTUALIZAR ESTATUS DE ORDEN'
                });
            }
        }
        async function update_status(id) {
            event.preventDefault();
            let url = "{{url('/compras/{id}')}}".replace("{id}",id);
            let init = {
                method:"PUT",
                headers:{
                    'X-CSRF-Token' : "{{ csrf_token() }}",
                    'Content-Type':'application/json'
                },
                body:JSON.stringify({'status':0})

            };
            
            let req = await fetch(url,init);
            if (req.ok) {
              window.location.reload();
            }
            else{
                let res = await req.json();
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: res
                });
            }
        }

    </script>
    @endsection
