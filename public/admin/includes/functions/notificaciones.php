<?php 
require_once('../../includes/load.php');

$user = current_user();

if(isset($_POST['add_aviso'])){
    $asunto   = clean($db->escape($_POST['asunto']));
    $mensaje   = clean($db->escape($_POST['mensaje']));
    $estado   = clean($db->escape($_POST['estado']));
    $color   = clean($db->escape($_POST['color']));
    $date = make_date();
    $emisor = $user['id'];
    $query = "INSERT INTO avisos (
        asunto,
        mensaje,
        condicion,
        color,
        registro_usuario,
        registro_fecha
        ) VALUES ( 
        '{$asunto}',
        '{$mensaje}',
        '{$estado}',
        '{$color}', 
        '{$emisor}', 
        '{$date}'
        ); ";
      if($db->query($query)){
    $ultimo_id = $db->insert_id(); 
    logs($user['id'],"aviso",$ultimo_id,"Agrego un aviso");
        $session->msg('s',"Se ha realizado la operacion exitosamente.");
        redirect('notificaciones', false);
      } else {
        $session->msg('d','Ha ocurrido un error en la operacion.');
        redirect('notificaciones', false);
      }

  }

if(isset($_POST['editar_aviso'])){
    $asunto   = clean($db->escape($_POST['asunto']));
    $mensaje   = clean($db->escape($_POST['mensaje']));
    $estado   = clean($db->escape($_POST['estado']));
    $color   = clean($db->escape($_POST['color']));
    $date = make_date();
    $emisor = $user['id'];
    $id = clean($db->escape($_POST['editar_aviso']));
    $query = "UPDATE avisos SET 
        asunto = '{$asunto}',
        mensaje = '{$mensaje}',
        condicion = '{$estado}',
        color = '{$color}',
        registro_usuario = '{$emisor}',
        registro_fecha = '{$date}' 
        WHERE idavisos = '{$id}';
        ";
      if($db->query($query)){
        logs($user['id'],"aviso",$id,"Edito un aviso");
        $session->msg('s',"Se ha realizado la operacion exitosamente.");
        redirect('notificaciones', false);
      } else {
        $session->msg('d','Ha ocurrido un error en la operacion.');
        redirect('notificaciones', false);
      }

  }

if(isset($_POST['eliminar_aviso'])){
    $id = clean($db->escape($_POST['eliminar_aviso']));
    $query = "DELETE FROM avisos 
        WHERE idavisos = '{$id}';
        ";
      if($db->query($query)){
        logs($user['id'],"aviso",$id,"Elimino un aviso");
        $session->msg('s',"Se ha realizado la operacion exitosamente.");
        redirect('notificaciones', false);
      } else {
        $session->msg('d','Ha ocurrido un error en la operacion.');
        redirect('notificaciones', false);
      }

  }

?>