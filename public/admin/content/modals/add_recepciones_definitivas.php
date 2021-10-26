<?php $date = make_date(); ?>
<div class="modal fade" id="add_recepcion_definitiva" tabindex="-1" role="dialog" aria-labelledby="add_recepcion_definitiva" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100" id="add_recepcion_definitiva">Agregar recepcion definitiva</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="card-body">
            <form method="post" action="recepciones-definitivas">
              <div class="form-group p-20">
                <div class="vtabs">
                  <ul class="nav nav-tabs tabs-vertical" role="tablist">
                    <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#tramite" role="tab">Tramite</a> </li>
                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#obra" role="tab">Obra</a> </li>
                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#documentacion" role="tab">Documentacion</a> </li>
                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#comision" role="tab">Comision</a> </li>
                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#acta" role="tab">Acta/Informe</a> </li>
                  </ul>
                  <div class="tab-content">
                    <div class="tab-pane p-l-20 active" id="tramite" role="tabpanel" aria-expanded="true">
                      <div class="form-group p-l-20">
                        <div class="row">
                          <label class="control-label"><b>Localizar tramite iniciado</b></label>
                        </div>
                        <div class="row p-t-20">
                          <label class="control-label">Por nota</label>
                        </div>                      
                        <div class="row">
                          <div class="col-md-12">
                            <input class="form-control"  id="busquedanotas" type="text" name="id_notas" placeholder="Escriba el asunto o referencia de nota..." >
                          </div>
                        </div>
                        <div class="row p-t-20">
                          <label class="control-label">Por expediente</label>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <input class="form-control"  id="busquedaexpedientes" type="number" maxlength="6" name="id_expedientes" placeholder="Escriba el asunto o numero de expediente..." >   
                          </div>
                        </div>
                        <div class="row p-t-20">
                          <label class="control-label">Por fecha de pedido</label>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <input class="form-control" type="date" name="fecha_pedido" >   
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane p-l-20" id="obra" role="tabpanel" aria-expanded="false">
                      <div class="form-group p-l-20">
                        <div class="row">
                          <label class="control-label"><b>Obra a recibir</b></label>
                        </div>
                        <div class="row p-t-10">
                          <div class="col-md-12">
                            <input class="form-control"  id="searchbox" type="text" name="nombre_obras" placeholder="Escriba el nombre de la obra..." >
                          </div> 
                        </div>
                        <br>
                        <hr>
                        <div class="row p-t-20">
                          <div class="col-md-12">                        
                            En caso de que la obra no este registrada en el sistema, por favor, complete los siguientes campos
                          </div>
                        </div>
                        <div class="row p-t-20">
                          <div class="col-md-8">
                            <input type="text" name="obra" class="form-control" placeholder="Nombre de obra segun expediente">
                          </div>
                          <div class="col-md-4">
                            <input type="text" name="exediente_obra" class="form-control" placeholder="Nº Expediente">
                          </div>
                        </div>
                      </div>
                    </div>                  
                    <div class="tab-pane p-l-20" id="documentacion" role="tabpanel" aria-expanded="false">
                      <div class="form-group p-l-20">
                        <div class="row">
                          <label class="control-label"><b>Documentacion de recepcion</b></label>
                        </div>
                        <div class="row p-t-10">
                          <div class="col-md-6">
                            <div class="md-form form-md" style="padding-top:16%;" >
                              <input class="form-check-input" name="documentacion_planos" type="checkbox" value="1" id="documentacion_planos">
                              <label class="form-check-label" for="documentacion_planos">
                                Planos conforme a obra
                              </label>
                            </div>
                          </div> 
                          <div class="col-md-6">
                            <div class="md-form form-md">
                              <label class="control-label">&nbsp;</label>
                              <input type="text" name="documentacion_planos_observacion" class="form-control">
                              <small class="form-control-feedback"> Observacion </small>                            
                            </div>
                          </div>
                        </div>
                        <div class="row p-t-20">
                          <div class="col-md-6">
                            <div class="md-form form-md" style="padding-top:16%;" >
                              <input class="form-check-input" name="documentacion_ensayos" type="checkbox" value="1" id="documentacion_ensayos">
                              <label class="form-check-label" for="documentacion_ensayos">
                                Ensayos
                              </label>
                            </div>
                          </div> 
                          <div class="col-md-6">
                            <div class="md-form form-md">
                              <label class="control-label">&nbsp;</label>
                              <input type="text" name="documentacion_ensayos_observacion" class="form-control">
                              <small class="form-control-feedback"> Observacion </small>                            
                            </div>
                          </div>   
                        </div>
                        <div class="row p-t-20">
                          <div class="col-md-6">
                            <div class="md-form form-md">
                              <label class="control-label">&nbsp;</label>
                              <input type="text" name="documentacion_mas" class="form-control">
                              <small class="form-control-feedback"> Mas documentacion </small>                            
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="md-form form-md">
                              <label class="control-label">&nbsp;</label>
                              <input type="text" name="documentacion_mas_observacion" class="form-control">
                              <small class="form-control-feedback"> Observacion</small>  
                            </div>
                          </div>      
                        </div>
                        <br><hr><br>
                        <div class="row p-t-20">
                          <div class="col-md-8">
                            <div class="md-form form-md">
                              <label class="control-label"><b>Confirmacion de documentacion</b></label>
                              <input type="text" name="confirmacion_documentacion_observacion" class="form-control">
                              <small class="form-control-feedback"> Observacion </small>                            
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="md-form form-md">
                              <label class="control-label">&nbsp;</label>
                              <input type="date" name="confirmacion_documentacion_fecha" class="form-control">
                              <small class="form-control-feedback"> fecha</small>  
                            </div>
                          </div>      
                        </div>
                      </div>
                    </div>    
                    <div class="tab-pane p-l-20" id="comision" role="tabpanel" aria-expanded="false">
                      <div class="form-group p-l-20">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="md-form form-md">
                              <label class="control-label"><b>Resolucion de designacion</b></label>
                              <input type="date" name="integrantes_resolucion_fecha" class="form-control">
                              <small class="form-control-feedback"> Fecha de Resolucion </small>                            
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="md-form form-md">
                              <label class="control-label">&nbsp;</label>
                              <input type="text" name="integrantes_resolucion_num" class="form-control">
                              <small class="form-control-feedback"> Numero de Resolucion</small>  
                            </div>
                          </div>      
                        </div> 
                        <br><hr><br>
                        <div class="row p-t-20">
                          <div class="col-md-8">
                            <div class="md-form form-md">
                              <label class="control-label">Agentes de comision</label>
                              <input type="text" name="comision_agente1" class="form-control">
                              <small class="form-control-feedback"> Nombre del agente </small>                            
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="md-form form-md" style="margin-top:30%;">
                              <input class="form-check-input" name="comision_agente1_notificado" type="checkbox" value="1" id="comision_agente1_notificado">
                              <label class="form-check-label" for="comision_agente1_notificado">
                                Notificado
                              </label>
                            </div>
                          </div>      
                        </div> 
                        <div class="row p-t-20">
                          <div class="col-md-8">
                            <div class="md-form form-md">
                              <label class="control-label">Agentes de comision</label>
                              <input type="text" name="comision_agente2" class="form-control">
                              <small class="form-control-feedback"> Nombre del agente </small>                            
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="md-form form-md" style="margin-top:30%;">
                              <input class="form-check-input" name="comision_agente2_notificado" type="checkbox" value="1" id="comision_agente2_notificado">
                              <label class="form-check-label" for="comision_agente2_notificado">
                                Notificado
                              </label>
                            </div>
                          </div>      
                        </div>
                        <div class="row p-t-20">
                          <div class="col-md-8">
                            <div class="md-form form-md">
                              <label class="control-label">Agentes de comision</label>
                              <input type="text" name="comision_agente3" class="form-control">
                              <small class="form-control-feedback"> Nombre del agente </small>                            
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="md-form form-md" style="margin-top:30%;">
                              <input class="form-check-input" name="comision_agente3_notificado" type="checkbox" value="1" id="comision_agente3_notificado">
                              <label class="form-check-label" for="comision_agente3_notificado">
                                Notificado
                              </label>
                            </div>
                          </div>      
                        </div>
                        <br><hr><br>
                        <div class="row p-t-20">
                          <label class="control-label"><b>Movilidad</b></label>
                        </div>
                        <div class="row p-t-10">
                          <div class="col-md-4">
                            <div class="md-form form-md" style="margin-top:30%;">
                              <input class="form-check-input" name="movilidad" type="checkbox" value="1" id="movilidad">
                              <label class="form-check-label" for="movilidad">
                                Disponible
                              </label>
                            </div>
                          </div>
                          <div class="col-md-8">
                            <div class="md-form form-md">
                              <label class="control-label">&nbsp;</label>
                              <input type="text" name="movilidad_observacion" class="form-control">
                              <small class="form-control-feedback"> Observaciones</small>  
                            </div>
                          </div>      
                        </div>
                      </div>
                    </div> 
                    <div class="tab-pane p-l-20" id="acta" role="tabpanel" aria-expanded="false">
                      <div class="form-group p-l-20">
                        <div class="row">
                          <div class="col-md-12">
                            <label class="control-label">Estado</label>
                            <select class="form-control custom-select" name="estado" id="estado">
                              <option disabled selected>Seleccione un estado</option>
                              <option value="1">Recibido</option>
                              <option value="0">No recibido</option>
                            </select>
                          </div>
