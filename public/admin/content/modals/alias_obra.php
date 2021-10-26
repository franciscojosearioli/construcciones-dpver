<?php
require_once('../../includes/load.php');
 $obra = find_by_id('obras','idobras',$_POST['id']) ?>
<!-- Central Modal Small -->
<div class="modal fade" id="alias_obra_modal" tabindex="-1" role="dialog" aria-labelledby="alias_obra_modal" aria-hidden="true">

  <!-- Change class .modal-sm to change the size of the modal -->
  <div class="modal-dialog modal-md" role="document">

    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100" id="alias_obra_modal">Alias de obra</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card-body">
          
            <div class="form-group p-20">
              <form method="post" action="obras-ejecucion" id="formulario_alias_obra">
                <input type="text" name="idobras_alias" value="<?php echo $obra['idobras'] ?>" hidden>
               <div class="row p-t-20">
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="md-form form-md">
                      <label class="control-label">Alias</label>
                      <textarea name="nombre_alias" class="form-control md-textarea" rows="4"><?php echo $obra["alias"]; ?></textarea>
                    </div>
                  </div>
                </div>
                
          </div>
        </div>
        <div class="modal-footer">
<button type="submit" id="enviar_alias_obra" class="btn btn-info waves-effect waves-light m-r-10">Guardar</button>
              </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
$("#enviar_alias_obra"). click(function(){
$("#formulario_alias_obra"). submit(); 
});
</script>

<script>

</script>