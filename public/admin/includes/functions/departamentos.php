<?php
  if(isset($_POST['add_departamento'])){
        $nombre = clean($db->escape($_POST['nombre']));
        $iddireccion = clean($db->escape($_POST['iddireccion']));
        $query  = "INSERT INTO departamentos (";
        $query .="iddireccion,nombre,condicion";
        $query .=") VALUES (";
        $query .=" {$iddireccion},'{$nombre}',1";
        $query .=")";
        if($db->query($query)){
          $ultimo_id = $db->insert_id(); 
    logs($user['id'],"departamento",$ultimo_id,"Agrego un departamento");
          $session->msg('s',"Departamento creado! ");
          redirect('departamentos', false);
        } else {
          $session->msg('d','Lamentablemente no se pudo crear el departamento');
          redirect('departamentos', false);
        }
 } 
 ?>