</div> 
<div id="recibido">
                        <div class="row p-t-20">
                          <div class="col-md-4">
                            <div class="md-form form-md" style="margin-top:30%;">
                              <input class="form-check-input" name="recibido_notificado" type="checkbox" value="1" id="recibido_notificado">
                              <label class="form-check-label" for="recibido_notificado">
                                Notificado
                              </label>
                            </div>
                          </div>
                          <div class="col-md-8">
                            <div class="md-form form-md">
                              <label class="control-label">&nbsp;</label>
                              <input type="text" name="recibido_notificado_observacion" id="recibido_notificado_observacion" class="form-control">
                              <small class="form-control-feedback"> Observaciones</small>  
                            </div>
                          </div>      
                        </div>
                        <div class="row p-t-20">
<div class="col-md-12">
<div class="md-form form-md">
<label class="control-label">Proyecto de resolucion</label>
<input type="date" name="acta_resolucion_proyecto" id="acta_resolucion_proyecto" class="form-control">                           
</div>
</div>
</div>
                        <div class="row p-t-20">
<div class="col-md-6">
<div class="md-form form-md">
<label class="control-label">Resolucion del acta</label>
<input type="date" name="acta_fecha" id="acta_fecha" class="form-control">
<small class="form-control-feedback"> Fecha de Resolucion </small>                            
</div>
</div>
<div class="col-md-6">
<div class="md-form form-md">
<label class="control-label">&nbsp;</label>
<input type="text" name="acta_resolucion" id="acta_resolucion" class="form-control">
<small class="form-control-feedback"> Numero de Resolucion</small>  
</div>
</div>
</div>
</div>
<div id="no-recibido">
                        <div class="row p-t-20">
                          <label class="control-label"><b>Notificacion al Inspector de obra</b></label>
                        </div>
                        <div class="row">
                          <div class="col-md-4">
                            <div class="md-form form-md" style="margin-top:30%;">
                              <input class="form-check-input" name="no_recibido_notificado_inspector" type="checkbox" value="1" id="no_recibido_notificado_inspector">
                              <label class="form-check-label" for="no_recibido_notificado_inspector">
                                Notificado
                              </label>
                            </div>
                          </div>
                          <div class="col-md-8">
                            <div class="md-form form-md">
                              <label class="control-label">&nbsp;</label>
                              <input type="text" name="no_recibido_notificado_inspector_observacion" id="no_recibido_notificado_inspector_observacion" class="form-control">
                              <small class="form-control-feedback"> Observaciones</small>  
                            </div>
                          </div>      
                        </div>
                        <div class="row p-t-20">
                          <label class="control-label"><b>Notificacion a la Empresa por Orden de servicio</b></label>
                        </div>
                        <div class="row">
                          <div class="col-md-4">
                            <div class="md-form form-md" style="margin-top:30%;">
                              <input class="form-check-input" name="no_recibido_notificado_empresa" type="checkbox" value="1" id="no_recibido_notificado_empresa">
                              <label class="form-check-label" for="no_recibido_notificado_empresa">
                                Notificado
                              </label>
                            </div>
                          </div>
                          <div class="col-md-8">
                            <div class="md-form form-md">
                              <label class="control-label">&nbsp;</label>
                              <input type="text" name="no_recibido_notificado_empresa_observacion" id="no_recibido_notificado_empresa_observacion" class="form-control">
                              <small class="form-control-feedback"> Observaciones</small>  
                            </div>
                          </div>      
                        </div>
                        <div class="row p-t-20">
                          <div class="col-md-12">
                            <label class="control-label">Respuesta de la empresa</label>
                            <select class="form-control custom-select" name="respuesta_empresa" id="respuesta_empresa">
                              <option disabled selected>Seleccione una respuesta</option>
                              <option value="1">Conforme</option>
                              <option value="0">No conforme (Descargo)</option>
                            </select>
                          </div>
