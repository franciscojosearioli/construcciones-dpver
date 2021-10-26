<?php
require_once('../load.php');

$user = current_user();
$requestData= $_REQUEST;

$columns = array( 
    0 => 'select',
    1 => 'acciones',
    2 => 'fecha_pedido',
    3 => 'tramite', 
    4 => 'inicio_tramite',
    5 => 'seguimiento_tramite',
    6 => 'obra',
    7 => 'documentacion',
    8 => 'comision',
    9 => 'movilidad',
    10 => 'acta',
    11 => 'observacion'
);

$recepciones_definitivas_construcciones = recepciones_definitivas_construcciones($user['iddepartamentos']);
$conteo_recepciones_definitivas = conteo_recepciones_definitivas('recepciones_definitivas','idrecepciones_definitivas');
$query= $db->query($sql);
$totalData = $db->num_rows($query);
$totalFiltered = $totalData;  

$data = array();
while( $recepcion=$recepciones_definitivas_construcciones) {  

    $obra = find_by_name($recepcion['nombre_obras']);
    $expedientes = recepciones_expedientes($recepcion['idexpedientes']);
    $notas = recepciones_notas($recepcion['idnotas']);
    $inicio_exp = buscar_expediente($recepcion['idexpedientes']);                
    $ul_mov_exp = ul_mov_exp($recepcion['idexpedientes']);



    $nestedData=array(); 

    $nestedData[] = '';

if(!permiso('admin')){
if(!permiso('recepciones')){
$nestedData[] = '<a class="i-dt-list" onclick="movimiento_rd('.$recepcion['idrecepciones_definitivas'].')" data-toggle="tooltip" title="Movimientos"><i class="mdi mdi-view-list"></i></a>';
}

if(permiso('recepciones')){
$nestedData[] = '<a class="i-dt-list" onclick="movimiento_rd('.$recepcion['idrecepciones_definitivas'].')" data-toggle="tooltip" title="Movimientos"><i class="mdi mdi-view-list"></i></a><a class="i-dt-list" onclick="editar_rd('.$recepcion['idrecepciones_definitivas'].')" data-toggle="tooltip" title="Editar datos"><i class="mdi mdi-pencil"></i></a><a class="i-dt-list" href="includes/functions/archivar.php?id='.(int)$recepcion['idrecepciones_definitivas'].'&url=recepciones-definitivas&tipo=recepcion-definitiva" data-toggle="tooltip" title="Archivar"><i class="mdi mdi-close"></i></a>';
}
}
if(permiso('admin')){
$nestedData[] = '<a class="i-dt-list" onclick="movimiento_rd('.$recepcion['idrecepciones_definitivas'].')" data-toggle="tooltip" title="Movimientos"><i class="mdi mdi-view-list"></i></a><a class="i-dt-list" onclick="editar_rd('.$recepcion['idrecepciones_definitivas'].')" data-toggle="tooltip" title="Editar datos"><i class="mdi mdi-pencil"></i></a><a class="i-dt-list" href="includes/functions/archivar.php?id='.(int)$recepcion['idrecepciones_definitivas'].'&url=recepciones-definitivas&tipo=recepcion-definitiva" data-toggle="tooltip" title="Archivar"><i class="mdi mdi-close"></i></a>';
}

if(!empty($recepcion['idexpedientes']) && !empty($expedientes['fecha_inicio']) && $expedientes['fecha_inicio'] != '0000-00-00'){ 
                        $nestedData[] = ifdate($expedientes['fecha_inicio']);
}elseif(!empty($recepcion['idnotas']) && !empty($notas['fecha_inicio']) && $notas['fecha_inicio'] != '0000-00-00'){
                        $nestedData[] = ifdate($notas['fecha_inicio']);
}elseif($recepcion['fecha_pedido'] != '0000-00-00'){
                       $nestedData[] = ifdate($recepcion['fecha_pedido']);
} 

if(!empty($recepcion['idexpedientes'])){
                        $nestedData[] = 'Expediente Nº '.clean($recepcion['idexpedientes']);}
elseif(!empty($recepcion['idnotas'])){ 
    $nestedData[] = 'Nota Ref. '.clean($recepcion['idnotas']);
                      }
    $nestedData[] = ifdate($inicio_exp['fechareg']);
    $nestedData[] = '<b>'.ifdate($ul_mov_exp['fecha']).'</b> en <b>'.utf8_encode($ul_mov_exp['tramite']).'</b>';

if(!empty($recepcion['obra'])){ 
        $nestedData[] = $recepcion['obra']; 
}else{ 
        $nestedData[] = '<a href="./obra?id='.$obra['idobras'].'" target="_blank">'.$obra['nombre'].'</a>'; 
}

 $nestedData[] = 
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


$nestedData[] =
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

$nestedData[] =
if($recepcion['movilidad'] == 0){ echo '<span class="text-danger" data-toggle="tooltip" data-original-title="No disponible"><i class="mdi mdi-close"></i> No disponible</span><br/>';}
                            if($recepcion['movilidad'] == 1){ echo '<span class="text-success" data-toggle="tooltip" data-original-title="Disponible"><i class="mdi mdi-check"></i> Disponible';
                            if(!empty($recepcion['movilidad_fecha_observacion'])){ echo '- '.$recepcion['movilidad_observacion'].' ('.ifdate($recepcion['movilidad_observacion_fecha']).')'; }
                            echo '</span><br/>';
                          }

$nestedData[] =
if($recepcion['recibido_estado'] == NULL){ echo '<span class="text-danger" data-toggle="tooltip" data-original-title="Sin acciones"><i class="mdi mdi-close"></i> Sin acciones</span><br/>'; }
                          if($recepcion['recibido_estado'] === '0'){ echo '<span class="text-warning" data-toggle="tooltip" data-original-title="Sin recibir"><i class="mdi mdi-close"></i> Sin recibir</span><br/>'; }
                          if($recepcion['recibido_estado'] === '1'){ echo '<span class="text-success" data-toggle="tooltip" data-original-title="Recibido"><i class="mdi mdi-check"></i> Recibido</span><br/>'; }

    $nestedData[] = $recepcion['observaciones'];

    $data[] = $nestedData;

}



$json_data = array(
"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
"recordsTotal"    => intval( $totalData ),  // total number of records
"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
"data"            => $data   // total data array
);

echo json_encode($json_data);  // send data as json format

?>