<?php
require_once(LIB_PATH_INC.'load.php');
date_default_timezone_set('America/Argentina/Buenos_Aires');
date_default_timezone_get();



function consulta_valor_acumulado($item)
{
  global $db;
  $id = (int)$id;
  if(tableExists($table)){
    $sql = $db->query("SELECT cantidad_acumulada FROM certificados_obras_items WHERE idobras_items='{$db->escape($item)}' ORDER BY idcertificados_obras_items DESC LIMIT 1");
    if($result = $db->fetch_assoc($sql))
      return $result;
    else
      return null;
  }
}

function consulta_disponibles($item)
{
  global $db;
  $id = (int)$id;
  if(tableExists($table)){
    $sql = $db->query("SELECT disponibles FROM certificados_obras_items WHERE idobras_items='{$db->escape($item)}' ORDER BY idcertificados_obras_items DESC LIMIT 1");
    if($result = $db->fetch_assoc($sql))
      return $result;
    else
      return null;
  }
}

function cantidades_cert_anterior($idcertificado,$iditem)
{
  global $db;
    $sql = "SELECT * FROM certificados_obras_items WHERE idcertificados_obras='{$db->escape($idcertificado)}' AND idobras_items='{$db->escape($iditem)}' ORDER BY idcertificados_obras_items DESC LIMIT 1";
    return find_by_sql($sql);
}

function ultimo_certificado_obra_aprobado($obra)
{
  global $db;
  $id = (int)$id;
  if(tableExists($table)){
    $sql = $db->query("SELECT * FROM certificados_obras WHERE idobras='{$db->escape($obra)}' ORDER BY idcertificados_obras DESC LIMIT 1");
    if($result = $db->fetch_assoc($sql))
      return $result;
    else
      return null;
  }
}

function ultimo_pase_tramite($id)
{
  global $db;
  $id = (int)$id;
    $sql = $db->query("SELECT * FROM tramites_movimientos WHERE idtramites='{$db->escape($id)}' ORDER BY idtramites_movimientos DESC LIMIT 1");
    if($result = $db->fetch_assoc($sql))
      return $result;
    else
      return null;
}

function ultimo_item_certificado($certificado,$item)
{
  global $db;
    $sql = $db->query("SELECT * FROM certificados_obras_items WHERE idcertificados_obras='{$db->escape($certificado)}' AND idobras_items='{$db->escape($item)}'");
    if($result = $db->fetch_assoc($sql))
    return $result;
  else
    return null;
  }


function anticipos_certificados($idobras){
  global $db;
  static $session;
  $user = current_user();
    $sql  =" SELECT SUM(descuento_anticipo) as anticipo_acumulado ";
    $sql  .=" FROM certificados_obras";
    $sql  .=" WHERE idobras = {$idobras}";
    return find_by_sql($sql);
  }

function existe_certificado_anticipo($idobras){
  global $db;
  static $session;
  $user = current_user();
    $sql  =" SELECT *";
    $sql  .=" FROM certificados_obras";
    $sql  .=" WHERE idobras = {$idobras} AND numero=0";
    return find_by_sql($sql);
  }

function listar_restantes_certificados($idobras,$idcertificado){
  global $db;
  static $session;
  $user = current_user();
    $sql  =" SELECT c.idcertificados_obras, c.numero, c.idobras, c.month, c.year, i.disponibles,o.idobras_items, o.item, o.sub_item, o.descripcion, o.unidad, o.tipo,o.precio_unitario FROM certificados_obras c INNER JOIN certificados_obras_items i ON i.idcertificados_obras=c.idcertificados_obras INNER JOIN obras_items o ON i.idobras_items = o.idobras_items  WHERE c.idobras={$idobras} AND c.idcertificados_obras={$idcertificado}";
    return find_by_sql($sql);
}

function listar_precios_actas($idobras,$idcertificado,$idacta){
  global $db;
  static $session;
  $user = current_user();
    $sql  ="SELECT c.idcertificados_obras, c.numero, c.idobras, c.month, c.year, i.disponibles,o.idobras_items, o.item, o.sub_item, o.descripcion, o.unidad, o.tipo,o.precio_unitario as precio_base,a.precio_unitario as ultimo_precio FROM certificados_obras c INNER JOIN certificados_obras_items i ON i.idcertificados_obras=c.idcertificados_obras INNER JOIN obras_items o ON o.idobras_items = i.idobras_items INNER JOIN redeterminaciones r ON r.idobras=c.idobras INNER JOIN redeterminaciones_precios a ON o.idobras_items=a.idobras_items WHERE c.idobras={$idobras} AND c.idcertificados_obras={$idcertificado} AND r.idredeterminaciones_actas={$idacta} group by o.idobras_items";
    return find_by_sql($sql);
}

function ultimo_acta_provisorio($idobras){
  global $db;
    $sql  =" SELECT *";
    $sql  .=" FROM redeterminaciones";
    $sql  .=" WHERE idobras = {$idobras} AND tipo = 1";
    $sql  .=" ORDER BY idredeterminaciones_actas DESC LIMIT 1";
    $result = $db->query($sql);
    $resultado = $db->fetch_assoc($result);
    return $resultado;
}

function ultimo_acta_definitivo($idobras){
  global $db;
    $sql  =" SELECT *";
    $sql  .=" FROM redeterminaciones";
    $sql  .=" WHERE idobras = {$idobras} AND tipo = 2";
    $sql  .=" ORDER BY idredeterminaciones_actas DESC LIMIT 1";
    $result = $db->query($sql);
    $resultado = $db->fetch_assoc($result);
    return $resultado;
}

function listar_obras_items($idobras){
  global $db;
  static $session;
  $user = current_user();
    $sql  =" SELECT *";
    $sql  .=" FROM obras_items";
    $sql  .=" WHERE idobras = {$idobras}";
    return find_by_sql($sql);
}

function listar_indices_precios_camino(){
  global $db;
  static $session;
    $sql  =" SELECT *";
    $sql  .=" FROM certificados_precios WHERE condicion=1 AND tipo='Camino'";
    $sql  .=" ORDER BY idcertificados_precios DESC";
    return find_by_sql($sql);
}
function listar_indices_precios_puente(){
  global $db;
  static $session;
    $sql  =" SELECT *";
    $sql  .=" FROM certificados_precios WHERE condicion=1 AND tipo='Puente'";
    $sql  .=" ORDER BY idcertificados_precios DESC";
    return find_by_sql($sql);
}



function listar_descuentoscertificados(){
  global $db;
  static $session;
  $user = current_user();
    $sql  =" SELECT *";
    $sql  .=" FROM certificados_descuentos";
    $sql  .=" ORDER BY idcertificados_descuentos DESC";
    return find_by_sql($sql);

}



function tramites_logs($id)
{
  global $db;
    $sql = "SELECT * FROM tramites_movimientos WHERE idtramites='{$db->escape($tipo)}' ORDER BY idtramites DESC";
    return find_by_sql($sql);
}

function ultimo_tramite_log($id)
{
  global $db;
  $sql = $db->query("SELECT * FROM tramites_movimientos WHERE idtramites='{$db->escape($id)}' ORDER BY idtramites DESC LIMIT 1");
  return $db->fetch_assoc($sql); 
}

function ultimos_eventos($tipo,$limit)
{
  global $db;
    $sql = "SELECT * FROM logs WHERE tipo='{$db->escape($tipo)}' ORDER BY idlogs DESC LIMIT {$db->escape($limit)}";
    return find_by_sql($sql);
}


function ultimos_valores_tabla($tabla,$where,$columna,$limit)
{
  global $db;
    $sql = "SELECT * FROM {$db->escape($tabla)} {$db->escape($where)} ORDER BY {$db->escape($columna)} DESC LIMIT {$db->escape($limit)}";
    return find_by_sql($sql);
}


/*--------------------------------------------------------------*/
/* VERIFICAR SI EXISTE TABLA
/*--------------------------------------------------------------*/
function tableExists($table){
  global $db;
  $table_exit = $db->query('SHOW TABLES FROM sac LIKE "'.$db->escape($table).'"');
  if($table_exit) {
    if($db->num_rows($table_exit) > 0)
      return true;
    else
      return false;
  }
}

function obtener_columnas($tabla){
  global $db;
  $result = $db->query("SHOW COLUMNS FROM ".$tabla);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        echo $row['Field'].'<br/>';
    }
}
}

  function ultimo_id($id, $tabla) {
      global $db;
  $sql = $db->query("SELECT * FROM {$db->escape($tabla)} ORDER BY {$db->escape($id)} DESC LIMIT 1;");
    if($result = $db->fetch_assoc($sql))
      return $result['idobras_items'];
    else
      return null;
  }

  function ultimo_id_plan($id, $tabla) {
      global $db;
  $sql = $db->query("SELECT * FROM {$db->escape($tabla)} ORDER BY {$db->escape($id)} DESC LIMIT 1;");
    if($result = $db->fetch_assoc($sql))
      return $result['idobras_planoficial'];
    else
      return null;
  }

  function buscar_dpto($username='', $password='') {
    global $db;
    $username = $db->escape($username);
    $password = $db->escape($password);
    $sql  = sprintf("SELECT * FROM users WHERE username ='%s' LIMIT 1", $username);
    $result = $db->query($sql);
    if($db->num_rows($result)){
      $user = $db->fetch_assoc($result);
      $password_request = sha1($password);
      if($password_request === $user['password'] ){
        return $user['iddepartamentos'];
      }
    }
   return false;
  }

  function authenticate($username='', $password='') {
    global $db;
    $username = $db->escape($username);
    $password = $db->escape($password);
    $sql  = sprintf("SELECT * FROM users WHERE username ='%s' AND condicion=1 LIMIT 1", $username);
    $result = $db->query($sql);
    if($db->num_rows($result)){
      $user = $db->fetch_assoc($result);
      $password_request = sha1($password);
      if($password_request === $user['password'] ){
        return $user['id'];
      }
    }
   return false;
  }
/*--------------------------------------------------------------*/
/*  BUSCAR POR ID Y COLUMNA
/*--------------------------------------------------------------*/

function find_by_id($table,$column,$id)
{
  global $db;
  $id = (int)$id;
  if(tableExists($table)){
    $sql = $db->query("SELECT * FROM {$table} WHERE {$column}={$id} LIMIT 1");
    if($result = $db->fetch_assoc($sql))
      return $result;
    else
      return null;
  }
}

function find_all_by_id($table,$column,$id)
{
  global $db;
  $id = (int)$id;
    $sql = "SELECT * FROM {$table} WHERE {$column}={$id}";
    return find_by_sql($sql);

}

function find_by_id_user($table,$id)
{
  global $db;
  $id = (int)$id;
  if(tableExists($table)){
    $sql = $db->query("SELECT * FROM {$db->escape($table)} WHERE id='{$db->escape($id)}' LIMIT 1");
    if($result = $db->fetch_assoc($sql))
      return $result;
    else
      return null;
  }
}

function find_cert_n($obra,$numero)
{
  global $db;
  $id = (int)$id;
  if(tableExists($table)){
    $sql = $db->query("SELECT * FROM certificados_obras WHERE idobras='{$db->escape($obra)}' AND numero='{$db->escape($numero)}' LIMIT 1");
    if($result = $db->fetch_assoc($sql))
      return $result;
    else
      return null;
  }
}

function registro($idusuario,$descripcion){
  global $db;
  $registro_fecha    = make_date();
  $insert = $db->query('INSERT INTO usuarios_movimientos (idusuarios,registro_fecha,descripcion,ip) VALUES ("'.$db->escape($idusuario).'","'.$registro_fecha.'","'.$db->escape($descripcion).'","'.$_SERVER['REMOTE_ADDR'].'")');
  return $insert;
}

function logs($idusuario,$tipo,$dato,$evento){
  global $db;
  $fecha    = make_date();
  $insert = $db->query('INSERT INTO logs (idusuarios,tipo,dato,evento,fecha,ip) VALUES ("'.$db->escape($idusuario).'","'.$db->escape($tipo).'","'.$db->escape($dato).'","'.$db->escape($evento).'","'.$fecha.'","'.$_SERVER['REMOTE_ADDR'].'")');
  return $insert;
}

function user_name($id)
{
  global $db;
  $id = (int)$id;
  $sql = $db->query("SELECT nombre,apellido FROM users WHERE id='{$db->escape($id)}' LIMIT 1");
  if($result = $db->fetch_assoc($sql))
    return ' por '.$result['nombre'].' '.$result['apellido'].'.';
  else
    return '.';
}

function user_nya($id)
{
  global $db;
  $id = (int)$id;
  $sql = $db->query("SELECT nombre,apellido FROM users WHERE id='{$db->escape($id)}' LIMIT 1");
  if($result = $db->fetch_assoc($sql))
    return $result['apellido'].', '.$result['nombre'];
  else
    return '.';
}
function obtener_user_memo($id){
  global $db;
  $id = (int)$id;
  $sql = "SELECT * FROM memorandums_agentes WHERE idmemorandums='{$db->escape($id)}'";
  $result = find_by_sql($sql);
  return $result;
}
function user_name_memo_comision($id)
{
  global $db;
  $id = (int)$id;
  $sql = $db->query("SELECT * FROM memorandums_agentes WHERE agente='{$db->escape($id)}'");
  if($result = $db->fetch_assoc($sql))
    return user_nya($result['agente']);
  else
    return '';
}

function etiquetas_tramite($id)
{
  global $db;
  $id = (int)$id;
  $sql = $db->query("SELECT * FROM tramites_etiquetas_relacion WHERE idtramites='{$db->escape($id)}'");
  if($result = $db->fetch_assoc($sql))
    return $result['idtramites_etiquetas'];

}

function nombre_etiquetas($id)
{
  global $db;
  $id = (int)$id;
  $sql = $db->query("SELECT * FROM tramites_etiquetas WHERE idtramites_etiquetas='{$db->escape($id)}'");
  if($result = $db->fetch_assoc($sql))
    return $result['titulo'];

}


function user_name_memo_llegada_tarde($id)
{
  global $db;
  $id = (int)$id;
  $sql = $db->query("SELECT nombre,apellido FROM users WHERE id='{$db->escape($id)}' LIMIT 1");
  if($result = $db->fetch_assoc($sql))
    return $result['apellido'].', '.$result['nombre'];
  else
    return '';
}

function dato_nombre($table,$where)
{
  global $db;
  $sql = $db->query("SELECT nombre FROM {$db->escape($table)} {$db->escape($where)}");
  if($result = $db->fetch_assoc($sql))

    return $result["nombre"];

  else

    return '';
}

function dato_memoria($where)
{
  global $db;
  $sql = $db->query("SELECT memoria FROM logs WHERE {$db->escape($where)}");
  if($result = $db->fetch_assoc($sql))

    return $result["memoria"];

  else

    return '';
}


function find_select($select,$table,$where,$value)
{
  global $db;
  $sql = $db->query("SELECT {$db->escape($select)} FROM {$db->escape($table)} WHERE {$db->escape($where)} ='{$db->escape($value)}' LIMIT 1");
  $result = $db->fetch_assoc($sql);
  return $result['nombre'];
}

