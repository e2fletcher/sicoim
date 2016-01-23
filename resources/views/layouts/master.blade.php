<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title')</title>
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="">
        {!! Html::style('vendor/bootstrap/dist/css/bootstrap.css') !!}
        {!! Html::style('vendor/font-awesome/css/font-awesome.css') !!}
        {!! Html::style('vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker.css') !!}
        {!! Html::style('css/style.css') !!}
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
		@yield('head')
    </head>
    <body>
        <div class="hidden-print">
	    @include('layouts.header')
	</div>
        <div class="container">
	    @yield('content')
	</div>

		<footer id="footer" class="footer hidden-print">
			<div class="container text-center">
				<div class="row">
					<div class="col-md-12">
						<span class="label label-danger"><i class="fa fa-home"></i>
							@if(Auth::check())
								@if(Auth::user()->type > 0)
									{{ Illuminate\Support\Str::upper(Auth::user()->sucursal()->nombre)  }}
								@endif
							@endif
						</span>
					</div>
				</div>
			</div>
		</footer>
		{!! Html::script('vendor/jquery/dist/jquery.js')  !!}
		{!! Html::script('vendor/bootstrap/dist/js/bootstrap.js') !!}
		{!! Html::script('vendor/bootstrap-validator/dist/validator.js') !!}
		{!! Html::script('vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.js') !!}
		@yield('body')
	</body>
</html>
