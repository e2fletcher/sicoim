<?php use Illuminate\Support\Str; ?>
@extends('layouts.master')
@section('content')
@parent
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-barcode"></i>
				 VENTA Nº 
				<span class="label label-default text-uppercase">
					{{ $venta->id }}
				</span>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-default">
							<div class="panel-heading"><i class="fa fa-users"></i> Cliente</div>
							<div class="panel-body">
								<ul class="list-group">
									<li class="list-group-item">Identificacion: <strong>{{ Str::upper($venta->cliente->ident) }}</strong></li>
									<li class="list-group-item">Nombre: <strong>{{ Str::upper($venta->cliente->nombre) }}</strong></li>
									<li class="list-group-item">Direccion: <strong>{{ Str::upper($venta->cliente->direccion) }}</strong></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-default">
							<div class="panel-heading"><i class="fa fa-barcode"></i> Productos</div>
							<div class="panel-body">
								<table class="table table-hover">
									<thead>
										<tr>
											<td>Codigo</td>
											<td>Nombre</td>
											<td class="text-right">Cantidad</td>
											<td class="text-right">Precio</td>
											<td class="text-right">Subtotal</td>
										</tr>
									</thead>
									<tbody>
										<?php $total = 0 ?>
										@foreach($venta->detalles as $detalle)
											<tr>
												<?php
													$subtotal = $detalle->cantidad * $detalle->precio;
													$total += $subtotal;
												?>
												<td><span class="label label-default">{{ Str::upper($detalle->producto->tipo->codigo) }}</span></td>
												<td>{{ Str::upper($detalle->producto->tipo->nombre) }}</td>
												<td class="text-right">{{ $detalle->cantidad }}</td>
												<td class="text-right">{{ $detalle->precio }}</td>
												<td class="text-right">{{ $subtotal }}</span></td>
											</tr>
											@endforeach
											<tr>
												<td></td>
												<td></td>
												<td></td>
												<td class="text-right">TOTAL: </td>
												<td class="text-right"><span class="label label-warning">{{ $total }}</span></td>
											</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row hidden-print row-padding-button row_padding_button">
	<div class="col-md-12 text-center">
		<button class="btn btn-default" type="button" id="button-print"><i class="fa fa-print"></i> Imprimir</button>
	</div>
</div>
@endsection

@section('body')
	@parent
	<script>
		$(document).ready(function(){
			$('#button-print').click(function(){
				window.print();
			});
			window.print();
		});
	</script>
@endsection