function user_name_mensajes($id)
{
  global $db;
  $sql = $db->query("SELECT nombre,apellido FROM users WHERE id='{$db->escape($id)}' LIMIT 1");
  if($result = $db->fetch_assoc($sql))
    return $result['nombre'].' '.$result['apellido'];
  else
    return;
}

function inspector_name($id)
{
  global $db;
  $id = (int)$id;
  $sql = $db->query("SELECT nombre,apellido FROM users WHERE id='{$db->escape($id)}' LIMIT 1");
  if($result = $db->fetch_assoc($sql))
    return $result['nombre'].' '.$result['apellido'];
  else
    return;
}

function find_by_name($id)
{
  global $db;
  if(tableExists($table)){
    $sql = $db->query("SELECT * FROM obras WHERE nombre='{$id}' LIMIT 1");
    if($result = $db->fetch_assoc($sql))
      return $result;
    else
      return null;
  }
}

function find_item($id){
  global $db;
  if(tableExists($table))
  {
    return find_by_sql("SELECT * FROM obras_items WHERE idobras=".$db->escape($id));
  }
}

function find_planoficial($id){
  global $db;
  if(tableExists($table))
  {
    return find_by_sql("SELECT * FROM obras_planoficial WHERE idobras=".$db->escape($id));
  }
}

function find_rows_planoficial($dato,$obra){
  global $db;
  if(tableExists($table))
  {
    return find_by_sql("SELECT * FROM obras_planoficial WHERE idplanes_de_trabajo=".$db->escape($dato)." AND idobras=".$db->escape($obra));
  }
}

function find_departamentos($id){
  global $db;
  if(tableExists($table))
  {
    return find_by_sql("SELECT * FROM departamentos WHERE iddireccion=".$db->escape($id));
  }
}

function usuarios_movimientos($id){
  global $db;
  if(tableExists($table))
  {
    return find_by_sql("SELECT * FROM logs WHERE idusuarios=".$db->escape($id)." ORDER BY fecha DESC");
  }
}

function usuarios_movimientos_dia(){
  global $db;
  $date_hora = make_date();
  $date = make_dmy();
  if(tableExists($table))
  {
    return find_by_sql("SELECT * FROM logs WHERE idusuarios!='0' AND tipo='usuario' AND fecha BETWEEN '$date 00:00:01' AND '$date_hora' ORDER BY idlogs DESC");
  }
}

function usuarios_movimientos_dia_id($id){
  global $db;
  $date_hora = make_date();
  $date = make_dmy();
  if(tableExists($table))
  {
    return find_by_sql("SELECT * FROM logs WHERE idusuarios = '$id'  AND fecha BETWEEN '$date 00:00:01' AND '$date_hora' ORDER BY idlogs DESC");
  }
}

function usuarios_actividades(){
  global $db;
  $date_hora = make_date();
  $date = make_dmy();
  if(tableExists($table))
  {
    return find_by_sql("SELECT * FROM logs WHERE fecha BETWEEN '$date 00:00:01' AND '$date_hora' ORDER BY idlogs DESC");
  }
}

function actividad_obra($id){
  global $db;
  $date_hora = make_date();
  $date = make_dmy();
  $id = $id;
  if(tableExists($table))
  {
    return find_by_sql("SELECT * FROM logs WHERE dato='{$id}' AND tipo LIKE '%obra%' ORDER BY idlogs DESC");
  }
}

/*--------------------------------------------------------------*/
/* BUSCAR POR TABLA
/*--------------------------------------------------------------*/

function find_all($table) {
  global $db;
  if(tableExists($table))
  {
    return find_by_sql("SELECT * FROM ".$db->escape($table));
  }
}

function find_all_dependecias() {
  global $db;
    return find_by_sql("SELECT * FROM departamentos d INNER JOIN direcciones dir ON d.iddireccion=dir.iddireccion");
}



/*--------------------------------------------------------------*/
/* EJECUTAR CONSULTA
/*--------------------------------------------------------------*/
function find_by_sql($sql)
{
  global $db;
  $result = $db->query($sql);
  $result_set = $db->while_loop($result);
  return $result_set;
}


/*--------------------------------------------------------------*/
/* PERMISOS
/*--------------------------------------------------------------*/

function find_by_groupName($val)
{
  global $db;
  $sql = "SELECT nombre FROM permisos WHERE nombre = '{$db->escape($val)}' LIMIT 1 ";
  $result = $db->query($sql);
  return($db->num_rows($result) === 0 ? true : false);
}

function nivel_usuario($level)
{
  global $db;
  $sql = "SELECT * FROM usuarios WHERE idpermisos = '{$db->escape($level)}' LIMIT 1 ";
  $result = $db->query($sql);
  return($db->num_rows($result) === 0 ? true : false);
}

function all_memorandums(){
  global $db;
    $sql  =" SELECT * FROM memorandums ORDER BY registro_fecha DESC";
    return find_by_sql($sql);
 
}

function ultima_version(){
  global $db;
    $sql  = $db->query("SELECT * FROM version ORDER BY registro_fecha DESC LIMIT 1");
    $result = $db->fetch_assoc($sql);
    return $result;
 
}

function cambios_version($id){
  global $db;
    $sql  =" SELECT * FROM changelog WHERE idversion=$id ORDER BY registro_fecha DESC";
    return find_by_sql($sql);
 
}

/*--------------------------------------------------------------*/
/* CONTROL DE ACCESO
/*--------------------------------------------------------------*/

function administradores($require_level){
  global $session;
  $user = current_user();
  $login_level = nivel_usuario($current_user['idpermisos']);
  if($user['idpermisos'] != 1 && !$session->isUserLoggedIn(true)){
    $session->msg('d','Se ha cerrado la session');
    redirect('includes/functions/cerrar-session.php', false);
  }elseif($session->isUserLoggedIn(true)){
    return true;
  }
}

function acceso_registrado(){
  global $session;
  $user = current_user();
  $confirmacion = $_POST['acceso'];
  if($user['condicion'] == 1){
  if($_GET['acceso'] == 'si'){
    return true;
  }
  if($session->isUserLoggedIn(true)){ 
    return true;
  } else {
    $session->msg('d','No tiene acceso para ingresar');
    redirect('../', false);
  }
  if($session->isUserLoggedIn(false)){ 
    $session->msg('d','Debe acceder con su usuario');
    redirect('../', false);
  } 

}elseif($user['condicion'] == 0){
$session->logout();
      $session->msg('d','Usuario bloqueado');
    redirect('../', false);
}
}

 function updateLastLogIn($user_id)
  {
    global $db;
    $date = make_date();
    $sql = "UPDATE usuarios SET login='{$date}' WHERE id ='{$user_id}' LIMIT 1";
    $result = $db->query($sql);
    return ($result && $db->affected_rows() === 1 ? true : false);
  }

/*--------------------------------------------------------------*/
/* VERIFICACION DE USUARIOS PARA LOGIN
/*--------------------------------------------------------------*/


function verif_user($id){
  global $db;
  $consulta = $db->query("SELECT * FROM usuarios WHERE username='{$db->escape($id)}'");
  return $db->fetch_assoc($consulta);
}  

function verif_expediente($id){
  global $db;
  $consulta = $db->query("SELECT * FROM expedientes WHERE expediente='{$db->escape($id)}'");
  return $db->fetch_assoc($consulta);
}

function verif_nota($id){
  global $db;
  $consulta = $db->query("SELECT * FROM notas WHERE referencia='{$db->escape($id)}'");
  return $db->fetch_assoc($consulta);
}

/*--------------------------------------------------------------*/
/* LISTAR TABLA OBRAS CONSTRUCCIONES 
/*--------------------------------------------------------------*/

function all_equipo_inspector($id,$idobra){
  global $db;
  $sql = "SELECT e.idobras_inspeccion_equipo ,e.idobras, e.idinspector, e.idusuario,o.idinspector,o.idobras FROM obras_inspeccion_equipo e INNER JOIN obras o ON o.idobras=e.idobras WHERE e.idinspector={$id} AND e.idobras={$idobra} ";
  return find_by_sql($sql);
}

function equipo_inspector($id,$obra){
  global $db;
  $sql = $db->query("SELECT * FROM obras_inspeccion_equipo WHERE idusuario={$id} AND idobras={$obra}");
  if($result = $db->fetch_assoc($sql)){
  return $result;
}else {
    return $result;
  }
}

function usuarios_inspector($id){
  global $db;
  $sql =  "SELECT * FROM users WHERE idusuarios={$id}";
  return find_by_sql($sql);
}

function all_permisos_users($id){
  global $db;
  $sql = "SELECT p.idpermisos,p.nombre,p.descripcion,up.idpermisos FROM permisos p INNER JOIN users_permisos up ON p.idpermisos=up.idpermisos WHERE up.idusers={$id};";
  return find_by_sql($sql);
}

function all_etiquetas_tramite($id){
  global $db;
  $sql = "SELECT e.idtramites_etiquetas,e.titulo,e.descripcion,er.idtramites_etiquetas_relacion,er.idtramites FROM tramites_etiquetas e INNER JOIN tramites_etiquetas_relacion er ON e.idtramites_etiquetas=er.idtramites_etiquetas WHERE er.idtramites={$id};";
  return find_by_sql($sql);
}

function all_obras_tramite($id){
  global $db;
  $sql = "SELECT ot.idtramites,o.idobras,o.numero,o.expediente,o.nombre,ot.idobras FROM obras o INNER JOIN tramites_obras ot ON o.idobras=ot.idobras WHERE ot.idtramites={$id};";
  return find_by_sql($sql);
}

function all_oyp(){
  global $db;
    $sql  =" SELECT * FROM obras WHERE condicion = '1' ORDER BY registro_fecha DESC";
    return find_by_sql($sql);
 
}

function proyectos_construcciones($departamento){
  global $db;
  if($direccion == 1 || $direccion == 11 || $direccion == 21){
  if($departamento == 7){  
    $sql  =" SELECT *";
    $sql  .=" FROM obras";
    $sql  .=" WHERE estado = '1' AND bacheo='1' AND condicion = '1'";
    return find_by_sql($sql);
  }elseif($departament == 5){
    $sql  =" SELECT *";
    $sql  .=" FROM obras";
    $sql  .=" WHERE estado = '1' AND idtipo='1' AND condicion = '1'";
    return find_by_sql($sql);
  }elseif($departamento == 6){
    $sql  =" SELECT *";
    $sql  .=" FROM obras";
    $sql  .=" WHERE estado = '1' AND idtipo='2' AND condicion = '1'";
    return find_by_sql($sql);
  }  elseif($departamento != 6 && $departamento != 5 && $departamento != 8){
    $sql  =" SELECT *";
    $sql  .=" FROM obras";
    $sql  .=" WHERE estado = '1' AND bacheo='0' AND condicion = '1'";
    return find_by_sql($sql);
  }  elseif($departamento == 1){
    $sql  =" SELECT *";
    $sql  .=" FROM obras";
    $sql  .=" WHERE estado = '1' AND condicion = '1'";
    return find_by_sql($sql);
  }
}
}

function planes_de_trabajo($id){
  global $db; 
  $sql  =" SELECT *";
  $sql  .=" FROM planes_de_trabajo";
  $sql  .=" WHERE idobras=$id";
  return find_by_sql($sql);
}

function cotizaciones($id){
  global $db;
  $sql  =" SELECT * FROM cotizaciones";
  $sql .=" WHERE idobras=$id";
  return find_by_sql($sql);
}

function proyectos($id){
  global $db; 
  $sql  =" SELECT *";
  $sql  .=" FROM obras";
  $sql  .=" WHERE idobras=$id";
  return find_by_sql($sql);
}

function proyectos_construcciones_archivo($departamento){
  global $db;
  if($direccion == 1 || $direccion == 11 || $direccion == 21){
  if($departamento == 7){  
    $sql  =" SELECT *";
    $sql  .=" FROM obras";
    $sql  .=" WHERE estado = '1' AND bacheo='1' AND condicion = '0'";
    return find_by_sql($sql);
  }elseif($departamento != 7 && $departamento != 6 && $departamento != 5 && $departamento != 1){
    $sql  =" SELECT *";
    $sql  .=" FROM obras";
    $sql  .=" WHERE estado = '1' AND idtipo='0' AND condicion = '0'";
    return find_by_sql($sql);
  }elseif($departamento == 5){
    $sql  =" SELECT *";
    $sql  .=" FROM obras";
    $sql  .=" WHERE estado = '1' AND idtipo='1' AND condicion = '0'";
    return find_by_sql($sql);
  }elseif($departamento == 6){
    $sql  =" SELECT *";
    $sql  .=" FROM obras";
    $sql  .=" WHERE estado = '1' AND idtipo='2' AND condicion = '0'";
    return find_by_sql($sql);
  }
  elseif($departamento == 1){
    $sql  =" SELECT *";
    $sql  .=" FROM obras";
    $sql  .=" WHERE estado = '1' AND condicion = '0'";
    return find_by_sql($sql);
  }
}
}

function obras_construcciones($departamento){
  global $db;
  static $session;
  $user = current_user();
  if($departamento == 7){  
    $sql  =" SELECT *";
    $sql  .=" FROM obras";
    $sql  .=" WHERE estado != '1' AND bacheo='1' ORDER BY certificado_porcentaje DESC";
    return find_by_sql($sql);
  }elseif($departamento != 7 && $departamento != 6 && $departamento != 5 && $departamento != 8){
    $sql  =" SELECT *";
    $sql  .=" FROM obras";
    $sql  .=" WHERE estado != '1' AND idtipo='0' ORDER BY certificado_porcentaje DESC";
    return find_by_sql($sql);
  }elseif($departamento == 5){
    $sql  =" SELECT *";
    $sql  .=" FROM obras";
    $sql  .=" WHERE estado != '1' AND idtipo='1' ORDER BY certificado_porcentaje DESC";
    return find_by_sql($sql);
  }elseif($departamento == 6){
    $sql  =" SELECT *";
    $sql  .=" FROM obras";
    $sql  .=" WHERE estado != '1' AND idtipo='2' ORDER BY certificado_porcentaje DESC";
    return find_by_sql($sql);
  }elseif($departamento == 8){
    if($user['idusuarios'] == NULL || $user['idusuarios'] == 0){  
      $sql  =" SELECT * FROM obras WHERE idinspector='".$user['id']."' ORDER BY certificado_porcentaje DESC";
      return find_by_sql($sql);
    }else{
      $sql  =" SELECT * FROM obras WHERE idinspector='".$user['idusuarios']."' ORDER BY certificado_porcentaje DESC";
      return find_by_sql($sql);
    }
  }
}

function obra_timeline($id){
  global $db;
  static $session;
  $user = current_user();
  $sql  ="SELECT * FROM obras_resumen WHERE idobras = ".$id." ORDER BY fecha ASC";
  return find_by_sql($sql);
}

