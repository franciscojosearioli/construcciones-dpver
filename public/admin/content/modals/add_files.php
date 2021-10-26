<?php $obra = find_by_id('obras','idobras', (int)$_GET['id']); ?>
<div class="modal fade" id="add_files" tabindex="-1" role="dialog" aria-labelledby="add_files" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100" id="add_files">Cargar nuevo documento</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
            <form action="obra?id=<?php echo $obra['idobras']; ?>" name="carga-datos" method="post" enctype="multipart/form-data">

<div class="modal-body">
          <div class="card-body">   
           <h5 class="p-b-20"><b>ARCHIVOS DE OBRA</b></h5>
            <div class="row justify-content-center">       
<input type="text" name="n_caja" value="<?php echo $obra['numero']; ?>" style="visibility:hidden;" />
<input type="text" name="id_obra" value="<?php echo $obra['idobras']; ?>" style="visibility:hidden;" />

<!-- Carpeta Archivos -->

            <div class="row justify-content-center">
            <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="form-group">
            <label for="fecha_informe"> Archivos de obra </label>
            <input type="file" name="dir_archivos[]" id="input-file-now-custom-1" class="dropify-es" multiple />
            <small class="form-control-feedback"> Seleccione o arrastre uno o varios archivos. </small>
            </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
            <p>Carpeta: Archivos (Directorio principal)</p>
            <li>Los documentos deberan ser del siguiente formato:
            <ul>
            <li>Archivos - PDF</li>
            <li>Archivos - Word</li>
            <li>Archivos - Excel</li>
            <li>Imagenes - JPG</li>
            <li>Imagenes - PNG</li>
            </ul>
            </li>
            </div>
            </div> 
            
<!-- Carpeta pliego completo -->   
            
            <div class="row justify-content-center">
            <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="form-group">
            <label for="fecha_informe"> Pliego completo </label>
            <input type="file" name="pliego_completo[]" id="input-file-now-custom-1" class="dropify-es" multiple />
            <small class="form-control-feedback"> Seleccione o arrastre uno o varios archivos. </small>
            </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
            <p>Carpeta: Pliego completo </p>
            <li>Los documentos deberan ser del siguiente formato:
            <ul>
            <li>Archivos - PDF</li>
            <li>Archivos - Word</li>
            <li>Archivos - Excel</li>
            <li>Imagenes - JPG</li>
            <li>Imagenes - PNG</li>
            </ul>
            </li>
            </div>
            </div> 
            
<!-- Carpeta Resolucion de aprobacion de proyecto -->   
            
            <div class="row justify-content-center">
            <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="form-group">
            <label for="fecha_informe"> Resolucion de aprobacion de proyecto </label>
            <input type="file" name="res_aprobacion[]" id="input-file-now-custom-1" class="dropify-es" multiple />
            <small class="form-control-feedback"> Seleccione o arrastre uno o varios archivos. </small>
            </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
            <p>Carpeta: Resolucion aprobacion </p>
            <li>El documento debe ser copia del original.</li>
            <li>Los documentos deberan ser del siguiente formato:
            <ul>
            <li>Archivos - PDF</li>
            <li>Imagenes - JPG</li>
            <li>Imagenes - PNG</li>
            </ul>
            </li>
            </div>
            </div>   
                   
<!-- Carpeta Resolucion de adjudicacion de empresa -->   
            
            <div class="row justify-content-center">
            <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="form-group">
            <label for="fecha_informe"> Resolucion de adjudicacion de empresa </label>
            <input type="file" name="res_adjudicacion[]" id="input-file-now-custom-1" class="dropify-es" multiple />
            <small class="form-control-feedback"> Seleccione o arrastre uno o varios archivos. </small>
            </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
            <p>Carpeta: Resolucion adjudicacion </p>
            <li>El documento debe ser copia del original.</li>
            <li>Los documentos deberan ser del siguiente formato:
            <ul>
            <li>Archivos - PDF</li>
            <li>Imagenes - JPG</li>
            <li>Imagenes - PNG</li>
            </ul>
            </li>
            </div>
            </div> 
            
     <!-- Carpeta Contrato -->   
            
            <div class="row justify-content-center">
            <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="form-group">
            <label for="fecha_informe"> Contrato / Actuacion notarial / Convenios </label>
            <input type="file" name="contrat[]" id="input-file-now-custom-1" class="dropify-es" multiple />
            <small class="form-control-feedback"> Seleccione o arrastre uno o varios archivos. </small>
            </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
            <p>Carpeta: Contrato </p>
            <li>El documento debe ser copia del original.</li>
            <li>Los documentos deberan ser del siguiente formato:
            <ul>
            <li>Archivos - PDF</li>
            <li>Imagenes - JPG</li>
            <li>Imagenes - PNG</li>
            </ul>
            </li>
            </div>
            </div>        
            
        <!-- Carpeta Acta de inicio -->   
            
            <div class="row justify-content-center">
            <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="form-group">
            <label for="fecha_informe"> Acta de inicio </label>
            <input type="file" name="acta_inicio[]" id="input-file-now-custom-1" class="dropify-es" multiple />
            <small class="form-control-feedback"> Seleccione o arrastre uno o varios archivos. </small>
            </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
            <p>Carpeta: Acta de inicio </p>
            <li>El documento debe ser copia del original.</li>
            <li>Los documentos deberan ser del siguiente formato:
            <ul>
            <li>Archivos - PDF</li>
            <li>Imagenes - JPG</li>
            <li>Imagenes - PNG</li>
            </ul>
            </li>
            </div>
            </div>               
            
            
               
            </div>                                    
        </div>
        </div>
        <div class="modal-footer">
          <button type="submit" name="add_files_obra" class="btn btn-info waves-effect waves-light">Confirmar</button>
        </div>
      </form>
    </div>
  </div>
</div>