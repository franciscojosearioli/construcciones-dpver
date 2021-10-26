<?php
require_once('../../includes/load.php');

$user = current_user();
$data = find_by_id('certificados','idcertificados',$_POST['id']); 

?>
	<div class="card-body" id="editar_certificado">
		<form method="post" action="obra?id=<?php echo (int)$_POST['obra']; ?>" id="form_editar_certificado">
            <div class="form-group p-20">
              <center><h3>Editar certificado</h3></center>
              <div class="row p-t-20">
                <input type="text" name="editar_certificado" value="<?php echo $data['idcertificados']; ?>" hidden>
                <div class="col-md-4">
                  <div class="md-form form-md">
                    <label class="control-label">Expediente</label>
                    <input type="number" name="expediente" class="form-control" value="<?php echo $data['expediente'] ?>" required>
                  </div>
                </div>   
                <div class="col-md-4">
                  <div class="md-form form-md">
                    <label class="control-label">Numero</label>
                    <input type="text" name="numero" class="form-control" value="<?php echo $data['numero'] ?>" required>
                  </div>
                </div>                  
                <div class="col-md-4">
                  <div class="md-form form-md">
                    <label class="control-label">Fecha</label>
                    <input type="text" name="fecha" class="form-control" value="<?php echo $data['fecha'] ?>" required>
                  </div>
                </div>   
              </div>
              <div class="row p-t-20">
                <div class="col-md-8">
                  <div class="md-form form-md">
                    <label class="control-label">Monto del certificado</label>
                    <input type="number" name="monto" class="form-control" value="<?php echo $data['monto'] ?>" pattern="^\d*(\.\d{0,2})?$" required>
                  </div>
                </div>                       
               <div class="col-md-4">
                  <div class="md-form form-md">
                    <label class="control-label">Porcentaje</label>
                    <input type="text" name="avance" class="form-control" value="<?php echo $data['avance'] ?>" pattern="^\d*(\.\d{0,2})?$" required>
                  </div>
                </div>  
              </div>        
            </div>
          <center>
          	<a onclick="cancelar_editar_certificado()" class="btn btn-danger waves-effect waves-light text-white" >Cerrar</a>
          	<a onclick="submit_editar_certificado();" class="btn btn-info waves-effect waves-light text-white">Actualizar</a>
        </center>

</form>
      </div>