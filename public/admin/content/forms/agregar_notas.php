<?php
require_once('../../includes/load.php');
$user = current_user();
$all_direcciones = find_all('direcciones');
$tramites_etiquetas = find_all_by_id('tramites_etiquetas','condicion',1);
$oyp = all_oyp();
?>
      <div class="row form-center hide" id="agregar_notas">
        <div class="col-lg-12 col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
              <div class="col-12">
                                        <div class="d-flex flex-wrap">
                                            <div>
                                                <h3 class="card-title">Nueva Presentacion / Nota </h3>
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
            <form method="post" action="tramites" id="form_agregar_nota">
              <div class="row">
                      <div class="col-lg-7 col-md-7 col-sm-12">
                    <div class="form-group p-r-10 p-l-10">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="row title-form">
                      Informacion del tramite
                      </div>
                      </div>
                      <input type="text" name="add_notas" hidden>
                      <div class="row p-t-20">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <div class="md-form form-md">
                            <label class="control-label">Numero de nota</label>
                            <input type="number" name="numero" class="form-control" required>
                          </div>
                        </div> 
                      </div>
                      <div class="row p-t-10">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="md-form form-md">
                          <label class="control-label">Asunto</label>
                          <input type="text" name="asunto" class="form-control" required>
                        </div>
                      </div> 
                    </div>
                      <div class="row p-t-10">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="md-form form-md">
                          <label class="control-label">Iniciador</label>
                          <input type="text" name="iniciador" class="form-control" required>
                        </div>
                      </div> 
                    </div>
                      <div class="row p-t-10">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="md-form form-md">
                          <label class="control-label">Fecha de inicio</label>
                          <input type="date" name="fecha_inicio" class="form-control" required>
                        </div>
                      </div>
                      </div> 
                <div class="row p-t-20">
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="md-form form-md">
                    <label class="control-label">Etiquetas del tramite</label>
                            <select class="form-control etiquetas" name="etiquetas[]" style="height:80px;width:100%;" required>    
                            <?php foreach($tramites_etiquetas as $e): ?>    
                            <option value="<?php echo $e['idtramites_etiquetas']; ?>"><?php echo $e['titulo']; ?></option>
                            <?php endforeach; ?>
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
                            <option value="0" selected>No interviene obra</option>
                            <?php foreach($oyp as $r): ?>    
                            <option value="<?php echo $r['idobras']; ?>"><?php echo $r['numero'].' - '.$r['expediente'].' - '.$r['nombre']; ?></option>
                            <?php endforeach; ?>
                            </select>
                            <div id="result_etiquetas"></div>
                    </div>
                  </div>
                </div> 
                <div class="row p-t-20">
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="md-form form-md">
                      <label class="control-label">Prioridad del tramite</label>
                      <select class="form-control custom-select" name="prioridad" required>
                          <option value="1" selected>Urgente</option>
                          <option value="2">Alto</option>
                          <option value="3">Medio</option>
                          <option value="4">Bajo</option>
                      </select>
                    </div>
                  </div>
                </div> 
                <div class="row p-t-20 hide">
                  <div class="col-md-12">
                    <div class="md-form form-md">
                      <label class="control-label">Estado del tramite</label>
                      <select class="form-control custom-select" name="condicion" required>
                          <option value="1" selected>Activo</option>
                          <option value="0">Archivado</option>
                      </select>
                    </div>
                  </div>
                </div> 
                    </div>
                  </div>
                      <div class="col-lg-5 col-md-5 col-sm-12">
                      <div class="form-group p-r-10 p-l-10">
                         <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="row title-form">
                      Ingreso / Pase del tramite
                      </div>
                    </div>
                    <div class="row p-t-20">
                      <div class="col-12">
                        <label class="control-label">Direccion</label>
                        <select class="form-control custom-select" name="iddireccion" id="select_direccion_agregar" required>
                          <option selected disabled>Seleccione una direccion</option>
                          <?php foreach ($all_direcciones as $direccion ):?>
                            <option value="<?php echo $direccion['iddireccion'];?>"><?php echo ucwords($direccion['nombre']);?></option>
                          <?php endforeach;?>
                        </select>
                      </div> 
                    </div>
                    <div id="departamentos_agregar"></div>
                      <div class="row p-t-10">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="md-form form-md">
                          <label class="control-label">Fecha del pase</label>
                          <input type="date" name="fecha_pase" class="form-control" value="<?php echo date("Y-m-d");?>" required>
                        </div>
                      </div>
                      </div>
                      <div class="row p-t-10">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="md-form form-md">
                          <label class="control-label">Emisor del tramite</label>
                          <input type="text" name="emisor" class="form-control" required>
                        </div>
                      </div>
                      </div>
                      <div class="row p-t-10">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="md-form form-md">
                          <label class="control-label">Receptor del tramite</label>
                          <input type="text" name="receptor" class="form-control" required>
                        </div>
                      </div>
                      </div>
                <div class="row p-t-20">
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="md-form form-md">
                      <label class="control-label">Observaciones</label>
                      <textarea name="observaciones" class="form-control md-textarea" rows="2"></textarea>
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
                                                <h6 class="text-muted"><a onclick="cancelar_agregar()" class="dropdown-item a-icon" data-toggle="tooltip" title="Cancelar"><i class="fas fa-times fa-2x"></i></a></h6>
                                            </div>
                                            <div class="ml-auto">
                                                <ul class="list-inline">
                                                    <li>
                                                        <h6 class="text-muted"><a onclick="submit_agregar_nota();" class="dropdown-item a-icon" data-toggle="tooltip" title="Confirmar"><i class="fas fa-check fa-2x"></i></a></h6> 
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
      $( "#select_direccion_agregar" ).change(function() {
      var valor = $(this).val();
        $.post("includes/ajax/direccion-departamentos.php",  { valor: valor }).done(function(data) {
                    $('#departamentos_agregar').html(data);
});
});
    </script>
<script type="text/javascript">
$(document).ready(function () {
  $('.etiquetas').select2();
  $('.obra').select2();
});

  </script>