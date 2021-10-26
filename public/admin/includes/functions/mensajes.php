<?php
    $key=$_GET['id'];
    $array = array();
    $con=mysql_connect("localhost","cons","");
    $db=mysql_select_db("construcciones",$con);
    $query=mysql_query("select * from notificaciones n INNER JOIN usuarios u ON n.autor = u.id where n.receptor = '{$key}' AND n.estado=0 AND n.privado=1");
    $conteo_query=mysql_query("select count(idmsj) as total from notificaciones where receptor = '{$key}' AND estado=0 AND privado=1");
    $conteo2 = mysql_fetch_assoc($conteo_query);
    while($row=mysql_fetch_assoc($query))
    {
      $array[] = array('total'=>$conteo2['total'],'mensaje'=>$row['mensaje'],'autor'=>$row['name'] );
    }
    echo json_encode($array);
?>
