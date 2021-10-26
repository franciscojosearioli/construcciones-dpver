<div class="row form-center hide" id="agregar_obra">
        <div class="col-lg-12 col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
              <div class="col-12">
                                        <div class="d-flex flex-wrap">
                                            <div>
                                                <h3 class="card-title">Cargar nueva obra</h3>
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
            <form method="post" action="obras" id="form_agregar_obra">
              
            <input type="text" name="add_obra" hidden>
            <div class="form-group p-20">
            <div class="row p-t-20">
              <div class="col-md-4">
                <div class="md-form form-md">
                  <label class="control-label">Nº Caja</label>
                  <input type="text" name="numero" class="form-control">
                </div>
              </div>                  
              <div class="col-md-4">
                <div class="md-form form-md">
                  <label class="control-label">Nº Expediente</label>
                  <input type="text" name="expediente" class="form-control" required>
                </div>
              </div>     
              <div class="col-md-4">
                <label class="control-label">Estado</label>
                <select class="form-control custom-select" name="estado" id="select_estado" required>
                  <option disabled selected>Seleccione una opcion</option>
                  <option value="6">A iniciar</option>
                  <option value="0">En ejecucion</option>
                  <option value="3">Finalizado</option>
                  <option value="4">Neutralizado</option>
                  <option value="5">Rescindido</option>
                </select>
              </div>
            </div>
            <div id="estado-finalizado"></div>
                <script>
                        $( "#select_estado" ).change(function() {
                    var valor = $(this).val();
                        $.post("includes/ajax/estado-finalizado.php",  { valor: valor }).done(function(data) {
                                    $('#estado-finalizado').html(data);
                });
                });
                </script>
            <div class="form-group">
            <div class="row p-t-20">
                <div class="col-md-12">
                  <div class="md-form form-md">
                    <label class="control-label">Titulo de obra</label>
                    <input type="text" name="titulo" class="form-control" required>
                  </div>
                </div>
              </div>
              <div class="row p-t-20">
                <div class="col-md-8">
                  <div class="md-form form-md">
                    <label class="control-label">Observaciones</label>
                    <textarea name="observaciones" class="form-control" rows="3"></textarea>
                  </div>
                </div> 
                <div class="col-md-4">
                  <div class="md-form form-md">
                    <label class="control-label">Inspector designado</label>
                    <select class="form-control custom-select" name="idinspector">
                        <option value="0" selected>No se ha seleccionado ningun usuario</option>
                      <?php $inspectores = all_inspectores(); foreach ($inspectores as $inspector):?>
                        <option value="<?php echo $inspector['id']; ?>"><?php echo $inspector['nombre'].' '.$inspector['apellido']; ?></option>
                      <?php endforeach; ?>
                    </select>

                </div>
                </div>
              </div>
            </div>
          </div>
          <ul class="nav nav-tabs customtab2 justify-content-center m-b-30" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" data-toggle="tab" href="#generalidades" role="tab" aria-expanded="true">Generalidades</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#proyecto" role="tab" aria-expanded="false">Proyecto</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="pill" href="#contratacion" role="tab" aria-expanded="false">Contratacion</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="pill" href="#datos-vigentes" role="tab" aria-expanded="false">Montos y plazos</a>
            </li>  
          </ul>
          <div class="tab-content">
            <div class="tab-pane p-20 active" id="generalidades" role="tabpanel" aria-expanded="true">
              
              <div class="row p-t-20">
                <div class="col-md-6">
                  <div class="md-form form-md">
                    <label class="control-label">Descripcion</label>
                    <input type="text" name="descripcion" class="form-control">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="md-form form-md">
                    <label class="control-label">Longitud</label>
                    <input type="number" name="longitud" step="any" pattern="^\d+(?:\.\d{1,2})?$" class="form-control">
                    <small class="form-control-feedback"> En metros. </small>
                  </div>
                </div>      
              </div>         
              <div class="row p-t-20">
                <div class="col-md-6">
                  <div class="md-form form-md">
                    <label class="control-label">Departamento / Localidad</label>
                    <input type="text" name="ubicacion" class="form-control">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="md-form form-md">
                    <label class="control-label">Proyectista</label>
                    <input type="text" name="proyectista" class="form-control">
                  </div>
                </div>
              </div>    
              <div class="row p-t-20">
                <div class="col-md-12">
                  <div class="md-form">
                    <label class="control-label">Memoria descriptiva</label>
                    <textarea name="memoria_descriptiva" class="form-control md-textarea" length="50000" rows="4"></textarea>
                  </div>
                </div>
              </div>          
            </div>
            <div class="tab-pane p-20" id="proyecto" role="tabpanel" aria-expanded="false">
              <div class="row p-t-20">
                <div class="col-md-4">
                  <div class="md-form form-md">
                    <label class="control-label">Presupuesto oficial</label>
                    <input type="number" name="proyecto_monto" class="form-control" step="any" pattern="^\d+(?:\.\d{1,2})?$" required>
                    <small class="form-control-feedback"> En pesos argentinos. </small>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="md-form form-md">
                    <label class="control-label">Fecha del presupuesto</label>
                    <input type="text" name="proyecto_monto_fecha" class="form-control">
                  </div>
                </div>   
                                <div class="col-md-4">
                  <div class="md-form form-md">
                    <input type="checkbox" name="anticipo_financiero" value="1" id="basic_checkbox_3" class="filled-in anticipo_financiero" unchecked>
                    <label class="control-label" for="basic_checkbox_3">Anticipo financiero</label>
                    
                    <label class="control-label">Porcentaje de anticipo</label>
                    <input type="text" name="valor_anticipo_financiero" class="form-control">
                  </div>
                </div>      
              </div> 
              <div class="row p-t-20">
                <div class="col-md-4">
                  <div class="md-form form-md">
                    <label class="control-label">Plazo de ejecucion</label>
                    <input type="text" name="proyecto_plazo" class="form-control" required>
                    <small class="form-control-feedback"> Aprobado en proyecto. </small>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="md-form form-md">
                    <label clasee="control-label">Plazo de garantia</label>
                    <input type="text" name="plazo_garantia" class="form-control">
                    <small class="form-control-feedback"> Aprobado en proyecto. </small>
                  </div>
                </div>      
                  <div class="col-md-4">
                    <div class="md-form form-md">
                      <label clasee="control-label">Vencimiento de certificados</label>
                      <input type="number" name="certificado_vencimiento" class="form-control">
                    </div>
                  </div>  
              </div> 
              
            </div>
            <div class="tab-pane p-20" id="contratacion" role="tabpanel" aria-expanded="false">
              <div class="row p-t-20">
                <div class="col-md-6">
                  <div class="md-form form-md">
                    <label class="control-label">Contratista</label>
                    <input type="text" name="contratista" class="form-control">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="md-form form-md">
                    <label class="control-label">Tipo de contratacion</label>
                    <input type="text" name="tipo_contratacion" class="form-control">
                  </div>
                </div>      
              </div> 
              <div class="row p-t-20">
                <div class="col-md-4">
                  <div class="md-form form-md">
                    <label class="control-label">Aprobacion de proyecto</label>
                    <input type="date" name="aprobacion_res_fecha" class="form-control">
                    <small class="form-control-feedback"> Fecha de Resolucion </small>                            
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="md-form form-md">
                    <label class="control-label">&nbsp;</label>
                    <input type="text" name="aprobacion_res_num" class="form-control">
                    <small class="form-control-feedback"> Numero </small>  
                  </div>
                </div>      
                <div class="col-md-4">
                  <div class="md-form form-md">
                    <label class="control-label">Adjudicacion a empresa</label>
                    <input type="date" name="adjudicacion_res_fecha" class="form-control">
                    <small class="form-control-feedback"> Fecha de Resolucion </small> 
                  </div>
                </div>      
                <div class="col-md-2">
                  <div class="md-form form-md">
                    <label class="control-label">&nbsp;</label>
                    <input type="text" name="adjudicacion_res_num" class="form-control">
                    <small class="form-control-feedback"> Numero </small>  
                  </div>
                </div>
              </div>             
              <div class="row p-t-20">
                <div class="col-md-6">
                  <div class="md-form form-md">
                    <label class="control-label">Fuente de financiamiento</label>
                    <input type="text" name="tipo_financiamiento" class="form-control">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="md-form form-md">
                    <label class="control-label">Firma del contrato</label>
                    <input type="date" name="contrato_fecha" class="form-control">
                    <small class="form-control-feedback"> Fecha de firma. </small>  
                  </div>
                </div>          
              </div>  
              <div class="row p-t-20">
                <div class="col-md-6">
                  <div class="md-form form-md">
                    <label class="control-label">Acta de inicio</label>
                    <input type="date" name="fecha_inicio" class="form-control">
                    <small class="form-control-feedback"> Fecha de firma. </small>  
                  </div>
                </div> 
                <div class="col-md-6">
                  <div class="row">
                  <div class="col-6">
                  <div class="md-form form-md">
                    <label class="control-label">Finalizacion</label>
                    <input type="date" name="fecha_fin" class="form-control">
                    <small class="form-control-feedback"> Fecha aproximada. </small> 
                  </div></div>
                  <div class="col-6">
                    <input type="checkbox" name="fecha_fin_no_define" value="1" id="basic_checkbox_2" class="filled-in" unchecked>
                    <label for="basic_checkbox_2">No define fecha fin</label> 
                  </div>
                </div>
                </div>      
              </div>
            </div>
            <div class="tab-pane p-20" id="datos-vigentes" role="tabpanel" aria-expanded="false">
              <div class="row p-t-20">
                <div class="col-md-6">
                  <div class="md-form form-md">
                    <label class="control-label">Monto de obra contrato</label>
                    <input type="number" name="contrato_monto" class="form-control" step="any" pattern="^\d+(?:\.\d{1,2})?$" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="md-form form-md">
                    <label class="control-label">Plazo de ejecucion contrato</label>
                    <input type="text" name="contrato_plazo" class="form-control" disabled>
                  </div>
                </div>   
              </div> 
              <hr>
              <div class="row p-t-20">
                <div class="col-md-6">
                  <div class="md-form form-md">
                    <label class="control-label">Monto de obra vigente</label>
                    <input type="number" name="monto_vigente" class="form-control" step="any" pattern="^\d+(?:\.\d{1,2})?$" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="md-form form-md">
                    <label class="control-label">Observaciones</label>
                    <input type="text" name="monto_vigente_obs" class="form-control">
                  </div>
                </div>      
              </div> 
              <hr>
              <div class="row p-t-20">
                <div class="col-md-6">
                <div class="md-form form-md">
                    <label class="control-label">Plazo de ejecucion vigente</label>
                    <input type="text" name="plazo_vigente" class="form-control" required>
                  </div>
                </div>
                <div class="col-md-6">
                <div class="md-form form-md">
                    <label class="control-label">Observaciones</label>
                    <input type="text" name="plazo_vigente_obs" class="form-control">
                  </div>
                </div>      
              </div> 
              <hr>
              <div class="row p-t-20">
                <div class="col-md-6">
                  <div class="md-form form-md">
                    <label class="control-label">Monto contrato redeterminado</label>
                    <input type="number" name="monto_redeterminado" class="form-control" step="any" pattern="^\d+(?:\.\d{1,2})?$">
                    <small class="form-control-feedback"> En pesos argentinos. </small>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="md-form f orm-md">
                    <label class="control-label">Observaciones</label>
                    <input type="text" name="info_redeterminacion" class="form-control">
                    <small class="form-control-feedback"> Informacion de adecuacion. </small>
                  </div>
                </div>      
              </div> 
              <hr>
              <div class="row p-t-20">
                  <div class="col-md-12">
                    <div class="md-form">
                      <label class="control-label">Memoria descriptiva vigente</label>
                      <textarea name="memoria_descriptiva_vigente" class="form-control" rows="8"></textarea>
                    </div>
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
