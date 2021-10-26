<?php
require_once('../../includes/load.php');

$user = current_user();
$expediente = find_by_id('tramites','idtramites',$_POST['id']); 
$expediente_pase = find_by_id('tramites_movimientos', 'idtramites',$expediente['idtramites']);
$expediente_local = buscar_expediente($expediente['numero']);
$all_direcciones = find_all('direcciones');

$all_etiquetas = find_all('tramites_etiquetas');
$oyp = all_oyp();

$etiquetas_tramite = all_etiquetas_tramite($_POST['id']);
$obras_tramite = all_obras_tramite($_POST['id']);
?>
      <div class="row form-center" id="editar_expedientes">
        <div class="col-lg-12 col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
              <div class="col-12">
                                        <div class="d-flex flex-wrap">
                                            <div>
                                                <h3 class="card-title">Editar datos de expediente</h3>
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
            <form method="post" action="tramites" id="form_editar">
              <div class="row">
                      <div class="col-lg-7 col-md-7 col-sm-12">
                    <div class="form-group p-r-10 p-l-10">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="row title-form">
                      Informacion del tramite
                      </div>
                      </div>
                      <input type="text" name="editar_expediente" value="<?php echo $expediente['idtramites'] ?>" hidden>
                      <div class="row p-t-20">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <div class="md-form form-md">
                            <label class="control-label">Expediente</label>
                            <input type="text" name="numero" class="form-control" value="<?php echo trim($expediente_local["numero"]); ?>" readonly required>
                          </div>
                        </div> 
                      </div>
                      <div class="row p-t-10">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="md-form form-md">
                          <label class="control-label">Asunto</label>
                          <textarea name="asunto" class="form-control md-textarea" rows="3" readonly><?php echo utf8_encode($expediente_local["asunto"]); ?></textarea>
                        </div>
                      </div> 
                    </div>
                      <div class="row p-t-10">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="md-form form-md">
                          <label class="control-label">Iniciador</label>
                          <input type="text" name="iniciador" class="form-control" value="<?php echo utf8_encode($expediente_local["iniciador"]); ?>" readonly>
                        </div>
                      </div> 
                    </div>
                      <div class="row p-t-10">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="md-form form-md">
                          <label class="control-label">Fecha de inicio</label>
                          <input type="date" name="fecha_inicio" class="form-control" value="<?php echo utf8_encode($expediente_local["fechareg"]); ?>" readonly>
                        </div>
                      </div>
                      </div> 
                
                
                      <div class="row p-t-10 hide">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="md-form form-md">
                          <label class="control-label">Borrar expediente</label><br />
                          <a class="btn btn-sm btn-danger text-white" onclick="eliminar_expediente(<?php echo $expediente['idexpedientes']; ?>)" data-toggle="tooltip" title="Eliminar">Confirmar y eliminar</a>
                        </div>
                      </div> 
                    </div>
                    </div>
                  </div>
                      <div class="col-lg-5 col-md-5 col-sm-12">
                      <div class="form-group p-r-10 p-l-10">
                         <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="row title-form">
                      Detalles del tramite
                      </div>
                    </div>
                    <div class="row p-t-20">
                  <div class="col-md-12">
                    <div class="md-form form-md">
                      <label class="control-label">Estado del tramite</label>
                      <select class="form-control custom-select" name="condicion" required>
                        <optgroup label="Establecido">
                          <?php
                          if($expediente['condicion'] == 1){ echo '<option value="1" selected>Activo</option>';} 
                          if($expediente['condicion'] == 0){ echo '<option value="0" selected>Archivado</option>';} 
                          ?> 
                        </optgroup>
                        <optgroup label="Opciones ">
                          <option value="1">Activo</option>
                          <option value="0">Archivado</option>
                        </optgroup>
                      </select>
                    </div>
                  </div>
                </div> 
                <div class="row p-t-20">
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="md-form form-md">
                      <label class="control-label">Prioridad del tramite</label>
                      <select class="form-control custom-select" name="prioridad" required>
                        <optgroup label="Establecido">
                          <?php
                          if($expediente['prioridad'] == 1){ echo '<option value="1" selected>Urgente</option>';} 
                          if($expediente['prioridad'] == 2){ echo '<option value="2" selected>Alto</option>';} 
                          if($expediente['prioridad'] == 3){ echo '<option value="3" selected>Medio</option>';} 
                          if($expediente['prioridad'] == 4){ echo '<option value="4" selected>Bajo</option>';} 
                          ?>
                        </optgroup>
                        <optgroup label="Opciones ">
                          <option value="1">Urgente</option>
                          <option value="2">Alto</option>
                          <option value="3">Medio</option>
                          <option value="4">Bajo</option>
                        </optgroup>
                      </select>
                    </div>
                  </div>
                </div> 
                <div class="row p-t-20">
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="md-form form-md">
                    <label class="control-label">Etiquetas del tramite</label>
                            <select class="form-control etiquetas" name="etiquetas[]" style="height:80px;width:100%;" required>  
                            <optgroup label="Establecido">
                              
                            <?php if(empty($etiquetas_tramite)){ ?>
                            <option disabled selected>Seleccione una etiqueta</option>
                            <?php }else{ ?>
                            <?php foreach($etiquetas_tramite as $e): ?>    
                            <option selected value="<?php echo $e['idtramites_etiquetas']; ?>"><?php echo $e['titulo']; ?></option>
                            <?php endforeach; ?>
                            <?php } ?>
                          </optgroup>
                  <optgroup label="Opciones ">
                            <?php foreach($all_etiquetas as $e): ?>    
                            <option value="<?php echo $e['idtramites_etiquetas']; ?>"><?php echo $e['titulo']; ?></option>
                            <?php endforeach; ?>
                            </optgroup>
                            </select>
                            <div id="result_etiquetas"></div>
                    </div>
                  </div>
                </div> 
                <div class="row p-t-20">
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="md-form form-md">
                    <label class="control-label">Obra relacionada al tramite</label>
                            <select class="form-control obra" name="obra[]" style="height:80px;width:100%;" required> 
                            <optgroup label="Establecido">   
                            <?php if(empty($obras_tramite)){ ?>
                            <option value="0" selected>No interviene obra</option>
                            <?php }else{ ?>
                            <?php foreach($obras_tramite as $o): ?>    
                            <option selected value="<?php echo $o['idobras']; ?>"><?php echo $o['numero'].' - '.$o['expediente'].' - '.$o['nombre']; ?></option>
                            <?php endforeach; ?>
                            <?php } ?>
                          </optgroup>
                  <optgroup label="Opciones ">
                            <?php foreach($oyp as $r): ?>    
                            <option value="<?php echo $r['idobras']; ?>"><?php echo $r['numero'].' - '.$r['expediente'].' - '.$r['nombre']; ?></option>
                            <?php endforeach; ?>
                            </optgroup>
                            </select>
                            <div id="result_obras"></div>
                    </div>
                  </div>
                </div> 





                <div class="row p-t-20">
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="md-form form-md">
                      <label class="control-label">Observaciones</label>
                      <textarea name="observaciones" class="form-control md-textarea" rows="2"><?php echo $expediente["observaciones"]; ?></textarea>
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
      $( "#select_direccion_editar" ).change(function() {
      var valor = $(this).val();
        $.post("includes/ajax/direccion-departamentos.php",  { valor: valor }).done(function(data) {
                    $('#departamentos_editar').html(data);
});
});
    </script>

<script type="text/javascript">

$(document).ready(function () {
  $('.etiquetas').select2();
  $('.obra').select2();

});
  </script>












