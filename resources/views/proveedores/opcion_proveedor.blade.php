@extends('layouts.base_html')

@section ('tittle')PROVEEDORES @endsection

@section('styles')
<style>
ul.feat{
	list-style:none;
	margin: 0 0 20px 0;
	padding:0;
}
ul.feat li{
	padding-left:70px;
	position:relative;
}
ul.feat li img{
	position:absolute;
	left:0;
	top:0;
}

ul.feat#about li i {
    font-size: 40px;
    color: #FF3333;
}
ul.feat#about li {
    margin-bottom: 20px;
    padding: 20px 25px 10px 70px;
    border: 1px solid #ddd;
    background-color: #f3f3f3;
}
a{
    position:absolute;
    top:25px;
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
            PROVEEDORES
        </h1>

    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <h4 style="color:gray; font-size:20px">-Opciones</h4>
        <hr style="color:orange">
        <p>
            
        </p>
</div> 

<div class="row">
      <div class="col-md-3" >
        <h1></h1> 
      </div>
      <div class="col-md-5" >
        <ul class="feat" id="about">	
            <li>
            <i class="fas fa-user-friends"></i>	
                <a  href="/proveedores/create" style="font-size:20px;">Agregar Proveedor</a>
            </li>		    
        </ul>
        <ul class="feat" id="about">	
            <li>
            <i class="fas fa-list"></i>	
                <a  href="proveedores/" style="font-size:20px;">Catalogo de Proveedores</a>
            </li>		    
        </ul>
      </div>
      <div class="col-md-4" >
        <h1></h1> 
      </div>
</div>
  
@endsection