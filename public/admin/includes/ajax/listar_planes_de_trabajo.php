<?php
require_once('../load.php');

$user = current_user();
// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


$columns = array( 
// datatable column index  => database column name
    0 => 'select',
    1 => 'accion',
    2 => 'numero',
    3 => 'detalle',
    4 => 'obra'
);
//CONSTRUCCIONES
    $sql  =" SELECT *";
    $sql  .=" FROM planes_de_trabajo";
    $sql  .=" ORDER BY idplanes_de_trabajo DESC";


$query= $db->query($sql);
$totalData = $db->num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

$data = array();
while( $row=$db->fetch_array($query) ) {  // preparing an array

    $obra = find_by_id('obras','idobras',$row["idobras"]); 

    $nestedData=array(); 

    $nestedData[] = '';
    
    if(permiso('admin') || permiso('obras')){

         $nestedData[] = '<a class="i-dt-list" onclick="ver_plan('.$row['idplanes_de_trabajo'].')" data-toggle="tooltip" title="Ver planilla"><i class="fa fa-list-alt"></i></a><a class="i-dt-list" onclick="editar_plan('.$row['idplanes_de_trabajo'].')" data-toggle="tooltip" title="Editar datos"><i class="mdi mdi-pencil"></i></a><a class="i-dt-list" href="includes/functions/eliminar.php?id='.$row['idplanes_de_trabajo'].'&url=refresh&tipo=planilla-plandetrabajo"><i class="fa fa-times"></i></a>';     
  
                    }else{
                        
         $nestedData[] = '<a class="i-dt-list" onclick="ver_plan('.$row['idplanes_de_trabajo'].')" data-toggle="tooltip" title="Ver planilla"><i class="fa fa-list-alt"></i></a>';    
  
                    } 

    $nestedData[] = $row["numero"];

    $nestedData[] = $row["detalle"];
    $nestedData[] = '<a href="obra?id='.$obra["idobras"].'" target="_blank">'.$obra["numero"].' - '.$obra['expediente'].' - '.substr($obra['nombre'], 0, 50).'...</a>';


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