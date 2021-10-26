<?php
require_once('../../includes/load.php');
$user = current_user();

if(isset($_POST['add_obra'])){
  $obra_id = $_GET['id'];
  $numero   = clean($db->escape($_POST['numero']));
  $expediente   = clean($db->escape($_POST['expediente']));
  $estado   = clean($db->escape($_POST['estado']));
  $observaciones  = clean($db->escape($_POST['observaciones']));
  $proyectista  = clean($db->escape($_POST['proyectista']));
  $titulo  = clean($db->escape($_POST['titulo']));
  $descripcion  = clean($db->escape($_POST['descripcion']));
  $longitud   = clean($db->escape($_POST['longitud']));
  $ubicacion  = clean($db->escape($_POST['ubicacion']));
  $plan_de_trabajo  = clean($db->escape($_POST['plan_de_trabajo']));
  $cotizacion  = clean($db->escape($_POST['cotizacion']));
  $certificado_vencimiento   = clean($db->escape($_POST['certificado_vencimiento']));  
  $memoria_descriptiva   = clean($db->escape($_POST['memoria_descriptiva']));  
  $memoria_descriptiva_vigente   = clean($db->escape($_POST['memoria_descriptiva_vigente']));  
  $proyecto_monto   = clean($db->escape($_POST['proyecto_monto']));
  $proyecto_monto_fecha  = clean($db->escape($_POST['proyecto_monto_fecha']));    
  $proyecto_plazo   = clean($db->escape($_POST['proyecto_plazo']));
  $plazo_garantia  = clean($db->escape($_POST['plazo_garantia']));
  $aprobacion_res_fecha  = clean($db->escape($_POST['aprobacion_res_fecha']));
  $aprobacion_res_num  = clean($db->escape($_POST['aprobacion_res_num']));
  $adjudicacion_res_fecha  = clean($db->escape($_POST['adjudicacion_res_fecha']));
  $adjudicacion_res_num  = clean($db->escape($_POST['adjudicacion_res_num']));    
  $contratista  = clean($db->escape($_POST['contratista']));
  $tipo_contratacion  = clean($db->escape($_POST['tipo_contratacion']));
  $tipo_financiamiento  = clean($db->escape($_POST['tipo_financiamiento']));
  $contrato_fecha  = clean($db->escape($_POST['contrato_fecha']));
  $fecha_inicio = $_POST['fecha_inicio'];
  $fecha_fin = $_POST['fecha_fin'];
  $fecha_fin_no_define = clean($db->escape($_POST['fecha_fin_no_define']));
  $idinspector = clean($db->escape($_POST['idinspector']));
  $contrato_monto  = clean($db->escape($_POST['contrato_monto']));
  $contrato_plazo  = clean($db->escape($_POST['contrato_plazo'])); 

  $anticipo_financiero = clean($db->escape($_POST['anticipo_financiero']));
  $valor_anticipo_financiero = clean($db->escape($_POST['valor_anticipo_financiero']));

  $monto_vigente  = clean($db->escape($_POST['monto_vigente']));
  $plazo_vigente  = clean($db->escape($_POST['plazo_vigente'])); 
  $monto_vigente_obs  = clean($db->escape($_POST['monto_vigente_obs']));
  $plazo_vigente_obs  = clean($db->escape($_POST['plazo_vigente_obs'])); 
  $monto_redeterminado  = clean($db->escape($_POST['monto_redeterminado']));
  $info_redeterminacion  = clean($db->escape($_POST['info_redeterminacion']));
  $idestado_finalizado = clean($db->escape($_POST['idestado_finalizado']));
  $registro_fecha    = make_date();
  $query  = "INSERT INTO obras (";
  $query .="nombre, descripcion, ubicacion, numero, expediente, proyecto_monto, proyecto_monto_fecha, proyecto_plazo, longitud, fecha_inicio, fecha_fin, fecha_fin_no_define, estado, observaciones, proyectista, memoria_descriptiva, memoria_descriptiva_vigente, plazo_garantia, contratista, tipo_contratacion, aprobacion_res_num, aprobacion_res_fecha, adjudicacion_res_num, adjudicacion_res_fecha, tipo_financiamiento, contrato_fecha, contrato_monto, contrato_plazo, monto_vigente, monto_vigente_obs, plazo_vigente, plazo_vigente_obs, monto_redeterminado, info_redeterminacion, idinspector, idtipo, registro_usuario, registro_fecha, condicion, finalizado, certificado_vencimiento, anticipo_financiero, valor_anticipo_financiero";
  $query .=") VALUES (";
  $query .=" '{$titulo}', '{$descripcion}', '{$ubicacion}', '{$numero}', '{$expediente}', '{$proyecto_monto}', '{$proyecto_monto_fecha}', '{$proyecto_plazo}', '{$longitud}','{$fecha_inicio}','{$fecha_fin}', '{$fecha_fin_no_define}', '{$estado}','{$observaciones}','{$proyectista}', '{$memoria_descriptiva}', '{$memoria_descriptiva_vigente}', '{$plazo_garantia}', '{$contratista}', '{$tipo_contratacion}', '{$aprobacion_res_num}', '{$aprobacion_res_fecha}', '{$adjudicacion_res_num}', '{$adjudicacion_res_fecha}','{$tipo_financiamiento}', '{$contrato_fecha}', '{$contrato_monto}','{$contrato_plazo}', '{$monto_vigente}', '{$monto_vigente_obs}', '{$plazo_vigente}', '{$plazo_vigente_obs}', '{$monto_redeterminado}', '{$info_redeterminacion}', '{$idinspector}', '0', '".$user['id']."', '{$registro_fecha}', '1', '{$idestado_finalizado}', '{$certificado_vencimiento}', '{$anticipo_financiero}', '{$valor_anticipo_financiero}' ";
  $query .=");";
  if($db->query($query)){
    $ultimo_id = $db->insert_id(); 
    logs($user['id'],"obra",$ultimo_id,"Agrego una obra");
      mkdir("../../../uploads/Obras/".$ultimo_id, 0777);
      mkdir("../../../uploads/Obras/".$ultimo_id."/Archivo", 0777);
      mkdir("../../../uploads/Obras/".$ultimo_id."/Archivo/1-Pliego completo", 0777);
      mkdir("../../../uploads/Obras/".$ultimo_id."/Archivo/2-Resolucion aprobacion", 0777);
      mkdir("../../../uploads/Obras/".$ultimo_id."/Archivo/3-Resolucion adjudicacion", 0777);
      mkdir("../../../uploads/Obras/".$ultimo_id."/Archivo/4-Contrato", 0777);
      mkdir("../../../uploads/Obras/".$ultimo_id."/Archivo/5-Acta de inicio", 0777);
      mkdir("../../../uploads/Obras/".$ultimo_id."/Inspeccion", 0777);
      mkdir("../../../uploads/Obras/".$ultimo_id."/Inspeccion/Certificados/", 0777);
      mkdir("../../../uploads/Obras/".$ultimo_id."/Inspeccion/Personal/", 0777);
      mkdir("../../../uploads/Obras/".$ultimo_id."/Certificaciones", 0777);
      mkdir("../../../uploads/Obras/".$ultimo_id."/Certificaciones/Certificados", 0777);
      mkdir("../../../uploads/Obras/".$ultimo_id."/Certificaciones/Redeterminados", 0777);
      redirect('obras', false);
  } else {
    $session->msg('d',' Lo siento, registro falló.');
    redirect('obras', false);
  }
}

