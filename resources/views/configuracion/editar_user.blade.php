@extends('layouts.base_html')
@section('tittle') AGREGAR USUARIO
@endsection 
@section("styles")
<style>
    .colorlib-contact{
            padding-top:1rem;
        }
 </style>
@endsection
@section('body')

<div class="container ">
<div class="col-md-12">
    <h1 class="animate-box fadeInLeft animated" data-animate-effect="fadeInLeft">
        Usuarios
    </h1>
</div>
<div class="row">
    <div class="col-md-12">
        <h4 style="color:gray;font-size:20px;">-Agregar</h4>
        <hr style="color: orange;">
        <p>
        </p>
    </div>
</div>
<form id="form-users" onSubmit='Update_User({{$user->id}});'>
@csrf
<div class="row d-flex flex-row justify-content-center alig-items-center">
    <div class="col-md-4">
        <a><i style="font-size:1.5rem;color:red" id="user-alt"  class="fas fa-user-alt"></i></a>
        <label for="nombre_usuario" >Nombre Completo</label>
        <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}">
    </div>
</div>
<br>
<div class="row d-flex flex-row justify-content-center alig-items-center">
    <div class="col-md-4">
    <a><i style="font-size:1.5rem;color:red" id="envelope"  class="fas fa-envelope"></i></a>
    <label for="nombre_email" >Email</label>
    <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}">
    </div>
</div>
<br>
<div class="row d-flex flex-row justify-content-center alig-items-center">
    <div class="col-md-4">
    <a><i style="font-size:1.5rem;color:red" id="lock"  class="fas fa-lock"></i></a>
        <label for="password">Contraseña</label>
        <input type="password" name="password" class="form-control" id="password" value="{{$user->password}}">
    </div>
</div>
<br>
<div class="row d-flex flex-row justify-content-center">
    <div class="col-md-4" style="text-align: center;">
        <button type="submit" class="btn btn-success">Actualizar</button>
        <a class="btn btn-danger" href="{{url('configuracion/listado')}}">Cancelar</a>
    </div>
</button>
</form>
@endsection

@section('scripts')
<script>
$(document).bind("contextmenu",function(e) { e.preventDefault(); }); //desactiva el inpector de codigo en la pagina
async function Update_User(id){
    event.preventDefault();
    let form = new FormData(document.getElementById("form-users"));
     let url='{{url("/configuracion/{id}")}}'.replace('{id}',id);
     let init = {
            method: "PUT"
            , headers: {
                'X-CSRF-Token': document.getElementsByName("_token")[0].value
                , "Content-Type": "application/json"
            }
            , body: JSON.stringify(Object.fromEntries(form))}
    let req=await fetch(url,init);
    if(req.ok){
        alert("El usuario se ha modificado correctamente.");
       window.location.href="{{url('/configuracion/listado')}}";
    }
    else{
        Swal.fire({
                    icon:"error",
                    title:"Error",
                    text:"ERROR al actualizar el usuario"
                });
            }
    }

</script>
@endsection