 <?php
date_default_timezone_get();
require_once('../../includes/load.php');
$user = current_user(); 

if(isset($_POST['add_usuario'])){
  $nombre   = clean($db->escape($_POST['nombre']));
  $apellido   = clean($db->escape($_POST['apellido']));
  $email   = clean($db->escape($_POST['email']));
  $telefono   = clean($db->escape($_POST['telefono']));
  $username   = clean($db->escape($_POST['username']));
  $password   = clean($db->escape($_POST['password']));
  $sexo   = clean($db->escape($_POST['sexo']));
  $iddireccion   = clean($db->escape($_POST['iddireccion']));
  $direccion   = clean($db->escape($_POST['direccion']));
  $direccion_numeracion   = clean($db->escape($_POST['direccion_numeracion']));
  $localidad  = clean($db->escape($_POST['localidad']));
  $codigo_postal   = clean($db->escape($_POST['codigo_postal']));
  $iddepartamentos   = clean($db->escape($_POST['iddepartamentos']));
  $idpermisos = (int)$db->escape($_POST['idpermisos']);
  $permiso = $db->escape($_POST['permisos']);
  $idroles = (int)$db->escape($_POST['idroles']);
  $password = sha1($password);
  $usuarioprincipal = $db->escape($_POST['usuarioprincipal']);
  $busqueda= verif_user($username);
  if($busqueda['username'] == $username){
    $session->msg('d','El usuario ya existe.');
    redirect('usuarios', false);
  }else{
    if(!isset($usuarioprincipal)){ /* Si no es sub-usuario */
      $query = "INSERT INTO users (";
      $query .="iddireccion,iddepartamentos,idroles,nombre,apellido,email,telefono,sexo,direccion,direccion_numeracion,localidad,codigo_postal,username,password,condicion";
      $query .=") VALUES (";
      $query .=" '{$iddireccion}', '{$iddepartamentos}', '{$idroles}', '{$nombre}', '{$apellido}', '{$email}', '{$telefono}', '{$sexo}', '{$direccion}', '{$direccion_numeracion}', '{$localidad}', '{$codigo_postal}', '{$username}', '{$password}', '1'";
      $query .=") ";
    }else{ /* Si es sub-usuario */
      $query = "INSERT INTO users (";
      $query .="idusuarios,iddireccion,iddepartamentos,idroles,nombre,apellido,email,telefono,sexo,direccion,direccion_numeracion,localidad,codigo_postal,username,password,condicion";
      $query .=") VALUES (";
      $query .=" '{$usuarioprincipal}', '{$iddireccion}', '{$iddepartamentos}', '{$idroles}', '{$nombre}', '{$apellido}', '{$email}', '{$telefono}', '{$sexo}', '{$direccion}', '{$direccion_numeracion}', '{$localidad}', '{$codigo_postal}', '{$username}', '{$password}', '1'";
      $query .=") ";
    } 
    if($db->query($query)){
      $ultimo_id = $db->insert_id(); 

    if(isset($_POST['permisos'])){
      $cantidad_permiso = count($_POST['permisos']);
      $i=0;
      $insert_permiso = '';
       foreach ($_POST as $indice=>$cadena) { 
       while($i<$cantidad_permiso){  
       $insert_permiso .= $db->query("INSERT INTO users_permisos (idusers, idpermisos) VALUES ('".$ultimo_id."', '".$_POST['permisos'][$i]."'); ");
       $i++; 
      }
      }
   $insert_permiso .= '';
    }

    if($db->query($insert_permiso)){
      $session->msg('s'," Cuenta de usuario ha sido creada");
      redirect('usuarios', false);
    } else {
      $session->msg('d',' No se pudo crear la cuenta.');
      redirect('usuarios', false);
    }
  } else {
    $session->msg('d',' No se pudo crear la cuenta.');
    redirect('usuarios', false);
  }
  }
}

