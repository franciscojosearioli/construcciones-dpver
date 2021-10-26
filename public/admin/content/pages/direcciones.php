<?php
require_once('../../includes/load.php');
require_once('../../includes/functions/direcciones.php');
cabecera('Direcciones');
$user = current_user();
$all_direcciones = find_all('direcciones');

?>
<div class="row justify-content-center">
         <div class="col-8">
              <div class="d-flex flex-wrap p-b-30">
              <div class="ml-auto my-auto mr-3">
<?php if(permiso('admin')){ ?>
              <a id="btn_agregar" onclick="form_agregar(true)" title="Agregar nuevo" data-toggle="tooltip" class="btn btn-light"><i class="fas fa-plus"></i> Cargar nuevo</a>
                  <?php } ?>
              </div>
              </div>
              </div>
         </div>
         <div class="row justify-content-center" id="listar_direcciones">
         <div class="col-8">
          <div class="card">
            <div class="card-body">
              <div class="row">
              <div class="col-12">
              
                <div class="card-body cards-titulo">
              <div class="d-flex flex-wrap p-b-30">
              <div class="my-auto ml-3">
                <h1><b>Direcciones</b></h1>
              </div>
            </div>
            </div>
            <div class="table-responsive">
              <table id="all" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th class="w-5"></th>
                    <th class="text-center w-5">  </th>
                    <th class="text-center"> # </th>
                    <th> Nombre </th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($all_direcciones as $direccion): ?>
                    <tr>
                      <td></td>
                      <td class="text-center"><a class="i-dt-list" href="includes/functions/archivar.php?id=<?php echo (int)$direccion['iddireccion'];?>&url=direcciones&tipo=direccion" data-toggle="tooltip" title="Desactivar"><i class="mdi mdi-close"></i></a></td>
                      <td class="text-center"><?php echo clean(ucwords($direccion['iddireccion']))?></td>
                      <td><?php echo clean(ucwords($direccion['nombre']))?></td>
                    </tr>
                  <?php endforeach;?>
                </tbody>
                <tfoot>
                  <tr>
                    <th></th>
                    <th class="text-center w-5">  </th>
                    <th class="text-center"> # </th>
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
    <script type="text/javascript" src="includes/ajax/scripts/direcciones.js"></script>
    <?php 
    require_once('../forms/agregar_direcciones.php');
    pie(); ?>