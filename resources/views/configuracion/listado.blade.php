@extends('layouts.base_html')
@section('tittle') USUARIOS 
@endsection 
@section("styles") 
<link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="{{ asset('lib/DataTables/Responsive-2.2.9/css/responsive.dataTables.min.css') }}">    <style>
    
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
            <h1 class="animate-box fadeInLeft animated" data-animate-effect="fadeInLeft">
                USUARIOS
            </h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h4 style="color:gray;font-size:20px;">-Agregar</h4>
            <hr style="color: #ff9c00;">
        </div>
    </div>
    <a type="button" class="btn" href={{url('configuracion/create')}} style="background:#8d8d8d;color:white;">Agregar usuario</a>
    <a type="button" class="btn" href={{url('/configuracion')}} style="background:#f16532;color:white;">Regresar</a>
    <br>

    <table id="usuario_lista" style="width: 100%;border: 1px solid black;">
        <thead  style="background-color:#ff9c00;color:white;">
        <th >Nombre</th>
        <th >email</th>
        <th >Opciones</th>
        </thead>
        <tbody >
            @foreach($users as $user)
                <tr >
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td width="15%">
                        {{-- <a  type="button" style="color: #f7dd0b; " class="btn"  href="{{url("/configuracion/{$user->id}/edit")}}"><i style="font-size:1.5rem;" id="pen"  class="fas fa-pen"></i></a> --}}
                        <a  style="color: #7f7f7f;" href="#" class="btn" onclick='borrarUsuario({{$user->id}});'><i style="font-size:1.5rem" id="trash-alt"  class="fas fa-trash-alt"></i></a>
                        </td>                 
                </tr>
            @endforeach
        </tbody>
    </table>


    @endsection

    @section("scripts")
    <script src="https://kit.fontawesome.com/b4cf0d1143.js" crossorigin="anonymous"></script>
    <script>
        let table=$("#usuario_lista").dataTable({
            responsive:true
        });

        
        
        
        async function borrarUsuario(id){
            event.preventDefault();
            let url='{{url("/configuracion/{id}")}}'.replace('{id}',id);
            let init={
                method:"DELETE",
               headers: {'X-CSRF-TOKEN': "{{csrf_token()}}"}
            }
        let req=await fetch(url,init);
        if(req.ok){
            location.reload();
        }
        else{
            Swal.fire({
                    icon:"error",
                    title:"Error",
                    text:"ERROR al eliminar el usuario"
                });
            }
        }

    </script>

    
    @endsection