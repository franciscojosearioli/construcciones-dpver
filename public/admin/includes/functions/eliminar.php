<?php
require_once('../../includes/load.php');
$user = current_user();

if($_GET['tipo'] == 'planilla-cotizacion'){
	$archivar = eliminar_dato('cotizaciones','idcotizaciones',(int)$_GET['id']);
	if($_GET['url'] == 'refresh'){
	if($archivar){
		logs($user['id'],"planilla-cotizacion",$_GET['id'],"Elimino una planilla de cotizacion");
		$session->msg("s","Se elimino exitosamente.");
		header('Location:' . getenv('HTTP_REFERER'));
	} else {
		$session->msg("d","No se pudo eliminar.");
		header('Location:' . getenv('HTTP_REFERER'));
	}
}
}
if($_GET['tipo'] == 'planilla-plandetrabajo'){
	$archivar = eliminar_dato('planes_de_trabajo','idplanes_de_trabajo',(int)$_GET['id']);
	if($_GET['url'] == 'refresh'){
	if($archivar){
		logs($user['id'],"planilla-cotizacion",$_GET['id'],"Elimino una planilla de plan de trabajo");
		$session->msg("s","Se elimino exitosamente.");
		header('Location:' . getenv('HTTP_REFERER'));
	} else {
		$session->msg("d","No se pudo eliminar.");
		header('Location:' . getenv('HTTP_REFERER'));
	}
}
}


if($_GET['tipo'] == 'planoficial'){
	$archivar = eliminar_dato('obras_planoficial','idobras_planoficial',(int)$_GET['id']);
	if($archivar){
		logs($user['id'],"obras-planoficial",$_GET['id'],"Elimino una fila del plan oficial");
		$session->msg("s","Se elimino exitosamente.");
		redirect('../../'.$_GET['url']);
	} else {
		$session->msg("d","No se pudo eliminar.");
		redirect('../../'.$_GET['url']);
	}
}

if($_GET['tipo'] == 'armario'){
	$archivar = eliminar_dato('armarios','idarmarios',(int)$_GET['id']);
	if($archivar){
		logs($user['id'],"armario",$_GET['id'],"Elimino un registro de armario");
		$session->msg("s","Se elimino exitosamente.");
		redirect('../../'.$_GET['url']);
	} else {
		$session->msg("d","No se pudo eliminar.");
		redirect('../../'.$_GET['url']);
	}
}

if($_GET['tipo'] == 'cotizacion'){
	$archivar = eliminar_dato('obras_items','idobras_items',(int)$_GET['id']);
	if($archivar){
		logs($user['id'],"obras-items",$_GET['id'],"Elimino un item de cotizacion");
		$session->msg("s","Se elimino exitosamente.");
		redirect('../../'.$_GET['url']);
	} else {
		$session->msg("d","No se pudo eliminar.");
		redirect('../../'.$_GET['url']);
	}
}

if($_GET['tipo'] == 'certificados_descuentos'){
	$archivar = eliminar_dato('certificados_descuentos','idcertificados_descuentos',(int)$_GET['id']);
	if($archivar){
		logs($user['id'],"certificados_descuentos",$_GET['id'],"Elimino descuento de certificados");
		$session->msg("s","Se elimino exitosamente.");
		redirect('../../'.$_GET['url']);
	} else {
		$session->msg("d","No se pudo eliminar.");
		redirect('../../'.$_GET['url']);
	}
}

if($_GET['tipo'] == 'certificados_unidades'){
	$archivar = eliminar_dato('certificados_unidades','idcertificados_unidades',(int)$_GET['id']);
	if($archivar){
		logs($user['id'],"certificados_unidades",$_GET['id'],"Elimino unidad de medida");
		$session->msg("s","Se elimino exitosamente.");
		redirect('../../'.$_GET['url']);
	} else {
		$session->msg("d","No se pudo eliminar.");
		redirect('../../'.$_GET['url']);
	}
}

if($_GET['tipo'] == 'certificados_precios'){
	$archivar = eliminar_dato('certificados_precios','idcertificados_precios',(int)$_GET['id']);
	if($archivar){
		logs($user['id'],"certificados_precios",$_GET['id'],"Elimino indice de precio");
		$session->msg("s","Se elimino exitosamente.");
		redirect('../../'.$_GET['url']);
	} else {
		$session->msg("d","No se pudo eliminar.");
		redirect('../../'.$_GET['url']);
	}
}

if($_GET['tipo'] == 'recepcion-provisoria'){
	$archivar = eliminar_dato('recepciones_provisorias','idrecepciones_provisorias',(int)$_GET['id']);
	if($archivar){
		logs($user['id'],"recepcion-provisoria",$_GET['id'],"Elimino una recepcion provisoria");
		$session->msg("s","Se elimino exitosamente.");
		redirect('../../'.$_GET['url']);
	} else {
		$session->msg("d","No se pudo eliminar.");
		redirect('../../'.$_GET['url']);
	}
}
if($_GET['tipo'] == 'recepcion-definitiva'){
	$archivar = eliminar_dato('recepciones_definitivas','idrecepciones_definitivas',(int)$_GET['id']);
	if($archivar){
		logs($user['id'],"recepcion-definitiva",$_GET['id'],"Elimino una recepcion definitiva");
		$session->msg("s","Se elimino exitosamente.");
		redirect('../../'.$_GET['url']);
	} else {
		$session->msg("d","No se pudo eliminar.");
		redirect('../../'.$_GET['url']);
	}
}

?>