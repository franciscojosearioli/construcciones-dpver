<?php $inspectores = all_inspectores(); ?>
<div class="modal fade" id="add_obra" tabindex="-1" role="dialog" aria-labelledby="add_obra" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100" id="add_obra">Agregar nueva obra</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="obras.php?id=<?php echo (int)$obra['id']; ?>">      
        <div class="modal-body">
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
                    <label class="control-label">Observaciones generales</label>
                    <textarea name="observaciones" class="form-control" rows="3"></textarea>
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
              <a class="nav-link" data-toggle="pill" href="#montos" role="tab" aria-expanded="false">Montos vigentes</a>
            </li>  
              <li class="nav-item">
                <a class="nav-link" data-toggle="pill" href="#ceremonial" role="tab" aria-expanded="false">Memoria vigente</a>
              </li> 
          </ul>
          <div class="tab-content">
            <div class="tab-pane p-20 active" id="generalidades" role="tabpanel" aria-expanded="true">
              <div class="row p-t-20">
                <div class="col-md-12">
                  <div class="md-form form-md">
                    <label class="control-label">Titulo de obra</label>
                    <input type="text" name="titulo" class="form-control" required>
                  </div>
                </div>
              </div>
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
                    <input type="number" name="longitud" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" class="form-control">
                    <small class="form-control-feedback"> En metros. </small>
                  </div>
                </div>      
              </div>         
              <div class="row p-t-20">
                <div class="col-md-12">
                  <div class="md-form form-md">
                    <label class="control-label">Departamento</label>
                    <input type="text" name="ubicacion" class="form-control">
                  </div>
                </div>
              </div>             
            </div>
            <div class="tab-pane p-20" id="proyecto" role="tabpanel" aria-expanded="false">
              <div class="row p-t-20">
                <div class="col-md-4">
                  <div class="md-form form-md">
                    <label class="control-label">Presupuesto oficial</label>
                    <input type="number" name="proyecto_monto" class="form-control" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" required>
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
                    <input type="checkbox" name="anticipo_financiero" value="1" id="basic_checkbox_3" class="filled-in" unchecked>
                    <label class="control-label" for="basic_checkbox_3">Anticipo financiero</label>
                    <input type="text" name="valor_anticipo_financiero" class="form-control">
                  </div>
                </div>      
              </div> 
              <div class="row p-t-20">
                <div class="col-md-4">
                  <div class="md-form form-md">
                    <label class="control-label">Plazo de obra</label>
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
              <div class="row p-t-20">
                <div class="col-md-12">
                  <div class="md-form">
                    <label class="control-label">Memoria descriptiva</label>
                    <textarea name="memoria_descriptiva" class="form-control md-textarea" length="50000" rows="4" required></textarea>
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
              <div class="row p-t-20">
                <div class="col-md-12">
                  <div class="md-form form-md">
                    <label class="control-label">Inspector de obra</label>
                    <select class="form-control custom-select" name="idinspector">
                        <option value="0" selected>No se ha seleccionado ningun usuario</option>
                      <?php foreach ($inspectores as $inspector):?>
                        <option value="<?php echo $inspector['id']; ?>"><?php echo $inspector['nombre'].' '.$inspector['apellido']; ?></option>
                      <?php endforeach; ?>
                    </select>
                    <small class="form-control-feedback"> Permitir acceso a la obra desde el panel del usuario asignado. </small> 
                  </div>
                </div>      
              </div>
            </div>
            <div class="tab-pane p-20" id="montos" role="tabpanel" aria-expanded="false">
              <div class="row p-t-20">
                <div class="col-md-6">
                  <div class="md-form form-md">
                    <label class="control-label">Monto de obra contrato</label>
                    <input type="number" name="contrato_monto" class="form-control" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" required>
                    <small class="form-control-feedback"> Firma de contrato. </small>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="md-form form-md">
                    <label class="control-label">Plazo de obra contrato</label>
                    <input type="text" name="contrato_plazo" class="form-control" required>
                    <small class="form-control-feedback"> Firma de contrato. </small>
                  </div>
                </div>   
              </div> 
              <hr>
              <div class="row p-t-20">
                <div class="col-md-6">
                  <div class="md-form form-md">
                    <label class="control-label">Monto vigente</label>
                    <input type="number" name="monto_vigente" class="form-control" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" required>
                    <small class="form-control-feedback"> En pesos argentinos. </small>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="md-form form-md">
                    <label class="control-label">Plazo vigente</label>
                    <input type="text" name="plazo_vigente" class="form-control" required>
                    <small class="form-control-feedback"> Total. </small>
                  </div>
                </div>      
              </div> 
              <hr>
              <div class="row p-t-20">
                <div class="col-md-6">
                  <div class="md-form form-md">
                    <label class="control-label">Monto contrato redeterminado</label>
                    <input type="number" name="monto_redeterminado" class="form-control" step="0.01" pattern="^\d+(?:\.\d{1,2})?$">
                    <small class="form-control-feedback"> En pesos argentinos. </small>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="md-form f orm-md">
                    <label class="control-label">&nbsp;</label>
                    <input type="text" name="info_redeterminacion" class="form-control">
                    <small class="form-control-feedback"> Informacion de adecuacion. </small>
                  </div>
                </div>      
              </div> 
            </div>
              <div class="tab-pane p-20" id="ceremonial" role="tabpanel" aria-expanded="false">
                <div class="row p-t-20">
                  <div class="col-md-12">
                    <div class="md-form">
                      <label class="control-label">Memoria descriptiva en vigencia</label>
                      <textarea name="memoria_descriptiva_vigente" class="form-control" rows="8"></textarea>
                    </div>
                  </div>
                </div> 
              </div>   
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" name="add_obra" class="btn btn-info waves-effect waves-light">Guardar cambios</button>
        </div>
      </form>      
    </div>
  </div>
</div>
</div>
</div>
</div>
