<?php
require_once('../../includes/load.php');
require_once('../../includes/functions/recordatorios.php');
$user = current_user();
$notificaciones = listar_recordatorios($user['id']);
cabecera('Recordatorios'); ?>
            <div class="row">
                <div class="col-lg-12">
                    <?php echo display_msg($msg); ?>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="card m-b-0">
                            <div class="chat-main-box-recordatorios">
                                <div class="chat-main-header">
                                    <div class="p-20 b-b">
                                        <h3 class="box-title">Pendientes</h3>
                                    </div>
                                </div>
                                <div class="chat-rbox">
                                    <ul class="chat-list p-20">
                                        <div id="ResultadoRecordatoriosp"></div>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="card m-b-0">
                            <div class="chat-main-box-recordatorios">
                                <div class="chat-main-header">
                                    <div class="p-20 b-b">
                                        <h3 class="box-title">Finalizados</h3>
                                    </div>
                                </div>
                                <div class="chat-rbox">
                                    <ul class="chat-list p-20">
                                        <div id="ResultadoRecordatoriosf"></div>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<a class="flotante" data-toggle="modal" data-target="#agregar_recordatorios"><button type="submit" class="btn btn-info btn-circle btn-lg" title="Enviar"><i class="fas fa-plus fa-1x"></i></button></a>
                <?php
                require_once('../modals/agregar_recordatorio.php');
                 pie(); ?>