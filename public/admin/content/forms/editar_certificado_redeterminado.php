<?php
require_once('../../includes/load.php');

$user = current_user();
$data = find_by_id('certificados_redeterminados','idcertificados_redeterminados',$_POST['id']); 

?>
	<div class="card-body" id="editar_certificado_redeterminado">
		<form method="post" action="obra?id=<?php echo (int)$_POST['obra']; ?>" id="form_editar_certificado_redeterminado">
            <div class="form-group p-20">
              <center><h3>Editar certificado redeterminado</h3></center>
              <div class="row p-t-20">
                <input type="text" name="editar_certificado_redeterminado" value="<?php echo $data['idcertificados_redeterminados']; ?>" hidden>
          <div class="col-sm-4">
        <div class="md-form form-md">
          <label class="control-label">Expediente</label>
          <input type="number" name="expediente" class="form-control" value="<?php echo $data['expediente']; ?>" required>
        </div>
            </div> 
          <div class="col-sm-4">
        <div class="md-form form-md">
          <label class="control-label">Numero</label>
          <input type="text" name="numero" class="form-control" value="<?php echo $data['numero']; ?>" required>
        </div>
            </div>                  
          <div class="col-sm-4">
        <div class="md-form form-md">
          <label class="control-label">Fecha</label>
          <input type="text" name="fecha" class="form-control" value="<?php echo $data['fecha']; ?>" required>
        </div>
            </div>         
             </div>
         </div>
       <div class="form-group">
       <div class="row">
          <div class="col-sm-12">
        <div class="md-form form-md">
          <label class="control-label">Informacion de adecuacion</label>
          <input type="text" name="informacion" class="form-control" value="<?php echo $data['informacion']; ?>" required>
        </div>
            </div> 
            </div>
            </div>         
       <div class="form-group">
       <div class="row">
          <div class="col-sm-12">
        <div class="md-form form-md">
          <label class="control-label">Monto provisorio</label>
          <input type="number" name="monto_provisorio" id="provisorio" class="form-control" pattern="^\d*(\.\d{0,2})?$" value="<?php echo $data['monto_provisorio']; ?>">
        </div>
            </div>                       
             </div>
       <div class="row">
          <div class="col-sm-12">
        <div class="md-form form-md">
          <label class="control-label">Monto definitivo</label>
          <input type="number" name="monto_definitivo" id="definitivo" class="form-control" pattern="^\d*(\.\d{0,2})?$" value="<?php echo $data['monto_definitivo']; ?>">
        </div>
            </div>                       
             </div>             
         </div> 



          <center>
          	<a onclick="cancelar_editar_certificado_redeterminado()" class="btn btn-danger waves-effect waves-light text-white" >Cerrar</a>
          	<a onclick="submit_editar_certificado_redeterminado();" class="btn btn-info waves-effect waves-light text-white">Actualizar</a>
        </center>

</form>
      </div>