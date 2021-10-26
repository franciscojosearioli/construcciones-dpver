<?php $user = current_user(); ?>
<div class="modal fade" id="change_password" tabindex="-1" role="dialog" aria-labelledby="change_password" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100" id="change_password">Cambiar contraseña</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="card-body">
            <form method="post" action="perfil">
              <div class="form-group p-20">
                <div class="row p-t-20">
                  <div class="col-md-6">
                    <div class="md-form form-md">
                      <label class="control-label">Nueva contraseña</label>
                      <input type="password" name="new_password" class="form-control" required>
                    </div>
                  </div>                  
                  <div class="col-md-6">
                    <div class="md-form form-md">
                      <label for="control-label">Antigua contraseña</label>
                      <input type="password" name="old_password" class="form-control" required>
                    </div>
                  </div>       
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" name="update_password" class="btn btn-info waves-effect waves-light">Cambiar</button>
        </form>
      </div>
    </div>
  </div>
</div>