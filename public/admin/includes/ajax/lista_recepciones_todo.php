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
    3 => 'fpedido',
    4 => 'expediente',
    5 => 'obra',
    6 => 'doc',
    7 => 'com',
    8 => 'comint',
    9 => 'inf',
    10 => 'acta',
    11 => 'obs'
);
 
$sql = "SELECT * FROM recepciones ";

$query= $db->query($sql);
$totalData = $db->num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

$data = array();
while( $row=$db->fetch_array($query) ) {  // preparing an array
    $nestedData=array();
    $obra = find_by_id('obras','idobras',$row['idobras']);
    $expedientes = recepciones_expedientes($row['idexpedientes']);
    $notas = recepciones_notas($row['idnotas']);
    $nestedData[] = ''; 
    if(permiso('admin') || permiso('obras')){
        if(!empty($obra)){
            $nestedData[] = '<a class="i-dt-list" href="obra?id='.$obra['idobras'].'" data-toggle="tooltip" title="Ver informe"><i class="fa fa-info-circle"></i></a><a class="i-dt-list" onclick="editar_recepcion('.$row['idrecepciones'].')" data-toggle="tooltip" title="Editar datos"><i class="mdi mdi-pencil"></i></a>';
             }else{
             $nestedData[] = '<a class="i-dt-list" onclick="editar_recepcion('.$row['idrecepciones'].')" data-toggle="tooltip" title="Editar datos"><i class="mdi mdi-pencil"></i></a>';
             }
    }else{
        if(!empty($obra)){
            $nestedData[] = '<a class="i-dt-list" href="obra?id='.$obra['idobras'].'" data-toggle="tooltip" title="Ver informe"><i class="fa fa-info-circle"></i></a>';
             }else{
             $nestedData[] = '';
             }
            }


     if($row['tipo'] == 'rp'){ 
     $nestedData[] = 'Provisoria'; 
     }elseif($row['tipo'] == 'rd'){ 
     $nestedData[] = 'Definitiva'; 
     }
                if($row['fecha_pedido'] != NULL && $row['fecha_pedido'] != '0000-00-00'){
                    $nestedData[] = format_date($row['fecha_pedido']);
                }else{
       $nestedData[] = 'Sin fecha';
                }

       $nestedData[] = $row['expediente'];   
if(!empty($obra)){

        if(permiso('admin') || permiso('moderador') || permiso('obras') || permiso('recepciones')){
            if(!empty($obra['alias'])){
        $nestedData[] = $obra['expediente'].' - '.$obra['alias'];
            }else{
                $nestedData[] = $obra['expediente'].' - '.wordwrap($obra['nombre'], 40, "<br>" ,false);
            }
        }else{
            $nestedData[] = $obra['expediente'].' - '.wordwrap($obra['nombre'], 40, "<br>" ,false);

        }

    }else{
        $nestedData[] = wordwrap($row['obra_nombre'], 40, "<br>" ,false);
    }
        
        if($row['documentacion'] != 0){ $nestedData[] = 'Adjuntado'; }else{ $nestedData[] = 'Sin archivos';}
        
        if(!empty($row['comision_fecha'])){
           $nestedData[] =   $row['comision_numero'].' el '.$row['comision_fecha'];
        }else{
            $nestedData[] =   $row['comision_numero'];

        }


        $nestedData[] =  $row['agente1'].'<br>'.$row['agente2'].'<br>'.$row['agente3'].'<br>'.$row['agente4'] ;

        
        if($row['informe_archivo'] != NULL){ $nestedData[] = 'Adjuntado'; }else{ $nestedData[] = 'Sin archivos';}
        
        if(!empty($row['acta_fecha'])){
            $nestedData[] =  $row['acta_numero'].' el '.$row['acta_fecha'];
        }else{
            $nestedData[] =   $row['acta_numero'];
        }
                 
          
        if($row['observaciones'] != NULL || !empty($row['observaciones'])){ 
        
        $nestedData[] = '<div id="main"><div class="container"><div class="accordion" id="faq"><div id="faqhead'.$row['idrecepciones'].'"><a href="#"  data-toggle="collapse" data-target="#faq'.$row['idrecepciones'].'" aria-expanded="true" aria-controls="faq'.$row['idrecepciones'].'">Mostrar/Ocultar Observaciones</a></div><div id="faq'.$row['idrecepciones'].'" class="collapse" aria-labelledby="faqhead'.$row['idrecepciones'].'" data-parent="#faq'.$row['idrecepciones'].'"><div class="card-body">'.textarea($row['observaciones']).'</div></div></div>';
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