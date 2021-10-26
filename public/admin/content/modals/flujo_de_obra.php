<?php $obra = find_by_id('obras','idobras',(int)$_GET['id']); ?>

<div class="modal fade" id="flujo_de_obra" tabindex="-1" role="dialog" aria-labelledby="flujo_de_obra" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100" id="flujo_de_obra">Flujo de obra</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<form method="post" action="obra?id=<?php echo $obra['idobras'];?>" enctype="multipart/form-data">
      <div class="modal-body">
        <div class="form-group p-20">
          <div class="row p-20 justify-content-center">       
            <h5><b>FLUJO DE OBRA</b></h5>
          </div>     
          <div class="row">
            <div class="col-lg-12 col-md-12">
              <input type="file" name="archivo" id="input-file-now-custom-1" class="dropify-es" 
              <?php if(!empty($obra['flujo_de_obra'])){ ?> data-default-file="<?php echo '../../../uploads/Obras/'.$obra['numero'].'/Certificacion/Ultimo/'.$obra['flujo_de_obra']; ?>" <?php } ?> />
              <input type="text" name="obra_id" value="<?php echo $obra['idobras'];?>" hidden>
              <input type="text" name="caja" value="<?php echo $obra['numero'];?>" hidden>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button name="flujo_de_obra" class="btn btn-info waves-effect waves-light">Actualizar</button>
      </div>
    </form>
    </div>
  </div>
</div>