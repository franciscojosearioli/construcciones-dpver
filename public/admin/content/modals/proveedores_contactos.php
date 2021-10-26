<?php
require_once('../../includes/load.php');
 $contacto = find_by_id('proveedores','idproveedores',$_POST['id']) ?>
<!-- Central Modal Small -->
<div class="modal fade" id="contacto" tabindex="-1" role="dialog" aria-labelledby="contacto" aria-hidden="true">

  <!-- Change class .modal-sm to change the size of the modal -->
  <div class="modal-dialog modal-md" role="document">

    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100" id="contacto">Contacto del proveedor</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card-body">
          
            <div class="form-group p-20">
              <div class="row"><h3>
                <?php echo $contacto['contacto_nombre'].' '.$contacto['contacto_apellido']; ?></h3>
                </div>
                <div class="row">
                <?php echo 'Email: '.$contacto['contacto_email']; ?>
                </div>
                <div class="row">
                <?php echo 'Telefono: '.$contacto['contacto_telefono']; ?>
                </div>
          </div>
        </div>
        <div class="modal-footer">

      </div>
    </div>
  </div>
</div>