function obras_contratadas(){
  global $db;
  static $session;
  $user = current_user();
  if($user['iddepartamentos'] != 8){
    $sql  =" SELECT *";
    $sql  .=" FROM obras";
    $sql  .=" WHERE estado != '1' AND condicion = '1' ORDER BY idobras DESC";
    return find_by_sql($sql);
  }else{
    if($user['idusuarios'] == NULL || $user['idusuarios'] == 0){  
      $sql  =" SELECT * FROM obras WHERE idinspector='".$user['id']."' AND estado != '1' ORDER BY idobras DESC";
      return find_by_sql($sql);
    }else{
      $sql  =" SELECT * FROM obras WHERE idinspector='".$user['idusuarios']."' and estado != '1' ORDER BY idobras DESC";
      return find_by_sql($sql);
    }
  }
}

function obras_construcciones_activas($direccion,$departamento){
  global $db;
  static $session;
  $user = current_user();
  if($direccion == 1 || $direccion == 11 || $direccion == 21){
  if($departamento == 7){  
    $sql  =" SELECT *";
    $sql  .=" FROM obras";
    $sql  .=" WHERE estado != '1' AND bacheo='1' AND condicion = '1' ORDER BY idobras DESC";
    return find_by_sql($sql);
  }elseif($departamento != 7 && $departamento != 6 && $departamento != 5 && $departamento != 8){
    $sql  =" SELECT *";
    $sql  .=" FROM obras";
    $sql  .=" WHERE estado != '1' AND idtipo='0' AND condicion = '1' ORDER BY idobras DESC";
    return find_by_sql($sql);
  }elseif($departamento == 5){
    $sql  =" SELECT *";
    $sql  .=" FROM obras";
    $sql  .=" WHERE estado != '1' AND idtipo='1' AND condicion = '1' ORDER BY idobras DESC";
    return find_by_sql($sql);
  }elseif($departamento == 6){
    $sql  =" SELECT *";
    $sql  .=" FROM obras";
    $sql  .=" WHERE estado != '1' AND idtipo='2' AND condicion = '1' ORDER BY idobras DESC";
    return find_by_sql($sql);
  }elseif($departamento == 8){
    if($user['idusuarios'] == NULL || $user['idusuarios'] == 0 && $direccion == 1){  
      $sql  =" SELECT * FROM obras WHERE idinspector='".$user['id']."' ORDER BY idobras DESC";
      return find_by_sql($sql);
    }else{
      $sql  =" SELECT * FROM obras WHERE idinspector='".$user['idusuarios']."' ORDER BY idobras DESC";
      return find_by_sql($sql);
    }
  }
  }
}

function obras_ejecucion_activas($direccion,$departamento){
  global $db;
  static $session;
  $user = current_user();
  if($direccion == 1 || $direccion == 11 || $direccion == 21){
  if($departamento == 7){  
    $sql  =" SELECT *";
    $sql  .=" FROM obras";
    $sql  .=" WHERE estado = '0' AND bacheo='1' AND condicion = '1' ORDER BY certificado_porcentaje DESC";
    return find_by_sql($sql);
  }elseif($departamento != 7 && $departamento != 6 && $departamento != 5 && $departamento != 8){
    $sql  =" SELECT *";
    $sql  .=" FROM obras";
    $sql  .=" WHERE estado = '0' AND idtipo='0' AND condicion = '1' ORDER BY certificado_porcentaje DESC";
    return find_by_sql($sql);
  }elseif($departamento == 5){
    $sql  =" SELECT *";
    $sql  .=" FROM obras";
    $sql  .=" WHERE estado = '0' AND idtipo='1' AND condicion = '1' ORDER BY certificado_porcentaje DESC";
    return find_by_sql($sql);
  }elseif($departamento == 6){
    $sql  =" SELECT *";
    $sql  .=" FROM obras";
    $sql  .=" WHERE estado = '0' AND idtipo='2' AND condicion = '1' ORDER BY certificado_porcentaje DESC";
    return find_by_sql($sql);
  }elseif($departamento == 8){
    if($user['idusuarios'] == NULL || $user['idusuarios'] == 0 && $direccion == 1){  
      $sql  =" SELECT * FROM obras WHERE idinspector='".$user['id']."' ORDER BY certificado_porcentaje DESC";
      return find_by_sql($sql);
    }else{
      $sql  =" SELECT * FROM obras WHERE idinspector='".$user['idusuarios']."' ORDER BY certificado_porcentaje DESC";
      return find_by_sql($sql);
    }
  }
  }
}
function obras_finalizadas_activas($direccion,$departamento){
  global $db;
  static $session;
  $user = current_user();
  if($direccion == 1 || $direccion == 11 || $direccion == 21){
  if($departamento == 7){  
    $sql  =" SELECT *";
    $sql  .=" FROM obras";
    $sql  .=" WHERE estado = '3' AND bacheo='1' AND condicion = '1' ORDER BY certificado_porcentaje DESC";
    return find_by_sql($sql);
  }elseif($departamento != 7 && $departamento != 6 && $departamento != 5 && $departamento != 8){
    $sql  =" SELECT *";
    $sql  .=" FROM obras";
    $sql  .=" WHERE estado = '3' AND idtipo='0' AND condicion = '1' ORDER BY certificado_porcentaje DESC";
    return find_by_sql($sql);
  }elseif($departamento == 5){
    $sql  =" SELECT *";
    $sql  .=" FROM obras";
    $sql  .=" WHERE estado = '3' AND idtipo='1' AND condicion = '1' ORDER BY certificado_porcentaje DESC";
    return find_by_sql($sql);
  }elseif($departamento == 6){
    $sql  =" SELECT *";
    $sql  .=" FROM obras";
    $sql  .=" WHERE estado = '3' AND idtipo='2' AND condicion = '1' ORDER BY certificado_porcentaje DESC";
    return find_by_sql($sql);
  }elseif($departamento == 8){
    if($user['idusuarios'] == NULL || $user['idusuarios'] == 0 && $direccion == 1){  
      $sql  =" SELECT * FROM obras WHERE idinspector='".$user['id']."' ORDER BY certificado_porcentaje DESC";
      return find_by_sql($sql);
    }else{
      $sql  =" SELECT * FROM obras WHERE idinspector='".$user['idusuarios']."' ORDER BY certificado_porcentaje DESC";
      return find_by_sql($sql);
    }
  }
  }
}
function obras_neutralizadas_activas($direccion,$departamento){
  global $db;
  static $session;
  $user = current_user();
  if($direccion == 1 || $direccion == 11 || $direccion == 21){
  if($departamento == 7){  
    $sql  =" SELECT *";
    $sql  .=" FROM obras";
    $sql  .=" WHERE estado = '4' AND bacheo='1' AND condicion = '1' ORDER BY certificado_porcentaje DESC";
    return find_by_sql($sql);
  }elseif($departamento != 7 && $departamento != 6 && $departamento != 5 && $departamento != 8){
    $sql  =" SELECT *";
    $sql  .=" FROM obras";
    $sql  .=" WHERE estado = '4' AND idtipo='0' AND condicion = '1' ORDER BY certificado_porcentaje DESC";
    return find_by_sql($sql);
  }elseif($departamento == 5){
    $sql  =" SELECT *";
    $sql  .=" FROM obras";
    $sql  .=" WHERE estado = '4' AND idtipo='1' AND condicion = '1' ORDER BY certificado_porcentaje DESC";
    return find_by_sql($sql);
  }elseif($departamento == 6){
    $sql  =" SELECT *";
    $sql  .=" FROM obras";
    $sql  .=" WHERE estado = '4' AND idtipo='2' AND condicion = '1' ORDER BY certificado_porcentaje DESC";
    return find_by_sql($sql);
  }elseif($departamento == 8){
    if($user['idusuarios'] == NULL || $user['idusuarios'] == 0 && $direccion == 1){  
      $sql  =" SELECT * FROM obras WHERE idinspector='".$user['id']."' ORDER BY certificado_porcentaje DESC";
      return find_by_sql($sql);
    }else{
      $sql  =" SELECT * FROM obras WHERE idinspector='".$user['idusuarios']."' ORDER BY certificado_porcentaje DESC";
      return find_by_sql($sql);
    }
  }
  }
}
function obras_garantias_activas($direccion,$departamento){
  global $db;
  static $session;
  $user = current_user();
  if($direccion == 1 || $direccion == 11 || $direccion == 21){
  if($departamento == 7){  
    $sql  =" SELECT *";
    $sql  .=" FROM obras";
    $sql  .=" WHERE estado = '3' AND finalizado='1' AND bacheo='1' AND condicion = '1' ORDER BY certificado_porcentaje DESC";
    return find_by_sql($sql);
  }elseif($departamento != 7 && $departamento != 6 && $departamento != 5 && $departamento != 8){
    $sql  =" SELECT *";
    $sql  .=" FROM obras";
    $sql  .=" WHERE estado = '3' AND finalizado='1' AND idtipo='0' AND condicion = '1' ORDER BY certificado_porcentaje DESC";
    return find_by_sql($sql);
  }elseif($departamento == 5){
    $sql  =" SELECT *";
    $sql  .=" FROM obras";
    $sql  .=" WHERE estado = '3' AND finalizado='1' AND idtipo='1' AND condicion = '1' ORDER BY certificado_porcentaje DESC";
    return find_by_sql($sql);
  }elseif($departamento == 6){
    $sql  =" SELECT *";
    $sql  .=" FROM obras";
    $sql  .=" WHERE estado = '3' AND finalizado='1' AND idtipo='2' AND condicion = '1' ORDER BY certificado_porcentaje DESC";
    return find_by_sql($sql);
  }elseif($departamento == 8){
    if($user['idusuarios'] == NULL || $user['idusuarios'] == 0 && $direccion == 1){  
      $sql  =" SELECT * FROM obras WHERE idinspector='".$user['id']."' ORDER BY certificado_porcentaje DESC";
      return find_by_sql($sql);
    }else{
      $sql  =" SELECT * FROM obras WHERE idinspector='".$user['idusuarios']."' ORDER BY certificado_porcentaje DESC";
      return find_by_sql($sql);
    }
  }
  }
}

function obras_rescindidas_activas($direccion,$departamento){
  global $db;
  static $session;
  $user = current_user();
  if($direccion == 1 || $direccion == 11 || $direccion == 21){
  if($departamento == 7){  
    $sql  =" SELECT *";
    $sql  .=" FROM obras";
    $sql  .=" WHERE estado = '5' AND bacheo='1' AND condicion = '1' ORDER BY certificado_porcentaje DESC";
    return find_by_sql($sql);
  }elseif($departamento != 7 && $departamento != 6 && $departamento != 5 && $departamento != 8){
    $sql  =" SELECT *";
    $sql  .=" FROM obras";
    $sql  .=" WHERE estado = '5' AND idtipo='0' AND condicion = '1' ORDER BY certificado_porcentaje DESC";
    return find_by_sql($sql);
  }elseif($departamento == 5){
    $sql  =" SELECT *";
    $sql  .=" FROM obras";
    $sql  .=" WHERE estado = '5' AND idtipo='1' AND condicion = '1' ORDER BY certificado_porcentaje DESC";
    return find_by_sql($sql);
  }elseif($departamento == 6){
    $sql  =" SELECT *";
    $sql  .=" FROM obras";
    $sql  .=" WHERE estado = '5' AND idtipo='2' AND condicion = '1' ORDER BY certificado_porcentaje DESC";
    return find_by_sql($sql);
  }elseif($departamento == 8){
    if($user['idusuarios'] == NULL || $user['idusuarios'] == 0 && $direccion == 1){  
      $sql  =" SELECT * FROM obras WHERE idinspector='".$user['id']."' ORDER BY certificado_porcentaje DESC";
      return find_by_sql($sql);
    }else{
      $sql  =" SELECT * FROM obras WHERE idinspector='".$user['idusuarios']."' ORDER BY certificado_porcentaje DESC";
      return find_by_sql($sql);
    }
  }
  }
}


function obras_construcciones_archivo($direccion,$departamento){
  global $db;
  static $session;
  $user = current_user();
  if($direccion == 1 || $direccion == 11 || $direccion == 21){
  if($departamento == 7){  
    $sql  =" SELECT *";
    $sql  .=" FROM obras";
    $sql  .=" WHERE estado != '1' AND bacheo='1' AND condicion = '0' ORDER BY certificado_porcentaje DESC";
    return find_by_sql($sql);
  }elseif($departamento != 7 && $departamento != 6 && $departamento != 5 && $departamento != 8){
    $sql  =" SELECT *";
    $sql  .=" FROM obras";
    $sql  .=" WHERE estado != '1' AND idtipo='0' AND condicion = '0' ORDER BY certificado_porcentaje DESC";
    return find_by_sql($sql);
  }elseif($departamento == 5){
    $sql  =" SELECT *";
    $sql  .=" FROM obras";
    $sql  .=" WHERE estado != '1' AND idtipo='1' AND condicion = '0' ORDER BY certificado_porcentaje DESC";
    return find_by_sql($sql);
  }elseif($departamento == 6){
    $sql  =" SELECT *";
    $sql  .=" FROM obras";
    $sql  .=" WHERE estado != '1' AND idtipo='2' AND condicion = '0' ORDER BY certificado_porcentaje DESC";
    return find_by_sql($sql);
  }elseif($departamento == 8){
    if($user['idusuarios'] == NULL || $user['idusuarios'] == 0 && $direccion == 1){  
      $sql  =" SELECT * FROM obras WHERE condicion='0' AND idinspector='".$user['id']."' ORDER BY certificado_porcentaje DESC";
      return find_by_sql($sql);
    }else{
      $sql  =" SELECT * FROM obras WHERE condicion='0' AND idinspector='".$user['idusuarios']."' ORDER BY certificado_porcentaje DESC";
      return find_by_sql($sql);
    }
  }
  }
}  

function obras_construcciones_modificaciones($departamento){
  global $db;
  static $session;
  $user = current_user();
  if($departamento == 8){
    if($user['idusuarios'] == NULL){
      $sql  =" SELECT m.registro_fecha,m.idmodificaciones,m.idobras,m.numero,m.expediente,m.estado,m.monto,m.resolucion_numero,m.resolucion_fecha,m.descripcion,m.computo_estado,m.computo_fecha,m.precios_estado,m.precios_fecha,m.observaciones,m.condicion,o.nombre,o.contratista,o.expediente as expediente_obra,o.registro_usuario,o.registro_fecha ";
      $sql  .=" FROM obras_modificaciones m INNER JOIN obras o ON m.idobras=o.idobras";
      $sql  .=" WHERE o.idinspector = '".$user['id']."' ORDER BY m.estado ASC";
      return find_by_sql($sql);
    }else{
      $sql  =" SELECT m.registro_fecha, m.idmodificaciones,m.idobras,m.numero,m.expediente,m.estado,m.monto,m.resolucion_numero,m.resolucion_fecha,m.descripcion,m.computo_estado,m.computo_fecha,m.precios_estado,m.precios_fecha,m.observaciones,m.condicion,o.nombre,o.contratista,o.expediente as expediente_obra,o.registro_usuario,o.registro_fecha ";
      $sql  .=" FROM obras_modificaciones m INNER JOIN obras o ON m.idobras=o.idobras";
      $sql  .=" WHERE o.idinspector = '".$user['idusuarios']."' ORDER BY m.estado ASC";
      return find_by_sql($sql);
    }
  }else{
    $sql  =" SELECT m.registro_fecha,m.idmodificaciones,m.idobras,m.numero,m.expediente,m.estado,m.monto,m.resolucion_numero,m.resolucion_fecha,m.descripcion,m.computo_estado,m.computo_fecha,m.precios_estado,m.precios_fecha,m.observaciones,m.condicion,o.nombre,o.contratista,o.expediente as expediente_obra,o.registro_usuario,o.registro_fecha ";
    $sql  .=" FROM obras_modificaciones m INNER JOIN obras o ON m.idobras=o.idobras";
    $sql  .=" WHERE m.condicion='1' ORDER BY m.estado ASC";
    return find_by_sql($sql);
  }
}

