<?php 
require_once('../../includes/load.php');

$user = current_user();

if(isset($_POST['add_categoria'])){
    $nombre   = clean($db->escape($_POST['nombre']));
    $estado   = clean($db->escape($_POST['estado']));
    $query = "INSERT INTO categorias (
        iddireccion,
        iddepartamentos,
        nombre,
        condicion
        ) VALUES ( 
        '".$user['iddireccion']."', 
        '".$user['iddepartamentos']."', 
        '{$nombre}',
        '{$estado}'
        ); ";
      if($db->query($query)){
    $ultimo_id = $db->insert_id(); 
    logs($user['id'],"categoria",$ultimo_id,"Agrego una categoria");
        $session->msg('s'," Se ha registrado una nueva categoria.");
        redirect('categorias', false);
      } else {
        $session->msg('d',' No se pudo registrar la categoria.');
        redirect('categorias', false);
      }

  }

if(isset($_POST['editar_categoria'])){
    $nombre   = clean($db->escape($_POST['nombre']));
    $estado   = clean($db->escape($_POST['estado']));
    $id = clean($db->escape($_POST['editar_categoria']));
    $query = "UPDATE categorias SET 
        nombre = '{$nombre}',
        condicion = '{$estado}'
        WHERE idcategorias = '{$id}';
        ";
      if($db->query($query)){
        logs($user['id'],"categoria",$id,"Edito una categoria");
        $session->msg('s'," Se ha editado una categoria.");
        redirect('categorias', false);
      } else {
        $session->msg('d',' No se pudo editar la categoria.');
        redirect('categorias', false);
      }

  }

if(isset($_POST['eliminar_categoria'])){
    $id = clean($db->escape($_POST['eliminar_categoria']));
    $query = "DELETE FROM categorias 
        WHERE idcategorias = '{$id}';
        ";
      if($db->query($query)){
        logs($user['id'],"categoria",$id,"Elimino una categoria");
        $session->msg('s'," Se ha eliminado una categoria.");
        redirect('categorias', false);
      } else {
        $session->msg('d',' No se pudo eliminar la categoria.');
        redirect('categorias', false);
      }

  }

?>