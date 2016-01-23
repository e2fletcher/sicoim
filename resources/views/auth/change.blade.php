@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row margin-top-15">
        <div class="col-md-8 col-md-offset-2">
	    <div class="panel panel-default">
	        <div class="panel-heading">Modificar contraseña</div>
                <div class="panel-body">
                @if(isset($alert))
		    <div class="row">
		        <div class="col-md-12">
			    @include('layouts.alert')
			</div>
		    </div>
		@endif

		@if (count($errors) > 0)
		    <div class="alert alert-danger">
		        <strong>Epa!</strong> algo salió mal :(.<br><br>
                        <ul>
    		        @foreach ($errors->all() as $error)
	    		    <li>{{ $error }}</li>
		        @endforeach
			</ul>
		    </div>
		@endif
                
                <form class="form-horizontal" data-toggle="validator" role="form" method="POST" action="{{ url('/password/change') }}">
		    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group">
		        <label class="col-md-4 control-label">Contraseña</label>
	    	        <div class="col-md-6">
		            <input id="inputPassword" data-minlength="6" type="password" class="form-control" name="password" required>
                            <span class="help-block">Mínimo 6 caracteres</span>
                        </div>
		    </div>

                    <div class="form-group">
		        <label class="col-md-4 control-label">Repita contraseña</label>
	    	        <div class="col-md-6">
                            <input type="password" class="form-control" name="password_confirmation" data-match="#inputPassword" data-match-error="Las contraseñas no coinciden" required>
                            <div class="help-block with-errors"></div>
			</div>
		    </div>
		        <div class="form-group">
		            <div class="col-md-6 col-md-offset-4">
			        <button type="submit" class="btn btn-primary">Aceptar</button>
                            </div>
		        </div>
		    </form>
	        </div>
	    </div>
        </div>
    </div>
</div>
@endsection
