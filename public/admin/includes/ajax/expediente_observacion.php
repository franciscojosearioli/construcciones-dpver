<div class="modal fade" id="expediente_observacion" tabindex="-1" role="dialog" aria-labelledby="expediente_observacion" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100" id="expediente_observacion">Observaciones del expediente</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="card-body">
            <form method="post" action="expedientes">
              <div class="form-group">
                <div class="row p-t-20">               
                  <div class="col-12 text-center">
  <div class="checkbox checkbox-success">
    <input name="bacheo" value="1" id="bacheo" type="checkbox" <?php if($obra['bacheo'] == 1){ echo 'checked';} else { echo '';} ?>>
    <label for="bacheo">
      Habilitado
    </label>
  </div>
                  </div>  
                </div>
              </div>
            </div>
          </div>  
        </div>
        <div class="modal-footer">
          <button type="submit" name="expediente_observacion" class="btn btn-info waves-effect waves-light">Guardar</button>
        </form>
      </div>
    </div>
  </div>
</div>