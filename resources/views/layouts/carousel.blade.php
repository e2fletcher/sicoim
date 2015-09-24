<div id="carousel-example-generic" class="carousel slide row_padding_button" data-ride="carousel">
<?php $imgs = glob(public_path() . '/img/carousel/*.{png,jpg}', GLOB_BRACE); ?>
	<ol class="carousel-indicators">
		@foreach($imgs as $k => $img)
			<li data-target="#carousel-example-generic" data-slide-to="{{ $k }}" class="<?php if($k == 0) echo "active"; ?>"></li>
		@endforeach
	</ol>
	<div class="carousel-inner" role="listbox">
		@foreach($imgs as $k => $img)
			<?php $img = basename($img); ?>
			<div class="item <?php if($k == 0) echo "active"; ?>">
				<img class="img-responsive center-block" data-src="" alt="" src="{{ asset('img/carousel/' . $img)  }}" data-holder-rendered="true">
			</div>
		@endforeach
	</div>
	<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
		<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
		<span class="sr-only">Anterior</span>
	</a>
	<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
		<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
		<span class="sr-only">Siguiente</span>
	</a>
</div>
