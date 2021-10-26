<?php
require_once('../../includes/load.php');

$user = current_user();
$data = find_by_id('notificaciones','idnotificacion',$_POST['id']);v 

?>
      <div class="row form-center" id="editar_notificacion">
        <div class="col-lg-12 col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
              <div class="col-12">
                                        <div class="d-flex flex-wrap">
                                            <div>
                                                <h3 class="card-title">Editar notificacion</h3>
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
            <form method="post" action="notificaciones" id="form_editar">
              <div class="row">
                      <div class="col-lg-7 col-md-7 col-sm-12">
                    <div class="form-group p-r-10 p-l-10">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="row title-form">
                      Informacion del mensaje
                      </div>
                      </div>
                      <input type="text" name="editar_aviso" value="<?php echo $data['idavisos'] ?>" hidden>
                      <div class="row p-t-20">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <div class="md-form form-md">
                            <label class="control-label">Asunto</label>
                            <input type="text" name="asunto" id="asunto" class="form-control" value="<?php echo $data['asunto']; ?>" required>
                          </div>
                        </div> 
                      </div>
                      <div class="row p-t-10">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="md-form form-md">
                          <label class="control-label">Mensaje</label>
                          <textarea name="mensaje" class="form-control" row="2" required><?php echo $data['mensaje']; ?></textarea>
                        </div>
                      </div> 
                    </div>
                    </div>
                  </div>
                      <div class="col-lg-5 col-md-5 col-sm-12">
                      <div class="form-group p-r-10 p-l-10">
                         <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="row title-form">
                      Formato del aviso
                      </div>
                    </div>
                    <div class="row p-t-20">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <div class="md-form form-md">
                            <label class="control-label">Estado</label>
                            <select class="form-control custom-select" name="estado">
                  <optgroup label="Establecido">
                    <?php 
                    if($data['condicion'] == 1){ echo '<option value="1" selected>Activo</option>'; }
                    if($data['condicion'] == 0){ echo '<option value="0" selected>Inactivo</option>'; }
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
                      <div class="row p-t-20">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <div class="md-form form-md">
                            <label class="control-label">Color</label>
                            <select class="form-control custom-select" name="color">
                  <optgroup label="Establecido">
                    <?php 
                    if($data['color'] == 'info'){ echo '<option value="info" selected>Azul</option>'; }
                    if($data['color'] == 'success'){ echo '<option value="success" selected>Verde</option>'; }
                    if($data['color'] == 'danger'){ echo '<option value="danger" selected>Rojo</option>'; }
                    if($data['color'] == 'warning'){ echo '<option value="warning" selected>Amarillo</option>'; }
                    ?>
                  </optgroup>
                  <optgroup label="Opciones ">
                    <option value="info">Azul</option>
                    <option value="success">Verde</option>
                    <option value="danger">Rojo</option>
                    <option value="warning">Amarillo</option>
                  </optgroup>
                  </select>
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