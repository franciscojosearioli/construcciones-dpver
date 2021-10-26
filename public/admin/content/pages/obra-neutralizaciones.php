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
    $neutralizaciones_de_obra =  neutralizaciones_de_obra($obra['idobras']);
    if(empty($neutralizaciones_de_obra)){ echo '<div class="card p-20"><center>No se han registrado neutralizaciones de obra.</center></div>'; }  ?>




<?php if(!empty($neutralizaciones_de_obra)){ ?>

<h3 class="titulo-bienvenida">Neutralizaciones</h3>                       
<div class="owl-carousel obra-neutralizaciones">

<?php 
foreach($neutralizaciones_de_obra as $neutralizacion):
if(ifexist($neutralizacion['expediente'])){   $ul_mov_exp = ul_mov_exp($neutralizacion['expediente']); }
?>        
<div class="p-3">
<div class="card">
<div class="card-body">
<h3 class="card-title p-20"><?php echo $neutralizacion['numero'].'° Neutralizacion '; ?></h3>
<?php if(permiso('obras') || permiso('admin')){ ?>
<a class="i-dt-list" onclick="editar_neutralizacion(<?php echo (int)$neutralizacion['idneutralizaciones'];?>)" data-toggle="tooltip" title="Editar datos"><i class="fa fa-edit"></i> Editar dato</a>
<?php } ?>
<div class="d-flex flex-row">
  <div class="p-3">
  <?php if(ifexist($neutralizacion['expediente'])){ echo '<label class="control-label text-muted" style="font-size:12px;">Tramite</label> <p>Expediente N° '.$neutralizacion['expediente'].'</p>';} ?>
  </div>
  <div class="p-3">
  <?php if(ifexist($neutralizacion['expediente'])){ echo '<label class="control-label text-muted" style="font-size:12px;">Movimientos del tramite</label> <p>'.utf8_encode($ul_mov_exp['tramite']); } if(!empty($ul_mov_exp['fecha'])){ echo ' desde '.format_date($ul_mov_exp['fecha']).'</p>';} ?>
  </div>
  </div>
<div class="d-flex flex-row">
  <div class="p-3">
  <label class="control-label text-muted" style="font-size:12px;">Estado del tramite</label>
<p><?php 
if($neutralizacion['estado'] == 0){ echo 'Sin definir';} 
if($neutralizacion['estado'] == 1){ echo 'Confeccion Inspeccion';}
if($neutralizacion['estado'] == 2){ echo 'Revision Dpto. II Obras por contrato';}
if($neutralizacion['estado'] == 3){ echo 'Autorizando Ing. Jefe';}
if($neutralizacion['estado'] == 4){ echo 'Encuadre Legal';}
if($neutralizacion['estado'] == 5){ echo 'Imputacion del gasto';}
if($neutralizacion['estado'] == 6){ echo 'Confeccionando resolucion';}
if($neutralizacion['estado'] == 7){ echo 'Resolucion aprobada';} ?></p>   
  </div>
  <div class="p-3">
<label class="control-label text-muted" style="font-size:12px;">Progreso del tramite</label>
<p> <?php if(!empty($neutralizacion['estado'])){ echo number_format($neutralizacion['estado']*100/7,2). ' %';}else{ echo '0 %';} ?></p>
  </div>
  <div class="p-3">
  <label class="control-label text-muted" style="font-size:12px;">Resolucion de aprobacion</label><p>
<?php if(!empty($neutralizacion['resolucion_numero']) || $neutralizacion['resolucion_fecha'] != '0000-00-00'){  ?>
<?php if(!empty($neutralizacion['resolucion_numero'])){ echo 'Nº '.$neutralizacion['resolucion_numero'].' ';} if($neutralizacion['resolucion_fecha'] != '0000-00-00' && $neutralizacion['resolucion_fecha'] != NULL){ echo 'Fecha '.$neutralizacion['resolucion_fecha']; } ?><?php } ?></p>
<?php if(!empty($neutralizacion['resolucion_archivo'])){ ?> 
<a target="_blank" href="../uploads/obras/<?php echo $obra['idobras']; ?>/Tramites/Neutralizaciones/<?php echo $neutralizacion['numero']; ?>/Resolucion/<?php echo $neutralizacion['resolucion_archivo']; ?>">Ver resolucion</a>
<?php }else{ echo 'Sin cargar resolucion'; } ?>
  </div>
  </div>  
  <?php if($neutralizacion['fecha_inicio'] != NULL){ ?>
  <div class="d-flex flex-row">
  <div class="p-3">
  <label class="control-label text-muted" style="font-size:12px;">Fecha de neutralizacion</label>
<p><?php echo format_date($neutralizacion['fecha_inicio']); ?></p>   
  </div>
  </div>  
  <?php } ?>
  
  <?php if($neutralizacion['fecha_reinicio'] != NULL){ ?>
  <div class="d-flex flex-row">
  <div class="p-3">
  <label class="control-label text-muted" style="font-size:12px;">Fecha de reinicio de obra</label>
<p><?php echo format_date($neutralizacion['fecha_reinicio']); ?></p>   
  </div>
  </div>  
  <?php } ?>
<?php if(ifexist($neutralizacion['observaciones'])){ ?>
  <div class="p-3">
<label class="control-label text-muted" style="font-size:12px;">Observaciones</label>
<?php echo '<p>'.textarea($neutralizacion['observaciones']).'</p></div>'; } ?>
</div>
</div>
</div>
<?php endforeach; }?>

</div>
<?php } ?>
   
<?php  endforeach; ?>



<script>
  $(document).ready(function(){
        init_php_file_tree();
    });
$('.obra-neutralizaciones').owlCarousel({
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

