<?php 
require_once('../../includes/load.php');

$user = current_user();

if(isset($_POST['add_proveedor'])){
    $nombre   = clean($db->escape($_POST['nombre']));
    $cuit   = clean($db->escape($_POST['cuit']));
    $direccion   = clean($db->escape($_POST['direccion']));
    $telefono   = clean($db->escape($_POST['telefono']));
    $localidad  = clean($db->escape($_POST['localidad']));
    $codigo_postal   = clean($db->escape($_POST['codigo_postal']));
    $contacto_nombre   = clean($db->escape($_POST['contacto_nombre']));
    $contacto_apellido   = clean($db->escape($_POST['contacto_apellido']));
    $contacto_email   = clean($db->escape($_POST['contacto_email']));
    $contacto_telefono   = clean($db->escape($_POST['contacto_telefono']));
    $query = "INSERT INTO proveedores (
        iddireccion,
        iddepartamentos,
        nombre,
        cuit,
        direccion,
        telefono,
        localidad,
        codigo_postal,
        contacto_nombre,
        contacto_apellido,
        contacto_email,
        contacto_telefono
        ) VALUES ( 
        '".$user['iddireccion']."', 
        '".$user['iddepartamentos']."', 
        '{$nombre}', 
        '{$cuit}',
        '{$direccion}', 
        '{$telefono}', 
        '{$localidad}', 
        '{$codigo_postal}', 
        '{$contacto_nombre}', 
        '{$contacto_apellido}', 
        '{$contacto_email}', 
        '{$contacto_telefono}'
        ); ";
      if($db->query($query)){
      $ultimo_id = $db->insert_id(); 
    logs($user['id'],"proveedor",$ultimo_id,"Agrego un proveedor");
        $session->msg('s'," Se ha registrado un nuevo proveedor.");
        redirect('proveedores', false);
      } else {
        $session->msg('d',' No se pudo registrar el proveedor.');
        redirect('proveedores', false);
      }

  }

if(isset($_POST['editar_proveedor'])){
    $nombre   = clean($db->escape($_POST['nombre']));
    $cuit   = clean($db->escape($_POST['cuit']));
    $direccion   = clean($db->escape($_POST['direccion']));
    $telefono   = clean($db->escape($_POST['telefono']));
    $localidad  = clean($db->escape($_POST['localidad']));
    $codigo_postal   = clean($db->escape($_POST['codigo_postal']));
    $contacto_nombre   = clean($db->escape($_POST['contacto_nombre']));
    $contacto_apellido   = clean($db->escape($_POST['contacto_apellido']));
    $contacto_email   = clean($db->escape($_POST['contacto_email']));
    $contacto_telefono   = clean($db->escape($_POST['contacto_telefono']));
    $id = clean($db->escape($_POST['editar_proveedor']));
    $query = "UPDATE proveedores SET 
        nombre = '{$nombre}',
        cuit = '{$cuit}',
        direccion = '{$direccion}',
        telefono = '{$telefono}',
        localidad = '{$localidad}',
        codigo_postal = '{$codigo_postal}',
        contacto_nombre = '{$contacto_nombre}', 
        contacto_apellido = '{$contacto_apellido}', 
        contacto_email = '{$contacto_email}',
        contacto_telefono = '{$contacto_telefono}'
        WHERE idproveedores = '{$id}';
        ";
      if($db->query($query)){
        logs($user['id'],"proveedor",$id,"Edito datos de proveedor");
        $session->msg('s'," Se ha editado un proveedor.");
        redirect('proveedores', false);
      } else {
        $session->msg('d',' No se pudo editar el proveedor.');
        redirect('proveedores', false);
      }

  }

?>