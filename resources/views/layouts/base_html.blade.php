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
                <li><a href="/configuracion">Configuracion</a></li>
                <li><a href="/contrato">Contrato</a></li>
                <li><a href="/facturas">Facturas</a></li>
                <li><a href="/pagos">Pagos</a></li>
                <li><a href="/opcion_proveedores">Proveedores</a></li>
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