<?php
require_once('../../includes/load.php');
 $tramite = find_by_id('tramites','idtramites',$_POST['id']) ?>
<!-- Central Modal Small -->
<div class="modal fade" id="observacion_tramite" tabindex="-1" role="dialog" aria-labelledby="observacion_tramite" aria-hidden="true">

  <!-- Change class .modal-sm to change the size of the modal -->
  <div class="modal-dialog modal-md" role="document">

    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100" id="observacion_tramite">Observar el tramite</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card-body">
          
            <div class="form-group p-20">
              <form method="post" action="tramites" id="formulario_observacion">
                <input type="text" name="observacion_tramite" value="<?php echo $tramite['idtramites'] ?>" hidden>
                <input type="text" name="numero" value="<?php echo $tramite['numero'] ?>" hidden>
               <div class="row p-t-20">
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="md-form form-md">
                      <label class="control-label">Observaciones</label>
                      <textarea name="observaciones" class="form-control md-textarea" rows="4"><?php echo $tramite["observaciones"]; ?></textarea>
                    </div>
                  </div>
                </div>
                
          </div>
        </div>
        <div class="modal-footer">
<button type="submit" id="enviar_observacion" class="btn btn-info waves-effect waves-light m-r-10">Guardar</button>
              </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
$("#enviar_observacion"). click(function(){
$("#formulario_observacion"). submit(); 
});
</script>
