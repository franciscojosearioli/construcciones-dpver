<?php
include_once("includes/load.php");
  die;
$req_fields = array('username','password' );
validar($req_fields);
$username = clean($_POST['username']);
$password = clean($_POST['password']);
$recordar = $_POST['recordar'];
$consultas = $_POST['consultas'];
if(!$consultas){
  $dpto = buscar_dpto($username, $password);
  $user_id = authenticate($username, $password);
  if($user_id){
    logs($user['id'],"aviso",$ultimo_id,"Ingreso al sistema");
    redirect($dpto,'index.php',false);
  } else {
    $session->msg("d", "Nombre de usuario y/o contraseña incorrecto.");
    redirect('index.php',false);
  }
} else {
  redirect('index.php',false);
}
?>