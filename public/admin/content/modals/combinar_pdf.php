<?php $obra = find_by_id('obras','idobras',(int)$_GET['id']); ?>
<div class="modal fade" id="combinar_pdf" tabindex="-1" role="dialog" aria-labelledby="combinar_pdf" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100" id="combinar_pdf">Combinar varios archivos pdf en uno solo</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form method="post" action="obra?id=<?php echo $obra['idobras'];?>" enctype="multipart/form-data">
      <div class="modal-body">
          <div class="card-body">
              <div class="form-group p-20">
                <div class="row">       
                <h5><b>Carge los archivos</b></h5>
              </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12">
<input type="file" name="certificado" id="input-file-now-custom-1" class="dropify-es" 
  <?php if(!empty($obra['certificado_archivo'])){ ?> data-default-file="<?php echo '../../../uploads/Obras/'.$obra['numero'].'/Certificacion/Ultimo/Certificado_'.$obra['certificado_archivo']; ?>" <?php } ?> />
<input type="text" name="obra_id" value="<?php echo $obra['idobras'];?>" hidden>
<input type="text" name="caja" value="<?php echo $obra['numero'];?>" hidden>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" name="combinar_pdf" class="btn btn-info waves-effect waves-light">Guardar cambios</button>
      </div>
        </form>
    </div>
  </div>
</div>
</div>