<?php
require_once('../load.php');
    $array = array();
    $query= $db->query("select * from obras");




    while($row=$db->fetch_assoc($query))
    {
      $array[] = $row['nombre'];
      $array[] = $row['expediente'];
    }


    echo '{
  "data": ['.json_encode($array).'  ]
}';
?>