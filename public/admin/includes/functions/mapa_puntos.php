<?php 
require_once('../../includes/load.php');
$user = current_user();


  global $db;
  $array = array();
  $sql = "SELECT * from mapa_punto where condicion=1 AND tipo=0 order by idmapa_punto ASC";
  $result = $db->query($sql);
  while ($row = $result->fetch_assoc()) {
    $array[] = [ "idmapa_punto" => $row['idmapa_punto'], "idobras" => $row['idobras'], "titulo" => $row['titulo'], "descripcion" => $row['descripcion'], "latitud" => $row['latitud'], "longitud" => $row['longitud'], "tipo" => $row['tipo'], "condicion" => $row['condicion']];
  }
  echo json_encode($array);
  ?>
