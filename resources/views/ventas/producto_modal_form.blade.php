<!-- layouts.alert.blade.php -->
<div class="modal fade" id="producto_modal_form" tabindex="-1" role="dialog" aria-labelledby="modal_form">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="producto_modal_form_title"></h4>
			</div>
			<form id="producto_form" role="form" data-toggle="validator" action="#">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="row">
								<div class="form-group col-md-8">
									<label for="producto_input_cantidad">Cantidad</label>
									<input type="number" class="form-control" id="producto_input_cantidad" required>
								</div>
								<div class="form-group col-md-4">
									<label for="producto_input_stock">Stock</label>
									<input type="number" class="form-control" id="producto_input_stock" disabled="disabled">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-primary">Agregar</button>
				</div>
				<input type="hidden" id="producto_input_id">
				<input type="hidden" id="producto_input_codigo">
				<input type="hidden" id="producto_input_nombre">
				<input type="hidden" id="producto_input_precio">
			</form>
		</div>
	</div>
</div>
