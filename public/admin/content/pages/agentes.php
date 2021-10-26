<?php
require_once('../../includes/load.php');
cabecera('Agentes');
$user = current_user();
$all_users = find_all_user_dpto_y_dir($user['iddireccion'],$user['iddepartamentos']);
$direccion = find_by_id('direcciones','iddireccion',$user['iddireccion']);
$departamento = find_by_id('departamentos','iddepartamentos',$user['iddepartamentos']);

?>
<div class="row justify-content-center">
<div class="col-10">
<div class="d-flex flex-wrap p-b-30">
<div class="my-auto ml-3">
<h3 class="titulo-bienvenida">Agentes de los departamentos</h3>
</div>
<div class="ml-auto my-auto mr-3">
</div>
</div>
</div>
</div>
         <div class="row justify-content-center" >
         <div class="col-8">
          <div class="card">
            <div class="card-body">
              <div class="row">
              <div class="col-12">
      <div class="table-responsive">
        <table id="all" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th class="w-5"></th>
              <th class="w-5"></th>
              <th class="text-center">Nombre completo</th>
              <th class="text-center">Email</th>
              <th class="text-center">Telefono</th>
              <?php if(permiso('admin')){ ?>
                <th class="text-center">Ultimo login</th>
              <?php } ?>
            </tr>
          </thead>
          <tbody>
            <?php foreach($all_users as $usuario): ?>
              <tr>
                <td class="w-5"></td>
                <td>
                <a class="i-dt-list" href="usuario?id=<?php echo (int)$usuario['id'];?>" data-toggle="tooltip" title="Ver perfil"><i class="fa fa-id-card-alt"></i></a>
                      </td>
                <td><?php echo ucwords($usuario['apellido']).', '.ucwords($usuario['nombre']); ?></td>
                <td><?php echo ucwords($usuario['email'])?></td>
                <td><?php echo ucwords($usuario['telefono'])?></td>
                <?php if(permiso('admin')){ ?>
                  <td><?php if(!empty($usuario['login'])){ echo format_dyt($usuario['login']); }else{ echo 'Sin conexion';}?></td>
                <?php } ?>
              </tr>
            <?php endforeach;?>
          </tbody>
          <tfoot>
            <tr>
              <th class="w-5"></th>
              <th class="w-5"></th>
              <th class="text-center">Nombre completo</th>
              <th class="text-center">Email</th>
              <th class="text-center">Telefono</th>
              <?php if(permiso('admin')){ ?>
                <th class="text-center">Ultimo login</th>
              <?php } ?>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>    
</div>
<?php pie(); ?>