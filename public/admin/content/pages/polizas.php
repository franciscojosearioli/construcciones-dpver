<?php
require_once('../../includes/load.php');
$user = current_user();
cabecera('Polizas');
?>
<div class="row justify-content-center">
         <div class="col-10">
              <div class="d-flex flex-wrap p-b-30">
              <div class="my-auto ml-3">
              </div>
              <div class="ml-auto my-auto mr-3">
                  <?php if(permiso('admin')){ ?>
             <a id="btn_agregar" onclick="form_agregar(true)" title="Agregar nuevo" data-toggle="tooltip" class="btn btn-light"><i class="fas fa-plus"></i> Cargar nuevo</a>
                  <?php } ?>
              </div>
              </div>
              </div>
         </div>
         <div class="row justify-content-center" id="listar_polizas">
         <div class="col-10">
          <div class="card">
            <div class="card-body">
              <div class="row">
              <div class="col-12">
                <div class="card-body cards-titulo">
              <div class="d-flex flex-wrap p-b-30">
              <div class="my-auto ml-3">
                <h1><b>Polizas</b></h1>
              </div>
            </div>
            </div>   
        </div>
      </div>
    </div>    
  </div>
</div>
</div>
    <?php 
    pie(); 
    ?>