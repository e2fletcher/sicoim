@extends('layouts.master')

@section('content')	
	@parent
<div class="row hidden-xs row_padding_button">
	<div class="col-lg-12">
		@include('layouts.carousel')
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">Misión</div>
			<div class="panel-body">
				@include('layouts.mision')
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">Visión</div>
			<div class="panel-body">
				@include('layouts.vision')
			</div>
		</div>
	</div>
</div>
@endsection
