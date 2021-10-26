<?php
require_once('../../includes/load.php');
require_once('../../includes/functions/recepciones.php');
$user = current_user();
$recepciones_provisorias_construcciones = recepciones_provisorias_construcciones($user['iddepartamentos']);
$conteo_recepciones_provisorias = conteo_recepciones_provisorias('recepciones_provisorias','idrecepciones_provisorias');
cabecera('Recepciones provisorias de obras');
?>
<div class="row justify-content-center">
         <div class="col-10">
              <div class="d-flex flex-wrap p-b-30">
              <div class="my-auto ml-3">
              <span title="Agregar nuevo" data-toggle="tooltip" class="btn-light" style="display: inline-block;font-weight: 400;text-align: center;vertical-align: middle;-webkit-user-select: none;-moz-user-select: none;  -ms-user-select: none;  user-select: none;  border: 1px solid transparent; padding: .5rem .75rem;  font-size: 1rem;  line-height: 1.25;  border-radius: .25rem;  transition: all .15s ease-in-out; padding: 7px 12px; font-size: 14px; cursor: pointer;">
              Buscar por nombre de obra: <input type="search" style="background:#f0f0f0;width:350px;height:20px;min-height:20px;" class="form-control" aria-controls="1" id="busqueda">
              </span>
              </div>
              <div class="ml-auto my-auto mr-3">
<?php if(permiso('admin') || permiso('obras') || permiso('recepciones')){ ?>
              <a id="btn_agregar" onclick="form_agregar(true)" title="Agregar nuevo" data-toggle="tooltip" class="btn btn-light"><i class="fas fa-plus"></i> Cargar nuevo</a>
                  <?php } ?>
              </div>
              </div>
              </div>
         </div>
         <div class="row justify-content-center" id="listar_rp">
         <div class="col-10">
          <div class="card">
            <div class="card-body">
              <div class="row">
              <div class="col-12">
                <div class="card-body cards-titulo">
              <div class="d-flex flex-wrap p-b-30">
              <div class="my-auto ml-3">
                <h1><b>Recepciones provisorias de obras</b></h1>
              </div>
            </div>
            </div>
            <div class="table-responsive">
              <table id="all" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th></th>
                    <th class="text-center">  </th>
                    <th class="text-center"> Fecha de pedido </th>
                    <th class="text-center"> Expediente </th>
                    <th> Obra </th>
                    <th> Expediente obra</th>
                    <!--<th class="text-center"> Inicio del Tramite </th>
                    <th class="text-center"> Seguimiento del Tramite </th>-->
                    <th> Documentacion</th>
                    <th> Comision</th>
                    <th> Movilidad</th>
                    <th> Acta/Informe </th>
                    <th> Observacion </th>    
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  foreach ($recepciones_provisorias_construcciones as $recepcion):
                    $obra = find_by_name($recepcion['nombre_obras']);
                    $expedientes = recepciones_expedientes($recepcion['idexpedientes']);
                    $notas = recepciones_notas($recepcion['idnotas']);
