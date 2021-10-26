<?php
require_once('../../includes/load.php');

$user = current_user();
$etiqueta = find_by_id('tramites_etiquetas','idtramites_etiquetas',$_POST['id']);

?>
      <div class="row form-center" >
        <div class="col-lg-12 col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
              <div class="col-12">
                                        <div class="d-flex flex-wrap">
                                            <div>
                                                <h3 class="card-title">Editar etiqueta</h3>
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
            <form method="post" action="tramites-etiquetas" id="form_editar">
              <div class="row">


                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="form-group p-r-10 p-l-10">
                    <input type="text" name="editar_etiqueta" value="<?php echo $etiqueta['idtramites_etiquetas']; ?>" hidden>
                <div class="row p-t-20">
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="md-form form-md">
                      <label class="control-label">Titulo</label>
                      <input type="text" name="titulo" class="form-control" value="<?php echo $etiqueta['titulo']; ?>" required>
                    </div>
                  </div> 
                  <div class="col-lg-8 col-md-8 col-sm-12">
                    <div class="md-form form-md">
                      <label class="control-label">Descripcion</label>
                      <input type="text" name="descripcion" class="form-control" value="<?php echo $etiqueta['descripcion']; ?>" required>
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
    </div>