@extends('layouts.base')

@section('title')
    Login 
@endsection

@section('styles')
<style>
    body{
        background-color: #F7F7F7;
    }
</style>
    
@endsection

@section('menu')
<div style="height: 100vh;" class="d-flex align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="col-md-10">
                    <img src="{{ asset('images/constructura2.jpg') }}"  class="img-fluid" height="150" alt="ConbeLogo">
                </div>
            </div>
            <div class="col-md-6">
                <div class="row d-flex justify-content-center align-self-center">
                    <span class="heading-meta">Sistema la administracion CONBE</span>
                    <h1 class="animate-box fadeInLeft animated" data-animate-effect="fadeInLeft">Acceso</h1>
                </div>
                <div class="row d-flex justify-content-center">
                    <div class="row">
                        <div class="animate-box fadeInLeft animated" data-animate-effect="fadeInLeft">
                            <form id="login-form" enctype="multipart/form-data" onsubmit="submitForm();">
                                @csrf
                                <div class="form-group mt-3">
                                    <input autocomplete="off" id="email" name="email" type="text" class="form-control" placeholder="Usuario">
                                </div>
                                <div class="form-group mt-3">
                                    <input autocomplete="off" id="password" name="password" type="password" class="form-control" placeholder="Contraseña">
                                </div>
                                <div class="form-group mt-5">
                                    {{-- <a href="#" class="btn btn-primary">Entrar</a> --}}
                                    <button id="submit" type="submit" class="btn btn-primary btn-send-message">Entrar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection

@section('scripts')
<script>
async function submitForm(){
            event.preventDefault();
            //  Convierte el formulario a Objeto formdata
            let form = new FormData(document.getElementById("login-form"));
            //Agregamos el campo accion
            //INIT
            let url = "{{url("/login")}}";
            let init = {
                method:"POST",
                body:form
            };
            //PETICION
            let req = await fetch(url, init);
            //SI LA PETICION TIENE STATUS OK REDIRECICONA
            if(req.ok){
                window.location.href = "{{url("/")}}";
                return;
            }
            //SI NO  AGREGA MENSAJE EN SWALERT
            let res = await req.json();
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: res
            })
            document.getElementById('password').value = "";
        }
</script>
@endsection