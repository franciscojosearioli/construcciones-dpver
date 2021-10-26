<?php
require_once('../../includes/load.php');
$user = current_user();
$all_users = find_all_user_dpto($user['id']);
$notificaciones = notificaciones();
cabecera('Notificaciones'); ?>
            <div class="row">
                <div class="col-lg-12">
                    <?php echo display_msg($msg); ?>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-0">
                            <div class="chat-main-box">
                                <div class="chat-main-header">
                                    <div class="p-20 b-b">
                                        <h3 class="box-title">Novedades publicadas</h3>
                                    </div>
                                </div>
                                <div class="chat-rbox">
                                    <ul class="chat-list p-20">
                                        <div id="ResultadoNotificaciones"></div>
                                    </ul>
                                    <div class="card-body b-t">
                                        <form name="NewMG" action="" onsubmit="NuevaNotificacion(); return false">
                                            <div class="row">
                                                <div class="col-8">
                                                    <textarea id="mensaje" name="mensaje_global" placeholder="Escriba un mensaje aqui..." class="form-control b-0"></textarea>
                                                </div>
                                                <div class="col-4 text-right">
                                                    <button type="submit" name="new_global" class="btn btn-info btn-circle btn-lg" title="Enviar" id="Add_notificacion"><i style="margin-left: -1px;margin-top: -1px;" class="fas fa-paper-plane"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
</div>
                <?php pie(); ?>