if(isset($_POST['edit_obra'])){
  $obra_id = $_GET['id'];
  $obra = find_by_id('obras','idobras',$obra_id);
  $numero   = clean($db->escape($_POST['numero']));
  $plan_de_trabajo  = clean($db->escape($_POST['plan_de_trabajo']));
  $cotizacion  = clean($db->escape($_POST['cotizacion']));
  $expediente   = clean($db->escape($_POST['expediente']));
  $estado   = clean($db->escape($_POST['estado']));
  $observaciones  = clean($db->escape($_POST['observaciones']));
  $proyectista  = clean($db->escape($_POST['proyectista']));
  $titulo  = clean($db->escape($_POST['titulo']));
  $descripcion  = clean($db->escape($_POST['descripcion']));
  $longitud   = clean($db->escape($_POST['longitud']));
  $ubicacion  = clean($db->escape($_POST['ubicacion']));
  $certificado_vencimiento  = clean($db->escape($_POST['certificado_vencimiento']));
  $memoria_descriptiva   = $_POST['memoria_descriptiva']; 
  $memoria_descriptiva_vigente   = clean($db->escape($_POST['memoria_descriptiva_vigente']));  
  $proyecto_monto   = clean($db->escape($_POST['proyecto_monto']));
  $proyecto_monto_fecha  = clean($db->escape($_POST['proyecto_monto_fecha']));    
  $proyecto_plazo   = clean($db->escape($_POST['proyecto_plazo']));
  $plazo_garantia  = clean($db->escape($_POST['plazo_garantia']));
  $aprobacion_res_fecha  = clean($db->escape($_POST['aprobacion_res_fecha']));
  $aprobacion_res_num  = clean($db->escape($_POST['aprobacion_res_num']));
  $adjudicacion_res_fecha  = clean($db->escape($_POST['adjudicacion_res_fecha']));
  $adjudicacion_res_num  = clean($db->escape($_POST['adjudicacion_res_num']));    
  $contratista  = clean($db->escape($_POST['contratista']));
  $tipo_contratacion  = clean($db->escape($_POST['tipo_contratacion']));
  $tipo_financiamiento  = clean($db->escape($_POST['tipo_financiamiento']));
  $contrato_fecha  = clean($db->escape($_POST['contrato_fecha']));
  $fecha_inicio = clean($db->escape($_POST['fecha_inicio']));
  $fecha_fin = $_POST['fecha_fin'];
  $fecha_fin_no_define = $_POST['fecha_fin_no_define'];
  $idinspector = clean($db->escape($_POST['idinspector']));
  $contrato_monto  = clean($db->escape($_POST['contrato_monto']));
  $contrato_plazo  = clean($db->escape($_POST['contrato_plazo'])); 
    $anticipo_financiero = clean($db->escape($_POST['anticipo_financiero']));
  $valor_anticipo_financiero = clean($db->escape($_POST['valor_anticipo_financiero']));
  $monto_vigente  = clean($db->escape($_POST['monto_vigente']));
  $plazo_vigente  = clean($db->escape($_POST['plazo_vigente'])); 
  $monto_vigente_obs  = clean($db->escape($_POST['monto_vigente_obs']));
  $plazo_vigente_obs  = clean($db->escape($_POST['plazo_vigente_obs'])); 
  $monto_redeterminado  = clean($db->escape($_POST['monto_redeterminado']));
  $info_redeterminacion  = clean($db->escape($_POST['info_redeterminacion']));
  $idestado_finalizado = clean($db->escape($_POST['idestado_finalizado']));
  $registro_fecha    = make_date();

  $query   = "UPDATE obras SET";
  $query  .=" 
  numero='{$numero}', 
  expediente = '{$expediente}', 
  estado = '{$estado}', 
  observaciones = '{$observaciones}', 
  proyectista = '{$proyectista}', 
  nombre = '{$titulo}', 
  descripcion = '{$descripcion}', 
  longitud = '{$longitud}', 
  ubicacion = '{$ubicacion}', 
  memoria_descriptiva = '".mysql_real_escape_string($memoria_descriptiva)."', 
  memoria_descriptiva_vigente = '".mysql_real_escape_string($memoria_descriptiva_vigente)."', 
  proyecto_monto = '{$proyecto_monto}',
  proyecto_monto_fecha = '{$proyecto_monto_fecha}', 
  proyecto_plazo = '{$proyecto_plazo}', 
  plazo_garantia ='{$plazo_garantia}', 
  contratista ='{$contratista}', 
  tipo_contratacion ='{$tipo_contratacion}', 
  aprobacion_res_fecha ='{$aprobacion_res_fecha}', 
  aprobacion_res_num ='{$aprobacion_res_num}',
  adjudicacion_res_fecha ='{$adjudicacion_res_fecha}', 
  adjudicacion_res_num ='{$adjudicacion_res_num}', 
  tipo_financiamiento ='{$tipo_financiamiento}', 
  fecha_inicio ='{$fecha_inicio}', 
  fecha_fin ='{$fecha_fin}', 
  fecha_fin_no_define = '{$fecha_fin_no_define}',
  idinspector ='{$idinspector}', 
  contrato_fecha ='{$contrato_fecha}', 
  contrato_monto ='{$contrato_monto}', 
  contrato_plazo = '{$contrato_plazo}', 
  monto_vigente = '{$monto_vigente}', 
  monto_vigente_obs = '{$monto_vigente_obs}', 
  plazo_vigente = '{$plazo_vigente}', 
  plazo_vigente_obs = '{$plazo_vigente_obs}', 
  monto_redeterminado = '{$monto_redeterminado}', 
  info_redeterminacion = '{$info_redeterminacion}', 
  registro_usuario = '".$user['id']."', 
  registro_fecha = '{$registro_fecha}',
  finalizado = '{$idestado_finalizado}',
  certificado_vencimiento = '{$certificado_vencimiento}',
  anticipo_financiero = '{$anticipo_financiero}',
  idplanes_de_trabajo = '{$plan_de_trabajo}',
  idcotizaciones = '{$cotizacion}',
  valor_anticipo_financiero = '{$valor_anticipo_financiero}'";
  $query  .=" WHERE idobras ='{$obra_id}';";
  $query_mapa   = "UPDATE mapa_linea SET estado = $estado WHERE idobras = $obra_id";
  
  $res_obra = find_by_id('obras','idobras',$obra_id);
  if($res_obra['memoria_descriptiva_vigente'] != $memoria_descriptiva_vigente){
  $query_memoria   = $db->query("INSERT INTO logs (idusuarios,tipo,dato,evento,memoria,fecha) VALUES ({$user['id']},
    'obra',
    {$obra_id},
    'Edito memoria vigente',
    '".mysql_real_escape_string($res_obra['memoria_descriptiva_vigente'])."',
    '{$registro_fecha}');");
  }
  $result = $db->query($query);
  $result_mapa = $db->query($query_mapa);
  if($result){
      mkdir("../../../uploads/Obras/".$obra_id, 0777);
      mkdir("../../../uploads/Obras/".$obra_id."/Tramites", 0777);
      mkdir("../../../uploads/Obras/".$obra_id."/Archivo", 0777);
      mkdir("../../../uploads/Obras/".$obra_id."/Archivo/1-Pliego completo", 0777);
      mkdir("../../../uploads/Obras/".$obra_id."/Archivo/2-Resolucion aprobacion", 0777);
      mkdir("../../../uploads/Obras/".$obra_id."/Archivo/3-Resolucion adjudicacion", 0777);
      mkdir("../../../uploads/Obras/".$obra_id."/Archivo/4-Contrato", 0777);
      mkdir("../../../uploads/Obras/".$obra_id."/Archivo/5-Acta de inicio", 0777);
      mkdir("../../../uploads/Obras/".$obra_id."/Inspeccion", 0777);
      mkdir("../../../uploads/Obras/".$obra_id."/Inspeccion/Certificados/", 0777);
      mkdir("../../../uploads/Obras/".$obra_id."/Inspeccion/Personal/", 0777);
      mkdir("../../../uploads/Obras/".$obra_id."/Certificaciones", 0777);
      mkdir("../../../uploads/Obras/".$obra_id."/Certificaciones/Certificados", 0777);
      mkdir("../../../uploads/Obras/".$obra_id."/Certificaciones/Redeterminados", 0777);

    logs($user['id'],"obra",$obra_id,"Edito una obra"); 
    redirect('obra?id='.$obra_id, false);
  } else {
    redirect('obra?id='.$obra_id, false);
  }
}

