@extends('layouts.master')
@section('content')
@parent
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
					<span class="label label-default">RECEPCIÓN Nº DE CONTROL:</span> 
					<span class="label label-danger">{{ $newId  }}</span>
			</div>
			<div class="panel-body">
				<div class="panel panel-default">
                                        <div class="panel-body">
                                                @include('layouts.errors')
						@if(isset($alert))
						<div class="row">
							<div class="col-md-12">
							@include('layouts.alert')
							</div>
						</div>
						@endif
						<form class="form-inline">
							<div class="row row_padding_button">
								<div class="form-group col-lg-5">
									<label class="sr-only" for=""></label>
									<div class="input-group">
										<div class="input-group-addon"><i class="fa fa-truck"></i> Proveedor</div>
										<input type="text" class="typeahead_proveedors form-control" data-provide="typeahead">
										<div class="input-group-addon"><i class="fa fa-search"></i></div>
									</div>
								</div>
								<div class="form-group col-md-7">
									<label class="sr-only" for=""></label>
									<div class="input-group">
										<div class="input-group-addon"><i class="fa fa-bookmark-o"></i></div>
										<input type="text" class="form-control" id="proveedor_nombre" disabled>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-12">
									<label class="sr-only" for=""></label>
									<div class="input-group">
										<div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
										<input type="text" class="form-control" id="proveedor_direccion" disabled>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="row">
							<div class="form-group col-md-6">
								<label class="sr-only" for=""></label>
								<div class="input-group">
									<div class="input-group-addon"><i class="fa fa-barcode"></i> Producto</div>
									<input type="text" class="typeahead_tipos form-control" data-provide="typeahead">
									<div class="input-group-addon"><i class="fa fa-search"></i></div>
								</div>
							</div>
						</div>
						<form method="POST" id="recepcion_form" role="form" action="{!! action('RecepcionsController@process') !!}">
							<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
							<input type="hidden" name="recepcion_id" value="{{ $newId }}" />
							<input type="hidden" id="proveedor_id" name="proveedor_id"/>
							<div class="row">
								<div class="col-md-12">
									<table id="table_productos" class="table table-hover">
										<tbody></tbody>
									</table>
								</div>
							</div>
							<div class="row">
								<div class="text-right col-md-12">
									<button type="submit" id="button_process" class="btn btn-default" disabled="disabled"><i class="fa fa-gears"></i> Procesar</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@include('recepcions.producto_modal_form')
@endsection

@section('body')
	@parent
	{!! Html::script('vendor/typeahead.js/dist/typeahead.jquery.js') !!}
	<!-- {!! Html::script('vendor/bootstrap3-typeahead/bootstrap3-typeahead.js') !!} -->
	{!! Html::script('vendor/typeahead.js/dist/bloodhound.js') !!}