</div> 
<div id="conforme">
                        <div class="row p-t-20">
                              <input class="form-check-input" name="no_recibido_conforme" type="checkbox" value="1" id="no_recibido_conforme">
                              <label class="form-check-label" for="no_recibido_conforme">
                                Vuelve a Comision de recepcion
                              </label>
                        </div>
                      </div>
<div id="no-conforme">
                        <div class="row p-t-20">
                              <label class="control-label">Observaciones</label>
                              <input type="text" name="no_recibido_no_conforme" id="no_recibido_no_conforme" class="form-control">
                        </div>
                      </div>
</div>
</div>   
</div>
</div>
</div>
<hr>
<div class="row p-t-20">
  <div class="col-md-12">
    <div class="md-form">
      <label class="control-label">Observaciones</label>
      <textarea name="observaciones" class="form-control md-textarea" length="50000" rows="4"></textarea>
    </div>
  </div>                        
</div>
</div>
<div class="modal-footer">
  <button type="submit" name="add_recepcion_definitiva" class="btn btn-info waves-effect waves-light">Guardar cambios</button>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<script>
  $(document).ready(function() {
    $("#recibido").hide();
    $("#no-recibido").hide();
    $("#conforme").hide();
    $("#no-conforme").hide();
    $("#estado").change(function(){
      if ($(this).val() == 1){
        $("#no_recibido_notificado_inspector").prop("checked", false);
        $("#no_recibido_notificado_inspector_observacion").val("");
        $("#no_recibido_notificado_empresa").prop("checked", false);
        $("#no_recibido_notificado_observacion_empresa").val("");
        $("#respuesta_empresa").val("Seleccione una respuesta");
        $("#no_recibido_conforme").prop("checked", false);
        $("#no_recibido_no_conforme").val("");
        $("#recibido").show();
        $("#no-recibido").hide();
      }
      if ($(this).val() == 0){
        $("#recibido_notificado").prop("checked", false);
        $("#recibido_notificado_observacion").val("");
        $("#acta_fecha").val("");
        $("#acta_resolucion").val("");
        $("#recibido").hide();
        $("#no-recibido").show();
      }
    });
    $("#respuesta_empresa").change(function(){
      if ($(this).val() == 1){
        $("#no_recibido_no_conforme").val("");
        $("#conforme").show();
        $("#no-conforme").hide();
      }
      if ($(this).val() == 0){
        $("#no_recibido_conforme").prop("checked", false);       
        $("#conforme").hide();
        $("#no-conforme").show();
      }
    });    
  })
</script>