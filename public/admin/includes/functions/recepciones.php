<?php
require_once('../../includes/load.php');
$user = current_user();

if(isset($_POST['add_recepcion'])){
    $idnota = $db->escape($_POST['id_notas']);
    $idexpediente = $db->escape($_POST['id_expedientes']);
    $nombre_obras  = $db->escape($_POST['nombre_obras']);
    $expediente  = clean($db->escape($_POST['expediente']));
    $obra  = $db->escape($_POST['obra']);
    $expediente_obra  = $db->escape($_POST['expediente_obra']);
    $fecha_pedido  = clean($db->escape($_POST['fecha_pedido']));
    $documentacion_planos = $db->escape($_POST['documentacion_planos']);
    if(!empty($documentacion_planos)){ echo $documentacion_planos_fecha = make_date(); }else{ $documentacion_planos_fecha = '';}
    $documentacion_planos_observacion = $db->escape($_POST['documentacion_planos_observacion']);
    $documentacion_ensayos = $db->escape($_POST['documentacion_ensayos']);
    if(!empty($documentacion_ensayos)){ echo $documentacion_ensayos_fecha = make_date(); }else{ $documentacion_ensayos_fecha = '';}
    $documentacion_ensayos_observacion = $db->escape($_POST['documentacion_ensayos_observacion']);
    $documentacion_mas = $db->escape($_POST['documentacion_mas']);
    if(!empty($documentacion_mas)){ echo $documentacion_mas_fecha = make_date(); }else{ $documentacion_mas_fecha = '';}
    $documentacion_mas_observacion = $db->escape($_POST['documentacion_mas_observacion']);
    $confirmacion_documentacion_fecha = $db->escape($_POST['confirmacion_documentacion_fecha']);
    $confirmacion_documentacion_observacion = $db->escape($_POST['confirmacion_documentacion_observacion']);
    $integrantes_resolucion_fecha  = clean($db->escape($_POST['integrantes_resolucion_fecha']));
    $integrantes_resolucion_num   = clean($db->escape($_POST['integrantes_resolucion_num']));
    $comision_agente1 = $db->escape($_POST['comision_agente1']);
    $comision_agente1_notificado = $db->escape($_POST['comision_agente1_notificado']);
    $comision_agente2 = $db->escape($_POST['comision_agente2']);
    $comision_agente2_notificado = $db->escape($_POST['comision_agente2_notificado']);
    $comision_agente3 = $db->escape($_POST['comision_agente3']);
    $comision_agente3_notificado = $db->escape($_POST['comision_agente3_notificado']);
    $comision_agente4 = $db->escape($_POST['comision_agente4']);
    $comision_agente4_notificado = $db->escape($_POST['comision_agente4_notificado']);
    $movilidad = $db->escape($_POST['movilidad']);
    $movilidad_observacion = $db->escape($_POST['movilidad_observacion']);
    if(!empty($movilidad_observacion)){ echo $movilidad_observacion_fecha = make_date(); }else{ $movilidad_observacion_fecha = '';}
    $recibido_estado = $db->escape($_POST['recibido_estado']);
    $recibido_notificado = $db->escape($_POST['recibido_notificado']);
    $recibido_notificado_observacion = $db->escape($_POST['recibido_notificado_observacion']);
    $acta_resolucion = $db->escape($_POST['acta_resolucion']);
    $acta_resolucion_proyecto = $db->escape($_POST['acta_resolucion_proyecto']);
    $acta_fecha = $db->escape($_POST['acta_fecha']);
    $no_recibido_notificado_inspector = $db->escape($_POST['no_recibido_notificado_inspector']);
    $no_recibido_notificado_inspector_observacion = $db->escape($_POST['no_recibido_notificado_inspector_observacion']);
    $no_recibido_notificado_empresa = $db->escape($_POST['no_recibido_notificado_empresa']);
    $no_recibido_notificado_empresa_observacion = $db->escape($_POST['no_recibido_notificado_empresa_observacion']);
    $no_recibido_conforme = $db->escape($_POST['no_recibido_conforme']);
    $no_recibido_no_conforme = $db->escape($_POST['no_recibido_no_conforme']);
    $observaciones   = clean($db->escape($_POST['observaciones']));
    $tipo   = clean($db->escape($_POST['tipo']));
    $registro_fecha    = make_date();
    $query  = "INSERT INTO recepciones (idnotas, idexpedientes, nombre_obras, expediente, obra, expediente_obra, fecha_pedido, documentacion_planos, documentacion_planos_fecha, documentacion_planos_observacion, documentacion_ensayos, documentacion_ensayos_fecha, documentacion_ensayos_observacion, documentacion_mas, documentacion_mas_fecha, documentacion_mas_observacion, confirmacion_documentacion_fecha, confirmacion_documentacion_observacion, integrantes_resolucion_fecha, integrantes_resolucion_num, comision_agente1, comision_agente1_notificado, comision_agente2, comision_agente2_notificado, comision_agente3, comision_agente3_notificado, comision_agente4, comision_agente4_notificado, movilidad, movilidad_observacion, movilidad_observacion_fecha, recibido_estado, recibido_notificado, recibido_notificado_observacion, acta_resolucion_proyecto, acta_resolucion, acta_fecha, no_recibido_notificado_inspector, no_recibido_notificado_inspector_observacion, no_recibido_notificado_empresa, no_recibido_notificado_empresa_observacion, no_recibido_conforme, no_recibido_no_conforme, observaciones, condicion, registro_usuario, registro_fecha, tipo";
    $query .=") VALUES (";
    $query .=" '$idnota', '$idexpediente', '$nombre_obras', '$expediente', '$obra', '$expediente_obra', '$fecha_pedido', '$documentacion_planos', '$documentacion_planos_fecha', '$documentacion_planos_observacion', '$documentacion_ensayos', '$documentacion_ensayos_fecha', '$documentacion_ensayos_observacion', '$documentacion_mas', '$documentacion_mas_fecha', '$documentacion_mas_observacion', '$confirmacion_documentacion_fecha', '$confirmacion_documentacion_observacion', '$integrantes_resolucion_fecha', '$integrantes_resolucion_num', '$comision_agente1', '$comision_agente1_notificado', '$comision_agente2', '$comision_agente2_notificado', '$comision_agente3', '$comision_agente3_notificado', '$comision_agente4', '$comision_agente4_notificado', '$movilidad', '$movilidad_observacion', '$movilidad_observacion_fecha', '$recibido_estado', '$recibido_notificado', '$recibido_notificado_observacion', '$acta_resolucion_proyecto', '$acta_resolucion', '$acta_fecha', '$no_recibido_notificado_inspector', '$no_recibido_notificado_inspector_observacion', '$no_recibido_notificado_empresa', '$no_recibido_notificado_empresa_observacion', '$no_recibido_conforme', '$no_recibido_no_conforme', '$observaciones', 1, '".$user['id']."', '$registro_fecha', '$tipo'";
    $query .=")";
    if($db->query($query)){
      $ultimo_id = $db->insert_id(); 
    logs($user['id'],"recepciones",$ultimo_id,"Agrego una recepcion de obra");
      $session->msg('s',"Agregado exitosamente. ");
      redirect('recepciones', false);
    } else {
      $session->msg('d',' Lo siento, registro falló.');
      redirect('recepciones', false);
    }

 }



