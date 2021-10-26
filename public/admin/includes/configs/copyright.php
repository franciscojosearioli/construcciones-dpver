
<?php 
$user = current_user();
define('__ROOT__', dirname(dirname(dirname(__FILE__)))); 
$dptoweb = 'D.P.V.E.R.';
//if(permiso('admin')){
//$dptoweb = 'Administrador';
//}else{
//$dptoweb = find_select('nombre','departamentos','iddepartamentos',$user['iddepartamentos']).' | '.find_select('nombre','direcciones','iddireccion',$user['iddireccion']);
//}
?>