if(isset($_POST['obra_bacheo'])){
  $obra_id = $_GET['id'];
  $bacheo = clean($db->escape($_POST['bacheo']));
  $query  = "UPDATE obras SET bacheo='{$bacheo}' WHERE idobras='{$obra_id}'";
  if($db->query($query)){
    logs($user['id'],"cuadrilla-bacheo",$obra_id,"Asigno obra a cuadrilla de bacheo");
    $session->msg('s',"Agregado exitosamente. ");
    redirect('obra.php?id='.$obra_id, false);
  } else {
    $session->msg('d',' Lo siento, registro falló.');
  }
}

if(isset($_POST['modificaciones'])){
  $obra_id = $_GET['id'];
  $carpeta= '/'; // Directorio principal
  opendir($carpeta); // Iniciamos en el directorio princiapl
  $dir_obras = $_SERVER["DOCUMENT_ROOT"].'/construcciones/public/uploads/Obras/'.$obra_id;
  $directorio = 'Tramites/Modificaciones'; //Declaramos un  variable con la ruta donde guardaremos los archivos
  if(!file_exists($dir_obras.'/Tramites')){
    mkdir($dir_obras.'/Tramites', 0755) or die("No se puede crear el directorio Tramites");	
  }
   if(!file_exists($dir_obras.'/'.$directorio)){
    mkdir($dir_obras.'/'.$directorio, 0755) or die("No se puede crear el directorio Modificaciones");	
  }


  $idmodificaciones = $_POST['idmodificaciones'];
  $numero = $_POST['numero'];
  $expediente = $_POST['expediente'];
  $estado = $_POST['estado'];
  $resolucion_fecha = $_POST['resolucion_fecha'];
  $resolucion_numero = $_POST['resolucion_numero'];
  $descripcion = $_POST['descripcion'];
  $monto = $_POST['monto'];
  $monto_final = $_POST['monto_final'];
  $computo_estado = $_POST['computo_estado'];
  $computo_fecha = $_POST['computo_fecha'];
  $precios_estado = $_POST['precios_estado'];
  $precios_fecha = $_POST['precios_fecha'];
  $observaciones = $_POST['observaciones'];
  $cantidad = count($_POST['numero']);
  $i=0;
  $update = '';
foreach ($_POST as $indice=>$cadena) { 
$$indice = $cadena[$i]; 
while($i<$cantidad){  
  if($_POST['estado'][$i] == 0){

 $update .= $db->query("DELETE FROM obras_modificaciones WHERE idmodificaciones=".$_POST['idmodificaciones'][$i]."; "); 
   logs($user['id'],"modificacion-obra",$_POST['idmodificaciones'][$i],"Elimino modificacion de obra");
  }elseif($_POST['estado'][$i] != 0){
 $update .= $db->query("UPDATE obras_modificaciones SET numero='".$_POST['numero'][$i]."', expediente='".$_POST['expediente'][$i]."', estado='".$_POST['estado'][$i]."', resolucion_fecha='".$_POST['resolucion_fecha'][$i]."',resolucion_numero='".$_POST['resolucion_numero'][$i]."', descripcion='".mysql_real_escape_string($_POST['descripcion'][$i])."', monto='".$_POST['monto'][$i]."', monto_final='".$_POST['monto_final'][$i]."', computo_estado='".$_POST['computo_estado'][$i]."', computo_fecha='".$_POST['computo_fecha'][$i]."', precios_estado='".$_POST['precios_estado'][$i]."', precios_fecha='".$_POST['precios_fecha'][$i]."', observaciones='".$_POST['observaciones'][$i]."' WHERE idmodificaciones=".$_POST['idmodificaciones'][$i]."; "); 
  logs($user['id'],"modificacion-obra",$_POST['idmodificaciones'][$i],"Edito modificacion de obra");
}
 $i++; 
}
}
$update .= '';
if(isset($_POST['add_numero'])){
  $obra_id = $_GET['id'];
  $add_idmodificaciones = $_POST['add_idmodificaciones'];
  $add_numero = $_POST['add_numero'];
  $add_expediente = $_POST['add_expediente'];
  $add_estado = $_POST['add_estado'];
  $add_resolucion_fecha = $_POST['add_resolucion_fecha'];
  $add_resolucion_numero = $_POST['add_resolucion_numero'];
  $add_monto = $_POST['add_monto'];
  $add_monto_final = $_POST['add_monto_final'];
  $add_porcentaje_monto = $_POST['add_porcentaje_monto'];  
  $add_descripcion = $_POST['add_descripcion'];
  $add_computo_estado = $_POST['add_computo_estado'];
  $add_computo_fecha = $_POST['add_computo_fecha'];
  $add_precios_estado = $_POST['add_precios_estado'];
  $add_precios_fecha = $_POST['add_precios_fecha'];
  $add_observaciones = $_POST['add_observaciones'];
  if($add_estado == 0){
    $insert = "DELETE FROM obras_modificaciones WHERE idmodificaciones=".$obra_id;
   logs($user['id'],"modificacion-obra",$obra_id,"Elimino modificacion de obra");
  }elseif($add_estado != 0){  
  $insert = "INSERT INTO obras_modificaciones (idobras, numero, expediente, estado, resolucion_numero, resolucion_fecha, monto, monto_final, descripcion, computo_estado, computo_fecha, precios_estado, precios_fecha, observaciones, condicion) VALUES ('$obra_id','$add_numero','$add_expediente','$add_estado','$add_resolucion_numero','$add_resolucion_fecha','$add_monto','$add_monto_final','".mysql_real_escape_string($add_descripcion)."','$add_computo_estado','$add_computo_fecha','$add_precios_estado','$add_precios_fecha','$add_observaciones',1);";
}
}

  if($db->query($insert)){
    $ultimo_id = $db->insert_id(); 
    logs($user['id'],"modificacion-obra",$ultimo_id,"Agrego una modificacion de obra");
		header('Location:' . getenv('HTTP_REFERER'));
  } else {	
		header('Location:' . getenv('HTTP_REFERER'));
  }
}

