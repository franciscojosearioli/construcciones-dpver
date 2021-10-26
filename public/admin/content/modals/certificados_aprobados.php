<div class="modal fade" id="certificados_aprobados" tabindex="-1" role="dialog" aria-labelledby="certificados_aprobados" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100" id="certificados_aprobados">Certificado de obra</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card-body">
          <form method="post" action="obra?id=<?php echo (int)$_GET['id']; ?>">
            <div class="form-group p-20">
              <div class="row p-t-20">
                <div class="col-md-4">
                  <div class="md-form form-md">
                    <label class="control-label">Expediente</label>
                    <input type="number" name="expediente" class="form-control" required>
                  </div>
                </div>   
                <div class="col-md-4">
                  <div class="md-form form-md">
                    <label class="control-label">Numero</label>
                    <input type="text" name="numero" class="form-control" required>
                  </div>
                </div>                  
                <div class="col-md-4">
                  <div class="md-form form-md">
                    <label class="control-label">Fecha</label>
                    <input type="text" name="fecha" class="form-control" required>
                  </div>
                </div>   
              </div>
              <div class="row p-t-20">
                <div class="col-md-8">
                  <div class="md-form form-md">
                    <label class="control-label">Monto del certificado</label>
                    <input type="number" name="monto" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" class="form-control" required>
                  </div>
                </div>                       
               <div class="col-md-4">
                  <div class="md-form form-md">
                    <label class="control-label">Porcentaje</label>
                    <input type="text" name="avance" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" class="form-control" required>
                  </div>
                </div>  
              </div>        
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" name="certificados_aprobados" class="btn btn-info waves-effect waves-light">Agregar nuevo</button>
        </form>
      </div>
    </div>
  </div>
</div>