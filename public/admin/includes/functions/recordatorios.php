<?php 
require_once('../../includes/load.php');
$user = current_user();

if(isset($_POST['agregar_recordatorios'])){
    $descripcion   = clean($db->escape($_POST['descripcion']));
    $fecha = make_date();
    $query = "INSERT INTO recordatorios (idusuarios,descripcion,fecha,condicion) VALUES ('".$user['id']."', '{$descripcion}', '{$fecha}', 0); ";
      if($db->query($query)){
        redirect('recordatorios', false);
      } else {
        redirect('recordatorios', false);
      }

  }

if($_GET['tipo'] == 'listo'){
	$archivar = cambiar_condicion('recordatorios',1,'idrecordatorios',(int)$_GET['id']);
	if($archivar){
		redirect('../../'.$_GET['url']);
	} else {
		redirect('../../'.$_GET['url']);
	}
}

if($_GET['tipo'] == 'nolisto'){
	$archivar = cambiar_condicion('recordatorios',0,'idrecordatorios',(int)$_GET['id']);
	if($archivar){
		redirect('../../'.$_GET['url']);
	} else {
		redirect('../../'.$_GET['url']);
	}
}

?>