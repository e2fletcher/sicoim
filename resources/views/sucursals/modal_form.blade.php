<!-- layouts.alert.blade.php -->
<div class="modal fade" id="modal_form" tabindex="-1" role="dialog" aria-labelledby="modal_form">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="modal_form-title"><i class="fa fa-warning"></i> Title</h4>
			</div>
			<form id="modal_form-form" method="POST" role="form" data-toggle="validator">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="modal_form-ident">Codigo</label>
								<div class="row">
									<div class="col-md-3">
										<input type="number" name="ident" class="form-control" id="modal_form-ident" placeholder="000" required>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="modal_form-nombre">Nombre</label>
								<input type="text" name="nombre" class="form-control" id="modal_form-nombre" required>
							</div>
							<div class="form-group">
								<label for="modal_form-direccion">Direccion</label>
								<input type="text" name="direccion" class="form-control" id="modal_form-direccion" required>
							</div>
							<div class="form-group">
								<label for="modal_form-tlf">Telefono</label>
								<div class="row">
									<div class="col-md-4">
										<input type="text" pattern="^\+?\d{1,3}?[- .]?\(?(?:\d{2,3})\)?[- .]?\d\d\d[- .]?\d\d\d\d$" name="tlf" class="form-control" id="modal_form-tlf">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="modal_form-tlf">Coordenadas Geograficas</label>
								<div class="row">
									<div class="col-md-4">
										<input type="text"  pattern="^(\-?\d+(\.\d+)?),\w*(\-?\d+(\.\d+)?)$" name="coordenadas" class="form-control" id="modal_form-coordenadas" placeholder="00.0000,00.0000" required>
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
				<input type="hidden" id="modal_form-id" name="id"/>
			</form>
		</div>
	</div>
</div>

