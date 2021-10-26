<?php
require_once('../../includes/load.php');
$user = current_user();
$oyp = all_oyp();
?>

<div class="row form-center hide" id="agregar_recepcion">
        <div class="col-lg-12 col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
              <div class="col-12">
                                        <div class="d-flex flex-wrap">
                                            <div>
                                                <h3 class="card-title">Agregar nueva recepcion</h3>
                                            </div>
                                            <div class="ml-auto">
                                                <ul class="list-inline">
                                                    <li>
                                                      <h6 class="text-muted"><a onclick="cancelar_agregar()" class="dropdown-item a-icon" data-toggle="tooltip" title="Cancelar"><i class="fas fa-times fa-2x"></i></a></h6>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                  </div>

            <hr class="m-t-0 m-b-0"></div>
          <div class="card-body">
            <form method="post" action="recepciones" id="form_agregar" enctype="multipart/form-data">
              <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="form-group p-r-10 p-l-10">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="row title-form">
                      Informacion del tramite
                      </div>
                      </div>
                      <input type="text" name="agregar_recepcion" hidden>
                      <div class="row p-t-20">
                          
                        <div class="col-lg-4 col-md-4 col-sm-12">
                          <div class="md-form form-md">
                            <label class="control-label">Fecha de pedido</label>
                            <input type="date" name="fecha_pedido" class="form-control" required>
                          </div>
                        </div> 
                        <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="md-form form-md">
                          <label class="control-label">Expediente</label>
                          <input type="number" name="expediente" class="form-control" required>
                        </div>
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="md-form form-md">
                          <label class="control-label">Tipo</label>
                          <select class="form-control" name="tipo" required>
                            <option value="rp">Provisoria</option>
                            <option value="rd">Definitiva</option>
                            </select>
                        </div>
                      </div>  
                      </div>

                      <div class="row p-t-10">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="md-form form-md">
                          <label class="control-label">Obra</label>
                          <select class="form-control obra" name="idobras" style="height:80px;width:100%;" id="obra_registrada">    
                            <option value="0" selected>No interviene obra</option>
                            <?php foreach($oyp as $r): ?>    
                            <option value="<?php echo $r['idobras']; ?>"><?php echo $r['numero'].' - '.$r['expediente'].' - '.$r['nombre']; ?></option>
                            <?php endforeach; ?>
                            </select>
                        </div>
                      </div>
                      </div> 
                      <div class="row p-t-10">
                      <div class="col-lg-8 col-md-8 col-sm-12">
                        <div class="md-form form-md" id="obra_nombre">
                          <label class="control-label">Nombre de obra</label>
                          <input type="text" name="obra_nombre" class="form-control">
                        </div>
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="md-form form-md" id="obra_expediente">
                          <label class="control-label">Expediente de obra</label>
                          <input type="number" name="obra_expediente" class="form-control">
                        </div>
                      </div>
                      </div> 

                    </div>
                  </div>
</div>


<div class="row">
                      <div class="col-lg-6 col-md-6 col-sm-12">
                      <div class="form-group p-r-10 p-l-10">
                         <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="row title-form">
                      Comision de recepcion
                      </div>
                    </div>
                    <div class="row p-t-20">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                          <div class="md-form form-md">
                            <label class="control-label">Numero</label>
                            <input type="number" name="comision_numero" class="form-control">
                          </div>
                        </div> 
                        <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="md-form form-md">
                          <label class="control-label">Fecha</label>
                          <input type="date" name="comision_fecha" class="form-control">
                        </div>
                      </div>
                      </div>
                      
                    <div class="row p-t-20">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <div class="md-form form-md">
                            <label class="control-label">Integrantes de comision</label>
                          <input type="text" name="agente1" class="form-control">
                          </div>
                          <div class="md-form form-md">
                          <input type="text" name="agente2" class="form-control">
                          </div>
                          <div class="md-form form-md">
                          <input type="text" name="agente3" class="form-control">
                          </div>
                          <div class="md-form form-md">
                          <input type="text" name="agente4" class="form-control">
                          </div>
                        </div> 
                    </div>
                    <div class="row p-t-20">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                        <label class="control-label">Archivo de resolucion de comision</label>
                        <input type="file" name="comision_archivo" class="dropify-es" />
                        </div> 
                      </div>
                  </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="form-group p-r-10 p-l-10">
                         <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="row title-form">
                      Documentacion
                      </div>
                    </div>
                    <div class="row p-t-20">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <div class="md-form form-md">
                            <label class="control-label">Archivos de planos conforme a obra</label>
                          <input type="file" name="documentacion[]" class="dropify-es" />
                          </div>
                        </div> 
                      </div>
                  </div>      
                  <div class="form-group p-r-10 p-l-10">
                         <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="row title-form">
                      Informe 
                      </div>
                    </div>
                    <div class="row p-t-20">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <div class="md-form form-md">
                            <label class="control-label">Archivo del informe</label>
                          <input type="file" name="informe_archivo" class="dropify-es" />
                          </div>
                        </div> 
                      </div>
                            </div>
                  </div>
                  



                </div><div class="row">
                      <div class="col-lg-6 col-md-6 col-sm-12">
                      <div class="form-group p-r-10 p-l-10">
                         <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="row title-form">
                      Acta de recepcion
                      </div>
                    </div>
                    <div class="row p-t-20">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                          <div class="md-form form-md">
                            <label class="control-label">Numero</label>
                            <input type="number" name="acta_numero" class="form-control">
                          </div>
                        </div> 
                        <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="md-form form-md">
                          <label class="control-label">Fecha</label>
                          <input type="date" name="acta_fecha" class="form-control">
                        </div>
                      </div>
                      </div>
                    <div class="row p-t-20">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <div class="md-form form-md">
                            <label class="control-label">Archivo de resolucion de aprobacion de acta</label>
                          <input type="file" name="acta_archivo" class="dropify-es" />
                          </div>
                        </div> 
                      </div>
                            </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                      <div class="form-group p-r-10 p-l-10">
                         <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="row title-form">
                      Observaciones
                      </div>
                    </div>
                    <div class="row p-t-20">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <div class="md-form form-md">
                            <label class="control-label">Observacion del tramite</label>
                          <textarea class="form-control" name="observaciones" rows="4"></textarea>
                          </div>
                        </div> 
                      </div>
                            </div>
                            </div>
                            </div>
</div>



            <div class="card-body">
<hr class="m-t-0 m-b-0">
              <div class="row p-t-20">
              <div class="col-12">
                                        <div class="d-flex flex-wrap">
                                            <div>
                                                <h6 class="text-muted"><a onclick="cancelar_agregar()" class="dropdown-item a-icon" data-toggle="tooltip" title="Cancelar"><i class="fas fa-times fa-2x"></i></a></h6>
                                            </div>
                                            <div class="ml-auto">
                                                <ul class="list-inline">
                                                    <li>
                                                        <h6 class="text-muted"><button type="submit"  class="dropdown-item a-icon" data-toggle="tooltip" title="Confirmar"><i class="fas fa-check fa-2x"></i></button></h6> 
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                  </div>
            </form>
            </div>
        </div>
      </div>    
    </div>
    <script type="text/javascript">
$(document).ready(function () {
  $('.obra').select2();
});


$(document).ready(function () {
$('#obra_registrada').on('change', function(){
  var obra = $('#obra_registrada').val();
    

  if(obra == 0){
    $('#obra_nombre').show();
    $('#obra_expediente').show();
  }
  if(obra != 0){
    $('#obra_nombre').hide();
    $('#obra_expediente').hide();
  }
});

});
  </script>






