<?php 
$obra = find_by_id('obras','idobras',(int)$_GET['id']);
$planes_de_trabajo = planes_de_trabajo_obras($obra['idobras']);
$cotizaciones = cotizaciones_obras($obra['idobras']); ?>
<div class="modal fade" id="datos_certificados" tabindex="-1" role="dialog" aria-labelledby="datos_certificados" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100" id="datos_certificados">Datos para certificados</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form method="post" action="obra?id=<?php echo $obra['idobras'];?>">
      <div class="modal-body">
          <div class="card-body">
              <div class="form-group p-20">
              <div class="row p-t-20">
                <div class="col-md-6">
                    <div class="md-form form-md">
                      <label class="control-label">Plan de trabajo vigente <i class="fas fa-question-circle" data-toggle="tooltip" title="Plan de trabajo "></i></label>
                      <select class="form-control custom-select" name="plan_de_trabajo">
                  <optgroup label="Establecido">
                    <?php if($obra['idplanes_de_trabajo'] != '0' && $obra['idplanes_de_trabajo'] != NULL){ 
                      $plan = find_by_id('planes_de_trabajo','idplanes_de_trabajo',$obra['idplanes_de_trabajo']); ?>
                        <option selected value="<?php echo $obra['idplanes_de_trabajo']; ?>" selected >Plan N° <?php echo $plan['numero'].' - '.$plan['detalle']; ?></option>
                        <?php }else{ echo '<option selected value="0">No se ha asignado plan de trabajo</option>'; } ?>
                  </optgroup>
                  <optgroup label="Opciones ">
                      <?php foreach ($planes_de_trabajo as $p):?>
                        <option value="<?php echo $p['idplanes_de_trabajo']; ?>">N° <?php echo $p['numero'].' - '.$p['detalle'];; ?></option>
                      <?php endforeach; ?>
                  </optgroup>
                </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="md-form form-md">
                      <label class="control-label">Cotizacion vigente <i class="fas fa-question-circle" data-toggle="tooltip" title="Items de obra"></i></label>
                      <select class="form-control custom-select" name="cotizacion">
                  <optgroup label="Establecido">
                    <?php if($obra['idcotizaciones'] != '0' && $obra['idcotizaciones'] != NULL){ 
                      $coti = find_by_id('cotizaciones','idcotizaciones',$obra['idcotizaciones']);?>
                        <option selected value="<?php echo $obra['idcotizaciones']; ?>" selected >Cotizacion N° <?php echo $coti['numero'].' - '.$coti['detalle']; ?></option>
                        <?php }else{ echo '<option selected value="0">No se ha asignado cotizacion</option>'; } ?>
                  </optgroup>
                  <optgroup label="Opciones ">
                      <?php foreach ($cotizaciones as $c):?>
                        <option value="<?php echo $c['idcotizaciones']; ?>">N° <?php echo $c['numero'].' - '.$c['detalle']; ?></option>
                      <?php endforeach; ?>
                  </optgroup>
                </select>
                    </div>
                  </div>
                </div>

                <hr>

                <div class="row p-t-20">
                  <div class="col-md-6">
                    <div class="md-form form-md">
                      <label class="control-label">Monto contrato redeterminado <i class="fas fa-question-circle" data-toggle="tooltip" title="Monto de obra de ultima redeterminacion"></i></label>
                      <input type="number" name="monto_redeterminado" class="form-control" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" value="<?php echo $obra['monto_redeterminado'];?>">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="md-form f orm-md">
                      <label class="control-label">Observacion <i class="fas fa-question-circle" data-toggle="tooltip" title="Informacion de redeterminacion"></i></label>
                      <input type="text" name="info_redeterminacion" class="form-control" value="<?php echo $obra['info_redeterminacion'];?>">
                    </div>
                  </div>      
                </div> 

                <hr>
              <div class="row p-t-20">
                <div class="col-md-12">
                  <div class="md-form form-md">
                    <input type="checkbox" name="anticipo_financiero" value="1" id="basic_checkbox_4" class="filled-in" <?php if($obra['anticipo_financiero'] == 1){ echo 'checked'; }else{ echo 'unchecked'; };?>>
                    <label class="control-label" for="basic_checkbox_4">Anticipo financiero <i class="fas fa-question-circle" data-toggle="tooltip" title="Obra con anticipo y su valor en porcentaje"></i></label>
                    <input type="text" name="valor_anticipo_financiero" class="form-control" value="<?php echo $obra['valor_anticipo_financiero'];?>">
                  </div>
                </div>
                </div>
                <hr>
                   
              <div class="row p-t-20">

                <div class="col-md-12">
                    <div class="md-form form-md">
                      <label clasee="control-label">Vencimiento de certificados <i class="fas fa-question-circle" data-toggle="tooltip" title="Plazo de vencimiento de certificados expresados en dias"></i></label>
                      <input type="number" name="certificado_vencimiento" class="form-control" value="<?php echo $obra['certificado_vencimiento'];?>">
                    </div>
                  </div>
                  </div>
                <hr>
                   
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
          <button type="submit" name="datos_certificados" class="btn btn-info waves-effect waves-light">Guardar cambios</button>
      </div>
        </form>
    </div>
  </div>
</div>
</div>