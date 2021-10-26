<?php
require_once('../../includes/load.php');
$user = current_user();
$all_direcciones = find_all('direcciones');
?>
      <div class="row form-center hide" id="agregar_equipos">
        <div class="col-lg-12 col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
              <div class="col-12">
                                        <div class="d-flex flex-wrap">
                                            <div>
                                                <h3 class="card-title">Agregar nuevo equipo</h3>
                                                <h6 class="card-subtitle"><?php echo find_select('nombre','departamentos','iddepartamentos',$user['iddepartamentos']) ?> - <?php echo find_select('nombre','direcciones','iddireccion',$user['iddireccion']) ?></h6>
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
            <form method="post" action="equipos-registrados" id="form_agregar">
              <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="form-group p-r-10 p-l-10">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="row title-form">
                      Informacion de equipo
                      </div>
                      </div>
                      <input type="text" name="agregar_equipo" hidden>
                      <div class="row p-t-20">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <div class="md-form form-md">
                            <label class="control-label">Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" required>
                          </div>
                        </div> 
                      </div>
                      <div class="row p-t-20">
                        <div class="col-lg-8 col-md-8 col-sm-12">
                          <div class="md-form form-md">
                            <label class="control-label">Patente</label>
                            <input type="text" name="patente" class="form-control" required>
                          </div>
                        </div> 
                        <div class="col-lg-4 col-md-4 col-sm-12">
                          <div class="md-form form-md">
                            <label class="control-label">Estado</label>
                            <select class="form-control custom-select" name="estado" required>
                  <option disabled selected>Seleccione una opcion</option>
                  <option value="1">Activo</option>
                  <option value="0">Inactivo</option>
                </select>
                          </div>
                        </div> 
                      </div>
                      <?php if($user['idroles'] == 1){ ?>
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
                    <?php } ?>
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
      $( "#select_direccion_agregar" ).change(function() {
      var valor = $(this).val();
        $.post("includes/ajax/direccion-departamentos.php",  { valor: valor }).done(function(data) {
                    $('#departamentos_agregar').html(data);
});
});
    </script>