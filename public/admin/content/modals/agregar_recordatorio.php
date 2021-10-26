<?php
require_once('../../includes/load.php'); ?>
<!-- Central Modal Small -->
<div class="modal fade" id="agregar_recordatorios" tabindex="-1" role="dialog" aria-labelledby="agregar_recordatorios" aria-hidden="true">
  <!-- Change class .modal-sm to change the size of the modal -->
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100" id="agregar_recordatorios">Agregar recordatorio</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
              <form method="post" action="recordatorios">
      <div class="modal-body">
        <div class="card-body">
            <div class="form-group p-20">
               <div class="row p-t-20">
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="md-form form-md">
                      <label class="control-label">Descripcion</label>
                      <textarea name="descripcion" class="form-control md-textarea" rows="4"></textarea>
                    </div>
                  </div>
                </div>
                
          </div>
        </div>
        <div class="modal-footer">
<button type="submit" name="agregar_recordatorios" class="btn btn-info waves-effect waves-light m-r-10">Agregar</button>
      </div>
  </form>
    </div>
  </div>
</div>