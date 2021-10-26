<?php 
require_once('../../includes/load.php');
$user = current_user();
$registro_fecha = make_date();
$obra_id = $_GET['id'];
if(!empty($obra_id)){
$items_obra = find_item($obra_id);
}




if(isset($_POST['add_cotizacion'])){
  $obra_id = $_POST['obra_id'];
  $cotiz_id = $_POST['cotiz_id'];
  $detalle = $_POST['detalle'];
  $referencia = $_POST['referencia'];
  $numero_plan = $_POST['numero_plan'];
  $expediente = $_POST['expediente'];
  $estado = $_POST['estado'];
  $n_reso = $_POST['n_reso'];
  $f_reso = $_POST['f_reso'];

  $update_cotiz = $db->query("UPDATE cotizaciones SET numero='".$numero."',detalle='".$detalle."', referencia='".$referencia."', registro_usuario='".$user['id']."', registro_fecha='".$registro_fecha."' WHERE idcotizaciones=".$cotiz_id."; ");
  
  if($update_cotiz){
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

}

if(isset($_POST['edit_cotizacion'])){
    $obra_id = $_POST['obra_id'];
    $cotiz_id = $_POST['cotiz_id'];
  $referencia = $_POST['referencia'];
    $numero_cotiz = $_POST['numero_cotiz'];
    $expediente = $_POST['expediente'];
    $detalle = $_POST['detalle'];
    $estado = $_POST['estado'];
    $n_reso = $_POST['n_reso'];
    $f_reso = $_POST['f_reso'];
  
    $update_cotiz = $db->query("UPDATE cotizaciones SET numero='".$numero_cotiz."',detalle='".$detalle."', referencia='".$referencia."', registro_usuario='".$user['id']."', registro_fecha='".$registro_fecha."' WHERE idcotizaciones=".$cotiz_id."; ");
    
    if($update_cotiz){
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
  
  }
?>