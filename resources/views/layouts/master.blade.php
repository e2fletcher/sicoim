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
        <!-- Bootstrap -->
        {!! Html::style('vendor/bootstrap/dist/css/bootstrap.css') !!}
        {!! Html::style('vendor/font-awesome/css/font-awesome.css') !!}
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        @yield('head')
    </head>
  <body>
    @include('layouts.header')
    <div class="container">
		@yield('content')
    </div> <!-- /container -->

    <footer id="footer" class="footer">
        <div class="container text-center">
            <div><i class="fa fa-html5 fa-3x"></i></div>
        </div>
    </footer>
     <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    {!! Html::script('vendor/jquery/dist/jquery.js')  !!}
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    {!! Html::script('vendor/bootstrap/dist/js/bootstrap.js') !!}
    @yield('body')
    </body>
</html>
