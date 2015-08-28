<!-- layouts.alert.blade.php -->
<div class="modal fade" id="tipos_modal_form" tabindex="-1" role="dialog" aria-labelledby="tipos_modal_form">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="tipos_modal_form-title"><i class="fa fa-warning"></i> Title</h4>
			</div>
			<form id="tipos_modal_form-form" method="POST">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="tipos_modal_form-codigo">Codigo</label>
								<div class="row">
									<div class="col-md-4">
										<input type="text" name="codigo" class="form-control" id="tipos_modal_form-codigo" placeholder="AAAAAA-000">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="tipos_modal_form-nombre">Descripción</label>
								<input type="text" name="nombre" class="form-control" id="tipos_modal_form-nombre" placeholder="">
							</div>
							<div class="form-group">
								<label for="tipos_modal_form-tipo">Tipo</label>
								<div class="row">
									<div class="col-md-3">
										<select class="form-control" id="tipos_modal_form-tipo" name="tipo">
											<option value="casa">Casa</option>
											<option value="regional">Regional</option>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="tipos_modal_form-unidad">Unidad</label>
								<div class="row">
									<div class="col-md-4">
										<select class="form-control" id="tipos_modal_form-unidad" name="unidad">
											<option value="litros">Litros</option>
											<option value="kilos">Kilos</option>
											<option value="unidad">Unidad</option>
											<option value="paquete">Paquete</option>
											<option value="caja">Caja</option>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="tipos_modal_form-cantidad">Cantidad</label>
								<div class="row">
									<div class="col-md-4">
										<input type="text" name="cantidad" class="form-control" id="tipos_modal_form-cantidad">
									</div>
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
				<input type="hidden" name="id"/>
			</form>
		</div>
	</div>
</div>
	
