@extends('layouts.master')
@section('content')
@parent
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
					<span class="label label-default">VENTA Nº DE CONTROL:</span> 
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
								<div class="form-group col-md-5">
									<label class="sr-only" for=""></label>
									<div class="input-group">
										<div class="input-group-addon"><i class="fa fa-users"></i> Cliente</div>
										<input type="text" class="typeahead_clientes form-control" data-provide="typeahead">
										<div class="input-group-addon"><i class="fa fa-search"></i></div>
									</div>
								</div>
								<div class="form-group col-md-7">
									<label class="sr-only" for=""></label>
									<div class="input-group">
										<div class="input-group-addon"><i class="fa fa-bookmark-o"></i></div>
										<input type="text" class="form-control" id="cliente_nombre" disabled>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-12">
									<label class="sr-only" for=""></label>
									<div class="input-group">
										<div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
										<input type="text" class="form-control" id="cliente_direccion" disabled>
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
									<input type="text" class="typeahead_productos form-control" data-provide="typeahead">
									<div class="input-group-addon"><i class="fa fa-search"></i></div>
								</div>
							</div>
						</div>
						<form method="POST" id="venta_form" role="form" action="{!! action('VentasController@process') !!}">
							<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
							<input type="hidden" name="venta_id" value="{{ $newId }}" />
							<input type="hidden" id="cliente_id" name="cliente_id"/>
							<div class="row">
								<div class="col-md-12">
									<table id="table_productos" class="table table-hover">
										<thead></thead>
										<tbody></tbody>
									</table>
									<div class="row row_padding_button">
										<div class="col-md-12">
											<p><h4><span class="label label-warning">TOTAL: <strong class="venta_total">00.00</strong></span></h4></p>
										</div>
									</div>
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
@include('ventas.producto_modal_form')
@endsection

@section('body')
	@parent
	{!! Html::script('vendor/typeahead.js/dist/typeahead.jquery.js') !!}
	<!-- {!! Html::script('vendor/bootstrap3-typeahead/bootstrap3-typeahead.js') !!} -->
	{!! Html::script('vendor/typeahead.js/dist/bloodhound.js') !!}
