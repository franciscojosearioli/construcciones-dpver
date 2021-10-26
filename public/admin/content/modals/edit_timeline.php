<?php 
require_once('../../includes/load.php');
$obra_id = $_GET['id']; 
$line = find_by_id('obras_resumen','idobras_resumen',(int)$_POST['id']);?>
?>
<div class="modal fade" id="edit_timeline" tabindex="-1" role="dialog" aria-labelledby="edit_timeline" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100" id="edit_timeline">Editar evento </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="card-body">
            <form method="post" action="obra.php?id=<?php echo (int)$line['idobras']; ?>">
                  <div class="form-group p-20">
            <div class="row p-20 justify-content-center">       
              <h5><b>EDITAR EVENTO</b></h5>
            </div> 
                  <div class="row p-t-20">
                    <div class="col-md-4">
                      <div class="md-form form-md">
                        <label class="control-label">Fecha</label>
                        <input type="date" name="fecha" class="form-control" value="<?php echo $line['fecha']; ?>" required>
                      </div>
                    </div>
                    <div class="col-md-8">
                      <div class="form-group">
                        <label class="control-label">Evento</label>
                        <select class="form-control custom-select" name="evento" required>
                          <optgroup label="Establecido"> 
                            <?php
                            if($line['evento'] == 'Acta de inicio'){ echo '<option value="Acta de inicio" selected>Acta de inicio</option>'; }
                            if($line['evento'] == 'Modificacion de plazos'){ echo '<option value="Modificacion de plazos" selected>Modificacion de plazos</option>'; }
                            if($line['evento'] == 'Modificacion de obra'){ echo '<option value="Modificacion de obra" selected>Modificacion de obra</option>'; }
                            if($line['evento'] == 'Neutralizacion de plazo'){ echo '<option value="Neutralizacion de plazo" selected>Neutralizacion de plazo</option>'; }
                            if($line['evento'] == 'Acta de reinicio'){ echo '<option value="Acta de reinicio" selected>Acta de reinicio</option>'; }
                            if($line['evento'] == 'Finalizacion de obra prevista'){ echo '<option value="Finalizacion de obra prevista" selected>Finalizacion de obra prevista</option>'; }
                            ?>
                          </optgroup>
                          <optgroup label="Opciones ">
                          <option value="Acta de inicio">Acta de inicio</option>
                          <option value="Modificacion de plazos">Modificacion de plazos</option>
                          <option value="Modificacion de obra">Modificacion de obra</option>
                          <option value="Neutralizacion de plazo">Neutralizacion de plazo</option>
                          <option value="Acta de reinicio">Acta de reinicio</option>
                          <option value="Finalizacion de obra prevista">Finalizacion de obra prevista</option>
                          </optgroup>
                        </select>
                      </div>
                    </div>      
                  </div>   
                  <div class="row p-t-20">
                    <div class="col-md-12">
                      <div class="md-form form-md">
                        <label class="control-label">Expediente</label>
                        <input type="text" name="expediente" class="form-control" <?php if(!empty($ot['expediente']) && $ot['expediente'] != '0'){ ?> value="<?php echo $line['expediente']; ?>" <?php } ?>>
                      </div>
                    </div>   
                  </div> 
                      <div class="row p-t-20">
                        <div class="col-md-12">
                          <div class="md-form">
                        <label class="control-label">Observacion</label>
                            <textarea name="observacion" class="form-control md-textarea" length="50000" rows="2"><?php echo $line['observacion']; ?></textarea>
                          </div>
                        </div>
                      </div>              
                <div class="modal-footer">
                  <a onclick="eliminar_timeline(<?php echo $line['idobras_resumen']; ?>)" class="btn btn-danger waves-effect waves-light text-white">Eliminar</a>
                  <button type="submit" name="edit_evento_timeline" class="btn btn-info waves-effect waves-light">Editar</button>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>