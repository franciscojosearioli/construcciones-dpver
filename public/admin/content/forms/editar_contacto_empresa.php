<?php
require_once('../../includes/load.php');

$user = current_user();
$contacto = find_by_id('empresas_contactos','idcontactos',$_POST['id']);
$empresas = find_all('empresas'); 

?>
      <div class="row form-center" id="editar_empresas_contactos">
        <div class="col-lg-12 col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
              <div class="col-12">
                                        <div class="d-flex flex-wrap">
                                            <div>
                                                <h3 class="card-title">Editar contacto de empresa</h3>
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
            <form method="post" action="empresas-contactos" id="form_editar">
              <div class="row">


                <div class="col-lg-7 col-md-7 col-sm-12">
                    <div class="form-group p-r-10 p-l-10">

                <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="row title-form">
                Informacion general
                </div>
                </div>
                      <input type="text" name="editar_contacto_empresa" value="<?php echo $contacto['idcontactos']; ?>" hidden>
                      <div class="row p-t-20">
                  <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="md-form form-md">
                      <label class="control-label">Nombre</label>
                      <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo $contacto['nombre']; ?>" required>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="md-form form-md">
                      <label class="control-label">Apellido</label>
                      <input type="text" name="apellido" id="apellido" class="form-control" value="<?php echo $contacto['apellido']; ?>" required>
                    </div>
                  </div> 
                </div>
                <div class="row p-t-10">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="md-form form-md">
                      <label class="control-label">Correo electronico</label>
                      <input type="text" name="email" id="email" class="form-control" value="<?php echo $contacto['email']; ?>" required>
                    </div>
                  </div>  
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="md-form form-md">
                      <label class="control-label">Telefono</label>
                      <input type="text" name="telefono" id="telefono" class="form-control" value="<?php echo $contacto['telefono']; ?>" required>
                    </div>
                  </div> 
                </div>

                </div> 
                </div>


                <div class="col-lg-5 col-md-5 col-sm-12">
              <div class="form-group p-r-10 p-l-10">

                <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="row title-form">
                    Informacion de contacto
                  </div>
                </div>
                <div class="row p-t-20">
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="md-form form-md">
                      <label class="control-label">Empresa</label>
                      <select class="form-control custom-select" name="empresa" required> 
                        <optgroup>
                        <option value="<?php echo $contacto['idempresas']; ?>" selected><?php echo find_select('nombre','empresas','idempresas',$contacto["idempresas"]); ?></option>
                        </optgroup>
                        <optgroup>
                        <?php foreach($empresas as $e): ?>
                          <option value="<?php echo $e['idempresas']; ?>"><?php echo $e['nombre']; ?></option> 
                          <?php endforeach; ?>
                        </optgroup>
                      </select>
                    </div>
                  </div> 
                </div>
                <div class="row p-t-10">
                  <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="md-form form-md">
                      <label class="control-label">Cargo</label>
                      <input type="text" name="cargo" id="cargo" class="form-control" value="<?php echo $contacto['cargo']; ?>" required>
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