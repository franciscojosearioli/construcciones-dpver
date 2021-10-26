<?php
  date_default_timezone_set('America/Argentina/Buenos_Aires');
  date_default_timezone_get();
$errors = array();

/*--------------------------------------------------------------*/
/* Función para validar si el dato existe
/*--------------------------------------------------------------*/
function ifexist($dato){
  if($dato == NULL){
    return;
  }elseif($dato == '0000-00-00'){
    return;
  }else{
    return $dato;
  }
}

function ifdate($dato){
  date_default_timezone_set('America/Argentina/Buenos_Aires');
  date_default_timezone_get();
  if(!empty($dato) && $dato != '0000-00-00'){
  return strftime("%d/%m/%Y", strtotime($dato));

  }
}

/*--------------------------------------------------------------*/
/* Función para quitar caracteres especiales en una cadena para usar en una declaración SQL
/*--------------------------------------------------------------*/
function real_escape($str){
  global $con;
  $escape = mysqli_real_escape_string($con,$str);
  return $escape;
}

/*--------------------------------------------------------------*/
/* Funcion para visualizar header, footer y login
/*--------------------------------------------------------------*/
function cabecera($text){
  include_once('copyright.php');  
  $titulo = $text.' - S.A.C. Vialidad E.R.';
  include_once('../../content/layouts/header.php');
  include_once('../../includes/ajax/breadcrumb.php');
  return;
}
function cabecera_funciones($text){
  include_once('copyright.php');  
  $titulo = $text.' - S.A.C. Vialidad E.R.';
  include_once('../../content/layouts/header-functions.php');
  include_once('../../includes/ajax/breadcrumb.php');
  return;
}


function cabecera_print_vertical($text){
  include_once('copyright.php');  
  $titulo = $text.' - S.A.C. Vialidad E.R.';
  include_once('../../content/prints/layouts/vertical.php');
  return;
}

function cabecera_print_horizontal($text){
  include_once('copyright.php');  
  $titulo = $text.' - S.A.C. Vialidad E.R.';
  include_once('../../content/prints/layouts/horizontal.php');
  return;
}

function cabecera_print_vertical_doc($text){
  include_once('copyright.php');  
  $titulo = $text;
  include_once('../../content/prints/layouts/vertical-doc.php');
  return;
}

function pie(){
  include_once('../../content/layouts/footer.php');
  return;
}
function pie_funciones(){
  include_once('../../content/layouts/footer-functions.php');
  return;
}

function cabecera_print_memo_doc($text){
  include_once('copyright.php');  
  $titulo = $text;
  include_once('../../content/prints/layouts/memorandums-doc.php');
  return;
}

function cabecera_print_memo($text){
  include_once('copyright.php');  
  $titulo = $text;
  include_once('../../content/prints/layouts/memorandums.php');
  return;
}

/*--------------------------------------------------------------*/
/* Funcion para remover caracteres de html
/*--------------------------------------------------------------*/
function clean($str){
  $str = nl2br($str);
  $str = htmlspecialchars(strip_tags($str, ENT_QUOTES));
  return $str;
}

/*--------------------------------------------------------------*/
/* Funcion para dar mayuscula a la primer letra : ucfirst();
/*--------------------------------------------------------------*/

/*--------------------------------------------------------------*/
/* Funcion para visualizar saltos de linea en un textarea de la base de datos
/*--------------------------------------------------------------*/
function textarea($str) {
  return str_replace(array("\r\n", "\r", "\n"), "<br />", $str);
}

/*--------------------------------------------------------------*/
/* Funcion para validar campos 
/*--------------------------------------------------------------*/
function validar($var){
  global $errors;
  foreach ($var as $field) {
    $val = clean($_POST[$field]);
    if(isset($val) && $val==''){
      $errors = "Requerido: ". $field ;
      return $errors;
    }
  }
}

/*--------------------------------------------------------------*/
/* Funcion para visualizar mensajes de respuestas
/* Ejemplo: echo display_msg($message);
/*--------------------------------------------------------------*/
function display_msg($msg =''){
  $output = array();
  if(!empty($msg)) {
    foreach ($msg as $key => $value) {
   	$output  = "<script>$.notify({icon: '',title: 'Notificacion',message: '".clean(ucfirst($value))."',url: '#',target: ''},{	element: 'body',	position: null,	type: 'info',	allow_dismiss: true,	newest_on_top: false,	showProgressbar: false,	placement: {	from: 'bottom',		align: 'right'	},	offset: 20,	spacing: 10,	z_index: 1031,	delay: 5000,	timer: 1500,	url_target: '_blank',	mouse_over: null,animate: {enter: 'animated fadeInDown',	exit: 'animated fadeOutUp'},	onShow: null,	onShown: null,	onClose: null,	onClosed: null,	icon_type: 'class',";
	$output .=  "template: '";
	$output .= '<div data-notify="container" class="col-xl-3 col-lg-3 col-md-4 col-sm-11 col-11 alert alert-{0}" role="alert">';
	$output .= '<span data-notify="message">{2}</span><div class="progress" data-notify="progressbar"><div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div></div><a href="{3}" target="{4}" data-notify="url"></a></div>'; 
	$output .= "'});</script>";
    }
    return $output;
  } else {
    return "" ;
  }
}

/*--------------------------------------------------------------*/
/* Funcion para redireccionar
/*--------------------------------------------------------------*/
function redirect($url, $permanent = false)
{
  if (headers_sent() === false)
  {
    header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
  }

  exit();
}


