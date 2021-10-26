<?php
require_once('../../includes/load.php');
require_once('../../includes/functions/recepciones.php');
cabecera('Recepciones definitivas archivadas');
$user = current_user();
$recepciones_definitivas_construcciones = recepciones_definitivas_construcciones_archivo();
$conteo_recepciones_definitivas = conteo_recepciones_definitivas_archivo('recepciones_definitivas','idrecepciones_definitivas');

?>
      <div class="row">
        <div class="col-lg-12">
          <?php echo display_msg($msg); ?>
        </div>
      </div>
      <div class="row" id="listar_rd">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
              <div class="col-12">
                                        <div class="d-flex flex-wrap margin-dt">
                                            <div>
                                                <h3 class="card-title">Listado de recepciones definitivas (Archivo)</h3>
                                                <h6 class="card-subtitle">Espere unos minutos hasta que cargue la planilla.</h6>
                                                <h6 class="card-subtitle">Deslice la planilla para ver mas información.</h6>
                                            </div>
                                        </div>
      <div class="table-responsive">
                <table id="all" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                  <thead>
                    <tr>      
                      <th></th>
                      <th class="text-center">  </th>
                      <th class="text-center"> Tramite </th>
                      <th class="text-center"> Fecha </th>
                      <th> Obra </th>
                      <th> Expediente obra</th>
                      <th> Documentacion</th>
                      <th> Comision</th>
                      <th> Movilidad</th>
                      <th> Acta/Informe </th>
                      <th> Observacion </th>              
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($recepciones_definitivas_construcciones as $recepcion):
                      $obra = find_by_name($recepcion['nombre_obras']);
                      ?>
                      <tr>
                        <td class="w-5"></td>
                        <td>
                          <a class="i-dt-list" onclick="movimiento_rd(<?php echo $recepcion['idrecepciones_definitivas']; ?>)" data-toggle="tooltip" title="Movimientos"><i class="mdi mdi-view-list"></i></a>
                          
                          <?php if(permiso('admin') || permiso('recepciones')){ ?>
                            <a class="i-dt-list" onclick="editar_rd(<?php echo $recepcion['idrecepciones_definitivas']; ?>)" data-toggle="tooltip" title="Editar datos"><i class="mdi mdi-pencil"></i></a>
                            <a class="i-dt-list" href="includes/functions/restaurar.php?id=<?php echo (int)$recepcion['idrecepciones_definitivas'];?>&url=recepciones-definitivas&tipo=recepcion-definitiva" data-toggle="tooltip" title="Restaurar"><i class="mdi mdi-backup-restore"></i></a>
                          <?php } ?>
                        </td>
                        <td class="text-center"> <?php 
                        if(!empty($recepcion['idexpedientes'])){
                          echo 'Expediente Nº '.clean($recepcion['idexpedientes']);}
                          elseif(!empty($recepcion['idnotas'])){ echo 'Nota Ref. '.clean($recepcion['idnotas']);
                        }
                        ?></td>
                        <td class="text-center"> <?php 
                        if(!empty($recepcion['idexpedientes']) && !empty($expedientes['fecha_inicio']) && $expedientes['fecha_inicio'] != '0000-00-00'){ 
                          echo ifdate($expedientes['fecha_inicio']);
                        }elseif(!empty($recepcion['idnotas']) && !empty($notas['fecha_inicio']) && $notas['fecha_inicio'] != '0000-00-00'){
                          echo ifdate($notas['fecha_inicio']);
                        }elseif($recepcion['fecha_pedido'] != '0000-00-00'){
                          echo ifdate($recepcion['fecha_pedido']);
                        } 
                        ?> </td>
                        <td><?php 
                        if(!empty($recepcion['obra'])){ echo $recepcion['obra']; 
                      }else{ 
                        echo '<a href="./obra?id='.$obra['idobras'].'" target="_blank">'.$obra['nombre'].'</a>'; } 
                        ?></td>
                        <td class="text-center"> <?php 
                        if(!empty($recepcion['expediente_obra'])){ 
                          echo $recepcion['expediente_obra']; 
                        }else{ 
                          echo $obra['expediente']; 
                        }
                        ?></td>
                        <td class="text-center"><?php 
                        if($recepcion['documentacion_planos'] == 0){ echo '<span class="text-danger" data-toggle="tooltip" data-original-title="Sin recibir"><i class="mdi mdi-close"></i> Planos conforme a obra - Sin recibir</span><br/>';} 
                        if($recepcion['documentacion_planos'] == 1){ echo '<span class="text-success" data-toggle="tooltip" data-original-title="Recibido"><i class="mdi mdi-check"></i> Planos conforme a obra - Recibido el ';
                        if(!empty($recepcion['documentacion_planos_fecha']) && $recepcion['documentacion_planos_fecha'] != '0000-00-00'){ 
                          echo ifdate($recepcion['documentacion_planos_fecha']);} 
                          if(!empty($recepcion['documentacion_planos_observacion'])){ echo ' ('.$recepcion['documentacion_planos_observacion'].')'; }
                          echo '</span><br/>';}
                          if($recepcion['documentacion_ensayos'] == 0){ echo '<span class="text-danger" data-toggle="tooltip" data-original-title="Sin recibir"><i class="mdi mdi-close"></i> Ensayos de laboratorio - Sin recibir</span><br/>';} 
                          if($recepcion['documentacion_ensayos'] == 1){ echo '<span class="text-success" data-toggle="tooltip" data-original-title="Recibido"><i class="mdi mdi-check"></i> Ensayos de laboratorio - Recibido el ';
                          if(!empty($recepcion['documentacion_ensayos_fecha']) && $recepcion['documentacion_ensayos_fecha'] != '0000-00-00'){ 
                            echo ifdate($recepcion['documentacion_ensayos_fecha']);} 
                            if(!empty($recepcion['documentacion_ensayos_observacion'])){ echo ' ('.$recepcion['documentacion_ensayos_observacion'].')'; }
                            echo '</span><br/>';}
                            if(!empty($recepcion['documentacion_mas'])){ echo '<span class="text-success" data-toggle="tooltip" data-original-title="Recibido"><i class="mdi mdi-check"></i> '.$recepcion['documentacion_mas'].' - Recibido el ';
                            if(!empty($recepcion['documentacion_mas_fecha']) && $recepcion['documentacion_mas_fecha'] != '0000-00-00'){ 
                              echo ifdate($recepcion['documentacion_mas_fecha']);} 
                              if(!empty($recepcion['documentacion_mas_observacion'])){ echo ' ('.$recepcion['documentacion_mas_observacion'].')'; }
                              echo '</span><br/>';}
                              ?></td>
                              <td> <?php
                              if(!empty($recepcion['integrantes_resolucion_num'])){ 
                                echo 'Resolucion Nº '.$recepcion['integrantes_resolucion_num'].' el ';
                                if($recepcion['integrantes_resolucion_fecha'] != '0000-00-00'){ echo ifdate($recepcion['integrantes_resolucion_fecha']); }
                                echo '<br/>';
                              }
                              if(!empty($recepcion['comision_agente1'])){ 
                                echo $recepcion['comision_agente1'];
                                if($recepcion['comision_agente1_notificado'] != '0000-00-00'){ 
                                  echo ' - Notificado el '.ifdate($recepcion['comision_agente1_notificado']);
                                } 
                                echo "<br/>";
                              }
                              if(!empty($recepcion['comision_agente2'])){ 
                                echo $recepcion['comision_agente2'];
                                if($recepcion['comision_agente2_notificado'] != '0000-00-00'){ 
                                  echo ' - Notificado el '.ifdate($recepcion['comision_agente2_notificado']);
                                } 
                                echo "<br/>";
                              }
                              if(!empty($recepcion['comision_agente3'])){ 
                                echo $recepcion['comision_agente3'];
                                if($recepcion['comision_agente3_notificado'] != '0000-00-00'){ 
                                  echo ' - Notificado el '.ifdate($recepcion['comision_agente3_notificado']);
                                } 
                                echo "<br/>";
                              }
                              ?></td>
                              <td> <?php 
                              if($recepcion['movilidad'] == 0){ echo '<span class="text-danger" data-toggle="tooltip" data-original-title="No disponible"><i class="mdi mdi-close"></i> No disponible</span><br/>';}
                              if($recepcion['movilidad'] == 1){ echo '<span class="text-success" data-toggle="tooltip" data-original-title="Disponible"><i class="mdi mdi-check"></i> Disponible';
                              if(!empty($recepcion['movilidad_fecha_observacion'])){ echo '- '.$recepcion['movilidad_observacion'].' ('.ifdate($recepcion['movilidad_observacion_fecha']).')'; }
                              echo '</span><br/>';
                            }
                            ?></td>
                            <td> <?php 
                            if($recepcion['recibido_estado'] == NULL){ echo '<span class="text-danger" data-toggle="tooltip" data-original-title="Sin acciones"><i class="mdi mdi-close"></i> Sin acciones</span><br/>'; }
                            if($recepcion['recibido_estado'] === '0'){ echo '<span class="text-warning" data-toggle="tooltip" data-original-title="Sin recibir"><i class="mdi mdi-close"></i> Sin recibir</span><br/>'; }
                            if($recepcion['recibido_estado'] === '1'){ echo '<span class="text-success" data-toggle="tooltip" data-original-title="Recibido"><i class="mdi mdi-check"></i> Recibido</span><br/>'; }
                            ?> </td>
                            <td><?php echo $recepcion['observaciones']; ?></td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>    
          </div>
        </div>
      </div>
        <div id="editar_rd"></div>
        <div id="movimientos_recepciones"></div>
        <script type="text/javascript" src="includes/ajax/scripts/recepciones-definitivas.js"></script>
          <?php 
          require_once('../modals/add_proyecto.php');
          pie(); ?>