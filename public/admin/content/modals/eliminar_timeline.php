<?php
require_once('../../includes/load.php');
$obra_id = $_GET['id']; 
$user = current_user();
$data = find_by_id('obras_resumen','idobras_resumen',$_POST['id']) 
?>
<!-- Central Modal Small -->
<div class="modal fade" id="elim_timeline" tabindex="-1" role="dialog" aria-labelledby="elim_timeline" aria-hidden="true">

  <!-- Change class .modal-sm to change the size of the modal -->
  <div class="modal-dialog modal-md" role="document">

    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100" id="elim_timeline">Eliminar evento</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card-body">
            <div class="form-group p-20">
              <form method="post" action="obra.php?id=<?php echo $data['idobras']; ?>">
                <input type="text" name="eliminar_timeline" value="<?php echo $data['idobras_resumen']; ?>" hidden>
                <center><button type="submit" class="btn btn-danger waves-effect waves-light m-r-10">ELIMINAR</button></center>
              </form>

          </div>
        </div>
        <div class="modal-footer">

      </div>
    </div>
  </div>
</div>
</div>