if(isset($_POST['ampliaciones'])){  
  $obra_id = $_GET['id'];
  $carpeta= '/'; // Directorio principal
  opendir($carpeta); // Iniciamos en el directorio princiapl
  $dir_obras = $_SERVER["DOCUMENT_ROOT"].'/construcciones/public/uploads/Obras/'.$obra_id;
  $directorio = 'Tramites/Ampliaciones'; //Declaramos un  variable con la ruta donde guardaremos los archivos
  if(!file_exists($dir_obras.'/Tramites')){
    mkdir($dir_obras.'/Tramites', 0755) or die("No se puede crear el directorio Tramites");	
  }
   if(!file_exists($dir_obras.'/'.$directorio)){
    mkdir($dir_obras.'/'.$directorio, 0755) or die("No se puede crear el directorio Ampliaciones");	
  }


  $idampliaciones = $_POST['idampliaciones'];
  $numero = $_POST['numero'];
  $expediente = $_POST['expediente'];
  $estado = $_POST['estado'];
  $resolucion_fecha = $_POST['resolucion_fecha'];
  $resolucion_numero = $_POST['resolucion_numero'];
  $descripcion = $_POST['descripcion'];
  $cantidad = count($_POST['numero']);
  $i=0;
  $update = '';
foreach ($_POST as $indice=>$cadena) { 
$$indice = $cadena[$i]; 
while($i<$cantidad){  
  if($_POST['estado'][$i] == 0){
 $update .= $db->query("DELETE FROM obras_ampliaciones WHERE idampliaciones=".$_POST['idampliaciones'][$i]."; "); 
    logs($user['id'],"ampliacion-obra",$_POST['idampliaciones'][$i],"Elimino ampliacion de obra");
    $user_activity = registro($user['id'],"Eliminio una ampliacion de obra"); 
  }elseif($_POST['estado'][$i] != 0){
 $update .= $db->query("UPDATE obras_ampliaciones SET numero='".$_POST['numero'][$i]."', expediente='".$_POST['expediente'][$i]."', estado='".$_POST['estado'][$i]."', resolucion_fecha='".$_POST['resolucion_fecha'][$i]."',resolucion_numero='".$_POST['resolucion_numero'][$i]."',plazo='".$_POST['plazo'][$i]."', fecha_plazo='".$_POST['fecha_plazo'][$i]."', plazo_final='".$_POST['plazo_final'][$i]."', fecha_plazo_final='".$_POST['fecha_plazo_final'][$i]."', descripcion='".$_POST['descripcion'][$i]."' WHERE idampliaciones=".$_POST['idampliaciones'][$i]."; ");
     logs($user['id'],"ampliacion-obra",$_POST['idampliaciones'][$i],"Edito ampliacion de obra"); 
} 
 $i++;
}
}
$update .= '';
if(isset($_POST['add_numero'])){
  $obra_id = $_GET['id'];
  $add_idampliaciones = $_POST['add_idampliaciones'];
  $add_numero = $_POST['add_numero'];
  $add_expediente = $_POST['add_expediente'];
  $add_estado = $_POST['add_estado'];
  $add_resolucion_fecha = $_POST['add_resolucion_fecha'];
  $add_resolucion_numero = $_POST['add_resolucion_numero'];
  $add_plazo = $_POST['add_plazo'];
  $add_fecha_plazo = $_POST['add_fecha_plazo'];
  $add_plazo_final = $_POST['add_plazo_final'];
  $add_fecha_plazo_final = $_POST['add_fecha_plazo_final'];
  $add_descripcion = $_POST['add_descripcion'];
  if($add_estado == 0){
    $insert = "DELETE FROM obras_ampliaciones WHERE idampliaciones=".$obra_id;
        logs($user['id'],"ampliacion-obra",$obra_id,"Elimino ampliacion de obra");
  }elseif($add_estado != 0){  
  $insert = "INSERT INTO obras_ampliaciones (idobras, numero, expediente, estado, resolucion_numero, resolucion_fecha, plazo, fecha_plazo, plazo_final, fecha_plazo_final, descripcion, condicion) VALUES ('$obra_id','$add_numero','$add_expediente','$add_estado','$add_resolucion_numero','$add_resolucion_fecha','$add_plazo','$add_fecha_plazo','$add_plazo_final','$add_fecha_plazo_final','$add_descripcion',1);";
}
}
  if($db->query($insert)){
        $ultimo_id = $db->insert_id(); 
    logs($user['id'],"ampliacion-obra",$ultimo_id,"Agrego una ampliacion de obra");	
		header('Location:' . getenv('HTTP_REFERER'));
  } else {	
		header('Location:' . getenv('HTTP_REFERER'));
  }
}















