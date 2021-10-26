<?php 
require_once('../load.php');

$search = trim($_POST['term']); 

$sql  = " SELECT p.idpermisos,p.nombre,p.descripcion,up.idpermisos FROM permisos p INNER JOIN users_permisos up ON p.idpermisos=up.idpermisos WHERE p.nombre LIKE '".$search."'";
$query = $db->query($sql);
$list = $db->fetch_assoc($query); 

if(count($list) > 0){
   foreach ($list as $key => $value) {
    $data[] = array('id' => $value['idpermisos'], 'text' => $value['nombre']);            
   } 
} else {
   $data[] = array('id' => '0', 'text' => 'Sin datos');
}


echo json_encode($data);

?>