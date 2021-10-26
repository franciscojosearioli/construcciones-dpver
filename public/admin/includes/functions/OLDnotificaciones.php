<?php
date_default_timezone_get();
require_once('../../includes/load.php');
$user = current_user();
$date = make_date();
$emisor = $user['id'];
  $mensaje_global = $_POST['mensaje_global'];
if (isset($_POST['new_global'])){
if(!empty($mensaje_global)){
    $query = "INSERT INTO notificaciones (";
    $query .=" mensaje,estado,autor,privado,date";
    $query .=") VALUES (";
    $query .=" '{$mensaje_global}', '0', '{$emisor}', '0', '{$date}')";
if($db->query($query)){
      $session->msg('s',"Mensaje global enviado correctamente. ");
      header('Location:' . getenv('HTTP_REFERER'));
    } else {
      $session->msg('d',' Lo siento, no se ha podido enviar el mensaje.');
      header('Location:' . getenv('HTTP_REFERER'));
    }
  } else{
    $session->msg("d", 'No se ha enviado el mensaje.');
    header('Location:' . getenv('HTTP_REFERER'));
  }
}
	$receptor = $_POST['receptor'];
  $mensaje_privado = $_POST['mensaje_privado'];
if (isset($_POST['new_privado'])){
if(!empty($mensaje_privado) && $receptor != 0){
    $query  = "INSERT INTO notificaciones (";
    $query .=" mensaje,estado,autor,receptor,privado,date";
    $query .=") VALUES (";
    $query .=" '{$mensaje_privado}', '0', '{$emisor}', '{$receptor}', '1', '{$date}')";
if($db->query($query)){
      $session->msg('s',"Mensaje privado enviado correctamente.");
      header('Location:' . getenv('HTTP_REFERER'));
    } else {
      $session->msg('d',' Lo siento, no se ha podido enviar el mensaje.');
      header('Location:' . getenv('HTTP_REFERER'));
    }
  } else{
    $session->msg("d", 'No se ha enviado el mensaje.');
    header('Location:' . getenv('HTTP_REFERER'));
  }
} 
?>