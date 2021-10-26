<?php
  require_once("../../includes/load.php");
  $user = current_user();
  $dato = $_GET['b'];

  $sql = $db->query("SELECT * FROM usuarios WHERE id != '{$user['id']}' AND nombre LIKE '%{$dato}%' AND condicion=1");

  while($row = $db->fetch_array($sql)){
      $mensaje_noleido = conteo_mensajes_noleido_chat('mensajes','idmensajes',$user['id'],$row['id']);
?>
<li id="usuario-chat" data-user="<?php echo $row['id']; ?>" data-nombre="<?php echo user_name_mensajes($row['id']); ?>">
                                                <a class="noselect" >                               
                            <?php if(!empty($row['image'])){ ?>
                                <img src="../uploads/Usuarios/Perfiles/<?php echo $row['id'].'/'.$row['image']; ?>" class="profile-pic" />
                            <?php }else{ ?>
                                <img src="../uploads/Usuarios/Perfiles/avatar.png" class="profile-pic" />
                            <?php } ?>
                            <span><?php echo user_name_mensajes($row['id']); ?> 
                            <?php if($mensaje_noleido['total'] > 0 ){ ?>
                                        <div class="notify-chat"> <span class="heartbit"></span> <span class="point"></span> </div>
                                        <?php } ?>
                          </span>
                        </a>
                                            </li>
<?php
  }
?>