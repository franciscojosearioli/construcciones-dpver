<?php 

$obra_id = (int)$_GET['id'];
$user = current_user();

  if(isset($_POST['edit_valor_multa'])){
      $valor = clean($db->escape($_POST['valor_multa']));
      $query  = "UPDATE obras SET valormulta='{$valor}' WHERE id='{$obra_id}'";
      if($db->query($query)){
        logs($user['id'],"valor-multa",$id,"Edito margen de multa de obra");
        $session->msg('s',"Agregado exitosamente. ");
        redirect('obra?id='.$obra_id, false);
      } else {
        $session->msg('d',' Lo siento, registro falló.');
        redirect('obra?id='.$obra_id, false);
      }
  }

 if(isset($_POST['agregar_plan_oficial'])){
     $numero  = clean($db->escape($_POST['numero']));
     $avance   = clean($db->escape($_POST['avance']));
     $registro_fecha    = make_date();
     $query  = "INSERT INTO plan_oficial (";
     $query .=" idobras,numero,avance,registro_usuario,registro_fecha,condicion";
     $query .=") VALUES (";
     $query .=" '$obra_id', '$numero', '$avance', '".$user['id']."', '$registro_fecha',1";
     $query .=")";
     if($db->query($query)){
    $ultimo_id = $db->insert_id(); 
    logs($user['id'],"plan_oficial",$ultimo_id,"Agrego plan oficial de obra");
       $session->msg('s',"Agregado exitosamente. ");
       redirect('obra?id='.$obra_id, false);
     } else {
       $session->msg('d',' Lo siento, registro falló.');
       redirect('obra?id='.$obra_id, false);
     }
 }

 if(isset($_POST['editar_plan_oficial'])){
     $numero  = clean($db->escape($_POST['numero']));
     $avance   = clean($db->escape($_POST['avance']));
     $id = clean($db->escape($_POST['editar_plan_oficial']));
     $registro_usuario = $user['id'];
     $registro_fecha    = make_date();
     $query  = "UPDATE plan_oficial SET";
     $query .=" numero = '{$numero}', avance = '{$avance}', registro_usuario = '{$registro_usuario}', registro_fecha = '{$registro_fecha}'";
     $query .=" WHERE idplan_oficial = '{$id}'";
     if($db->query($query)){
  logs($user['id'],"plan-oficial",$id,"Edito plan oficial de obra");
       $session->msg('s',"Agregado exitosamente. ");
       redirect('obra?id='.$obra_id, false);
     } else {
       $session->msg('d',' Lo siento, registro falló.');
       redirect('obra?id='.$obra_id, false);
     }
 }

 if(isset($_POST['eliminar_plan_oficial'])){
    $id = clean($db->escape($_POST['eliminar_plan_oficial']));
    $query = "DELETE FROM plan_oficial 
        WHERE idplan_oficial = '{$id}';";
      if($db->query($query)){
        logs($user['id'],"plan-oficial",$id,"Elimino un plan oficial de obra");
        $session->msg('s'," Se ha eliminado un plan oficial.");
        redirect('obra?id='.$obra_id, false);
      } else {
        $session->msg('d',' No se pudo eliminar el plan oficial.');
        redirect('obra?id='.$obra_id, false);
      }
  }

 if(isset($_POST['agregar_certificado'])){
     $expediente  = clean($db->escape($_POST['expediente']));
     $numero  = clean($db->escape($_POST['numero']));
     $fecha  = clean($db->escape($_POST['fecha']));
     $monto  = clean($db->escape($_POST['monto']));
     $avance   = clean($db->escape($_POST['avance']));
     $registro_fecha    = make_date();
     $query  = "INSERT INTO certificados (";
     $query .=" idobras,expediente,numero,fecha,monto,avance,registro_usuario,registro_fecha,condicion";
     $query .=") VALUES (";
     $query .=" '$obra_id', '$expediente', '$numero', '$fecha', '$monto', '$avance', '".$user['id']."', '$registro_fecha',1";
     $query .=")";
     if($db->query($query)){
$ultimo_id = $db->insert_id(); 
    logs($user['id'],"certificado",$ultimo_id,"Agrego certificado de obra");
       $session->msg('s',"Agregado exitosamente. ");
       redirect('obra?id='.$obra_id, false);
     } else {
       $session->msg('d',' Lo siento, registro falló.');
       redirect('obra?id='.$obra_id, false);
     }
 }

 if(isset($_POST['editar_certificado'])){
     $id = clean($db->escape($_POST['editar_certificado']));
     $expediente  = clean($db->escape($_POST['expediente']));
     $numero  = clean($db->escape($_POST['numero']));
     $fecha  = clean($db->escape($_POST['fecha']));
     $monto  = clean($db->escape($_POST['monto']));
     $avance   = clean($db->escape($_POST['avance']));
     $registro_fecha    = make_date();
     $registro_usuario = $user['id'];
     $query  = "UPDATE certificados SET";
     $query .=" expediente = '{$expediente}' , numero = '{$numero}', fecha = '{$fecha}', monto = '{$monto}', avance = '{$avance}', registro_usuario = '{$registro_usuario}', registro_fecha = '{$registro_fecha}'";
     $query .=" WHERE idcertificados = '{$id}'";
     if($db->query($query)){
  logs($user['id'],"certificado",$id,"Edito un certificado");
       $session->msg('s',"Editado exitosamente. ");
       redirect('obra?id='.$obra_id, false);
     } else {
       $session->msg('d',' Lo siento, registro falló.');
       redirect('obra?id='.$obra_id, false);
     }
 }

 if(isset($_POST['eliminar_certificado'])){
    $id = clean($db->escape($_POST['eliminar_certificado']));
    $query = "DELETE FROM certificados 
        WHERE idcertificados = '{$id}';";
      if($db->query($query)){
  logs($user['id'],"certificado",$id,"Elimino un certificado");
        $session->msg('s'," Se ha eliminado un certificado.");
        redirect('obra?id='.$obra_id, false);
      } else {
        $session->msg('d',' No se pudo eliminar el certificado.');
        redirect('obra?id='.$obra_id, false);
      }
  }


 if(isset($_POST['agregar_certificado_redeterminado'])){
     $expediente  = clean($db->escape($_POST['expediente']));
     $numero  = clean($db->escape($_POST['numero']));
     $fecha  = clean($db->escape($_POST['fecha']));
     $monto_provisorio  = clean($db->escape($_POST['monto_provisorio']));
     $monto_definitivo  = clean($db->escape($_POST['monto_definitivo']));
     $informacion  = clean($db->escape($_POST['informacion']));
     $registro_fecha    = make_date();
     $registro_usuario = $user['id'];
     $query  = "INSERT INTO certificados_redeterminados (";
     $query .=" idobras,expediente,numero,fecha,monto_provisorio,monto_definitivo,informacion,registro_usuario,registro_fecha,condicion";
     $query .=") VALUES (";
     $query .=" '$obra_id', '$expediente', '$numero', '$fecha', '$monto_provisorio', '$monto_definitivo', '$informacion', '".$user['id']."', '$registro_fecha',1";
     $query .=")";
     if($db->query($query)){
$ultimo_id = $db->insert_id(); 
    logs($user['id'],"certificado-redeterminado",$ultimo_id,"Agrego certificado redeterminado de obra");
       $session->msg('s',"Agregado exitosamente. ");
       redirect('obra?id='.$obra_id, false);
     } else {
       $session->msg('d',' Lo siento, registro falló.');
       redirect('obra?id='.$obra_id, false);
     }
 }

  if(isset($_POST['editar_certificado_redeterminado'])){
     $id = clean($db->escape($_POST['editar_certificado_redeterminado']));
     $expediente  = clean($db->escape($_POST['expediente']));
     $numero  = clean($db->escape($_POST['numero']));
     $fecha  = clean($db->escape($_POST['fecha']));
     $monto_provisorio  = clean($db->escape($_POST['monto_provisorio']));
     $monto_definitivo  = clean($db->escape($_POST['monto_definitivo']));
     $informacion  = clean($db->escape($_POST['informacion']));
     $registro_fecha    = make_date();
     $registro_usuario = $user['id'];
     $query  = "UPDATE certificados_redeterminados SET";
     $query .=" expediente = '{$expediente}', numero = '{$numero}', fecha = '{$fecha}', monto_provisorio = '{$monto_provisorio}', monto_definitivo = '{$monto_definitivo}', informacion = '{$informacion}', registro_usuario = '{$registro_usuario}', registro_fecha = '{$registro_fecha}'";
     $query .=" WHERE idcertificados_redeterminados = '{$id}'";
     if($db->query($query)){
      logs($user['id'],"certificado-redeterminado",$id,"Edito un certificado redeterminado de obra");
       $session->msg('s',"Agregado exitosamente. ");
       redirect('obra?id='.$obra_id, false);
     } else {
       $session->msg('d',' Lo siento, registro falló.');
       redirect('obra?id='.$obra_id, false);
     }
 }

 if(isset($_POST['eliminar_certificado_redeterminado'])){
    $id = clean($db->escape($_POST['eliminar_certificado_redeterminado']));
    $query = "DELETE FROM certificados_redeterminados 
        WHERE idcertificados_redeterminados = '{$id}';";
      if($db->query($query)){
        logs($user['id'],"certificado-redeterminado",$id,"Elimino un certificado redeterminado de obra");
        $session->msg('s'," Se ha eliminado un certificado redeterminado.");
        redirect('obra?id='.$obra_id, false);
      } else {
        $session->msg('d',' No se pudo eliminar el certificado redeterminado.');
        redirect('obra?id='.$obra_id, false);
      }
  }

 if(isset($_POST['agregar_descuento'])){
     $descripcion  = clean($db->escape($_POST['descripcion']));
     $valor  = clean($db->escape($_POST['valor']));
     $registro_fecha    = make_date();
     $query  = "INSERT INTO certificados_descuentos (";
     $query .=" descripcion,valor,registro_usuario,registro_fecha,condicion";
     $query .=") VALUES (";
     $query .=" '$descripcion', '$valor', '".$user['id']."', '$registro_fecha',1";
     $query .=")";
     if($db->query($query)){
$ultimo_id = $db->insert_id(); 
    logs($user['id'],"certificado-descuento",$ultimo_id,"Agrego descuento de certificados");
       $session->msg('s',"Agregado exitosamente. ");
       redirect('certificados-descuentos', false);
     } else {
       $session->msg('d',' Lo siento, registro falló.');
       redirect('certificados-descuentos', false);
     }
 }

   if(isset($_POST['editar_descuento'])){
     $id  = clean($db->escape($_POST['editar_descuento']));
     $descripcion  = clean($db->escape($_POST['descripcion']));
     $valor  = clean($db->escape($_POST['valor']));
     $registro_fecha    = make_date();
     $query  = "UPDATE certificados_descuentos SET";
     $query .=" descripcion = '{$descripcion}', valor = '{$valor}', registro_usuario = '".$user['id']."', registro_fecha = '{$registro_fecha}' WHERE idcertificados_descuentos = '{$id}'";
     if($db->query($query)){
$ultimo_id = $db->insert_id(); 
    logs($user['id'],"certificado-descuentos",$ultimo_id,"Edito descuento de certificados");
       $session->msg("Agregado exitosamente.");
       redirect('certificados-descuentos', false);
     } else {
       $session->msg('Lo siento, registro falló.');
       redirect('certificados-descuentos', false);
     }
 }

 if(isset($_POST['agregar_precio'])){
     $descripcion  = clean($db->escape($_POST['descripcion']));
     $valor  = clean($db->escape($_POST['valor']));
    $tipo  = clean($db->escape($_POST['tipo']));
     $registro_fecha    = make_date();
     $query  = "INSERT INTO certificados_precios (";
     $query .=" descripcion,valor,tipo,registro_usuario,registro_fecha,condicion";
     $query .=") VALUES (";
     $query .=" '$descripcion', '$valor', '$tipo', '".$user['id']."', '$registro_fecha',1";
     $query .=")";
     if($db->query($query)){
$ultimo_id = $db->insert_id(); 
    logs($user['id'],"certificado-precios",$ultimo_id,"Agrego indice de precios");
       $session->msg('s',"Agregado exitosamente. ");
       redirect('precios-items', false);
     } else {
       $session->msg('d',' Lo siento, registro falló.');
       redirect('precios-items', false);
     }
 }

  if(isset($_POST['editar_precio'])){
     $id  = clean($db->escape($_POST['idcertificados_precios']));
     $descripcion  = clean($db->escape($_POST['descripcion']));
     $valor  = clean($db->escape($_POST['valor']));
     $tipo  = clean($db->escape($_POST['tipo']));

     $registro_fecha    = make_date();
     $query  = "UPDATE certificados_precios SET";
     $query .=" descripcion = '{$descripcion}', valor = '{$valor}', tipo = '{$tipo}', registro_usuario = '".$user['id']."', registro_fecha = '{$registro_fecha}' WHERE idcertificados_precios = '{$id}'";
     if($db->query($query)){
$ultimo_id = $db->insert_id(); 
    logs($user['id'],"certificado-unidades",$ultimo_id,"Edito unidad de medida");
       $session->msg("Agregado exitosamente.");
       redirect('precios-items', false);
     } else {
       $session->msg('Lo siento, registro falló.');
       redirect('precios-items', false);
     }
 }

  if(isset($_POST['agregar_unidad'])){
     $titulo  = clean($db->escape($_POST['titulo']));
     $unidad  = clean($db->escape($_POST['unidad']));
     $registro_fecha    = make_date();
     $query  = "INSERT INTO certificados_unidades (";
     $query .=" titulo,unidad,registro_usuario,registro_fecha,condicion";
     $query .=") VALUES (";
     $query .=" '$titulo', '$unidad', '".$user['id']."', '$registro_fecha',1";
     $query .=")";
     if($db->query($query)){
$ultimo_id = $db->insert_id(); 
    logs($user['id'],"certificado-unidades",$ultimo_id,"Agrego unidad de medida");
       $session->msg("Agregado exitosamente.");
       redirect('certificados-unidades', false);
     } else {
       $session->msg('Lo siento, registro falló.');
       redirect('certificados-unidades', false);
     }
 }
  if(isset($_POST['editar_unidad'])){
     $id  = clean($db->escape($_POST['editar_unidad']));
     $titulo  = clean($db->escape($_POST['titulo']));
     $unidad  = clean($db->escape($_POST['unidad']));
     $registro_fecha    = make_date();
     $query  = "UPDATE certificados_unidades SET";
     $query .=" titulo = '{$titulo}', unidad = '{$unidad}', registro_usuario = '".$user['id']."', registro_fecha = '{$registro_fecha}' WHERE idcertificados_unidades = '{$id}'";
     if($db->query($query)){
$ultimo_id = $db->insert_id(); 
    logs($user['id'],"certificado-unidades",$ultimo_id,"Edito unidad de medida");
       $session->msg("Agregado exitosamente.");
       redirect('certificados-unidades', false);
     } else {
       $session->msg('Lo siento, registro falló.');
       redirect('certificados-unidades', false);
     }
 }


