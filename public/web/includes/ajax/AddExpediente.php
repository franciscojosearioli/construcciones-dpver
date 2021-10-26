<?php 
require_once('../../includes/load.php');
$user = current_user();
$all_direcciones = find_all('direcciones');
$exp = $_POST['numero'];
$expediente = buscar_expediente($exp);
?>
            <form method="post" action="expedientes" id="form_agregar">
              <div class="row">
                      <div class="col-lg-7 col-md-7 col-sm-12">
                    <div class="form-group p-r-10 p-l-10">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="row title-form">
                      Informacion del tramite
                      </div>
                      </div>
                      <input type="text" name="agregar_notas" hidden>
                      <div class="row p-t-20">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <div class="md-form form-md">
                            <label class="control-label">Expediente</label>
                            <input type="text" name="expediente" id="expediente" class="form-control" required>
                          </div>
                        </div> 
                      </div>
                      <div class="row p-t-10">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="md-form form-md">
                          <label class="control-label">Asunto</label>
                          <input type="text" name="asunto" id="asunto" class="form-control" required>
                        </div>
                      </div> 
                    </div>
                      <div class="row p-t-10">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="md-form form-md">
                          <label class="control-label">Iniciador</label>
                          <input type="text" name="iniciador" id="iniciador" class="form-control" required>
                        </div>
                      </div> 
                    </div>
                      <div class="row p-t-10">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="md-form form-md">
                          <label class="control-label">Fecha de inicio</label>
                          <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" required>
                        </div>
                      </div>
                      </div> 
                <div class="row p-t-20">
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="md-form form-md">
                      <label class="control-label">Prioridad del tramite</label>
                      <select class="form-control custom-select" name="prioridad">
                        <option selected disabled>Seleccione una opcion</option>
                          <option value="1">Urgente</option>
                          <option value="2">Alto</option>
                          <option value="3">Medio</option>
                          <option value="4">Bajo</option>
                      </select>
                    </div>
                  </div>
                </div> 
                <div class="row p-t-20">
                  <div class="col-md-12">
                    <div class="md-form form-md">
                      <label class="control-label">Estado del tramite</label>
                      <select class="form-control custom-select" name="condicion">
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
                      Movimientos del tramite
                      </div>
                    </div>
                    <div class="row p-t-20">
                      <div class="col-12">
                        <label class="control-label">Direccion</label>
                        <select class="form-control custom-select" name="iddireccion" id="select_direccion_agregar">
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
                          <input type="date" name="fecha_pase" class="form-control" required>
                        </div>
                      </div>
                      </div>
                      <div class="row p-t-10">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="md-form form-md">
                          <label class="control-label">Emisor del tramite</label>
                          <input type="text" name="emisor" class="form-control" value="<?php echo $user['nombre'].' '.$user['apellido'] ?>" readonly required>
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

            <script>
                    $( "#select_direccion_agregar" ).change(function() {
      var valor = $(this).val();
        $.post("includes/ajax/direccion-departamentos.php",  { valor: valor }).done(function(data) {
                    $('#departamentos_agregar').html(data);
});
});
            </script>