<?php
require_once('../../includes/load.php');
$user = current_user();
$fecha_pase = make_dmy();
$registro_fecha = make_date();

if(isset($_POST['agregar_expedientes'])){
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
  $prioridad   = $db->escape($_POST['prioridad']);
  $condicion  = clean($db->escape($_POST['condicion']));
  $nota  = clean($db->escape($_POST['nota']));
  $folios  = clean($db->escape($_POST['folios']));
  $norma_tipo  = clean($db->escape($_POST['norma_tipo']));
  $norma_numero  = clean($db->escape($_POST['norma_numero']));
  $registro_usuario    = $user['id'];
  $etiquetas  = trim($db->escape($_POST['etiquetas']));
  $registro_fecha    = make_date();
  $busqueda= verif_expediente($expediente);
  if($busqueda['expediente'] == $expediente){
    $session->msg('d','El expediente Nº '.$expediente.' ya existe.');
    redirect('expedientes', false);
  }else{
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
  registro_fecha,tipo
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
  '$registro_fecha','expediente'
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
    logs($user['id'],"expediente",$ultimo_id,"Cargo nuevo tramite tipo Expediente");
    $session->msg('s',"Agregado exitosamente. ");
	redirect('expedientes');
  } else {
    $session->msg('d',' Lo siento, registro falló.');
	redirect('expedientes');
  }}
}
}

if(isset($_POST['editar_expediente'])){
  $id = clean($db->escape($_POST['editar_expediente']));
  $asunto  = clean($db->escape($_POST['asunto']));
  $expediente  = clean($db->escape($_POST['expediente']));
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
  $nota  = clean($db->escape($_POST['nota']));
  $folios  = clean($db->escape($_POST['folios']));
  $norma_tipo  = clean($db->escape($_POST['norma_tipo']));
  $norma_numero  = clean($db->escape($_POST['norma_numero']));
  $registro_usuario    = $user['id'];
  $registro_fecha    = make_date();
  if(!empty($iddireccion)){
  $query  = "UPDATE expedientes SET 
  iddireccion='$iddireccion', 
  iddepartamentos='$iddepartamentos', 
  asunto = '$asunto', 
  expediente ='$expediente', 
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
  idexpedientes='$id';
  ";
}else{
  $session->msg('d','Debe seleccionar una direccion.');
  redirect('expedientes'); 
}
  if($db->query($query) && $db->query($query2)){
logs($user['id'],"expediente",$id,"Edito un expediente");
    $session->msg('s',"Dato actualizado.");
	redirect('expedientes');
  } else {
    $session->msg('d','Lo siento, registro falló.');
	redirect('expedientes');
  }
}

if(isset($_POST['observacion_expediente'])){
  $id = clean($db->escape($_POST['observacion_expediente']));
  $data = find_by_id('expedientes','idexpedientes',$id);
  $expediente = clean($db->escape($_POST['expediente']));
  $observaciones = clean($db->escape($_POST['observaciones']));
  $registro_usuario    = $user['id'];
  $registro_fecha    = make_date();
  $query  = "UPDATE expedientes SET 
  observaciones='$observaciones', 
  registro_usuario='$registro_usuario', 
  registro_fecha='$registro_fecha' 
  WHERE 
  idexpedientes='$id';
  ";
  $query2 = "INSERT INTO expedientes_movimientos (
  idexpedientes, 
  iddireccion, 
  iddepartamentos, 
  fecha, 
  folios, 
  norma_tipo, 
  norma_numero, 
  observaciones) VALUES (
  '$expediente', 
  '".$data['iddireccion']."', 
  '".$data['iddepartamentos']."', 
  '".$registro_fecha."', 
  '-', 
  '-', 
  '-',
  '$observaciones');";
  
  if($db->query($query) && $db->query($query2)){

logs($user['id'],"expediente",$id,"Observo un expediente");
    $session->msg('s',"Dato actualizado. ");
	redirect('expedientes');
  } else {
    $session->msg('d',' Lo siento, registro falló.');
	redirect('expedientes');
  }
}

if(isset($_POST['pases_expediente'])){
  $id = clean($db->escape($_POST['pases_expediente']));
  $expediente = clean($db->escape($_POST['expediente']));
  $fecha_pase   = clean($db->escape($_POST['fecha_pase']));
  $iddireccion  = clean($db->escape($_POST['iddireccion']));
  $iddepartamentos  = clean($db->escape($_POST['iddepartamentos']));
  $emisor = $user['nombre'].' '.$user['apellido'];
  $receptor = clean($db->escape($_POST['receptor']));
  $nota  = clean($db->escape($_POST['nota']));
  $folios  = clean($db->escape($_POST['folios']));
  $norma_tipo  = clean($db->escape($_POST['norma_tipo']));
  $norma_numero  = clean($db->escape($_POST['norma_numero']));
  $registro_usuario    = $user['id'];
  $registro_fecha    = make_date();
  $query  = "UPDATE expedientes SET 
  iddireccion='$iddireccion', 
  iddepartamentos='$iddepartamentos', 
  fecha_pase='$fecha_pase', 
  emisor='".$user['nombre']." ".$user['apellido']."', 
  receptor='$receptor', 
  registro_usuario='$registro_usuario', 
  registro_fecha='$registro_fecha' 
  WHERE 
  idexpedientes='$id';
  ";
  $query2 = "INSERT INTO expedientes_movimientos (
  idexpedientes, 
  iddireccion, 
  iddepartamentos, 
  fecha, 
  folios, 
  norma_tipo, 
  norma_numero) VALUES (
  '$expediente', 
  '$iddireccion', 
  '$iddepartamentos', 
  '$fecha_pase', 
  '$folios', 
  '$norma_tipo', 
  '$norma_numero'); 
  ";
  if($db->query($query) && $db->query($query2)){
  logs($user['id'],"expediente",$id,"Realizo un pase de expediente");
    $session->msg('s',"Pase realizado.");
	redirect('expedientes');
  } else {
    $session->msg('d',' Lo siento, registro falló.');
	redirect('expedientes');
  }
}


if($_GET['tipo'] == 'sacar-expediente'){
	$archivar = sacar_direccion('expedientes',10,'idexpedientes',(int)$_GET['id'],$fecha_pase,$user['id'],$registro_fecha);
	if($archivar){
    logs($user['id'],"expediente",$_GET['id'],"Saco un expediente fuera de la direccion");
		$session->msg("s","Se saco de la direccion.");
		redirect('../../'.$_GET['url']);
	} else {
		$session->msg("d","No se pudo sacar.");
		redirect('../../'.$_GET['url']);
	}
}

if(isset($_POST['eliminar_expediente'])){
    $id = clean($db->escape($_POST['eliminar_expediente']));
    $query = "DELETE FROM expedientes 
        WHERE idexpedientes = '{$id}';
        ";
      if($db->query($query)){
        logs($user['id'],"expediente",$id,"Elimino un expediente");
        $session->msg('s'," Se ha eliminado un expediente.");
        redirect('expedientes', false);
      } else {
        $session->msg('d',' No se pudo eliminar el expediente.');
        redirect('expedientes', false);
      }

  }

?>