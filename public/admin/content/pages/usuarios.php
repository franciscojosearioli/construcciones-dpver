<?php
require_once('../../includes/load.php');
require_once('../../includes/functions/users.php');
$user = current_user();
$all_usuarios = all_usuarios();
cabecera('Usuarios registrados');
?>
<div class="row justify-content-center">
         <div class="col-10">
              <div class="d-flex flex-wrap p-b-30">
              <div class="ml-auto my-auto mr-3">
<?php if(permiso('admin') || permiso('obras') || permiso('proyectos')){ ?>
              <a id="btn_agregar" onclick="form_agregar(true)" title="Agregar nuevo" data-toggle="tooltip" class="btn btn-light"><i class="fas fa-plus"></i> Cargar nuevo</a>
                  <?php } ?>
              </div>
              </div>
              </div>
         </div>
         <div class="row justify-content-center" id="listar_usuarios">
         <div class="col-10">
          <div class="card">
            <div class="card-body">
              <div class="row">
              <div class="col-12">
              
                <div class="card-body cards-titulo">
              <div class="d-flex flex-wrap p-b-30">
              <div class="my-auto ml-3">
                <h1><b>Usuarios</b></h1>
              </div>
            </div>
            </div>
            <div class="table-responsive">
              <table id="all" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th class="w-5"></th>
                    <th class="text-center"> </th>
                    <th>Nombre </th>
                    <th>Apellido </th>
                    <th>Usuario</th>
                    <th class="text-center">Departamento</th> 
                    <th class="text-center">Direccion</th>      
                    <th class="text-center" >Estado</th>
                    <th>Último login</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($all_usuarios as $a_user): ?>
                    <tr>
                      <td class="w-5"></td>
                      <td class="text-center">
                        <a class="i-dt-list" href="usuario.php?id=<?php echo (int)$a_user['id'];?>" data-toggle="tooltip" title="Ver perfil"><i class="mdi mdi-account"></i></a>
                        <a class="i-dt-list" onclick="editar_usuario(<?php echo $a_user['id']; ?>)" data-toggle="tooltip" title="Editar datos"><i class="mdi mdi-pencil"></i></a>
                      </td>
                      <td><?php echo clean(ucwords($a_user['nombre']))?></td>
                      <td><?php echo clean(ucwords($a_user['apellido']))?></td>
                      <td><?php echo clean($a_user['username'])?></td>
                      <td class="text-center"><?php echo find_select('nombre','departamentos','iddepartamentos',$a_user['iddepartamentos']); ?>
                    </td>
                    <td class="text-center"><?php echo find_select('nombre','direcciones','iddireccion',$a_user['iddireccion']); ?>
                  </td>
                  <td class="text-center">
                    <?php if($a_user['condicion'] === '1'): ?>
                      <span class="label label-success"><?php echo "Activo"; ?></span>
                      <?php else: ?>
                        <span class="label label-danger"><?php echo "Bloqueado"; ?></span>
                      <?php endif;?>
                    </td>
                    <td><?php if($a_user['login'] != NULL){ echo format_dyt($a_user['login']); } else{ echo 'Sin conexion'; }?></td>
                  </tr>
                <?php endforeach;?>
              </tbody>
              <tfoot>
                <tr>
                  <th class="w-5"></th>
                  <th class="text-center"> </th>
                  <th>Nombre </th>
                  <th>Apellido </th>
                  <th>Usuario</th>
                  <th class="text-center">Departamento</th> 
                  <th class="text-center">Direccion</th>      
                  <th class="text-center">Estado</th>
                  <th>Último login</th>
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
<div id="editar_usuarios"></div>
<script type="text/javascript" src="includes/ajax/scripts/usuarios.js"></script>
<?php 
//  require_once('../modals/add_usuario.php');
require_once('../forms/agregar_usuarios.php');
pie(); ?>