if(isset($_POST['numero_certificado'])){

     $idobra = clean($db->escape($_POST['idobras']));  
     $numero_certificado  = clean($db->escape($_POST['numero_certificado']));  
     $fecha_medicion  = clean($db->escape($_POST['fecha_medicion']));
     $fecha_vencimiento  = clean($db->escape($_POST['fecha_vencimiento']));
     $month  = clean($db->escape($_POST['month']));
     $year  = clean($db->escape($_POST['year']));
     $importe_rp  = clean($db->escape($_POST['importe_rp']));
     $if_rp  = clean($db->escape($_POST['if_rp']));
     $importe_cert  = clean($db->escape($_POST['total_importe']));
     $importe_anticipo = clean($db->escape($_POST['monto_anticipo_financiero']));
     $descuento_anticipo = clean($db->escape($_POST['monto_descuento_anticipo']));
     $porcentaje_anticipo = clean($db->escape($_POST['valor_descuento_anticipo']));
     $anticipo_archivo = 'Anticipo.pdf';
     $anticipo_copia = 'Anticipo-COPIA.pdf';
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
     $registro_fecha    = make_date();


     $consul_cert = consultar_n_certificado($numero_certificado,$idobra);


if(empty($consul_cert)){
  if($numero_certificado == '0'){
$query  = "INSERT INTO certificados_obras (";
     $query .=" idobras,numero,fecha_medicion,month,year,fecha_vencimiento,importe,importe_final,expediente,monto_total_aprobado,obra_ejecutada,porcen_ejecutado,obra_prevista,porcen_previsto,atraso_adelanto,plazo_contractual,plazo_aprobado,plazo_transcurrido,porcentaje_avance,estado,archivo,archivo_copia,numero_resolucion,fecha_resolucion,registro_usuario,registro_fecha";
     $query .=") VALUES (";
     $query .="'{$idobra}', '{$numero_certificado}', '', '{$month}', '{$year}', '', '{$importe_anticipo}','{$importe_anticipo}', '', '', '', '', '', '', '', '', '', '', '', '0', '{$anticipo_archivo}','{$anticipo_copia}','','', '".$user['id']."', '{$registro_fecha}'";
     $query .=");";
if($db->query($query)){
    logs($user['id'],"certificados_obras",$id,"Creo anticipo financiero");
    $session->msg('s',"Dato actualizado. ");
redirect('../../../certificados/web/index.php?r=certificados-obras%2Fanticipo&idobras='.$idobra, false);
  } else {
    $session->msg('d',' Lo siento, registro falló.');
redirect('../../../certificados/web/index.php?r=certificados-obras%2Fanticipo&idobras='.$idobra, false);
  }


}else{
  if($if_rp == '1'){
    
    $query = "INSERT INTO certificados_obras (";
    $query .=" idobras,numero,fecha_medicion,month,year,fecha_vencimiento,importe,importe_final,expediente,monto_total_aprobado,obra_ejecutada,porcen_ejecutado,obra_prevista,porcen_previsto,atraso_adelanto,plazo_contractual,plazo_aprobado,plazo_transcurrido,porcentaje_avance,estado,archivo,archivo_copia,numero_resolucion,fecha_resolucion,anticipo,descuento_anticipo,rp,registro_usuario,registro_fecha";
    $query .=") VALUES (";
    $query .="'{$idobra}', '{$numero_certificado}', '{$fecha_medicion}', '{$month}', '{$year}', '{$fecha_vencimiento}', '{$importe_cert}', '{$importe_cert}', '', '{$monto_total_aprobado}', '{$obra_ejecutada}', '{$porcen_ejecutado}', '{$obra_prevista}', '{$porcen_previsto}', '{$atraso_adelanto}', '{$plazo_contractual}', '{$plazo_aprobado}', '{$plazo_transcurrido}', '{$porcen_ejecutado}', '0', '{$certificado_archivo}','{$certificado_copia}','','', '{$porcentaje_anticipo}', '{$descuento_anticipo}', '1','".$user['id']."', '{$registro_fecha}'";
    $query .=");";

  }else{
    

     $query = "INSERT INTO certificados_obras (";
     $query .=" idobras,numero,fecha_medicion,month,year,fecha_vencimiento,importe,expediente,monto_total_aprobado,obra_ejecutada,porcen_ejecutado,obra_prevista,porcen_previsto,atraso_adelanto,plazo_contractual,plazo_aprobado,plazo_transcurrido,porcentaje_avance,estado,archivo,archivo_copia,numero_resolucion,fecha_resolucion,anticipo,descuento_anticipo,rp,registro_usuario,registro_fecha";
     $query .=") VALUES (";
     $query .="'{$idobra}', '{$numero_certificado}', '{$fecha_medicion}', '{$month}', '{$year}', '{$fecha_vencimiento}', '{$importe_cert}', '', '{$monto_total_aprobado}', '{$obra_ejecutada}', '{$porcen_ejecutado}', '{$obra_prevista}', '{$porcen_previsto}', '{$atraso_adelanto}', '{$plazo_contractual}', '{$plazo_aprobado}', '{$plazo_transcurrido}', '{$porcen_ejecutado}', '0', '{$certificado_archivo}','{$certificado_copia}','','', '{$porcentaje_anticipo}', '{$descuento_anticipo}', '0','".$user['id']."', '{$registro_fecha}'";
     $query .=");";
    }

if($db->query($query)){
      $ultimo_id_certificado = $db->insert_id(); 

if(isset($_POST['idobras_items'])){
  $cantidad_items = count($_POST['idobras_items']);
  $i=0;
  $insert_item = '';
   foreach ($_POST as $indice=>$cadena) { 
   while($i<$cantidad_items){  

   $insert_item .= $db->query("INSERT INTO certificados_obras_items (idcertificados_obras, idobras_items, cantidad, cantidad_acumulada, disponibles) VALUES ('".$ultimo_id_certificado."', '".$_POST['idobras_items'][$i]."', '".$_POST['cantidad'][$i]."', '".$_POST['total_individual_acumulado'][$i]."', '".$_POST['disponibles'][$i]."'); ");

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
   $insert_descuento .= $db->query("INSERT INTO certificados_obras_descuentos (idcertificados_obras, idcertificados_descuentos) VALUES ('".$ultimo_id_certificado."', '".$_POST['descuento_aplica'][$i]."'); ");
   $i++; 
   }
   }
$insert_descuento .= '';
}
    //http://10.100.32.8/certificados/web/index.php?r=certificados-obras%2Findex&idcertificado=8
     if($db->query($inserta_items) && $db->query($inserta_descuentos)){
       $session->msg('s',"Agregado exitosamente. ");
       logs($user['id'],"certificados_obras",$ultimo_id_certificado,"Creo certificado de obra");
       redirect('../../../certificados/web/index.php?r=certificados-obras%2Findex&idcertificado='.$ultimo_id_certificado, false);
     } else {
       $session->msg('d',' Lo siento, registro falló.');
       redirect('../../../certificados/web/index.php?r=certificados-obras%2Findex&idcertificado='.$ultimo_id_certificado, false);
     }
    }}
  }else{
    $session->msg('d',' Registro fallo, el certificado ya fue confeccionado. ');
    redirect('../../public/admin', false);

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