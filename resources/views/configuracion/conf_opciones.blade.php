@extends('layouts.base_html')

@section ('tittle')CONFIGURACION @endsection

@section('styles')
<style>
ul.feat{
	list-style:none;
	margin: 0 0 20px 0;
	padding:0;
}
ul.feat li{
	padding-left:85px;
	position:relative;
}
ul.feat li img{
	position:absolute;
	left:0;
	top:0;
}

ul.feat#about li i {
    font-size: 30px;
    color: #FF3333;
}
ul.feat#about li {
    margin-bottom: 20px;
    padding: 20px 25px 10px 135px;
    border: 1px solid #ddd;
    background-color: #f3f3f3;
}

a{
    position:absolute;
    top:18px;
    text-decoration:none;
}
i{
    margin-right:15px;
}
</style>
@endsection

@section('body')

<script src="https://kit.fontawesome.com/b4cf0d1143.js" crossorigin="anonymous"></script>

<div class="row">
    <div class="col-md-12">
        <h1 class="animate-box fadeInLeft animated" data-animate-effect="fadeInLeft">
            CONFIGURACION
        </h1>

    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <h4>-Opciones</h4>
        <hr>
        <p>
            
        </p>

<div class="row">
      <div class="col-md-3" >
        <h1></h1> 
      </div>
      <div class="col-md-5" >
        <ul class="feat" id="about">	
            <li>
            <i class="fas fa-users"></i>
                <a  href="/usuarios" style="font-size:20px;">Usuarios</a>
            </li>		    
        </ul>

        <ul class="feat" id="about">	
            <li>
            <i class="fas fa-address-card"></i>

                <a  href="/perfiles" style="font-size:20px;">Perfiles</a>
            </li>		    
        </ul>

        <ul class="feat" id="about">	
            <li>
            <i class="fas fa-user-lock"></i>
                <a  href="/permisos" style="font-size:20px;">Permisos</a>
            </li>		    
        </ul>
      </div>
      <div class="col-md-4" >
        <h1></h1> 
      </div>
</div>


@endsection