<?php 
require_once('../../includes/load.php');

$user = current_user();

$usuario = find_by_id('users','id',$_POST['id']);
$permisos = find_all('permisos');
$roles = find_all('roles');
$direcciones = find_all('direcciones');
$inspectores = all_inspectores();
$departamentos = find_departamentos($usuario['iddireccion']);
$all_permisos = all_permisos_users($usuario['id']);
?>
      <div class="row form-center" id="editar_usuarios">
        <div class="col-lg-12 col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
              <div class="col-12">
                                        <div class="d-flex flex-wrap">
                                            <div>
                                                <h3 class="card-title">Editar usuario</h3>
                                                <h6 class="card-subtitle"><?php echo find_select('nombre','departamentos','iddepartamentos',$user['iddepartamentos']) ?> - <?php echo find_select('nombre','direcciones','iddireccion',$user['iddireccion']) ?></h6>
                                            </div>
                                            <div class="ml-auto">
                                                <ul class="list-inline">
                                                    <li>
                                                      <h6 class="text-muted"><a onclick="cancelar_editar()" class="dropdown-item a-icon" data-toggle="tooltip" title="Cancelar"><i class="fas fa-times fa-2x"></i></a></h6>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                  </div>

            <hr class="m-t-0 m-b-0"></div>
          <div class="card-body">
            <form method="post" action="usuarios" id="form_editar">
              <input type="text" name="editar_usuario" value="<?php echo $usuario['id'] ?>" hidden>
              <div class="row">
              <div class="form-group p-20">
                <div class="row">
                  <div class="col-lg-6 col-md-6">
                    <div class="row p-t-20">                
                      <div class="col-12">
                        <label class="control-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control" value="<?php echo $usuario['nombre'] ?>" required>
                      </div>                            
                    </div>
                    <div class="row p-t-20">
                      <div class="col-12">
                        <label class="control-label">Apellido</label>
                        <input type="text" name="apellido" class="form-control" value="<?php echo $usuario['apellido'] ?>" required>
                      </div>                           
                    </div>
                    <div class="row p-t-20">                
                      <div class="col-12">
                        <label class="control-label">Correo electronico</label>
                        <input type="email" name="email" class="form-control" value="<?php echo $usuario['email'] ?>">
                      </div>  
                    </div>   
                    <div class="row p-t-20">
                      <div class="col-12">
                        <label class="control-label">Telefono</label>
                        <input type="text" name="telefono" class="form-control" value="<?php echo $usuario['telefono'] ?>">
                      </div> 
                    </div>
                    <div class="row p-t-20">
                      <div class="col-12">
                        <label class="control-label">Genero</label>
                        <select class="form-control custom-select" name="sexo">
                        <optgroup label="Establecido">
                          <?php 
                          if($usuario['sexo'] == 1){ echo '<option value="'.$usuario['sexo'].'" selected>Masculino</option>'; }
                          if($usuario['sexo'] == 2){ echo '<option value="'.$usuario['sexo'].'" selected>Femenino</option>'; } 
                          ?>
                        </optgroup>
                        <optgroup label="Opciones ">
                          <option value="1">Masculino</option>
                          <option value="2">Femenino</option>
                        </optgroup>
                        </select>
                      </div> 
                    </div>
                    <div class="row p-t-20">
                      <div class="col-8">
                        <label class="control-label">Direccion</label>
                        <input type="text" name="direccion" class="form-control" value="<?php echo $usuario['direccion'] ?>">
                      </div> 
                      <div class="col-4">
                        <label class="control-label">Numero</label>
                        <input type="text" name="direccion_numeracion" class="form-control" value="<?php echo $usuario['direccion_numeracion'] ?>">
                      </div> 
                    </div>
                    <div class="row p-t-20">
                      <div class="col-8">
                        <label class="control-label">Localidad</label>
                        <input type="text" name="localidad" class="form-control" value="<?php echo $usuario['localidad'] ?>">
                      </div> 
                      <div class="col-4">
                        <label class="control-label">C.Postal</label>
                        <input type="text" name="codigo_postal" class="form-control" value="<?php echo $usuario['codigo_postal'] ?>">
                      </div> 
                    </div>
                    <div class="row p-t-20">
                      <div class="col-12">
                        <label class="control-label">Estado</label>
                        <select class="form-control custom-select" name="condicion">
                        <optgroup label="Establecido">
                          <?php 
                          if($usuario['condicion'] == 1){ echo '<option value="'.$usuario['condicion'].'" selected>Activo</option>'; }
                          if($usuario['condicion'] == 0){ echo '<option value="'.$usuario['condicion'].'" selected>Inactivo</option>'; } 
                          ?>
                        </optgroup>
                        <optgroup label="Opciones ">
                          <option value="1">Activo</option>
                          <option value="0">Inactivo</option>
                        </optgroup>
                        </select>
                      </div> 
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6">
                    <div class="row p-t-20">                
                      <div class="col-12">
                        <label class="control-label">Usuario</label>
                        <input type="text" name="username" class="form-control" value="<?php echo $usuario['username'] ?>" readonly required>
                      </div>     
                    </div>
                    <div class="row p-t-20">
                      <div class="col-12">
                        <label class="control-label">Contraseña</label>
                        <input type="password" name="password" class="form-control" disabled>
                      </div> 
                    </div>
                    <div class="row p-t-20">
                      <div class="col-12">
                      <div class="md-form form-md">
                            <label class="control-label">Permisos de usuario (Requerido)</label>
                            <select class="form-control permisos" name="permisos[]" style="height:80px;width:100%;" required multiple>  
                            <optgroup label="Establecido">
                            <?php foreach($all_permisos as $pe): ?>
                            <option value="<?php echo $pe['idpermisos']; ?>" selected><?php echo $pe['nombre']; ?></option>
                            <?php endforeach; ?>
                          </optgroup>
                  <optgroup label="Opciones ">
                            <?php foreach($permisos as $p): ?>    
                            <option value="<?php echo $p['idpermisos']; ?>"><?php echo $p['nombre']; ?></option>
                            <?php endforeach; ?>
                            </optgroup>
                            </select>
                            <div id="result_permisos"></div>
                          </div>



                        <!--<label class="control-label">Permisos de usuario</label>
                        <select class="form-control custom-select" name="idpermisos">
                  <optgroup label="Establecido">
                    <?php echo '<option value="'.$usuario['idpermisos'].'" selected>'.find_select('nombre','permisos','idpermisos',$usuario['idpermisos']).'</option>'; ?>
                  </optgroup>
                  <optgroup label="Opciones ">
                    <?php foreach ($permisos as $permiso ):?>
                            <option value="<?php echo $permiso['idpermisos'];?>"><?php echo ucwords($permiso['nombre']);?></option>
                          <?php endforeach;?>
                  </optgroup>
                         
                        </select>-->
                      </div> 
                    </div>
                    <div class="row p-t-20">
                      <div class="col-12">
                    <label class="control-label">Aclaracion</label>
                        <input type="text" name="permiso" class="form-control" value="<?php echo $usuario['permiso'] ?>">
                      </div> 
                    </div>
                    <div class="row p-t-20">
                      <div class="col-12">
                        <label class="control-label">Rol de usuario</label>
                        <select class="form-control custom-select" name="idroles">
                  <optgroup label="Establecido">
                    <?php echo '<option value="'.$usuario['idroles'].'" selected>'.find_select('nombre','roles','idroles',$usuario['idroles']).'</option>'; ?>
                  </optgroup>
                  <optgroup label="Opciones ">
                          <?php foreach ($roles as $rol):?>
                            <option value="<?php echo $rol['idroles'];?>"><?php echo ucwords($rol['nombre']);?></option>
                          <?php endforeach;?>
                  </optgroup>
                        </select>
                      </div> 
                    </div>
                    <div class="row p-t-20">
                      <div class="col-12">
                        <label class="control-label">Direccion</label>
                        <select class="form-control custom-select" name="iddireccion" id="select_direccion_editar">
                  <optgroup label="Establecido">
                    <?php echo '<option value="'.$usuario['iddireccion'].'" selected>'.find_select('nombre','direcciones','iddireccion',$usuario['iddireccion']).'</option>'; ?>
                  </optgroup>
                  <optgroup label="Opciones ">
                          <?php foreach ($direcciones as $direccion ):?>
                            <option value="<?php echo $direccion['iddireccion'];?>"><?php echo ucwords($direccion['nombre']);?></option>
                          <?php endforeach;?>
                  </optgroup>
                        </select>
                      </div> 
                    </div>

                                           <div class="row p-t-20" id="departamentos_actuales">
                      <div class="col-12">
                        <label class="control-label">Departamento</label>
                        <select class="form-control custom-select" name="iddepartamentos">
                  <optgroup label="Establecido">
                    <?php echo '<option value="'.$usuario['iddepartamentos'].'" selected>'.find_select('nombre','departamentos','iddepartamentos',$usuario['iddepartamentos']).'</option>'; ?>
                  </optgroup>
                  <optgroup label="Opciones ">
                          <?php foreach ($departamentos as $dpto ):?>
                            <option value="<?php echo $dpto['iddepartamentos'];?>"><?php echo ucwords($dpto['nombre']);?></option>
                          <?php endforeach;?>
                  </optgroup>
                        </select>
                      </div> 
                    </div>
                    <div id="departamentos_editar"></div>

                                        <div class="row p-t-20">
                      <div class="col-12">
                      <div class="md-form">
   <input class="form-check-input" type="checkbox" id="subusuarios_editar" value="1" <?php if($usuario['idusuarios'] != 0){ echo 'checked'; } ?>>
    <label class="form-check-label" for="subusuarios_editar">
      Sub-Usuario
    </label>
  </div>