/*--------------------------------------------------------------*/
/* Funcion para dar formato a numeros con decimales y miles
/* Ejemplo: 1322156.57 -> 1.322.156,57
/*--------------------------------------------------------------*/
function numero($dato){
  if($dato != NULL){
  return number_format($dato,2, ",", ".");
  }
}
function numero_stock($unidad,$dato){
  if($unidad != 'u'){
  return number_format($dato,2, ",", ".");
}else{
    return number_format($dato,0, ",", ".");
}
}

/*--------------------------------------------------------------*/
/* Funcion para contar por linea en una tabla html
/*--------------------------------------------------------------*/
function count_id(){
  static $count = 1;
  return $count++;
}

/*--------------------------------------------------------------*/
/* Función para fecha legible
/*--------------------------------------------------------------*/
function read_date($str){
  if($str)
    return date('d/m/Y', strtotime($str));
  else
    return null;
}

/*--------------------------------------------------------------*/
/* Funcion para crear fecha actual
/*--------------------------------------------------------------*/
function make_date(){
  date_default_timezone_set('America/Argentina/Buenos_Aires');
  date_default_timezone_get();
  $date = new DateTime();
  $date->modify('+35 seconds');
  return $date->format('Y-m-d H:i:s');
}

function make_dmy(){
  date_default_timezone_set('America/Argentina/Buenos_Aires');
  date_default_timezone_get();
  $date = new DateTime();
  $date->modify('+35 seconds');
  return $date->format('Y-m-d');
}

/*--------------------------------------------------------------*/
/* Funcion para crear fecha para mensajes de notificaciones
/*--------------------------------------------------------------*/
function date_msj($data){
  date_default_timezone_set('America/Argentina/Buenos_Aires');
  date_default_timezone_get();
  return strftime("%d/%m/%Y", strtotime($data));
}

/*--------------------------------------------------------------*/
/* Funcion para dar formato a fecha: dd/mm/aaaa
/*--------------------------------------------------------------*/
function format_date($data){
  date_default_timezone_set('America/Argentina/Buenos_Aires');
  date_default_timezone_get();
  if($data != NULL){
  return strftime("%d/%m/%Y", strtotime($data));}
}

function format_date_memorandum($data){
  date_default_timezone_set('America/Argentina/Buenos_Aires');
  date_default_timezone_get();
  $mes = array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
  $mes = $mes[(date('m', strtotime($data))*1)-1];
  return strftime("%d de $mes de %Y", strtotime($data));
}

function format_dyt($data){
  date_default_timezone_set('America/Argentina/Buenos_Aires');
  date_default_timezone_get();
  return date("h:i:s d/m/Y ", strtotime($data));
}
/*--------------------------------------------------------------*/
/* Funcion para dar formato a fecha de certificados
/* Ejemplo: Ene-19
/*--------------------------------------------------------------*/
function date_cert($data){
  $fecha = substr($data, 0, 10);
  $mes = date('F', strtotime($data));
  $anio = date('y', strtotime($data));
  $meses_ES = array("Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic");
  $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
  $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
  return $nombreMes."-".$anio;

}

function date_memorandums($data){
  $fecha = substr($data, 0, 10);
  $dias = date('d', strtotime($data));
  $mes = date('F', strtotime($data));
  $anio = date('y', strtotime($data));
  $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
  $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
  $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
  return $dias." de ".$nombreMes;

}

/*--------------------------------------------------------------*/
/* Funcion para calcular dias restantes en tareas de mantenimientos
/*--------------------------------------------------------------*/
function dias_transcurridos($fecha_i,$fecha_f)
{
  $dias = (strtotime($fecha_i)-strtotime($fecha_f))/86400;
  $dias   = abs($dias); $dias = floor($dias);
  return $dias;
}

/*--------------------------------------------------------------*/
/* Funcion para calcular dias restantes entre dos fechas
/*--------------------------------------------------------------*/
function date_interval($date1, $date2) {
  $diff = abs(strtotime($date2) - strtotime($date1));

  $years = floor($diff / (365 * 60 * 60 * 24));

  $months = floor((365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));

  $days = floor((365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));

  return (($months > 0) ? $months . ' Mes' . ($months > 1 ? 'es' : '') . ' ' : '') . (($days > 0) ? $days . ' Dia' . ($days > 1 ? 's' : '') : ''); }


  /*--------------------------------------------------------------*/
/* Funcion para crear una palabra aleatoria
/*--------------------------------------------------------------*/
function randString($length = 5)
{
  $str='';
  $cha = "0123456789abcdefghijklmnopqrstuvwxyz";

  for($x=0; $x<$length; $x++)
    $str .= $cha[mt_rand(0,strlen($cha))];
  return $str;
}

/*--------------------------------------------------------------*/
/* Función para conocer precio de venta total, precio de compra y beneficio.
/*--------------------------------------------------------------*/
function total_price($totals){
  $sum = 0;
  $sub = 0;
  foreach($totals as $total ){
    $sum += $total['total_saleing_price'];
    $sub += $total['total_buying_price'];
    $profit = $sum - $sub;
  }
  return array($sum,$profit);
}

function mes_nombre($val){
  if($val == 1){ return 'Enero'; }
  if($val == 2){ return 'Febrero'; }
  if($val == 3){ return 'Marzo'; }
  if($val == 4){ return 'Abril'; }
  if($val == 5){ return 'Mayo'; }
  if($val == 6){ return 'Junio'; }
  if($val == 7){ return 'Julio'; }
  if($val == 8){ return 'Agosto'; }
  if($val == 9){ return 'Septiembre'; }
  if($val == 10){ return 'Octubre'; }
  if($val == 11){ return 'Noviembre'; }
  if($val == 12){ return 'Diciembre'; }
}

function evento($evento){
$result = '';
return '';
}


?>
