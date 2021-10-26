<?php 
require_once('../load.php');
$user = current_user(); 
$estado = $_POST['estado'];
$id = $_POST['id'];

if($estado != 3){
$query = "UPDATE certificados_obras SET";
      $query .=" estado = '{$estado}', edita = 0";
      $query .=" WHERE";
      $query .=" idcertificados_obras='{$id}'";
}else{
      $query = "UPDATE certificados_obras SET";
      $query .=" edita = 1";
      $query .=" WHERE";
      $query .=" idcertificados_obras='{$id}'";
}
 $db->query($query);

 echo 'ok';
 ?>




