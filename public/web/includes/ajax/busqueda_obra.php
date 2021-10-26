<?php
require_once('../load.php');
$user = current_user();

    $key=$_GET['key'];
    $array = array();
    $query= $db->query("select * from obras where nombre LIKE '%{$key}%' OR expediente LIKE '%{$key}%' OR alias LIKE '%{$key}%' OR numero LIKE '%{$key}%' OR contratista LIKE '%{$key}%' OR ubicacion LIKE '%{$key}%'");
    while($row=$db->fetch_assoc($query))
    {
      $array[] = $row;
    }
    echo json_encode($array);

?>