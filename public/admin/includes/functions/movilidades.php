<?php 
require_once('../../includes/load.php');
$user = current_user();

if(isset($_POST['agregar_equipo'])){
    $nombre  = $db->escape($_POST['nombre']);
    $patente  = $db->escape($_POST['patente']);
    $estado  = $db->escape($_POST['estado']);
    $iddireccion  = $db->escape($_POST['iddireccion']);
    $iddepartamentos  = $db->escape($_POST['iddepartamentos']);
if($user['idroles'] == 1){
  if(!empty($iddireccion)){
    $query  = "INSERT INTO equipos (iddireccion,iddepartamentos,nombre,patente,condicion) VALUES (";
    $query .=" '$iddireccion', '$iddepartamentos', '$nombre', '$patente', '$estado'";
    $query .=")";
  }else{
      $session->msg('d',' Debe seleccionar una direccion.');
      redirect('equipos-registrados', false);
  }
  }else{
    $query  = "INSERT INTO equipos (iddireccion,iddepartamentos,nombre,patente,condicion) VALUES (";
    $query .=" '".$user['iddireccion']."', '".$user['iddepartamentos']."', '$nombre', '$patente', '$estado'";
    $query .=")";
  }
    if($db->query($query)){
      $ultimo_id = $db->insert_id(); 
    logs($user['id'],"equipo",$ultimo_id,"Agrego un equipo");
      $session->msg('s',"Agregado exitosamente. ");
      redirect('equipos-registrados', false);
    } else {
      $session->msg('d',' Lo siento, registro falló.');
      redirect('equipos-registrados', false);
    }
}

if(isset($_POST['editar_equipo'])){
    $nombre  = $db->escape($_POST['nombre']);
    $patente  = $db->escape($_POST['patente']);
    $estado  = $db->escape($_POST['estado']);
    $iddireccion  = $db->escape($_POST['iddireccion']);
    $iddepartamentos  = $db->escape($_POST['iddepartamentos']);
    $get_id = $db->escape($_POST['editar_equipo']);
if($user['idroles'] == 1){
  if(!empty($iddireccion)){
  $query  = "UPDATE equipos SET iddireccion = '".$iddireccion."', iddepartamentos = '".$iddepartamentos."', nombre = '".$nombre."', patente = '".$patente."' , condicion = '".$estado."' WHERE idequipos='$get_id'; ";
  }else{
      $session->msg('d',' Debe seleccionar un direccion.');
      redirect('equipos-registrados', false);
  }
  }else{
    $query  = "UPDATE equipos SET nombre = '".$nombre."', patente = '".$patente."' , condicion = '".$estado."' WHERE idequipos='$get_id'; ";
  }
  if($db->query($query)){
  logs($user['id'],"equipo",$get_id,"Edito un equipo");
    $session->msg('s',"Se ha editado el registro. ");
      redirect('equipos-registrados', false);
  } else {
    $session->msg('d',' Lo siento, registro falló.');
      redirect('equipos-registrados', false);
  }
}



if(isset($_POST['add_tarea'])){
    $equipo  = $db->escape($_POST['equipo']);
    $tarea  = $db->escape($_POST['tarea']);
    $ultimo_fecha  = $db->escape($_POST['ultimo_fecha']);
    $ultimo_km  = $db->escape($_POST['ultimo_km']);
    $proximo_fecha  = $db->escape($_POST['proximo_fecha']);
    $proximo_km  = $db->escape($_POST['proximo_km']);
    $registro_fecha    = make_date();
    $query  = "INSERT INTO tareas_mantenimientos (idequipos,descripcion,ultimo_fecha,ultimo_km,proximo_fecha,proximo_km,iddepartamentos,condicion,registro_usuario,registro_fecha) VALUES (";
    $query .=" '$equipo', '$tarea', '$ultimo_fecha', '$ultimo_km', '$proximo_fecha', '$proximo_km', '".$user['iddepartamentos']."', '1', '".$user['id']."', '{$registro_fecha}'";
    $query .=")";
    $user_activity = registro($user['id'],"Registro una tarea de mantenimiento de equipos");
    if($db->query($query)){
      $session->msg('s',"Agregado exitosamente. ");
      redirect('equipos-mantenimientos', false);
    } else {
      $session->msg('d',' Lo siento, registro falló.');
      redirect('equipos-mantenimientos', false);
    }
}

 ?>