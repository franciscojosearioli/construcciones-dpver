<?php 
require_once('../../includes/load.php');

$user = current_user();

if(isset($_POST['add_empresa'])){
    $nombre   = clean($db->escape($_POST['nombre']));
    $cuit   = clean($db->escape($_POST['cuit']));
    $direccion   = clean($db->escape($_POST['direccion']));
    $telefono   = clean($db->escape($_POST['telefono']));
    $localidad  = clean($db->escape($_POST['localidad']));
    $query = "INSERT INTO empresas (
        nombre,
        cuit,
        direccion,
        telefono,
        localidad,
        condicion
        ) VALUES ( 
        '{$nombre}', 
        '{$cuit}',
        '{$direccion}', 
        '{$telefono}', 
        '{$localidad}', 
        '1'
        ); ";
      if($db->query($query)){
      $ultimo_id = $db->insert_id(); 
    logs($user['id'],"empresa",$ultimo_id,"Agrego una empresa");
        $session->msg('s'," Se ha registrado nueva empresa.");
        redirect('empresas', false);
      } else {
        $session->msg('d',' No se pudo registrar la empresa.');
        redirect('empresas', false);
      }

  }

if(isset($_POST['editar_empresa'])){
    $nombre   = clean($db->escape($_POST['nombre']));
    $cuit   = clean($db->escape($_POST['cuit']));
    $direccion   = clean($db->escape($_POST['direccion']));
    $telefono   = clean($db->escape($_POST['telefono']));
    $localidad  = clean($db->escape($_POST['localidad']));
    $id = clean($db->escape($_POST['editar_empresa']));
    $query = "UPDATE empresas SET 
        nombre = '{$nombre}',
        cuit = '{$cuit}',
        direccion = '{$direccion}',
        telefono = '{$telefono}',
        localidad = '{$localidad}'
        WHERE idempresas = '{$id}';
        ";
      if($db->query($query)){
        logs($user['id'],"empresa",$id,"Edito una empresa");
        $session->msg('s'," Se ha editado empresa.");
        redirect('empresas', false);
      } else {
        $session->msg('d',' No se pudo editar empresa.');
        redirect('empresas', false);
      }

  }

  if(isset($_POST['add_contacto_empresa'])){
    $nombre   = clean($db->escape($_POST['nombre']));
    $apellido   = clean($db->escape($_POST['apellido']));
    $empresa   = clean($db->escape($_POST['empresa']));
    $telefono   = clean($db->escape($_POST['telefono']));
    $email   = clean($db->escape($_POST['email']));
    $cargo  = clean($db->escape($_POST['cargo']));
    $query = "INSERT INTO empresas_contactos (
        nombre,
        apellido,
        idempresas,
        telefono,
        email,
        cargo,
        condicion
        ) VALUES ( 
        '{$nombre}', 
        '{$apellido}',
        '{$empresa}', 
        '{$telefono}', 
        '{$email}', 
        '{$cargo}', 
        '1'
        ); ";
      if($db->query($query)){
      $ultimo_id = $db->insert_id(); 
    logs($user['id'],"empresa-contacto",$ultimo_id,"Agrego un contacto de empresa");
        $session->msg('s'," Se ha registrado nuevo contacto de empresa.");
        redirect('empresas-contactos', false);
      } else {
        $session->msg('d',' No se pudo registrar el contacto.');
        redirect('empresas-contactos', false);
      }

  }
  if(isset($_POST['editar_contacto_empresa'])){
    $nombre   = clean($db->escape($_POST['nombre']));
    $apellido   = clean($db->escape($_POST['apellido']));
    $email   = clean($db->escape($_POST['email']));
    $telefono   = clean($db->escape($_POST['telefono']));
    $cargo  = clean($db->escape($_POST['cargo']));
    $empresa   = clean($db->escape($_POST['empresa']));
    $id = clean($db->escape($_POST['editar_contacto_empresa']));
    $query = "UPDATE empresas_contactos SET 
        nombre = '{$nombre}',
        apellido = '{$apellido}',
        email = '{$email}',
        telefono = '{$telefono}',
        cargo = '{$cargo}',
        idempresas = '{$empresa}'
        WHERE idcontactos = '{$id}';
        ";
      if($db->query($query)){
        logs($user['id'],"empresa-contacto",$id,"Edito un contacto de empresa");
        $session->msg('s'," Se ha editado contacto.");
        redirect('empresas-contactos', false);
      } else {
        $session->msg('d',' No se pudo editar contacto.');
        redirect('empresas-contactos', false);
      }

  }
?>