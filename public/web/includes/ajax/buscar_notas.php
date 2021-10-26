<?php
require_once('../load.php');
    $key=$_GET['key'];
    $array = array();
    $query= $db->query("select * from notas where asunto LIKE '%{$key}%' OR referencia LIKE '%{$key}%'");
    while($row=$db->fetch_assoc($query))
    {
      $array[] = $row['referencia'];
    }
    echo json_encode($array);
?>