<script>

		$(document).ready(function(){
		/**
		 * Busqueda de proveedores
		 */
		var proveedors = new Bloodhound({
			datumTokenizer: function (datum) {
				return Bloodhound.tokenizers.whitespace(datum.ident);
			},
			queryTokenizer: Bloodhound.tokenizers.whitespace,
			remote: {
				url: '{!! action('ProveedorsController@search') !!}?q=%QUERY',
				wildcard: '%QUERY'
				// Para escudriñar en la data del json
				/*filter: function (proveedors) {
					console.log(proveedors.data);
					return $.map(proveedors, function (proveedor) {
						return {
							id: proveedor.id,
							ident: proveedor.ident,
							nombre: proveedor.nombre,
							tlf: proveedor.tlf,
							direccion: proveedor.direccion
						};
					});
				}*/
			}
			});

		proveedors.initialize();

		$('.typeahead_proveedors').typeahead(null, {
			displayKey: 'ident',
			source: proveedors.ttAdapter(),
			templates: {
				suggestion: function(proveedor){
					return '<p><strong>' + proveedor.ident.toUpperCase() + '</strong> - ' + proveedor.nombre.toUpperCase() + '</p>';
				}
			}
		})
			.on('typeahead:selected', function(e, proveedor) {
				$('button#button_process').removeAttr('disabled');
				$('input#proveedor_id').val(proveedor.id);
				$('input#proveedor_nombre').val(proveedor.nombre.toUpperCase());
				$('input#proveedor_direccion').val(proveedor.direccion.toUpperCase());	
				console.log(proveedor);
		});

		/**
		 * Busqueda de tipos
		 */
		var tipos = new Bloodhound({
			datumTokenizer: function (datum) {
				return Bloodhound.tokenizers.whitespace(datum.nombre);
			},
			queryTokenizer: Bloodhound.tokenizers.whitespace,
			remote: {
				url: '{!! action('TiposController@search') !!}?q=%QUERY',
				wildcard: '%QUERY'
			}
		});

		tipos.initialize();

		$('.typeahead_tipos').typeahead(null, {
			displayKey: 'nombre',
			source: tipos.ttAdapter(),
			templates: {
				suggestion: function(tipo){
					return '<p><strong><i class="fa fa-barcode"></i> '
						+ tipo.codigo.toUpperCase()
						+ '</strong> - '
						+ tipo.nombre.toUpperCase()
						+ ' | '
						+ tipo.presentacion
						+ '</p>';
				}
			}
		})
			.on('typeahead:selected', function(e, tipo) {
				$('#producto_modal_form').modal("show");
				$('#producto_modal_form_title').text(tipo.codigo.toUpperCase());
				$('#producto_input_tipo_id').val(tipo.id);
				$('#producto_input_tipo_codigo').val(tipo.codigo);
				$('#producto_input_tipo_nombre').val(tipo.nombre);
				$('#producto_input_tipo_precio').val(tipo.precio);
				//$('.typeahead_tipos').val('');
			});

		/**
			* Manejo del evento agregar
			* producto a la lista de recepción
			* cuando se envia el formulario
		 */
		$("#producto_form").submit(function(e){
			e.preventDefault();
			if ($('#producto_input_cantidad').val())
			{
				$('#producto_modal_form').modal("hide");
				$('.typeahead_tipos').val('').focus();
				/**
				 * Agregar producto a la lista de recepcion
				 */
				var row = $('#table_productos > tbody tr').length;

				var producto = [
				'<tr>',
					'<td class="hidden"><input name="productos[' + row + '][tipo_id]" type="hidden" value="' + $('#producto_input_tipo_id').val() + '">',
					'<td class="hidden"><input name="productos[' + row + '][tipo_precio]" type="hidden" value="' + $('#producto_input_tipo_precio').val()  + '">',
					'<td class="hidden"><input name="productos[' + row  + '][cantidad]" type="hidden" value="' + $('#producto_input_cantidad').val()  + '">',
					'<td class="hidden"><input name="productos[' + row  + '][caducidad]" type="hidden" value="' + $('#producto_input_caducidad').val()  + '">',
					'<td><span class="label label-default">' + $('#producto_input_tipo_codigo').val().toUpperCase() + '</span></td>',
					'<td>' + $('#producto_input_tipo_nombre').val().toUpperCase() + '</td>',
					'<td>' + $('#producto_input_caducidad').val().toUpperCase() + '</td>',
					'<td><span class="badge">' + $('#producto_input_cantidad').val().toUpperCase() + '</span></td>',
					'<td><button id="button_delete" class="btn btn-default btn-xs" type="button"><i class="fa fa-trash"></i></button></td>',
				'</tr>'
				];
				$('table > tbody:last-child').append(producto.join('\n'));
				tipos.clearRemoteCache();
			}
		});

		/**
		 * Borrar producto de la lista
		 */
		$('#table_productos').on('click', '.btn-xs', function(e){
			$(this).parents('tr').remove();
		});

		/**
		 * Enviar recepcion
		 */
		$("#recepcion_form").submit(function(e){
			var row = $('#table_productos > tbody tr').length;
			if(row > 0)
				this.submit();
			else
				e.preventDefault();
		});


	});


</script>
@endsection

@section('head')
	@parent
	{!! Html::style('vendor/typeahead.js-bootstrap3.less/typeaheadjs.css') !!}
@endsection