function obra_modificaciones($id){
  global $db;
  $sql  =" SELECT * FROM obras_modificaciones WHERE idobras={$id} ";
  return find_by_sql($sql);
}

function obra_mod_planes($id){
  global $db;
  $sql  =" SELECT * FROM obras_mod_planes WHERE idobras={$id} ";
  return find_by_sql($sql);
}

function conteo_modificaciones($id){
  global $db;
  if(tableExists($table))
  {
    $sql    = "SELECT COUNT(".$db->escape($id).") AS total FROM obras_modificaciones";
    $result = $db->query($sql);
    return($db->fetch_assoc($result));
  }
}

function conteo_relevamientos($id){
  global $db;
  if(tableExists($table))
  {
    $sql    = "SELECT COUNT(".$db->escape($id).") AS total FROM relevamientos";
    $result = $db->query($sql);
    return($db->fetch_assoc($result));
  }
}

function obra_ampliaciones($id){
  global $db;
  $sql  =" SELECT * FROM obras_ampliaciones WHERE idobras={$id} ";
  return find_by_sql($sql);
}

function conteo_ampliaciones($id){
  global $db;
  if(tableExists($table))
  {
    $sql    = "SELECT COUNT(".$db->escape($id).") AS total FROM obras_ampliaciones";
    $result = $db->query($sql);
    return($db->fetch_assoc($result));
  }
}

function conteo_neutralizaciones($id){
  global $db;
  if(tableExists($table))
  {
    $sql    = "SELECT COUNT(".$db->escape($id).") AS total FROM obras_neutralizaciones";
    $result = $db->query($sql);
    return($db->fetch_assoc($result));
  }
}

function obra_neutralizaciones($id){
  global $db;
  $sql  =" SELECT * FROM obras_neutralizaciones WHERE idobras={$id} ";
  return find_by_sql($sql);
}

function obras_construcciones_ampliaciones($departamento){
  global $db;
  static $session;
  $user = current_user();
  if($departamento == 8){  
    if($user['idusuarios'] == NULL){
      $sql  =" SELECT a.idampliaciones,a.idobras,a.numero,a.expediente,a.estado,a.resolucion_numero,a.resolucion_fecha,a.descripcion,a.condicion,o.nombre,o.contratista,o.expediente as expediente_obra,o.registro_usuario,o.registro_fecha ";
      $sql  .=" FROM obras_ampliaciones a INNER JOIN obras o ON a.idobras=o.idobras";
      $sql  .=" WHERE o.idinspector = ".$user['id']." ORDER BY a.estado ASC";
      return find_by_sql($sql);
    }else{
      $sql  =" SELECT a.idampliaciones,a.idobras,a.numero,a.expediente,a.estado,a.resolucion_numero,a.resolucion_fecha,a.descripcion,a.condicion,o.nombre,o.contratista,o.expediente as expediente_obra,o.registro_usuario,o.registro_fecha ";
      $sql  .=" FROM obras_ampliaciones a INNER JOIN obras o ON a.idobras=o.idobras";
      $sql  .=" WHERE o.idinspector = '".$user['idusuarios']."' ORDER BY a.estado ASC";
      return find_by_sql($sql);
    }
  }else{
    $sql  =" SELECT a.idampliaciones,a.idobras,a.numero,a.expediente,a.estado,a.resolucion_numero,a.resolucion_fecha,a.descripcion,a.condicion,o.nombre,o.contratista,o.expediente as expediente_obra,o.registro_usuario,o.registro_fecha ";
    $sql  .=" FROM obras_ampliaciones a INNER JOIN obras o ON a.idobras=o.idobras";
    $sql  .=" WHERE o.condicion='1' ORDER BY a.estado ASC";
    return find_by_sql($sql);
  }
}

function obras_construcciones_neutralizaciones($departamento){
  global $db;
  static $session;
  $user = current_user();
  if($departamento == 8){  
    if($user['idusuarios'] == NULL){
      $sql  =" SELECT n.idneutralizaciones,n.idobras,n.numero,n.expediente,n.estado,n.resolucion_numero,n.resolucion_fecha,n.descripcion,n.condicion,o.nombre,o.contratista,o.expediente as expediente_obra,o.registro_usuario,o.registro_fecha ";
      $sql  .=" FROM obras_neutralizaciones n INNER JOIN obras o ON n.idobras=o.idobras";
      $sql  .=" WHERE o.idinspector = ".$user['id']." ORDER BY n.estado ASC";
      return find_by_sql($sql);
    }else{
      $sql  =" SELECT n.idneutralizaciones,n.idobras,n.numero,n.expediente,n.estado,n.resolucion_numero,n.resolucion_fecha,n.descripcion,n.condicion,o.nombre,o.contratista,o.expediente as expediente_obra,o.registro_usuario,o.registro_fecha ";
      $sql  .=" FROM obras_neutralizaciones n INNER JOIN obras o ON n.idobras=o.idobras";
      $sql  .=" WHERE o.idinspector = '".$user['idusuarios']."' ORDER BY n.estado ASC";
      return find_by_sql($sql);
    }

  }else{
    $sql  =" SELECT n.idneutralizaciones,n.idobras,n.numero,n.expediente,n.estado,n.resolucion_numero,n.resolucion_fecha,n.descripcion,n.condicion,o.nombre,o.contratista,o.expediente as expediente_obra,o.registro_usuario,o.registro_fecha ";
    $sql  .=" FROM obras_neutralizaciones n INNER JOIN obras o ON n.idobras=o.idobras";
    $sql  .=" WHERE o.condicion='1' ORDER BY n.estado ASC";
    return find_by_sql($sql);  
  }
}

// Estados de obras

function obras_construcciones_ejecucion(){
  global $db;
  $sql  =" SELECT *";
  $sql  .=" FROM obras";
  $sql  .=" WHERE estado = '0' AND condicion = '1' ORDER BY numero DESC";
  return find_by_sql($sql);
}

function obras_construcciones_finalizadas(){
  global $db;
  $sql  =" SELECT *";
  $sql  .=" FROM obras";
  $sql  .=" WHERE estado = '3' AND condicion = '1' ORDER BY numero DESC";
  return find_by_sql($sql);
}

function obras_construcciones_rescindidas(){
  global $db;
  $sql  =" SELECT *";
  $sql  .=" FROM obras";
  $sql  .=" WHERE estado = '5' AND condicion = '1' ORDER BY numero DESC";
  return find_by_sql($sql);
}

function obras_construcciones_neutralizadas(){
  global $db;
  $sql  =" SELECT *";
  $sql  .=" FROM obras";
  $sql  .=" WHERE estado = '4' AND condicion = '1' ORDER BY numero DESC";
  return find_by_sql($sql);
}

// Relevamientos

function relevamientos_construcciones($departamento){
  global $db;
  if($departamento == 1 || $departamento == 2){
    $sql  =" SELECT *";
    $sql  .=" FROM relevamientos";
    $sql  .=" WHERE condicion = '1' ORDER BY registro_fecha DESC";
    return find_by_sql($sql);
  }else{
    $sql  =" SELECT *";
    $sql  .=" FROM relevamientos";
    $sql  .=" WHERE iddepartamentos = '{$departamento}' AND condicion = '1' ORDER BY registro_fecha DESC";
    return find_by_sql($sql);
  }
}

/*--------------------------------------------------------------*/
/* Certificados
/*--------------------------------------------------------------*/

function listar_unidades(){
  global $db;
  $sql  =" SELECT * FROM certificados_unidades";
  $sql .=" ORDER BY idcertificados_unidades DESC";
  return find_by_sql($sql);
}

function listar_items_obras($dato){
  global $db;
  $sql  =" SELECT * FROM obras_items";
  $sql .=" WHERE idobras={$dato} ORDER BY idobras_items ASC";
  return find_by_sql($sql);
}

function listar_items_obras_redeterminacion_id($dato,$acta){
  global $db;
  $sql  =" SELECT i.idredeterminaciones_precios, i.idobras_items, i.precio_unitario, r.titulo, o.item, o.sub_item, o.descripcion, 
  o.unidad, o.tipo, i.disponibles  FROM redeterminaciones_precios i INNER JOIN redeterminaciones r ON i.idobras=r.idobras INNER JOIN obras_items o ON i.idobras_items = o.idobras_items  WHERE i.idobras={$dato} AND r.idredeterminaciones_actas={$acta}";
  return find_by_sql($sql);
}

function listar_items_obras_redeterminacion($dato){
  global $db;
  $sql  =" SELECT i.idredeterminaciones_precios, i.idobras_items, i.precio_unitario, r.titulo, o.item, o.sub_item, o.descripcion, o.unidad, o.tipo FROM redeterminaciones_precios i INNER JOIN redeterminaciones r ON i.idobras=r.idobras INNER JOIN obras_items o ON i.idobras_items = o.idobras_items  WHERE i.idobras={$dato} ";
  return find_by_sql($sql);
}

function listar_items_nuevos_precios($idcertificado,$idobra,$idacta){
  global $db;
  $sql  =" 
  SELECT i.idredeterminaciones_precios, i.idobras_items, i.precio_unitario, o.tipo, r.titulo, o.item, o.sub_item, o.descripcion, o.unidad, c.cantidad, c.cantidad_acumulada 
  FROM redeterminaciones_precios i 
  INNER JOIN redeterminaciones r ON i.idobras=r.idobras 
  INNER JOIN obras_items o ON i.idobras_items = o.idobras_items  
  INNER JOIN certificados_obras_items c ON c.idobras_items=o.idobras_items 
  INNER JOIN certificados_obras co ON co.idcertificados_obras = c.idcertificados_obras 
  WHERE i.idredeterminaciones_actas ={$idacta} AND co.idcertificados_obras={$idcertificado};";
  return find_by_sql($sql);
}

function listar_items_nuevos_precios_stipo($idcertificado,$idobra,$idacta,$tipo){
  global $db;
  $sql  =" 
  SELECT i.idredeterminaciones_precios, i.idobras_items, i.precio_unitario, o.tipo, r.titulo, o.item, o.sub_item, o.descripcion, o.unidad, c.cantidad, c.cantidad_acumulada 
  FROM redeterminaciones_precios i 
  INNER JOIN redeterminaciones r ON i.idobras=r.idobras 
  INNER JOIN obras_items o ON i.idobras_items = o.idobras_items  
  INNER JOIN certificados_obras_items c ON c.idobras_items=o.idobras_items 
  INNER JOIN certificados_obras co ON co.idcertificados_obras = c.idcertificados_obras 
  WHERE i.idredeterminaciones_actas ={$idacta} AND co.idcertificados_obras={$idcertificado} AND r.tipo={$tipo}; ";
  return find_by_sql($sql);
}

function listar_items_obra_certificados($idcertificado,$idobra){
  global $db;
  $sql  =" 
  SELECT o.idobras_items, o.idobras, o.item, o.tipo, o.sub_item, o.descripcion, o.unidad, o.precio_unitario, c.cantidad, c.cantidad_acumulada 
  FROM obras_items o 
  INNER JOIN certificados_obras_items c ON c.idobras_items=o.idobras_items 
  INNER JOIN certificados_obras co ON co.idcertificados_obras = c.idcertificados_obras 
  WHERE o.idobras={$idobra} AND co.idcertificados_obras={$idcertificado};";
  return find_by_sql($sql);
}

 function listar_planoficial_obras($dato){
  global $db;
  $sql  =" SELECT * FROM obras_planoficial";
  $sql .=" WHERE idobras={$dato} ORDER BY idobras_planoficial ASC";
  return find_by_sql($sql);
}

function planes_de_trabajo_obras($dato){
  global $db;
  $sql  =" SELECT * FROM planes_de_trabajo";
  $sql .=" WHERE idobras={$dato} ORDER BY idplanes_de_trabajo ASC";
  return find_by_sql($sql);
}

function cotizaciones_obras($dato){
  global $db;
  $sql  =" SELECT * FROM cotizaciones";
  $sql .=" WHERE idobras={$dato} ORDER BY idcotizaciones ASC";
  return find_by_sql($sql);
}

function rows_cotizaciones_obras($dato,$cotiz){
  global $db;
  $sql  =" SELECT * FROM obras_items";
  $sql .=" WHERE idobras={$dato} AND idcotizaciones={$cotiz} ORDER BY idobras_items ASC";
  return find_by_sql($sql);
}

function rows_planes_obras($dato,$plan){
  global $db;
  $sql  =" SELECT * FROM obras_planoficial";
  $sql .=" WHERE idobras={$dato} AND idplanes_de_trabajo={$plan} ORDER BY idobras_planoficial ASC";
  return find_by_sql($sql);
}

function certificados_obras($dato){
  global $db;
  $sql  =" SELECT * FROM certificados_obras";
  $sql .=" WHERE idobras={$dato} AND estado='2' ORDER BY idcertificados_obras ASC";
  return find_by_sql($sql);
}

function all_certificados_obras(){
  global $db;
  $sql  =" SELECT * FROM certificados";
  $sql .=" ORDER BY registro_fecha DESC";
  return find_by_sql($sql);
}

function all_certificados_obras_aprobados_limit(){
  global $db;
  $sql  =" SELECT * FROM certificados_obras ";
  $sql .=" ORDER BY registro_fecha DESC LIMIT 10";
  return find_by_sql($sql);
}

function all_certificados_aprobados_obras(){
  global $db;
  $sql  =" SELECT * FROM certificados";
  $sql .=" ORDER BY registro_fecha DESC";
  return find_by_sql($sql);
}

function listar_certificados_obras(){
  global $db;
  $sql  =" SELECT * FROM certificados_obras";
  $sql .=" ORDER BY registro_fecha DESC";
  return find_by_sql($sql);
}

function listar_certificados_idobras($id){
  global $db;
  $sql  =" SELECT * FROM certificados_obras WHERE idobras='{$id}'";
  $sql .=" ORDER BY registro_fecha DESC";
  return find_by_sql($sql);
}

function listar_certificados_aprobados_idobras($id){
  global $db;
  $sql  =" SELECT * FROM certificados_obras WHERE idobras='{$id}' AND estado=2";
  $sql .=" ORDER BY registro_fecha DESC";
  return find_by_sql($sql);
}

function listar_certificado_id($id){
  global $db;
  $sql  =" SELECT * FROM certificados_obras WHERE idcertificados_obras='{$id}'";
  return find_by_sql($sql);
}

