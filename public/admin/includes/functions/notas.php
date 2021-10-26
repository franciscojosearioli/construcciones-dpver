<?php
require_once('../../includes/load.php');
$user = current_user();
$fecha_pase = make_dmy();
$registro_fecha = make_date();

if(isset($_POST['agregar_notas'])){
  $asunto  = trim($db->escape($_POST['asunto']));
  $numero  = trim($db->escape($_POST['numero']));
  $iniciador  = trim($db->escape($_POST['iniciador']));
  $fecha_inicio   = clean($db->escape($_POST['fecha_inicio']));
  $fecha_pase   = clean($db->escape($_POST['fecha_pase']));
  $iddireccion  = clean($db->escape($_POST['iddireccion']));
  $iddepartamentos  = clean($db->escape($_POST['iddepartamentos']));
  $fecha_pase   = clean($db->escape($_POST['fecha_pase']));
  $emisor = user_name($user['id']);
  $receptor = clean($db->escape($_POST['receptor']));
  $observaciones = clean($db->escape($_POST['observaciones']));
  $prioridad   = clean($db->escape($_POST['prioridad']));
  $condicion  = clean($db->escape($_POST['condicion']));
  $nota  = clean($db->escape($_POST['nota']));
  $folios  = clean($db->escape($_POST['folios']));
  $norma_tipo  = clean($db->escape($_POST['norma_tipo']));
  $etiquetas  = clean($db->escape($_POST['etiquetas']));
  $norma_numero  = clean($db->escape($_POST['norma_numero']));
  $registro_usuario    = $user['id'];
  $registro_fecha    = make_date();
  $query  = "INSERT INTO tramites (
  iddireccion, 
  iddepartamentos, 
  asunto,
  numero,
  iniciador,
  fecha_inicio,
  fecha_pase,
  emisor,
  receptor,
  observaciones,
  prioridad,
  condicion,
  registro_usuario,
  registro_fecha,
  tipo
  ) VALUES ( 
  '$iddireccion', 
  '$iddepartamentos', 
  '$asunto', 
  '$numero', 
  '$iniciador', 
  '$fecha_inicio', 
  '$fecha_pase', 
  '".$user['nombre']." ".$user['apellido']."', 
  '$receptor', 
  '$observaciones', 
  '$prioridad', 
  '$condicion', 
  '$registro_usuario', 
  '$registro_fecha','presentacion'
  ); "; 

  if($db->query($query)){
  $ultimo_id = $db->insert_id(); 
  $insert_movimientos = "INSERT INTO tramites_movimientos (
    idtramites, 
    iddireccion, 
    iddepartamentos, 
    fecha, 
    observaciones, 
    folios, 
    norma_tipo, 
    norma_numero
  ) VALUES (
  '$ultimo_id', 
  '$iddireccion', 
  '$iddepartamentos', 
  '$fecha_pase', 
  '$observaciones', 
  '$folios', 
  '$norma_tipo', 
  '$norma_numero'); 
  ";        
  if(isset($_POST['etiquetas'])){
          $cantidad_etiquetas = count($_POST['etiquetas']);
          $i=0;
          $insert_etiquetas = '';
           foreach ($_POST as $indice=>$cadena) { 
           while($i<$cantidad_etiquetas){  
           $insert_etiquetas .= $db->query("INSERT INTO tramites_etiquetas_relacion (idtramites, idtramites_etiquetas) VALUES ('".$ultimo_id."', '".$_POST['etiquetas'][$i]."'); ");
           $i++; 
          }
          }
       $insert_etiquetas .= '';
        }

    if($db->query($insert_movimientos) && $db->query($insert_etiquetas)){
  if($db->query($insert_movimientos)){
    logs($user['id'],"nota",$ultimo_id,"Cargo nuevo tramite tipo Presentacion / Nota");
    $session->msg('s',"Agregado exitosamente");
	redirect('notas');
  } else {
    $session->msg('d',' Lo siento, registro falló.');
	redirect('notas');
  }
}
}

