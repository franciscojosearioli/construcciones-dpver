<?php
  if(isset($_POST['add_direccion'])){
        $nombre = clean($db->escape($_POST['nombre']));
        $query  = "INSERT INTO direcciones (";
        $query .="nombre,condicion";
        $query .=") VALUES (";
        $query .=" '{$nombre}',1";
        $query .=")";
        if($db->query($query)){
          $ultimo_id = $db->insert_id(); 
    logs($user['id'],"direccion",$ultimo_id,"Agrego una direccion");
          $session->msg('s',"Direccion creada! ");
          redirect('direcciones', false);
        } else {
          $session->msg('d','Lamentablemente no se pudo crear el direccion');
          redirect('direcciones', false);
        }
 } 
 ?>