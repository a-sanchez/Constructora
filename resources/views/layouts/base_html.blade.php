@extends('layouts.base')
@section('menu')
    @php
        use App\Models\permisos;
        $permisos = permisos::where("id_usuario",Auth::user()->id)->get();
    @endphp
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
                    @if(Auth::user()->id == 1)
                        <li><a href={{url('/clientes')}}>Cliente</a></li>
                        <li><a href={{url('/contratos')}}>Contrato</a></li>
                        <li><a href={{url('/compras')}}>Orden de Compra</a></li>
                        <li><a href={{url('/facturas')}}>Operar pre-factura</a></li>
                        <li><a href={{url('/pagos_proveedores')}}>Pagos proveedores</a></li>
                        <li><a href={{url('/proveedores')}}>Proveedores</a></li>
                        <li><a href={{url('/configuracion')}}>PERMISOS</a></li>
                    @else
                        @foreach($permisos as $opcion)
                            <li><a href={{url("{$opcion->pantalla->url}")}}>{{$opcion->pantalla->nombre}}</a></li>
                        @endforeach
                    @endif
                        <li><a href={{url('/salir')}}>Salir</a></li>
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
