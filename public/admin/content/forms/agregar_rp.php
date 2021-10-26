      <div class="row form-center hide" id="agregar_rp">
        <div class="col-lg-12 col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
              <div class="col-12">
                                        <div class="d-flex flex-wrap">
                                            <div>
                                                <h3 class="card-title">Agregar nueva recepcion provisoria</h3>
                                                <h6 class="card-subtitle"><span id="titulo-obra"></span></h6>
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
            <form method="post" action="recepciones-provisorias" id="form_agregar">
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
                      <input type="text" name="add_recepcion_provisoria" hidden>
                      <div class="form-group p-l-20">
                        <div class="row">
                          <div class="col-lg-12 col-md-12 col-sm-12">
                          <label class="control-label"><b>Tramite de la recepcion.</b></label><BR>Por favor, completar solo un campo de tramite.
                        </div>
                      </div>
                      <div class="row p-t-20">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <label class="control-label">Por nota</label>
                        </div>                      
                          <div class="col-lg-12 col-md-12 col-sm-12">
                            <input class="form-control"  id="busquedanotas" type="text" name="id_notas" placeholder="Escriba el asunto o referencia de nota..." >
                          </div>
                        </div>
                        <div class="row p-t-20">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <label class="control-label">Por expediente</label>
                        </div>
                          <div class="col-lg-12 col-md-12 col-sm-12">
                            <input class="form-control"  id="busqueda_expedientes" type="text" maxlength="6" name="id_expedientes" placeholder="Escriba el asunto o numero de expediente..." >   
                          </div>
                        </div>
                        <hr>
                        <div class="row p-t-20">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <label class="control-label">Fecha de pedido</label>
                        </div>
                          <div class="col-lg-12 col-md-12 col-sm-12">
                            <input class="form-control" type="date" name="fecha_pedido" id="fecha_pedido">   
                        </div>
                      </div>
                    </div>
                    </div>
                    <div class="tab-pane p-l-20" id="obra" role="tabpanel" aria-expanded="false">
                      <div class="form-group p-l-20">
                        <div class="row p-t-20">
                          <div class="col-lg-12 col-md-12 col-sm-12">                        
                            <label class="control-label"><b>Localizar y seleccionar obra cargada en el sistema</b></label>
                          </div>
                        </div>
                        <div class="row p-t-10">
                          <div class="col-lg-12 col-md-12 col-sm-12">

                            <input class="form-control"  id="searchbox" type="text" name="nombre_obras" placeholder="Ingrese y seleccione nombre de la obra..." >
                          </div> 
                        </div>
                        <br>
                        <hr>
                        <div class="row p-t-20">
                          <div class="col-lg-12 col-md-12 col-sm-12">                        
                            <label class="control-label"><b>Si la obra no esta cargada en el sistema, por favor complete los siguientes campos.</b></label>
                          </div>
                        </div>
                        <div class="row p-t-20">
                          <div class="col-lg-12 col-md-12 col-sm-12">
                            <label class="control-label">Nombre de obra</label>
                            <input type="text" name="obra" id="nombre_obra" class="form-control" placeholder="Nombre de obra segun expediente">
                          </div>
                        </div>
                        <div class="row p-t-10">
                          <div class="col-lg-12 col-md-12 col-sm-12">
                            <label class="control-label">Expediente de obra</label>
                            <input type="text" name="exediente_obra" id="expediente_obra" class="form-control" placeholder="Nº Expediente">
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
                        <div class="row p-t-20">
                          <div class="col-md-8">
                            <div class="md-form form-md">
                              <label class="control-label">Agentes de comision</label>
                              <input type="text" name="comision_agente4" class="form-control">
                              <small class="form-control-feedback"> Nombre del agente </small>                            
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="md-form form-md" style="margin-top:30%;">
                              <input class="form-check-input" name="comision_agente4_notificado" type="checkbox" value="1" id="comision_agente4_notificado">
                              <label class="form-check-label" for="comision_agente4_notificado">
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
<label class="control-label">Fecha del acta</label>
<input type="date" name="acta_resolucion_proyecto" id="acta_resolucion_proyecto" class="form-control">                           
</div>
</div>
</div>
                        <div class="row p-t-20">
<div class="col-md-6">
<div class="md-form form-md">
<label class="control-label">Fecha de aprobacion del acta</label>
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
            </form>
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
                                                        <h6 class="text-muted"><a onclick="submit_agregar();" class="dropdown-item a-icon" data-toggle="tooltip" title="Confirmar"><i class="fas fa-check fa-2x"></i></a></h6> 
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                  </div>
            </div>
        </div>
      </div>    
    </div>
    <script>

    $("#busquedanotas").keyup( function() {
        if ($(this).val() != "") {
            $("#busqueda_expedientes").prop("disabled", true);
        } else {
            $("#busqueda_expedientes").prop("disabled", false);
        }
    });
    $("#busqueda_expedientes").keyup( function() {
        if ($(this).val() != "") {
            $("#busquedanotas").prop("disabled", true);
        } else {
            $("#busquedanotas").prop("disabled", false);
        }
    });

    $("#searchbox").keyup( function() {
        if ($(this).val() != "") {
            $("#nombre_obra").prop("disabled", true);
            $("#expediente_obra").prop("disabled", true);
        } else {
            $("#nombre_obra").prop("disabled", false);
            $("#expediente_obra").prop("disabled", false);
        }
    });
    $("#nombre_obra").keyup( function() {
        if ($(this).val() != "") {
            $("#searchbox" ).prop("disabled", true);
        } else {
            $("#searchbox").prop("disabled", false);
        }
    });

$(document).ready(function(){
        var source = new Bloodhound({datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),queryTokenizer: Bloodhound.tokenizers.whitespace,remote: {url:'./includes/ajax/buscar_obra.php?key=%QUERY',wildcard: '%QUERY',filter: function (results) {return $.map(results, function (result) {return {value: result};});}}});source.initialize();$('#searchbox').typeahead(null, {display: 'value',source: source.ttAdapter(),limit:5});
      });
$(document).ready(function(){
        var busquedanotas = new Bloodhound({datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),queryTokenizer: Bloodhound.tokenizers.whitespace,remote: {url:'./includes/ajax/buscar_notas.php?key=%QUERY',wildcard: '%QUERY',filter: function (results) {return $.map(results, function (result) {return {value: result};});}}});busquedanotas.initialize();$('#busquedanotas').typeahead(null, {display: 'value',source: busquedanotas.ttAdapter(),limit:5});
        });
$(document).ready(function(){
        var busquedaexpedientes = new Bloodhound({datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),queryTokenizer: Bloodhound.tokenizers.whitespace,remote: {url:'./includes/ajax/buscar_expedientes.php?key=%QUERY',wildcard: '%QUERY',filter: function (results) {return $.map(results, function (result) {return {value: result};});}}});busquedaexpedientes.initialize();$('#busqueda_expedientes').typeahead(null, {display: 'value',source: busquedaexpedientes.ttAdapter(),limit:5});
      });
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

  $('#searchbox').on('change',function(){
    var nombre_obra = $('#searchbox').val();
          $('#titulo-obra').html(nombre_obra);
  });
    $('#nombre_obra').on('change',function(){
    var inputnombre_obra = $('#nombre_obra').val();
          $('#titulo-obra').html(inputnombre_obra);
  });
    </script>