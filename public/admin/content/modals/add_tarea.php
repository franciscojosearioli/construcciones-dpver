<?php 
$equipos_registrados = equipos_registrados($user['iddepartamentos']);
?>
<div class="modal fade" id="add_tarea" tabindex="-1" role="dialog" aria-labelledby="add_tarea" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100" id="add_tarea">Agregar nuevo</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="card-body">
            <form method="post" action="equipos-mantenimientos">
                    <div class="form-group p-20">
                      <div class="row">
                        <div class="col-12">
                          <div class="md-form form-md">
                            <label class="control-label">Equipo</label>
                <select class="form-control custom-select" name="equipo" required>
                  <option disabled selected>Seleccione un equipo</option>
                  <?php foreach($equipos_registrados as $equipo): ?>
                  <option value="<?php echo $equipo['idequipos']; ?>"><?php echo $equipo['nombre']; ?> <?php if(!empty($equipo['patente'])){ echo ' ('.$equipo['patente'].')';} ?></option>
                  <?php endforeach; ?>
                </select>
                          </div>
                        </div> 
                      </div>
                      <div class="row p-t-20">
                      <div class="col-md-12">
                        <div class="md-form form-md">
                          <label class="control-label">Tarea de mantenimiento</label>
                          <input type="text" name="tarea" class="form-control" required>
                        </div>
                      </div> 
                      </div>
                      <hr>
                    <div class="row p-t-20">
                      <div class="col-md-12">
                        <center>PROGRAMAR MANTENIMIENTO</center>
                      </div>                  
                    </div>
                      <div class="row p-t-20">
                      <div class="col-md-6">
                        <div class="md-form form-md">
                          <label class="control-label">Ultima vez realizado</label>
                          <input type="date" name="ultimo_fecha" class="form-control" required>
                  <small class="form-control-feedback"> Fecha </small>
                        </div>
                      </div> 
                      <div class="col-md-6">
                        <div class="md-form form-md">
                          <label class="control-label">Ultima vez realizado</label>
                          <input type="number" name="ultimo_km" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" class="form-control" required>
                  <small class="form-control-feedback"> Kilometros </small>
                        </div>
                      </div> 
                      </div> 
                      <hr>
                      <div class="row p-t-20">
                      <div class="col-md-6">
                        <div class="md-form form-md">
                          <label class="control-label">Proximo a realizar</label>
                          <input type="date" name="proximo_fecha" class="form-control" required>
                  <small class="form-control-feedback"> Fecha </small>
                        </div>
                      </div> 
                      <div class="col-md-6">
                        <div class="md-form form-md">
                          <label class="control-label">Proximo a realizar</label>
                          <input type="number" name="proximo_km" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" class="form-control" required>
                  <small class="form-control-feedback"> Kilometros </small>
                        </div>
                      </div> 
                      </div> 
                  </div>
            </div>
          </div>  
        </div>
        <div class="modal-footer">
          <button type="submit" name="add_tarea" class="btn btn-info waves-effect waves-light ml-auto">Agregar</button>
        </form>
      </div>
    </div>
  </div>
</div>