function actas_redeterminacion_provisorias($id){
  global $db;
  $sql  =" SELECT * FROM redeterminaciones WHERE idobras='{$id}' AND tipo=1 AND condicion=1 ";
  $sql .=" ORDER BY idredeterminaciones_actas DESC";
  return find_by_sql($sql);
}
function actas_redeterminacion_definitivas($id){
  global $db;
  $sql  =" SELECT * FROM redeterminaciones WHERE idobras='{$id}' AND tipo=2 AND condicion=1 ";
  $sql .=" ORDER BY idredeterminaciones_actas DESC";
  return find_by_sql($sql);
}


function plan_oficial_obras($dato){
  global $db;
  $sql  =" SELECT * FROM obras_planoficial";
  $sql .=" WHERE idobras={$dato} ORDER BY idobras_planoficial ASC";
  return find_by_sql($sql);
}

function certificados_redeterminados_obras($dato){
  global $db;
  $sql  =" SELECT * FROM certificados_redeterminados";
  $sql .=" WHERE idobras={$dato} ORDER BY idcertificados_redeterminados DESC";
  return find_by_sql($sql);
}

function all_certificados_redeterminados_obras(){
  global $db;
  $sql  =" SELECT * FROM certificados_redeterminados";
  $sql .=" ORDER BY idcertificados_redeterminados ASC";
  return find_by_sql($sql);
}

// Modificaciones, ampliaciones y neutralizaciones de obra

function modificaciones_de_obra($id){
  global $db;
  $sql  =" SELECT * FROM obras_modificaciones";
  $sql  .=" WHERE condicion='1' AND idobras={$id}  ORDER BY numero DESC";
  return find_by_sql($sql);
}

function ampliaciones_de_obra($id){
  global $db;
  $sql  =" SELECT * FROM obras_ampliaciones";
  $sql  .=" WHERE condicion='1' AND idobras={$id}  ORDER BY numero DESC";
  return find_by_sql($sql);
}

function ultima_ampliacion_obra($id){
  global $db;
  $sql  =" SELECT * FROM obras_ampliaciones";
  $sql  .=" WHERE condicion='1' AND idobras={$id} ORDER BY idampliaciones DESC LIMIT 1";
  return find_by_sql($sql);
}


function neutralizaciones_de_obra($id){
  global $db;
  $sql  =" SELECT * FROM obras_neutralizaciones";
  $sql  .=" WHERE condicion='1' AND idobras={$id} ORDER BY numero DESC";
  return find_by_sql($sql);
}

function obra_bacheo($dato){
  global $db;
  $sql  =" SELECT *";
  $sql  .=" FROM obras_bacheos";
  $sql  .=" WHERE idobras = '{$dato}' ORDER BY registro_fecha ASC";
  return find_by_sql($sql);
}

function rp_obra($id){
  global $db;
  $sql  =" SELECT * FROM recepciones_provisorias";
  $sql  .=" WHERE condicion='1' AND nombre_obras='{$id}'";
  return find_by_sql($sql);
}
function recepciones_obra($id){
  global $db;
  $sql  =" SELECT * FROM recepciones";
  $sql  .=" WHERE condicion='1' AND idobras='{$id}'";
  return find_by_sql($sql);
}

function rd_obra($id){
  global $db;
  $sql  =" SELECT * FROM recepciones_definitivas";
  $sql  .=" WHERE condicion='1' AND nombre_obras='{$id}' ";
  return find_by_sql($sql);
}

/*--------------------------------------------------------------*/
/* Movilidades - equipos registrados y tareas de mantenimiento
/*--------------------------------------------------------------*/

function equipos_registrados($departamento){
  global $db;
  if($departamento == 1){
    $sql  =" SELECT *";
    $sql  .=" FROM equipos";
    $sql  .=" WHERE condicion = '1' ORDER BY idequipos DESC";
    return find_by_sql($sql);
  }else{
    $sql  =" SELECT *";
    $sql  .=" FROM equipos";
    $sql  .=" WHERE iddepartamentos = '{$departamento}' AND condicion = '1' ORDER BY idequipos DESC";
    return find_by_sql($sql);
  }
}

function tareas_mantenimientos($departamento){
  global $db;
  if($departamento == 1){
    $sql  =" SELECT m.idtareas_mantenimientos,m.descripcion,m.ultimo_fecha,m.ultimo_km,m.proximo_fecha,m.proximo_km,m.iddepartamentos,e.nombre,e.patente";
    $sql  .=" FROM tareas_mantenimientos m";
    $sql  .=" LEFT JOIN equipos e ON e.idequipos = m.idequipos";
    $sql  .=" WHERE m.condicion=1 ORDER BY m.idtareas_mantenimientos DESC";
    return find_by_sql($sql);
  }else{ 
    $sql  =" SELECT m.idtareas_mantenimientos,m.descripcion,m.ultimo_fecha,m.ultimo_km,m.proximo_fecha,m.proximo_km,m.iddepartamentos,e.nombre,e.patente";
    $sql  .=" FROM tareas_mantenimientos m";
    $sql  .=" LEFT JOIN equipos e ON e.idequipos = m.idequipos";
    $sql  .=" WHERE m.iddepartamentos={$departamento} AND m.condicion=1 ORDER BY m.idtareas_mantenimientos DESC";
    return find_by_sql($sql);
  }
}

function tarea_mantenimiento($id){
  global $db;
  $id = (int)$id;
  $sql  = $db->query("SELECT m.idtareas_mantenimientos,m.descripcion,m.ultimo_fecha,m.ultimo_km,m.proximo_fecha,m.proximo_km,m.iddepartamentos,e.nombre,e.patente FROM tareas_mantenimientos m LEFT JOIN equipos e ON e.idequipos = m.idequipos WHERE m.idtareas_mantenimientos = {$id} ORDER BY m.idtareas_mantenimientos DESC");
  if($result = $db->fetch_assoc($sql)){
    return $result;
  }
  else{
    return null;
  }
}


/*--------------------------------------------------------------*/
/* Function to update the last log in of a user
/*--------------------------------------------------------------*/

function actualizar_login($user_id)
{
  global $db;
  $date = make_date();
  $sql = "UPDATE users SET login='{$date}' WHERE id ='{$user_id}' LIMIT 1";
  $result = $db->query($sql);
  return ($result && $db->affected_rows() === 1 ? true : false);
}


/*--------------------------------------------------------------*/
/* BUSCAR USUARIO CONECTADO POR NUMERO DE ID 
/*--------------------------------------------------------------*/
function current_user(){
  static $current_user;
  global $db;
  if(!$current_user){
    if(isset($_SESSION['user_id'])):
      $user_id = intval($_SESSION['user_id']);
      $current_user = find_by_id_user('users',$user_id);
    endif;
  }
  return $current_user;
}


/*--------------------------------------------------------------*/
/* BUSQUEDA DE USUARIOS
/*--------------------------------------------------------------*/
function all_usuarios(){
  global $db;
  $results = array();
  $sql = "SELECT * FROM users ORDER BY iddepartamentos ASC";
  $result = find_by_sql($sql);
  return $result;
}

function all_usuarios_chat($id){
  global $db;
  $results = array();
  $sql = "SELECT * FROM users WHERE id != $id AND condicion=1 ORDER BY iddepartamentos ASC";
  $result = find_by_sql($sql);
  return $result;
}

function find_all_user_dpto($departamento){
  global $db;
  if($departamento == 1 || $departamento == 2){
    $sql = "SELECT *";
    $sql .="FROM users";
    $sql .=" WHERE condicion=1 ORDER BY nombre ASC";
    $result = find_by_sql($sql);
    return $result;
  }else{
    $sql = "SELECT *";
    $sql .="FROM users";
    $sql .=" WHERE iddepartamentos={$departamento} AND condicion=1 ORDER BY nombre ASC";
    $result = find_by_sql($sql);
    return $result;
  }
}

function find_all_user_dpto_y_dir($direccion,$departamento){
  global $db;
  $user = current_user();
if($user['idroles'] == 1){
    $sql = "SELECT *";
    $sql .="FROM users";
    $sql .=" WHERE condicion=1 ORDER BY apellido ASC";
    $result = find_by_sql($sql);
    return $result;

}elseif($user['iddepartamentos'] == 2 || $user['idpermisos'] == 1){
    $sql = "SELECT *";
    $sql .="FROM users";
    $sql .=" WHERE iddireccion={$direccion} AND condicion=1 ORDER BY apellido ASC";
    $result = find_by_sql($sql);
    return $result;
  }
elseif($user['iddepartamentos'] != 2 || $user['idpermisos'] >= 2){
    $sql = "SELECT *";
    $sql .="FROM users";
    $sql .=" WHERE iddepartamentos={$departamento} AND iddireccion={$direccion} AND condicion=1 ORDER BY apellido ASC";
    $result = find_by_sql($sql);
    return $result;
  }
}

function all_inspectores(){
  global $db;
  $sql = "SELECT *";
  $sql .="FROM users";
  $sql .=" WHERE iddepartamentos=8 AND idusuarios = 0 OR idusuarios IS NULL ORDER BY nombre ASC";
  $result = find_by_sql($sql);
  return $result;
}

function all_equipo_inspectores(){
  global $db;
  $sql = "SELECT *";
  $sql .="FROM users";
  $sql .=" WHERE iddepartamentos=8 AND idusuarios != 0 ORDER BY nombre ASC";
  $result = find_by_sql($sql);
  return $result;
}

/*--------------------------------------------------------------*/
/* ELIMINAR POR ID Y COLUMNA
/*--------------------------------------------------------------*/

function delete_by_id($table,$column,$id)
{
  global $db;
  if(tableExists($table))
  {
    $sql = "DELETE FROM ".$db->escape($table);
    $sql .= " WHERE ".$db->escape($column)."=".$db->escape($id);
    $sql .= " LIMIT 1";
    $db->query($sql);
    return ($db->affected_rows() === 1) ? true : false;
  }
}


/*--------------------------------------------------------------*/
/* ELIMINAR POR ID Y COLUMNA
/*--------------------------------------------------------------*/

function cambiar_condicion($table,$numero,$column,$id)
{
  global $db;
  if(tableExists($table))
  {
    $sql = "UPDATE ".$db->escape($table);
    $sql .= " SET condicion=".$db->escape($numero)." WHERE ".$db->escape($column)."=".$db->escape($id);
    $db->query($sql);
    return ($db->affected_rows() === 1) ? true : false;
  }
}

function eliminar_dato($table,$column,$id)
{
  global $db;
  if(tableExists($table))
  {
    $sql = "DELETE FROM ".$db->escape($table);
    $sql .= " WHERE ".$db->escape($column)."=".$db->escape($id);
    $db->query($sql);
    return ($db->affected_rows() === 1) ? true : false;
  }
}

function sacar_direccion($table,$numero,$column,$id,$date,$user,$fecha)
{
  global $db;
  if(tableExists($table))
  {
    $sql = "UPDATE ".$db->escape($table);
    $sql .= " SET iddepartamentos='".$db->escape($numero)."', fecha_pase='".$db->escape($date)."', registro_usuario='".$db->escape($user)."', registro_fecha='".$db->escape($fecha)."' WHERE ".$db->escape($column)."=".$db->escape($id);
    $db->query($sql);
    return ($db->affected_rows() === 1) ? true : false;
  }
}


/*--------------------------------------------------------------*/
/* CONTEOS
/*--------------------------------------------------------------*/

function conteo_id($table,$id){
  global $db;
  if(tableExists($table))
  {
    $sql    = "SELECT COUNT(".$db->escape($id).") AS total FROM ".$db->escape($table);
    $result = $db->query($sql);
    return($db->fetch_assoc($result));
  }
}

function conteo_id_activos($table,$id){
  global $db;
  if(tableExists($table))
  {
    $sql    = "SELECT COUNT(".$db->escape($id).") AS total FROM ".$db->escape($table)." WHERE condicion=1";
    $result = $db->query($sql);
    return($db->fetch_assoc($result));
  }
}

function conteo_id_inactivos($table,$id){
  global $db;
  if(tableExists($table))
  {
    $sql    = "SELECT COUNT(".$db->escape($id).") AS total FROM ".$db->escape($table)." WHERE condicion=0";
    $result = $db->query($sql);
    return($db->fetch_assoc($result));
  }
}

function conteo_mensajes_noleido($table,$id,$user){
  global $db;
  if(tableExists($table))
  {
    $sql    = "SELECT COUNT(".$db->escape($id).") AS total FROM ".$db->escape($table)." WHERE estado=0 AND receptor=".$db->escape($user);
    $result = $db->query($sql);
    return($db->fetch_assoc($result));
  }
}

function conteo_mensajes_noleido_chat($table,$id,$user,$users){
  global $db;
  if(tableExists($table))
  {
    $sql    = "SELECT COUNT(".$db->escape($id).") AS total FROM ".$db->escape($table)." WHERE estado=0 AND registro_usuario=".$db->escape($users)." AND receptor=".$db->escape($user);
    $result = $db->query($sql);
    return($db->fetch_assoc($result));
  }
}

// Expedientes

function conteo_expedientes($table,$id,$departamento){
  global $db;
  if(tableExists($table))
  {
    $sql    = "SELECT COUNT(".$db->escape($id).") AS total FROM ".$db->escape($table)." WHERE condicion=1 AND iddepartamentos=".$db->escape($departamento);
    $result = $db->query($sql);
    return($db->fetch_assoc($result));
  }
}

function conteo_expedientes_direccion($table,$id,$direccion){
  global $db;
  if(tableExists($table))
  {
    $sql    = "SELECT COUNT(".$db->escape($id).") AS total FROM ".$db->escape($table)." WHERE condicion=1 AND iddireccion=".$db->escape($direccion);
    $result = $db->query($sql);
    return($db->fetch_assoc($result));
  }
}

function conteo_all_expedientes($table,$id){
  global $db;
  if(tableExists($table))
  {
    $sql    = "SELECT COUNT(".$db->escape($id).") AS total FROM ".$db->escape($table)." WHERE condicion=1";
    $result = $db->query($sql);
    return($db->fetch_assoc($result));
  }
}

// Notas

function conteo_notas($table,$id,$departamento){
  global $db;
  if(tableExists($table))
  {
    $sql    = "SELECT COUNT(".$db->escape($id).") AS total FROM ".$db->escape($table)." WHERE condicion=1 AND iddepartamentos=".$db->escape($departamento);
    $result = $db->query($sql);
    return($db->fetch_assoc($result));
  }
}

function conteo_notas_direccion($table,$id,$direccion){
  global $db;
  if(tableExists($table))
  {
    $sql    = "SELECT COUNT(".$db->escape($id).") AS total FROM ".$db->escape($table)." WHERE condicion=1 AND iddireccion=".$db->escape($direccion);
    $result = $db->query($sql);
    return($db->fetch_assoc($result));
  }
}

function conteo_all_notas($table,$id){
  global $db;
  if(tableExists($table))
  {
    $sql    = "SELECT COUNT(".$db->escape($id).") AS total FROM ".$db->escape($table)." WHERE condicion=1";
    $result = $db->query($sql);
    return($db->fetch_assoc($result));
  }
}

// Proyectos

