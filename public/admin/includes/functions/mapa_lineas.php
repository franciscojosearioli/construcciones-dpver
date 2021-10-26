<?php 
require_once('../../includes/load.php');
$user = current_user();

  global $db;
  $array = array();
  $sql = "SELECT * from mapa_linea where condicion=1  AND tipo=0 order by idmapa_linea ASC";
  $result = $db->query($sql);
  while ($row = $result->fetch_assoc()) {
    $array[] = [ "idmapa_linea" => $row['idmapa_linea'], "idobras" => $row['idobras'], "titulo" => $row['titulo'], "descripcion" => $row['descripcion'], "georeferencia" => $row['georeferencia'], "estado" => $row['estado'], "condicion" => $row['condicion']];
  }
  echo json_encode($array);
  ?>

