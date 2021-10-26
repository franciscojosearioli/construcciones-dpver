<?php
require_once('../../includes/load.php');
$user = current_user();

if($_GET['tipo'] == 'redeterminacion-indices'){
	$archivar = cambiar_condicion('certificados_precios',1,'idcertificados_precios',(int)$_GET['id']);
	if($archivar){
	logs($user['id'],"redeterminaciones",$_GET['id'],"Archivo un acta de redeterminacion");
		$session->msg("s","Se archivo exitosamente.");
		redirect('../../'.$_GET['url']);
	} else {
		$session->msg("d","No se pudo archivar.");
		redirect('../../'.$_GET['url']);
	}
}

if($_GET['tipo'] == 'redeterminacion-acta'){
	$archivar = cambiar_condicion('redeterminaciones',1,'idredeterminaciones_actas',(int)$_GET['id']);
	if($archivar){
	logs($user['id'],"redeterminaciones",$_GET['id'],"Archivo un acta de redeterminacion");
		$session->msg("s","Se archivo exitosamente.");
		redirect('../../'.$_GET['url']);
	} else {
		$session->msg("d","No se pudo archivar.");
		redirect('../../'.$_GET['url']);
	}
}

if($_GET['tipo'] == 'proyecto'){
	$archivar = cambiar_condicion('obras',1,'idobras',(int)$_GET['id']);
	if($archivar){
     logs($user['id'],"proyecto",$_GET['id'],"Restauro un proyecto");
		$session->msg("s","Se restauro exitosamente.");
		redirect('../../'.$_GET['url']);
	} else {
		$session->msg("d","No se pudo restaurar.");
		redirect('../../'.$_GET['url']);
	}
}
if($_GET['tipo'] == 'obra'){
	$archivar = cambiar_condicion('obras',1,'idobras',(int)$_GET['id']);
	if($archivar){
     logs($user['id'],"obra",$_GET['id'],"Restauro una obra");
		$session->msg("s","Se restauro exitosamente.");
		redirect('../../'.$_GET['url']);
	} else {
		$session->msg("d","No se pudo restaurar.");
		redirect('../../'.$_GET['url']);
	}
}

if($_GET['tipo'] == 'expediente'){
	$archivar = cambiar_condicion('expedientes',1,'idexpedientes',(int)$_GET['id']);
	if($archivar){
		logs($user['id'],"expediente",$_GET['id'],"Restauro un expediente");
		$session->msg("s","Se archivo exitosamente.");
		redirect('../../'.$_GET['url']);
	} else {
		$session->msg("d","No se pudo archivar.");
		redirect('../../'.$_GET['url']);
	}
}

if($_GET['tipo'] == 'nota'){
	$archivar = cambiar_condicion('notas',1,'idnotas',(int)$_GET['id']);
	if($archivar){
		logs($user['id'],"nota",$_GET['id'],"Restauro una nota");
		$session->msg("s","Se archivo exitosamente.");
		redirect('../../'.$_GET['url']);
	} else {
		$session->msg("d","No se pudo archivar.");
		redirect('../../'.$_GET['url']);
	}
}

if($_GET['tipo'] == 'recepcion-provisoria'){
	$archivar = cambiar_condicion('recepciones_provisorias',1,'idrecepciones_provisorias',(int)$_GET['id']);
	if($archivar){
		logs($user['id'],"recepcion-provisoria",$_GET['id'],"Restauro una recepcion provisoria");
		$session->msg("s","Se archivo exitosamente.");
		redirect('../../'.$_GET['url']);
	} else {
		$session->msg("d","No se pudo archivar.");
		redirect('../../'.$_GET['url']);
	}
}

if($_GET['tipo'] == 'recepcion-definitiva'){
	$archivar = cambiar_condicion('recepciones_definitivas',1,'idrecepciones_definitivas',(int)$_GET['id']);
	if($archivar){
		logs($user['id'],"recepcion-definitiva",$_GET['id'],"Restauro una recepcion definitiva");
		$session->msg("s","Se archivo exitosamente.");
		redirect('../../'.$_GET['url']);
	} else {
		$session->msg("d","No se pudo archivar.");
		redirect('../../'.$_GET['url']);
	}
}

if($_GET['tipo'] == 'rol'){
	$archivar = cambiar_condicion('roles',1,'idroles',(int)$_GET['id']);
	if($archivar){
		logs($user['id'],"rol",$_GET['id'],"Restauro un rol de usuario");
		$session->msg("s","Se archivo exitosamente.");
		redirect('../../'.$_GET['url']);
	} else {
		$session->msg("d","No se pudo archivar.");
		redirect('../../'.$_GET['url']);
	}
}

if($_GET['tipo'] == 'direccion'){
	$archivar = cambiar_condicion('direcciones',1,'iddireccion',(int)$_GET['id']);
	if($archivar){
     logs($user['id'],"direccion",$_GET['id'],"Restauro una direccion");
		$session->msg("s","Se archivo exitosamente.");
		redirect('../../'.$_GET['url']);
	} else {
		$session->msg("d","No se pudo archivar.");
		redirect('../../'.$_GET['url']);
	}
}

if($_GET['tipo'] == 'notificacion'){
	$archivar = cambiar_condicion('notificaciones',1,'idnotificacion',(int)$_GET['id']);
	if($archivar){
     logs($user['id'],"notificacion",$_GET['id'],"Activo una notificacion");
		$session->msg("s","Se activo exitosamente.");
		redirect('../../'.$_GET['url']);
	} else {
		$session->msg("d","No se pudo activar.");
		redirect('../../'.$_GET['url']);
	}
}

?>

