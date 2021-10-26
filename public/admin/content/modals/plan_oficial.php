<!-- Central Modal Small -->
<div class="modal fade" id="plan_oficial" tabindex="-1" role="dialog" aria-labelledby="plan_oficial" aria-hidden="true">

  <!-- Change class .modal-sm to change the size of the modal -->
  <div class="modal-dialog modal-lg" role="document">

    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100" id="plan_oficial">Plan oficial</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card-body">
          <form method="post" action="obra?id=<?php echo (int)$_GET['id']; ?>">
            <div class="form-group p-20">
              <div class="row p-t-20">
                <div class="col-md-6">
                  <div class="md-form form-md">
                    <label class="control-label">Numero</label>
                    <input type="number" name="numero" class="form-control" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" required>
                  </div>
                </div>                  
                <div class="col-md-6">
                  <div class="md-form form-md">
                    <label class="control-label">Porcentaje</label>
                    <input type="number"name="avance" class="form-control" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" required>
                  </div>
                </div>       
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" name="plan_oficial" class="btn btn-info waves-effect waves-light">Agregar nuevo</button>
        </form>
      </div>
    </div>
  </div>
</div>