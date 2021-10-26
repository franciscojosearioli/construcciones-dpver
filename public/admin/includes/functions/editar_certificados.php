<?php 

$obra_id = (int)$_GET['id'];
$user = current_user();

if(isset($_POST['numero_certificado_edit'])){
    $idcertificado = clean($db->escape($_POST['idcertificado']));  
     $idobra = clean($db->escape($_POST['idobras']));  
     $numero_certificado  = clean($db->escape($_POST['numero_certificado_edit']));  
     $fecha_medicion  = clean($db->escape($_POST['fecha_medicion']));
     $fecha_vencimiento  = clean($db->escape($_POST['fecha_vencimiento']));
     $month  = clean($db->escape($_POST['month']));
     $year  = clean($db->escape($_POST['year']));
     $importe_cert  = clean($db->escape($_POST['total_importe']));
     $importe_anticipo = clean($db->escape($_POST['monto_anticipo_financiero']));
     $descuento_anticipo = clean($db->escape($_POST['monto_descuento_anticipo']));
     $porcentaje_anticipo = clean($db->escape($_POST['valor_descuento_anticipo']));
     $anticipo_archivo = 'Anticipo.pdf';
     $certificado_archivo = 'CertificadoN'.$numero_certificado.'.pdf';

     $monto_total_aprobado  = clean($db->escape($_POST['monto_total_aprobado']));
     $obra_ejecutada  = clean($db->escape($_POST['obra_ejecutada']));

     $porcen_ejecutado  = clean($db->escape($_POST['porc_obra_ejecutada']));
     $obra_prevista  = clean($db->escape($_POST['obra_prevista']));
     $porcen_previsto  = clean($db->escape($_POST['avance_planoficial']));
     $atraso_adelanto  = clean($db->escape($_POST['atraso_adelanto']));
     $plazo_contractual  = clean($db->escape($_POST['plazo_contractual']));
     $plazo_aprobado  = clean($db->escape($_POST['plazo_aprobado']));
     $plazo_transcurrido  = clean($db->escape($_POST['plazo_transcurrido']));
     $porcentaje_avance  = clean($db->escape($_POST['porcentaje_avance']));     
     $registro_fecha    = make_date();

     $query  = "UPDATE certificados_obras SET idobras = '{$idobra}', numero = '{$numero_certificado}', fecha_medicion = '{$fecha_medicion}', month = '{$month}', year = '{$year}',
     fecha_vencimiento = '{$fecha_vencimiento}', importe = '{$importe_cert}', monto_total_aprobado = '{$monto_total_aprobado}', obra_ejecutada = '{$obra_ejecutada}', porcen_ejecutado ='{$porcen_ejecutado}',
     obra_prevista ='{$obra_prevista}', porcen_previsto ='{$porcen_previsto}', atraso_adelanto ='{$atraso_adelanto}', plazo_contractual ='{$plazo_contractual}', plazo_aprobado ='{$plazo_aprobado}',
     plazo_transcurrido ='{$plazo_transcurrido}', porcentaje_avance ='{$porcen_ejecutado}', estado = '0', archivo = '{$certificado_archivo}', numero_resolucion = '',
     fecha_resolucion = '', descuento_anticipo = '{$descuento_anticipo}', registro_usuario = '".$user['id']."', registro_fecha ='{$registro_fecha}' WHERE idcertificados_obras = '{$idcertificado}';";

if($db->query($query)){
  $insert_item = '';
  $insert_descuento = '';
if(isset($_POST['idobras_items'])){
  $cantidad_items = count($_POST['idobras_items']);
  $i=0;
  
   foreach ($_POST as $indice=>$cadena) { 
   while($i<$cantidad_items){  

   $insert_item .= $db->query("UPDATE certificados_obras_items SET cantidad = '".$_POST['cantidad'][$i]."', cantidad_acumulada = '".$_POST['total_individual_acumulado'][$i]."',
   disponibles = '".$_POST['disponibles'][$i]."' WHERE idcertificados_obras = '{$idcertificado}' AND idobras_items = '".$_POST['idobras_items'][$i]."'");

$i++; 
   }
   }
$insert_item .= '';
}

if(isset($_POST['descuento_aplica'])){
  $cantidad_descuentos = count($_POST['descuento_aplica']);
  $i=0;
  $insert_descuento = '';
  $db->query("DELETE FROM certificados_obras_descuentos WHERE idcertificados_obras = '".$idcertificado ."';");
   foreach ($_POST as $indice=>$cadena) { 
   while($i<$cantidad_descuentos){  
    if(isset($_POST['descuento_aplica'][$i])){
   $insert_descuento .= $db->query("INSERT INTO certificados_obras_descuentos (idcertificados_obras, idcertificados_descuentos) VALUES ('".$idcertificado."', '".$_POST['descuento_aplica'][$i]."'); ");
    }
  
  $i++;  
}} 
$insert_descuento .= '';
}else{
  $db->query("DELETE FROM certificados_obras_descuentos WHERE idcertificados_obras = '".$idcertificado ."';");
}
  //http://10.100.32.8/certificados/web/index.php?r=certificados-obras%2Findex&idcertificado=8
  if($db->query($insert_item) && $db->query($insert_descuento)){
    $session->msg('s',"Agregado exitosamente. ");
    redirect('../../../certificados/web/index.php?r=certificados-obras%2Findex&idcertificado='.$idcertificado, false);
  } else {
    $session->msg('d',' Lo siento, registro falló.');
    redirect('../../../certificados/web/index.php?r=certificados-obras%2Findex&idcertificado='.$idcertificado, false);
  }
    }
  }

if(isset($_POST['change_exp_cert'])){
  $id = clean($db->escape($_POST['certificado_expediente_id']));
   $expediente = clean($db->escape($_POST['change_exp_cert']));
  $registro_usuario    = $user['id'];
  $registro_fecha    = make_date();
  $query  = "UPDATE certificados_obras SET 
  expediente='$expediente' 
  WHERE 
  idcertificados_obras='$id';
  ";
  if($db->query($query)){
    logs($user['id'],"certificados_obras",$id,"Cambio el expediente del certificado");
    $session->msg('s',"Dato actualizado. ");
  redirect('certificados');
  } else {
    $session->msg('d',' Lo siento, registro falló.');
  redirect('certificados');
  }
  }

if(isset($_POST['change_reso_cert'])){
  $id = clean($db->escape($_POST['certificado_resolucion_id']));
   $numero = clean($db->escape($_POST['change_reso_cert']));   
   $fecha = clean($db->escape($_POST['change_fechareso_cert']));
  $registro_usuario    = $user['id'];
  $registro_fecha    = make_date();
  $query  = "UPDATE certificados_obras SET 
  numero_resolucion='$numero',  fecha_resolucion='$fecha'
  WHERE 
  idcertificados_obras='$id';
  ";
  if($db->query($query)){
    logs($user['id'],"certificados_obras",$id,"Cambio la resolucion del certificado");
    $session->msg('s',"Dato actualizado. ");
  redirect('certificados');
  } else {
    $session->msg('d',' Lo siento, registro falló.');
  redirect('certificados');
  }
  }





 ?>