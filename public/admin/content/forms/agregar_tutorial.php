<div class="row justify-content-center hide" id="ver_form_agregar">
<div class="row justify-content-center">
  <div class="col-8">
    <div class="card">
      <div class="card-body cards-titulo">
        <div class="d-flex flex-wrap">
          <div class="my-auto ml-3">
            Agregar tutorial
          </div>
          <div class="ml-auto my-auto mr-3">
            <a onclick="cancelar_agregar()" title="Cerrar" data-toggle="tooltip"><i class="fas fa-times"></i></a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <form method="post" action="ayuda" id="form_agregar" enctype="multipart/form-data">
          <div class="row"><div class="col-lg-12 col-md-12 col-sm-12" >
                  <div class="row title-form p-20">
                    Informacion general
                  </div>
                </div>
            <div class="col-lg-7 col-md-7 col-sm-12">
              <div class="form-group p-r-10 p-l-10">
                
                <input type="text" name="add_tutorial" hidden>
                <div class="row p-t-20">
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="md-form form-md">
                      <label class="control-label">Nombre</label>
                      <input type="text" name="titulo" id="asunto" class="form-control" required>
                    </div>
                  </div> 
                </div>
                <div class="row p-t-10">
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="md-form form-md">
                      <label class="control-label">Descripcion</label>
                      <textarea name="descripcion" class="form-control" row="2" required></textarea>
                    </div>
                  </div> 
                </div>
              </div>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-12">
              <div class="form-group p-r-10 p-l-10">
                <div class="row p-t-20">
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="md-form form-md">
                      <label class="control-label">Estado</label>
                      <select class="form-control custom-select" name="condicion" required> 
                        <option value="1" selected>Activo</option>
                        <option value="0">Inactivo</option>
                      </select>
                    </div>
                  </div> 
                </div>
                <div class="row p-t-20">
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="md-form form-md">
                      <label class="control-label">Archivo</label>
                      <input type="file" name="archivo" id="input-file-now-custom-1" class="dropify-es" />

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