<?php
require_once('../load.php');

$user = current_user();
// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;
 
 
$columns = array( 
// datatable column index  => database column name
    0 => 'select',
    1 => 'acciones',
    2 => 'titulo',
    3 => 'agentes',
    4 => 'emisor',
    5 => 'receptor',
    6 => 'tipo'
);
 
$sql = "SELECT * FROM memorandums order by registro_fecha desc";

$query= $db->query($sql);
$totalData = $db->num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

$data = array();
while( $row=$db->fetch_array($query) ) {  // preparing an array
    $nestedData=array();
     
    $nestedData[] = '';


if($row['tipo'] == 1){
     $nestedData[] = '<a class="i-dt-list" href="content/prints/memo-llegada-tarde.php?id='.$row['idmemorandums'].'" target="_blank"><i class="fa fa-file-pdf"></i></a>
     <a class="i-dt-list" href="content/prints/memo-llegada-tarde-docs.php?id='.$row['idmemorandums'].'" target="_blank"><i class="fa fa-file-word"></i></a>';
    }
    if($row['tipo'] == 2){
        $nestedData[] = '<a class="i-dt-list" href="content/prints/memo-comision.php?id='.$row['idmemorandums'].'" target="_blank"><i class="fa fa-file-pdf"></i></a>
        <a class="i-dt-list" href="content/prints/memo-comision-docs.php?id='.$row['idmemorandums'].'" target="_blank"><i class="fa fa-file-word"></i></a>';
       }


     $nestedData[] = $row["titulo"];
     
$agentes = find_by_id('memorandums_agentes','idmemorandums',$row['idmemorandums']);  
if($row['tipo'] == 1){

    $nestedData[] = user_name_memo_llegada_tarde($agentes['agente']);
}
if($row['tipo'] == 2){
    $agentes_comision = obtener_user_memo($row['idmemorandums']);
    $nestedData[] = $agentes_comision['agente'];
}



  $nestedData[] = find_select('nombre','direcciones','iddireccion',$row["emisor"]);
  

  if($row['tipo'] == 1){
  $nestedData[] = format_date($row["fecha"]);
  }
  if($row['tipo'] == 2){
    $nestedData[] = format_date($row["fecha_inicio"]).' a '.format_date($row["fecha_fin"]);
}

    $nestedData[] = find_select('nombre','direcciones','iddireccion',$row["receptor"]);


    
if($row['tipo'] == 1){
    $nestedData[] = 'Llegada tarde';
}

if($row['tipo'] == 2){
    $nestedData[] = 'Comision de servicio';

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