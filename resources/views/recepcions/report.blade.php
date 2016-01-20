@extends('layouts.master')
@section('content')
@parent
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
	    <div class="panel-heading">
		<span class="label label-default">Reporte de recepciones</span> 
	    </div>
	    <div class="panel-body">
	        <div class="panel panel-default">
		    <div class="panel-body">
		    @if(isset($alert))
	        	<div class="row">
		            <div class="col-md-12">
			        @include('layouts.alert')
			    </div>
			</div>
		    @endif
		    </div>
                </div>
            </div>
        </div>
    <div>
</div>
@endsection
