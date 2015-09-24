<div class="modal fade" id="consulta_modal_form" tabindex="-1" role="dialog" aria-labelledby="modal_form">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="consultas_modal_form_title">Consultar</h4>
			</div>
			<form id="consulta_form" role="form" data-toggle="validator">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="row">
								<div class="form-group col-md-12">
									<label for="consultas_input_fecha">Fecha</label>
									<input type="text" name="date" class="form-control" id="consulta_input_fecha" data-provide="datepicker" data-date-format="dd/mm/yyyy">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-primary">Consular</button>
				</div>
			</form>
		</div>
	</div>
</div>
