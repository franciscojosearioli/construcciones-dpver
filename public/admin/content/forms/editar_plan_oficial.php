<?php
require_once('../../includes/load.php');

$user = current_user();
$data = find_by_id('plan_oficial','idplan_oficial',$_POST['id']); 

?>
	<div class="card-body" id="editar_plan_oficial">
		<form method="post" action="obra?id=<?php echo (int)$_POST['obra']; ?>" id="form_editar_plan_oficial">
            <div class="form-group p-20">
              <center><h3>Editar plan oficial</h3></center>
              <div class="row p-t-20">
                <div class="col-md-6">
                  <input type="text" name="editar_plan_oficial" value="<?php echo $data['idplan_oficial'] ?>" hidden>
                  <div class="md-form form-md">
                    <label class="control-label">Numero</label>
                    <input type="number" name="numero" class="form-control" value="<?php echo $data['numero'] ?>" required>
                  </div>
                </div>                  
                <div class="col-md-6">
                  <div class="md-form form-md">
                    <label class="control-label">Porcentaje</label>
                    <input type="number" name="avance" class="form-control" value="<?php echo $data['avance'] ?>" pattern="^\d*(\.\d{0,2})?$" required>
                  </div>
                </div>       
              </div>
            </div>
          <center>
          	<a onclick="cancelar_editar_plan_oficial()" class="btn btn-danger waves-effect waves-light text-white" >Cerrar</a>
          	<a onclick="submit_editar_plan_oficial();" class="btn btn-info waves-effect waves-light text-white">Actualizar</a>
        </center>

</form>
      </div>