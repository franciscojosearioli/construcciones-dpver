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
    9 => 'observaciones'
);
 
$sql = "SELECT * FROM obras_mod_planes where estado != '7' order by estado asc";

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
    <a class="i-dt-list" onclick="editar_mod_plandetrabajo('.$row['idobras_mod_planes'].')" data-toggle="tooltip" title="Editar datos"><i class="fa fa-edit"></i></a>';
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
         
        if($row['observaciones'] != NULL || !empty($row['observaciones'])){ 
        
        $nestedData[] = '<div id="main"><div class="container"><div class="accordion" id="faq"><div id="faqhead'.$row['idobras_mod_planes'].'"><a href="#"  data-toggle="collapse" data-target="#faq'.$row['idobras_mod_planes'].'" aria-expanded="true" aria-controls="faq'.$row['idobras_mod_planes'].'">Mostrar/Ocultar Observaciones</a></div><div id="faq'.$row['idobras_mod_planes'].'" class="collapse" aria-labelledby="faqhead'.$row['idobras_mod_planes'].'" data-parent="#faq'.$row['idobras_mod_planes'].'"><div class="card-body">'.textarea($row['observaciones']).'</div></div></div>';
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