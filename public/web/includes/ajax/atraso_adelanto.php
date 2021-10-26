<?php 
require_once('../load.php');
$obra_ejec = $_POST['obra_ejec'];
$obra_prev = $_POST['obra_prev'];

$resultado = (($obra_ejec - $obra_prev)/$obra_prev)*100;
echo number_format($resultado,2);


 ?>