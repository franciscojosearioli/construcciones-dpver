<?php
require_once('../load.php');

$user = current_user();
// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;
 
 
$columns = array( 
// datatable column index  => database column name
    0 => 'select',
    1 => 'prioridad',
    2 => 'prioridad',
    3 => 'referencia', 
    4 => 'asunto',
    5 => 'iniciador',
    6 => 'ubicacion',
    7 => 'envia',
    8 => 'recibe'
);
 
 
$sql = "SELECT * FROM certificados_redeterminados ORDER BY idcertificados_redeterminados ASC";
$query= $db->query($sql);
$totalData = $db->num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

$data = array();
while( $row=$db->fetch_array($query) ) {  // preparing an array
    $nestedData=array();

$obra = find_by_id('obras', 'idobras', $row['idobras']);

if($row['expediente'] != 0){ $ul_mov_exp = ul_mov_exp($row['expediente']); }

$nestedData[] = '';
$nestedData[] = $row['numero'];
$nestedData[] = $row['fecha'];
if(!empty($row['monto_provisorio'])){ 
$nestedData[] = '$ '.numero($row['monto_provisorio']);
}else{$nestedData[] = '';  }
if(!empty($row['monto_definitivo'])){ 
$nestedData[] = '$ '.numero($row['monto_definitivo']);
}else{$nestedData[] = '';}

$nestedData[] = $row['informacion'];




if(strlen($row['expediente']) > 5){ 
    $nestedData[] = $row['expediente'];
} else{
$nestedData[] = '';
}

if(strlen($row['expediente']) > 5){ 
$nestedData[] = '<span style="font-size:16px;"><b>'.ifdate($ul_mov_exp['fecha']).'</b> en <b>'.utf8_encode($ul_mov_exp['tramite']).'</b><br></span>';
} else{
$nestedData[] = '';
}

$nestedData[] = '<a href="obra?id='.$row['idobras'].'">'.$obra['nombre'].'</a>';

$nestedData[] = $obra['contratista'];

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