<?php 
$obra = find_by_id('obras','idobras', (int)$_GET['id']);

$planes_de_trabajo = planes_de_trabajo_obras($obra['idobras']);
$cotizaciones = cotizaciones_obras($obra['idobras']);

$inspectores = all_inspectores(); 
$inspector_asignado = find_by_id('users','id',(int)$obra['idinspector']);
?>
<div class="modal fade" id="edit_obra" tabindex="-1" role="dialog" aria-labelledby="edit_obra" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100" id="edit_obra">Editar informacion de obra</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="obras.php?id=<?php echo (int)$obra['idobras']; ?>">      
        <div class="modal-body">
          <div class="form-group p-20">
            <div class="row p-t-20">
              <div class="col-md-4">
                <div class="md-form form-md">
                  <label class="control-label">Nº Caja <i class="fas fa-question-circle" data-toggle="tooltip" title="Numero de archivo administrativo"></i></label>
                  <input type="text" name="numero" class="form-control" value="<?php echo $obra['numero'];?>">
                </div>
              </div>                  
              <div class="col-md-4">
                <div class="md-form form-md">
                  <label class="control-label">Nº Expediente <i class="fas fa-question-circle" data-toggle="tooltip" title="Expediente principal de obra"></i></label>
                  <input type="text" name="expediente" class="form-control" value="<?php echo $obra['expediente'];?>" required>
                </div>
              </div>     
              <div class="col-md-4">
                <label class="control-label">Estado <i class="fas fa-question-circle" data-toggle="tooltip" title="Estado de obra"></i></label>
                <select class="form-control custom-select" name="estado" id="select_estado" required>
                  <optgroup label="Establecido">
                    <?php if($obra['estado'] == 2 || !isset($obra['estado'])){ echo '<option selected>Sin definir</option>'; }
                    if($obra['estado'] == 1){ echo '<option value="1" selected>En proyecto</option>'; }
                    if($obra['estado'] == 6){ echo '<option value="6" selected>A Iniciar</option>'; }
                    if($obra['estado'] == 0){ echo '<option value="0" selected>En ejecucion</option>'; }
                    if($obra['estado'] == 3){ echo '<option value="3" selected>Finalizado</option>'; }
                    if($obra['estado'] == 4){ echo '<option value="4" selected>Neutralizado</option>'; }
                    if($obra['estado'] == 5){ echo '<option value="5" selected>Rescindido</option>'; } ?>
                  </optgroup>
                  <optgroup label="Opciones ">
                    <option value="1">En proyecto</option>
                    <option value="6">A Iniciar</option>
                    <option value="0">En ejecucion</option>
                    <option value="3">Finalizado</option>
                    <option value="4">Neutralizado</option>
                    <option value="5">Rescindido</option>
                  </optgroup>
                  </select>
                </div>
              </div>
              <div id="estado-finalizado">
