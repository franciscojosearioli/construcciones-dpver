<div class="row justify-content-center hide" id="form_agregar">
<div class="row justify-content-center">
  <div class="col-8">
    <div class="card">
      <div class="card-body cards-titulo">
        <div class="d-flex flex-wrap">
          <div class="my-auto ml-3">
            Agregar nuevo registro
          </div>
          <div class="ml-auto my-auto mr-3">
            <a onclick="cancelar_agregar()" title="Cerrar" data-toggle="tooltip"><i class="fas fa-times"></i></a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <form method="post" action="armarios" id="form_agregar">
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
              <div class="form-group p-r-10 p-l-10">
                <input type="text" name="add_armario" hidden>
                <div class="row p-t-20">
                  <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="md-form form-md">
                      <label class="control-label">Numero de armario</label>
                      <input type="text" name="numero" id="numeroo" class="form-control" required>
                    </div>
                  </div> 
                  <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="md-form form-md">
                      <label class="control-label">Numero de caja o carpeta</label>
                      <input type="text" name="caja_carpeta" id="caja" class="form-control" >
                    </div>
                  </div> 
                </div>
                <div class="row p-t-10">
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="md-form form-md">
                      <label class="control-label">Obra</label>
                      <input type="text" name="obra" id="obra" class="form-control" required>
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
        </form>
            </div>  
    </div>
  </div>
</div>
</div>