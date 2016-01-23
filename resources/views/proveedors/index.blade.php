@extends('layouts.master')
@section('content')
@parent
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">PROVEEDORES</div>
                        <div class="panel-body">
                                @include('layouts.errors')
				@if(isset($alert))
				<div class="row">
					<div class="col-md-12">
					@include('layouts.alert')
					</div>
				</div>
				@endif
				<div class="row">
					<div class="col-md-12">
						<form class="navbar-form navbar-left" role="search" action="{!! action('ProveedorsController@index')  !!}">
							<div class="form-group">
								<input type="text" name="search" class="form-control" placeholder="Proveedor">
							</div>
							<button class="btn btn-default" type="submit" id="button_search"><i class="fa fa-search"></i></button>
							<button class="btn btn-default" type="button" id="button_add"><i class="fa fa-plus-square"></i> Agregar</button>
						</form>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<table class="table table-hover">
							<thead>
								<tr>
									<th class="col-md-2">Identificación</th>
									<th class="col-md-4">Proveedor</th>
									<th class="col-md-4 hidden-xs">Dirección</th>
									<th class="col-md-2"></th>
								</tr>
							</thead>
							<tbody>
								@foreach ($proveedors as $proveedor)
								<tr
									data-id="{{ $proveedor->id  }}"
									data-ident="{{ $proveedor->ident }}"
									data-nombre="{{ $proveedor->nombre }}"
									data-direccion="{{ $proveedor->direccion }}"
									data-tlf="{{ $proveedor->tlf }}"
									data-email="{{ $proveedor->email }}">
									
									<td class="col-md-2">{{ $proveedor->ident }}</td>
									<td class="col-md-4">{{ strtoupper($proveedor->nombre) }}</td>
									<td class="col-md-4 hidden-xs">{{ $proveedor->direccion }}</td>
									<td class="col-md-2 text-right">
										<div class="btn-group" role="group" aria-label="...">
											<button class="btn btn-default" type="button" data-name="button_edit" data-toggle="modal" data-target="#modal_form"><i class="fa fa-edit"></i></button>
											<button class="btn btn-warning" type="button" data-toggle="modal" data-target="#layouts_modal_alert"><i class="fa fa-trash"></i></button>
										</div>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
						{!! $proveedors->render() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@include('layouts.modal_alert')
@include('proveedors.modal_form')
@endsection

@section('body')
@parent
<script>
	$(document).ready(function(){
		console.log('> document ready');
		/**
		 * Button Add
		 */
		$("#button_add").button().click(function(){
			console.log("> Clicked button_add");
                        $("input#modal_form-ident").removeAttr('disabled');
                        $('#modal_form').modal("show");
			$('#modal_form-title').text("Agregar");
			$('#modal_form-form').attr('action', '{!! action('ProveedorsController@create') !!}');
		});

		/**
		 * Button Delete
		 */
		$('#layouts_modal_alert').on('show.bs.modal', function (e) {
			console.log("> Clicked button_delete")
			proveedor = $(e.relatedTarget).parents("tr");
			$($('#layouts_modal_alert').find('.bg-warning')).text("Desea eliminar a " + proveedor.data("nombre").toUpperCase());
		});
		$('#layouts_modal_alert_acept').button().click(function(){
			$.ajax({ url: "{!! action("ProveedorsController@destroy") !!}", data: {"id" : proveedor.data("id")} })
				.done(function(){
					$('#layouts_modal_alert').modal('hide');
					$(proveedor).fadeOut();
				});
		});

		/**
		 * Button Edit
		 */
		$("#modal_form").on('show.bs.modal', function(e){
			if($(e.relatedTarget).data('name') == 'button_edit')
                        {
                                $("input#modal_form-ident").attr('disabled', 'disabled');

				console.log('Clicked button_edit');
				proveedor = $(e.relatedTarget).parents("tr");
				$("input#modal_form-id").val(proveedor.data("id"));
				$("input#modal_form-ident").val(proveedor.data("ident"));
				$("input#modal_form-nombre").val(proveedor.data("nombre"));
				$("input#modal_form-direccion").val(proveedor.data("direccion"));
				$("input#modal_form-email").val(proveedor.data("email"));
				$("input#modal_form-tlf").val(proveedor.data("tlf"));
				
				$('#modal_form-form').attr('action', '{!! action('ProveedorsController@update') !!}');
				$('#modal_form-title').text("Modificar");
			}
		});

	});

</script>
@endsection

