<?php use Illuminate\Support\Str; ?>
@extends('layouts.master')
@section('content')
@parent
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-barcode"></i>
				 RECEPCION Nº 
				<span class="label label-default text-uppercase">
					{{ $recepcion->id }}
				</span>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-default">
							<div class="panel-heading"><i class="fa fa-truck"></i> Proveedor</div>
							<div class="panel-body">
								<ul class="list-group">
									<li class="list-group-item">Identificacion: <strong>{{ Str::upper($recepcion->proveedor->ident) }}</strong></li>
									<li class="list-group-item">Nombre: <strong>{{ Str::upper($recepcion->proveedor->nombre) }}</strong></li>
									<li class="list-group-item">Direccion: <strong>{{ Str::upper($recepcion->proveedor->direccion) }}</strong></li>
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
											<td>Caducidad</td>
										</tr>
									</thead>
									<tbody>
										@foreach($recepcion->detalles as $detalle)
											<tr>
												<td><span class="label label-default">{{ Str::upper($detalle->tipo->codigo) }}</span></td>
												<td>{{ Str::upper($detalle->tipo->nombre) }}</td>
												<td class="text-right"><span class="label label-warning">{{ $detalle->cantidad }}</span></td>
												<td>{{ $detalle->caducidad }}</td>
											</tr>
										@endforeach
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
