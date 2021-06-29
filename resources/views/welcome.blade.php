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

@section('body')
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
                                <div class="form-group mt-3">
                                    <input autocomplete="off" id="email" name="email" type="text" class="form-control" placeholder="Usuario">
                                </div>
                                <div class="form-group mt-3">
                                    <input autocomplete="off" id="contrasena" name="contrasena" type="password" class="form-control" placeholder="Contraseña">
                                </div>
                                <div class="form-group mt-5">
                                    <a href="/opciones" class="btn btn-primary">Entrar</a>
                                    <!-- <button id="submit" type="submit" class="btn btn-primary btn-send-message">Entrar</button> -->
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
