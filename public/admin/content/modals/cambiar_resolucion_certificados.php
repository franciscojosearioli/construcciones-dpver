<?php
require_once('../../includes/load.php');
 $cert = find_by_id('certificados_obras','idcertificados_obras',$_POST['id']) ?>
<!-- Central Modal Small -->
<div class="modal fade" id="certificaciones_resoluciones" tabindex="-1" role="dialog" aria-labelledby="certificaciones_resoluciones" aria-hidden="true">

  <!-- Change class .modal-sm to change the size of the modal -->
  <div class="modal-dialog modal-md" role="document">

    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100" id="certificaciones_resoluciones">Aprobacion del certificado</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card-body">
          
            <div class="form-group p-20">
              <form method="post" action="certificados" id="formulario_certificado_reso">
                <input type="text" name="certificado_resolucion_id" value="<?php echo $cert['idcertificados_obras'] ?>" hidden>
               <div class="row p-t-20">
                  <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="md-form form-md">
                      <label class="control-label">Numero de resolucion</label>
                      <input name="change_reso_cert" class="form-control" type="text" value="<?php echo $cert["expediente"]; ?>">
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="md-form form-md">
                      <label class="control-label">Fecha resolucion</label>
                      <input name="change_fechareso_cert" class="form-control" type="date" value="<?php echo $cert["expediente"]; ?>">
                    </div>
                  </div>
                </div>
                
          </div>
        </div>
        <div class="modal-footer">
<button type="submit" id="enviar_certificado_reso" class="btn btn-info waves-effect waves-light m-r-10">Guardar</button>
              </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
$("#enviar_certificado_reso"). click(function(){
$("#formulario_certificado_reso"). submit(); 
});
</script>
