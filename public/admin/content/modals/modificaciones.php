<?php $obra_modificaciones = obra_modificaciones((int)$_GET['id']); ?>
<div class="modal fade" id="modificaciones" tabindex="-1" role="dialog" aria-labelledby="modificaciones" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100" id="modificaciones">Modificaciones de obra</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="obra.php?id=<?php echo (int)$_GET['id']; ?>">
        <div class="modal-body">
          <div class="form-group p-20">
            <div class="row p-20 justify-content-center">       
              <h5><b>MODIFICACIONES DE OBRA </b></h5>
            </div>     
            <?php foreach($obra_modificaciones as $obra): ?>                   
            <div class="row p-t-20">
              <div class="col-md-12">
                <label class="control-label">Estado del tramite <i class="fas fa-question-circle" data-toggle="tooltip" title="Pasos del procedimiento administrativo"></i></label>
                <select class="form-control custom-select" name="estado[]">
                  <optgroup label="Establecido">
                    <?php if($obra['estado'] == 0){ echo '<option value="0" selected>Sin definir</option>'; }
                    if($obra['estado'] == 1){ echo '<option value="1" selected>1. Confeccion Inspeccion</option>';}
                    if($obra['estado'] == 2){ echo '<option value="2" selected>2. Revision Dpto. II Obras por contrato</option>';}
                    if($obra['estado'] == 3){ echo '<option value="3" selected>3. Autorizando Ing. Jefe</option>';}
                    if($obra['estado'] == 4){ echo '<option value="4" selected>4. Encuadre Legal</option>';}
                    if($obra['estado'] == 5){ echo '<option value="5" selected>5. Imputacion del gasto</option>';}
                    if($obra['estado'] == 6){ echo '<option value="6" selected>6. Confeccionando resolucion</option>';}
                    if($obra['estado'] == 7){ echo '<option value="7" selected>7. Resolucion aprobada</option>';} ?>
                  </optgroup>
                  <optgroup label="Opciones ">
                    <option value="0">CANCELADO</option>
                    <option value="1">1. Confeccion Inspeccion</option>
                    <option value="2">2. Revision Dpto. II Obras por contrato</option>
                    <option value="3">3. Autorizando Ing. Jefe</option>
                    <option value="4">4. Encuadre Legal</option>
                    <option value="5">5. Imputacion del Gasto</option>
                    <option value="6">6. Confeccionando Resolucion</option>
                    <option value="7">7. Resolucion aprobada</option>
                  </optgroup>
                </select>
              </div> 
              </div>
              <div class="row p-t-20">
              <div class="col-md-6">
                <div class="md-form form-md">
                  <label class="control-label">Mayor gasto <i class="fas fa-question-circle" data-toggle="tooltip" title="Monto de gasto mayor"></i></label>
                  <input type="number" name="monto[]" class="form-control" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" value="<?php echo $obra['monto'];?>" required>
                </div>
              </div> 
              <div class="col-md-6">
                <div class="md-form form-md">
                  <label class="control-label">Monto final <i class="fas fa-question-circle" data-toggle="tooltip" title="Monto final de obra"></i></label>
                  <input type="number" name="monto_final[]" class="form-control" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" value="<?php echo $obra['monto_final'];?>" required>
                </div>
              </div>   
            </div>
            <input type="text" name="idmodificaciones[]" value="<?php echo $obra['idmodificaciones'];?>" hidden>
            <div class="row p-t-20">
              <div class="col-md-2">
                <div class="md-form form-md">
                  <label class="control-label">Numero <i class="fas fa-question-circle" data-toggle="tooltip" title="Numero de modificacion"></i></label>
                  <input type="text" name="numero[]" class="form-control" value="<?php echo $obra['numero'];?>">
                  <small class="form-control-feedback"> Modificacion </small>
                </div>
              </div>  
              <div class="col-md-3">
                <div class="md-form form-md">
                  <label class="control-label">Nº Expediente <i class="fas fa-question-circle" data-toggle="tooltip" title="Expediente de modificacion"></i></label>
                  <input type="text" name="expediente[]" class="form-control" value="<?php echo $obra['expediente'];?>">
                </div>
              </div>                          
              <div class="col-md-4">
                <div class="md-form form-md">
                  <label class="control-label">Resolucion <i class="fas fa-question-circle" data-toggle="tooltip" title="Fecha de resolucion de aprobacion"></i></label>
                  <input type="date" name="resolucion_fecha[]" class="form-control" value="<?php echo $obra['resolucion_fecha'];?>">
                  <small class="form-control-feedback"> Fecha </small> 
                </div>
              </div>   
              <div class="col-md-3">
                <div class="md-form form-md">
                  <label class="control-label">&nbsp;</label>
                  <input type="text" name="resolucion_numero[]" class="form-control" value="<?php echo $obra['resolucion_numero'];?>">
                  <small class="form-control-feedback"> Numero </small> 
                </div>
              </div>  
            </div>
            <div class="row p-t-20">
              <div class="col-md-12">
                <div class="md-form">
                  <label class="control-label">Informacion general <i class="fas fa-question-circle" data-toggle="tooltip" title="Memoria descriptiva de modificacion"></i></label>
                  <textarea name="descripcion[]" class="form-control" rows="5" ><?php echo $obra['descripcion'];?></textarea>
                  <small class="form-control-feedback"> Descripcion de la modificacion </small> 
                </div>
              </div>                        
            </div>
