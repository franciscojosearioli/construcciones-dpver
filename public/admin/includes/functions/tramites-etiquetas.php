<?php 
require_once('../../includes/load.php');
$user = current_user();
$fecha_pase = make_dmy();
$registro_fecha = make_date(); 

if(isset($_POST['agregar_tramite_etiqueta'])){
  $titulo  = trim($db->escape($_POST['titulo']));
  $descripcion  = trim($db->escape($_POST['descripcion']));
  $query  = "INSERT INTO tramites_etiquetas (titulo,descripcion) VALUES ('$titulo', '$descripcion'); ";
  if($db->query($query)){
    logs($user['id'],"tramites-etiquetas",$ultimo_id,"Cargo nueva etiqueta de tramites");
    $session->msg('s',"Agregado exitosamente. ");
  redirect('tramites-etiquetas');
  } else {
    $session->msg('d',' Lo siento, registro falló.');
  redirect('tramites-etiquetas');
  }
}

if(isset($_POST['editar_etiqueta'])){
  $id  = trim($db->escape($_POST['editar_etiqueta']));
  $titulo  = trim($db->escape($_POST['titulo']));
  $descripcion  = trim($db->escape($_POST['descripcion']));
  $query  = "UPDATE tramites_etiquetas SET titulo='{$titulo}', descripcion='{$descripcion}' WHERE idtramites_etiquetas = '{$id}'; ";
  if($db->query($query)){
    logs($user['id'],"tramites-etiquetas",$ultimo_id,"Edito etiqueta de tramites");
    $session->msg('s',"Editado exitosamente. ");
  redirect('tramites-etiquetas');
  } else {
    $session->msg('d',' Lo siento, registro falló.');
  redirect('tramites-etiquetas');
  }
}

?>