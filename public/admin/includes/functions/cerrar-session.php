<?php
  include_once("../../includes/load.php");
session_destroy();
  $user = current_user();
  logs($user['id'],'usuario',$user['id'],'Cerró su sesion');
  if(!$session->logout()) {
    $session->msg('d', 'Cerró su sesion.');
  	redirect("../../../logout");
  }
?>
