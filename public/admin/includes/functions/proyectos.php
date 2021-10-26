<?php 
require_once('../../includes/load.php');
$user = current_user();

if(isset($_POST['add_proyecto'])){
    $obra_id = $_GET['id'];
    $numero  = clean($db->escape($_POST['numero']));
    $titulo  = clean($db->escape($_POST['titulo']));
    $descripcion  = clean($db->escape($_POST['descripcion']));
    $ubicacion  = clean($db->escape($_POST['ubicacion']));
    $memoria_descriptiva   = clean($db->escape($_POST['memoria_descriptiva']));    
    $proyecto_monto   = clean($db->escape($_POST['proyecto_monto']));
    $proyecto_monto_fecha  = clean($db->escape($_POST['proyecto_monto_fecha']));    
    $proyecto_plazo   = clean($db->escape($_POST['proyecto_plazo']));
    $longitud   = clean($db->escape($_POST['longitud']));
    $plazo_garantia  = clean($db->escape($_POST['plazo_garantia']));
    $expediente   = clean($db->escape($_POST['expediente']));
    $tramite   = clean($db->escape($_POST['tramite']));
    $prioridad   = clean($db->escape($_POST['prioridad']));
    $observaciones  = clean($db->escape($_POST['observaciones']));
    $proyectista  = clean($db->escape($_POST['proyectista']));
    $aprobacion_res_fecha  = clean($db->escape($_POST['aprobacion_res_fecha']));
    $aprobacion_res_num  = clean($db->escape($_POST['aprobacion_res_num']));
    $adjudicacion_res_fecha  = clean($db->escape($_POST['adjudicacion_res_fecha']));
    $adjudicacion_res_num  = clean($db->escape($_POST['adjudicacion_res_num']));    
    $contratista  = clean($db->escape($_POST['contratista']));
    $tipo_contratacion  = clean($db->escape($_POST['tipo_contratacion']));
    $tipo_financiamiento  = clean($db->escape($_POST['tipo_financiamiento']));
    $contrato_fecha  = clean($db->escape($_POST['contrato_fecha']));
    $contrato_monto  = clean($db->escape($_POST['contrato_monto']));
    $contrato_plazo  = clean($db->escape($_POST['contrato_plazo']));  
    
  $anticipo_financiero = clean($db->escape($_POST['anticipo_financiero']));
  $valor_anticipo_financiero = clean($db->escape($_POST['valor_anticipo_financiero']));
    $registro_fecha    = make_date();
if($user['iddepartamentos'] == 5){
    $query  = "INSERT INTO obras (";
    $query .=" nombre,descripcion,numero,ubicacion,expediente,proyecto_monto,proyecto_monto_fecha,proyecto_plazo,longitud,estado,tramite,prioridad,observaciones,memoria_descriptiva,plazo_garantia,idtipo,registro_usuario,registro_fecha,condicion";
    $query .=") VALUES (";
    $query .=" '{$titulo}', '{$descripcion}', '{$numero}', '{$ubicacion}', '{$expediente}', '{$proyecto_monto}','{$proyecto_monto_fecha}', '{$proyecto_plazo}', '{$longitud}', '1', '{$tramite}', '{$prioridad}','{$observaciones}','{$memoria_descriptiva}', '{$plazo_garantia}','1','".$user['id']."','{$registro_fecha}','1'";
    $query .=")";
}elseif($user['iddepartamentos'] == 6){
    $query  = "INSERT INTO obras (";
    $query .=" nombre,descripcion,numero,ubicacion,expediente,proyecto_monto,proyecto_monto_fecha,proyecto_plazo,longitud,estado,tramite,prioridad,observaciones,memoria_descriptiva,plazo_garantia,idtipo,registro_usuario,registro_fecha,condicion";
    $query .=") VALUES (";
    $query .=" '{$titulo}', '{$descripcion}', '{$numero}', '{$ubicacion}', '{$expediente}', '{$proyecto_monto}','{$proyecto_monto_fecha}', '{$proyecto_plazo}', '{$longitud}', '1', '{$tramite}', '{$prioridad}','{$observaciones}','{$memoria_descriptiva}', '{$plazo_garantia}','2','".$user['id']."','{$registro_fecha}','1'";
    $query .=")";
}elseif($user['iddireccion'] == 1){






    $query  = "INSERT INTO obras (";
    $query .=" 
    nombre,
    descripcion,
    numero,
    ubicacion,
    expediente,
    proyecto_monto,
    proyecto_monto_fecha,
    proyecto_plazo,
    longitud,
    estado,
    tramite,
    prioridad,
    observaciones,
    proyectista,
    memoria_descriptiva,
    plazo_garantia,
    contratista,
    tipo_contratacion,
    aprobacion_res_fecha,
    aprobacion_res_num,
    adjudicacion_res_fecha,
    adjudicacion_res_num,
    tipo_financiamiento,
    contrato_fecha,
    contrato_monto,
    contrato_plazo,
    anticipo_financiero,
    valor_anticipo_financiero,
    idtipo,
    registro_usuario,
    registro_fecha,
    condicion";
    $query .=") VALUES (";
    $query .=" '{$titulo}', '{$descripcion}', '0', '{$ubicacion}', '{$expediente}', '{$proyecto_monto}','{$proyecto_monto_fecha}', '{$proyecto_plazo}', '{$longitud}', '1', '{$tramite}', '{$prioridad}','{$observaciones}','{$proyectista}','{$memoria_descriptiva}', '{$plazo_garantia}','{$contratista}', '{$tipo_contratacion}', '{$aprobacion_res_fecha}', '{$aprobacion_res_num}', '{$adjudicacion_res_fecha}', '{$adjudicacion_res_num}', '{$tipo_financiamiento}', '{$contrato_fecha}', '{$contrato_monto}', '{$contrato_plazo}', '{$anticipo_financiero}', '{$valor_anticipo_financiero}', '0','".$user['id']."','{$registro_fecha}','1'";
    $query .=")";




}elseif($user['iddireccion'] == 8){
    $query  = "INSERT INTO obras (";
    $query .=" nombre,descripcion,numero,ubicacion,expediente,proyecto_monto,proyecto_monto_fecha,proyecto_plazo,longitud,estado,tramite,prioridad,observaciones,proyectista,memoria_descriptiva,plazo_garantia,contratista,tipo_contratacion,aprobacion_res_fecha,aprobacion_res_num,adjudicacion_res_fecha,adjudicacion_res_num,tipo_financiamiento,contrato_fecha,contrato_monto,contrato_plazo,idtipo,registro_usuario,registro_fecha,condicion";
    $query .=") VALUES (";
    $query .=" '{$titulo}', '{$descripcion}', '0', '{$ubicacion}', '{$expediente}', '{$proyecto_monto}','{$proyecto_monto_fecha}', '{$proyecto_plazo}', '{$longitud}', '1', '{$tramite}', '{$prioridad}','{$observaciones}','{$proyectista}','{$memoria_descriptiva}', '{$plazo_garantia}','{$contratista}', '{$tipo_contratacion}', '{$aprobacion_res_fecha}', '{$aprobacion_res_num}', '{$adjudicacion_res_fecha}', '{$adjudicacion_res_num}', '{$tipo_financiamiento}', '{$contrato_fecha}', '{$contrato_monto}', '{$contrato_plazo}', '3','".$user['id']."','{$registro_fecha}','1'";
    $query .=")";
}
    if($db->query($query)){
      $ultimo_id = $db->insert_id(); 
    logs($user['id'],"proyecto",$ultimo_id,"Agrego un proyecto");
        $session->msg('s',"Agregado exitosamente.");
        if($numero != 0){
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
            redirect('proyectos', false);
          }else{
            mkdir("../../../uploads/Obras/0/", 0777);
            redirect('proyectos', false);
          }
    } else {
        $session->msg('d',' Lo siento, registro falló.');
        redirect('proyectos', false);
    }
} 


