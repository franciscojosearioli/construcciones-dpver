<?php
$obra = find_by_id('obras','idobras',(int)$_GET['id']);  
?>
<div class="modal fade" id="valor_multa" tabindex="-1" role="dialog" aria-labelledby="valor_multa" aria-hidden="true">
	<div class="modal-dialog modal-md" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title w-100" id="valor_multa">Margen de multa</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" action="obra?id=<?php echo (int)$_GET['id']; ?>">        
				<div class="modal-body">
					<div class="card-body">
						<div class="form-group p-20">
							<div class="row p-t-20">
								<div class="col-md-12">
									<div class="md-form form-md">
										<label class="control-label">Valor de multa</label>
										<input type="number" name="valor_multa" step="any" pattern="^\d+(?:\.\d{1,2})?$" class="form-control" value="<?php echo $obra['valormulta'] ?>" required>
									</div>
								</div>                       
							</div>
						</div>         
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" name="edit_valor_multa" class="btn btn-info waves-effect waves-light">Guardar cambios</button>
				</div>
			</form>
		</div>
	</div>
</div>