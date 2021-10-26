<?php 
$permisos = find_all('permisos');
$roles = find_all('roles');
$direcciones = find_all('direcciones');
$inspectores = all_inspectores();
$permisos = find_all('permisos');
?>
      <div class="row form-center hide" id="agregar_usuarios">
        <div class="col-lg-12 col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
              <div class="col-12">
                                        <div class="d-flex flex-wrap">
                                            <div>
                                                <h3 class="card-title">Agregar nuevo usuario</h3>
                                                </div>
                                            <div class="ml-auto">
                                                <ul class="list-inline">
                                                    <li>
                                                      <h6 class="text-muted"><a onclick="cancelar_agregar()" class="dropdown-item a-icon" data-toggle="tooltip" title="Cancelar"><i class="fas fa-times fa-2x"></i></a></h6>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                  </div>

            <hr class="m-t-0 m-b-0"></div>
          <div class="card-body">
            <form method="post" action="usuarios" id="form_agregar">
              <input type="text" name="add_usuario" hidden>
              <div class="row">
              <div class="form-group p-20">
                <div class="row">
                  <div class="col-lg-6 col-md-6">
                    <div class="row p-t-20">                
                      <div class="col-12">
                        <label class="control-label">Nombre (Requerido)</label>
                        <input type="text" name="nombre" class="form-control" required>
                      </div>                            
                    </div>
                    <div class="row p-t-20">
                      <div class="col-12">
                        <label class="control-label">Apellido (Requerido)</label>
                        <input type="text" name="apellido" class="form-control" required>
                      </div>                           
                    </div>
                    <div class="row p-t-20">                
                      <div class="col-12">
                        <label class="control-label">Correo electronico</label>
                        <input type="email" name="email" class="form-control">
                      </div>  
                    </div>   
                    <div class="row p-t-20">
                      <div class="col-12">
                        <label class="control-label">Telefono</label>
                        <input type="text" name="telefono" class="form-control">
                      </div> 
                    </div>
                    <div class="row p-t-20">
                      <div class="col-12">
                        <label class="control-label">Genero</label>
                        <select class="form-control custom-select" name="sexo">
                          <option selected disabled>Seleccione un genero</option>
                          <option value="1">Masculino</option>
                          <option value="2">Femenino</option>
                        </select>
                      </div> 
                    </div>
                    <div class="row p-t-20">
                      <div class="col-8">
                        <label class="control-label">Direccion</label>
                        <input type="text" name="direccion" class="form-control">
                      </div> 
                      <div class="col-4">
                        <label class="control-label">Numero</label>
                        <input type="text" name="direccion_numeracion" class="form-control">
                      </div> 
                    </div>
                    <div class="row p-t-20">
                      <div class="col-8">
                        <label class="control-label">Localidad</label>
                        <input type="text" name="localidad" class="form-control">
                      </div> 
                      <div class="col-4">
                        <label class="control-label">C.Postal</label>
                        <input type="text" name="codigo_postal" class="form-control">
                      </div> 
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6">
                    <div class="row p-t-20">                
                      <div class="col-12">
                        <label class="control-label">Usuario (Requerido)</label>
                        <input type="text" name="username" class="form-control" required>
                      </div>     
                    </div>
                    <div class="row p-t-20">
                      <div class="col-12">
                        <label class="control-label">Contraseña (Requerido)</label>
                        <input type="password" name="password" class="form-control" required>
                      </div> 
                    </div>
                    <div class="row p-t-20">
                      
                    <div class="col-12">
                    <div class="md-form form-md">
                            <label class="control-label">Permisos de usuario (Requerido)</label>
                            <select class="form-control permisos" name="permisos[]" style="height:80px;width:100%;" required multiple>    
                            <?php foreach($permisos as $p): ?>    
                            <option value="<?php echo $p['idpermisos']; ?>"><?php echo $p['nombre']; ?></option>
                            <?php endforeach; ?>
                            </select>
                            <div id="result_permisos"></div>
                          </div>
                      </div> 
                            </div>
                    <div class="row p-t-20">
                      <div class="col-12">
                        <label class="control-label">Rol de usuario (Requerido)</label>
                        <select class="form-control custom-select" name="idroles" required>
                          <option selected disabled>Seleccione un rol</option>
                          <?php foreach ($roles as $rol):?>
                            <option value="<?php echo $rol['idroles'];?>"><?php echo ucwords($rol['nombre']);?></option>
                          <?php endforeach;?>
                        </select>
                      </div> 
                    </div>
                    <div class="row p-t-20">
                      <div class="col-12">
                        <label class="control-label">Direccion (Requerido)</label>
                        <select class="form-control custom-select" name="iddireccion" id="select_direccion" required>
                          <option selected disabled>Seleccione una direccion</option>
                          <?php foreach ($direcciones as $direccion ):?>
                            <option value="<?php echo $direccion['iddireccion'];?>"><?php echo ucwords($direccion['nombre']);?></option>
                          <?php endforeach;?>
                        </select>
                      </div> 
                    </div>
                    <div id="departamentos"></div>
                                        <div class="row p-t-20">
                      <div class="col-12">
                      <div class="md-form">
   <input class="form-check-input" type="checkbox" id="subusuarios" value="1">
    <label class="form-check-label" for="subusuarios">
      Sub-Usuario
    </label>
  </div>
