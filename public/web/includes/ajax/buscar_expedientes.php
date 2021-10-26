<?php
require_once('../load.php');
    $key=$_GET['key'];
    $array = array();
    $query= $db->query("select * from expedientes where asunto LIKE '%{$key}%' OR expediente LIKE '%{$key}%'");
    while($row=$db->fetch_assoc($query))
    {
      $array[] = $row['expediente'];
    }
    echo json_encode($array);
?>