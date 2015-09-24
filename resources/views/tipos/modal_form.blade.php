<!-- layouts.alert.blade.php -->
<div class="modal fade" id="tipo_modal_form" tabindex="-1" role="dialog" aria-labelledby="modal_form">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="tipo_modal_form_title"><i class="fa fa-warning"></i> Title</h4>
			</div>
			<form id="tipo_modal_form_form" method="POST" data-toggle="validator" role="form">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="row">
								<div class="form-group col-md-6">
									<label for="tipo_modal_form_codigo">Codigo</label>
									<input type="text" name="codigo" class="form-control" id="tipo_modal_form_codigo">
								</div>	
								<div class="form-group col-md-6">
									<label for="tipo_modal_form_generic_tipo">Tipo generico</label>
									<select name="generic_tipo" class="form-control" id="tipo_modal_form_generic_tipo">
										@include('tipos.generic_tipo')
									</select>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-12">
									<label for="tipo_modal_form_nombre">Nombre</label>
									<input type="text" name="nombre" class="form-control" id="tipo_modal_form_nombre" required>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-8">
									<label for="tipo_modal_form_origen">Origen</label>
									<select class="form-control" id="tipo_modal_form_origen" name="origen" required>
										@include('tipos.origen')
									</select>
								</div>
								<div class="form-group col-md-4">
									<label for="tipo_modal_form_precio">Precio</label>
									<input type="text" class="form-control" id="tipo_modal_form_precio" name="precio" required>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-5">
									<label for="tipo_modal_form_presentacion">Presentacion</label>
									<select class="form-control" id="tipo_modal_form_presentacion" name="presentacion" required>
										@include('tipos.presentacion')
									</select>
								</div>
								<div class="form-group col-md-2">
									<label for="tipo_modal_form_cantidad">Cantidad</label>
									<input type="integer" name="cantidad" class="form-control" id="tipo_modal_form_cantidad"  value="1" required>
								</div>
								<div class="form-group col-md-5">
									<label for="tipo_modal_form_unidad">Unidad</label>
									<select class="form-control" id="tipo_modal_form_unidad" name="unidad" required>
										@include('tipos.unidad')
									</select>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-primary">Guardar</button>
				</div>
				<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
				<input type="hidden" id="tipo_modal_form_id" name="id"/>
			</form>
		</div>
	</div>
</div>

