<?php $obra = find_by_id('obras', 'idobras', (int)$_GET['id']); ?>
<div class="modal fade" id="add_ensayo_inspeccion" tabindex="-1" role="dialog" aria-labelledby="add_ensayo_inspeccion" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100" id="add_ensayo_inspeccion">Cargar ensayo de laboratorio</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="obra.php?id=<?php echo $obra['idobras']; ?>" name="form_ensayo_inspeccion" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="card-body">
            <div class="form-group p-20">
                                        <div class="row p-t-20 justify-content-center">
                                          <h5><b>Ensayo de laboratorio</b></h5>
                                        </div>
                                        <div class="row justify-content-center">
                                          <h6>Complete los siguientes campos y cargue el archivo.</h6>
                                        </div>
              <div class="row p-t-20">              
              <div class="col-md-4">
                  <div class="form-group">
                    <label for="control-label">Fecha</label>
                    <input type="date" name="fecha" class="form-control required" required>
                  </div>
                </div>  
              <div class="col-md-4">
                  <div class="form-group">
                    <label for="control-label">Descripcion</label>
                    <input type="text" name="descripcion" class="form-control required" required>
                  </div>
                </div> 
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="control-label">Tipo</label>
                    <select name="tipo" class="form-control required" required>
                    <option disabled selected>No habilitado</option>
                    </select>
                  </div>
                </div>       
              </div>
              <div class="row p-t-20 justify-content-center">
                <h5><b>ARCHIVO</b></h5>
              </div>
              <div class="row">
                <div class="col-12">
                  <input type="file" name="archivo" id="input-file-now-custom-1" class="dropify-es" />
                  <input type="text" name="idobra" value="<?php echo $obra['idobras'];?>" hidden>
                  <input type="text" name="caja" value="<?php echo $obra['numero'];?>" hidden>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" name="add_ensayo" class="btn btn-info waves-effect waves-light">Agregar nuevo</button>
        </div>
      </form>
    </div>
  </div>
</div>