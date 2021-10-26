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
    $recepciones_obra =  recepciones_obra($obra['idobras']);
    ?>
    <?php if(empty($recepciones_obra) ){ echo '<div class="card p-20"><center>No se han registrado recepciones de obra.</center></div>'; } 
if(isset($recepciones_obra)){ ?>

<h3 class="titulo-bienvenida">Recepciones</h3>                       
<div class="owl-carousel obra-recepciones">

<?php
foreach($recepciones_obra as $r):
if(ifexist($r['expediente'])){  
$inicio_exp = buscar_expediente($r['expediente']);  
  $ul_mov_exp = ul_mov_exp($r['expediente']); } ?>

<div class="p-3">
<div class="card">
<div class="card-body">
<h3 class="card-title p-20"><?php if($r['tipo'] == 'rp'){ echo 'Recepcion Provisoria'; }elseif($r['tipo'] == 'rd'){ echo 'Recepcion Definitiva'; } ?></h3>
<?php if(permiso('obras') || permiso('admin')){ ?>
<a class="i-dt-list" onclick="editar_recepcion(<?php echo (int)$r['idrecepciones'];?>)" data-toggle="tooltip" title="Editar datos"><i class="fa fa-edit"></i> Editar dato</a>
<?php } ?>
<p class="card-text">
<u>Nº expediente:</u> <?php echo $r['expediente']; ?><br/>
<?php if(ifexist($r['expediente'])){ echo '<u>Inicio del tramite:</u> '.ifdate($inicio_exp['fechareg']).'<br/><u>Ubicacion del tramite:</u> <b>'.utf8_encode($ul_mov_exp['tramite']).'</b> desde '.format_date($ul_mov_exp['fecha']);} ?>                                  
<br/><br/>
<u>Resolucion de comision:</u> <?php if(!empty($r['comision_numero'])) { echo $r['comision_numero'];}if(!empty($r['comision_fecha'])) { echo ' el '.$r['comision_fecha']; } if(!empty($r['comision_archivo'])) { echo ' Ver archivo'; }else{echo ' Sin resolucion'; }  ?><br/>
<u>Integrantes de comision:</u><br> <?php 
if(!empty($r['agente1'])){ echo $r['agente1'].'<br>';} 
if(!empty($r['agente2'])){ echo $r['agente2'].'<br>';} 
if(!empty($r['agente3'])){ echo $r['agente3'].'<br>';} 
if(!empty($r['agente4'])){ echo $r['agente4']; } ?>
<br/>
<?php if(!empty($r['informe_archivo'])){ echo '<u>Informe:</u> '.$r['informe_archivo'].'<br>'; } ?>
<u>Acta de recepcion:</u> <?php if(!empty($r['acta_numero'])) { echo $r['acta_numero'];}if(!empty($r['acta_fecha'])) { echo ' el '.$r['acta_fecha']; } if(!empty($r['acta_archivo'])) { echo ' Ver archivo'; }else{echo ' Sin resolucion'; }  ?><br/>

<?php if($r['documentacion'] == 1){ echo '<br><u>Documentacion:</u> cargada<br>'; } ?>

<?php if(!empty($r['observaciones'])){ echo '<br><u>Observaciones:</u><br/>'.textarea($r['observaciones']); } ?>

</p>
</div>
</div></div>
                                <?php endforeach; } ?> 
</div>
                      <?php } endforeach; ?>
<script>

$('.obra-recepciones').owlCarousel({
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