<?php if($obra['estado'] == 3){
?>
                     <div class="row p-t-20">
                      <div class="col-12">
                        <label class="control-label">Detalles estado finalizado</label>
                        <select class="form-control custom-select" name="idestado_finalizado">
                          <option selected disabled>Seleccione un estado</option>
                            <option value="0" <?php if($obra['finalizado'] == 0){ ?> selected <?php } ?>>Finalizada sin recibir</option>
                            <option value="1" <?php if($obra['finalizado'] == 1){ ?> selected <?php } ?>>En garantia</option>
                            <option value="2" <?php if($obra['finalizado'] == 2){ ?> selected <?php } ?>>Finalizada definitiva</option>
                        </select>
                      </div> 
                    </div>
<?php } ?>
</div>


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
                      <label class="control-label">Observaciones generales <i class="fas fa-question-circle" data-toggle="tooltip" title="Observaciones de obra"></i></label>
                      <textarea name="observaciones" class="form-control" rows="3"><?php echo $obra['observaciones'];?></textarea>
                    </div>
                  </div> 
                </div>
              </div>
            </div>
            <ul class="nav customtab2 justify-content-center m-b-30" style="border-bottom: 1px solid #ddd;" role="tablist">
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
                <a class="nav-link" data-toggle="pill" href="#montos" role="tab" aria-expanded="false">Datos vigentes</a>
              </li>  
            </ul>
            <div class="tab-content">
              <div class="tab-pane p-20 active" id="generalidades" role="tabpanel" aria-expanded="true">
                <div class="row p-t-20">
                  <div class="col-md-12">
                    <div class="md-form form-md">
                      <label class="control-label">Titulo de obra <i class="fas fa-question-circle" data-toggle="tooltip" title="Nombre de obra"></i></label>
                      <input type="text" name="titulo" class="form-control" value="<?php echo $obra['nombre'];?>" required>
                    </div>
                  </div>
                </div>
                <div class="row p-t-20">
                  <div class="col-md-6">
                    <div class="md-form form-md">
                      <label class="control-label">Descripcion <i class="fas fa-question-circle" data-toggle="tooltip" title="Tipo de obra. Ejemplo: Pavimentacion"></i></label>
                      <input type="text" name="descripcion" class="form-control" value="<?php echo $obra['descripcion'];?>">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="md-form form-md">
                      <label class="control-label">Longitud <i class="fas fa-question-circle" data-toggle="tooltip" title="Medicion de obra en metros"></i></label>
                      <input type="number" name="longitud" step="any" class="form-control" value="<?php echo $obra['longitud'];?>">
                    </div>
                  </div>      
                </div>         
                <div class="row p-t-20">
                  <div class="col-md-6">
                    <div class="md-form form-md">
                      <label class="control-label">Departamento / Localidad <i class="fas fa-question-circle" data-toggle="tooltip" title="Ubicacion de obra"></i></label>
                      <input type="text" name="ubicacion" class="form-control" value="<?php echo $obra['ubicacion'];?>">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="md-form form-md">
                      <label class="control-label">Proyectista <i class="fas fa-question-circle" data-toggle="tooltip" title="Autor de confeccion de proyecto"></i></label>
                      <input type="text" name="proyectista" class="form-control" value="<?php echo $obra['proyectista'];?>">
                    </div>
                  </div>
                </div>             
              </div>
              <div class="tab-pane p-20" id="proyecto" role="tabpanel" aria-expanded="false">
                <div class="row p-t-20">
                  <div class="col-md-4">
                    <div class="md-form form-md">
                      <label class="control-label">Presupuesto oficial <i class="fas fa-question-circle" data-toggle="tooltip" title="Monto de presupuesto de proyecto"></i></label>
                      <input type="number" name="proyecto_monto" class="form-control" step="any" value="<?php echo $obra['proyecto_monto'];?>">
                      <small class="form-control-feedback"> En pesos argentinos. </small>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="md-form form-md">
                      <label class="control-label">Fecha del presupuesto <i class="fas fa-question-circle" data-toggle="tooltip" title="Fecha de presupuesto oficial"></i></label>
                      <input type="text" name="proyecto_monto_fecha" class="form-control" value="<?php echo $obra['proyecto_monto_fecha'];?>">
                    </div>
                  </div>
                  <div class="col-md-4">
                  <div class="md-form form-md">
                    <input type="checkbox" name="anticipo_financiero" value="1" id="basic_checkbox_3" class="filled-in" <?php if($obra['anticipo_financiero'] == 1){ echo 'checked'; }else{ echo 'unchecked'; };?>>
                    <label class="control-label" for="basic_checkbox_3">Anticipo financiero <i class="fas fa-question-circle" data-toggle="tooltip" title="Obra con anticipo y su valor en porcentaje"></i></label>
                    <input type="text" name="valor_anticipo_financiero" class="form-control" value="<?php echo $obra['valor_anticipo_financiero'];?>">
                  </div>
                </div>        
                </div> 
                <div class="row p-t-20">
                  <div class="col-md-4">
                    <div class="md-form form-md">
                      <label class="control-label">Plazo de ejecucion <i class="fas fa-question-circle" data-toggle="tooltip" title="Plazo de ejecucion de obra segun proyecto"></i></label>
                      <input type="text" name="proyecto_plazo" class="form-control" value="<?php echo $obra['proyecto_plazo'];?>">
                      <small class="form-control-feedback"> Aprobado en proyecto. </small>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="md-form form-md">
                      <label clasee="control-label">Plazo de garantia <i class="fas fa-question-circle" data-toggle="tooltip" title="Plazo de garantia segun proyecto"></i></label>
                      <input type="text" name="plazo_garantia" class="form-control" value="<?php echo $obra['plazo_garantia'];?>">
                    </div>
                  </div>      
                  <div class="col-md-4">
                    <div class="md-form form-md">
                      <label clasee="control-label">Vencimiento de certificados <i class="fas fa-question-circle" data-toggle="tooltip" title="Plazo de vencimiento de certificados expresados en dias"></i></label>
                      <input type="number" name="certificado_vencimiento" class="form-control" value="<?php echo $obra['certificado_vencimiento'];?>">
                    </div>
                  </div>                    
                </div> 
                <div class="row p-t-20">
                  <div class="col-md-12">
                    <div class="md-form">
                      <label class="control-label">Memoria descriptiva <i class="fas fa-question-circle" data-toggle="tooltip" title="Memoria descriptiva segun proyecto original"></i></label>
                      <textarea name="memoria_descriptiva" id="memoria" class="form-control" rows="5" required><?php echo $obra['memoria_descriptiva'];?></textarea>
                    </div>
                  </div>
                </div> 
              </div>
              <div class="tab-pane p-20" id="contratacion" role="tabpanel" aria-expanded="false">
                <div class="row p-t-20">
                <div class="col-md-6">
                    <div class="md-form form-md">
                      <label class="control-label">Contratista <i class="fas fa-question-circle" data-toggle="tooltip" title="Empresa adjudicada "></i></label>
                      <input type="text" name="contratista" class="form-control" value="<?php echo $obra['contratista'];?>">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="md-form form-md">
                      <label class="control-label">Tipo de contratacion <i class="fas fa-question-circle" data-toggle="tooltip" title="Ejemplo: Licitacion publica N _"></i></label>
                      <input type="text" name="tipo_contratacion" class="form-control" value="<?php echo $obra['tipo_contratacion'];?>">
                    </div>
                  </div>      
                </div> 
                <div class="row p-t-20">
                  <div class="col-md-4">
                    <div class="md-form form-md">
                      <label class="control-label">Aprobacion de proyecto <i class="fas fa-question-circle" data-toggle="tooltip" title="Fecha de aprobacion de pliegos del proyecto de obra"></i></label>
                      <input type="date" class="form-control" name="aprobacion_res_fecha" value="<?php echo $obra['aprobacion_res_fecha'];?>">
                      <small class="form-control-feedback"> Fecha de Resolucion </small>                            
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="md-form form-md">
                      <label class="control-label">&nbsp;</label>
                      <input type="text" name="aprobacion_res_num" class="form-control" value="<?php echo $obra['aprobacion_res_num'];?>">
                      <small class="form-control-feedback"> Numero </small>  
                    </div>
                  </div>      
                  <div class="col-md-4">
                    <div class="md-form form-md">
                      <label class="control-label">Adjudicacion a empresa <i class="fas fa-question-circle" data-toggle="tooltip" title="Fecha de adjudicacion de empresa a obra"></i></label>
                      <input type="date" name="adjudicacion_res_fecha" class="form-control" value="<?php echo $obra['adjudicacion_res_fecha'];?>">
                      <small class="form-control-feedback"> Fecha de Resolucion </small> 
                    </div>
                  </div>      
                  <div class="col-md-2">
                    <div class="md-form form-md">
                      <label class="control-label">&nbsp;</label>
                      <input type="text" name="adjudicacion_res_num" class="form-control" value="<?php echo $obra['adjudicacion_res_num'];?>">
                      <small class="form-control-feedback"> Numero </small>  
                    </div>
                  </div>
                </div>             
                <div class="row p-t-20">
                  <div class="col-md-6">
                    <div class="md-form form-md">
                      <label class="control-label">Fuente de financiamiento <i class="fas fa-question-circle" data-toggle="tooltip" title="Origen de fondos de pago de obra"></i></label>
                      <input type="text" name="tipo_financiamiento" class="form-control" value="<?php echo $obra['tipo_financiamiento'];?>">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="md-form form-md">
                      <label class="control-label">Firma del contrato <i class="fas fa-question-circle" data-toggle="tooltip" title="Fecha de firma de contrato"></i></label>
                      <input type="date" name="contrato_fecha" class="form-control" value="<?php echo $obra['contrato_fecha'];?>">
                    </div>
                  </div>          
                </div> 
                <div class="row p-t-20">
                   <div class="col-md-6">
                    <div class="md-form form-md">
                      <label class="control-label">Acta de inicio <i class="fas fa-question-circle" data-toggle="tooltip" title="Fecha de inicio de obra"></i></label>
                      <input type="date" name="fecha_inicio" class="form-control" value="<?php echo $obra['fecha_inicio'];?>">  
                    </div>
                  </div>   
                <div class="col-md-6">
                  <div class="row">
                  <div class="col-6">
                  <div class="md-form form-md">
                    <label class="control-label">Finalizacion <i class="fas fa-question-circle" data-toggle="tooltip" title="Fecha de finalizacion de obra aproximada"></i></label>
                    <input type="date" name="fecha_fin" class="form-control" value="<?php echo $obra['fecha_fin'];?>">
                  </div></div>
                  <div class="col-6">
                    <input type="checkbox" name="fecha_fin_no_define" value="1" id="basic_checkbox_2" class="filled-in" <?php if($obra['fecha_fin_no_define'] == 1){ echo 'checked'; }else{ echo ''; };?>>
                    <label for="basic_checkbox_2">No define fecha fin</label> 
                  </div>
                </div>
                </div>    
                </div>  
                <div class="row p-t-20">
                  <div class="col-md-12">
                    <div class="md-form form-md">
                      <label class="control-label">Inspector de obra <i class="fas fa-question-circle" data-toggle="tooltip" title="Inspector designado a obra"></i></label>
                    <select class="form-control custom-select" name="idinspector">
                  <optgroup label="Establecido">
                    <?php if($obra['idinspector'] != '0' && $obra['idinspector'] != NULL){ ?>
                        <option value="<?php echo $obra['idinspector']; ?>" selected ><?php echo $inspector_asignado['nombre'].' '.$inspector_asignado['apellido']; ?></option>
                        <?php }else{ echo '<option selected>No se ha asignado inspector</option>'; } ?>
                  </optgroup>
                  <optgroup label="Opciones ">
                      <?php foreach ($inspectores as $inspector):?>
                        <option value="<?php echo $inspector['id']; ?>"><?php echo $inspector['nombre'].' '.$inspector['apellido']; ?></option>
                      <?php endforeach; ?>
                  </optgroup>
                </select>
                    </div>
                  </div>  
                </div>            
              </div>
              <div class="tab-pane p-20" id="montos" role="tabpanel" aria-expanded="false">
                <div class="row p-t-20">
                <div class="col-md-6">
                    <div class="md-form form-md">
                      <label class="control-label">Plan de trabajo vigente <i class="fas fa-question-circle" data-toggle="tooltip" title="Plan de trabajo "></i></label>
                      <select class="form-control custom-select" name="plan_de_trabajo">
                  <optgroup label="Establecido">
                    <?php if($obra['idplanes_de_trabajo'] != '0' && $obra['idplanes_de_trabajo'] != NULL){ ?>
                        <option value="<?php echo $obra['idplanes_de_trabajo']; ?>" selected >plan de trabajo activo</option>
                        <?php }else{ echo '<option selected value="0">No se ha asignado plan de trabajo</option>'; } ?>
                  </optgroup>
                  <optgroup label="Opciones ">
                      <?php foreach ($planes_de_trabajo as $p):?>
                        <option value="<?php echo $p['idplanes_de_trabajo']; ?>"><?php echo $p['numero']; ?></option>
                      <?php endforeach; ?>
                  </optgroup>
                </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="md-form form-md">
                      <label class="control-label">Cotizacion vigente <i class="fas fa-question-circle" data-toggle="tooltip" title="Items de obra"></i></label>
                      <select class="form-control custom-select" name="cotizacion">
                  <optgroup label="Establecido">
                    <?php if($obra['idcotizaciones'] != '0' && $obra['idcotizaciones'] != NULL){ ?>
                        <option value="<?php echo $obra['idcotizaciones']; ?>" selected >cotizacion activo</option>
                        <?php }else{ echo '<option selected value="0">No se ha asignado cotizacion</option>'; } ?>
                  </optgroup>
                  <optgroup label="Opciones ">
                      <?php foreach ($cotizaciones as $c):?>
                        <option value="<?php echo $c['idcotizaciones']; ?>"><?php echo $c['numero']; ?></option>
                      <?php endforeach; ?>
                  </optgroup>
                </select>
                    </div>
                  </div>
                </div>


                <hr>
              
                <div class="row p-t-20">
                <div class="col-md-6">
                  <div class="md-form form-md">
                    <label class="control-label">Monto de obra contrato <i class="fas fa-question-circle" data-toggle="tooltip" title="Monto de contrato original"></i></label>
                    <input type="number" name="contrato_monto" class="form-control" step="any" value="<?php echo $obra['contrato_monto'];?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="md-form form-md">
                    <label class="control-label">Plazo de ejecucion contrato <i class="fas fa-question-circle" data-toggle="tooltip" title="Fecha de ejecucion de obra contratada"></i></label>
                    <input type="text" name="proyecto_plazo" class="form-control" value="<?php echo $obra['proyecto_plazo'];?>" disabled>
                  </div>
                </div> 
                </div> 
                <hr>
                <div class="row p-t-20">
                  <div class="col-md-6">
                    <div class="md-form form-md">
                      <label class="control-label">Monto de obra vigente <i class="fas fa-question-circle" data-toggle="tooltip" title="Monto de obra en vigencia"></i></label>
                      <input type="number" name="monto_vigente" class="form-control" step="any" value="<?php echo $obra['monto_vigente'];?>">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="md-form form-md">
                      <label class="control-label">Observacion <i class="fas fa-question-circle" data-toggle="tooltip" title="Informacion del monto"></i></label>
                      <input type="text" name="monto_vigente_obs" class="form-control" value="<?php echo $obra['monto_vigente_obs'];?>">
                    </div>
                  </div>      
                </div> 
                <hr>
                <div class="row p-t-20">
                  <div class="col-md-6">
                    <div class="md-form form-md">
                      <label class="control-label">Plazo de ejecucion vigente <i class="fas fa-question-circle" data-toggle="tooltip" title="Plazo de ejecucion de obra en vigencia"></i></label>
                      <input type="text" name="plazo_vigente" class="form-control" value="<?php echo $obra['plazo_vigente'];?>">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="md-form form-md">
                      <label class="control-label">Observacion <i class="fas fa-question-circle" data-toggle="tooltip" title="Informacion del plazo"></i></label>
                      <input type="text" name="plazo_vigente_obs" class="form-control" value="<?php echo $obra['plazo_vigente_obs'];?>">
                    </div>
                  </div>      
                </div> 
                <hr>
                <div class="row p-t-20">
                  <div class="col-md-6">
                    <div class="md-form form-md">
                      <label class="control-label">Monto contrato redeterminado <i class="fas fa-question-circle" data-toggle="tooltip" title="Monto de obra de ultima redeterminacion"></i></label>
                      <input type="number" name="monto_redeterminado" class="form-control" step="any" value="<?php echo $obra['monto_redeterminado'];?>">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="md-form f orm-md">
                      <label class="control-label">Observacion <i class="fas fa-question-circle" data-toggle="tooltip" title="Informacion de redeterminacion"></i></label>
                      <input type="text" name="info_redeterminacion" class="form-control" value="<?php echo $obra['info_redeterminacion'];?>">
                    </div>
                  </div>      
                </div> 
                <hr>
                <div class="row p-t-20">
                  <div class="col-md-12">
                    <div class="md-form">
                      <label class="control-label">Memoria descriptiva vigente <i class="fas fa-question-circle" data-toggle="tooltip" title="Memoria descriptiva en vigencia"></i></label>
                      <textarea name="memoria_descriptiva_vigente" id="memoria_vigente"  class="form-control" rows="8" required><?php echo $obra['memoria_descriptiva_vigente'];?></textarea>
                    </div>
                  </div>
                </div> 
              </div>             
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" name="edit_obra" class="btn btn-info waves-effect waves-light">Guardar cambios</button>
          </div>
        </form>      
      </div>
    </div>
  </div>