if(!empty($recepcion['idexpedientes'])){
//$inicio_exp = buscar_expediente($recepcion['idexpedientes']);                
//$ul_mov_exp = ul_mov_exp($recepcion['idexpedientes']);
}
                    ?>
                    <tr>
                      <td class="w-5"></td>
                      <td>
                        <a class="i-dt-list" onclick="movimiento_rp(<?php echo $recepcion['idrecepciones_provisorias']; ?>)" data-toggle="tooltip" title="Movimientos"><i class="mdi mdi-view-list"></i></a>
                        <?php if(permiso('admin') || permiso('recepciones')){ ?>
                          <a class="i-dt-list" onclick="editar_rp(<?php echo $recepcion['idrecepciones_provisorias']; ?>)" data-toggle="tooltip" title="Editar datos"><i class="mdi mdi-pencil"></i></a>
                          <!--<a class="i-dt-list" href="includes/functions/archivar.php?id=<?php echo $recepcion['idrecepciones_provisorias'];?>&url=recepciones-provisorias&tipo=recepcion-provisoria" data-toggle="tooltip" title="Archivar"><i class="mdi mdi-archive"></i></a>
                          <a class="i-dt-list" href="includes/functions/eliminar.php?id=<?php echo $recepcion['idrecepciones_provisorias'];?>&url=recepciones-provisorias&tipo=recepcion-provisoria" title="Eliminar"><i class="mdi mdi-close"></i></a>   
                          -->
                        <?php } ?>
                      </td>
                      <td class="text-center"> <?php 
                      if(!empty($recepcion['idexpedientes']) && !empty($expedientes['fecha_inicio']) && $expedientes['fecha_inicio'] != '0000-00-00'){ 
                        echo ifdate($expedientes['fecha_inicio']);
                      }elseif(!empty($recepcion['idnotas']) && !empty($notas['fecha_inicio']) && $notas['fecha_inicio'] != '0000-00-00'){
                        echo ifdate($notas['fecha_inicio']);
                      }elseif($recepcion['fecha_pedido'] != '0000-00-00'){
                        echo ifdate($recepcion['fecha_pedido']);
                      } 
                      ?> </td>
                      <td class="text-center"> <?php 
                      if(!empty($recepcion['idexpedientes'])){
                        echo clean($recepcion['idexpedientes']);}
                        elseif(!empty($recepcion['idnotas'])){ echo 'Nota'.clean($recepcion['idnotas']);
                      }
                      ?></td>
                      <?php if(permiso('admin')){ ?>
                      <td><?php 
                      if(!empty($recepcion['obra'])){ echo substr($recepcion['obra'], 0, 50).'...';
                    }elseif(!empty($obra['alias'])){ 
                      echo '<a href="./obra?id='.$obra['idobras'].'" target="_blank">'.$obra['alias'].'</a>'; }elseif(empty($obra['alias'])){ 
echo '<a href="./obra?id='.$obra['idobras'].'" target="_blank">'.substr(ifexist($obra['nombre']), 0, 50).'...'.'</a>';
                      } 
                      ?></td>
<?php }else{ ?>
<td><?php 
                      if(!empty($recepcion['obra'])){ echo $recepcion['obra']; 
                    }else{ 
                      echo '<a href="./obra?id='.$obra['idobras'].'" target="_blank">'.substr(ifexist($obra['nombre']), 0, 50).'...'.'</a>'; } 
                      ?></td>
<?php } ?>
                      <td class="text-center"> <?php 
                      if(!empty($recepcion['expediente_obra'])){ 
                        echo $recepcion['expediente_obra']; 
                      }else{ 
                        echo $obra['expediente']; 
                      }
                      ?></td>
                      <!--<td class="text-center"> <?php echo ifdate($inicio_exp['fechareg']); ?> </td><td class="text-center"> <?php if(!empty($recepcion['idexpedientes'])){
                      echo '<b>'.ifdate($ul_mov_exp['fecha']).'</b> en <b>'.utf8_encode($ul_mov_exp['tramite']).'</b>';
                    }else{ echo 'Sin movimientos';}
                      ?></td>  -->
                      <td ><?php 
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
                          <td>
                          
                          <div id="main">
  <div class="container">
<div class="accordion" id="faq">
                    <div class="card">
                        <div id="faqhead<?php echo (int)$recepcion['idrecepciones_provisorias'];?>">
                            <a href="#"  data-toggle="collapse" data-target="#faq<?php echo (int)$recepcion['idrecepciones_provisorias'];?>"
                            aria-expanded="true" aria-controls="faq<?php echo (int)$recepcion['idrecepciones_provisorias'];?>">Mostrar/Ocultar Observaciones</a>
                        </div>

                        <div id="faq<?php echo (int)$recepcion['idrecepciones_provisorias'];?>" class="collapse" aria-labelledby="faqhead<?php echo (int)$recepcion['idrecepciones_provisorias'];?>" data-parent="#faq<?php echo (int)$recepcion['idrecepciones_provisorias'];?>">
                            <div class="card-body"><?php echo textarea($recepcion['observaciones']); ?>
                            </div></div></div></div></td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                  <tr>
                    <th></th>
                    <th class="text-center">  </th>
                    <th class="text-center"> Fecha de pedido </th>
                    <th class="text-center"> Expediente </th>
                    <th> Obra </th>
                    <th> Expediente obra</th>
                    <!--<th class="text-center"> Inicio del Tramite </th>
                    <th class="text-center"> Seguimiento del Tramite </th>-->
                    <th> Documentacion</th>
                    <th> Comision</th>
                    <th> Movilidad</th>
                    <th> Acta/Informe </th>
                    <th> Observacion </th>    
                  </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
          </div>    
        </div>
      </div>
    </div>
    <div id="editar_rp"></div>
    <div id="movimientos_recepciones"></div>
    <script type="text/javascript" src="includes/ajax/scripts/recepciones-provisorias.js"></script>
    <?php 
    require_once('../forms/agregar_rp.php');
    pie(); ?>