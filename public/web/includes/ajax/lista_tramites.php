<?php
require_once('../load.php');

$user = current_user();
// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;
 
 
$columns = array( 
// datatable column index  => database column name
    0 => 'select',
    1 => 'acciones',
    2 => 'tipo',
    3 => 'numero', 
    4 => 'asunto',
    5 => 'ingreso',
    6 => 'movimientos',
    7 => 'etiquetas',
    8 => 'observacion'
);
 
 if(permiso('admin') || permiso('expedientes')){
$sql = "SELECT * FROM tramites order by registro_fecha desc";
}else{
    $sql = "SELECT * FROM tramites WHERE iddepartamentos = '".$user['iddepartamentos']."' order by registro_fecha desc";
}
$query= $db->query($sql);
$totalData = $db->num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

$data = array();
while( $row=$db->fetch_array($query) ) {  // preparing an array
    $nestedData=array(); 
    
    $nestedData[] = '';


    if($row['tipo'] == 'expediente'){
if(permiso('admin') || permiso('tramites')){
     $nestedData[] = '<a class="i-dt-list" href="tramite?id='.$row['numero'].'" data-toggle="tooltip" title="Ver tramite"><i class="fa fa-info-circle"></i></a>
     <a class="i-dt-list" onclick="editar_expediente('.$row['idtramites'].')" data-toggle="tooltip" title="Editar datos"><i class="fa fa-edit"></i></a>
<a class="i-dt-list hide" onclick="editar_expediente('.$row['idtramites'].')" data-toggle="tooltip" title="Editar datos"><i class="fa fa-edit"></i></a>
     <a class="i-dt-list" onclick="movimientos_tramite('.$row['idtramites'].')" data-toggle="tooltip" title="Movimientos"><i class="fa fa-list-alt"></i></a>
<a class="i-dt-list" onclick="observar_tramite('.$row['idtramites'].')" data-toggle="tooltip" title="Observar"><i class="fa fa-comment-alt"></i></a>
<a class="i-dt-list" onclick="pases_tramite('.$row['idtramites'].')" data-toggle="tooltip" title="Realizar pase"><i class="fa fa-external-link-alt"></i></a>
     ';
 }else{
    $nestedData[] = '<a class="i-dt-list" onclick="movimientos_tramite('.$row['idtramites'].')" data-toggle="tooltip" title="Movimientos"><i class="fa fa-list-alt"></i></a>';
}
}elseif($row['tipo'] == 'presentacion'){
    if(permiso('admin') || permiso('tramites')){
         $nestedData[] = '<a class="i-dt-list" href="tramite?id='.$row['numero'].'" data-toggle="tooltip" title="Ver tramite"><i class="fa fa-info-circle"></i></a>
         <a class="i-dt-list" onclick="editar_nota('.$row['idtramites'].')" data-toggle="tooltip" title="Editar datos"><i class="fa fa-edit"></i></a>
<a class="i-dt-list hide" onclick="editar_nota('.$row['idtramites'].')" data-toggle="tooltip" title="Editar datos"><i class="fa fa-edit"></i></a>
         <a class="i-dt-list" onclick="movimientos_tramite('.$row['idtramites'].')" data-toggle="tooltip" title="Movimientos"><i class="fa fa-list-alt"></i></a>
    <a class="i-dt-list" onclick="observar_tramite('.$row['idtramites'].')" data-toggle="tooltip" title="Observar"><i class="fa fa-comment-alt"></i></a>
    <a class="i-dt-list" onclick="pases_tramite('.$row['idtramites'].')" data-toggle="tooltip" title="Realizar pase"><i class="fa fa-external-link-alt"></i></a>
         ';
     }else{
        $nestedData[] = '    <a class="i-dt-list" onclick="movimientos_tramite('.$row['idtramites'].')" data-toggle="tooltip" title="Movimientos"><i class="fa fa-list-alt"></i></a>';
    }
    }
 
    $nestedData[] = ucfirst($row["tipo"]);

    $nestedData[] = '<center>'.$row["numero"].'</center>';
    
    $nestedData[] =  wordwrap($row['asunto'], 40, "<br>" ,false);
    $nestedData[] = $row["fecha_inicio"].' por '.$row["iniciador"];


    $ultimo_pase = ultimo_pase_tramite($row["idtramites"]);
    if(isset($ultimo_pase)){
    $nestedData[] = $ultimo_pase['fecha'];
    }else{
        $nestedData[] = $row["fecha_pase"];  
    }    
    
    


    $etiquetas = etiquetas_tramite($row["idtramites"]);
    $nombre_etiqueta = nombre_etiquetas($etiquetas);
    $nestedData[] = $nombre_etiqueta;

    $nestedData[] = $row["observaciones"];
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