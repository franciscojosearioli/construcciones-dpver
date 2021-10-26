<?php $empresas = find_all('empresas'); ?>
<div class="row justify-content-center hide" id="ver_form_agregar">
<div class="row justify-content-center">
  <div class="col-8">
    <div class="card">
      <div class="card-body">
      <div class="d-flex flex-wrap">
        <div>
            <h3 class="card-title">Agregar nuevo contacto de empresa</h3>
            <h6 class="card-subtitle"><?php echo find_select('nombre','departamentos','iddepartamentos',$user['iddepartamentos']) ?> - <?php echo find_select('nombre','direcciones','iddireccion',$user['iddireccion']) ?></h6>
        </div>
          <div class="ml-auto my-auto mr-3">
            <a onclick="cancelar_agregar()" title="Cerrar" data-toggle="tooltip"><i class="fas fa-times"></i></a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <form method="post" action="empresas-contactos" id="form_agregar">
          <div class="row">
            <div class="col-lg-7 col-md-7 col-sm-12">
              <div class="form-group p-r-10 p-l-10">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="row title-form">
                    Informacion general
                  </div>
                </div>
                <input type="text" name="add_contacto_empresa" hidden>
                <div class="row p-t-20">
                  <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="md-form form-md">
                      <label class="control-label">Nombre</label>
                      <input type="text" name="nombre" id="nombre" class="form-control" required>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="md-form form-md">
                      <label class="control-label">Apellido</label>
                      <input type="text" name="apellido" id="apellido" class="form-control" required>
                    </div>
                  </div> 
                </div>
                <div class="row p-t-10">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="md-form form-md">
                      <label class="control-label">Correo electronico</label>
                      <input type="text" name="email" id="email" class="form-control" required>
                    </div>
                  </div>  
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="md-form form-md">
                      <label class="control-label">Telefono</label>
                      <input type="text" name="telefono" id="telefono" class="form-control" required>
                    </div>
                  </div> 
                </div>
              </div>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-12">
              <div class="form-group p-r-10 p-l-10">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="row title-form">
                    Informacion de empresa
                  </div>
                </div>
                <div class="row p-t-20">
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="md-form form-md">
                      <label class="control-label">Empresa</label>
                      <select class="form-control custom-select" name="empresa" required> 
                        <option disabled selected>Seleccione una empresa</option>
                        <?php foreach($empresas as $e): ?>
                          <option value="<?php echo $e['idempresas']; ?>"><?php echo $e['nombre']; ?></option> 
                          <?php endforeach; ?>
                      </select>
                    </div>
                  </div> 
                </div>
                <div class="row p-t-10">
                  <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="md-form form-md">
                      <label class="control-label">Cargo</label>
                      <input type="text" name="cargo" id="cargo" class="form-control" required>
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
</div>