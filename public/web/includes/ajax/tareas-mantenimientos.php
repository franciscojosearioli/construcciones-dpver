<?php
require_once('../load.php');
    $key=$_GET['key'];
    $array = array();
    $query= $db->query("select * from tareas_mantenimientos'");
    while($row=$db->fetch_assoc($query))
    {
      $array[] = $row['descripcion'];
      $array[] = $row['iddepartamentos'];      
    }
    echo json_encode($array);
?>