function conteo_proyectos_construcciones($table,$id){
  global $db;
  if(tableExists($table))
  {
    $sql    = "SELECT COUNT(".$db->escape($id).") AS total FROM ".$db->escape($table);
    $sql .= " WHERE estado = '1' AND idtipo = '0' AND condicion='1'";
    $result = $db->query($sql);
    return($db->fetch_assoc($result));
  }
}

function conteo_proyectos_construcciones_archivo($table,$id){
  global $db;
  if(tableExists($table))
  {
    $sql    = "SELECT COUNT(".$db->escape($id).") AS total FROM ".$db->escape($table);
    $sql .= " WHERE estado = '1' AND idtipo = '0' AND  condicion='0'";
    $result = $db->query($sql);
    return($db->fetch_assoc($result));
  }
}

// Obras
function conteo_obras_construcciones($table,$id){
  global $db;
  if(tableExists($table))
  {
    $sql    = "SELECT COUNT(".$db->escape($id).") AS total FROM ".$db->escape($table)." WHERE idtipo = '0' AND estado != '1'";
    $result = $db->query($sql);
    return($db->fetch_assoc($result));
  }
}

function conteo_obras($table,$id){
  global $db;
  if(tableExists($table))
  {
    $sql    = "SELECT COUNT(".$db->escape($id).") AS total FROM ".$db->escape($table)." WHERE condicion = '1' AND estado != '1'";
    $result = $db->query($sql);
    return($db->fetch_assoc($result));
  }
}

function conteo_obras_archivo($table,$id){
  global $db;
  if(tableExists($table))
  {
    $sql    = "SELECT COUNT(".$db->escape($id).") AS total FROM ".$db->escape($table)." WHERE condicion = '0' AND estado != '1'";
    $result = $db->query($sql);
    return($db->fetch_assoc($result));
  }
}

// Estado de obras

function conteo_bacheos($table,$id){
  global $db;
  if(tableExists($table))
  {
    $sql    = "SELECT COUNT(".$db->escape($id).") AS total FROM ".$db->escape($table);
    $result = $db->query($sql);
    return($db->fetch_assoc($result));
  }
}

function conteo_obras_ejecutadas($table,$id){
  global $db;
  if(tableExists($table))
  {
    $sql    = "SELECT COUNT(".$db->escape($id).") AS total FROM ".$db->escape($table);
    $sql .= " WHERE estado = '0' AND idtipo='0'";

    $result = $db->query($sql);
    return($db->fetch_assoc($result));
  }
}
function conteo_obras_finalizadas($table,$id){
  global $db;
  if(tableExists($table))
  {
    $sql    = "SELECT COUNT(".$db->escape($id).") AS total FROM ".$db->escape($table);
    $sql .= " WHERE estado = '3' AND idtipo='0'";

    $result = $db->query($sql);
    return($db->fetch_assoc($result));
  }
}
function conteo_obras_neutralizadas($table,$id){
  global $db;
  if(tableExists($table))
  {
    $sql    = "SELECT COUNT(".$db->escape($id).") AS total FROM ".$db->escape($table);
    $sql .= " WHERE estado = '4' AND idtipo='0'";

    $result = $db->query($sql);
    return($db->fetch_assoc($result));
  }
}
function conteo_obras_rescindidas($table,$id){
  global $db;
  if(tableExists($table))
  {
    $sql    = "SELECT COUNT(".$db->escape($id).") AS total FROM ".$db->escape($table);
    $sql .= " WHERE estado = '5' AND idtipo='0'";

    $result = $db->query($sql);
    return($db->fetch_assoc($result));
  }
}

// Modificaciones de obras

function conteo_obras_modificaciones($table,$id){
  global $db;
  if(tableExists($table))
  {
    $sql    = "SELECT COUNT(".$db->escape($id).") AS total FROM ".$db->escape($table);
    $sql .= " WHERE condicion='1'";

    $result = $db->query($sql);
    return($db->fetch_assoc($result));
  }
}

function conteo_recepciones_provisorias($table,$id){
  global $db;
  if(tableExists($table))
  {
    $sql    = "SELECT COUNT(".$db->escape($id).") AS total FROM ".$db->escape($table);
    $sql .= " WHERE condicion='1'";

    $result = $db->query($sql);
    return($db->fetch_assoc($result));
  }
}

function conteo_recepciones_definitivas($table,$id){
  global $db;
  if(tableExists($table))
  {
    $sql    = "SELECT COUNT(".$db->escape($id).") AS total FROM ".$db->escape($table);
    $sql .= " WHERE condicion='1'";

    $result = $db->query($sql);
    return($db->fetch_assoc($result));
  }
}

function conteo_recepciones_provisorias_archivo($table,$id){
  global $db;
  if(tableExists($table))
  {
    $sql    = "SELECT COUNT(".$db->escape($id).") AS total FROM ".$db->escape($table);
    $sql .= " WHERE condicion='0'";

    $result = $db->query($sql);
    return($db->fetch_assoc($result));
  }
}

function conteo_recepciones_definitivas_archivo($table,$id){
  global $db;
  if(tableExists($table))
  {
    $sql    = "SELECT COUNT(".$db->escape($id).") AS total FROM ".$db->escape($table);
    $sql .= " WHERE condicion='0'";

    $result = $db->query($sql);
    return($db->fetch_assoc($result));
  }
}

// Iluminacion

function conteo_proyectos_iluminacion($table,$id){
  global $db;
  if(tableExists($table))
  {
    $sql    = "SELECT COUNT(".$db->escape($id).") AS total FROM ".$db->escape($table)." WHERE condicion = '1' AND idtipo = '1'";
    $result = $db->query($sql);
    return($db->fetch_assoc($result));
  }
}

function conteo_proyectos_iluminacion_archivo($table,$id){
  global $db;
  if(tableExists($table))
  {
    $sql    = "SELECT COUNT(".$db->escape($id).") AS total FROM ".$db->escape($table)." WHERE condicion = '0' AND idtipo = '1'";
    $result = $db->query($sql);
    return($db->fetch_assoc($result));
  }
}

// Señalamiento

function conteo_proyectos_senialamiento($table,$id){
  global $db;
  if(tableExists($table))
  {
    $sql    = "SELECT COUNT(".$db->escape($id).") AS total FROM ".$db->escape($table)." WHERE condicion = '1' AND idtipo = '2'";
    $result = $db->query($sql);
    return($db->fetch_assoc($result));
  }
}

function conteo_proyectos_senialamiento_archivo($table,$id){
  global $db;
  if(tableExists($table))
  {
    $sql    = "SELECT COUNT(".$db->escape($id).") AS total FROM ".$db->escape($table)." WHERE condicion = '0' AND idtipo = '2'";
    $result = $db->query($sql);
    return($db->fetch_assoc($result));
  }
}

/*--------------------------------------------------------------*/
/* Recepciones de obras
/*--------------------------------------------------------------*/
function all_recepciones_obras(){
  global $db;
  static $session;
  $user = current_user();
    $sql = "SELECT * FROM recepciones";
    $sql .=" WHERE condicion=1 ORDER BY idrecepciones DESC";
    $result = find_by_sql($sql);
    return $result;
}

function all_recepciones_obras_provisorias(){
  global $db;
  static $session;
  $user = current_user();
    $sql = "SELECT * FROM recepciones";
    $sql .=" WHERE condicion=1 AND tipo='rp' ORDER BY idrecepciones DESC";
    $result = find_by_sql($sql);
    return $result;
}

function all_recepciones_obras_definitivas(){
  global $db;
  static $session;
  $user = current_user();
    $sql = "SELECT * FROM recepciones";
    $sql .=" WHERE condicion=1 AND tipo='rd' ORDER BY idrecepciones DESC";
    $result = find_by_sql($sql);
    return $result;
}

function recepciones_provisorias_construcciones($departamento){
  global $db;
  static $session;
  $user = current_user();
  //if($departamento == 8){  
  //  $sql  =" SELECT r.idrecepciones_provisorias,r.nombre_obras,r.expediente,r.obra,r.expediente_obra,r.fecha_pedido,r.integrantes,r.integrantes_resolucion_fecha,r.integrantes_resolucion_num,r.acta_resolucion,r.acta_fecha,r.observaciones,r.condicion,r.registro_usuario,r.registro_fecha ";
  //  $sql .= " FROM recepciones_provisorias r INNER JOIN obras o ON r.nombre_obras=o.nombre ";
  //  $sql  .=" WHERE o.idinspector='".$user['id']."' OR o.idinspector = '".$user['idusuarios']."' ORDER BY r.fecha_pedido DESC";
  //  return find_by_sql($sql);
  //}else{
    $sql = "SELECT * FROM recepciones_provisorias";
    $sql .=" WHERE condicion=1 ORDER BY fecha_pedido DESC";
    $result = find_by_sql($sql);
    return $result;
  //}
}

function recepciones_definitivas_construcciones($departamento){
  global $db;
  static $session;
  $user = current_user();
  //if($departamento == 8){  
  //  $sql  =" SELECT r.idrecepciones_definitivas,r.nombre_obras,r.expediente,r.obra,r.expediente_obra,r.fecha_pedido,r.integrantes,r.integrantes_resolucion_fecha,r.integrantes_resolucion_num,r.acta_resolucion,r.acta_fecha,r.observaciones,r.condicion,r.registro_usuario,r.registro_fecha ";
  //  $sql .= " FROM recepciones_definitivas r INNER JOIN obras o ON r.nombre_obras=o.nombre ";
  //  $sql  .=" WHERE o.idinspector='".$user['id']."' OR o.idinspector = '".$user['idusuarios']."' ORDER BY r.fecha_pedido DESC";
  //  return find_by_sql($sql);
  //}else{
    $sql = "SELECT * FROM recepciones_definitivas";
    $sql .=" WHERE condicion=1 ORDER BY fecha_pedido DESC";
    $result = find_by_sql($sql);
    return $result;
  //}
}

function recepciones_provisorias_construcciones_archivo(){
  global $db;
  $sql = "SELECT * FROM recepciones_provisorias";
  $sql .=" WHERE condicion=0";
  $result = find_by_sql($sql);
  return $result;
}

function recepciones_definitivas_construcciones_archivo(){
  global $db;
  $sql = "SELECT * FROM recepciones_definitivas";
  $sql .=" WHERE condicion=0";
  $result = find_by_sql($sql);
  return $result;
}

function rp_movimientos($nota,$expediente){
  global $db;
  if(!empty($expediente)){
    $sql  =" SELECT *";
    $sql  .=" FROM rp_movimientos WHERE idexpedientes='$expediente' ";
    $sql  .=" ORDER BY idrp_movimientos ASC";
    return find_by_sql($sql);
  }
  if(!empty($nota)){
    $sql  =" SELECT *";
    $sql  .=" FROM rp_movimientos WHERE idnotas='$nota' ";
    $sql  .=" ORDER BY idrp_movimientos ASC";
    return find_by_sql($sql);
  }  
}

function rd_movimientos($nota,$expediente){
  global $db;
  if(!empty($expediente)){
    $sql  =" SELECT *";
    $sql  .=" FROM rd_movimientos WHERE idexpedientes='$expediente' ";
    $sql  .=" ORDER BY idrd_movimientos ASC";
    return find_by_sql($sql);
  }
  if(!empty($nota)){
    $sql  =" SELECT *";
    $sql  .=" FROM rd_movimientos WHERE idnotas='$nota' ";
    $sql  .=" ORDER BY idrd_movimientos ASC";
    return find_by_sql($sql);
  } 
}

function recepciones_expedientes($ref){
  global $db;
  $sql  =" SELECT * FROM expedientes WHERE expediente='$ref'";
  return find_by_sql($sql);
}

function recepciones_notas($ref){
  global $db;
  $sql  =" SELECT * FROM notas WHERE referencia='$ref'";
  return find_by_sql($sql);
}


/*--------------------------------------------------------------*/
/* EXPEDIENTES CONSULTAS
/*--------------------------------------------------------------*/

// LOCAL DPV

function buscar_expediente($exp){
  global $db_exp;
  $sql = "SELECT * FROM tbase WHERE numero = {$exp}";
  $result = $db_exp->query($sql);
  return($db_exp->fetch_array($result));
}

function pases_expediente($exp){
  global $db_exp;
  $sql = "SELECT * FROM tmovi WHERE numero = {$exp} ORDER BY fecha DESC;";
  $result = $db_exp->query($sql);
  return $result;
}

function ul_mov_exp($exp){
  global $db_exp;
  $sql = "SELECT * FROM tmovi WHERE numero = {$exp} ORDER BY id DESC LIMIT 1;";
  $result = $db_exp->query($sql);
  return($db_exp->fetch_array($result));
}

function ul_mov_tramite($exp){
  global $db;
  $sql = "SELECT * FROM tramites_movimientos WHERE idtramites = '{$exp}' ORDER BY idtramites_movimientos DESC LIMIT 1";
  $result = $db->query($sql);
  return($db->fetch_array($result));
}


function buscar_expediente_asunto($exp){
  global $db_exp;
  if(isset($exp)){
    $sql = "SELECT asunto FROM tbase WHERE numero = {$exp}";
    $result = $db_exp->query($sql);
    $asunto = $db_exp->fetch_array($result);
    return utf8_encode($asunto['asunto']);
  }
}

// SISTEMA SAC

function expedientes_departamento($direccion,$departamento){
  global $db;
  global $session;  
  $user = current_user();
  if($user['idroles'] == 1  || $departamento == 2){
    $sql   = " SELECT * FROM expedientes WHERE condicion=1 ORDER BY idexpedientes ASC";
    return find_by_sql($sql);
  }elseif($user['idpermisos'] == 1){
    $sql = " SELECT * FROM expedientes WHERE iddireccion=".$db->escape($direccion)." ORDER BY idexpedientes ASC";
    return find_by_sql($sql);
  }elseif($user['idpermisos'] >= 2){
    $sql = " SELECT * FROM expedientes WHERE iddireccion=".$db->escape($direccion)." AND iddepartamentos=".$db->escape($departamento)." ORDER BY idexpedientes ASC";
    return find_by_sql($sql);
  }



  global $db;
  if($departamento == 1 || $departamento == 2){
    $sql  =" SELECT *";
    $sql  .=" FROM expedientes WHERE condicion=1 AND iddepartamentos!=10";
    $sql  .=" ORDER BY prioridad ASC";
    return find_by_sql($sql);
  }else{
    $sql  =" SELECT *";
    $sql  .=" FROM expedientes WHERE iddepartamentos={$departamento} AND iddepartamentos!=10 AND condicion=1";
    $sql  .=" ORDER BY prioridad ASC";
    return find_by_sql($sql);
  }
}

function expedientes_departamento_archivos($departamento){
  global $db;
  if($departamento == 1 || $departamento == 2){
    $sql  =" SELECT *";
    $sql  .=" FROM expedientes WHERE condicion=0 AND iddepartamentos!=10";
    $sql  .=" ORDER BY prioridad ASC";
    return find_by_sql($sql);
  }else{
    $sql  =" SELECT *";
    $sql  .=" FROM expedientes WHERE iddepartamentos={$departamento} AND iddepartamentos!=10 AND condicion=0";
    $sql  .=" ORDER BY prioridad ASC";
    return find_by_sql($sql);  
  }
}

