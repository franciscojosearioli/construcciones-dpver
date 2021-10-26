<?php
require_once('../../includes/load.php');
$user = current_user();

if($_GET['tipo'] == 'redeterminacion-indices'){
	$archivar = cambiar_condicion('certificados_precios',0,'idcertificados_precios',(int)$_GET['id']);
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
	$archivar = cambiar_condicion('redeterminaciones',0,'idredeterminaciones_actas',(int)$_GET['id']);
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
	$archivar = cambiar_condicion('obras',0,'idobras',(int)$_GET['id']);
	if($archivar){
	logs($user['id'],"proyecto",$_GET['id'],"Archivo un proyecto");
		$session->msg("s","Se archivo exitosamente.");
		redirect('../../'.$_GET['url']);
	} else {
		$session->msg("d","No se pudo archivar.");
		redirect('../../'.$_GET['url']);
	}
}

if($_GET['tipo'] == 'obra'){
	$archivar = cambiar_condicion('obras',0,'idobras',(int)$_GET['id']);
	if($archivar){
logs($user['id'],"obra",$_GET['id'],"Archivo una obra");
		$session->msg("s","Se archivo exitosamente.");
		redirect('../../'.$_GET['url']);
	} else {
		$session->msg("d","No se pudo archivar.");
		redirect('../../'.$_GET['url']);
	}
}

if($_GET['tipo'] == 'recepcion-provisoria'){
	$archivar = cambiar_condicion('recepciones_provisorias',0,'idrecepciones_provisorias',(int)$_GET['id']);
	if($archivar){
		logs($user['id'],"recepcion-provisoria",$_GET['id'],"Archivo una recepcion provisoria");
		$session->msg("s","Se archivo exitosamente.");
		redirect('../../'.$_GET['url']);
	} else {
		$session->msg("d","No se pudo archivar.");
		redirect('../../'.$_GET['url']);
	}
}

if($_GET['tipo'] == 'recepcion-definitiva'){
	$archivar = cambiar_condicion('recepciones_definitivas',0,'idrecepciones_definitivas',(int)$_GET['id']);
	if($archivar){
		logs($user['id'],"recepcion-definitiva",$_GET['id'],"Archivo una recepcion definitiva");
		$session->msg("s","Se archivo exitosamente.");
		redirect('../../'.$_GET['url']);
	} else {
		$session->msg("d","No se pudo archivar.");
		redirect('../../'.$_GET['url']);
	}
}

if($_GET['tipo'] == 'expediente'){
	$archivar = cambiar_condicion('expedientes',0,'idexpedientes',(int)$_GET['id']);
	if($archivar){
	logs($user['id'],"expediente",$_GET['id'],"Archivo un expediente");
		$session->msg("s","Se archivo exitosamente.");
		redirect('../../'.$_GET['url']);
	} else {
		$session->msg("d","No se pudo archivar.");
		redirect('../../'.$_GET['url']);
	}
}

if($_GET['tipo'] == 'nota'){
	$archivar = cambiar_condicion('notas',0,'idnotas',(int)$_GET['id']);
	if($archivar){
	logs($user['id'],"nota",$_GET['id'],"Archivo una nota");
		$session->msg("s","Se archivo exitosamente.");
		redirect('../../'.$_GET['url']);
	} else {
		$session->msg("d","No se pudo archivar.");
		redirect('../../'.$_GET['url']);
	}
}

if($_GET['tipo'] == 'plan_oficial'){
	$archivar = cambiar_condicion('plan_oficial',0,'idplan_oficial',(int)$_GET['id']);
	if($archivar){
		logs($user['id'],"plan_oficial",$_GET['id'],"Archivo un plan oficial de la curva de inversion");
		$session->msg("s","Se archivo exitosamente.");
		redirect('../../obra?id='.$_GET['idobras']);
	} else {
		$session->msg("d","No se pudo archivar.");
		redirect('../../obra?id='.$_GET['idobras']);
	}
}

if($_GET['tipo'] == 'certificados'){
	$archivar = cambiar_condicion('certificados',0,'idcertificados',(int)$_GET['id']);
	if($archivar){
		logs($user['id'],"certificado",$_GET['id'],"Archivo un certificado de la curva de inversion");
		$session->msg("s","Se archivo exitosamente.");
		redirect('../../obra?id='.$_GET['idobras']);
	} else {
		$session->msg("d","No se pudo archivar.");
		redirect('../../obra?id='.$_GET['idobras']);
	}
}

