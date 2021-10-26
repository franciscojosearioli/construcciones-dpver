<?php
require_once('../../includes/load.php');
require_once('../../includes/functions/departamentos.php');
cabecera('Departamentos');
$user = current_user();
$all_departamentos = find_all('departamentos');

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
         <div class="row justify-content-center" id="listar_departamentos">
         <div class="col-8">
          <div class="card">
            <div class="card-body">
              <div class="row">
              <div class="col-12">
              
                <div class="card-body cards-titulo">
              <div class="d-flex flex-wrap p-b-30">
              <div class="my-auto ml-3">
                <h1><b>Departamentos</b></h1>
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
                    <th> Direccion </th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($all_departamentos as $departamento): ?>
                    <tr>
                      <td></td>
                      <td class="text-center"><a class="i-dt-list" href="includes/functions/archivar.php?id=<?php echo (int)$departamento['iddepartamentos'];?>&url=departamentos&tipo=departamento" data-toggle="tooltip" title="Desactivar"><i class="mdi mdi-close"></i></a></td>
                      <td class="text-center"><?php echo clean(ucwords($departamento['iddepartamentos']))?></td>
                      <td><?php echo clean(ucwords($departamento['nombre']))?></td>
                      <td><?php echo find_select('nombre','direcciones','iddireccion',$departamento['iddireccion']); ?></td>
                    </tr>
                  <?php endforeach;?>
                </tbody>
                <tfoot>
                  <tr>
                    <th></th>
                    <th class="text-center w-5">  </th>
                    <th class="text-center"> # </th>
                    <th> Nombre </th>
                    <th> Direccion </th>
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
  <script type="text/javascript" src="includes/ajax/scripts/departamentos.js"></script>
    <?php 
    require_once('../forms/agregar_departamentos.php');
    pie(); ?>