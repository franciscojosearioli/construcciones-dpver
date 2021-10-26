<?php $obra_id = $_GET['id']; ?>
<div class="modal fade" id="add_bacheo" tabindex="-1" role="dialog" aria-labelledby="add_bacheo" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100" id="add_bacheo">Agregar tarea realizada</h4>
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
              <h5><b>AGREGAR TAREA REALIZADA</b></h5>
            </div> 
                  <div class="row p-t-20">
                    <div class="col-md-6">
                      <div class="md-form form-md">
                        <label class="control-label">Fecha</label>
                        <input type="date" name="fecha" class="form-control" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="md-form form-md">
                        <label class="control-label">Ubicacion</label>
                        <input type="text" name="ubicacion" class="form-control" required>
                      </div>
                    </div>      
                  </div>    
                      <div class="row p-t-20">
                        <div class="col-md-12">
                          <div class="md-form">
                        <label class="control-label">Personal</label>
                            <textarea name="personal" class="form-control md-textarea" length="50000" rows="2" required></textarea>
                          </div>
                        </div>
                      </div>                     
                  <div class="row p-t-20">
                    <div class="col-md-12">
                      <div class="md-form form-md">
                        <label class="control-label">Proveedor</label>
                        <input type="text" name="proveedor" class="form-control" required>
                      </div>
                    </div>   
                  </div>             
                  <div class="row p-t-20">
                    <div class="col-md-3">
                      <div class="md-form form-md">
                        <label class="control-label">Riego (m3)</label>
                        <input type="number" name="riego-m3" class="form-control" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" required>
                      </div>
                    </div><div class="col-md-3">
                      <div class="md-form form-md">
                        <label class="control-label">Riego (Tn)</label>
                        <input type="number" name="riego-tn" class="form-control" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" required>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="md-form form-md">
                        <label class="control-label">Asfalto (m2)</label>
                        <input type="number" name="asfalto-m2" class="form-control" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" required>
                      </div>
                    </div>   
                    <div class="col-md-3">
                      <div class="md-form form-md">
                        <label class="control-label">Asfalto (Tn)</label>
                        <input type="number" name="asfalto-tn" class="form-control" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" required>
                      </div>
                    </div>  
                  </div> 
                    <input type="text" class="form-control" id="codigobacheo" name="obra_id" style="visibility:hidden;" />
                <div class="modal-footer">
                  <button type="submit" name="add_bacheo" class="btn btn-info waves-effect waves-light">Agregar nuevo</button>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>