<?php
require_once('../../includes/load.php');

$user = current_user();

$id = $_POST["id"];

$obra = find_by_id('obras','idobras',$id);

echo '<br>Expediente: '.$obra['expediente'].'<br />';
if($obra['estado'] == 0){ echo 'Estado: En ejecucion <br />'; }
if($obra['estado'] == 1){ echo 'Estado: En proyecto <br />'; }
if($obra['estado'] == 3){ echo 'Estado: Finalizada <br />'; }
if($obra['estado'] == 4){ echo 'Estado: Neutralizada <br />'; }
if($obra['estado'] == 5){ echo 'Estado: Rescindida <br />'; }

?>
