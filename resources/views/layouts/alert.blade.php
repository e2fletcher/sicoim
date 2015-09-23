<div class="alert alert-{{ $alert["type"] }} alert-dismissible fade in" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
	{{ $alert["message"] }}
	@if(isset($alert["actions"]))
		@foreach($alert["actions"] as $action)
			<a href="{{ $action["value"] }}" role="button" class="btn btn-default btn-sm">{{ $action["name"] }}</a>
		@endforeach
	@endif
</div>
