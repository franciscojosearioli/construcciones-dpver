<?php
require_once('../../includes/load.php');
$user = current_user(); 
$registro_fecha    = make_date();

  if(isset($_POST['add_version'])){
        $numero = clean($db->escape($_POST['numero']));
        $query  = "INSERT INTO version (";
        $query .="numero,registro_usuario,registro_fecha";
        $query .=") VALUES (";
        $query .=" '{$numero}','".$user['id']."','{$registro_fecha}'";
        $query .=")";
        if($db->query($query)){
          $ultimo_id = $db->insert_id(); 
    logs($user['id'],"version",$ultimo_id,"Agrego nueva version");
          $session->msg('s',"Nueva version");
          redirect('ajustes', false);
        } else {
          $session->msg('d','Lamentablemente no se pudo registrar la version');
          redirect('ajustes', false);
        }
 } 

 if(isset($_POST['add_cambio'])){
    $version = clean($db->escape($_POST['version']));
    $descripcion = clean($db->escape($_POST['descripcion']));
    $query  = "INSERT INTO changelog (";
    $query .="idversion,descripcion,registro_usuario,registro_fecha";
    $query .=") VALUES (";
    $query .=" '{$version}','{$descripcion}','".$user['id']."','{$registro_fecha}'";
    $query .=")";
    if($db->query($query)){
      $ultimo_id = $db->insert_id(); 
logs($user['id'],"version",$ultimo_id,"Agrego nuevo cambios en la version");
      $session->msg('s',"Nueva version");
      redirect('ajustes', false);
    } else {
      $session->msg('d','Lamentablemente no se pudo registrar los cambios');
      redirect('ajustes', false);
    }
} 


 ?>