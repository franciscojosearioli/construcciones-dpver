<?php  $proyecto = find_by_id('obras','idobras',(int)$_GET['id']);?>
<div class="modal fade" id="edit_proyecto" tabindex="-1" role="dialog" aria-labelledby="edit_proyecto" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100" id="edit_proyecto">Editar proyecto</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="card-body">
            <form method="post" action="proyecto.php?id=<?php echo (int)$proyecto['idobras']; ?>">
              <ul class="nav nav-tabs customtab2 justify-content-center m-b-30" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" data-toggle="tab" href="#generalidades" role="tab" aria-expanded="true">Generalidades</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#contratacion" role="tab" aria-expanded="false">Contratacion</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#tramite" role="tab" aria-expanded="false">Tramite</a>
                </li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane p-20 active" id="generalidades" role="tabpanel" aria-expanded="true">
                  <div class="row p-t-20">
                    <div class="col-md-12">
                      <div class="md-form form-md">
                        <label class="control-label">Titulo de obra</label>
                        <input type="text" name="titulo" class="form-control" value="<?php echo $proyecto['nombre'];?>" required>
                      </div>
                    </div>
                  </div>
                  <div class="row p-t-20">
                    <div class="col-md-6">
                      <div class="md-form form-md">
                        <label class="control-label">Descripcion</label>
                        <input type="text" name="descripcion" class="form-control" value="<?php echo $proyecto['descripcion'];?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="md-form form-md">
                        <label class="control-label">Longitud (en metros)</label>
                        <input type="number" name="longitud" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" class="form-control" value="<?php echo $proyecto['longitud'];?>">
                        <small class="form-control-feedback"> En metros. </small>
                      </div>
                    </div>     
                  </div>         
                  <div class="row p-t-20">
                    <div class="col-md-6">
                      <div class="md-form form-md">
                        <label class="control-label">Departamento / Localidad</label>
                        <input type="text" id="ubicacion" name="ubicacion" class="form-control" value="<?php echo $proyecto['ubicacion'];?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="md-form form-md">
                        <label class="control-label">Proyectista</label>
                        <input type="text" id="proyectista" name="proyectista" class="form-control" value="<?php echo $proyecto['proyectista'];?>">
                      </div>
                    </div>
                  </div>            
                  <div class="row p-t-20">
                    <div class="col-md-12">
                      <div class="md-form">
                        <label class="control-label">Memoria descriptiva</label>
                        <textarea name="memoria_descriptiva" class="form-control md-textarea" length="50000" rows="4"><?php echo $proyecto['memoria_descriptiva'];?></textarea>
                      </div>
                    </div>
                  </div>  
                  <div class="row p-t-20">
                    <div class="col-md-6">
                      <div class="md-form form-md">
                        <label class="control-label">Presupuesto oficial</label>
                        <input type="number" name="proyecto_monto" class="form-control" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" value="<?php echo $proyecto['proyecto_monto'];?>">
                        <small class="form-control-feedback"> En pesos argentinos. </small>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="md-form form-md">
                        <label class="control-label">Fecha de presupuesto</label>
                        <input type="text" name="proyecto_monto_fecha" class="form-control" value="<?php echo $proyecto['proyecto_monto_fecha'];?>">
                      </div>
                    </div>    
                  </div> 
                  <div class="row p-t-20">
                    <div class="col-md-6">
                      <div class="md-form form-md">
                        <label class="control-label">Plazo de ejecucion</label>
                        <input type="text" name="proyecto_plazo" class="form-control" value="<?php echo $proyecto['proyecto_plazo'];?>">
                        <small class="form-control-feedback"> Aprobado en proyecto. </small>
                      </div>
                    </div> 
                    <div class="col-md-6">
                      <div class="md-form form-md">
                        <label class="control-label">Plazo de garantía</label>
                        <input type="text" name="plazo_garantia" class="form-control" value="<?php echo $proyecto['plazo_garantia'];?>">
                        <small class="form-control-feedback"> Aprobado en proyecto. </small>
                      </div>
                    </div> 
                  </div> 
                  <div class="row p-t-20">
                    <div class="col-md-12">
                      <div class="md-form">
                        <label class="control-label">Observaciones</label>
                        <textarea name="observaciones" class="form-control md-textarea" length="50000" rows="2"><?php echo $proyecto['observaciones'];?></textarea>
                      </div>
                    </div>
                  </div> 
                </div> 
                <div class="tab-pane p-20" id="contratacion" role="tabpanel" aria-expanded="false">
                  <div class="row p-t-20">
                    <div class="col-md-4">
                      <div class="md-form form-md">
                        <label class="control-label">Aprobacion de pliegos</label>
                        <input type="date" class="form-control" name="aprobacion_res_fecha" value="<?php echo $proyecto['aprobacion_res_fecha'];?>">
                        <small class="form-control-feedback"> Fecha de Resolucion </small>     
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="md-form form-md">
                        <label class="control-label">&nbsp;</label>
                        <input type="text" name="aprobacion_res_num" class="form-control" value="<?php echo $proyecto['aprobacion_res_num'];?>">
                        <small class="form-control-feedback"> Numero </small>  
                      </div>
                    </div>      
                    <div class="col-md-4">
                      <div class="md-form form-md">
                        <label class="control-label">Adjudicacion a empresa</label>
                        <input type="date" name="adjudicacion_res_fecha" class="form-control" value="<?php echo $proyecto['adjudicacion_res_fecha'];?>">
                        <small class="form-control-feedback"> Fecha de Resolucion </small> 
                      </div>
                    </div>      
                    <div class="col-md-2">
                      <div class="md-form form-md">
                        <label class="control-label">&nbsp;</label>
                        <input type="text" name="adjudicacion_res_num" class="form-control" value="<?php echo $proyecto['adjudicacion_res_num'];?>">
                        <small class="form-control-feedback"> Numero </small> 
                      </div>
                    </div>
                  </div>   
                  <div class="row p-t-20">
                    <div class="col-md-6">
                      <div class="md-form form-md">
                        <label class="control-label">Contratista</label>
                        <input type="text" name="contratista" class="form-control" value="<?php echo $proyecto['contratista'];?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="md-form form-md">
                        <label class="control-label">Tipo de contratacion</label>
                        <input type="text" name="tipo_contratacion" class="form-control" value="<?php echo $proyecto['tipo_contratacion'];?>">
                      </div>
                    </div>      
                  </div> 
                  <div class="row p-t-20">
                    <div class="col-md-6">
                      <div class="md-form form-md">
                        <label class="control-label">Fuente de financiamiento</label>
                        <input type="text" name="tipo_financiamiento" class="form-control" value="<?php echo $proyecto['tipo_financiamiento'];?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="md-form form-md">
                        <label class="control-label">Firma del contrato</label>
                        <input type="date" name="contrato_fecha" class="form-control" value="<?php echo $proyecto['contrato_fecha'];?>">
                        <small class="form-control-feedback"> Fecha de firma. </small>  
                      </div>
                    </div>          
                  </div> 
                  <div class="row p-t-20">
                    <div class="col-md-12">
                      <div class="md-form form-md">
                        <label class="control-label">Monto de contrato</label>
                        <input type="number" name="contrato_monto" class="form-control" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" value="<?php echo $proyecto['contrato_monto'];?>">
                        <small class="form-control-feedback"> Firma de contrato. </small> 
                      </div>
                    </div>   
                  </div> 
                </div> 
                <div class="tab-pane p-20" id="tramite" role="tabpanel" aria-expanded="false">
                  <div class="form-group p-20">
                    <div class="row p-t-20">              
                      <div class="col-md-6">
                        <div class="md-form form-md">
                          <label class="control-label">Nº Expediente</label>
                          <input type="text" name="expediente" class="form-control" value="<?php echo $proyecto['expediente'];?>" required>
                        </div>
                      </div>     
                      <div class="col-md-3">
                        <label class="control-label">Prioridad</label>
                        <select class="form-control custom-select" name="prioridad">
                          <optgroup label="Establecido"> 
                            <?php
                            if($proyecto['prioridad'] == 1){ echo '<option value="1" selected>Urgente</option>'; }
                            if($proyecto['prioridad'] == 2){ echo '<option value="2" selected>Alta</option>'; }
                            if($proyecto['prioridad'] == 3){ echo '<option value="3" selected>Media</option>'; }
                            if($proyecto['prioridad'] == 4){ echo '<option value="4" selected>Baja</option>'; } ?>
                          </optgroup>
                          <optgroup label="Opciones ">
                            <option value="1">Urgente</option>
                            <option value="2">Alta</option>
                            <option value="3">Media</option>
                            <option value="4">Baja</option>
                          </optgroup>
                        </select>
                      </div>
                      <div class="col-md-3">          
                        <label class="control-label">Estado</label>
                        <select class="form-control custom-select" name="estado">
                          <optgroup label="Establecido"> 
                            <?php
                            if($proyecto['estado'] == 1){ echo '<option value="1" selected>En proyecto</option>'; }
                            if($proyecto['estado'] == 0){ echo '<option value="0" selected>En ejecucion</option>'; } ?>
                          </optgroup>
                          <optgroup label="Opciones ">
                            <option value="1">En proyecto</option>
                            <option value="0" >En ejecucion</option>
                          </optgroup>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="form-group p-20">
                    <div class="row p-t-20">
                      <div class="col-md-12">
                        <label class="control-label">Procedimiento administrativo</label>
                        <select class="form-control custom-select" name="tramite">
                          <optgroup label="Establecido"> 
                            <?php if($proyecto['tramite'] == 1){ echo '<option value="1" selected>1. Relevando y confeccionando proyecto y pliegos</option>';}
                            if($proyecto['tramite'] == 2){ echo '<option value="2" selected>2. Autorizando proyecto</option>';}
                            if($proyecto['tramite'] == 3){ echo '<option value="3" selected>3. Visando pliegos (Encuadre legal)</option>';}
                            if($proyecto['tramite'] == 4){ echo '<option value="4" selected>4. Reserva preventiva</option>';}
                            if($proyecto['tramite'] == 5){ echo '<option value="5" selected>5. Tomado conocimiento</option>';}
                            if($proyecto['tramite'] == 6){ echo '<option value="6" selected>6. Conf. proyecto de resolución llamado / Desig. Comision de est. / Aprobado de res.</option>';}
                            if($proyecto['tramite'] == 7){ echo '<option value="7" selected>7. Cursado de invitacion y plazo de preparacion de ofertas</option>';}
                            if($proyecto['tramite'] == 8){ echo '<option value="8" selected>8. Apertura de ofertas y armado de expediente</option>';}
                            if($proyecto['tramite'] == 9){ echo '<option value="9" selected>9. Desglasando la garantia de oferta</option>';}
                            if($proyecto['tramite'] == 10){ echo '<option value="10" selected>10. Designacion comision de estudio y resolucion</option>';}
                            if($proyecto['tramite'] == 11){ echo '<option value="11" selected>11. Aprob. Res. de designacion</option>';}
                            if($proyecto['tramite'] == 12){ echo '<option value="12" selected>12. Comision de estudios</option>';}
                            if($proyecto['tramite'] == 13){ echo '<option value="13" selected>13. Reserva definitiva</option>';}
                            if($proyecto['tramite'] == 14){ echo '<option value="14" selected>14. Confeccionando proyecto de resolucion de adjudicacion y aprobacion</option>';}
                            if($proyecto['tramite'] == 15){ echo '<option value="15" selected>15. Notificacion al adjudicatario</option>';}
                            if($proyecto['tramite'] == 16){ echo '<option value="16" selected>16. Solicitando gtia. contractual, notif. de perdedores, devol. de gtia.</option>';}
                            if($proyecto['tramite'] == 17){ echo '<option value="17" selected>17. Redactando contrato</option>';}
                            if($proyecto['tramite'] == 18){ echo '<option value="18" selected>18. Sellando contrato</option>';}
                            if($proyecto['tramite'] == 19){ echo '<option value="19" selected>19. Designando inspeccion / Confeccion acta de inicio</option>';}
                            if($proyecto['tramite'] == 20){ echo '<option value="20" selected>20. En ejecucion</option>';}
                            ?>
                          </optgroup>
                          <optgroup label="Opciones"> 
                            <option value="1">1. Relevando y confeccionando proyecto y pliegos</option>
                            <option value="2">2. Autorizando proyecto</option>
                            <option value="3">3. Visando pliegos (Encuadre legal)</option>
                            <option value="4">4. Reserva preventiva</option>
                            <option value="5">5. Tomado conocimiento</option>
                            <option value="6">6. Conf. proyecto de resolución llamado / Desig. Comision de est. / Aprobado de res.</option>
                            <option value="7">7. Cursado de invitacion y plazo de preparacion de ofertas</option>
                            <option value="8">8. Apertura de ofertas y armado de expediente</option>
                            <option value="9">9. Desglasando la garantia de oferta</option>
                            <option value="10">10. Designacion comision de estudio y resolucion</option>
                            <option value="11">11. Aprob. Res. de designacion</option>
                            <option value="12">12. Comision de estudios</option>
                            <option value="13">13. Reserva definitiva</option>
                            <option value="14">14. Confeccionando proyecto de resolucion de adjudicacion y aprobacion</option>
                            <option value="15">15. Notificacion al adjudicatario</option>
                            <option value="16">16. Solicitando gtia. contractual, notif. de perdedores, devol. de gtia.</option>
                            <option value="17">17. Redactando contrato</option>
                            <option value="18">18. Sellando contrato</option>
                            <option value="19">19. Designando inspeccion / Confeccion acta de inicio</option>
                            <option value="20">20. En ejecucion</option>
                          </optgroup>
                        </select>
                      </div> 
                    </div>
                  </div>
                </div> 
                <div class="modal-footer">
                  <button type="submit" name="edit_proyecto" class="btn btn-info waves-effect waves-light">Guardar cambios</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>