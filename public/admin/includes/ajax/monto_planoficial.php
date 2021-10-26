<?php 
require_once('../load.php');
$numero = $_POST['numero'];
$idobras = $_POST['idobras'];

$obra = find_by_id('obras','idobras',$idobras);

$cert_planoficial = find_rows_planoficial($obra['idplanes_de_trabajo'],$idobras);



foreach($cert_planoficial as $fila):
if($fila['numero'] == $numero){

echo $fila['monto'];
}
endforeach;
 ?>