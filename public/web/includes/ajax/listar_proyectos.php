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
    10 => 'movimiento',
    11 => 'tramite',
    12 => 'tramite_avance',
    13 => 'dependencia'
);


if($user['iddireccion'] == 1 || $user['iddireccion'] == 21 || $user['iddireccion'] == 11){




  if($user['iddepartamentos'] == 7){  
    $sql  =" SELECT *";
    $sql  .=" FROM obras";
    $sql  .=" WHERE estado = '1' AND bacheo='1' AND condicion = '1'";
  }elseif($user['iddepartamentos'] != 7 && $user['iddepartamentos'] != 6 && $user['iddepartamentos'] != 5 && $user['iddepartamentos'] != 1){
    $sql  =" SELECT *";
    $sql  .=" FROM obras";
    $sql  .=" WHERE estado = '1' AND idtipo='0' AND condicion = '1'";
  }elseif($user['iddepartamentos'] == 5){
    $sql  =" SELECT *";
    $sql  .=" FROM obras";
    $sql  .=" WHERE estado = '1' AND idtipo='1' AND condicion = '1'";
  }elseif($user['iddepartamentos'] == 6){
    $sql  =" SELECT *";
    $sql  .=" FROM obras";
    $sql  .=" WHERE estado = '1' AND idtipo='2' AND condicion = '1'";
  }
  elseif($user['iddepartamentos'] == 1){
    $sql  =" SELECT *";
    $sql  .=" FROM obras";
    $sql  .=" WHERE estado = '1' AND condicion = '1'";
  }
}



if($user['iddireccion'] == 8){
    if($user['iddepartamentos'] == 50){
    $sql  =" SELECT * FROM obras WHERE estado = '1' AND idtipo='3' AND condicion = '1'";
    }
}





$query= $db->query($sql);
$totalData = $db->num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

$data = array();
while( $row=$db->fetch_array($query) ) {  // preparing an array

 //   $inicio_exp = buscar_expediente($row['expediente']);                
 //   $ul_mov_exp = ul_mov_exp($row['expediente']);

    $nestedData=array(); 

    $nestedData[] = '';


$nestedData[] = '
<a class="i-dt-list" href="proyecto.php?id='.$row['idobras'].'" data-toggle="tooltip" title="Ver informe"><i class="fa fa-info-circle"></i></a>
<a class="i-dt-list" href="content/prints/proyecto.php?id='.$row['idobras'].'" target="_blank" data-toggle="tooltip" title="Informe tecnico"><i class="fa fa-file-pdf"></i></a>
<a class="i-dt-list" href="content/prints/proyecto-doc.php?id='.$row['idobras'].'" target="_blank" data-toggle="tooltip" title="Informe tecnico"><i class="fa fa-file-word"></i></a>';


    if(permiso('observador') || permiso('admin') || permiso('señalamiento')){
        $nestedData[] = $row['numero'];
    } 
    $nestedData[] = $row["nombre"];
    $nestedData[] = $row["descripcion"];
    $nestedData[] = $row["ubicacion"];
    $nestedData[] = $row["expediente"];
    $nestedData[] = $row["proyecto_monto"];
    $nestedData[] = $row["proyecto_plazo"];
   // $nestedData[] = ifdate($inicio_exp['fechareg']);
    //$nestedData[] = '<span style="font-size:16px;"><b>'.ifdate($ul_mov_exp['fecha']).'</b> en <b>'.utf8_encode($ul_mov_exp['tramite']).'</b>';

    if(!isset($row['tramite']) || $row['tramite'] == 0){ $nestedData[] = 'No establecido';} 
    if($row['tramite'] == 1){ $nestedData[] = 'Relevando y confeccionando proyecto y pliegos';}
    if($row['tramite'] == 2){ $nestedData[] = 'Autorizando proyecto';}
    if($row['tramite'] == 3){ $nestedData[] = 'Visando pliegos (Encuadre legal)';}
    if($row['tramite'] == 4){ $nestedData[] = 'Reserva preventiva';}
    if($row['tramite'] == 5){ $nestedData[] = 'Tomado conocimiento';}
    if($row['tramite'] == 6){ $nestedData[] = 'Conf. proyecto de resolución llamado / Desig. Comision de est. / Aprobado de res.';}
    if($row['tramite'] == 7){ $nestedData[] = 'Cursado de invitacion y plazo de preparacion de ofertas';}
    if($row['tramite'] == 8){ $nestedData[] = 'Apertura de ofertas y armado de expediente';}
    if($row['tramite'] == 9){ $nestedData[] = 'Desglasando la garantia de oferta';}
    if($row['tramite'] == 10){ $nestedData[] = 'Designacion comision de estudio y resolucion';}
    if($row['tramite'] == 11){ $nestedData[] = 'Aprob. Res. de designacion';}
    if($row['tramite'] == 12){ $nestedData[] = 'Comision de estudios';}
    if($row['tramite'] == 13){ $nestedData[] = 'Reserva definitiva';}
    if($row['tramite'] == 14){ $nestedData[] = 'Confeccionando proyecto de resolucion de adjudicacion y aprobacion';}
    if($row['tramite'] == 15){ $nestedData[] = 'Notificacion al adjudicatario';}
    if($row['tramite'] == 16){ $nestedData[] = 'Solicitando gtia. contractual, notif. de perdedores, devol. de gtia.';}
    if($row['tramite'] == 17){ $nestedData[] = 'Redactando contrato';}
    if($row['tramite'] == 18){ $nestedData[] = 'Sellando contrato';}
    if($row['tramite'] == 19){ $nestedData[] = 'Designando inspeccion / Confeccion acta de inicio';}
    if($row['tramite'] == 20){ $nestedData[] = 'En ejecucion';}
    $porcentaje = $row['tramite']*100/20;
    if(isset($row['tramite'])){ $nestedData[] = $porcentaje.' %'; } else { $nestedData[] = '0 %';}
if(permiso('observador') || permiso('admin')){ 
    if($row['idtipo'] == 0){ $nestedData[] = 'Obras por Contrato';} 
    if($row['idtipo'] == 1){ $nestedData[] = 'Iluminacion y Semaforizacion';} 
    if($row['idtipo'] == 2){ $nestedData[] = 'Señalamiento y Seguridad Vial';} 
}
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