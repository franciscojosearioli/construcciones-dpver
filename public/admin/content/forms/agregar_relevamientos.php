<?php
require_once('../../includes/load.php');

$user = current_user();

 ?>
      <div class="row form-center hide" id="agregar_relevamientos">
        <div class="col-lg-12 col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
              <div class="col-12">
                                        <div class="d-flex flex-wrap">
                                            <div>
                                                <h3 class="card-title">Agregar nuevo relevamiento</h3>
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
            <form method="post" action="relevamientos" id="form_agregar" enctype="multipart/form-data">
              <div class="row">
                      <div class="col-lg-7 col-md-7 col-sm-12">
                    <div class="form-group p-l-10 p-r-10">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="row title-form">
                      Informacion general
                      </div>
                      </div>
                      <input type="text" name="agregar_relevamientos" hidden>
                      <div class="row p-t-20">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                          <label class="control-label">Solicitud </label>
                                <div class="demo-radio-button">
                                    <input name="solicitud" type="radio" id="solicitud_expediente" value="expediente" onchange="mostrar(this.value);">
                                    <label for="solicitud_expediente">Expediente</label>
                                    <input name="solicitud" type="radio" id="solicitud_nota" value="nota" onchange="mostrar(this.value);">
                                    <label for="solicitud_nota">Nota / Pedido</label>
                                </div>         


                        <div class="md-form form-md"  id="expediente">
                          <label class="control-label">Expediente </label>
                          <input type="text" name="expediente" class="form-control">
                        </div>
                        <div class="md-form form-md"  id="nota">
                          <label class="control-label">Nota </label>
                          <input type="text" name="nota" class="form-control">
                        </div>


                      </div>
                      </div> 
                      <div class="row p-t-10">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <div class="md-form form-md">
                            <label class="control-label">Descripcion</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" required>
                          </div>
                        </div> 
                      </div>
                      <div class="row p-t-10">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="md-form form-md">
                          <label class="control-label">Ubicacion</label>
                          <input type="text" name="ubicacion" class="form-control" required>
                        </div>
                      </div> 
                    </div>
                    </div>
                  </div>
                      <div class="col-lg-5 col-md-5 col-sm-12">
                      <div class="form-group p-r-10 p-l-10">
                         <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="row title-form">
                      Archivo adjunto
                      </div>
                    </div>
                      <div class="row p-t-20">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <input type="file" name="archivo" id="input-file-now-custom-1" class="dropify-es" required />
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
      $(document).ready(function(){
  $('#expediente').hide();
  $('#nota').hide();  

});
    </script>