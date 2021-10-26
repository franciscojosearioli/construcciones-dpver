<?php
require_once('../load.php');

$user = current_user();
// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


$columns = array( 
// datatable column index  => database column name
    0 => 'select',
    1 => 'acciones',
    2 => 'solicitud',
    3 => 'descripcion', 
    4 => 'ubicacion',
    5 => 'archivo'
);
//CONSTRUCCIONES
if($user['iddireccion'] == 1){
  if($user['iddepartamentos'] == 1 || $user['iddepartamentos'] == 2){
    $sql  =" SELECT *";
    $sql  .=" FROM relevamientos";
    $sql  .=" WHERE condicion = '1' ORDER BY registro_fecha DESC";
  }else{
    $sql  =" SELECT *";
    $sql  .=" FROM relevamientos";
    $sql  .=" WHERE iddepartamentos = ".$user['iddepartamentos']." AND condicion = '1' ORDER BY registro_fecha DESC";
  }
}
//ESTUDIOS Y PROYECTOS
if($user['iddireccion'] == 8){
  if($user['iddepartamentos'] == 50){
    $sql  =" SELECT *";
    $sql  .=" FROM relevamientos";
    $sql  .=" WHERE condicion = '1' ORDER BY registro_fecha DESC";
  }else{
    $sql  =" SELECT *";
    $sql  .=" FROM relevamientos";
    $sql  .=" WHERE iddepartamentos = ".$user['iddepartamentos']." AND condicion = '1' ORDER BY registro_fecha DESC";
  }
}
//OBRAS POR ADMINISTRACION
if($user['iddireccion'] == 21){
  if($user['iddepartamentos'] == 50){
    $sql  =" SELECT *";
    $sql  .=" FROM relevamientos";
    $sql  .=" WHERE iddepartamentos = ".$user['iddepartamentos']." AND condicion = '1' ORDER BY registro_fecha DESC";
}
}


$query= $db->query($sql);
$totalData = $db->num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

$data = array();
while( $row=$db->fetch_array($query) ) {  // preparing an array

    $nestedData=array(); 

    $nestedData[] = '<i class="far fa-circle"></i>';

    if(permiso('admin') || permiso('relevamientos')){
        $nestedData[] = '<a class="btn btn-sm btn-secondary" onclick="editar_relevamiento('.$row['idrelevamientos'].')" data-toggle="tooltip" title="Editar datos"><i class="mdi mdi-pencil"></i></a>
                      <a class="btn btn-sm btn-danger text-white" onclick="eliminar_relevamiento('.$row['idrelevamientos'].')" data-toggle="tooltip" title="Eliminar"><i class="fa fa-times"></i></a>';
    }

if(!empty($row['expediente'])){ 
    $nestedData[] = 'Expediente: '.$row['expediente'];
}elseif(!empty($row['nota'])){
 $nestedData[] = 'Nota: '.$row['nota']; 
} 

    $nestedData[] = $row["nombre"];

    $nestedData[] = $row["ubicacion"];


    $nestedData[] = '<a href="../uploads/Relevamientos/'.$row['iddepartamentos'].'/'.$row['archivo'].'" target="_blank">'.utf8_encode($row['archivo']).'</a>';

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