</div></div>
                                         <div class="row p-t-20" id="sub_usuarios" style="display:none;">
                      <div class="col-12">
                        <div class="md-form form-md">
                          <label class="control-label">Asignar a inspector</label>
                          <select class="form-control custom-select" name="usuarioprincipal">
                            <option selected disabled>Seleccione un inspector</option>
                            <?php foreach ($inspectores as $inspector):?>
                              <option value="<?php echo $inspector['id']; ?>"><?php echo $inspector['nombre'].' '.$inspector['apellido']; ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>  
                    </div> 
                  </div>
                </div>  
              </div>











                      <!--<div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="form-group p-r-10 p-l-10">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="row title-form">
                      Informacion de categoria
                      </div>
                      </div>
                      <input type="text" name="add_categoria" hidden>
                      <div class="row p-t-20">
                        <div class="col-lg-8 col-md-8 col-sm-12">
                          <div class="md-form form-md">
                            <label class="control-label">Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" required>
                          </div>
                        </div> 
                        <div class="col-lg-4 col-md-4 col-sm-12">
                          <div class="md-form form-md">
                            <label class="control-label">Estado</label>
                            <select class="form-control custom-select" name="estado" required>
                  <option disabled selected>Seleccione una opcion</option>
                  <option value="1">Activa</option>
                  <option value="0">Inactiva</option>
                </select>
                          </div>
                        </div> 
                      </div>
                    </div>
                  </div>-->










</div>
            </form>
          </div>
            <div class="card-body">
<hr class="m-t-0 m-b-0">
              <div class="row p-t-20">
              <div class="col-12">
                                        <div class="d-flex flex-wrap">
                                            <div>
                                                <h6 class="text-muted"><a onclick="cancelar_agregar()" class="dropdown-item a-icon" data-toggle="tooltip" title="Cancelar"><i class="fas fa-times fa-2x"></i></a></h6>
                                            </div>
                                            <div class="ml-auto">
                                                <ul class="list-inline">
                                                    <li>
                                                        <h6 class="text-muted"><a onclick="submit_agregar();" class="dropdown-item a-icon" data-toggle="tooltip" title="Confirmar"><i class="fas fa-check fa-2x"></i></a></h6> 
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
$( "#select_direccion" ).change(function() {
      var valor = $(this).val();
        $.post("includes/ajax/direccion-departamentos.php",  { valor: valor }).done(function(data) {
                    $('#departamentos').html(data);
});
});
$(document).ready(function(){
    $('#subusuarios').change(function(){
        if(this.checked)
            $('#sub_usuarios').show();
        else
            $('#sub_usuarios').hide();

    });
    $('.permisos').select2();
  });

    </script>