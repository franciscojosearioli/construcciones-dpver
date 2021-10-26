<?php 
$user = current_user();
date_default_timezone_set('America/Argentina/Buenos_Aires');
$all_users = find_all_user_msj('usuarios',$user['id']);
$mensajes_globales = mensajes_globales();
$mensajes_privados1 = mensajes_privados_recibidos($user['id']);
$mensajes_privados2 = mensajes_privados_enviados($user['id']);
?>

<div class="modal fade right" id="notificaciones" tabindex="-1" role="dialog" aria-labelledby="notificaciones"
  aria-hidden="true">
  <div class="modal-dialog modal-full-height modal-right" style="overflow-y: scroll;"> 
 


    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="notificaciones">Mensajes privados</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<br>
        <ul class="nav md-pills nav-justified" id="myClassicTab" role="tablist">
    <li class="nav-item">
      <a class="nav-link  waves-light active show" id="profile-tab-classic" data-toggle="tab" href="#profile-classic"
        role="tab" aria-controls="profile-classic" aria-selected="true">Recibidos</a>
    </li>
    <li class="nav-item">
      <a class="nav-link waves-light" id="follow-tab-classic" data-toggle="tab" href="#follow-classic" role="tab"
        aria-controls="follow-classic" aria-selected="false">Enviados</a>
    </li>
    </li>
  </ul>
  <div class="tab-content border-right border-bottom border-left rounded-bottom" id="myClassicTabContent">
    <div class="tab-pane fade active show" id="profile-classic" role="tabpanel" aria-labelledby="profile-tab-classic">
      <div class="modal-body" style="height: 500px;background-color: #f1f1f1;">
                  <table class="table table-striped" style="margin-top: -25px;margin-left: -10px; width: 110%;" cellspacing="0">               
  <tr style="background-color: #f1f1f1;">
    <td>
      <div id="ResultRecibidos"><?php include('includes/assets/notificaciones/privados/recibidos.php');?></div>
    </td></tr></table>
      </div>  
      <br>
<form name="NewMP" action="" onsubmit="NewMensajePrivado(); return false">
   
    </div>
    <div class="tab-pane fade" id="follow-classic" role="tabpanel" aria-labelledby="follow-tab-classic">


<!-- Tab panels -->
<div class="tab-content pt-0">

      <div class="modal-body" style="height: 350px;background-color: #f1f1f1;">
                  <table class="table table-striped" style="margin-top: -25px;margin-left: -10px; width: 110%;" cellspacing="0">   
                    <tr style="background-color: #f1f1f1;"><td>      
<div id="ResultMP"><?php include('includes/assets/notificaciones/privados/consulta.php');?></div>
</td></tr>      
</table>
      </div>
<br>
<div class="row footer-adjust">
                      <div class="col-md-12">
                        <select class="browser-default custom-select" name="receptor">
                          <option selected>Seleccionar destinatario</option>
             <?php foreach ($all_users as $u):?>
                          <option value="<?php echo $u['id']; ?>"><?php echo $u['name']; ?></option>
             <?php endforeach; ?>
                        </select>
                      </div>
</div>      

<div class="row footer-adjust">
              <div class="col-9">
          <div class="md-form">            
  <textarea type="text" id="mensaje_privado" name="mensaje_privado" class="md-textarea form-control" rows="2"></textarea>
  <label for="mensaje_privado">Redactar un mensaje...</label>
</div></div>
        <div class="col-3">
        <button type="submit" name="new_privado" class="btn-floating btn-md green lighten-2 waves-effect waves-light next-step ml-auto" title="Enviar"><i style="margin-left: -1px;" class="fas fa-paper-plane"></i></button>
        </div>
      </div>
    </form>


  </div>
  <!--/.Panel 2-->


</div>

  </div>
    </div>
  </div>
</div>