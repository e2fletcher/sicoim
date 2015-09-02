@extends('layouts.master')
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">LISTA DE PRODUCTOS</div>
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
						<form class="navbar-form navbar-left" role="search" action="{!! action('TiposController@index')  !!}">
							<button type="button" class="btn btn-primary" id="tipos_index-buttonadd"><i class="fa fa-plus-square"></i> Agregar</button>
							<div class="form-group">
								<input type="text" name="search" class="form-control" placeholder="Tipo de Producto">
							</div>
							<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
						</form>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<table class="table table-hover">
							<thead>
								<tr>
									<th>Código</th>
									<th>Nombre</th>
									<th>Origen</th>
									<th>Unidad</th>
									<th>Cantidad</th>
									<th></th>
								</tr>
							<tbody>
								@foreach ($tipos as $tipo)
								<tr data-id="{{ $tipo->id  }}" data-nombre="{{ $tipo->nombre }}" data-codigo="{{ $tipo->codigo }}" data-origen="{{ $tipo->origen }}" data-unidad="{{ $tipo->unidad }}" data-cantidad="{{ $tipo->cantidad }}">
									<td class="col-md-2 text-uppercase">{{ $tipo->codigo }}</td>
									<td class="col-md-3 text-uppercase">{{ $tipo->nombre }}</td>
									<td class="col-md-2 text-uppercase">{{ $tipo->origen }}</td>
									<td class="col-md-2 text-uppercase">{{ $tipo->unidad }}</td>
									<td class="col-md-1 text-uppercase text-right">{{ $tipo->cantidad }}</td>
									<td class="col-md-2 text-right">
										<button class="btn btn-default" type="button" data-name="tipos_index-buttonedit" data-toggle="modal" data-target="#tipos_modal_form"><i class="fa fa-edit"></i></button>
										<button class="btn btn-warning" type="button" data-toggle="modal" data-target="#layouts_modal_alert"><i class="fa fa-trash"></i></button>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
							</thead>
						</table>
						{!! $tipos->render() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@include('tipos_modal_form')
@include('layouts.modal_alert')
@endsection

@section('body')
<script>
	var tipo;

	$(document).ready(function(){
		$("#tipos_index-buttonadd").button().click(function(){
			$('#tipos_modal_form').modal("show");
			$('#tipos_modal_form-title').text("Agregar tipo de producto");
			$('#tipos_modal_form-form').attr('action', '{!! action('TiposController@create') !!}');
		});
		
		$("#tipos_modal_form").on('show.bs.modal', function(e){
			if($(e.relatedTarget).data('name') == 'tipos_index-buttonedit')
			{
				tipo = $(e.relatedTarget).parents("tr");
				$("input#tipos_modal_form-id").val(tipo.data("id"));
				$("input#tipos_modal_form-codigo").val(tipo.data("codigo"));
				$("input#tipos_modal_form-nombre").val(tipo.data("nombre"));
				$("select#tipos_modal_form-unidad").val(tipo.data("unidad"));
				$("input#tipos_modal_form-cantidad").val(tipo.data("cantidad"));
				$("select#tipos_modal_form-origen").val(tipo.data("origen"));
				
				$('#tipos_modal_form-form').attr('action', '{!! action('TiposController@update') !!}');
				$('#tipos_modal_form-title').text("Modificar tipo de producto");
			}
		});

		$('#layouts_modal_alert').on('show.bs.modal', function (e) {
			tipo = $(e.relatedTarget).parents("tr");
			$($('#layouts_modal_alert').find('.bg-warning')).text("Desea eliminar a " + tipo.data("nombre"));
			//console.log($('#layouts-modal_alert > div > div > div')[2]);
		});

		$($('#layouts_modal_alert').find("button")[2]).button().click(function(){
			$.ajax({
			url: "{!! action("TiposController@destroy") !!}",
				data: {"id" : tipo.data("id")}
			})
				.done(function(){
					$('#layouts_modal_alert').modal('hide');
					$(tipo).fadeOut();
				})
				.fail(function(){
				
				});
		});
	});
</script>
@endsection
