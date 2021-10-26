<?php
require_once('../load.php');

$user = current_user();
// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


$columns = array( 
// datatable column index  => database column name
    0 => 'select',
    1 => 'acciones',
    2 => 'numero',
    3 => 'nombre', 
    4 => 'descripcion',
    5 => 'ubicacion',
    6 => 'expediente',
    7 => 'proyecto_monto',
    8 => 'proyecto_plazo',
    9 => 'fecha_inicio',
    10 => 'movimiento'
);

  if($user['iddepartamentos'] == 8){  
    $sql  =" SELECT r.idrecepciones_provisorias,r.nombre_obras,r.expediente,r.obra,r.expediente_obra,r.fecha_pedido,r.integrantes,r.integrantes_resolucion_fecha,r.integrantes_resolucion_num,r.acta_resolucion,r.acta_fecha,r.observaciones,r.condicion,r.registro_usuario,r.registro_fecha ";
    $sql .= " FROM recepciones_provisorias r INNER JOIN obras o ON r.nombre_obras=o.nombre ";
    $sql  .=" WHERE o.idinspector='".$user['id']."' OR o.idinspector = '".$user['idusuarios']."'";
  }else{
    $sql = "SELECT * FROM recepciones_provisorias WHERE condicion=1";
  }

$query= $db->query($sql);
$totalData = $db->num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