function expedientes_departamento_salidos($departamento){
  global $db;
  if($departamento == 1 || $departamento == 2){
    $sql  =" SELECT *";
    $sql  .=" FROM expedientes WHERE iddepartamentos=10";
    $sql  .=" ORDER BY prioridad ASC";
    return find_by_sql($sql);
  }else{
    $sql  =" SELECT *";
    $sql  .=" FROM expedientes WHERE iddepartamentos={$departamento} AND iddepartamentos=10";
    $sql  .=" ORDER BY prioridad ASC";
    return find_by_sql($sql);  
  }
}

function listar_notas($direccion,$departamento){
  global $db;
  global $session;  
  $user = current_user();
  if($user['idroles'] == 1 || $departamento == 2){
    $sql   = " SELECT * FROM notas ORDER BY prioridad ASC";
    return find_by_sql($sql);
  }elseif($user['idpermisos'] == 1){
    $sql = " SELECT * FROM notas WHERE iddireccion=".$db->escape($direccion)." ORDER BY prioridad ASC";
    return find_by_sql($sql);
  }elseif($user['idpermisos'] >= 2){
    $sql = " SELECT * FROM notas WHERE iddireccion=".$db->escape($direccion)." AND iddepartamentos=".$db->escape($departamento)." ORDER BY prioridad ASC";
    return find_by_sql($sql);
  }
}

function notas_departamento_archivos($departamento){
  global $db;
  if($departamento == 1 || $departamento == 2){
    $sql  =" SELECT *";
    $sql  .=" FROM notas WHERE condicion=0 AND iddepartamentos!=10";
    $sql  .=" ORDER BY prioridad ASC";
    return find_by_sql($sql);
  }else{
    $sql  =" SELECT *";
    $sql  .=" FROM notas WHERE iddepartamentos={$departamento} AND iddepartamentos!=10 AND condicion=0";
    $sql  .=" ORDER BY prioridad ASC";
    return find_by_sql($sql);  
  }
}

function notas_departamento_salidos($departamento){
  global $db;
  if($departamento == 1 || $departamento == 2){
    $sql  =" SELECT *";
    $sql  .=" FROM notas WHERE iddepartamentos!=10";
    $sql  .=" ORDER BY prioridad ASC";
    return find_by_sql($sql);
  }else{
    $sql  =" SELECT *";
    $sql  .=" FROM notas WHERE iddepartamentos={$departamento} AND iddepartamentos!=10";
    $sql  .=" ORDER BY prioridad ASC";
    return find_by_sql($sql);  
  }
}

function expedientes(){
  global $db;
  $sql  =" SELECT *";
  $sql  .=" FROM expedientes WHERE condicion=1";
  $sql  .=" ORDER BY prioridad ASC";
  return find_by_sql($sql);
}

function expedientes_archivos(){
  global $db;
  $sql  =" SELECT *";
  $sql  .=" FROM expedientes WHERE condicion=0";
  $sql  .=" ORDER BY prioridad ASC";
  return find_by_sql($sql);
}

function expedientes_movimientos($numero){
  global $db;
  $sql  =" SELECT *";
  $sql  .=" FROM expedientes_movimientos WHERE idexpedientes='$numero'";
  $sql  .=" ORDER BY idexpedientes_movimientos DESC";
  return find_by_sql($sql);
}
function tramites_movimientos($numero){
  global $db;
  $sql  =" SELECT *";
  $sql  .=" FROM tramites_movimientos WHERE idtramites='$numero'";
  $sql  .=" ORDER BY idtramites_movimientos DESC";
  return find_by_sql($sql);
}

/*-------------------------------------------------------------*/
/* CARGA DE DATOS DE INSPECCION
/*--------------------------------------------------------------*/

function info_certificado($dato){
  global $db;
  $sql  =" SELECT * FROM certificados_obras";
  $sql .=" WHERE idcertificados_obras={$dato} ";
  $result = $db->query($sql);
  return($db->fetch_assoc($result));
}

function info_items_certificado($dato,$dato2){
  global $db;
  $sql  =" SELECT * FROM certificados_obras_items";
  $sql .=" WHERE idcertificados_obras={$dato} AND idobras_items={$dato2}";
  $result = $db->query($sql);
  return($db->fetch_assoc($result));
}

function info_descuento_certificado($id,$descuento){
  global $db;
  $sql  =" SELECT * FROM certificados_obras_descuentos";
  $sql .=" WHERE idcertificados_obras={$id} AND idcertificados_descuentos={$descuento} ";
  $result = $db->query($sql);
  return($db->fetch_assoc($result));
}

function informes_inspeccion($dato){
  global $db;
  $sql  =" SELECT * FROM informes_inspeccion";
  $sql .=" WHERE idobras={$dato} ORDER BY idinformes_inspeccion ASC";
  return find_by_sql($sql);
}

function all_informes_inspeccion(){
  global $db;
  $sql  =" SELECT * FROM informes_inspeccion ORDER BY registro_fecha DESC";
  return find_by_sql($sql);
}

function certificados_inspeccion($dato){
  global $db;
  $sql  =" SELECT * FROM certificados_obras";
  $sql .=" WHERE idobras={$dato} ORDER BY idcertificados_obras DESC";
  return find_by_sql($sql);
}

function certificados_red_inspeccion($dato){
  global $db;
  $sql  =" SELECT * FROM certificados_obras_redeterminados";
  $sql .=" WHERE idobras={$dato} ORDER BY idcertificados_obras_redeterminados DESC";
  return find_by_sql($sql);
}

function asistencias_inspeccion($dato){
  global $db;
  $sql  =" SELECT * FROM asistencia_inspeccion";
  $sql .=" WHERE idobras={$dato} ORDER BY idasistencia_inspeccion ASC";
  return find_by_sql($sql);
}

function all_asistencias(){
  global $db;
  $sql  =" SELECT * FROM asistencia_inspeccion";
  $sql .=" ORDER BY idasistencia_inspeccion ASC";
  return find_by_sql($sql);
}

function ordenes_de_servicio($id){
  global $db;
  $sql  =" SELECT *";
  $sql  .=" FROM ordenes_de_servicio";
  $sql  .=" WHERE idobras={$id}";
  return find_by_sql($sql);
}  

function ensayos_laboratorio($id){
  global $db;
  $sql  =" SELECT *";
  $sql  .=" FROM obras_laboratorios";
  $sql  .=" WHERE idobras={$id}";
  return find_by_sql($sql);
}  

function notas_de_pedido($id){
  global $db;
  $sql  =" SELECT *";
  $sql  .=" FROM notas_de_pedido";
  $sql  .=" WHERE idobras={$id}";
  return find_by_sql($sql);
}  

function ensayos_suelo($id){
  global $db;
  $sql  =" SELECT *";
  $sql  .=" FROM obras_laboratorios";
  $sql  .=" WHERE idobras={$id} AND tipo=0";
  return find_by_sql($sql);
}  

function ensayos_hormigon($id){
  global $db;
  $sql  =" SELECT *";
  $sql  .=" FROM obras_laboratorios";
  $sql  .=" WHERE idobras={$id} AND tipo=1";
  return find_by_sql($sql);
}  
function ensayos_asfalto($id){
  global $db;
  $sql  =" SELECT *";
  $sql  .=" FROM obras_laboratorios";
  $sql  .=" WHERE idobras={$id} AND tipo=2";
  return find_by_sql($sql);
}  

function obras_inspeccion($id,$idusuarios){
  global $db;
  static $session;  
  if($idusuarios == 0){  
      $sql  =" SELECT * FROM obras WHERE idinspector='{$id}' ORDER BY certificado_porcentaje DESC";
      return find_by_sql($sql);
    }else{
      $sql  =" SELECT * FROM obras WHERE idinspector='{$idusuarios}' ORDER BY certificado_porcentaje DESC";
      return find_by_sql($sql);
    }
  }

  function consultar_n_certificado($dato,$obra){
    global $db;
    $sql  =" SELECT * FROM certificados_obras";
    $sql .=" WHERE numero={$dato} AND idobras={$obra}";
    $result = $db->query($sql);
    return($db->fetch_assoc($result));
  }  

/*--------------------------------------------------------------*/
/* LISTAR ULTIMOS
/*--------------------------------------------------------------*/
function ultimos_expedientes($departamento,$id,$limit){
  global $db;
  if($departamento != 1 && $departamento != 2){
    $sql   = " SELECT * FROM expedientes";
    $sql  .= " ORDER BY ".$db->escape($id)." DESC LIMIT ".$db->escape((int)$limit);
    return find_by_sql($sql);
  } else{
    $sql   = " SELECT * FROM expedientes WHERE iddepartamentos=".$db->escape($departamento);
    $sql  .= " ORDER BY ".$db->escape($id)." DESC LIMIT ".$db->escape((int)$limit);
    return find_by_sql($sql);
  }
}

function ultimas_notas($departamento,$id,$limit){
  global $db;
  if($departamento != 1 && $departamento != 2){
    $sql   = " SELECT * FROM notas";
    $sql  .= " ORDER BY ".$db->escape($id)." DESC LIMIT ".$db->escape((int)$limit);
    return find_by_sql($sql);
  } else{
    $sql   = " SELECT * FROM notas WHERE iddepartamentos=".$db->escape($departamento);
    $sql  .= " ORDER BY ".$db->escape($id)." DESC LIMIT ".$db->escape((int)$limit);
    return find_by_sql($sql);
  }
}

function ultimos_proyectos($estado,$tipo,$id,$limit){
  global $db;
  $sql   = " SELECT * FROM obras WHERE estado=".$db->escape($estado)." AND idtipo=".$db->escape($tipo);
  $sql  .= " ORDER BY ".$db->escape($id)." DESC LIMIT ".$db->escape((int)$limit);
  return find_by_sql($sql);
}

function ultimos_registros($table,$id,$limit){
  global $db;
  $sql   = " SELECT * FROM ".$db->escape($table);
  $sql  .= " ORDER BY ".$db->escape($id)." DESC LIMIT ".$db->escape((int)$limit);
  return find_by_sql($sql);
}

function ultimos_certificados($limit){
  global $db;
  $sql   = "SELECT * FROM obras ORDER BY registro_certificados_fecha DESC LIMIT ".$db->escape((int)$limit);
  return find_by_sql($sql);
}


/*--------------------------------------------------------------*/
/* SUMAS DE COLUMNAS
/*--------------------------------------------------------------*/

function sumar($column,$table,$estado,$condicion,$idtipo,$mas){
  global $db;
  $sql    = "SELECT SUM($column) AS total FROM $table WHERE estado = $estado AND condicion = $condicion AND idtipo = $idtipo $mas";
  $result = $db->query($sql);
  return($db->fetch_assoc($result));
}

function sumar_todo($column,$table,$condicion,$mas){
  global $db;
  $sql    = "SELECT SUM($column) AS total FROM $table WHERE condicion = $condicion $mas";
  $result = $db->query($sql);
  return($db->fetch_assoc($result));
}

function suma_estadistica($column,$table,$mas){
  global $db;
  $sql    = "SELECT SUM($column) AS total FROM $table $mas";
  $result = $db->query($sql);
  return($db->fetch_assoc($result));
}

function sumar_anticipo($column,$table,$idobra){
  global $db;
  $sql    = "SELECT SUM($column) AS total FROM $table WHERE idobras=$idobra";
  $result = $db->query($sql);
  return($db->fetch_assoc($result));
}

/*-------------------------------------------------------------*/
/* NOTIFICACIONES
/*--------------------------------------------------------------*/
function find_all_user_msj($table,$id) {
  global $db;
  if(tableExists($table))
  {
    return find_by_sql("SELECT * FROM ".$db->escape($table)." WHERE id != '{$db->escape($id)}'");
  }
}

function notificaciones(){
  global $db;
  $sql = "SELECT * FROM notificaciones ORDER BY idnotificacion DESC ";
  $result = find_by_sql($sql);
  return $result;
}


function all_notificaciones_activos(){
  global $db;
  $sql = "SELECT * FROM notificaciones WHERE condicion=1 ORDER BY idnotificacion DESC ";
  $result = find_by_sql($sql);
  return $result;
}

function all_notificaciones_inactivos(){
  global $db;
  $sql = "SELECT * FROM notificaciones WHERE condicion=0 ORDER BY idnotificacion DESC ";
  $result = find_by_sql($sql);
  return $result;
}

/*--------------------------------------------------------------*/
/* Mensajes de notificaciones
/* Funcion para seleccionar todos los mensajes privados recibidos
/*--------------------------------------------------------------*/
function all_mensajes($id){
  global $db;
  $sql = "SELECT * FROM mensajes WHERE registro_usuario = '{$db->escape($id)}' ORDER BY idmensajes DESC ";
  $result = find_by_sql($sql);
  return $result;
}

function mensajes_privados_recibidos($id){
  global $db;
  $sql = "SELECT n.idmsj, n.mensaje, n.estado, n.autor, n.receptor, n.privado, n.date, u.id, u.name ";
  $sql .=" FROM notificaciones n INNER JOIN users u ON n.autor = u.id ";
  $sql .=" WHERE n.receptor = '{$db->escape($id)}' AND n.privado=1 ORDER BY n.idmsj DESC ";
  $result = find_by_sql($sql);
  return $result;
}

/*--------------------------------------------------------------*/
/* Mensajes de notificaciones
/* Funcion para seleccionar todos los mensajes privados enviados
/*--------------------------------------------------------------*/

function mensajes_privados_enviados($id){
  global $db;
  $sql = "SELECT n.idmsj, n.mensaje, n.estado, n.autor, n.receptor, n.privado, n.date, u.id, u.name";
  $sql .=" FROM notificaciones n INNER JOIN users u ON n.receptor = u.id";
  $sql .=" WHERE n.autor = '{$db->escape($id)}' AND n.privado=1 ORDER BY n.idmsj DESC";
  $result = find_by_sql($sql);
  return $result;
}

function mensajes_sin_leer($id){
  global $db;
  $user = current_user();
  if(!empty($user['id'])){
    $sql  = "SELECT COUNT(idnotificaciones) AS total FROM notificaciones ";
    $sql .= " WHERE receptor={$id} AND estado=0";
    $result = $db->query($sql);
    return($db->fetch_assoc($result));
  }else{
    $session->msg("d", "Sesion caducada, vuelva a iniciar sesion.");
    redirect('panel', false);    
  }
}

function leer_mensajes($id)
{
  global $db;
  if(tableExists($table))
  {
    $sql = "UPDATE notificaciones";
    $sql .= " SET estado='1' WHERE idnotificaciones='". $db->escape($id)."';";
    $db->query($sql);
    return ($db->affected_rows() === 1) ? true : false;
  }
}


/*-------------------------------------------------------------*/
/* MAPA LEAFLET
/*--------------------------------------------------------------*/

function all_puntos()
{
  global $db;
  $array = array();
  $sql = "SELECT * from mapa_punto where condicion=1 AND tipo=0 order by idmapa_punto ASC";
  $result = $db->query($sql);
  while ($row = $result->fetch_assoc()) {
    $array[] = [ "idmapa_punto" => $row['idmapa_punto'], "idobras" => $row['idobras'], "titulo" => $row['titulo'], "descripcion" => $row['descripcion'], "latitud" => $row['latitud'], "longitud" => $row['longitud'], "tipo" => $row['tipo'], "condicion" => $row['condicion']];
  }
  return $array;
}

