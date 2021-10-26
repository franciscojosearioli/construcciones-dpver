<?php
require_once('../load.php');
$user = current_user();

    $key=$_GET['key'];
    $array = array();
    $query= $db->query("select * from obras where nombre LIKE '%{$key}%' OR expediente LIKE '%{$key}%'");
    while($row=$db->fetch_assoc($query))
    {
      $array[] = $row;
    }
    echo json_encode($array);

?>