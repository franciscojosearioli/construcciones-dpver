<?php 
require_once('../../includes/load.php');
$valor = $_POST['valor'];
$idobras = $_POST['idobras'];

$data = find_by_id('certificados_obras','idobras',$idobras);

echo $data['numero'];

?>