</div></div>
                   <div class="row p-t-20" id="sub_usuarios_editar" <?php if($usuario['idusuarios'] == 0){ echo 'style="display:none;"'; } ?>>
                      <div class="col-12">
                        <div class="md-form form-md">
                          <label class="control-label">Asignar a inspector</label>
                          <select class="form-control custom-select" name="usuarioprincipal">
                  <optgroup label="Establecido">
                    <?php 
                    $subusuario = find_by_id('users','id',$usuario['idusuarios']);
                    echo '<option value="'.$usuario['idusuarios'].'" selected>'.$subusuario['nombre'].' '.$subusuario['apellido'].'</option>'; ?>
                  </optgroup>
                  <optgroup label="Opciones ">
                            <?php foreach ($inspectores as $inspector):?>
                              <option value="<?php echo $inspector['id']; ?>"><?php echo $inspector['nombre'].' '.$inspector['apellido']; ?></option>
                            <?php endforeach; ?>
                  </optgroup>
                          </select>
                        </div>
                      </div>  
                    </div> 

                  </div>
                </div>  
              </div>
</div>
            </form>
          </div>
            <div class="card-body">
<hr class="m-t-0 m-b-0">
              <div class="row p-t-20">
              <div class="col-12">
                                        <div class="d-flex flex-wrap">
                                            <div>
                                                <h6 class="text-muted"><a onclick="cancelar_editar()" class="dropdown-item a-icon" data-toggle="tooltip" title="Cancelar"><i class="fas fa-times fa-2x"></i></a></h6>
                                            </div>
                                            <div class="ml-auto">
                                                <ul class="list-inline">
                                                    <li>
                                                        <h6 class="text-muted"><a onclick="submit_editar();" class="dropdown-item a-icon" data-toggle="tooltip" title="Confirmar"><i class="fas fa-check fa-2x"></i></a></h6> 
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                  </div>
            </div>
        </div>
      </div>    
    </div>
    <script>
$("#select_direccion_editar").change(function(){
      var valor = $(this).val();
        $.post("includes/ajax/direccion-departamentos.php",  { valor: valor }).done(function(data) {
           $('#departamentos_actuales').hide();
           $('#departamentos_editar').html(data);
});
});
$(document).ready(function(){
    $('#subusuarios_editar').change(function(){
        if(this.checked)
            $('#sub_usuarios_editar').show();
        else
            $('#sub_usuarios_editar').hide();

    });

    $('.permisos').select2();

});

</script>