if(isset($_POST['editar_recepcion'])){
    $get_id = $db->escape($_POST['editar_recepcion']);
    $idnota = $db->escape($_POST['id_notas']);
    $idexpediente = $db->escape($_POST['id_expedientes']);
    $nombre_obras  = $db->escape($_POST['nombre_obras']);
    $expediente  = clean($db->escape($_POST['expediente']));
    $obra  = $db->escape($_POST['obra']);
    $expediente_obra  = $db->escape($_POST['expediente_obra']);
    $fecha_pedido  = clean($db->escape($_POST['fecha_pedido']));
    $documentacion_planos = $db->escape($_POST['documentacion_planos']);
    if(!empty($documentacion_planos)){ echo $documentacion_planos_fecha = make_date(); }else{ $documentacion_planos_fecha = '';}
    $documentacion_planos_observacion = $db->escape($_POST['documentacion_planos_observacion']);
    $documentacion_ensayos = $db->escape($_POST['documentacion_ensayos']);
    if(!empty($documentacion_ensayos)){ echo $documentacion_ensayos_fecha = make_date(); }else{ $documentacion_ensayos_fecha = '';}
    $documentacion_ensayos_observacion = $db->escape($_POST['documentacion_ensayos_observacion']);
    $documentacion_mas = $db->escape($_POST['documentacion_mas']);
    if(!empty($documentacion_mas)){ echo $documentacion_mas_fecha = make_date(); }else{ $documentacion_mas_fecha = '';}
    $documentacion_mas_observacion = $db->escape($_POST['documentacion_mas_observacion']);
    $confirmacion_documentacion_fecha = $db->escape($_POST['confirmacion_documentacion_fecha']);
    $confirmacion_documentacion_observacion = $db->escape($_POST['confirmacion_documentacion_observacion']);
    $integrantes_resolucion_fecha  = clean($db->escape($_POST['integrantes_resolucion_fecha']));
    $integrantes_resolucion_num   = clean($db->escape($_POST['integrantes_resolucion_num']));
    $comision_agente1 = $db->escape($_POST['comision_agente1']);
    $comision_agente1_notificado = $db->escape($_POST['comision_agente1_notificado']);
    $comision_agente2 = $db->escape($_POST['comision_agente2']);
    $comision_agente2_notificado = $db->escape($_POST['comision_agente2_notificado']);
    $comision_agente3 = $db->escape($_POST['comision_agente3']);
    $comision_agente3_notificado = $db->escape($_POST['comision_agente3_notificado']);
    $comision_agente4 = $db->escape($_POST['comision_agente4']);
    $comision_agente4_notificado = $db->escape($_POST['comision_agente4_notificado']);
    $movilidad = $db->escape($_POST['movilidad']);
    $movilidad_observacion = $db->escape($_POST['movilidad_observacion']);
    if(!empty($movilidad_observacion)){ echo $movilidad_observacion_fecha = make_date(); }else{ $movilidad_observacion_fecha = '';}
    $recibido_estado = $db->escape($_POST['recibido_estado']);
    $recibido_notificado = $db->escape($_POST['recibido_notificado']);
    $recibido_notificado_observacion = $db->escape($_POST['recibido_notificado_observacion']);
    $acta_resolucion = $db->escape($_POST['acta_resolucion']);
    $acta_resolucion_proyecto = $db->escape($_POST['acta_resolucion_proyecto']);
    $acta_fecha = $db->escape($_POST['acta_fecha']);
    $no_recibido_notificado_inspector = $db->escape($_POST['no_recibido_notificado_inspector']);
    $no_recibido_notificado_inspector_observacion = $db->escape($_POST['no_recibido_notificado_inspector_observacion']);
    $no_recibido_notificado_empresa = $db->escape($_POST['no_recibido_notificado_empresa']);
    $no_recibido_notificado_empresa_observacion = $db->escape($_POST['no_recibido_notificado_empresa_observacion']);
    $no_recibido_conforme = $db->escape($_POST['no_recibido_conforme']);
    $no_recibido_no_conforme = $db->escape($_POST['no_recibido_no_conforme']);
    $observaciones   = clean($db->escape($_POST['observaciones']));
    $tipo   = clean($db->escape($_POST['tipo']));
    $registro_fecha    = make_date();
    $query  = "UPDATE recepciones SET
    idnotas = '$idnota', 
    idexpedientes = '$idexpediente', 
    nombre_obras = '$nombre_obras', 
    expediente = '$expediente', 
    obra = '$obra', 
    expediente_obra = '$expediente_obra', 
    fecha_pedido = '$fecha_pedido', 
    documentacion_planos = '$documentacion_planos', 
    documentacion_planos_fecha = '$documentacion_planos_fecha', 
    documentacion_planos_observacion = '$documentacion_planos_observacion', 
    documentacion_ensayos = '$documentacion_ensayos', 
    documentacion_ensayos_fecha = '$documentacion_ensayos_fecha', 
    documentacion_ensayos_observacion = '$documentacion_ensayos_observacion', 
    documentacion_mas = '$documentacion_mas', 
    documentacion_mas_fecha = '$documentacion_mas_fecha', 
    documentacion_mas_observacion = '$documentacion_mas_observacion', 
    confirmacion_documentacion_fecha = '$confirmacion_documentacion_fecha', 
    confirmacion_documentacion_observacion = '$confirmacion_documentacion_observacion', 
    integrantes_resolucion_fecha = '$integrantes_resolucion_fecha', 
    integrantes_resolucion_num = '$integrantes_resolucion_num', 
    comision_agente1 = '$comision_agente1', 
    comision_agente1_notificado = '$comision_agente1_notificado', 
    comision_agente2 = '$comision_agente2', 
    comision_agente2_notificado = '$comision_agente2_notificado', 
    comision_agente3 = '$comision_agente3', 
    comision_agente3_notificado = '$comision_agente3_notificado', 
    comision_agente4 = '$comision_agente4', 
    comision_agente4_notificado = '$comision_agente4_notificado', 
    movilidad = '$movilidad', 
    movilidad_observacion = '$movilidad_observacion', 
    movilidad_observacion_fecha = '$movilidad_observacion_fecha', 
    recibido_estado = '$recibido_estado', 
    recibido_notificado = '$recibido_notificado', 
    recibido_notificado_observacion = '$recibido_notificado_observacion', 
    acta_resolucion = '$acta_resolucion', 
    acta_resolucion_proyecto = '$acta_resolucion_proyecto', 
    acta_fecha = '$acta_fecha', 
    no_recibido_notificado_inspector = '$no_recibido_notificado_inspector', 
    no_recibido_notificado_inspector_observacion = '$no_recibido_notificado_inspector_observacion', 
    no_recibido_notificado_empresa = '$no_recibido_notificado_empresa', 
    no_recibido_notificado_empresa_observacion = '$no_recibido_notificado_empresa_observacion', 
    no_recibido_conforme = '$no_recibido_conforme', 
    no_recibido_no_conforme = '$no_recibido_no_conforme', 
    observaciones = '$observaciones',
    registro_usuario = '".$user['id']."', 
    registro_fecha = '$registro_fecha' ,
    tipo = '$tipo' 
    WHERE idrecepciones='$get_id'";
  if($db->query($query)){
     logs($user['id'],"recepciones",$get_id,"Edito una recepcion de obra");
    $session->msg('s',"Dato actualizado. ");
      redirect('recepciones', false);
  } else {
    $session->msg('d',' Lo siento, registro falló.');
      redirect('recepciones', false);
  }
 }

?>