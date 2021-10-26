<?php
require_once('../../includes/load.php');

$user = current_user();
$nota = find_by_id('notas','idnotas',$_POST['id']) 
?>
<!-- Central Modal Small -->
<div class="modal fade" id="eliminar_nota" tabindex="-1" role="dialog" aria-labelledby="eliminar_nota" aria-hidden="true">

  <!-- Change class .modal-sm to change the size of the modal -->
  <div class="modal-dialog modal-sm" role="document">

    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100" id="eliminar_nota">Eliminar nota</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card-body">
            <div class="form-group p-20">
              <form method="post" action="notas">
                <input type="text" name="eliminar_nota" value="<?php echo $nota['idnotas']; ?>" hidden>
                <div class="row justify-content-center">¿Esta seguro?</div>
                <div class="row justify-content-center p-t-20"><button type="submit" class="btn btn-danger waves-effect waves-light m-r-10">CONFIRMAR Y ELIMINAR</button></div>
              </form>

          </div>
        </div>
        <div class="modal-footer">

      </div>
    </div>
  </div>
</div>