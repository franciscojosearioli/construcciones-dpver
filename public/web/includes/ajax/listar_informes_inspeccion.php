<?php
require_once('../load.php');

$user = current_user();
// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;
 
 
$columns = array( 
// datatable column index  => database column name
    0 => 'select',
    1 => 'numero',
    2 => 'fecha',
    3 => 'obra', 
    4 => 'informe',
    5 => 'asistencia',
    6 => 'autor'
);
 
 
$sql = "SELECT * FROM informes_inspeccion ORDER BY registro_fecha DESC ";
$query= $db->query($sql);
$totalData = $db->num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

$data = array();
while( $row=$db->fetch_array($query) ) {  // preparing an array
    $nestedData=array();

$obra = find_by_id('obras', 'idobras', $row['idobras']);    
$asistencia = find_by_id('asistencia_inspeccion', 'idobras', $row['idobras']);    

$nestedData[] = '';

$nestedData[] = $row['numero'];
$nestedData[] = $row['fecha'];
$nestedData[] = '<a href="obra?id='.$row['idobras'].'">'.$obra['expediente'].' - '.substr($obra['nombre'], 0, 25).'...</a>';
$nestedData[] = '<a href="../uploads/Obras/'.$obra['idobras'].'/Inspeccion/Informes/'.$row['numero'].'/'.$row['archivo'].'" target="_blank">'.substr($row['archivo'], 0, 25).'...</a>';
$nestedData[] = '<a href="../uploads/Obras/'.$obra['idobras'].'/Inspeccion/Asistencias/'.$asistencia['numero'].'/'.$asistencia['archivo'].'" target="_blank">'.substr($asistencia['archivo'], 0, 25).'...</a>';
$nestedData[] = format_date($row['registro_fecha']).' por '.user_name($row['registro_usuario']);

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