if(isset($_POST['neutralizaciones'])){
  $obra_id = $_GET['id'];  
  $carpeta= '/'; // Directorio principal
  opendir($carpeta); // Iniciamos en el directorio princiapl
  $dir_obras = $_SERVER["DOCUMENT_ROOT"].'/construcciones/public/uploads/Obras/'.$obra_id;
  $directorio = 'Tramites/Neutralizaciones'; //Declaramos un  variable con la ruta donde guardaremos los archivos
  if(!file_exists($dir_obras.'/Tramites')){
    mkdir($dir_obras.'/Tramites', 0755) or die("No se puede crear el directorio Tramites");	
  }
  if(!file_exists($dir_obras.'/'.$directorio)){
    mkdir($dir_obras.'/'.$directorio, 0755) or die("No se puede crear el directorio Neutralizaciones");	
  }
  

  $idneutralizaciones = $_POST['idneutralizaciones'];
  $numero = $_POST['numero'];
  $expediente = $_POST['expediente'];
  $estado = $_POST['estado'];
  $resolucion_fecha = $_POST['resolucion_fecha'];
  $resolucion_numero = $_POST['resolucion_numero'];
  $descripcion = $_POST['descripcion'];
  $cantidad = count($_POST['numero']);
  $i=0;
  $update = '';
foreach ($_POST as $indice=>$cadena) { 
$$indice = $cadena[$i]; 
while($i<$cantidad){  
  if($_POST['estado'][$i] == 0){
 $update .= $db->query("DELETE FROM obras_neutralizaciones WHERE idneutralizaciones=".$_POST['idneutralizaciones'][$i]."; "); 
     logs($user['id'],"neutralizacion-obra",$_POST['idneutralizaciones'][$i],"Elimino neutralizacion de obra");
  }elseif($_POST['estado'][$i] != 0){
 $update .= $db->query("UPDATE obras_neutralizaciones SET numero='".$_POST['numero'][$i]."', expediente='".$_POST['expediente'][$i]."', estado='".$_POST['estado'][$i]."', fecha_inicio='".$_POST['fecha_inicio'][$i]."', resolucion_fecha='".$_POST['resolucion_fecha'][$i]."',resolucion_numero='".$_POST['resolucion_numero'][$i]."', descripcion='".$_POST['descripcion'][$i]."' WHERE idneutralizaciones=".$_POST['idneutralizaciones'][$i]."; ");      
 logs($user['id'],"neutralizacion-obra",$_POST['idneutralizaciones'][$i],"Edito neutralizacion de obra");
} 
 $i++;
}
}
$update .= '';
if(isset($_POST['add_numero'])){
  $obra_id = $_GET['id'];
  $add_idneutralizaciones = $_POST['add_idneutralizaciones'];
  $add_numero = $_POST['add_numero'];
  $add_expediente = $_POST['add_expediente'];
  $add_estado = $_POST['add_estado'];
  $add_fecha_inicio = $_POST['add_fecha_inicio'];
  $add_resolucion_fecha = $_POST['add_resolucion_fecha'];
  $add_resolucion_numero = $_POST['add_resolucion_numero'];
  $add_descripcion = $_POST['add_descripcion'];
  if($add_estado == 0){
    $insert = "DELETE FROM obras_neutralizaciones WHERE idneutralizaciones=".$obra_id;
         logs($user['id'],"neutralizacion-obra",$obra_id,"Elimino neutralizacion de obra");
  }elseif($add_estado != 0){  
  $insert = "INSERT INTO obras_neutralizaciones (idobras, numero, expediente, estado, fecha_inicio, resolucion_numero, resolucion_fecha, descripcion, condicion) VALUES ('$obra_id','$add_numero','$add_expediente','$add_estado','$add_fecha_inicio','$add_resolucion_numero','$add_resolucion_fecha','$add_descripcion',1);";
}
}
  if($db->query($insert)){
        $ultimo_id = $db->insert_id(); 
    logs($user['id'],"neutralizacion-obra",$ultimo_id,"Agrego una neutralizacion");
		header('Location:' . getenv('HTTP_REFERER'));
  } else {	
		header('Location:' . getenv('HTTP_REFERER'));
  }
}

