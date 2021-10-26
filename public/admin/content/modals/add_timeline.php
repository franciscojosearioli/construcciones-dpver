<?php $obra_id = $_GET['id']; ?>
<div class="modal fade" id="add_timeline" tabindex="-1" role="dialog" aria-labelledby="add_timeline" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100" id="add_timeline">Agregar evento</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="card-body">
            <form method="post" action="obra.php?id=<?php echo (int)$_GET['id']; ?>">
                  <div class="form-group p-20">
            <div class="row p-20 justify-content-center">       
              <h5><b>AGREGAR EVENTO</b></h5>
            </div> 
                  <div class="row p-t-20">
                    <div class="col-md-4">
                      <div class="md-form form-md">
                        <label class="control-label">Fecha</label>
                        <input type="date" name="fecha" class="form-control" required>
                      </div>
                    </div>
                    <div class="col-md-8">
                      <div class="form-group">
                        <label class="control-label">Evento</label>
                        <select class="form-control custom-select" name="evento" required>
                          <option selected disabled>Seleccione un evento</option>
                          <option value="Acta de inicio">Acta de inicio</option>
                          <option value="Modificacion de plazos">Modificacion de plazos</option>
                          <option value="Modificacion de obra">Modificacion de obra</option>
                          <option value="Neutralizacion de plazo">Neutralizacion de plazo</option>
                          <option value="Acta de reinicio">Acta de reinicio</option>
                          <option value="Finalizacion de obra prevista">Finalizacion de obra prevista</option>
                        </select>
                      </div>
                    </div>      
                  </div>               
                  <div class="row p-t-20">
                    <div class="col-md-12">
                      <div class="md-form form-md">
                        <label class="control-label">Expediente</label>
                        <input type="text" name="expediente" class="form-control">
                      </div>
                    </div>   
                  </div>
                  <div class="row p-t-20">
                        <div class="col-md-12">
                          <div class="md-form">
                        <label class="control-label">Observacion</label>
                            <textarea name="observacion" class="form-control md-textarea" length="50000" rows="2" ></textarea>
                          </div>
                        </div>
                      </div> 
                      <input type="text" name="id_referencia" value="<?php echo (int)$line['idobras']; ?>" hidden>
                <div class="modal-footer">
                  <button type="submit" name="add_evento_timeline" class="btn btn-info waves-effect waves-light">Agregar</button>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>