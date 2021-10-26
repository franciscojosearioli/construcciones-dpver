      <div class="card-body hide" id="agregar_certificado">
<form method="post" action="obra?id=<?php echo (int)$_GET['id']; ?>" id="form_agregar_certificado">
            <div class="form-group p-20">
              <center><h3>Agregar certificado</h3></center>
              <div class="row p-t-20">
                <input type="text" name="agregar_certificado" hidden>
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
                    <input type="number" name="monto" pattern="^\d*(\.\d{0,2})?$" class="form-control" required>
                  </div>
                </div>                       
               <div class="col-md-4">
                  <div class="md-form form-md">
                    <label class="control-label">Porcentaje</label>
                    <input type="text" name="avance" pattern="^\d*(\.\d{0,2})?$" class="form-control" required>
                  </div>
                </div>  
              </div>        
            </div>
          <center>
          <a onclick="cancelar_agregar_certificado()" class="btn btn-danger waves-effect waves-light text-white">Cerrar</a>
          <a onclick="submit_agregar_certificado();" class="btn btn-info waves-effect waves-light text-white">Agregar</a>
        </center>

</form>
      </div>