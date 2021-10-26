<?php
require_once('../load.php');

$user = current_user();
// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


$columns = array( 
// datatable column index  => database column name
    0 => 'select',
    1 => 'action',
    2 => 'titulo',
    3 => 'obra'
);
//CONSTRUCCIONES
    $sql  =" SELECT *";
    $sql  .=" FROM redeterminaciones WHERE condicion=1";
    $sql  .=" ORDER BY idredeterminaciones_actas DESC";


$query= $db->query($sql);
$totalData = $db->num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

$data = array();
while( $row=$db->fetch_array($query) ) {  // preparing an array

    $nestedData=array(); 

    $nestedData[] = '';
    if($row['condicion'] == 1 ){
         $nestedData[] = '<a class="i-dt-list" href="includes/functions/archivar.php?id='.$row['idredeterminaciones_actas'].'&url=redeterminaciones-actas&tipo=redeterminacion-acta" title="Eliminar"><i class="mdi mdi-close"></i></a>';    
     }else{
    $nestedData[] = '<a class="i-dt-list" onclick="editar_precios('.$row['idredeterminaciones_actas'].')" data-toggle="tooltip" title="Editar datos"><i class="mdi mdi-pencil"></i></a><a class="i-dt-list" href="includes/functions/restaurar.php?id='.$row['idredeterminaciones_actas'].'&url=redeterminaciones-actas&tipo=redeterminacion-acta" title="Eliminar"><i class="mdi mdi-close"></i></a>';    
}
    $nestedData[] = $row["titulo"];
        $nestedData[] = $row["importe"];

$obra = find_by_id('obras','idobras',$row['idobras']);
if(!empty($obra['alias'])){
$nestedData[] = '('.$obra['numero'].') '.$obra['alias'];
}else{
$nestedData[] = '('.$obra['numero'].') '.$obra['nombre'];
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