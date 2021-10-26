<?php 

$obra_id = (int)$_GET['id'];
$user = current_user();


if(isset($_POST['numero_certificado'])){

     $idobra = clean($db->escape($_POST['idobras']));  
     $numero_certificado  = clean($db->escape($_POST['numero_certificado']));  
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
     $certificado_copia = 'CertificadoN'.$numero_certificado.'-COPIA.pdf';

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
     $tipo =  clean($db->escape($_POST['tipo']));    
     $registro_fecha    = make_date();

     $query  = "INSERT INTO certificados_obras_redeterminados (";
     $query .=" idobras,numero,fecha_medicion,month,year,fecha_vencimiento,importe,expediente,estado,archivo,archivo_copia,numero_resolucion,fecha_resolucion,tipo,registro_usuario,registro_fecha";
     $query .=") VALUES (";
     $query .="'{$idobra}', '{$numero_certificado}', '{$fecha_medicion}', '{$month}', '{$year}', '{$fecha_vencimiento}', '{$importe_cert}', '', '0', '{$certificado_archivo}','{$certificado_copia}','','', '{$tipo}', '".$user['id']."', '{$registro_fecha}'";
     $query .=");";
if($db->query($query)){
      $ultimo_id_certificado = $db->insert_id(); 

if(isset($_POST['idobras_items'])){
  $cantidad_items = count($_POST['idobras_items']);
  $i=0;
  $insert_item = '';
   foreach ($_POST as $indice=>$cadena) { 
   while($i<$cantidad_items){  
   $insert_item .= $db->query("INSERT INTO certificados_obras_redeterminados_items (idcertificados_obras_redeterminados, idobras_items, cantidad, precio, importe) VALUES ('".$ultimo_id_certificado."', '".$_POST['idobras_items'][$i]."', '".$_POST['cantidad'][$i]."', '".$_POST['precio_unitario_items'][$i]."', '".$_POST['importe'][$i]."'); ");
   $i++; 
   }
   }
$insert_item .= '';
}
if(isset($_POST['descuento_aplica'])){
  $cantidad_descuentos = count($_POST['descuento_aplica']);
  $i=0;
  $insert_descuento = '';
   foreach ($_POST as $indice=>$cadena) { 
   while($i<$cantidad_descuentos){  
    //var_dump($_POST['descuento_aplica'][$i]);die;
   $insert_descuento .= $db->query("INSERT INTO certificados_obras_descuentos (idcertificados_obras_redeterminados, idcertificados_descuentos) VALUES ('".$ultimo_id_certificado."', '".$_POST['descuento_aplica'][$i]."'); ");
   $i++; 
   }
   }
$insert_descuento .= '';
}
    ///certificados/web//index.php?r=certificados-obras%2Frede&idcertificado=1&id_acta=10
     if($db->query($inserta_items) && $db->query($inserta_descuentos)){
      logs($user['id'],"certificados_obras_redeterminados",$ultimo_id_certificado,"Creo certificado redeterminado de obra");
       $session->msg('s',"Agregado exitosamente. ");
       redirect('../../../certificados/web/index.php?r=certificados-obras%2Frede&idcertificado='.$ultimo_id_certificado.'&id_acta='.$_POST['id_acta'], false);
     } else {
       $session->msg('d',' Lo siento, registro falló.');
       redirect('../../../certificados/web/index.php?r=certificados-obras%2Frede&idcertificado='.$ultimo_id_certificado.'&id_acta='.$_POST['id_acta'], false);
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