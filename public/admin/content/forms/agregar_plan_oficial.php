      <div class="card-body hide" id="agregar_plan_oficial">
<form method="post" action="obra?id=<?php echo (int)$_GET['id']; ?>" id="form_agregar_plan_oficial">
            <div class="form-group p-20">
              <center><h3>Agregar plan oficial</h3></center>
              <div class="row p-t-20">
                <div class="col-md-6">
                  <input type="text" name="agregar_plan_oficial" hidden>
                  <div class="md-form form-md">
                    <label class="control-label">Numero</label>
                    <input type="number" name="numero" class="form-control" required>
                  </div>
                </div>                  
                <div class="col-md-6">
                  <div class="md-form form-md">
                    <label class="control-label">Porcentaje</label>
                    <input type="number"name="avance" class="form-control" pattern="^\d*(\.\d{0,2})?$" required>
                  </div>
                </div>       
              </div>
            </div>
          <center>
          <a onclick="cancelar_agregar_plan_oficial()" class="btn btn-danger waves-effect waves-light text-white">Cerrar</a>
          <a onclick="submit_agregar_plan_oficial();" class="btn btn-info waves-effect waves-light text-white">Agregar</a>
        </center>

</form>
      </div>