function obra_puntos($id)
{
  global $db;
  $array = array();
  $sql = "SELECT idmapa_punto, titulo, descripcion, latitud, longitud, condicion from mapa_punto where idobras=$id AND condicion=1 order by idmapa_punto ASC";
  $result = $db->query($sql);
  while ($row = $result->fetch_assoc()) {
    $array[] = [ "idmapa_punto" => $row['idmapa_punto'], "titulo" => $row['titulo'], "descripcion" => $row['descripcion'], "latitud" => $row['latitud'], "longitud" => $row['longitud'], "condicion" => $row['condicion']];
  }
  return $array;
}

function add_punto($company, $latitude, $longitude, $obra_id)
{
  global $db;
  $statement = $db->con->prepare("INSERT INTO mapa_marker( company, latitude, longitude, obra_id) VALUES( ?, ?, ?, ?)");
  $statement->bind_param('ssss', $company, $latitude, $longitude, $obra_id);
  $statement->execute();
  $statement->close();
  $this->conn->close();
}

function update_punto( $id, $details, $latitude, $longitude, $telephone, $keywords)
{
  global $db;
  $statement = $db->con->prepare("UPDATE mapa_marker SET details = ?,latitude = ?,longitude = ?,telephone = ?,keywords = ? where id = ?");
  $statement->bind_param( 'sssssi', $details, $latitude, $longitude, $telephone, $keywords, $id);
  $statement->execute();
  $statement->close();

}

function delete_punto($id)
{
  global $db;
  $statement = $db->con->prepare("DELETE FROM mapa_marker WHERE id = ?");
  $statement->bind_param('i', $id);
  $statement->execute();
  $statement->close();
}

function all_lineas()
{
  global $db;
  $array = array();
  $sql = "SELECT * from mapa_linea where condicion=1 AND tipo=0 order by idmapa_linea ASC";
  $result = $db->query($sql);
  while ($row = $result->fetch_assoc()) {
    $array[] = [ "idmapa_linea" => $row['idmapa_linea'], "idobras" => $row['idobras'], "titulo" => $row['titulo'], "descripcion" => $row['descripcion'], "georeferencia" => $row['georeferencia'], "estado" => $row['estado'], "condicion" => $row['condicion']];
  }
  return $array;
}

function obra_lineas($id)
{
  global $db;
  $array = array();
  $sql = "SELECT idmapa_linea, titulo, descripcion, georeferencia, color, condicion from mapa_linea where idobras=$id AND condicion=1 order by idmapa_linea ASC";
  $result = $db->query($sql);
  while ($row = $result->fetch_assoc()) {
    $array[] = [ "idmapa_linea" => $row['idmapa_linea'], "titulo" => $row['titulo'], "descripcion" => $row['descripcion'], "georeferencia" => $row['georeferencia'], "color" => $row['color'], "condicion" => $row['condicion']];
  }
  return $array;
}

function add_linea( $street, $geo, $obra_id)
{
  global $db;
  $statement = $db->prepare("INSERT INTO mapa_ruta( name, geolocations, obra_id ) VALUES( ?, ?, ?)");
  $statement->bind_param( 'sss', $street, $geo, $obra_id);
  $statement->execute();
  $statement->close();

}

function update_linea( $id, $geo, $keywords)
{
  global $db;
  $statement = $db->prepare( "UPDATE mapa_ruta SET geolocations = ?, keywords = ? where id = ?");
  $statement->bind_param( 'ssi', $geo, $keywords, $id);
  $statement->execute();
  $statement->close();

}

function delete_linea($id)
{
  global $db;
  $statement = $db->prepare("DELETE FROM mapa_ruta WHERE id = ?");
  $statement->bind_param('i', $id);
  $statement->execute();
  $statement->close();

}

function all_areas()
{  
  global $db;
  $arr = array();
  $statement = $db->prepare( "SELECT id, name, geolocations, keywords from mapa_area order by name ASC");
  $statement->bind_result( $id, $name, $geolocations, $keywords);
  $statement->execute();
  while ($statement->fetch()) {
    $arr[] = [ "id" => $id, "name" => $name, "geolocations" => $geolocations, "keywords" => $keywords];
  }
  $statement->close();

  return $arr;
}

function obra_areas()
{  
  global $db;
  $arr = array();
  $statement = $db->prepare( "SELECT id, name, geolocations, keywords from mapa_area order by name ASC");
  $statement->bind_result( $id, $name, $geolocations, $keywords);
  $statement->execute();
  while ($statement->fetch()) {
    $arr[] = [ "id" => $id, "name" => $name, "geolocations" => $geolocations, "keywords" => $keywords];
  }
  $statement->close();

  return $arr;
}

function add_area( $area, $geo, $keywords)
{  
  global $db;
  $statement = $db->prepare( "INSERT INTO mapa_area( name, geolocations, keywords ) VALUES(?,?,?)");
  $statement->bind_param( 'sss', $area, $geo,$keywords);
  $statement->execute();
  $statement->close();

}

function update_area( $id, $geo, $keywords)
{
  global $db;
  $statement = $db->prepare("UPDATE mapa_area SET geolocations = ?, keywords = ? where id = ?");
  $statement->bind_param( 'ssi', $geo, $keywords, $id);
  $statement->execute();
  $statement->close();

}

function delete_area($id)
{
  global $db;
  $statement = $db->prepare("Delete from mapa_area where id = ?");
  $statement->bind_param('i', $id);
  $statement->execute();
  $statement->close();
}


/*--------------------------------------------------------------*/
/* BUSCAR EXPEDIENTES POR FECHA
/*--------------------------------------------------------------*/
function buscar_por_fecha($table,$start_date,$end_date,$direccion,$departamento){
  global $db;
  $start_date  = date("Y-m-d", strtotime($start_date));
  $end_date    = date("Y-m-d", strtotime($end_date));
    $sql  = "SELECT * FROM {$table} ";
    $sql .= " WHERE iddireccion = '{$direccion}' AND iddepartamentos = '{$departamento}' AND fecha_pase BETWEEN '{$start_date}' AND '{$end_date}'";
    $sql .= " ORDER BY DATE(fecha_pase) DESC";
  return $db->query($sql);
}

function buscar_por_fecha_dir($table,$start_date,$end_date,$direccion){
  global $db;
  $start_date  = date("Y-m-d", strtotime($start_date));
  $end_date    = date("Y-m-d", strtotime($end_date));
    $sql  = "SELECT * FROM {$table} ";
    $sql .= " WHERE iddireccion = '{$direccion}' AND fecha_pase BETWEEN '{$start_date}' AND '{$end_date}'";
    $sql .= " ORDER BY DATE(fecha_pase) DESC";
  return $db->query($sql);
}

function buscar_por_fecha_todo($table,$start_date,$end_date){
  global $db;
  $start_date  = date("Y-m-d", strtotime($start_date));
  $end_date    = date("Y-m-d", strtotime($end_date));
    $sql  = "SELECT * FROM {$table} ";
    $sql .= " WHERE fecha_pase BETWEEN '{$start_date}' AND '{$end_date}'";
    $sql .= " ORDER BY DATE(fecha_pase) DESC";
  return $db->query($sql);
}

/*--------------------------------------------------------------*/
/* INVENTARIOS
/*--------------------------------------------------------------*/

function inventario_disponibles($direccion,$departamento){
  global $db;
  global $session;  
  $user = current_user();
  if($user['idroles'] == 1 || permiso('observador')){
    $sql   = " SELECT * FROM insumos ORDER BY idinsumos ASC";
    return find_by_sql($sql);
  }else{
    $sql = " SELECT * FROM insumos WHERE iddepartamentos=".$db->escape($departamento)." ORDER BY idinsumos ASC";
    return find_by_sql($sql);
  }
}

function inventario_retirados($direccion,$departamento){
  global $db;
  global $session;  
  $user = current_user();
  if($user['idroles'] == 1 || permiso('observador')){
    $sql   = " SELECT * FROM insumos_retirados ORDER BY idinsumos_retirados ASC";
    return find_by_sql($sql);
  }else{
    $sql = " SELECT * FROM insumos_retirados WHERE iddepartamentos=".$db->escape($departamento)." ORDER BY idinsumos_retirados ASC";
    return find_by_sql($sql);
  }
}

function listar_proveedores($direccion,$departamento){
  global $db;
  global $session;  
  $user = current_user();
  if($user['idroles'] == 1 || permiso('observador')){
    $sql   = " SELECT * FROM proveedores ORDER BY idproveedores ASC";
    return find_by_sql($sql);
  }else{
    $sql = " SELECT * FROM proveedores WHERE iddepartamentos=".$db->escape($departamento)." ORDER BY idproveedores ASC";
    return find_by_sql($sql);
  }
}

function listar_categorias($direccion,$departamento){
  global $db;
  global $session;  
  $user = current_user();
  if($user['idroles'] == 1 || permiso('observador')){
    $sql   = " SELECT * FROM categorias ORDER BY idcategorias ASC";
    return find_by_sql($sql);
  }else{
    $sql = " SELECT * FROM categorias WHERE iddepartamentos=".$db->escape($departamento)." ORDER BY idcategorias ASC";
    return find_by_sql($sql);
}
}

function listar_categorias_activas($direccion,$departamento){
  global $db;
  global $session;  
  $user = current_user();
  if($user['idroles'] == 1 || permiso('observador')){
    $sql   = " SELECT * FROM categorias WHERE condicion=1 ORDER BY idcategorias ASC";
    return find_by_sql($sql);
  }else{
    $sql = " SELECT * FROM categorias WHERE condicion=1 AND iddepartamentos=".$db->escape($departamento)." ORDER BY idcategorias ASC";
    return find_by_sql($sql);
  }
}


function listar_dpto_director($direccion){
  global $db;
  $sql = "SELECT * FROM departamentos WHERE nombre = 'Director' AND iddireccion='$direccion'";
  $result = find_by_sql($sql);
  return $result;
}

function all_usuarios_registrados(){
  global $db;
  if(tableExists($table))
  {
    $sql    = "SELECT COUNT('id') AS total FROM users";
    $result = $db->query($sql);
    return($db->fetch_assoc($result));
  }
}

function usuarios_activos(){
  global $db;
  if(tableExists($table))
  {
    $sql    = "SELECT COUNT('id') AS total FROM users WHERE condicion='1'";
    $result = $db->query($sql);
    return($db->fetch_assoc($result));
  }
}

function usuarios_inactivos(){
  global $db;
  if(tableExists($table))
  {
    $sql    = "SELECT COUNT('id') AS total FROM users WHERE condicion='0'";
    $result = $db->query($sql);
    return($db->fetch_assoc($result));
  }
}

function fechas_inicios_obra(){
  global $db;
  $start_date  = date("Y-m-d", strtotime($start_date));
  $fecha_actual = make_date();
  $year = date("Y");
  $end_date    = date("Y-m-d", strtotime($fecha_actual));
    $sql  = "SELECT COUNT('idobras') AS total FROM obras ";
    $sql .= " WHERE idtipo = '0' AND estado != '1' AND acta_inicio BETWEEN '".$year."-01-01' AND '".$end_date."'";
    $result = $db->query($sql);
    return($db->fetch_assoc($result));
}

function fechas_fin_obra(){
  global $db;
  $start_date  = date("Y-m-d", strtotime($start_date));
  $fecha_actual = make_date();
  $year = date("Y");
  $end_date    = date("Y-m-d", strtotime($fecha_actual));
    $sql  = "SELECT COUNT('idobras') AS total FROM obras ";
    $sql .= " WHERE idtipo = '0' AND estado != '1' AND acta_inicio BETWEEN '".$end_date."' AND '".$year."-12-31'";
    $result = $db->query($sql);
    return($db->fetch_assoc($result));
}

function fechas_fin_proyecto(){
  global $db;
    $sql  = "SELECT COUNT('idobras') AS total FROM obras ";
    $sql .= " WHERE idtipo = '0' AND estado = '1' AND tramite >= '10'";
    $result = $db->query($sql);
    return($db->fetch_assoc($result));
}

function conteo_relevamientos_construcciones(){
  global $db;
    $sql  = "SELECT COUNT('idrelevamientos') AS total FROM relevamientos ";
    $sql .= " WHERE iddireccion = '1' AND iddepartamentos != '5' AND iddepartamentos != '6'";
    $result = $db->query($sql);
    return($db->fetch_assoc($result));
}

function conteo_estadistica($column,$table,$mas){
  global $db;
  $sql    = "SELECT COUNT($column) AS total FROM $table $mas";
  $result = $db->query($sql);
  return($db->fetch_assoc($result));
}

function conteo_relevamientos_filtro($direccion,$departamento){
  global $db;
    $sql  = "SELECT COUNT('idrelevamientos') AS total FROM relevamientos ";
    $sql .= " WHERE iddireccion = '".$direccion."' AND iddepartamentos = '".$departamento."'";
    $result = $db->query($sql);
    return($db->fetch_assoc($result));
}

 function prod_retirados_mes($dpto){
  global $db;      
  $start_date  = date("Y-m-d", strtotime($start_date));
  $fecha_actual = make_date();
  $year = date("Y");
  $month = date("m");
  $day = date("d");
  $end_date    = date("Y-m-d",strtotime($fecha_actual."- 1 month"));       
  $sql  = "SELECT COUNT('idinsumos_retirados') AS total FROM insumos_retirados WHERE registro_fecha BETWEEN '".$end_date."' AND '".$fecha_actual."' AND iddepartamentos=".$dpto;
  $result = $db->query($sql);
  return($db->fetch_assoc($result));
    }

 function prod_retirados_year($dpto){
  global $db;      
  $start_date  = date("Y-m-d", strtotime($start_date));
  $fecha_actual = make_date();
  $year = date("Y");
  $month = date("m");
  $day = date("d");
  $end_date    = date("Y-m-d", strtotime($fecha_actual));      
  $sql  = "SELECT COUNT('idinsumos_retirados') AS total FROM insumos_retirados WHERE registro_fecha BETWEEN '".$year."-01-01' AND '".$end_date."' AND iddepartamentos=".$dpto;
  $result = $db->query($sql);
  return($db->fetch_assoc($result));
    }

//USUARIOS INSPECCION
  function usuarios_a_cargo($id){
  global $db;
  $sql  =" SELECT * FROM users";
  $sql .=" WHERE idusuarios={$id}";
  return find_by_sql($sql);
  }
  function usuarios_responsable($id){
  global $db;
  $sql  =" SELECT * FROM users";
  $sql .=" WHERE id={$id}";
  return find_by_sql($sql);
  }

//permisos
  function permiso($var){
  global $db;
  global $session;  
  $user = current_user();  
  $sql  =" SELECT * FROM users u INNER JOIN users_permisos up ON u.id=up.idusers INNER JOIN permisos p ON p.idpermisos=up.idpermisos WHERE p.nombre LIKE '%{$var}%' AND u.id='".$user['id']."' LIMIT 1";

  return find_by_sql($sql);
  }


?>