if($_GET['tipo'] == 'certificados_redeterminados'){
	$archivar = cambiar_condicion('certificados_redeterminados',0,'idcertificados_redeterminados',(int)$_GET['id']);
	if($archivar){
		logs($user['id'],"certificado-redeterminado",$_GET['id'],"Archivo un certificado redeterminado de la curva de inversion");
		$session->msg("s","Se archivo exitosamente.");
		redirect('../../obra?id='.$_GET['idobras']);
	} else {
		$session->msg("d","No se pudo archivar.");
		redirect('../../obra?id='.$_GET['idobras']);
	}
}

if($_GET['tipo'] == 'departamento'){
	$archivar = cambiar_condicion('departamentos',0,'iddepartamentos',(int)$_GET['id']);
	if($archivar){
		logs($user['id'],"departamento",$_GET['id'],"Archivo un departamento");
		$session->msg("s","Se archivo exitosamente.");
		redirect('../../'.$_GET['url']);
	} else {
		$session->msg("d","No se pudo archivar.");
		redirect('../../'.$_GET['url']);
	}
}

if($_GET['tipo'] == 'equipo'){
	$archivar = cambiar_condicion('equipos',0,'idequipos',(int)$_GET['id']);
	if($archivar){
		logs($user['id'],"equipo",$_GET['id'],"Archivo una movilidad");
		$session->msg("s","Se archivo exitosamente.");
		redirect('../../'.$_GET['url']);
	} else {
		$session->msg("d","No se pudo archivar.");
		redirect('../../'.$_GET['url']);
	}
}

if($_GET['tipo'] == 'mantenimiento'){
	$archivar = cambiar_condicion('tareas_mantenimientos',0,'idtareas_mantenimientos',(int)$_GET['id']);
	if($archivar){
		logs($user['id'],"mantenimiento",$_GET['id'],"Archivo una tarea de mantenimiento");
		$session->msg("s","Se archivo exitosamente.");
		redirect('../../'.$_GET['url']);
	} else {
		$session->msg("d","No se pudo archivar.");
		redirect('../../'.$_GET['url']);
	}
}

if($_GET['tipo'] == 'rol'){
	$archivar = cambiar_condicion('roles',0,'idroles',(int)$_GET['id']);
	if($archivar){
	logs($user['id'],"rol",$_GET['id'],"Archivo un rol de usuario");
		$session->msg("s","Se archivo exitosamente.");
		redirect('../../'.$_GET['url']);
	} else {
		$session->msg("d","No se pudo archivar.");
		redirect('../../'.$_GET['url']);
	}
}

if($_GET['tipo'] == 'direccion'){
	$archivar = cambiar_condicion('direcciones',0,'iddireccion',(int)$_GET['id']);
	if($archivar){
		logs($user['id'],"direccion",$_GET['id'],"Archivo una direccion");
		$session->msg("s","Se archivo exitosamente.");
		redirect('../../'.$_GET['url']);
	} else {
		$session->msg("d","No se pudo archivar.");
		redirect('../../'.$_GET['url']);
	}
}

if($_GET['tipo'] == 'notificacion'){
	$archivar = cambiar_condicion('notificaciones',0,'idnotificacion',(int)$_GET['id']);
	if($archivar){
		logs($user['id'],"notificacion",$_GET['id'],"Desactivo una notificacion");
		$session->msg("s","Se desactivo exitosamente.");
		redirect('../../'.$_GET['url']);
	} else {
		$session->msg("d","No se pudo desactivar.");
		redirect('../../'.$_GET['url']);
	}
}

if($_GET['tipo'] == 'tramites-etiquetas'){
	$archivar = cambiar_condicion('tramites_etiquetas',0,'idtramites_etiquetas',(int)$_GET['id']);
	if($archivar){
		logs($user['id'],"notificacion",$_GET['id'],"Desactivo una notificacion");
		$session->msg("s","Se desactivo exitosamente.");
		redirect('../../'.$_GET['url']);
	} else {
		$session->msg("d","No se pudo desactivar.");
		redirect('../../'.$_GET['url']);
	}
}

?>