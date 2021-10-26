<?php
require_once('../../includes/load.php');
 $nota = find_by_id('notas','idnotas',$_POST['id']) ?>
<!-- Central Modal Small -->
<div class="modal fade" id="observacion_notas" tabindex="-1" role="dialog" aria-labelledby="observacion_notas" aria-hidden="true">

  <!-- Change class .modal-sm to change the size of the modal -->
  <div class="modal-dialog modal-md" role="document">

    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100" id="observacion_notas">Observacion del tramite</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card-body">
          
            <div class="form-group p-20">
              <form method="post" action="expedientes">
                <input type="text" name="observacion_nota" value="<?php echo $nota['idnotas'] ?>" hidden>
               <div class="row p-t-20">
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="md-form form-md">
                      <label class="control-label">Observaciones</label>
                      <textarea name="observaciones" class="form-control md-textarea" rows="4"><?php echo $nota["observaciones"]; ?></textarea>
                    </div>
                  </div>
                </div>
                
          </div>
        </div>
        <div class="modal-footer">
<button type="submit" class="btn btn-info waves-effect waves-light m-r-10">Guardar</button>
              </form>
      </div>
    </div>
  </div>
</div>