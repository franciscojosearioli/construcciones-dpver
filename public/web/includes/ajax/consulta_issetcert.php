<?php 
require_once('../../includes/load.php');
$valor = $_POST['valor'];
$idobras = $_POST['idobras'];

$data = find_by_id('certificados_obras','idcertificados_obras',$valor);

echo $data['numero'];

?>
