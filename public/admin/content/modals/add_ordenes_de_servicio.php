<?php $obra = find_by_id('obras', 'idobras', (int)$_GET['id']); ?>
<div class="modal fade" id="add_ordenes_de_servicio" tabindex="-1" role="dialog" aria-labelledby="add_ordenes_de_servicio" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100" id="add_ordenes_de_servicio">Cargar nuevo documento</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="obra.php?id=<?php echo $obra['idobras']; ?>" name="form_ordenes_de_servicio" method="post" enctype="multipart/form-data">
      <div class="modal-body">
          <div class="card-body">
            <div class="row justify-content-center">          
           <h5 class="p-b-20"><b>ORDEN DE SERVICIO</b></h5>
            <div class="row justify-content-center">
            <div class="col-lg-6 col-md-6 col-sm-12">
            <input type="text" name="idobra" value="<?php echo $obra['idobras'];?>" hidden>
            <input type="text" name="caja" value="<?php echo $obra['numero'];?>" hidden>
            <div class="form-group">
            <label for="numero_informe"> Numero <span class="danger">*</span> </label>
            <input type="number" class="form-control required" name="numero" required> 
            <small class="form-control-feedback"> Indique el numero del documento. </small>
            </div>
            <div class="form-group">
            <label for="fecha_informe"> Asunto <span class="danger">*</span> </label>
            <input type="text" name="asunto" class="form-control required" required>
            <small class="form-control-feedback"> Indique un asunto o refencia del documento. </small>
            </div>
            <div class="form-group">
            <label for="fecha_informe"> Documento <span class="danger">*</span> </label>
            <input type="file" name="archivo" id="input-file-now-custom-1" class="dropify-es" required />
            <small class="form-control-feedback"> Seleccione o arrastre el archivo. </small>
            </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
            <p>El documento debe cumplir con los siguientes requisitos:</p>
            <li>El documento debe ser unico y en formato de archivos pdf.</li>
            <li>El informe debe presentarse en el siguiente orden:
            <ol>
            <li>Nota de elevacion</li>
            <li>Anexos</li>
            </ol>
            </li>
            </div>
            </div>    
            </div>                                    
        </div>
        </div>
        <div class="modal-footer">
          <button type="submit" name="add_ordenes_de_servicio" class="btn btn-info waves-effect waves-light">Agregar nuevo</button>
        </div>
      </form>
    </div>
  </div>
</div>