if(isset($_POST['editar_nota'])){
  $id = clean($db->escape($_POST['editar_nota']));
  $asunto  = clean($db->escape($_POST['asunto']));
  $referencia  = clean($db->escape($_POST['referencia']));
  $iniciador  = clean($db->escape($_POST['iniciador']));
  $fecha_inicio   = clean($db->escape($_POST['fecha_inicio']));
  $fecha_pase   = clean($db->escape($_POST['fecha_pase']));
  $iddireccion  = clean($db->escape($_POST['iddireccion']));
  $iddepartamentos  = clean($db->escape($_POST['iddepartamentos']));
  $fecha_pase   = clean($db->escape($_POST['fecha_pase']));
  $emisor = $user['nombre'].' '.$user['apellido'];
  $receptor = clean($db->escape($_POST['receptor']));
  $observaciones = clean($db->escape($_POST['observaciones']));
  $prioridad   = clean($db->escape($_POST['prioridad']));
  $condicion  = clean($db->escape($_POST['condicion']));
  $registro_usuario    = $user['id'];
  $registro_fecha    = make_date();
  $query  = "
  UPDATE notas SET 
  iddireccion='$iddireccion', 
  iddepartamentos='$iddepartamentos', 
  asunto = '$asunto', 
  referencia ='$referencia', 
  iniciador='$iniciador', 
  fecha_inicio='$fecha_inicio', 
  fecha_pase='$fecha_pase', 
  emisor='".$user['nombre']." ".$user['apellido']."', 
  receptor='$receptor', 
  observaciones='$observaciones', 
  prioridad='$prioridad', 
  condicion='$condicion', 
  registro_usuario='$registro_usuario', 
  registro_fecha='$registro_fecha' 
  WHERE 
  idnotas='$id'; 
  ";
  if($db->query($query)){
  logs($user['id'],"nota",$id,"Edito una nota");
    $session->msg('s',"Dato actualizado.");
	redirect('notas');
  } else {
    $session->msg('d','Lo siento, registro falló.');
	redirect('notas');
  }
}

if(isset($_POST['observacion_nota'])){
  $id = clean($db->escape($_POST['observacion_nota']));
  $observaciones = clean($db->escape($_POST['observaciones']));
  $registro_usuario    = $user['id'];
  $registro_fecha    = make_date();
  $query  = "UPDATE tramites SET 
  observaciones='$observaciones', 
  registro_usuario='$registro_usuario', 
  registro_fecha='$registro_fecha' 
  WHERE 
  idtramites='$id';
  ";
  if($db->query($query)){
  logs($user['id'],"nota",$id,"Observo una nota");
    $session->msg('s',"Dato actualizado. ");
  redirect('notas');
  } else {
    $session->msg('d',' Lo siento, registro falló.');
  redirect('notas');
  }
}

if(isset($_POST['pases_nota'])){
  $id = clean($db->escape($_POST['pases_nota']));
  $fecha_pase   = clean($db->escape($_POST['fecha_pase']));
  $iddireccion  = clean($db->escape($_POST['iddireccion']));
  $iddepartamentos  = clean($db->escape($_POST['iddepartamentos']));
  $emisor = $user['nombre'].' '.$user['apellido'];
  $receptor = clean($db->escape($_POST['receptor']));
  $nota  = clean($db->escape($_POST['nota']));
  $registro_usuario    = $user['id'];
  $registro_fecha    = make_date();
  $query  = "UPDATE notas SET 
  iddireccion='$iddireccion', 
  iddepartamentos='$iddepartamentos', 
  fecha_pase='$fecha_pase', 
  emisor='".$user['nombre']." ".$user['apellido']."', 
  receptor='$receptor', 
  registro_usuario='$registro_usuario', 
  registro_fecha='$registro_fecha' 
  WHERE 
  idnotas='$id';
  ";
  if($db->query($query)){
logs($user['id'],"nota",$id,"Realizo un pase de nota");
    $session->msg('s',"Pase realizado.");
  redirect('notas');
  } else {
    $session->msg('d',' Lo siento, registro falló.');
  redirect('notas');
  }
}

if($_GET['tipo'] == 'sacar-nota'){
	$archivar = sacar_direccion('notas',10,'idnotas',(int)$_GET['id'],$fecha_pase,$user['id'],$registro_fecha);
	if($archivar){
logs($user['id'],"nota",$_GET['id'],"Saco una nota de la direccion");
		$session->msg("s","Se saco de la direccion.");
		redirect('../../'.$_GET['url']);
	} else {
		$session->msg("d","No se pudo sacar.");
		redirect('../../'.$_GET['url']);
	}
}

if(isset($_POST['eliminar_nota'])){
    $id = clean($db->escape($_POST['eliminar_nota']));
    $query = "DELETE FROM notas 
        WHERE idnotas = '{$id}';
        ";
      if($db->query($query)){
logs($user['id'],"nota",$id,"Elimino una nota");
        $session->msg('s'," Se ha eliminado una nota.");
        redirect('notas', false);
      } else {
        $session->msg('d',' No se pudo eliminar la nota.');
        redirect('notas', false);
      }

  }

?>