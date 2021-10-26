<?php
require_once('../load.php');

$user = current_user();
// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;
 
 
$columns = array( 
// datatable column index  => database column name
    0 => 'select',
    1 => 'acciones',
    2 => 'numero',
    3 => 'expediente',
    4 => 'avance',
    5 => 'estado',
    6 => 'obra',
    7 => 'contratista',
    8 => 'resolucion',
    9 => 'computo',
    10 => 'precios',
    11 => 'observaciones'
);
 
$sql = "SELECT * FROM obras_modificaciones where estado != '7' order by estado asc";

$query= $db->query($sql);
$totalData = $db->num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

$data = array();
while( $row=$db->fetch_array($query) ) {  // preparing an array
    $nestedData=array();
    $obra = find_by_id('obras','idobras',$row['idobras']);  
    $nestedData[] = ''; 
   
    if(permiso('admin') || permiso('obras')){
        $nestedData[] = '<a class="i-dt-list" href="obra?id='.$row['idobras'].'" data-toggle="tooltip" title="Ver informe"><i class="fa fa-info-circle"></i></a>
        <a class="i-dt-list" onclick="editar_modificacion('.$row['idmodificaciones'].')" data-toggle="tooltip" title="Editar datos"><i class="fa fa-edit"></i></a>';    
    }else{
        $nestedData[] = '<a class="i-dt-list" href="obra?id='.$row['idobras'].'" data-toggle="tooltip" title="Ver informe"><i class="fa fa-info-circle"></i></a>';
    }
    $nestedData[] = '<center>'.$row["numero"].'</center>';
     $nestedData[] = '<center>'.$row["expediente"].'</center>';
     if(!empty($row['estado'])){ 
         $nestedData[] = '<center>'.round($row['estado']*100/7).' %</center>'; } else { $nestedData[] = '<center>0 %</center>'; }

     if($row['estado'] == 0 || $row['estado'] == NULL){ 
         $nestedData[] = 'No hay datos';
        } elseif($row['estado'] == 1){ $nestedData[] = 'Confeccion Inspeccion';
        } elseif($row['estado'] == 2){ $nestedData[] = 'Revision Dpto. II Obras por contrato';
        } elseif($row['estado'] == 3){ $nestedData[] = 'Autorizando Ing. Jefe';
        } elseif($row['estado'] == 4){ $nestedData[] = 'Encuadre Legal';
        } elseif($row['estado'] == 5){ $nestedData[] = 'Imputacion del Gasto';
        } elseif($row['estado'] == 6){ $nestedData[] = 'Confeccionando Resolucion';
        } elseif($row['estado'] == 7){ $nestedData[] = 'Resolucion aprobada';}

        if(permiso('admin') || permiso('moderador') || permiso('obras')){
            if(!empty($obra['alias'])){
        $nestedData[] = $obra['expediente'].' - '.$obra['alias'];
            }else{
                $nestedData[] = $obra['expediente'].' - '.wordwrap($obra['nombre'], 40, "<br>" ,false);
            }
        }else{
            $nestedData[] = $obra['expediente'].' - '.wordwrap($obra['nombre'], 40, "<br>" ,false);

        }
        
        $nestedData[] = $obra["contratista"];
  
        if(!empty($row['resolucion_numero']) && $row["resolucion_fecha"] != '0000-00-00' && $row["resolucion_fecha"] != NULL){ 
        $nestedData[] = ifexist(format_date($row["resolucion_fecha"])).' Resolucion Nº '.$row['resolucion_numero'];
        }else{ 
            $nestedData[] = '';
        }
        
        if($row['computo_estado'] == 0){ $nestedData[] = '<span class="text-danger" data-toggle="tooltip" data-original-title="Sin recibir"><i class="mdi mdi-close"></i> Sin recibir</span>'; if($row['computo_fecha'] != '0000-00-00'){ ' desde '.format_date($row['computo_fecha']); }} 
        if($row['computo_estado'] == 1){ $nestedData[] = '<span class="text-warning" data-toggle="tooltip" data-original-title="Recibido"><i class="mdi mdi-check"></i> Recibido</span>'; if($row['computo_fecha'] != '0000-00-00'){ ' desde '.format_date($row['computo_fecha']); }}
        if($row['computo_estado'] == 2){ $nestedData[] = '<span class="text-warning" data-toggle="tooltip" title="" style="cursor:default;" data-original-title="Empresa"><i class="mdi mdi-clock"></i> Empresa</span>'; if($row['computo_fecha'] != '0000-00-00'){ ' desde '.format_date($row['computo_fecha']); }}
        if($row['computo_estado'] == 3){ $nestedData[] = '<span class="text-success" data-toggle="tooltip" title="" style="cursor:default;" data-original-title="Aprobado"><i class="mdi mdi-check-all"></i> Aprobado</span>'; if($row['computo_fecha'] != '0000-00-00'){ ' desde '.format_date($row['computo_fecha']); }}
        
        if($row['precios_estado'] == 0){ $nestedData[] = '<span class="text-danger" data-toggle="tooltip" title="" style="cursor:default;" data-original-title="Sin recibir"><i class="mdi mdi-close"></i> Sin recibir</span>'; if($row['precios_fecha'] != '0000-00-00'){ ' desde '.format_date($modificacion['precios_fecha']); }} 
        if($row['precios_estado'] == 1){ $nestedData[] = '<span class="text-warning" data-toggle="tooltip" title="" style="cursor:default;" data-original-title="Recibido"><i class="mdi mdi-check"></i> Recibido</span>'; if($row['precios_fecha'] != '0000-00-00'){ ' desde '.format_date($modificacion['precios_fecha']); }}
        if($row['precios_estado'] == 2){ $nestedData[] = '<span class="text-warning" data-toggle="tooltip" title="" style="cursor:default;" data-original-title="Empresa"><i class="mdi mdi-clock"></i> Empresa</span>'; if($row['precios_fecha'] != '0000-00-00'){ ' desde '.format_date($modificacion['precios_fecha']); }}
        if($row['precios_estado'] == 3){ $nestedData[] = '<span class="text-success" data-toggle="tooltip" title="" style="cursor:default;" data-original-title="Aprobado"><i class="mdi mdi-check-all"></i> Aprobado</span>'; if($row['precios_fecha'] != '0000-00-00'){ ' desde '.format_date($modificacion['precios_fecha']); }}
        
        if($row['observaciones'] != NULL || !empty($row['observaciones'])){ 
        
        $nestedData[] = '<div id="main"><div class="container"><div class="accordion" id="faq"><div id="faqhead'.$row['idmodificaciones'].'"><a href="#"  data-toggle="collapse" data-target="#faq'.$row['idmodificaciones'].'" aria-expanded="true" aria-controls="faq'.$row['idmodificaciones'].'">Mostrar/Ocultar Observaciones</a></div><div id="faq'.$row['idmodificaciones'].'" class="collapse" aria-labelledby="faqhead'.$row['idmodificaciones'].'" data-parent="#faq'.$row['idmodificaciones'].'"><div class="card-body">'.textarea($row['observaciones']).'</div></div></div>';
         }else{
            $nestedData[] = '';
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