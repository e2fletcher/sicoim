<nav class="navbar navbar-default">
	<div class="container-fluid">
		<div class="navbar-header">
		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			<span class="sr-only"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="#"></a>
	</div>

	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		@if(Auth::check())
		<ul class="nav navbar-nav">
			<li class="active"><a href="/">Inicio<span class="sr-only">(current)</span></a></li>
			<li><a href="#"><i class="fa fa-shopping-cart"></i> Ventas<span class="sr-only"></span></a></li>
			<li><a href="{!! action('RecepcionsController@index') !!}"><i class="fa fa-archive"></i> Recepciones<span class="sr-only"></span></a></li>
			<li><a href="#">Transferencias<span class="sr-only"></span></a></li>

			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Modificar<span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li><a href="{!! action('ClientesController@index') !!}">Clientes<span class="sr-only"></span></a></li>
					<li><a href="{!! action('ProveedorsController@index') !!}">Proveedores<span class="sr-only"></span></a></li>
					@if(Auth::user()->type < 1)
						<li><a href="{!! action('TiposController@index') !!}">Listas de productos<span class="sr-only"></span></a></li>
					@endif
					@if(Auth::user()->type < 2)
						<li><a href="{!! action('SucursalsController@index') !!}">Sucursales<span class="sr-only"></span></a></li>
					@endif

				</ul>
			</li>
		</ul>

		<ul class="nav navbar-nav navbar-right">
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
						<i class="fa fa-user"></i> <span class="text-capitalize">{{ Auth::user()->name }}</span>
				<span class="caret"></span></a>
				<ul class="dropdown-menu">
					@if(Auth::user()->type < 1)
						<li><a href="#">Configuracion de usuarios<span class="sr-only"></span></a></li>
					@endif
					<li><a href="{!! route('auth/logout') !!}">Salir</a></li>
				</ul>
			</li>
	  </ul>
	@endif
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
