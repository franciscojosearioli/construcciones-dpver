<div class="modal fade" id="add_equipo" tabindex="-1" role="dialog" aria-labelledby="add_equipo" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100" id="add_equipo">Agregar nuevo</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="card-body">
            <form method="post" action="equipos-registrados">
                    <div class="form-group p-20">
                      <div class="row">
                        <div class="col-12">
                          <div class="md-form form-md">
                            <label class="control-label">Nombre</label>
                            <input type="text" name="nombre" class="form-control" required>
                          </div>
                        </div> 
                      </div>
                      <div class="row p-t-20">
                      <div class="col-md-12">
                        <div class="md-form form-md">
                          <label class="control-label">Patente</label>
                          <input type="text" name="patente" class="form-control" required>
                        </div>
                      </div> 
                      </div>
                  </div>
            </div>
          </div>  
        </div>
        <div class="modal-footer">
          <button type="submit" name="add_equipo" class="btn btn-info waves-effect waves-light ml-auto">Guardar cambios</button>
        </form>
      </div>
    </div>
  </div>
</div>