@if(Auth::check())
<nav class="navbar navbar-default" id="navbar_master">
        <div class="container-fluid">
          <div class="navbar-header">
            <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a href="{{ action('HomeController@index')  }}" class="navbar-brand">SICOIME</a>
          </div>
          <div class="navbar-collapse collapse" id="navbar">
            <ul class="nav navbar-nav">
			@if(Auth::user()->type > 0)
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
					<i class="fa fa-archive"></i> Recepciones<span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
					<li><a href="{!! action('RecepcionsController@index') !!}"><i class="fa fa-archive"></i> Procesar<span class="sr-only"></span></a></li>
					<li><a href="{!! action('ProveedorsController@index') !!}"><i class="fa fa-truck"></i> Proveedores<span class="sr-only"></span></a></li>
					<li id="navbar_button_consultar" data-action="recepcions"><a href="#"><i class="fa fa-search"></i> Consultar<span class="sr-only"></span></a></li>
				</ul>
			</li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
					<i class="fa fa-shopping-cart"></i> Ventas<span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
					<li><a href="{!! action('VentasController@index') !!}"><i class="fa fa-shopping-cart"></i> Procesar<span class="sr-only"></span></a></li>
					<li><a href="{!! action('ClientesController@index') !!}"><i class="fa fa-users"></i> Clientes<span class="sr-only"></span></a></li>
					<li id="navbar_button_consultar" data-action="ventas"><a href="#"><i class="fa fa-search"></i> Consultar<span class="sr-only"></span></a></li>
				</ul>
			</li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
					<i class="fa fa-send"></i> Transferencias<span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
					<li><a href="{!! action('RecepcionsController@index') !!}"><i class="fa fa-send"></i> Procesar<span class="sr-only"></span></a></li>
					<li id="navbar_button_consultar" data-action="transferencias"><a href="#"><i class="fa fa-search"></i> Consultar<span class="sr-only"></span></a></li>
				</ul>
			</li>
			<li><a href="{!! action('ProveedorsController@index') !!}"><i class="fa fa-search"></i> Inventario<span class="sr-only"></span></a></li>
			@endif
			@if(Auth::user()->type < 1)
				<li><a href="{!! action('TiposController@index') !!}"><i class="fa fa-barcode"></i> Listas de productos<span class="sr-only"></span></a></li>
				<li><a href="{!! action('SucursalsController@index') !!}"><i class="fa fa-home"></i> Sucursales<span class="sr-only"></span></a></li>
			@endif
			<li><a href="{!! action('SucursalsController@maps')  !!}" target="_blank"><i class="fa fa-map-marker"></i> Mapa de Sucursales<span class="sr-only"></span></a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
						<span class="label label-default label-sm"><i class="fa fa-user"></i> {{ Auth::user()->email }}</span>
				<span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li><a href="#"><i class="fa fa-gear"></i> Modificar contraseña<span class="sr-only"></span></a></li>
					@if(Auth::user()->type < 1)
						<li><a href="#"><i class="fa fa-gear"></i> Agregar usuarios<span class="sr-only"></span></a></li>
					@endif
					<li><a href="{!! route('auth/logout') !!}"><i class="fa fa-lock"></i> Salir</a></li>
				</ul>
			</li>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>
@section('body')
	@parent
	@include('layouts.consulta_modal_form')
	<script>
	$(document).ready(function(){
		$("#navbar_master").on('click', '#navbar_button_consultar', function(e){
			e.preventDefault();
			
			var form = $('#consulta_modal_form').find("form");
			$('#consulta_modal_form').modal('show');
			
			switch ($(this).data("action")) {
				case 'recepcions':
					$('#consulta_modal_form').find('form').attr('action', '{!! action('RecepcionsController@search') !!}');
					break;
				case 'ventas':
					$('#consulta_modal_form').find('form').attr('action', '{!! action('VentasController@search') !!}');
					break;
				default:
					break;
			}
		});
	});
	</script>
@endsection
@endif
