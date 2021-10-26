<?php 
$fecha = $_POST['fecha'];
$dias = (int)$_POST['dias'];
$dias_result = $dias-1;
$nuevafecha = strtotime ( '+'.$dias_result.' days' , strtotime ( $fecha ) ) ;
$nuevafecha = date ( 'Y-m-d' , $nuevafecha );
echo $nuevafecha;
 ?>