<script>

	$(document).ready(function(){
		/**
		 * Busqueda de clientees
		 */
		var clientes = new Bloodhound({
			datumTokenizer: function (datum) {
				return Bloodhound.tokenizers.whitespace(datum.ident);
			},
			queryTokenizer: Bloodhound.tokenizers.whitespace,
			remote: {
				url: '{!! action('ClientesController@search') !!}?q=%QUERY',
				wildcard: '%QUERY'
			}
		});

		clientes.initialize();

		$('.typeahead_clientes').typeahead(null, {
			displayKey: 'ident',
			source: clientes.ttAdapter(),
			templates: {
				suggestion: function(cliente){
					return '<p><strong>' + cliente.ident.toUpperCase() + '</strong> - ' + cliente.nombre.toUpperCase() + '</p>';
				}
			}
		})
			.on('typeahead:selected', function(e, cliente) {
				$('button#button_process').removeAttr('disabled');
				$('input#cliente_id').val(cliente.id);
				$('input#cliente_nombre').val(cliente.nombre.toUpperCase());
				$('input#cliente_direccion').val(cliente.direccion.toUpperCase());	
		});

		/**
		 * Busqueda de productos
		 */
		var productos = new Bloodhound({
			datumTokenizer: function (datum) {
				return Bloodhound.tokenizers.whitespace(datum.nombre);
			},
			queryTokenizer: Bloodhound.tokenizers.whitespace,
			remote: {
				url: '{!! action('ProductosController@search') !!}?q=%QUERY',
				wildcard: '%QUERY',
				filter: function (productos) {
					return $.map(productos, function (producto) {
						$('.producto_codigo').each(function(i, e){
							if($(e).html().toLowerCase() == producto.codigo)
							{
								var cantidad = $($('.producto_cantidad')[i]).html();
								producto.stock = producto.stock - cantidad;
							}	
						
						});
						return {
							id: producto.id,
							codigo: producto.codigo,
							nombre: producto.nombre,
							precio: producto.precio,
							stock: producto.stock
						};
					});
				}
			}
		});

		productos.initialize();

		$('.typeahead_productos').typeahead(null, {
			displayKey: 'nombre',
			source: productos.ttAdapter(),
			templates: {
				suggestion: function(producto){
					return '<p><strong><i class="fa fa-barcode"></i> '
						+ producto.codigo.toUpperCase()
						+ '</strong> - '
						+ producto.nombre.toUpperCase()
						+ ' <strong>('
						+ producto.stock
						+ ')</strong></p>';
				}
			}
		})
			.on('typeahead:selected', function(e, producto) {
				$('#producto_modal_form').modal("show");
				$('#producto_modal_form_title').text(producto.codigo.toUpperCase());
				$('#producto_input_id').val(producto.id);
				$('#producto_input_codigo').val(producto.codigo);
				$('#producto_input_nombre').val(producto.nombre);
				$('#producto_input_precio').val(producto.precio);
				$('#producto_input_stock').val(producto.stock);
				//$('.typeahead_productos').val('');
			});

		/**
			* Manejo del evento agregar
			* producto a la lista de recepción
			* cuando se envia el formulario
		 */
		$("#producto_form").submit(function(e){
			e.preventDefault();
			var cantidad = $('#producto_input_cantidad').val();
			var stock = $('#producto_input_stock').val();
			var id = $('#producto_input_id').val();
			var codigo = $('#producto_input_codigo').val();
			var nombre = $('#producto_input_nombre').val();
			var precio = $('#producto_input_precio').val();
			console.log(stock - cantidad);
			if ((stock - cantidad) >= 0 && cantidad > 0)
			{
				$('#producto_modal_form').modal("hide");
				$('.typeahead_productos').val('').focus();
				/**
				 * Agregar producto a la lista de venta
				 */
				var row = $('#table_productos > tbody tr').length;
				if(row < 1)
				{
					$('table > thead').append([
						'<tr>',
							'<td>Cod</td>',
							'<td>Producto</td>',
							'<td>Cantidad</td>',
							'<td>Precio</td>',
							'<td>Subtotal</td>',
							'<td></td>',
						'</tr>'
					].join('\n'));
				}

				var producto = [
				'<tr class="productos_list">',
					'<td class="hidden"><input name="productos[' + row + '][id]" type="hidden" value="' + id + '">',
					'<td class="hidden"><input name="productos[' + row + '][precio]" type="hidden" value="' + precio  + '">',
					'<td class="hidden"><input name="productos[' + row  + '][cantidad]" type="hidden" value="' + cantidad  + '">',
					'<td><span class="label label-default producto_codigo">' + codigo.toUpperCase() + '</span></td>',
					'<td>' + nombre.toUpperCase() + '</td>',
					'<td>' + precio + '</td>',
					'<td><span class="label label-warning text-right producto_cantidad">' + cantidad + '</span></td>',
					'<td><span class="label label-warning text-right venta_subtotales">' + parseFloat(cantidad * precio) + '</span></td>',
					'<td><button id="button_delete" class="btn btn-default btn-xs" type="button"><i class="fa fa-trash"></i></button></td>',
				'</tr>'
				];
				$('table > tbody:last-child').append(producto.join('\n'));
				productos.clearRemoteCache();
				updateTotal();
			}
		});

		/**
		 * Borrar producto de la lista
		 */
		$('#table_productos').on('click', '.btn-xs', function(e){
			$(this).parents('tr').remove();

			var row = $('#table_productos > tbody tr').length;
			if(row < 1)
				$('table > thead tr').remove();
			updateTotal();
		});

		/**
		 * Enviar venta
		 */
		$("#venta_form").submit(function(e){
			var row = $('#table_productos > tbody tr').length;
			if(row > 0)
				this.submit();
			else
				e.preventDefault();
		});
		
		/**
		 * Focus producto_input_cantidad
		 */
		$("#producto_modal_form").on('show.bs.modal', function(e){
			$('#producto_input_cantidad').val('').focus();
		});
	});

	function updateTotal()
	{
		$('.venta_total').empty();
		var total = 0;
		$('.venta_subtotales').each(function(index, sub){
			total += parseFloat($(sub).html());
		});
		$('.venta_total').html(total);
	}

</script>
@endsection

@section('head')
	@parent
	{!! Html::style('vendor/typeahead.js-bootstrap3.less/typeaheadjs.css') !!}
@endsection
