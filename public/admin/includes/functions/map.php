<?php 
require_once('../../includes/load.php');
$user = current_user();

if(isset($_POST['add_ruta'])){
$titulo = strip_tags( $_POST['titulo'] );
$descripcion = strip_tags( $_POST['descripcion'] );
$georeferencia = strip_tags( $_POST['geo'] );
$color = strip_tags( $_POST['color'] );
$estado = $_POST['estado'];
$obra_id = $_GET['id'];
$obra = find_by_id('obras','idobras',$obra_id);
if($obra['tipo'] == 0){
  $insert = "INSERT INTO mapa_linea (idobras, titulo, descripcion, georeferencia, estado,tipo, condicion) VALUES ('$obra_id','$titulo','$descripcion','$georeferencia','$estado',0,1);";
}
if($obra['tipo'] == 1){
  $insert = "INSERT INTO mapa_linea (idobras, titulo, descripcion, georeferencia, estado,tipo, condicion) VALUES ('$obra_id','$titulo','$descripcion','$georeferencia','$estado',1,1);";
}
if($obra['tipo'] == 2){
  $insert = "INSERT INTO mapa_linea (idobras, titulo, descripcion, georeferencia, estado,tipo, condicion) VALUES ('$obra_id','$titulo','$descripcion','$georeferencia','$estado',2,1);";
}
  if($db->query($insert)){
    
    logs($user['id'],"obra",$obra_id,"Agrego polilinea en mapa de ubicacion de obra");
		header('Location:' . getenv('HTTP_REFERER'));
  } else {
		header('Location:' . getenv('HTTP_REFERER'));
  }
}


if(isset($_POST['add_mark'])){
$titulo = strip_tags( $_POST['titulo'] );
$descripcion = strip_tags( $_POST['descripcion'] );
$latitud = strip_tags($_POST['latitud']);
$longitud = strip_tags($_POST['longitud']);
$tipo = $_POST['tipo'];
$obra_id = $_GET['id'];
  $insert = "INSERT INTO mapa_punto (idobras, titulo, descripcion, latitud, longitud, tipo, condicion) VALUES ('$obra_id','$titulo','$descripcion','$latitud','$longitud','$tipo',1);";
  if($db->query($insert)){
    logs($user['id'],"obra",$obra_id,"Agrego marcador en mapa de ubicacion de obra");
		header('Location:' . getenv('HTTP_REFERER'));
  } else {
    header('Location:' . getenv('HTTP_REFERER'));
  }
}




if(isset($_POST['delete_ruta'])){
 $id = $_POST['tramo'];
 $obra_id = $_GET['id'];
 cambiar_condicion('mapa_linea',0,'idmapa_linea',$id);
 logs($user['id'],"obra",$obra_id,"Elimino polilinea en mapa de ubicacion de obra");
 header('Location:' . getenv('HTTP_REFERER'));
   } 




if(isset($_POST['delete_mark'])){
 $id = $_POST['marcador'];
 $obra_id = $_GET['id'];
 cambiar_condicion('mapa_punto',0,'idmapa_punto',$id);
 logs($user['id'],"obra",$obra_id,"Elimino marcador en mapa de ubicacion de obra");
 header('Location:' . getenv('HTTP_REFERER'));
   } 
   
?>