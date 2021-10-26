<?php
require_once('../../includes/load.php');

$user = current_user();

if(isset($_POST['agregar_productos'])){
    $codigo  = $db->escape($_POST['codigo']);
    $nombre  = $db->escape($_POST['nombre']);
    $descripcion  = $db->escape($_POST['descripcion']);
    $idcategorias  = $db->escape($_POST['idcategorias']);
    $cargo  = $db->escape($_POST['cargo']);
    $unidad  = $db->escape($_POST['unidad']);
    $cantidades  = $db->escape($_POST['cantidades']);
    $registro_fecha    = make_date();
    $query  = "INSERT INTO insumos (
    iddireccion,
    iddepartamentos,
    idcategorias,
    codigo,
    nombre,
    descripcion,
    cargo,
    unidad,
    cantidades,
    registro_usuario,
    registro_fecha
  ) VALUES ( 
  '".$user['iddireccion']."',
  '".$user['iddepartamentos']."',
  '$idcategorias', 
  '$codigo', 
  '$nombre', 
  '$descripcion', 
  '$cargo', 
  '$unidad', 
  '$cantidades', 
  '".$user['id']."', 
  '$registro_fecha'
  )";
    if($db->query($query)){
      $ultimo_id = $db->insert_id(); 
    logs($user['id'],"inventario",$ultimo_id,"Agrego un producto");
      $session->msg('s',"Agregado exitosamente.");
      redirect('productos', false);
    } else {
      $session->msg('d',' Lo siento, registro falló.');
      redirect('productos', false);
    }
}

if(isset($_POST['retirar_producto'])){
  $idinsumos = clean($db->escape($_POST['retirar_producto']));
  $codigo  = $db->escape($_POST['codigo']);
  $nombre  = $db->escape($_POST['nombre']);
  $descripcion  = $db->escape($_POST['descripcion']);
  $idcategorias  = $db->escape($_POST['idcategorias']);
  $cargo  = $db->escape($_POST['cargo']);
  $unidad  = $db->escape($_POST['unidad']);
  $destino  = $db->escape($_POST['destino']);
  $fecha_salida = $db->escape($_POST['fecha_salida']);
  $cantidades  = $db->escape($_POST['cantidades']);
  $registro_fecha    = make_date();
  $producto = find_by_id('insumos','idinsumos',$idinsumos);
  $resultado = $producto['cantidades']-$cantidades;

  $query  = "UPDATE insumos SET 
  cantidades = '".$resultado."'
  WHERE 
  idinsumos='$idinsumos';
  ";
  $query2 = "INSERT INTO insumos_retirados (
    iddireccion,
    iddepartamentos,
    idinsumos,
    idcategorias,
    codigo,
    nombre,
    descripcion,
    cargo,
    unidad,
    cantidades,
    destino,
    fecha_salida,
    registro_usuario,
    registro_fecha
) VALUES (
'".$user['iddireccion']."',
'".$user['iddepartamentos']."',
'$idinsumos', 
'$idcategorias', 
'$codigo', 
'$nombre', 
'$descripcion',  
'$cargo', 
'$unidad', 
'$cantidades', 
'$destino', 
'$fecha_salida',
'".$user['id']."', 
'$registro_fecha'
); ";
  if($db->query($query) && $db->query($query2)){
  logs($user['id'],"inventario",$idinsumos,"Retiro un producto del inventario");
    $session->msg('s',"Se ha registrado el retiro del producto.");
    echo "<script languaje='javascript' type='text/javascript'>window.opener.document.location='../../insumos-disponibles'; window.close();</script>";
  } else {
    $session->msg('d',' Lo siento, registro falló.');
    echo "<script languaje='javascript' type='text/javascript'>window.opener.document.location='../../insumos-disponibles'; window.close();</script>";
  }
}
?>