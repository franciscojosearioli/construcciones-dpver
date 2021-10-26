<?php $obra = find_by_id('obras','idobras',(int)$_GET['id']); 

$planes_de_trabajo = planes_de_trabajo_obras($obra['idobras']);
$cotizaciones = cotizaciones_obras($obra['idobras']);

?>
<div class="modal fade" id="montos_obra" tabindex="-1" role="dialog" aria-labelledby="montos_obra" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100" id="montos_obra">Datos vigentes</h4>
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
                    <?php if($obra['idplanes_de_trabajo'] != '0' && $obra['idplanes_de_trabajo'] != NULL){ ?>
                        <option selected value="<?php echo $obra['idplanes_de_trabajo']; ?>" selected >plan de trabajo activo</option>
                        <?php }else{ echo '<option selected value="0">No se ha asignado plan de trabajo</option>'; } ?>
                  </optgroup>
                  <optgroup label="Opciones ">
                      <?php foreach ($planes_de_trabajo as $p):?>
                        <option value="<?php echo $p['idplanes_de_trabajo']; ?>"><?php echo $p['numero']; ?></option>
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
                    <?php if($obra['idcotizaciones'] != '0' && $obra['idcotizaciones'] != NULL){ ?>
                        <option selected value="<?php echo $obra['idcotizaciones']; ?>" selected >cotizacion activo</option>
                        <?php }else{ echo '<option selected value="0">No se ha asignado cotizacion</option>'; } ?>
                  </optgroup>
                  <optgroup label="Opciones ">
                      <?php foreach ($cotizaciones as $c):?>
                        <option value="<?php echo $c['idcotizaciones']; ?>"><?php echo $c['numero']; ?></option>
                      <?php endforeach; ?>
                  </optgroup>
                </select>
                    </div>
                  </div>
                </div>


                <hr>
              <div class="row p-t-20">
                <div class="col-md-12">
                  <div class="md-form form-md">
                    <label class="control-label">Monto de obra contrato <i class="fas fa-question-circle" data-toggle="tooltip" title="Monto de contrato original"></i></label>
                    <input type="number" name="contrato_monto" class="form-control" step="any" value="<?php echo $obra['contrato_monto'];?>">
                  </div>
                </div>
                </div> 
                <hr>
                <div class="row p-t-20">
                  <div class="col-md-6">
                    <div class="md-form form-md">
                      <label class="control-label">Monto de obra vigente <i class="fas fa-question-circle" data-toggle="tooltip" title="Monto de obra en vigencia"></i></label>
                      <input type="number" name="monto_vigente" class="form-control" step="any" value="<?php echo $obra['monto_vigente'];?>" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="md-form form-md">
                      <label class="control-label">Observacion <i class="fas fa-question-circle" data-toggle="tooltip" title="Informacion del monto"></i></label>
                      <input type="text" name="monto_vigente_obs" class="form-control" value="<?php echo $obra['monto_vigente_obs'];?>">
                    </div>
                  </div>      
                </div> 
                <hr>
                <div class="row p-t-20">
                  <div class="col-md-6">
                    <div class="md-form form-md">
                      <label class="control-label">Plazo de ejecucion vigente <i class="fas fa-question-circle" data-toggle="tooltip" title="Plazo de ejecucion de obra en vigencia"></i></label>
                      <input type="text" name="plazo_vigente" class="form-control" value="<?php echo $obra['plazo_vigente'];?>" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="md-form form-md">
                      <label class="control-label">Observacion <i class="fas fa-question-circle" data-toggle="tooltip" title="Informacion del plazo"></i></label>
                      <input type="text" name="plazo_vigente_obs" class="form-control" value="<?php echo $obra['plazo_vigente_obs'];?>">
                    </div>
                  </div>      
                </div> 
                <hr>
                <div class="row p-t-20">
                  <div class="col-md-6">
                    <div class="md-form form-md">
                      <label class="control-label">Monto contrato redeterminado <i class="fas fa-question-circle" data-toggle="tooltip" title="Monto de obra de ultima redeterminacion"></i></label>
                      <input type="number" name="monto_redeterminado" class="form-control" step="any" value="<?php echo $obra['monto_redeterminado'];?>">
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
                    <div class="md-form">
                      <label class="control-label">Memoria descriptiva vigente <i class="fas fa-question-circle" data-toggle="tooltip" title="Memoria descriptiva en vigencia"></i></label>
                      <textarea name="memoria_descriptiva_vigente"  id="memoria_vigente_datos" class="form-control" rows="8" required><?php echo $obra['memoria_descriptiva_vigente'];?></textarea>
                    </div>
                  </div>
                </div> 
              </div>
            </div>
          </div>
        <div class="modal-footer">
          <button type="submit" name="montos_obra" class="btn btn-info waves-effect waves-light">Guardar cambios</button>
      </div>
        </form>
    </div>
  </div>
</div>
</div>