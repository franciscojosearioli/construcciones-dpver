<?php $obra = find_by_id('obras','idobras',(int)$_GET['id']); ?>
<div class="modal fade" id="avance_obra" tabindex="-1" role="dialog" aria-labelledby="avance_obra" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100" id="avance_obra">Avance de obra</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form method="post" action="obra?id=<?php echo $obra['idobras'];?>" enctype="multipart/form-data">
      <div class="modal-body">
          <div class="card-body">
              <div class="form-group p-20">
                <!--<div class="row">
                  <div class="col-md-6">
                    <div class="md-form form-md">
                      <label class="control-label">Monto vigente</label>
                      <input type="number" name="monto_vigente" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" class="form-control" value="<?php echo $obra['monto_vigente'];?>" required>
                      <small class="form-control-feedback"> En pesos argentinos. </small>
                    </div>
                  </div>                  
                  <div class="col-md-6">
                    <div class="md-form form-md">
                      <label class="control-label">Plazo vigente</label>
                      <input type="text" name="plazo_vigente" class="form-control" value="<?php echo $obra['plazo_vigente'];?>" required>
                      <small class="form-control-feedback"> Total. </small>
                    </div>
                  </div>      
                </div>
                <div class="row p-t-20">
                  <div class="col-md-6">
                    <div class="md-form form-md">
                      <label class="control-label">Monto actualizado</label>
                      <input type="number" name="monto_redeterminado" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" class="form-control" value="<?php echo $obra['monto_redeterminado'];?>" required>
                      <small class="form-control-feedback"> En pesos argentinos. </small>
                    </div>
                  </div>                  
                  <div class="col-md-6">
                    <div class="md-form form-md">
                      <label class="control-label">&nbsp;</label>
                      <input type="text" name="info_redeterminacion" class="form-control" value="<?php echo $obra['info_redeterminacion'];?>" required>
                      <small class="form-control-feedback"> Informacion de adecuacion. </small>
                    </div>
                  </div>      
                </div>
                <hr>-->
                <div class="row p-20 justify-content-center">       
                <h5><b>AVANCE DE OBRA</b></h5>
              </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="md-form form-md">
                      <label class="control-label">Numero <i class="fas fa-question-circle" data-toggle="tooltip" title="Numero de ultimo certificado"></i></label>
                      <input type="text" name="certificado_numero" class="form-control" value="<?php echo $obra['certificado_numero'];?>">
                    </div>
                  </div>                  
                  <div class="col-md-4">
                    <div class="md-form form-md">
                      <label class="control-label">Fecha <i class="fas fa-question-circle" data-toggle="tooltip" title="Fecha del ultimo certificado"></i></label>
                      <input type="text" name="certificado_fecha" class="form-control" value="<?php echo $obra['certificado_fecha'];?>">
                    </div>
                  </div>     
                  <div class="col-md-4">
                    <div class="md-form form-md">
                      <label class="control-label">Porcentaje <i class="fas fa-question-circle" data-toggle="tooltip" title="Porcentaje de avance"></i></label>
                      <input type="text" name="certificado_porcentaje" class="form-control" value="<?php echo $obra['certificado_porcentaje'];?>">
                    </div>
                  </div>   
                </div>
                  <div class="row p-t-20">
                    <div class="col-md-6">
                      <div class="md-form form-md">
                      <label class="control-label">Monto ejecutado <i class="fas fa-question-circle" data-toggle="tooltip" title="Monto de ejecucion de obra a precios base"></i></label>
                        <input type="text" name="certificado_monto" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" class="form-control" value="<?php echo $obra['certificado_monto'];?>">
                      </div>
                    </div> 
                    <div class="col-md-6">
                      <div class="md-form form-md">
                      <label class="control-label">Plazo transcurrido <i class="fas fa-question-circle" data-toggle="tooltip" title="Plazo transcurrido del certificado"></i></label>
                        <input type="text" name="certificado_plazo" class="form-control" value="<?php echo $obra['certificado_plazo'];?>">
                      </div>
                    </div> 
                  </div>
<hr>
                <div class="row p-20 justify-content-center">
<h5><b>ULTIMO CERTIFICADO DE OBRA</b> </h5> <i class="fas fa-question-circle" data-toggle="tooltip" title="Certificado de obra en pdf"></i>
</div>
                <div class="row">
                    <div class="col-lg-12 col-md-12">
<input type="file" name="certificado" id="input-file-now-custom-1" class="dropify-es" 
  <?php if(!empty($obra['certificado_archivo'])){ ?> data-default-file="<?php echo '../../../uploads/Obras/'.$obra['numero'].'/Certificacion/Ultimo/Certificado_'.$obra['certificado_archivo']; ?>" <?php } ?> />
<input type="text" name="obra_id" value="<?php echo $obra['idobras'];?>" hidden>
<input type="text" name="caja" value="<?php echo $obra['numero'];?>" hidden>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" name="avance_obra" class="btn btn-info waves-effect waves-light">Guardar cambios</button>
      </div>
        </form>
    </div>
  </div>
</div>
</div>