@extends('layouts.base')
@section('menu')
    <a href="#" class="js-colorlib-nav-toggle colorlib-nav-toggle"><i></i></a>
    <aside id="colorlib-aside" role="complementary" class="border js-fullheight" style="height: 982px;">
        <nav id="colorlib-main-menu" role="navigation">
            <div class="row">
                <div class="col-md-12">
                    <img class="img-fluid img-thumbnail" id="img" src="{{asset('images/constructura2.jpg')}}"/>
                </div>
            </div>
            <ul>
                <li class="colorlib-active">
                <li><a href={{url('/clientes_opciones')}}>Cliente</a></li>
                <li><a href={{url('/contratos')}}>Contrato</a></li>
                <li><a href={{url('/compras')}}>Orden de Compra</a></li>
                <li><a href={{url('/facturas')}}>Facturas</a></li>
                <li><a href={{url('/pagos')}}>Pagos</a></li>
                <li><a href={{url('/proveedores')}}>Proveedores</a></li>
                <li><a href={{url('/configuracion')}}>Configuracion</a></li>
                <li><a href="/">Salir</a></li>
            </ul>
        </nav>
    </aside>
    <main>
    <div id="colorlib-main">
			<div class="colorlib-contact">
				<div class="container-fluid">
					<!-- titulo -->
                    <div class="row">
						<div class="col-md-12">
							<h1 class="animate-box fadeInLeft animated" data-animate-effect="fadeInLeft">
                                @yield('title')
                            </h1>
						</div>
					</div>
                    <!-- body -->
                    @yield("body")
				</div>
			</div>
		</div>
	</div>
    </main>
@endsection