$data = array();
while( $row=$db->fetch_array($query) ) {  // preparing an array

    $obra = find_by_name($row['nombre_obras']);
    $expedientes = recepciones_expedientes($row['idexpedientes']);
    $notas = recepciones_notas($row['idnotas']);

    $nestedData=array(); 

    $nestedData[] = '';

    if(permiso('observador')){
        $nestedData[] = '<a class="btn btn-sm btn-outline-info" onclick="movimiento_rp('.$row['idrecepciones_provisorias'].')" data-toggle="tooltip" title="Movimientos"><i class="mdi mdi-information-variant"></i></a>';
    }
    if(permiso('admin') || permiso('recepciones')){
        $nestedData[] = '<a class="btn btn-sm btn-outline-info" onclick="movimiento_rp('.$row['idrecepciones_provisorias'].')" data-toggle="tooltip" title="Movimientos"><i class="mdi mdi-information-variant"></i></a>
                          <a class="btn btn-sm btn-secondary" onclick="editar_rp('.$row['idrecepciones_provisorias'].')" data-toggle="tooltip" title="Editar datos"><i class="mdi mdi-pencil"></i></a>
                          <a class="btn btn-sm btn-outline-danger" href="includes/functions/archivar.php?id='.(int)$row['idrecepciones_provisorias'].'&url=recepciones-provisorias&tipo=recepcion-provisoria" data-toggle="tooltip" title="Archivar"><i class="mdi mdi-close"></i></a>';
    }

if(!empty($row['idexpedientes'])){
$nestedData[] = 'Expediente Nº '.$row['idexpedientes'];
}elseif(!empty($row['idnotas'])){ 
$nestedData[] = 'Nota Ref. '.$row['idnotas'];
}

if(!empty($row['idexpedientes']) && !empty($expedientes['fecha_inicio']) && $expedientes['fecha_inicio'] != '0000-00-00'){ 
$nestedData[] = ifdate($expedientes['fecha_inicio']);
}elseif(!empty($row['idnotas']) && !empty($notas['fecha_inicio']) && $notas['fecha_inicio'] != '0000-00-00'){
$nestedData[] = ifdate($notas['fecha_inicio']);
}elseif($row['fecha_pedido'] != '0000-00-00'){
$nestedData[] = ifdate($row['fecha_pedido']);
}

if(!empty($row['obra'])){ 
$nestedData[] = $row['obra']; 
}else{ 
$nestedData[] = '<a href="./obra?id='.$obra['idobras'].'" target="_blank">'.$obra['nombre'].'</a>'; 
} 


if(!empty($row['expediente_obra'])){ 
$nestedData[] = $row['expediente_obra']; 
}else{ 
$nestedData[] = $obra['expediente']; 
}




if($row['documentacion_planos'] == 0){ 
    $nestedData[] = '<span class="text-danger" data-toggle="tooltip" data-original-title="Sin recibir"><i class="mdi mdi-close"></i> Planos conforme a obra - Sin recibir</span><br/>';
} 
if($row['documentacion_planos'] == 1){ 
    $nestedData[] = '<span class="text-success" data-toggle="tooltip" data-original-title="Recibido"><i class="mdi mdi-check"></i> Planos conforme a obra - Recibido el '. ifdate($row['documentacion_planos_fecha']).' ('.$row['documentacion_planos_observacion'].')</span><br/>';
}

if($row['documentacion_ensayos'] == 0){ 
    $nestedData[] = '<span class="text-danger" data-toggle="tooltip" data-original-title="Sin recibir"><i class="mdi mdi-close"></i> Ensayos de laboratorio - Sin recibir</span><br/>';
} 
 if($row['documentacion_ensayos'] == 1){ 
    $nestedData[] = '<span class="text-success" data-toggle="tooltip" data-original-title="Recibido"><i class="mdi mdi-check"></i> Ensayos de laboratorio - Recibido el '.ifdate($row['documentacion_ensayos_fecha']).' ('.$row['documentacion_ensayos_observacion'].')</span><br/>';
}

if(!empty($row['documentacion_mas'])){ 
    $nestedData[] = '<span class="text-success" data-toggle="tooltip" data-original-title="Recibido"><i class="mdi mdi-check"></i> '.$row['documentacion_mas'].' - Recibido el '.ifdate($row['documentacion_mas_fecha']).' ('.$row['documentacion_mas_observacion'].')</span><br/>';
}

if(!empty($row['integrantes_resolucion_num'])){ 
    $nestedData[] = 'Resolucion Nº '.$row['integrantes_resolucion_num'].' el '.ifdate($row['integrantes_resolucion_fecha']).'<br/>';
}
if(!empty($row['comision_agente1'])){ 
    $nestedData[] = $row['comision_agente1'].' - Notificado el '.ifdate($row['comision_agente1_notificado']).'<br/>';
}
if(!empty($row['comision_agente2'])){ 
    $nestedData[] .= $row['comision_agente2'].' - Notificado el '.ifdate($row['comision_agente2_notificado']).'<br/>';
}
if(!empty($row['comision_agente3'])){
    $nestedData[] .= $row['comision_agente3'].' - Notificado el '.ifdate($row['comision_agente3_notificado']).'<br/>';
}
if($row['movilidad'] == 0){ 
    $nestedData[] = '<span class="text-danger" data-toggle="tooltip" data-original-title="No disponible"><i class="mdi mdi-close"></i> No disponible</span><br/>';
}
if($row['movilidad'] == 1){ 
    $nestedData[] = '<span class="text-success" data-toggle="tooltip" data-original-title="Disponible"><i class="mdi mdi-check"></i> Disponible - '.$row['movilidad_observacion'].' ('.ifdate($row['movilidad_observacion_fecha']).')</span><br/>';
}

if($row['recibido_estado'] == NULL){ 
    $nestedData[] = '<span class="text-danger" data-toggle="tooltip" data-original-title="Sin acciones"><i class="mdi mdi-close"></i> Sin acciones</span><br/>'; 
}
if($row['recibido_estado'] === '0'){ 
    $nestedData[] = '<span class="text-warning" data-toggle="tooltip" data-original-title="Sin recibir"><i class="mdi mdi-close"></i> Sin recibir</span><br/>'; 
}
if($row['recibido_estado'] === '1'){ 
    $nestedData[] = '<span class="text-success" data-toggle="tooltip" data-original-title="Recibido"><i class="mdi mdi-check"></i> Recibido</span><br/>'; 
}
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