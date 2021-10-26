<?php
require_once('../load.php');

$user = current_user();
// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


$columns = array( 
// datatable column index  => database column name
    0 => 'select',
    1 => 'acciones',
    2 => 'nombre',
    3 => 'email',
    4 => 'telefono',
    5 => 'cargo',
    6 => 'empresa'
);
//CONSTRUCCIONES
    $sql  =" SELECT *";
    $sql  .=" FROM empresas_contactos";
    $sql  .=" ORDER BY idcontactos DESC";


$query= $db->query($sql);
$totalData = $db->num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

$data = array();
while( $row=$db->fetch_array($query) ) {  // preparing an array

    $nestedData=array(); 

    $nestedData[] = '';
 if(permiso('admin') || permiso('agenda')){ 
    $nestedData[] = '<a class="i-dt-list" onclick="editar_contacto_empresa('.$row['idcontactos'].')" data-toggle="tooltip" title="Editar datos"><i class="mdi mdi-pencil"></i></a>';
}
    $nestedData[] = $row["apellido"].', '.$row["nombre"];
    $nestedData[] = $row["email"];
    $nestedData[] = $row["telefono"];
    $nestedData[] = find_select('nombre','empresas','idempresas',$row["idempresas"]);
    $nestedData[] = $row["cargo"];

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