if(isset($_POST['edit_proyecto'])){
    $obra_id = $_GET['id'];
    $titulo  = clean($db->escape($_POST['titulo']));
    $numero  = clean($db->escape($_POST['numero']));
    $descripcion  = clean($db->escape($_POST['descripcion']));
    $ubicacion  = clean($db->escape($_POST['ubicacion']));
    $memoria_descriptiva   = clean($db->escape($_POST['memoria_descriptiva']));    
    $proyecto_monto   = clean($db->escape($_POST['proyecto_monto']));
    $proyecto_monto_fecha  = clean($db->escape($_POST['proyecto_monto_fecha']));    
    $proyecto_plazo   = clean($db->escape($_POST['proyecto_plazo']));
    $longitud   = clean($db->escape($_POST['longitud']));
    $plazo_garantia  = clean($db->escape($_POST['plazo_garantia']));
    $expediente   = clean($db->escape($_POST['expediente']));
    $estado   = clean($db->escape($_POST['estado']));
    $tramite   = $db->escape($_POST['tramite']);
    $prioridad   = clean($db->escape($_POST['prioridad']));
    $observaciones  = clean($db->escape($_POST['observaciones']));
    $proyectista  = clean($db->escape($_POST['proyectista']));
    $aprobacion_res_fecha  = clean($db->escape($_POST['aprobacion_res_fecha']));
    $aprobacion_res_num  = clean($db->escape($_POST['aprobacion_res_num']));
    $adjudicacion_res_fecha  = clean($db->escape($_POST['adjudicacion_res_fecha']));
    $adjudicacion_res_num  = clean($db->escape($_POST['adjudicacion_res_num']));    
    $contratista  = clean($db->escape($_POST['contratista']));
    $tipo_contratacion  = clean($db->escape($_POST['tipo_contratacion']));
    $tipo_financiamiento  = clean($db->escape($_POST['tipo_financiamiento']));
    $contrato_fecha  = clean($db->escape($_POST['contrato_fecha']));
    $contrato_monto  = clean($db->escape($_POST['contrato_monto']));
    $contrato_plazo  = clean($db->escape($_POST['contrato_plazo']));  
    $registro_usuario = $user['id'];
    $registro_fecha    = make_date();
    $query  = "UPDATE obras SET";
    $query .=" 
    nombre = '{$titulo}', 
    descripcion = '{$descripcion}', 
    numero='{$numero}', 
    ubicacion = '{$ubicacion}', 
    expediente = '{$expediente}', 
    proyecto_monto = '{$proyecto_monto}',
    proyecto_monto_fecha = '{$proyecto_monto_fecha}', 
    proyecto_plazo = '{$proyecto_plazo}', 
    longitud = '{$longitud}', 
    estado = '{$estado}', 
    prioridad = '{$prioridad}', 
    tramite = '{$tramite}', 
    plazo_garantia ='{$plazo_garantia}', 
    contratista ='{$contratista}', 
    tipo_contratacion ='{$tipo_contratacion}', 
    aprobacion_res_fecha ='{$aprobacion_res_fecha}', 
    aprobacion_res_num ='{$aprobacion_res_num}',
    adjudicacion_res_fecha ='{$adjudicacion_res_fecha}', 
    adjudicacion_res_num ='{$adjudicacion_res_num}', 
    tipo_financiamiento ='{$tipo_financiamiento}', 
    contrato_fecha ='{$contrato_fecha}', 
    contrato_monto ='{$contrato_monto}', 
    contrato_plazo = '{$contrato_plazo}', 
    memoria_descriptiva = '{$memoria_descriptiva}', 
    observaciones = '{$observaciones}', 
    proyectista = '{$proyectista}', 
    registro_usuario = '".$user['id']."', 
    registro_fecha = '{$registro_fecha}'";
    $query .=" WHERE idobras='{$obra_id}'";
    $query_mapa   = "UPDATE mapa_linea SET estado = $estado WHERE idobras = $obra_id";
    if($db->query($query) && $db->query($query_mapa)){
        if($numero != 0){
            mkdir("../../../uploads/Obras/".$obra_id, 0777);
            mkdir("../../../uploads/Obras/".$obra_id."/Tramites", 0777);
            mkdir("../../../uploads/Obras/".$obra_id."/Archivo", 0777);
            mkdir("../../../uploads/Obras/".$obra_id."/Archivo/1-Pliego completo", 0777);
            mkdir("../../../uploads/Obras/".$obra_id."/Archivo/1-Pliego completo/Proyecto/", 0777);
            mkdir("../../../uploads/Obras/".$obra_id."/Archivo/1-Pliego completo/Planillas/", 0777);
            mkdir("../../../uploads/Obras/".$obra_id."/Archivo/1-Pliego completo/Planos/", 0777);
            mkdir("../../../uploads/Obras/".$obra_id."/Archivo/1-Pliego completo/Pliegos/", 0777);
            mkdir("../../../uploads/Obras/".$obra_id."/Archivo/1-Pliego completo/Pliegos/Especificaciones/", 0777);
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
          }
     logs($user['id'],"proyecto",$obra_id,"Edito un proyecto");
        if($estado == 1 ){
            $session->msg('s',"Actualizado exitosamente.");
            redirect('proyecto?id='.$obra_id, false);
        }else { 
            $session->msg('s',"Actualizado exitosamente.");
            redirect('obra?id='.$obra_id, false);
        }
    } else {
        $session->msg('d',' Lo siento, actualizacion fallo.');
        redirect('proyecto?id='.$obra_id, false);
    }
} 
?>