<?php
include_once("includes/load.php");
$username = $_POST['username'];
$password = $_POST['password'];
$recordar = $_POST['remember'];

$dpto = buscar_dpto($username, $password);
$user_id = authenticate($username, $password);
  
if($user_id){
if ($recordar == 1) {
    $session->login_remember($user_id);
   } else {
    $session->login($user_id);
   }
    $user = current_user();
    updateLastLogIn($user_id);
    logs($user['id'],'usuario',$user['id'],'Inició su sesion');
    redirect('index.php',false);
  } else {
    $session->msg("d", "Nombre de usuario y/o contraseña incorrecto.");
    redirect('index.php',false);
  }
?>