<?php
require_once('../load.php');
    $key=$_GET['key'];
    $array = array();
    $query= $db->query("select * from obras where nombre LIKE '%{$key}%'");
    while($row=$db->fetch_assoc($query))
    {
      $array[] = $row['nombre'];
    }
    echo json_encode($array);
?>