<?php
require_once('../load.php');

$user = current_user();
// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;
 
 
$columns = array( 
// datatable column index  => database column name
    0 => 'select',
    1 => 'numero',
    2 => 'fecha_medicion',
    3 => 'month', 
    4 => 'year',
    5 => 'fecha_vencimiento',
    6 => 'importe',
    7 => 'expediente'
);
 
 
$sql = "SELECT * FROM certificados_obras ORDER BY registro_fecha DESC ";
$query= $db->query($sql);
$totalData = $db->num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

$data = array();
while( $row=$db->fetch_array($query) ) {  // preparing an array
    $nestedData=array();

$nestedData[] = '';
$nestedData[] = $row['numero'];
$nestedData[] = $row['fecha_medicion'];
$nestedData[] = '';
$nestedData[] = '';
$nestedData[] = $row['fecha_vencimiento'];
$nestedData[] = '';
$nestedData[] = '';


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