if(isset($_POST['add_bacheo'])){
    $obra_id = $_GET['id'];
    $fecha  = clean($db->escape($_POST['fecha']));
    $ubicacion = clean($db->escape($_POST['ubicacion']));
    $personal  = clean($db->escape($_POST['personal']));
    $proveedor   = clean($db->escape($_POST['proveedor']));
    $asfalto_m2   = clean($db->escape($_POST['asfalto-m2']));
    $asfalto_tn   = clean($db->escape($_POST['asfalto-tn']));
    $riego_m3   = clean($db->escape($_POST['riego-m3']));
    $riego_tn   = clean($db->escape($_POST['riego-tn']));    
    $date    = make_date();
    $query  = "INSERT INTO obras_bacheos (";
    $query .=" idobras,fecha,ubicacion,personal,asfalto-m2,asfalto-tn,riego-m3,riego-tn,proveedor,registro_usuario,registro_fecha";
    $query .=") VALUES (";
    $query .=" '{$obra_id}', '{$fecha}', '{$ubicacion}', '{$personal}', '{$asfalto_m2}', '{$asfalto_tn}', '{$riego_m3}', '{$riego_tn}', '{$proveedor}', '".$user['id']."', '{$date}'";
    $query .=")";
    if($db->query($query)){    
      $ultimo_id = $db->insert_id(); 
    logs($user['id'],"cuadrilla-bacheo",$ultimo_id,"Agrego una tarea de bacheo a obra");
      $session->msg('s',"Agregado exitosamente.");
      redirect('obra.php?id='.$obra_id, false);
    } else {
      $session->msg('d',' Lo siento, registro falló.');
      redirect('obra.php?id='.$obra_id, false);
    }
}

