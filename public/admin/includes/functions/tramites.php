<?php
require_once('../../includes/load.php');
$user = current_user();
$fecha_pase = make_dmy();
$registro_fecha = make_date();

if(isset($_POST['add_expedientes'])){
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
  $busqueda= verif_expediente($_POST['numero']);
  $obra  = clean($db->escape($_POST['obra']));

  if($busqueda['expediente'] == $_POST['numero']){
    $session->msg('d','El expediente Nº '.$_POST['numero'].' ya existe.');
    redirect('tramites', false);
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

    if($obra != '0'){
    $insert_obra = "INSERT INTO tramites_obras (
      idtramites, 
      idobras
    ) VALUES (
    '$ultimo_id', 
    '$obra'); 
    ";
    $db->query($insert_obra);
    }
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
    logs($user['id'],"expediente",$ultimo_id,"Cargo nuevo tramite N ".$numero." de tipo Expediente");
    $session->msg('s',"Agregado exitosamente. ");
	redirect('tramites');
  } else {
    $session->msg('d',' Lo siento, registro falló.');
	redirect('tramites');
  }}
}
}

if(isset($_POST['add_notas'])){
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
  $obra  = clean($db->escape($_POST['obra']));
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
      if($obra != '0'){
        $insert_obra = "INSERT INTO tramites_obras (
          idtramites, 
          idobras
        ) VALUES (
        '$ultimo_id', 
        '$obra'); 
        ";
        $db->query($insert_obra);
        }
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
    logs($user['id'],"nota",$ultimo_id,"Cargo nuevo tramite tipo Presentacion / Nota");
    $session->msg('s',"Agregado exitosamente");
	redirect('tramites');
  } else {
    $session->msg('d',' Lo siento, registro falló.');
	redirect('tramites');
  }
}
}

if(isset($_POST['editar_expediente'])){
  $id = clean($db->escape($_POST['editar_expediente']));
  $asunto  = clean($db->escape($_POST['asunto']));
  $numero  = clean($db->escape($_POST['numero']));
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
  $obra  = $_POST['obra'];
  $registro_fecha    = make_date();
  $query  = "UPDATE tramites SET 
  asunto = '$asunto', 
  numero ='$numero', 
  iniciador='$iniciador', 
  fecha_inicio='$fecha_inicio', 
  observaciones='$observaciones', 
  prioridad='$prioridad', 
  condicion='$condicion', 
  registro_usuario='$registro_usuario', 
  registro_fecha='$registro_fecha' 
  WHERE 
  idtramites='$id';
  ";

if(isset($_POST['obra'])){
  $db->query('DELETE FROM tramites_obras WHERE idtramites='.$id);
  $cantidad_obras = count($_POST['obra']);
  $i=0;
  $insert_obras = '';
   foreach ($_POST as $indice=>$cadena) { 
   while($i<$cantidad_obras){  
   $insert_obras .= $db->query("INSERT INTO tramites_obras (idtramites, idobras) VALUES ('".$id."', '".$_POST['obra'][$i]."'); ");
   $i++; 
  }
  }
$insert_obras .= '';
  }
if(isset($_POST['etiquetas'])){
  $db->query('DELETE FROM tramites_etiquetas_relacion WHERE idtramites='.$id);
    $cantidad_etiquetas = count($_POST['etiquetas']);
    $i=0;
    $insert_etiquetas = '';
     foreach ($_POST as $indice=>$cadena) { 
     while($i<$cantidad_etiquetas){  
     $insert_etiquetas .= $db->query("INSERT INTO tramites_etiquetas_relacion (idtramites, idtramites_etiquetas) VALUES ('".$id."', '".$_POST['etiquetas'][$i]."'); ");
     $i++; 
    }
    }
 $insert_etiquetas .= '';
  }
  if($db->query($query) && $db->query($insert_etiquetas) && $db->query($insert_obras)){
logs($user['id'],"expediente",$id,"Edito un expediente");
    $session->msg('s',"Dato actualizado.");
	redirect('tramites');
  } else {
    $session->msg('d','Lo siento, registro falló.');
	redirect('tramites');
  }
}

