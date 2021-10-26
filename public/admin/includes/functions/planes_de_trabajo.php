<?php 
require_once('../../includes/load.php');
$user = current_user();
$registro_fecha = make_date();
$obra_id = $_GET['id'];
if(!empty($obra_id)){
$planoficial_obra = find_planoficial($obra_id);
}




if(isset($_POST['add_plan_de_trabajo'])){
  $obra_id = $_POST['obra_id'];
  $plan_id = $_POST['plan_id'];
  $numero_plan = $_POST['numero_plan'];
  $detalle = $_POST['detalle'];
  $referencia = $_POST['referencia'];
  $expediente = $_POST['expediente'];
  $estado = $_POST['estado'];
  $n_reso = $_POST['n_reso'];
  $f_reso = $_POST['f_reso'];

  $update_plan = $db->query("UPDATE planes_de_trabajo SET numero='".$numero_plan."', detalle='".$detalle."', referencia='".$referencia."', registro_usuario='".$user['id']."', registro_fecha='".$registro_fecha."' WHERE idplanes_de_trabajo=".$plan_id."; ");
  
  if($update_plan){
  $cantidad = count($_POST['numero']);
  $i=0;
  $update = '';
   foreach ($_POST as $indice=>$cadena) { 
   while($i<$cantidad){  
   $update .= $db->query("UPDATE obras_planoficial SET numero='".$_POST['numero'][$i]."', monto='".$_POST['monto'][$i]."', avance='".$_POST['avance'][$i]."', registro_usuario='".$user['id']."', registro_fecha='".$registro_fecha."' WHERE idobras_planoficial=".$_POST['idobras_planoficial'][$i]."; ");
   $i++; 
   }
   }
$update .= '';
  }

}

if(isset($_POST['edit_plan_de_trabajo'])){
  $obra_id = $_POST['obra_id'];
  $plan_id = $_POST['plan_id'];
  $detalle = $_POST['detalle'];
  $referencia = $_POST['referencia'];
  $numero_plan = $_POST['numero_plan'];
  $expediente = $_POST['expediente'];
  $estado = $_POST['estado'];
  $n_reso = $_POST['n_reso'];
  $f_reso = $_POST['f_reso'];

  $update_plan = $db->query("UPDATE planes_de_trabajo SET numero='".$numero_plan."', detalle='".$detalle."', referencia='".$referencia."', registro_usuario='".$user['id']."', registro_fecha='".$registro_fecha."' WHERE idplanes_de_trabajo=".$plan_id."; ");
  
  if($update_plan){
  $cantidad = count($_POST['numero']);
  $i=0;
  $update = '';
   foreach ($_POST as $indice=>$cadena) { 
   while($i<$cantidad){  
   $update .= $db->query("UPDATE obras_planoficial SET numero='".$_POST['numero'][$i]."', monto='".$_POST['monto'][$i]."', avance='".$_POST['avance'][$i]."', registro_usuario='".$user['id']."', registro_fecha='".$registro_fecha."' WHERE idobras_planoficial=".$_POST['idobras_planoficial'][$i]."; ");
   $i++; 
   }
   }
$update .= '';
  }

}


?>