if(isset($_POST['montos_obra'])){
    $obra_id = $_GET['id'];
    $plan_de_trabajo  = clean($db->escape($_POST['plan_de_trabajo']));
    $cotizacion  = clean($db->escape($_POST['cotizacion']));
    $contrato_monto  = clean($db->escape($_POST['contrato_monto']));
    $monto_vigente  = clean($db->escape($_POST['monto_vigente']));
    $monto_vigente_obs  = clean($db->escape($_POST['monto_vigente_obs']));
    $plazo_vigente = clean($db->escape($_POST['plazo_vigente']));
    $plazo_vigente_obs = clean($db->escape($_POST['plazo_vigente_obs']));
    $monto_redeterminado  = clean($db->escape($_POST['monto_redeterminado']));
    $info_redeterminacion  = clean($db->escape($_POST['info_redeterminacion']));   
    $memoria_descriptiva_vigente   = clean($db->escape($_POST['memoria_descriptiva_vigente'])); 
    $date    = make_date();
    $query   = "UPDATE obras SET ";
    $query  .= "monto_vigente = '{$monto_vigente}',
    idplanes_de_trabajo = '{$plan_de_trabajo}',
    idcotizaciones = '{$cotizacion}',
    contrato_monto = '{$contrato_monto}',
                memoria_descriptiva_vigente = '".mysql_real_escape_string($memoria_descriptiva_vigente)."', 
                monto_vigente_obs = '{$monto_vigente_obs}',
                plazo_vigente = '{$plazo_vigente}',
                plazo_vigente_obs = '{$plazo_vigente_obs}',
                monto_redeterminado = '{$monto_redeterminado}',
                info_redeterminacion= '{$info_redeterminacion}'
                WHERE idobras ='{$obra_id}';";
                $res_obra = find_by_id('obras','idobras',$obra_id);
                if($res_obra['memoria_descriptiva_vigente'] != $memoria_descriptiva_vigente){
                $query_memoria   = $db->query("INSERT INTO logs (idusuarios,tipo,dato,evento,memoria,fecha) VALUES ({$user['id']},
                  'obra',
                  {$obra_id},
                  'Edito memoria vigente',
                  '".mysql_real_escape_string($res_obra['memoria_descriptiva_vigente'])."',
                  '{$registro_fecha}');");
                }
    if($db->query($query)){
      logs($user['id'],"obra",$obra_id,"Modifico datos vigentes de obra");
      redirect('obra.php?id='.$obra_id, false);
    } else {
      $session->msg('d',' Lo siento, registro falló.');
      redirect('obra.php?id='.$obra_id, false);
    }
}

if(isset($_POST['datos_certificados'])){
  $obra_id = $_GET['id'];
  $plan_de_trabajo  = clean($db->escape($_POST['plan_de_trabajo']));
  $cotizacion  = clean($db->escape($_POST['cotizacion']));
  $valor_anticipo_financiero = clean($db->escape($_POST['valor_anticipo_financiero']));
  $certificado_vencimiento  = clean($db->escape($_POST['certificado_vencimiento']));
  $valor_multa  = clean($db->escape($_POST['valor_multa']));
  $monto_redeterminado  = clean($db->escape($_POST['monto_redeterminado']));
  $info_redeterminacion  = clean($db->escape($_POST['info_redeterminacion']));   
  $anticipo_financiero = clean($db->escape($_POST['anticipo_financiero']));
  $date    = make_date();
  $query   = "UPDATE obras SET ";
  $query  .= "valormulta = '{$valor_multa}',
  certificado_vencimiento = '{$certificado_vencimiento}',
  idplanes_de_trabajo = '{$plan_de_trabajo}',
  idcotizaciones = '{$cotizacion}',
  anticipo_financiero = '{$anticipo_financiero}',
  valor_anticipo_financiero = '{$valor_anticipo_financiero}',
  monto_redeterminado = '{$monto_redeterminado}',
  info_redeterminacion= '{$info_redeterminacion}'
   WHERE idobras ='{$obra_id}';";
  if($db->query($query)){
    logs($user['id'],"obra",$obra_id,"Modifico datos de certificados de obra");
    redirect('obra.php?id='.$obra_id, false);
  } else {
    $session->msg('d',' Lo siento, registro falló.');
    redirect('obra.php?id='.$obra_id, false);
  }
}

