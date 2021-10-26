<?php
require_once('../../includes/load.php');
cabecera('Mis mensajes');
$user = current_user();
$all_users = all_usuarios_chat($user['id']);
$mensajes = all_mensajes($user['id']); ?>
  <div class="row">
    <div class="col-lg-12">
      <?php echo display_msg($msg); ?>
    </div>
  </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-20">
                            <!-- .chat-row -->
                            <div class="chat-main-box">
                                <div class="chat-left-aside">
                                    <div class="chat-left-inner">
                                    
                                        <div class="form-material">
                                            <form accept-charset="utf-8" method="POST">
                                            <input class="form-control p-20" name="busqueda_usuarios_chat" id="busqueda_usuarios_chat" type="text" placeholder="Buscar..." autocomplete="off">
                                            </form>
                                        </div>
                                        
                                        <ul id="users-list" class="chatonline style-none">
                                            <div id="listar_usuarios_chat">
                                          <?php foreach($all_users as $users):
                                            $mensaje_noleido = conteo_mensajes_noleido_chat('mensajes','idmensajes',$user['id'],$users['id']);
                                            ?>
                                            <li id="usuario-chat" data-user="<?php echo $users['id']; ?>" data-nombre="<?php echo user_name_mensajes($users['id']); ?>">
                                                <a class="noselect" >                             
                            <?php if(!empty($users['image'])){ ?>
                                <img src="../uploads/Usuarios/Perfiles/<?php echo $users['id'].'/'.$user['image']; ?>" class="profile-pic" />
                            <?php }else{ ?>
                                <img src="../uploads/Usuarios/Perfiles/avatar.png" class="profile-pic" />
                            <?php } ?>
                            <span><?php echo user_name_mensajes($users['id']); ?>
                            <?php if($mensaje_noleido['total'] > 0 ){ ?>
                                        <div class="notify-chat"> <span class="heartbit"></span> <span class="point"></span> </div>
                                        <?php } ?>
                        </span>
                        </a>
                                            </li>
                                          <?php endforeach;
                                           ?>
                                       </div>
                                            <li class="p-20"></li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- .chat-left-panel -->
                                <!-- .chat-right-panel -->
                                <div class="chat-right-aside">
                                    <div class="chat-main-header">
                                        <div class="p-20 b-b">
                                            <h3 class="box-title"><span id="toggle-chat" style="padding-right:20px;"><i class="ti-menu"></i></span><span id="nombre-usuario-chat">Conversaciones</span></h3>
                                        </div>
                                    </div>
                                    <div class="chat-rbox">
                                    <img src="includes/assets/images/chat/fondo.png" height="60%" width="80%" id="fondo-chat" />
                                    <ul class="chat-list p-20">
                                        <div id="contenido-chat"></div>
                                        </ul>
                                        <div class="card-body b-t" id="formulario-envio-chat">
                                        <form name="NewMG" action="" onsubmit="NewMensajeGlobal(); return false">
                                            <input type="text" name="receptor" id="receptor" hidden>
                                        <div class="row">
                                            <div class="col-8">
                                                <textarea id="mensaje" name="mensaje" placeholder="Escriba un mensaje aqui..." class="form-control b-0"></textarea>
                                            </div>
                                            <div class="col-4 text-right">
                                                <button type="submit" name="new_global" class="btn btn-info btn-circle btn-lg" title="Enviar" id="Add_mensaje"><i style="margin-left: -1px;margin-top: -1px;" class="fas fa-paper-plane"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                    </div>
                                    </div>
                                </div>
                                <!-- .chat-right-panel -->
                            </div>
                            <!-- /.chat-row -->
                        </div>
                    </div>

<script>
	$(document).ready(function()
	    {
	    $("#toggle-chat").on( "click", function() {	 
	        $('.chat-left-aside').toggle();
	         });
	    });

</script>
         <?php pie(); ?>