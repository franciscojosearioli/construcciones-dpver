<?php
require_once('../../includes/load.php');
$user = current_user();

if(isset($_POST['memo_llegada_tarde'])){
  $titulo  = trim($db->escape($_POST['titulo']));
  $emisor  = trim($db->escape($_POST['emisor']));
  $fecha   = clean($db->escape($_POST['fecha']));
  $agente   = clean($db->escape($_POST['agente']));
  $receptor   = clean($db->escape($_POST['receptor']));
  $iddireccion  = clean($db->escape($_POST['iddireccion']));
  $iddepartamentos  = clean($db->escape($_POST['iddepartamentos']));
  $registro_usuario    = $user['id'];
  $registro_fecha    = make_date();
  $query  = "INSERT INTO memorandums (
  titulo,
  emisor,
  fecha,
  receptor,
  tipo,
  registro_usuario,
  registro_fecha
  ) VALUES ( 
  '$titulo', 
  '$emisor', 
  '$fecha',
  '$receptor',
  '1',
  '$registro_usuario', 
  '$registro_fecha'
  ); "; 
  if($db->query($query)){
    $ultimo_id = $db->insert_id(); 
    $db->query("INSERT INTO memorandums_agentes (
      idmemorandums,
      agente
      ) VALUES ( 
      '$ultimo_id', 
      '$agente'
      ); "); 
    logs($user['id'],"memorandums",$ultimo_id,"Creo documento memorandum de llegada tarde");
    $session->msg('s',"Agregado exitosamente");
	redirect('memorandums');
  } else {
    $session->msg('d',' Lo siento, registro falló.');
	redirect('memorandums');
  }
}

if(isset($_POST['memo_comision'])){
  $titulo  = trim($db->escape($_POST['titulo']));
  $emisor  = trim($db->escape($_POST['emisor']));
  $fecha_inicio   = clean($db->escape($_POST['fecha_inicio']));
  $dias   = clean($db->escape($_POST['dias']));
  $fecha   = clean($db->escape($_POST['fecha']));
  $agente   = clean($db->escape($_POST['agente']));
  $receptor   = clean($db->escape($_POST['receptor']));
  $iddireccion  = clean($db->escape($_POST['iddireccion']));
  $iddepartamentos  = clean($db->escape($_POST['iddepartamentos']));
  $registro_usuario    = $user['id'];
  $registro_fecha    = make_date();
  $query  = "INSERT INTO memorandums (
  titulo,
  emisor,
  fecha,
  fecha_inicio,
  dias,
  receptor,
  tipo,
  registro_usuario,
  registro_fecha
  ) VALUES ( 
  '$titulo', 
  '$emisor', 
  '$fecha',
  '$fecha_inicio',
  '$dias',
  '$receptor',
  '2',
  '$registro_usuario', 
  '$registro_fecha'
  ); "; 
  if($db->query($query)){
    $ultimo_id = $db->insert_id(); 
    if(isset($_POST['agente'])){
      $cantidad_agente = count($_POST['agente']);
      $i=0;
      $insert_agente = '';
       foreach ($_POST as $indice=>$cadena) { 
       while($i<$cantidad_agente){  
       $insert_agente .= $db->query("INSERT INTO memorandums_agentes (idmemorandums, agente) VALUES ('".$ultimo_id."', '".$_POST['agente'][$i]."'); ");
       $i++; 
      }
      }
   $insert_agente .= '';
    }
    if($db->query($insert_agente)){
    logs($user['id'],"memorandums",$ultimo_id,"Creo documento memorandum de comision de servicio");
    $session->msg('s',"Agregado exitosamente");
	redirect('memorandums');
}else {
  $session->msg('d',' Lo siento, registro falló.');
redirect('memorandums');
}
  } else {
    $session->msg('d',' Lo siento, registro falló.');
	redirect('memorandums');
  }
}

if(isset($_POST['memo_egreso'])){
  $titulo  = trim($db->escape($_POST['titulo']));
  $emisor  = trim($db->escape($_POST['emisor']));
  $fecha   = clean($db->escape($_POST['fecha']));
  $fecha_fin   = clean($db->escape($_POST['fecha_fin']));
  $agente   = clean($db->escape($_POST['agente']));
  $receptor   = clean($db->escape($_POST['receptor']));
  $iddireccion  = clean($db->escape($_POST['iddireccion']));
  $iddepartamentos  = clean($db->escape($_POST['iddepartamentos']));
  $registro_usuario    = $user['id'];
  $registro_fecha    = make_date();
  $query  = "INSERT INTO memorandums (
  titulo,
  emisor,
  fecha,
  fecha_fin,
  receptor,
  tipo,
  registro_usuario,
  registro_fecha
  ) VALUES ( 
  '$titulo', 
  '$emisor', 
  '$fecha',
  '$fecha_fin',
  '$receptor',
  '3',
  '$registro_usuario', 
  '$registro_fecha'
  ); "; 
  if($db->query($query)){
    $ultimo_id = $db->insert_id(); 
    $db->query("INSERT INTO memorandums_agentes (
      idmemorandums,
      agente
      ) VALUES ( 
      '$ultimo_id', 
      '$agente'
      ); "); 
    logs($user['id'],"memorandums",$ultimo_id,"Creo documento memorandum de egreso");
    $session->msg('s',"Agregado exitosamente");
	redirect('memorandums');
  } else {
    $session->msg('d',' Lo siento, registro falló.');
	redirect('memorandums');
  }
}
?>