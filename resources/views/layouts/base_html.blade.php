@extends('layouts.base')
@section('menu')
    <aside id="colorlib-aside" role="complementary" class="border js-fullheight" style="height: 982px;">
        <nav id="colorlib-main-menu" role="navigation">
            <div class="row">
                <div class="col-md-12">
                    <img class="img-fluid img-thumbnail" id="img" src="{{asset('images/constructura2.jpg')}}"/>
                </div>
            </div>
            <ul>
                <li class="colorlib-active">
                <li><a href="configuracion.php">Configuracion</a></li>
                <li><a href="contrato.php">Contrato</a></li>
                <li><a href="facturas.php">Facturas</a></li>
                <li><a href="pagos.php">Pagos</a></li>
                <li><a href="proveedores.php">Proveedores</a></li>
                <li><a href="/">Salir</a></li>
            </ul>
        </nav>
    </aside>
@endsection