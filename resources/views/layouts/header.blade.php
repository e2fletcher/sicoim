<nav class="navbar navbar-default">
	<div class="container-fluid">
		<div class="navbar-header">
		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="#">Sicoime</a>
	</div>

	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<ul class="nav navbar-nav">

			<li class="active"><a href="/">Inicio<span class="sr-only">(current)</span></a></li>

			<li><a href="#">Ventas</a></li>

			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Recepción<span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li><a href="#">Desde Provedor</a></li>
					<li><a href="#">Desde Sucursal</a></li>
					<li role="separator" class="divider"></li>
					<li><a href="#">Consultar</a></li>
				</ul>
			</li>

			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Productos<span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li><a href="{!! action('TiposController@index')  !!}">Tipos</a></li>
					<li role="separator" class="divider"></li>
					<li><a href="#">Consultar</a></li>
				</ul>
			</li>

			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Sucursales<span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li><a href="#">Responsables</a></li>
					<li role="separator" class="divider"></li>
					<li><a href="#">Consultar</a></li>
				</ul>
			</li>

		</ul>

		<ul class="nav navbar-nav navbar-right">
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Configuraciones<span class="caret"></span></a>
				<ul class="dropdown-menu">
            <li><a href="#">Usuarios</a></li>
          </ul>
        </li>

		<li><a href="#">Salir</a></li>
	  </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
