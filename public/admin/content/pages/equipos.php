<?php
require_once('../../includes/load.php');
require_once('../../includes/functions/movilidades.php');
cabecera('Movilidades');
$user = current_user();
$equipos_registrados = equipos_registrados($user['iddepartamentos']);

?>
<div id="listar_equipos">
<div class="row justify-content-center">
<div class="col-10">
<div class="d-flex flex-wrap p-b-30">
<div class="my-auto ml-3">
<h3 class="titulo-bienvenida">Movilidades</h3>
</div>
<div class="ml-auto my-auto mr-3">
  <?php if(permiso('admin') || permiso('obras') || permiso('movilidades')){ ?>
<a id="btn_agregar" onclick="form_agregar(true)" title="Agregar nuevo" data-toggle="tooltip"
class="btn btn-warning btn-rounded btn-light"><i class="fas fa-plus"></i> Cargar nuevo</a>
<?php } ?>
</div>
</div>
</div>
</div>
<div class="row justify-content-center" >
  <div class="col-10">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-12">          
            <div class="table-responsive">
              <table id="all" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th class="w-5"></th>
                    <?php if(permiso('admin') || permiso('movilidades')){ ?>
                      <th class="text-center" style="width: 5%;"> </th>
                    <?php } ?>
                    <th>Nombre </th>
                    <th>Patente </th>
                    <th class="text-center" style="width: 8%;">Estado</th>
                    <?php if(permiso('admin') || permiso('observador')){ ?>
                      <th class="text-center">Dependencia</th>
                    <?php } ?>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($equipos_registrados as $equipo): ?>
                    <tr>
                      <td class="w-5"></td>
                      <?php if(permiso('admin') || permiso('movilidades')){ ?>
                        <td class="text-center">
                          <div class="btn-group">
                            <a class="btn btn-sm btn-secondary" onclick="editar_equipo(<?php echo $equipo['idequipos']; ?>)" data-toggle="tooltip" title="Editar datos"><i class="mdi mdi-pencil"></i></a>
                          </div>
                        </td>
                      <?php } ?>
                      <td><?php echo clean(ucwords($equipo['nombre'])); ?></td>
                      <td><?php echo clean(ucwords($equipo['patente'])); ?></td>
                      <td><?php if($equipo['condicion'] === '1'): ?>
                      <span class="label label-success"><?php echo "Activo"; ?></span>
                      <?php else: ?>
                        <span class="label label-danger"><?php echo "Bloqueado"; ?></span>
                      <?php endif;?>
                    </td>
                    <?php if(permiso('admin') || permiso('observador')){ ?>
                      <td class="text-center"> <b><?php echo find_select('nombre','departamentos','iddepartamentos',$equipo['iddepartamentos']) ?></b> (<?php echo find_select('nombre','direcciones','iddireccion',$equipo['iddireccion']) ?>)  
                      </td>
                    <?php } ?>
                  </tr>
                <?php endforeach;?>
              </tbody>
              <tfoot>
                <tr>
                  <th class="w-5"></th>
                  <?php if(permiso('admin') || permiso('movilidades')){ ?>
                    <th class="text-center" style="width: 5%;"> </th>
                  <?php } ?>
                  <th>Nombre </th>
                  <th>Patente </th>
                  <th class="text-center" style="width: 8%;">Estado</th>
                  <?php if(permiso('admin') || permiso('observador')){ ?>
                    <th class="text-center">Dependencia</th>
                  <?php } ?>
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
</div>
<div id="editar_equipos"></div>
<script type="text/javascript" src="includes/ajax/scripts/equipos.js"></script>
<?php 
require_once('../forms/agregar_equipos.php');
pie(); ?>