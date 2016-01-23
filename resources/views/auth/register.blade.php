@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('layouts.errors')
        <div class="col-md-8 col-md-offset-2">
	    <div class="panel panel-default">
	        <div class="panel-heading">Registrar usuario</div>
		    <div class="panel-body">

                    <form class="form-horizontal" data-toggle="validator" role="form" method="POST" action="{{ url('/auth/register') }}">
		        <input type="hidden" name="_token" value="{{ csrf_token() }}">

			<div class="form-group">
			    <label class="col-md-4 control-label">Nombre</label>
			    <div class="col-md-6">
				<input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
			    </div>
			</div>

			<div class="form-group">
			    <label class="col-md-4 control-label">Correo</label>
			    <div class="col-md-6">
				<input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
			    </div>
			</div>

                        <div class="form-group">
			    <label class="col-md-4 control-label">Sucursal</label>
			    <div class="row">
				<div class="col-md-5">
				    <select class="form-control" name="sucursal">
                                        @include('auth.sucursal')
                                    </select>
		        	</div>
			    </div>
			</div>

                        <div class="form-group">
			    <label class="col-md-4 control-label">Permisos</label>
			    <div class="row">
				<div class="col-md-4">
				    <select class="form-control" name="type">
                                        @include('auth.permisos')
                                    </select>
		        	</div>
			    </div>
			</div>
			
                        <div class="form-group">
			    <label class="col-md-4 control-label">Contraseña</label>
			    <div class="col-md-6">
			        <input type="password" class="form-control" name="password" required>
			    </div>
                        </div>

			<div class="form-group">
			    <label class="col-md-4 control-label">Confirmar contraseña</label>
			    <div class="col-md-6">
				<input type="password" class="form-control" name="password_confirmation">
			    </div>
			</div>

			<div class="form-group">
			    <div class="col-md-6 col-md-offset-4">
				<button type="submit" class="btn btn-primary">
				    Registrar
				</button>
			    </div>
			</div>
		    </form>
		</div>
	    </div>
	</div>
    </div>
</div>
@endsection
