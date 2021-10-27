<?php 
require_once('../../includes/load.php');
$obra_id=$_GET['id'];
$user = current_user();
$obra = find_by_id('obras','idobras',(int)$_GET['id']);  
if($obra['estado'] == 1){ redirect('proyecto?id='.$obra_id, false); }
require_once('../../includes/functions/obras.php');  
require_once('../../../uploads/files.php'); 
$ejecutados = all_oyp();
$all_user = all_usuarios();
foreach($ejecutados as $obra):
  if($obra['idobras'] == $obra_id){
    $ampliaciones_de_obra =  ampliaciones_de_obra($obra['idobras']);
    ?>
    <?php if(empty($ampliaciones_de_obra)){ echo '<div class="card p-20"><center>No se han registrado ampliaciones de obra.</center></div>'; }  ?>




<?php if(!empty($ampliaciones_de_obra)){ ?>
<h3 class="titulo-bienvenida p-20">Ampliaciones</h3>            
<div class="owl-carousel obra-ampliaciones">
<?php
foreach($ampliaciones_de_obra as $ampliacion): 
if(ifexist($ampliacion['expediente'])){  $ul_mov_exp = ul_mov_exp($ampliacion['expediente']);} ?>
<div class="p-3">
<div class="card card-outline-inverse">
<div class="card-body">
<h3 class="card-title"><?php echo $ampliacion['numero'].'° Ampliacion '; ?></h3>
<?php if(permiso('obras') || permiso('admin')){ ?>
<a class="i-dt-list" onclick="editar_ampliacion(<?php echo (int)$ampliacion['idampliaciones'];?>)" data-toggle="tooltip" title="Editar datos"><i class="fa fa-edit"></i> Editar dato</a>
 <?php } ?>
<div class="d-flex flex-row">
  <div class="p-3">
  <?php if(ifexist($ampliacion['expediente'])){ echo '<label class="control-label text-muted" style="font-size:12px;">Tramite</label> <p>Expediente N° '.$ampliacion['expediente'].'</p>';} ?>
  </div>
  <div class="p-3">
  <?php if(ifexist($ampliacion['expediente'])){ echo '<label class="control-label text-muted" style="font-size:12px;">Movimientos del tramite</label> <p>'.utf8_encode($ul_mov_exp['tramite']); } if(!empty($ul_mov_exp['fecha'])){ echo ' desde '.format_date($ul_mov_exp['fecha']).'</p>';} ?>
  </div>
  </div>

  <div class="d-flex flex-row">
  <div class="p-3">
  <label class="control-label text-muted" style="font-size:12px;">Estado del tramite</label>
<p><?php 
if($ampliacion['estado'] == 0){ echo 'Sin definir';} 
if($ampliacion['estado'] == 1){ echo 'Confeccion Inspeccion';}
if($ampliacion['estado'] == 2){ echo 'Revision Dpto. II Obras por contrato';}
if($ampliacion['estado'] == 3){ echo 'Autorizando Ing. Jefe';}
if($ampliacion['estado'] == 4){ echo 'Encuadre Legal';}
if($ampliacion['estado'] == 5){ echo 'Imputacion del gasto';}
if($ampliacion['estado'] == 6){ echo 'Confeccionando resolucion';}
if($ampliacion['estado'] == 7){ echo 'Resolucion aprobada';} ?></p>   
  </div>
  <div class="p-3">
<label class="control-label text-muted" style="font-size:12px;">Progreso del tramite</label>
<p> <?php if(!empty($ampliacion['estado'])){ echo number_format($ampliacion['estado']*100/7,2). ' %';}else{ echo '0 %';} ?></p>
  </div>
  <div class="p-3">
  <label class="control-label text-muted" style="font-size:12px;">Resolucion de aprobacion</label><p>
<?php if(!empty($ampliacion['resolucion_numero']) || $ampliacion['resolucion_fecha'] != '0000-00-00'){  ?>
<?php if(!empty($ampliacion['resolucion_numero'])){ echo 'Nº '.$ampliacion['resolucion_numero'].' ';} if($ampliacion['resolucion_fecha'] != '0000-00-00' && $ampliacion['resolucion_fecha'] != NULL){ echo 'Fecha '.$ampliacion['resolucion_fecha']; } ?><?php } ?></p>
<?php if(!empty($ampliacion['resolucion_archivo'])){ ?> 
<a target="_blank" href="../uploads/obras/<?php echo $obra['idobras']; ?>/Tramites/Ampliaciones/<?php echo $ampliacion['numero']; ?>/Resolucion/<?php echo $ampliacion['resolucion_archivo']; ?>">Ver resolucion</a>
<?php }else{ echo 'Sin cargar resolucion'; } ?>
  </div>
  </div>  


  
  <div class="d-flex flex-row">
  <div class="p-3">
<?php if(ifexist($ampliacion['plazo'])){ ?>
<label class="control-label text-muted" style="font-size:12px;">Plazo a tramitar</label>
<p><?php echo $ampliacion['plazo'].'</p>'; } ?>
</div>
<div class="p-3">
<?php if(ifexist($ampliacion['plazo_final'])){ ?>
<label class="control-label text-muted" style="font-size:12px;">Plazo final</label>
<p><?php echo $ampliacion['plazo_final'].'</p>'; } ?>

  </div>
  </div>  

<?php if(ifexist($ampliacion['observaciones'])){ ?>
  <div class="p-3">
<label class="control-label text-muted" style="font-size:12px;">Observaciones</label>
<?php echo '<p>'.textarea($ampliacion['observaciones']).'</p></div>'; } ?>
<div class="p-3">
<?php
$plan_obra = find_by_id('planes_de_trabajo','idplanes_de_trabajo',$ampliacion['idplanes_de_trabajo']);
if($plan_obra){
?>
<label class="control-label text-muted" style="font-size:12px;">Plan de trabajo</label>
<a class="list-group-item" style="padding:15px; text-decoration: none; color:#00000080" onclick="ver_plan(<?php echo $ampliacion['idplanes_de_trabajo']; ?>)">
<span style="font-weight:500">Plan <?php echo $plan_obra['numero']; ?></span>
</a>
<?php } ?>
</div>
</div>
</div>
</div>
<?php endforeach; ?>
</div>
<?php } ?>
   
<?php } endforeach; ?>



<script>
  $(document).ready(function(){
        init_php_file_tree();
    });
$('.obra-ampliaciones').owlCarousel({
    loop:true,
    margin:10,
    responsiveClass:true,nav:false,
    responsive:{
        0:{
            items:1,
            nav:false
        },
        600:{
            items:2,
            nav:false
        },
        1000:{
            items:2,
            nav:false,
            loop:false
        }
    }
});
</script>