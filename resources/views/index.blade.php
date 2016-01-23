@extends('layouts.master')

@section('content')	
@parent

@include('layouts.errors')

@if(isset($alert))
<div class="row">
    <div class="col-md-12">
        @include('layouts.alert')
    </div>
</div>
@endif

<div class="row hidden-xs row_padding_button">
	<div class="col-lg-12">
		@include('carousel')
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">Misión</div>
			<div class="panel-body">
				@include('mision')
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">Visión</div>
			<div class="panel-body">
				@include('vision')
			</div>
		</div>
	</div>
</div>
@endsection
