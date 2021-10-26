<?php 
require_once('../../includes/load.php');

$user = current_user();

if(isset($_POST['add_armario'])){
    $numero   = clean($db->escape($_POST['numero']));
    $caja_carpeta   = clean($db->escape($_POST['caja_carpeta']));
    $obra   = clean($db->escape($_POST['obra']));
    $query = "INSERT INTO armarios (
        numero,
        obra,
        caja_carpeta
        ) VALUES ( 
        '{$numero}',  '{$obra}', '{$caja_carpeta}'
        ); ";
      if($db->query($query)){
    $ultimo_id = $db->insert_id(); 
    logs($user['id'],"armario",$ultimo_id,"Agrego un registro de armario");
        redirect('armarios', false);
      } else {
        redirect('armarios', false);
      }

  }

if(isset($_POST['editar_armario'])){
    $numero   = clean($db->escape($_POST['numero']));
    $caja_carpeta   = clean($db->escape($_POST['caja_carpeta']));
    $obra   = clean($db->escape($_POST['obra']));
    $id = clean($db->escape($_POST['editar_armario']));
    $query = "UPDATE armarios SET 
        numero = '{$numero}',
        caja_carpeta = '{$caja_carpeta}',
        obra = '{$obra}'
        WHERE idarmarios = '{$id}';
        ";
      if($db->query($query)){
        logs($user['id'],"armario",$id,"Edito un registro de armario");
        redirect('armarios', false);
      } else {
        redirect('armarios', false);
      }

  }
?>