<?php
require_once('../load.php');

$user = current_user();
// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;
 
 
$columns = array( 
// datatable column index  => database column name
    0 => 'select',
    1 => 'numero',
    2 => 'obra',
    3 => 'fecha_medicion',
    4 => 'month', 
    5 => 'year',
    6 => 'fecha_vencimiento',
    7 => 'importe',
    8 => 'archivo',
    9 => 'expediente',    
    10 => 'resolucion',
    11 => 'estado'
);
 
 
$sql = "SELECT * FROM certificados_obras WHERE estado=2 ORDER BY registro_fecha DESC ";
$query= $db->query($sql);
$totalData = $db->num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

$data = array();
while( $row=$db->fetch_array($query) ) {  // preparing an array
    $nestedData=array();

$nestedData[] = '';
if($row['numero'] == 0){
$nestedData[] = 'ANTICIPO';

}else{
$nestedData[] = $row['numero'];
}
$obra = find_by_id('obras','idobras',$row['idobras']);
if(!empty($obra['alias'])){
$nestedData[] = '('.$obra['numero'].' - '.$obra['expediente'].') '.$obra['alias'];
}else{
$nestedData[] = '('.$obra['numero'].' - '.$obra['expediente'].') '.substr($obra['nombre'], 0, 25);

}
if($row['fecha_medicion'] != '0000-00-00'){ $nestedData[] = format_date($row['fecha_medicion']); }else{ $nestedData[] = '';}

$nestedData[] = mes_nombre($row['month']).' '.$row['year'];
if($row['fecha_vencimiento'] != '0000-00-00'){ $nestedData[] = format_date($row['fecha_vencimiento']); }else{ $nestedData[] = '';}
if(!empty($row['importe_final'])){
    $nestedData[] = '$ '.numero($row['importe_final']);
    }elseif(!empty($row['importe'])){
        $nestedData[] = '$ '.numero($row['importe']);
    }else{
        $nestedData[] = '$ 0,00';
    }
    $nestedData[] = '<a href="../uploads/Obras/'.$obra['idobras'].'/Certificaciones/Certificados/'.$row['archivo'].'" target="_blank"><i class="fa fa-download"></i>ORIGINAL</a> <a href="../uploads/Obras/'.$obra['idobras'].'/Certificaciones/Certificados/'.$row['archivo_copia'].'" target="_blank"><i class="fa fa-download"></i>COPIA</a>';
    
if(permiso('admin') || permiso('certificaciones')){
$nestedData[] = '<center>'.$row['expediente'].' <a class="i-dt-list" onclick="change_expediente('.$row['idcertificados_obras'].')" data-toggle="tooltip" title="Editar"><i class="fas fa-edit"></i></a></center>';
}else{
$nestedData[] = '<center>'.$row['expediente'].'</center>';

}

$nestedData[] = 'N '.$row['numero_resolucion'].' el '.$row['fecha_resolucion'].' <a class="i-dt-list" onclick="change_resolucion('.$row['idcertificados_obras'].')" data-toggle="tooltip" title="Editar"><i class="fas fa-edit"></i></a></center>';


if(permiso('admin') || permiso('certificaciones')){
$nestedData[] = '<input type="text" value="'.$row['idcertificados_obras'].'" id="n_certid" hidden><select id="change_estado" onchange="cambiar_estado('.$row['idcertificados_obras'].',this.value);"><option value="0" >Confeccionado</option><option value="1">Emitido</option><option value="2" selected>Aprobado</option></select>';
}else{
$nestedData[] = '<input type="text" value="'.$row['idcertificados_obras'].'" id="n_certid" hidden><select id="change_estado" onchange="cambiar_estado('.$row['idcertificados_obras'].',this.value);" disabled><option value="0" >Confeccionado</option><option value="1">Emitido</option><option value="2" selected>Aprobado</option></select>';

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