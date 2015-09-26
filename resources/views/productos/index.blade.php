<?php use Illuminate\Support\Str; ?>
@extends('layouts.master')
@section('content')
@parent
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<i class="fa fa-barcode"></i>
				 INVENTARIO 
				<span class="label label-default text-uppercase">
					{{ Str::upper(Auth::user()->sucursal->nombre) }}
				</span>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">
						<table class="table table-hover">
							<thead>
								<tr>
									<th>Código</th>
									<th>Nombre</th>
									<th class="text-right">Precio</th>
									<th class="text-right">Stock</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($productos as $producto)
								<tr>
									<td class="col-md-2"><i class="fa fa-barcode"></i> {{ Str::upper($producto->codigo) }}</td>
									<td class="col-md-2">{{ Str::upper($producto->nombre) }}</td>
									<td class="col-md-2 text-right">{{ $producto->precio }}</td>
									<td class="col-md-2 text-right"><span class="label label-warning">{{ $producto->stock }}</span></td>
								</tr>
								@endforeach
							</tbody>
						</table>
						{!! $productos->render() !!}
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
		});
	</script>
@endsection
