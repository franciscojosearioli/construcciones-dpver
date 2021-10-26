<?php
require_once('../../includes/load.php');
require_once('../../includes/functions/notificaciones.php');
cabecera('Notificaciones');
$user = current_user();
$avisos_activos = all_notificaciones_activos();
$avisos_inactivos = all_notificaciones_inactivos();
 ?>
         <div class="row justify-content-center">
          <div class="col-8">
<div class="row" id="notificaciones">
  <div class="col-12">
    <div class="card">
      <div class="card-body cards-titulo">
            <div class="d-flex flex-wrap">
              <div class="my-auto ml-3">
                NOTIFICACIONES
              </div>
              <div class="ml-auto my-auto mr-3">
              <a id="btn_agregar" onclick="form_agregar(true)" title="Agregar nuevo" data-toggle="tooltip"><i class="fas fa-plus"></i></a>
              </div>
            </div>
           
          </div>
        </div>

<ul class="nav nav-tabs nav-justified md-tabs indigo" id="myTabJust" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab-just" data-toggle="tab" href="#home-just" role="tab" aria-controls="home-just"
      aria-selected="true">Activos</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="profile-tab-just" data-toggle="tab" href="#profile-just" role="tab" aria-controls="profile-just"
      aria-selected="false">Inactivos</a>
  </li>
</ul>
<div class="card">
<div class="tab-content pt-5" id="myTabContentJust">
  <div class="tab-pane fade show active" id="home-just" role="tabpanel" aria-labelledby="home-tab-just">
                                        <ul class="chat-list p-20">
<?php foreach($avisos_activos as $aviso): ?>
<div class="alert alert-<?php echo $aviso['color']; ?> alert-dismissible fade show" role="alert">
    <div class="row">
        <div class="col-10">
<h4 class="alert-heading"><?php echo $aviso['asunto']; ?></h4>
  <p><?php echo $aviso['mensaje']; ?></p>
  <hr>
  <p class="mt-0 mb-0 text-muted"><?php echo user_name_mensajes($aviso['registro_usuario']); ?> el <?php echo format_dyt($aviso['registro_fecha']); ?></p>
        </div>
        <div class="col-2">
            <a class="close avisos-button" style="padding: .75rem .5rem;" href="includes/functions/archivar.php?id=<?php echo (int)$aviso['idnotificacion'];?>&url=notificaciones&tipo=notificacion" data-toggle="tooltip" title="Desactivar">
    <span aria-hidden="true"><i class="fas fa-thumbs-down"></i></span>
  </a>
  <button type="button" class="close avisos-button" style="padding: .75rem .5rem;" onclick="editar_notificacion(<?php echo $aviso['idnotificacion']; ?>)" data-toggle="tooltip" title="Editar datos">
    <span aria-hidden="true"><i class="fas fa-edit"></i></span>
  </button>
        </div>
    </div>
  
</div>
<?php endforeach; ?>
     </ul>
  </div>
  <div class="tab-pane fade" id="profile-just" role="tabpanel" aria-labelledby="profile-tab-just">
<ul class="chat-list p-20">
<?php foreach($avisos_inactivos as $aviso): ?>
<div class="alert alert-<?php echo $aviso['color']; ?> alert-dismissible fade show" role="alert">
    <div class="row">
        <div class="col-10">
<h4 class="alert-heading"><?php echo $aviso['asunto']; ?></h4>
  <p><?php echo $aviso['mensaje']; ?></p>
  <hr>
  <p class="mt-0 mb-0 text-muted"><?php echo user_name_mensajes($aviso['registro_usuario']); ?> el <?php echo format_dyt($aviso['registro_fecha']); ?></p>
        </div>
        <div class="col-2">
<a class="close avisos-button" style="padding: .75rem .5rem;" href="includes/functions/restaurar.php?id=<?php echo (int)$aviso['idnotificacion'];?>&url=notificaciones&tipo=notificacion" data-toggle="tooltip" title="Restaurar">
    <span aria-hidden="true"><i class="fas fa-thumbs-up"></i></span>
  </a>  
  <button type="button" class="close avisos-button" style="padding: .75rem .5rem;" onclick="editar_notificacion(<?php echo $aviso['idnotificacion']; ?>)" data-toggle="tooltip" title="Editar datos">
    <span aria-hidden="true"><i class="fas fa-edit"></i></span>
  </button>
        </div>
    </div>
  
</div>
<?php endforeach; ?>
     </ul>
  </div>
</div>
</div>
        
      </div>    
    </div>
  </div>
</div>
<div id="editar_notificaciones"></div>
<script type="text/javascript" src="includes/ajax/scripts/notificaciones.js"></script>
<?php 
require_once('../forms/agregar_notificacion.php');
pie(); 
?>