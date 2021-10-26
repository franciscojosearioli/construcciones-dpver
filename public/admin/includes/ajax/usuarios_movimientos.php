<?php
require_once('../../includes/load.php');
$user = current_user(); 

if(isset($_POST['info'])){
  $info   = clean($db->escape($_POST['info']));
  $date    = make_date();
  $user = current_user(); 
      $query = "INSERT INTO logs (";
      $query .="idusuarios,tipo,dato,evento,fecha,ip";
      $query .=") VALUES (";
      $query .=" '".$user['id']."', 'usuario-movimiento', '0', '".$info."', '".$date."', '".$_SERVER['REMOTE_ADDR']."'";
      $query .=") ";
   $db->query($query);
} 
?>