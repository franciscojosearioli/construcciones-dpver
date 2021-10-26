<?php
require_once('../../includes/load.php');
$get_id = $_POST['id'];
$data = find_by_id('recepciones_definitivas', 'idrecepciones_definitivas', $get_id);
$movimientos = rd_movimientos($data['idnotas'],$data['idexpedientes']);
$user = current_user();
?>
<div class="modal" id="movimientos_rd" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-full" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Movimientos de la recepcion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body p-4">

            <div class="container">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <?php if(!empty($data['idexpedientes'])){ ?><b><u>Expediente Nº:</u> <?php echo $data['idexpedientes']; ?></b><?php } else { ?> <b><u>Nota Ref.:</u> <?php echo $data['idnotas']; ?></b><?php }  
            $obra = find_by_name($data['nombre_obras']); ?>
            <hr>
            <b><u>Obra:</u> <?php if(!empty($data['obra'])){ echo $data['obra']; } else{ echo $obra['nombre']; ?></b><?php } ?>
            <hr>
            <u>Expediente de obra Nº</u> <?php if(!empty($data['expediente_obra'])){ echo $data['expediente_obra']; } else{ echo $obra['expediente']; ?><?php } ?>
          </ol>
        </div>
<div class="container">
                    <div class="card-body">
                      <div class="table-responsive">
                <table class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th> Fecha del movimiento</th>
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
<?php foreach($movimientos as $movimiento): 
                      $obra = find_by_name($movimiento['nombre_obras']);
                      $expedientes = recepciones_expedientes($movimiento['idexpedientes']);
                      $notas = recepciones_notas($movimiento['idnotas']);
                      ?>
                      <tr>
                        <td class="text-center"> <?php if($movimiento['fecha_movimiento'] != '0000-00-00'){ echo format_date($movimiento['fecha_movimiento']); } ?> </td>
                        <td class="text-center"> <?php 
                        if(!empty($movimiento['idexpedientes'])){
                          echo 'Expediente Nº '.clean($movimiento['idexpedientes']);}
                          elseif(!empty($movimiento['idnotas'])){ echo 'Nota Ref. '.clean($movimiento['idnotas']);
                        }
                        ?></td>
                        <td class="text-center"> <?php 
                        if(!empty($movimiento['idexpedientes']) && !empty($expedientes['fecha_inicio']) && $expedientes['fecha_inicio'] != '0000-00-00'){ 
                          echo format_date($expedientes['fecha_inicio']);
                        }elseif(!empty($movimiento['idnotas']) && !empty($notas['fecha_inicio']) && $notas['fecha_inicio'] != '0000-00-00'){
                          echo format_date($notas['fecha_inicio']);
                        }elseif($movimiento['fecha_pedido'] != '0000-00-00'){
                          echo format_date($movimiento['fecha_pedido']);
                        } 
                        ?> </td>
                        <td><?php 
                        if(!empty($movimiento['obra'])){ echo $movimiento['obra']; 
                      }else{ 
                        echo $obra['nombre']; } 
                        ?></td>
                        <td class="text-center"> <?php 
                        if(!empty($movimiento['expediente_obra'])){ 
                          echo $movimiento['expediente_obra']; 
                        }else{ 
                          echo $obra['expediente']; 
                        }
                        ?></td>
                          <td class="text-center"><?php 
                        if($movimiento['documentacion_planos'] == 0){ echo '<span class="text-danger" data-toggle="tooltip" data-original-title="Sin recibir"><i class="mdi mdi-close"></i> Planos conforme a obra - Sin recibir</span><br/>';} 
                        if($movimiento['documentacion_planos'] == 1){ echo '<span class="text-success" data-toggle="tooltip" data-original-title="Recibido"><i class="mdi mdi-check"></i> Planos conforme a obra - Recibido el ';
                        if(!empty($movimiento['documentacion_planos_fecha']) && $movimiento['documentacion_planos_fecha'] != '0000-00-00'){ 
                         echo format_date($movimiento['documentacion_planos_fecha']);} 
                        if(!empty($movimiento['documentacion_planos_observacion'])){ echo ' ('.$movimiento['documentacion_planos_observacion'].')'; }
                         echo '</span><br/>';}
                        if($movimiento['documentacion_ensayos'] == 0){ echo '<span class="text-danger" data-toggle="tooltip" data-original-title="Sin recibir"><i class="mdi mdi-close"></i> Ensayos de laboratorio - Sin recibir</span><br/>';} 
                        if($movimiento['documentacion_ensayos'] == 1){ echo '<span class="text-success" data-toggle="tooltip" data-original-title="Recibido"><i class="mdi mdi-check"></i> Ensayos de laboratorio - Recibido el ';
                        if(!empty($movimiento['documentacion_ensayos_fecha']) && $movimiento['documentacion_ensayos_fecha'] != '0000-00-00'){ 
                         echo format_date($movimiento['documentacion_ensayos_fecha']);} 
                        if(!empty($movimiento['documentacion_ensayos_observacion'])){ echo ' ('.$movimiento['documentacion_ensayos_observacion'].')'; }
                         echo '</span><br/>';}
                        if(!empty($movimiento['documentacion_mas'])){ echo '<span class="text-success" data-toggle="tooltip" data-original-title="Recibido"><i class="mdi mdi-check"></i> '.$movimiento['documentacion_mas'].' - Recibido el ';
                        if(!empty($movimiento['documentacion_mas_fecha']) && $movimiento['documentacion_mas_fecha'] != '0000-00-00'){ 
                         echo format_date($movimiento['documentacion_mas_fecha']);} 
                        if(!empty($movimiento['documentacion_mas_observacion'])){ echo ' ('.$movimiento['documentacion_mas_observacion'].')'; }
                         echo '</span><br/>';}
                        ?></td>
                        <td> <?php
                        if(!empty($movimiento['integrantes_resolucion_num'])){ 
                          echo 'Resolucion Nº '.$movimiento['integrantes_resolucion_num'].' el ';
                          if($movimiento['integrantes_resolucion_fecha'] != '0000-00-00'){ echo format_date($movimiento['integrantes_resolucion_fecha']); }
                          echo '<br/>';
                        }
                        if(!empty($movimiento['comision_agente1'])){ 
                         echo $movimiento['comision_agente1'];
                         if($movimiento['comision_agente1_notificado'] != '0000-00-00'){ 
                          echo ' - Notificado el '.format_date($movimiento['comision_agente1_notificado']);
                       } 
                       echo "<br/>";
                     }
                        if(!empty($movimiento['comision_agente2'])){ 
                         echo $movimiento['comision_agente2'];
                         if($movimiento['comision_agente2_notificado'] != '0000-00-00'){ 
                          echo ' - Notificado el '.format_date($movimiento['comision_agente2_notificado']);
                       } 
                       echo "<br/>";
                     }
                        if(!empty($movimiento['comision_agente3'])){ 
                         echo $movimiento['comision_agente3'];
                         if($movimiento['comision_agente3_notificado'] != '0000-00-00'){ 
                          echo ' - Notificado el '.format_date($movimiento['comision_agente3_notificado']);
                       } 
                       echo "<br/>";
                     }
                         ?></td>
                        <td> <?php 
                        if($movimiento['movilidad'] == 0){ echo '<span class="text-danger" data-toggle="tooltip" data-original-title="No disponible"><i class="mdi mdi-close"></i> No disponible</span><br/>';}
                        if($movimiento['movilidad'] == 1){ echo '<span class="text-success" data-toggle="tooltip" data-original-title="Disponible"><i class="mdi mdi-check"></i> Disponible';
                        if(!empty($movimiento['movilidad_fecha_observacion'])){ echo '- '.$movimiento['movilidad_observacion'].' ('.format_date($movimiento['movilidad_observacion_fecha']).')'; }
                         echo '</span><br/>';
                       }
                          ?></td>
                        <td> <?php 
                        if($movimiento['recibido_estado'] == NULL){ echo '<span class="text-danger" data-toggle="tooltip" data-original-title="Sin acciones"><i class="mdi mdi-close"></i> Sin acciones</span><br/>'; }
                        if($movimiento['recibido_estado'] === '0'){ echo '<span class="text-warning" data-toggle="tooltip" data-original-title="Sin recibir"><i class="mdi mdi-close"></i> Sin recibir</span><br/>'; }
                        if($movimiento['recibido_estado'] === '1'){ echo '<span class="text-success" data-toggle="tooltip" data-original-title="Recibido"><i class="mdi mdi-check"></i> Recibido</span><br/>'; }
                         ?> </td>





                        <td><?php echo $movimiento['observaciones']; ?></td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
</div>

                            </div>
                          </div>    

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>