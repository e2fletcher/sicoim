@extends('layouts.master')
@section('content')
@parent
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading"><i class="fa fa-barcode"></i> LISTA DE PRODUCTOS</div>
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
							<div class="form-group">
								<input type="text" name="search" class="form-control" placeholder="Tipo de producto">
							</div>
							<button class="btn btn-default" type="submit" id="button_search"><i class="fa fa-search"></i></button>
							<button class="btn btn-default" type="button" id="index-buttonadd"><i class="fa fa-plus-square"></i> Agregar</button>
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
									<th>Presentacion</th>
									<th>Cantidad</th>
									<th class="text-right">Precio</th>
									<th></th>
								</tr>
							<tbody>
								@foreach ($tipos as $tipo)
								<tr
									data-id="{{ $tipo->id  }}"
									data-codigo="{{ $tipo->codigo }}"
									data-nombre="{{ $tipo->nombre }}"
									data-origen="{{ $tipo->origen }}"
									data-generic_tipo="{{ $tipo->generic_tipo }}"
									data-presentacion="{{ $tipo->presentacion }}"
									data-unidad="{{ $tipo->unidad }}"
									data-cantidad="{{ $tipo->cantidad }}"
									data-precio="{{ $tipo->precio }}"
								>
									<td class="col-md-2"><i class="fa fa-barcode"></i> {{ $tipo->codigo }}</td>
									<td class="col-md-2">{{ $tipo->nombre }}</td>
									<td class="col-md-2">{{ $tipo->origen }}</td>
									<td class="col-md-2">{{ $tipo->presentacion }}</td>
									<td class="col-md-1">{{ $tipo->cantidad }}</td>
									<td class="col-md-1 text-right">{{ $tipo->precio }}</td>
									<td class="col-md-2 text-right">
										<button class="btn btn-default" type="button" data-name="index-buttonedit" data-toggle="modal" data-target="#tipo_modal_form"><i class="fa fa-edit"></i></button>
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
@include('tipos.modal_form')
@include('layouts.modal_alert')
@endsection

@section('body')
@parent
<script>
	var tipo;

	$(document).ready(function(){
		$("#index-buttonadd").button().click(function(){
			$('#tipo_modal_form').modal("show");
			$('#tipo_modal_form_title').text("Agregar");
			$('#tipo_modal_form_form').attr('action', '{!! action('TiposController@create') !!}');
		});
		
		$("#tipo_modal_form").on('show.bs.modal', function(e){
			if($(e.relatedTarget).data('name') == 'index-buttonedit')
			{
				tipo = $(e.relatedTarget).parents("tr");

				$("input#tipo_modal_form_id").val(tipo.data("id"));
				$("input#tipo_modal_form_codigo").val(tipo.data("codigo"));
				$("input#tipo_modal_form_nombre").val(tipo.data("nombre"));
				$("select#tipo_modal_form_origen").val(tipo.data("origen"));
				$("select#tipo_modal_form_generic_tipo").val(tipo.data("generic_tipo"));
				$("select#tipo_modal_form_presentacion").val(tipo.data("presentacion"));
				$("select#tipo_modal_form_unidad").val(tipo.data("unidad"));
				$("input#tipo_modal_form_cantidad").val(tipo.data("cantidad"));
				$("input#tipo_modal_form_precio").val(tipo.data("precio"));

				$('#tipo_modal_form_form').attr('action', '{!! action('TiposController@update') !!}');
				$('#tipo_modal_form_title').text("Modificar");
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
