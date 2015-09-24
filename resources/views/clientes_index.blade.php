@extends('layouts.master')
@section('content')
@parent
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">CLIENTES</div>
			<div class="panel-body">
				@if(isset($alert))
				<div class="row">
					<div class="col-md-12">
					@include('layouts.alert')
					</div>
				</div>
				@endif
				<div class="row">
					<div class="col-md-12">
						<form class="navbar-form navbar-left" role="search" action="{!! action('ClientesController@index')  !!}">
							<button type="button" class="btn btn-primary" id="button_add"><i class="fa fa-plus-square"></i> Agregar</button>
							<div class="form-group">
								<input type="text" name="search" class="form-control" placeholder="Cliente">
							</div>
							<button type="submit" id="button_search" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
						</form>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<table class="table table-hover">
							<thead>
								<tr>
									<th class="col-md-2">Identificación</th>
									<th class="col-md-4">Cliente</th>
									<th class="col-md-4">Dirección</th>
									<th class="col-md-2"></th>
								</tr>
							<tbody>
								@foreach ($clientes as $cliente)
								<tr
									data-id="{{ $cliente->id  }}"
									data-ident="{{ $cliente->ident }}"
									data-nombre="{{ $cliente->nombre }}"
									data-tipo="{{ $cliente->tipo }}"
									data-direccion="{{ $cliente->direccion }}"
									data-tlf="{{ $cliente->tlf }}"
									data-email="{{ $cliente->email }}">
									
									<td class="col-md-2 text-uppercase">{{ $cliente->ident }}</td>
									<td class="col-md-4 text-uppercase">{{ $cliente->nombre }}</td>
									<td class="col-md-4 text-uppercase">{{ $cliente->direccion }}</td>
									<td class="col-md-2 text-right">
										<button class="btn btn-default" type="button" data-name="button_edit" data-toggle="modal" data-target="#modal_form"><i class="fa fa-edit"></i></button>
										<button class="btn btn-warning" type="button" data-toggle="modal" data-target="#layouts_modal_alert"><i class="fa fa-trash"></i></button>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
							</thead>
						</table>
						{!! $clientes->render() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@include('layouts.modal_alert')
@include('clientes_modal_form')
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
			$('#modal_form').modal("show");
			$('#modal_form-title').text("Agregar");
			$('#modal_form-form').attr('action', '{!! action('ClientesController@create') !!}');
		});

		/**
		 * Button Delete
		 */
		$('#layouts_modal_alert').on('show.bs.modal', function (e) {
			console.log("> Clicked button_delete")
			cliente = $(e.relatedTarget).parents("tr");
			$($('#layouts_modal_alert').find('.bg-warning')).text("Desea eliminar a " + cliente.data("nombre").toUpperCase());
		});
		$('#layouts_modal_alert_acept').button().click(function(){
			$.ajax({ url: "{!! action("ClientesController@destroy") !!}", data: {"id" : cliente.data("id")} })
				.done(function(){
					$('#layouts_modal_alert').modal('hide');
					$(cliente).fadeOut();
				});
		});

		/**
		 * Button Edit
		 */
		$("#modal_form").on('show.bs.modal', function(e){
			if($(e.relatedTarget).data('name') == 'button_edit')
			{
				console.log('Clicked button_edit');
				cliente = $(e.relatedTarget).parents("tr");
				$("input#modal_form-id").val(cliente.data("id"));
				$("input#modal_form-ident").val(cliente.data("ident"));
				$("input#modal_form-nombre").val(cliente.data("nombre"));
				$("input#modal_form-direccion").val(cliente.data("direccion"));
				$("input#modal_form-email").val(cliente.data("email"));
				$("input#modal_form-tlf").val(cliente.data("tlf"));
				$("select#modal_form-tipo").val(cliente.data("tipo"));
				
				$('#modal_form-form').attr('action', '{!! action('ClientesController@update') !!}');
				$('#modal_form-title').text("Modificar");
			}
		});

	});

</script>
@endsection