if(isset($_POST['editar_nota'])){
  $id = clean($db->escape($_POST['editar_nota']));
  $asunto  = clean($db->escape($_POST['asunto']));
  $numero  = clean($db->escape($_POST['numero']));
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
  $obra  = $_POST['obra'];
  $registro_fecha    = make_date();
  $query  = "UPDATE tramites SET 
  asunto = '$asunto', 
  numero ='$numero', 
  iniciador='$iniciador', 
  fecha_inicio='$fecha_inicio', 
  observaciones='$observaciones', 
  prioridad='$prioridad', 
  condicion='$condicion', 
  registro_usuario='$registro_usuario', 
  registro_fecha='$registro_fecha' 
  WHERE 
  idtramites='$id';
  ";
if(isset($_POST['obra'])){
  $db->query('DELETE FROM tramites_obras WHERE idtramites='.$id);
  $cantidad_obras = count($_POST['obra']);
  $i=0;
  $insert_obras = '';
   foreach ($_POST as $indice=>$cadena) { 
   while($i<$cantidad_obras){  
   $insert_obras .= $db->query("INSERT INTO tramites_obras (idtramites, idobras) VALUES ('".$id."', '".$_POST['obra'][$i]."'); ");
   $i++; 
  }
  }
$insert_obras .= '';
  }
if(isset($_POST['etiquetas'])){
  $db->query('DELETE FROM tramites_etiquetas_relacion WHERE idtramites='.$id);
    $cantidad_etiquetas = count($_POST['etiquetas']);
    $i=0;
    $insert_etiquetas = '';
     foreach ($_POST as $indice=>$cadena) { 
     while($i<$cantidad_etiquetas){  
     $insert_etiquetas .= $db->query("INSERT INTO tramites_etiquetas_relacion (idtramites, idtramites_etiquetas) VALUES ('".$id."', '".$_POST['etiquetas'][$i]."'); ");
     $i++; 
    }
    }
 $insert_etiquetas .= '';
  }
  if($db->query($query) && $db->query($insert_etiquetas) && $db->query($insert_obras)){
logs($user['id'],"expediente",$id,"Edito un expediente");
    $session->msg('s',"Dato actualizado.");
	redirect('tramites');
  } else {
    $session->msg('d','Lo siento, registro falló.');
	redirect('tramites');
  }
}


if(isset($_POST['observacion_tramite'])){
  $id = clean($db->escape($_POST['observacion_tramite']));
  $data = find_by_id('tramites','idtramites',$id);
  $expediente = clean($db->escape($_POST['numero']));
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
  /*$query2 = "INSERT INTO tramites_movimientos (
  idtramites, 
  iddireccion, 
  iddepartamentos, 
  fecha, 
  observaciones) VALUES (
  '$expediente', 
  '".$data['iddireccion']."', 
  '".$data['iddepartamentos']."', 
  '".$registro_fecha."', 
  '$observaciones');";
  */
  if($db->query($query)){

logs($user['id'],"expediente",$id,"Observo el tramite N ".$expediente." de tipo ".ucfirst($data['tipo']));
    $session->msg('s',"Dato actualizado. ");
	redirect('tramites');
  } else {
    $session->msg('d',' Lo siento, registro falló.');
	redirect('tramites');
  }
}

if(isset($_POST['pases_tramites'])){
  $id = clean($db->escape($_POST['pases_tramites']));
  $data = find_by_id('tramites','idtramites',$id);
  $fecha_pase   = clean($db->escape($_POST['fecha_pase']));
  $iddireccion  = clean($db->escape($_POST['iddireccion']));
  $iddepartamentos  = clean($db->escape($_POST['iddepartamentos']));
  $emisor = clean($db->escape($_POST['emisor']));
  $receptor = clean($db->escape($_POST['receptor']));
  $nota  = clean($db->escape($_POST['nota']));
  $folios  = clean($db->escape($_POST['folios']));
  $norma_tipo  = clean($db->escape($_POST['norma_tipo']));
  $norma_numero  = clean($db->escape($_POST['norma_numero']));
  $observaciones = clean($db->escape($_POST['observaciones']));
  $registro_usuario    = $user['id'];
  $registro_fecha    = make_date();
  $query = "INSERT INTO tramites_movimientos (
  idtramites, 
  iddireccion, 
  iddepartamentos, 
  fecha, 
  folios, 
  emisor,
  receptor,
  norma_tipo, 
  norma_numero,
  observaciones) VALUES (
  '$id', 
  '$iddireccion', 
  '$iddepartamentos', 
  '$fecha_pase', 
  '$folios', 
  '$emisor', 
  '$receptor', 
  '$norma_tipo', 
  '$norma_numero',
  '$observaciones'); 
  ";
  if($db->query($query)){
  logs($user['id'],"expediente",$id,"Realizo un pase del tramite N".$data['numero']." de tipo ".ucfirst($data['tipo']));
    $session->msg('s',"Pase realizado.");
	redirect('tramites');
  } else {
    $session->msg('d',' Lo siento, registro falló.');
	redirect('tramites');
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