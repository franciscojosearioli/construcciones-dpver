<div class="modal fade" id="add_relevamiento" tabindex="-1" role="dialog" aria-labelledby="add_relevamiento" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100" id="add_relevamiento">Agregar relevamiento</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="card-body">
           <form action="relevamientos" name="carga-datos" method="post" enctype="multipart/form-data">
                  <div class="form-group p-20">
            <div class="row p-20 justify-content-center">       
              <h5><b>NUEVO RELEVAMIENTO</b></h5>
            </div>    
                    <div class="row p-t-20">
                      <div class="col-md-6">
                        <div class="md-form form-md">
                          <label class="control-label">Numero de expediente</label>
                          <input type="number" name="expediente" class="form-control">
                        </div>
                      </div>                  
                      <div class="col-md-6">
                        <div class="md-form form-md">
                          <label class="control-label">Referencia de nota</label>
                          <input type="text" name="nota" class="form-control">
                        </div>
                      </div> 
                    </div>
                      <div class="row p-t-20">
                        <div class="col-md-12">
                          <div class="md-form form-md">
                          <label class="control-label">Nombre</label>
                            <input type="text" name="nombre" class="form-control" required>
                          </div>
                        </div> 
                      </div>
                      <div class="row p-t-20">
                        <div class="col-md-12">
                          <div class="md-form form-md">
                          <label class="control-label">Ubicacion</label>
                            <input type="text" name="ubicacion" class="form-control" required>
                          </div>
                        </div> 
                      </div>
                      <div class="row p-t-20">
                        <div class="col-md-12">
                        <div class="input-default-wrapper mt-5">
            <div class="row justify-content-center">       
              <h5><b>ARCHIVO</b></h5>
            </div>  
<input type="file" name="archivo" id="input-file-now-custom-1" class="dropify-es" required />
  </label>
                        </div> 
                      </div>
                    </div>
            </div>
          </div>  
        </div>
        <div class="modal-footer">
          <button type="submit" name="add_relevamiento" class="btn btn-info waves-effect waves-light">Guardar cambios</button>
        </form>
      </div>
    </div>
  </div>
</div>