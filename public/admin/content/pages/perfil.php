<?php
require_once('../../includes/load.php');
require_once('../../includes/functions/users.php'); 
require_once('../../../uploads/files.php'); 
cabecera('Editar perfil');
$user = current_user();  
?>
      <div class="row">
        <div class="col-lg-12">
          <?php echo display_msg($msg); ?>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6 col-md-12">
          <div class="card">
            <div class="card-body">
              <h3 class="card-title">Informacion personal</h3>
              <h6 class="card-subtitle">Datos de contacto</h6>
            </div>
            <div class="card-body">
              <form method="post" action="perfil?id=<?php echo (int)$user['id'];?>" class="clearfix">
                <div class="row">
                  <div class="col-md-6">
                    <div class="md-form">
                      <span class="control-label">Nombre</span>
                      <input type="text" name="nombre" class="form-control" value="<?php echo clean(ucwords($user['nombre'])); ?>" required>
                    </div>
                  </div> 
                  <div class="col-md-6">
                    <div class="md-form">
                      <span class="control-label">Apellido</span>
                      <input type="text" name="apellido" class="form-control" value="<?php echo clean(ucwords($user['apellido'])); ?>" required>
                    </div>
                  </div> 
                </div>
                <div class="row p-t-20">
                  <div class="col-md-12">
                    <div class="md-form">
                      <span class="control-label">Usuario</span>
                      <input type="text" name="username" class="form-control" value="<?php echo $user['username']; ?>" disabled>
                    </div>
                  </div> 
                </div>
                <div class="row p-t-20">
                  <div class="col-md-12">
                    <div class="md-form">
                      <span class="control-label">Correo electronico</span>
                      <input type="email" name="email" class="form-control" value="<?php echo $user['email']; ?>">
                    </div>
                  </div> 
                </div>
                <div class="row p-t-20">
                  <div class="col-md-12">
                    <div class="md-form">
                      <span class="control-label">Telefono</span>
                      <input type="text" name="telefono" class="form-control" value="<?php echo $user['telefono']; ?>">
                    </div>
                  </div> 
                </div>
                <div class="row p-t-20">
                  <div class="col-md-12">
                    <div class="md-form">
                      <span class="control-label">Genero</span>
                      <select class="form-control custom-select" name="sexo">
                        <optgroup label="Establecido">
                          <?php 
                          if($user['sexo'] == 1){ echo '<option value="1" selected>Masculino</option>'; }
                          if($user['sexo'] == 2){ echo '<option value="2" selected>Femenino</option>'; } ?>
                        </optgroup>
                        <optgroup label="Opciones ">
                          <option value="1">Masculino</option>
                          <option value="2">Femenino</option>
                        </optgroup>
                      </select>
                    </div>
                  </div> 
                </div>
                <div class="row p-t-20">
                  <div class="col-md-8">
                    <div class="md-form">
                      <span class="control-label">Dirección</span>
                      <input type="text" name="direccion" class="form-control" value="<?php echo ucwords($user['direccion']); ?>" required>
                    </div>
                  </div> 
                  <div class="col-md-4">
                    <div class="md-form">
                      <span class="control-label">Numeración</span>
                      <input type="text" name="direccion_numeracion" class="form-control" value="<?php echo $user['direccion_numeracion']; ?>" required>
                    </div>
                  </div> 
                </div>
                <div class="row p-t-20">
                  <div class="col-md-8">
                    <div class="md-form">
                      <span class="control-label">Localidad</span>
                      <input type="text" name="localidad" class="form-control" value="<?php echo ucwords($user['localidad']); ?>" required>
                    </div>
                  </div> 
                  <div class="col-md-4">
                    <div class="md-form">
                      <span class="control-label">Código postal</span>
                      <input type="text" name="codigo_postal" class="form-control" value="<?php echo $user['codigo_postal']; ?>" required>
                    </div>
                  </div> 
                </div>

                <div>
                  <br><hr class="m-t-0 m-b-0"><br>
                </div>
                <div class="form-group clearfix">
                  <a data-toggle="modal" data-target="#change_password" class="btn btn-info waves-effect waves-light float-right text-white">Cambiar contraseña</a>
                  <button type="submit" name="editar_perfil" class="btn btn-info waves-effect waves-light">Guardar cambios</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-md-12">
          <div class="card">
            <div class="card-body">
              <h3 class="card-title">Imagen de perfil</h3>
            </div>
            <div class="card-body text-center ">
              <center><?php if(!empty($user['imagen'])){ ?>
                <img src="../uploads/Usuarios/Perfiles/<?php echo $user['id'].'/'.$user['imagen']; ?>" width="250px">
              <?php } else { ?>
                <img src="../uploads/Usuarios/Perfiles/avatar.png" width="250px">
              <?php } ?>
              <br>
              <form class="form" action="perfil" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <input type="file" name="archivo" class="btn btn-default">
                </div>
                <div class="form-group">
                  <button type="submit" name="update_image" class="btn btn-info waves-effect waves-light">Actualizar imagen</button>
                </div>
              </form></center>
            </div>
          </div>
        </div>
      </div>       
    </div>
    <?php 
    require_once('../modals/edit_password.php');
    pie(); ?>