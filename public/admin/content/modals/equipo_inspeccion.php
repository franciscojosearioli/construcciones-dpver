<div class="modal fade" id="equip-insp" tabindex="-1" role="dialog" aria-labelledby="equip-insp" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="equip-insp">Grupo de inspeccion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php foreach($usuario_a_cargo as $u): ?>
                          <a href="usuario.php?id=<?php echo $u['id'] ?>" class="list-group-item" style="padding:15px; text-decoration: none; color:#00000080" >
                <span style="font-weight:500"><?php echo $u['nombre'].' '.$u['apellido']; ?></span>
                
                <?php if($u['condicion'] == 1){ ?>
                <p style="color:#18a014;font-size: 14px;">                
                  <span style="float:right;font-weight:400">Activo</span>
                </p>
                <?php 
              }
              if($u['condicion'] == 0){ ?>
                <p style="color:#e51e1e;font-size: 14px;">                
                  <span style="float:right;font-weight:400">Inactivo</span>
                </p>
              <?php } ?>
                
              </a>
                      <?php endforeach;  ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>