<hr> 
            <div class="row p-t-20">
              <div class="col-md-3">
                <div class="md-form form-md">
                  <label class="control-label">Computo</label>
                  <select class="form-control custom-select" name="computo_estado[]">
                  <optgroup label="Establecido">
                    <?php if($obra['computo_estado'] == 0){ echo '<option value="0" selected>Sin definir</option>'; }
                    if($obra['computo_estado'] == 1){ echo '<option value="1" selected>Recibido</option>';}
                    if($obra['computo_estado'] == 2){ echo '<option value="2" selected>Empresa</option>';}
                    if($obra['computo_estado'] == 3){ echo '<option value="3" selected>Aprobado</option>';} ?>
                  </optgroup>
                  <optgroup label="Opciones ">
                    <option value="0">Sin definir</option>
                    <option value="1">Recibido</option>
                    <option value="2">Empresa</option>
                    <option value="3">Aprobado</option>
                  </optgroup>
                </select>
                  <small class="form-control-feedback"> Estado </small>
                </div>
              </div>  
              <div class="col-md-3">
                <div class="md-form form-md">
                  <label class="control-label">&nbsp;</label>
                  <input type="date" name="computo_fecha[]" class="form-control" value="<?php echo $obra['computo_fecha'];?>">
                  <small class="form-control-feedback"> Fecha </small>
                </div>
              </div>                          
              <div class="col-md-3">
                <div class="md-form form-md">
                  <label class="control-label">Precios</label>
                  <select class="form-control custom-select" name="precios_estado[]">
                  <optgroup label="Establecido">
                    <?php if($obra['precios_estado'] == 0){ echo '<option value="0" selected>Sin definir</option>'; }
                    if($obra['precios_estado'] == 1){ echo '<option value="1" selected>Recibido</option>';}
                    if($obra['precios_estado'] == 2){ echo '<option value="2" selected>Empresa</option>';}
                    if($obra['precios_estado'] == 3){ echo '<option value="3" selected>Aprobado</option>';} ?>
                  </optgroup>
                  <optgroup label="Opciones ">
                    <option value="0">Sin definir</option>
                    <option value="1">Recibido</option>
                    <option value="2">Empresa</option>
                    <option value="3">Aprobado</option>
                  </optgroup>
                </select>
                  <small class="form-control-feedback"> Estado </small> 
                </div>
              </div>   
              <div class="col-md-3">
                <div class="md-form form-md">
                  <label class="control-label">&nbsp;</label>
                  <input type="date" name="precios_fecha[]" class="form-control" value="<?php echo $obra['precios_fecha'];?>">
                  <small class="form-control-feedback"> fecha </small> 
                </div>
              </div>  
            </div>
            <div class="row p-t-20">
              <div class="col-md-12">
                <div class="md-form">
                  <label class="control-label">Observaciones</label>
                  <textarea name="observaciones[]" class="form-control" rows="3" ><?php echo $obra['observaciones'];?></textarea>
                </div>
              </div>                        
            </div>
            <hr>  
            <?php endforeach; ?>  
<div id="AddModificaciones"></div>
<input class="btn btn-success" type="button" id="AddBotonModificacion" value="Agregar Mas" onClick="AgregarModificacion();" />

          </div> 
        </div>
          <div class="modal-footer">
            <button type="submit" name="modificaciones" class="btn btn-info waves-effect waves-light">Guardar cambios</button>
          </div>
        </form>      
      </div>
    </div>
  </div>
