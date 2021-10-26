<?php 
require_once('../../includes/load.php');
$user = current_user();
$registro_fecha = make_date();
$obra_id = $_GET['id'];
if(!empty($obra_id)){
$items_obra = find_item($obra_id);
$planoficial_obra = find_planoficial($obra_id);
}


if(!empty($items_obra)){

  $cantidad = count($_POST['item']);
  $i=0;
  $update = '';
   foreach ($_POST as $indice=>$cadena) { 
   while($i<$cantidad){  
   $update .= $db->query("UPDATE obras_items SET item='".$_POST['item'][$i]."', sub_item='".$_POST['sub_item'][$i]."', descripcion='".$_POST['descripcion'][$i]."', unidad='".$_POST['unidad'][$i]."',cantidad_aprobada='".$_POST['cantidad_aprobada'][$i]."', precio_unitario='".$_POST['precio_unitario'][$i]."', tipo='".$_POST['tipo'][$i]."', registro_usuario='".$_POST['registro_usuario'][$i]."', registro_fecha='".$_POST['registro_fecha'][$i]."' WHERE idobras_items=".$_POST['idobras_items'][$i]."; ");
   $i++; 
   }
   }
$update .= '';


}

if(!empty($planoficial_obra)){

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



?>