if(isset($_POST['editar_usuario'])){
  $get_id = $db->escape($_POST['editar_usuario']);
  $nombre   = clean($db->escape($_POST['nombre']));
  $apellido   = clean($db->escape($_POST['apellido']));
  $email   = clean($db->escape($_POST['email']));
  $telefono   = clean($db->escape($_POST['telefono']));
  $username   = clean($db->escape($_POST['username']));
  $password   = clean($db->escape($_POST['password']));
  $sexo   = clean($db->escape($_POST['sexo']));
  $iddireccion   = clean($db->escape($_POST['iddireccion']));
  $direccion   = clean($db->escape($_POST['direccion']));
  $direccion_numeracion   = clean($db->escape($_POST['direccion_numeracion']));
  $localidad  = clean($db->escape($_POST['localidad']));
  $codigo_postal   = clean($db->escape($_POST['codigo_postal']));
  $iddepartamentos   = clean($db->escape($_POST['iddepartamentos']));
  $condicion   = clean($db->escape($_POST['condicion']));
  $idpermisos = (int)$db->escape($_POST['idpermisos']);
  $permisos = $db->escape($_POST['permisos']);
  $idroles = (int)$db->escape($_POST['idroles']);
  $password = sha1($password);
  $usuarioprincipal = $db->escape($_POST['usuarioprincipal']);
  if(!isset($usuarioprincipal)){
    $query  = "UPDATE users SET 
    iddireccion = '".$iddireccion."', 
    idroles = '".$idroles."', 
    iddepartamentos = '".$iddepartamentos."', 
    nombre = '".$nombre."',
    apellido = '".$apellido."', 
    email = '".$email."', 
    telefono = '".$telefono."', 
    direccion = '".$direccion."', 
    direccion_numeracion = '".$direccion_numeracion."',
    localidad = '".$localidad."',
    codigo_postal = '".$codigo_postal."',   
    sexo = '".$sexo."', 
    condicion = '".$condicion."',
    idusuarios = NULL   
    WHERE id='$get_id'; ";
  }else{

    $query  = "UPDATE users SET 
    iddireccion = '".$iddireccion."', 
    idroles = '".$idroles."', 
    iddepartamentos = '".$iddepartamentos."',
    nombre = '".$nombre."', 
    apellido = '".$apellido."', 
    email = '".$email."', 
    telefono = '".$telefono."', 
    direccion = '".$direccion."', 
    direccion_numeracion = '".$direccion_numeracion."',
    localidad = '".$localidad."',
    codigo_postal = '".$codigo_postal."',   
    sexo = '".$sexo."', 
    condicion = '".$condicion."',
    idusuarios = '".$usuarioprincipal."'  
    WHERE id='$get_id'; "; 
  }
  if($db->query($query)){

    if(isset($_POST['permisos'])){
      $db->query("DELETE FROM users_permisos WHERE idusers='".$get_id."'");
      $cantidad_permiso = count($_POST['permisos']);
      $i=0;
      $insert_permiso = '';
       foreach ($_POST as $indice=>$cadena) { 
       while($i<$cantidad_permiso){  
       $insert_permiso .= $db->query("INSERT INTO users_permisos (idusers, idpermisos) VALUES ('".$get_id."', '".$_POST['permisos'][$i]."'); ");
       $i++; 
      }
      }
   $insert_permiso .= '';
    }

    if($db->query($insert_permiso)){
    $logs = log($user['id'],"usuario",$get_id,"Edito un usuario");
    $session->msg('s',"Se ha editado el registro. ");
      redirect('usuarios', false);
    } else {
      $session->msg('d',' Lo siento, registro falló.');
        redirect('usuarios', false);
    }
  } else {
      $session->msg('d',' Lo siento, registro falló.');
        redirect('usuarios', false);
    }
}

if(isset($_POST['editar_perfil'])){
  $id = (int)$_SESSION['user_id'];
  $nombre = clean($db->escape($_POST['nombre']));
  $apellido = clean($db->escape($_POST['apellido']));
  $email = clean($db->escape($_POST['email']));
  $telefono = clean($db->escape($_POST['telefono']));
  $sexo = clean($db->escape($_POST['sexo']));
  $direccion = clean($db->escape($_POST['direccion']));
  $direccion_numeracion = clean($db->escape($_POST['direccion_numeracion']));
  $localidad = clean($db->escape($_POST['localidad']));
  $codigo_postal = clean($db->escape($_POST['codigo_postal']));
  $sql = "UPDATE users SET 
  nombre ='{$nombre}', 
  apellido ='{$apellido}', 
  email ='{$email}', 
  telefono ='{$telefono}',
  sexo ='{$sexo}', 
  direccion ='{$direccion}',
  direccion_numeracion ='{$direccion_numeracion}',
  localidad ='{$localidad}',
  codigo_postal ='{$codigo_postal}' 
  WHERE id='{$id}'";
  $result = $db->query($sql);
     $logs = log($user['id'],"usuario",$id,"Edito su perfil");
  if($result && $db->affected_rows() === 1){
    $session->msg('s',"Datos actualizados. ");
    redirect('perfil', false);
  } else {
    $session->msg('d',' Lo siento, actualización falló.');
    redirect('perfil', false);
  }
}

if(isset($_POST['update_password'])){

  if(sha1($_POST['old_password']) !== current_user()['password'] ){
    $session->msg('d', "Tu antigua contraseña no coincide");
    redirect('perfil',false);
  }
  $new = sha1($_POST['new_password']);
  $sql = "UPDATE users SET password='{$new}' WHERE id='".$user['id']."';";
  $result = $db->query($sql);
     $logs = log($user['id'],"usuario",$id,"Edito su perfil");
  if($result && $db->affected_rows() === 1):
    $session->logout();
    $session->msg('s',"Inicia sesión con tu nueva contraseña.");
    redirect('../', false);
  else:
    $session->msg('d',' Lo siento, actualización falló.');
    redirect('perfil', false);
  endif;
}  

if(isset($_POST['add_rol'])){
  $nivel = clean($db->escape($_POST['nivel']));
  $nombre = clean($db->escape($_POST['nombre']));
  $query  = "INSERT INTO roles (";
  $query .="idroles,nombre,condicion";
  $query .=") VALUES (";
  $query .=" '{$nivel}', '{$nombre}', '1'";
  $query .=")";
  if($db->query($query)){
    $session->msg('s',"Rol creado! ");
    redirect('usuarios-roles', false);
  } else {
    $session->msg('d','Lamentablemente no se pudo crear el rol');
    redirect('usuarios-roles', false);
  }
} 

if(isset($_POST['add_permiso'])){
  $descripcion = clean($db->escape($_POST['descripcion']));
  $nombre = clean($db->escape($_POST['nombre']));
  $query  = "INSERT INTO permisos (";
  $query .="nombre,descripcion,condicion";
  $query .=") VALUES (";
  $query .=" '{$nombre}', '{$descripcion}', '1'";
  $query .=")";
  if($db->query($query)){
    $session->msg('s',"Permiso creado! ");
    redirect('usuarios-permisos', false);
  } else {
    $session->msg('d','Lamentablemente no se pudo crear el permiso');
    redirect('usuarios-permisos', false);
  }
} 

?>