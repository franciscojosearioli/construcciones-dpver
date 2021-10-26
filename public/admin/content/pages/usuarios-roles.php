<?php
require_once('../../includes/load.php');
require_once('../../includes/functions/users.php');
$all_roles = find_all('roles');
$user = current_user();
cabecera('Roles de usuarios');
?>
<div class="row justify-content-center">
         <div class="col-8">
              <div class="d-flex flex-wrap p-b-30">
              <div class="ml-auto my-auto mr-3">
<?php if(permiso('admin') || permiso('obras') || permiso('proyectos')){ ?>
              <a id="btn_agregar" onclick="form_agregar(true)" title="Agregar nuevo" data-toggle="tooltip" class="btn btn-light"><i class="fas fa-plus"></i> Cargar nuevo</a>
                  <?php } ?>
              </div>
              </div>
              </div>
         </div>
         <div class="row justify-content-center" id="listar_roles">
         <div class="col-8">
          <div class="card">
            <div class="card-body">
              <div class="row">
              <div class="col-12">
              
                <div class="card-body cards-titulo">
              <div class="d-flex flex-wrap p-b-30">
              <div class="my-auto ml-3">
                <h1><b>Roles de usuarios</b></h1>
              </div>
            </div>
            </div>
            <div class="table-responsive">
              <table id="all" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th class="w-5"></th>
                    <th class="w-5"></th>
                    <th class="text-center"> ID </th>
                    <th> Nombre </th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($all_roles as $rol): ?>
                    <tr>
                      <td></td>
                      <td class="text-center">
                        <a class="i-dt-list" href="includes/functions/archivar.php?id=<?php echo (int)$rol['idroles'];?>&url=usuarios-roles&tipo=rol" data-toggle="tooltip" title="Desactivar">
                          <i class="mdi mdi-close"></i>
                        </a>
                      </td>
                      <td class="text-center"><?php echo clean(ucwords($rol['idroles']))?></td>
                      <td><?php echo clean(ucwords($rol['nombre']))?></td>
                    </tr>
                  <?php endforeach;?>
                </tbody>
                <tfoot>
                  <tr>
                    <th></th>
                    <th class="w-5"></th>
                    <th class="text-center"> ID </th>
                    <th> Nombre </th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>    
    </div>
  </div>
</div>
<script type="text/javascript" src="includes/ajax/scripts/roles.js"></script>
<?php 
require_once('../forms/agregar_roles.php');
pie(); ?>