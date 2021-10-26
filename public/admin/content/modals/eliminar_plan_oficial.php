<?php
require_once('../../includes/load.php');

$user = current_user();
$data = find_by_id('plan_oficial','idplan_oficial',$_POST['id']);
?>
<!-- Central Modal Small -->
<div class="modal fade" id="eliminar_plan_oficial" tabindex="-1" role="dialog" aria-labelledby="eliminar_plan_oficial" aria-hidden="true">

  <!-- Change class .modal-sm to change the size of the modal -->
  <div class="modal-dialog modal-md" role="document">

    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100" id="eliminar_plan_oficial">Eliminar plan oficial</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card-body">
            <div class="form-group p-20">
              <form method="post" action="obra?id=<?php echo (int)$_POST['obra']; ?>">
                <input type="text" name="eliminar_plan_oficial" value="<?php echo $data['idplan_oficial']; ?>" hidden>
                <center>
                  <button type="submit" class="btn btn-danger waves-effect waves-light m-r-10">Confirmar</button>
                </center>
              </form>

          </div>
        </div>
        <div class="modal-footer">

      </div>
    </div>
  </div>
</div>