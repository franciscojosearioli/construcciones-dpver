<?php
require_once('../../includes/load.php');
$user = current_user();
$all_direcciones = find_all('direcciones');
$all_departamentos = find_all('departamentos');
$agentes = find_all('users');
?>
      <div class="row form-center hide" id="memo_comision">
        <div class="col-lg-12 col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
              <div class="col-12">
                                        <div class="d-flex flex-wrap">
                                            <div>
                                                <h3 class="card-title">Nuevo Memorandum de Comision de servicio</h3>
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
            <form method="post" action="memorandums" id="form_agregar">
              <div class="row">
                      <div class="col-lg-7 col-md-7 col-sm-12">
                    <div class="form-group p-r-10 p-l-10">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="row title-form">
                      Informacion del documento
                      </div>
                      </div>
                      <input type="text" name="memo_comision" hidden>
                      <div class="row p-t-20 hide">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="md-form form-md">
                          <label class="control-label">Titulo</label>
                          <input type="text" name="titulo" class="form-control">
                        </div>
                      </div> 
                    </div>
                    <div class="row p-t-20">
                      <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="md-form form-md">
                          <label class="control-label">Desde</label>
                          <input type="date" name="fecha_inicio" class="form-control" required>
                        </div>
                      </div> 
                      <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="md-form form-md">
                          <label class="control-label">Cantidad de dias</label>
                          <input type="number" name="dias" class="form-control" required>
                        </div>
                      </div> 
                    </div>
                    <div class="row p-t-10">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <div class="md-form form-md">
                            <label class="control-label">Agentes de comision</label>
                            <select class="form-control agentes" name="agente[]" style="height:80px;width:100%;" required multiple>    
                            <?php foreach($agentes as $a): ?>    
                            <option value="<?php echo $a['id']; ?>"><?php echo $a['apellido'].', '.$a['nombre']; ?></option>
                            <?php endforeach; ?>
                            </select>
                            <div id="result_agente"></div>
                          </div>
                        </div> 
                      </div>
                    </div>
                  </div>
                      <div class="col-lg-5 col-md-5 col-sm-12">
                      <div class="form-group p-r-10 p-l-10">
                         <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="row title-form">
                      Informacion del tramite
                      </div>
                    </div>
                    <div class="row p-t-20">
                      <div class="col-12">
                        <label class="control-label">Producido por</label>
                        <select class="form-control custom-select" name="emisor" required>
                        <optgroup label="Establecido">
                          <option selected value="<?php echo $user['iddireccion'];?>"><?php echo find_select('nombre','direcciones','iddireccion',$user["iddireccion"]);?></option>
                   </optgroup>
                  <optgroup label="Opciones">
                          <?php foreach ($all_direcciones as $direccion ):?>
                            <option value="<?php echo $direccion['iddireccion'];?>"><?php echo ucwords($direccion['nombre']);?></option>
                          <?php endforeach;?>
                          </optgroup>
                        </select>
                      </div> 
                    </div>
                      <div class="row p-t-10">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="md-form form-md">
                          <label class="control-label">Fecha del tramite</label>
                          <input type="date" name="fecha" class="form-control" value="<?php echo date("Y-m-d");?>" required>
                        </div>
                      </div>
                      </div>
                      <div class="row p-t-10">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="md-form form-md">
                          <label class="control-label">Para informacion de</label>
                          
                        <select class="form-control custom-select" name="receptor" required>
                  <optgroup label="Establecido">
                          <option value="18" selected><?php echo find_select('nombre','departamentos','iddepartamentos',18);?></option>
                        </optgroup>
                  <optgroup label="Opciones">
                          <?php foreach ($all_departamentos as $dpto ):?>
                            <option value="<?php echo $dpto['iddepartamentos'];?>"><?php echo ucwords($dpto['nombre']);?></option>
                          <?php endforeach;?>
                        </optgroup>
                        </select>
                        </div>
                      </div>
                      </div>
                  </div>
                </div>

</div>
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
                                                        <h6 class="text-muted"><button type="submit" class="dropdown-item a-icon" data-toggle="tooltip" title="Confirmar"><i class="fas fa-check fa-2x"></i></button></h6> 
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
    
    </form>
