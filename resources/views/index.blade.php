@extends('layouts.master')

@section('content')	
	@parent
<div class="row hidden-xs">
	<div class="col-lg-12">
	@include('layouts.carousel')
	</div>
</div>
@endsection
