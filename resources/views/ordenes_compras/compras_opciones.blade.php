@extends('layouts.base_html')

@section ('tittle')ORDENES DE COMPRA @endsection

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
    padding: 20px 25px 10px 40px;
    border: 1px solid #ddd;
    background-color: #f3f3f3;
}
a{ 
    /* position:absolute; 
    top:25px; */
     text-decoration:none; 
 } 
</style>
@endsection

@section('body')

<script src="https://kit.fontawesome.com/b4cf0d1143.js" crossorigin="anonymous"></script>

<div class="row">
    <div class="col-md-12">
        <h1 class="animate-box fadeInLeft animated" data-animate-effect="fadeInLeft">
            ORDENES DE COMPRA
        </h1>

    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <h4 style="color:gray;font-size:20px">-Opciones</h4>
        <hr style="color:orange;">

<div class="row">
      <div class="col-md-3" >
        <h1></h1> 
      </div>
      <div class="col-md-5" >
        <ul class="feat" id="about" style="text-align:center;">	
            <li>
            <i class="fas fa-file-alt fa-2x" style="margin-right: 10px"></i>	
                <a  href="/compras/create"  style="font-size:20px;" >Crear Orden de Compra</a>
            </li>		    
        </ul>
        <ul class="feat" id="about" style="text-align:center;">	
            <li>
            <i class="fas fa-list fa-2x" style="margin-right: 10px"></i>	
                <a  href="/compras" style="font-size:20px;">Catalogo de Ordenes de Compra</a>
            </li>		    
        </ul>
      </div>
      <div class="col-md-4" >
        <h1></h1> 
      </div>
</div>

@endsection