if(isset($_POST['edit_valor_multa'])){
  $obra_id = $_GET['id'];
  $valor_multa  = clean($db->escape($_POST['valor_multa']));
  $date    = make_date();
  $query   = "UPDATE obras SET ";
  $query  .= "valormulta = '{$valor_multa}' WHERE idobras ='{$obra_id}';";
  if($db->query($query)){
    logs($user['id'],"obra",$obra_id,"Modifico valor de multa");
    $session->msg('s',"Modificado exitosamente.");
    redirect('obra.php?id='.$obra_id, false);
  } else {
    $session->msg('d',' Lo siento, registro falló.');
    redirect('obra.php?id='.$obra_id, false);
  }
}


if(isset($_POST['add_evento_timeline'])){
    $obra_id = $_GET['id'];
    $fecha  = clean($db->escape($_POST['fecha']));
    $evento = $_POST['evento'];
    $expediente  = clean($db->escape($_POST['expediente']));
    $observacion  = clean($db->escape($_POST['observacion']));   
    $date    = make_date();
    $query  = "INSERT INTO obras_resumen (idobras,fecha,evento,expediente,observacion) VALUES ('{$obra_id}', '{$fecha}', '{$evento}', '{$expediente}', '{$observacion}')";
    if($db->query($query)){
      $ultimo_id = $db->insert_id(); 
      logs($user['id'],"obra",$ultimo_id,"Agrego un evento en la linea de tiempo");
      $session->msg('s',"Agregado exitosamente.");
      redirect('obra.php?id='.$obra_id, false);
    } else {
      $session->msg('d',' Lo siento, registro falló.');
      redirect('obra.php?id='.$obra_id, false);
    }
}

if(isset($_POST['edit_evento_timeline'])){
    $obra_id = $_GET['id'];
    $id_referencia = (int)$_POST['id_referencia'];
    $fecha  = clean($db->escape($_POST['fecha']));
    $evento = clean($db->escape($_POST['evento']));
    $expediente  = clean($db->escape($_POST['expediente']));
    $observacion  = clean($db->escape($_POST['observacion']));   
    $date    = make_date();
    $query  = "UPDATE obras_resumen SET ";
    $query  .= "fecha = '{$fecha}',
                evento = '{$evento}',
                expediente = '{$expediente}',
                observacion = '{$observacion}' 
                 WHERE idobras ='{$id_referencia}';";
    if($db->query($query)){
      log($user['id'],"obra",$id_referencia,"Edito un evento en la linea de tiempo");
      $session->msg('s',"Editado exitosamente.");
      redirect('obra.php?id='.$obra_id, false);
    } else {
      $session->msg('d',' Lo siento, registro falló.');
      redirect('obra.php?id='.$obra_id, false);
    }
}

if(isset($_POST['eliminar_timeline'])){
      $obra_id = $_GET['id'];
    $id = clean($db->escape($_POST['eliminar_timeline']));
    $query = "DELETE FROM obras_resumen 
        WHERE idobras_resumen = '{$id}';";
      if($db->query($query)){
     logs($user['id'],"obra",$obra_id,"Elimino un evento en la linea de tiempo");
        $session->msg('s'," Se ha eliminado un evento.");
      redirect('obra.php?id='.$obra_id, false);
      } else {
        $session->msg('d',' No se pudo eliminar el evento.');
      redirect('obra.php?id='.$obra_id, false);
      }

  }
if(isset($_POST['idobras_alias'])){
  $id = clean($db->escape($_POST['idobras_alias']));
  $alias = $_POST['nombre_alias'];
  $query  = "UPDATE obras SET alias = '$alias' WHERE idobras = $id;";
  if($db->query($query)){
    logs($user['id'],"obra",$id,"Edito un alias de obra");
    $session->msg('s',"Dato actualizado. ");
    redirect('obras', false);
  } else {
    $session->msg('d',' Lo siento, registro falló.');
    redirect('obras', false);
  }
}


if(isset($_POST['designacion_inspeccion'])){
  $obra_id = $_POST['idobras'];
  $inspector = $_POST['inspector'];
  
  $query  = "UPDATE obras SET idinspector = '$inspector' WHERE idobras = $obra_id;";
  
  if($db->query($query)){
    $delete = $db->query("DELETE FROM obras_inspeccion_equipo WHERE idobras='".$obra_id."'");
    if(isset($_POST['equipo_inspectores'])){


      $cantidad = count($_POST['equipo_inspectores']);
      $i=0;
      $insert = '';
       foreach ($_POST as $indice=>$cadena) { 
       while($i<$cantidad){  
       $insert .= $db->query("INSERT INTO obras_inspeccion_equipo (idobras, idinspector, idusuario) VALUES ('".$obra_id."', '".$inspector."', '".$_POST['equipo_inspectores'][$i]."'); ");
       $i++; 
      }
      }
   $insert .= '';
    }



    if($db->query($delete) && $db->query($insert)){
    logs($user['id'],"obra",$obra_id,"Definio inspeccion de obra");      
    redirect('obra.php?id='.$obra_id, false);
    }
  }else{
    redirect('obra.php?id='.$obra_id, false);
  }
}

?>