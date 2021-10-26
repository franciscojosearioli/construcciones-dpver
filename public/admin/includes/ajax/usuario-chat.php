<?php
  require_once("../../includes/load.php");
  $user = current_user();
  $dato = $_POST['usuarios_chat'];

  $consulta = $db->query("SELECT * FROM mensajes WHERE receptor='{$dato}'");

  $row = $db->fetch_array($consulta);
  if(!empty($row['mensaje'])){
if($user['id'] == $row['registro_usuario']){
?>

<li class="reverse">
                                                <div class="chat-content">
                                                    <h5><?php echo user_name_mensajes($row['registro_usuario']); ?></h5>
                                                    <div class="box bg-light-inverse"><?php echo $row['mensaje']; ?></div>
                                                    <div class="chat-time"><?php echo $row['registro_fecha']; ?></div>
                                                </div>
                                                <div class="chat-img"><?php if(!empty($row['image'])){ ?>
                                <img src="../archivos/Usuarios/Perfiles/<?php echo $user['id'].'/'.$user['image']; ?>" />
                            <?php }else{ ?>
                                <img src="../archivos/Usuarios/Perfiles/avatar.png" />
                            <?php } ?></div>
                                            </li>
<?php
}else{
  ?>
<li>
  <div class="chat-img"> <?php if(!empty($row['image'])){ ?>
                                <img src="../archivos/Usuarios/Perfiles/<?php echo $user['id'].'/'.$user['image']; ?>" />
                            <?php }else{ ?>
                                <img src="../archivos/Usuarios/Perfiles/avatar.png" />
                            <?php } ?> </div>
                                                  <div class="chat-content">
                                                    <h5><?php echo user_name_mensajes($row['registro_usuario']); ?></h5>
                                                    <div class="box bg-light-info"><?php echo $row['mensaje']; ?></div>
                                                    <div class="chat-time"><?php echo format_dyt($row['registro_fecha']); ?></div>
                                                </div>
</li>
  <?php
  }
}else{
  echo "<center>No hay mensajes con ".user_name_mensajes($_POST['usuarios_chat'])."</center>";
}
?>
