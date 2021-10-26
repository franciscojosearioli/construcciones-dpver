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
    $modificaciones_de_obra =  modificaciones_de_obra($obra['idobras']);
    ?>
    <?php if(empty($modificaciones_de_obra) && empty($modificaciones_de_obra)){ echo '<div class="card p-20"><center>No se han registrado modificaciones de obra.</center></div>'; }  ?>


<?php if(!empty($modificaciones_de_obra)){ ?>
<h3 class="titulo-bienvenida">Modificaciones</h3>                       
<div class="owl-carousel obra-modificaciones">
<?php 
foreach($modificaciones_de_obra as $modificacion):
if(ifexist($modificacion['expediente'])){  $ul_mov_exp = ul_mov_exp($modificacion['expediente']); }
?>        
<div class="p-3">
<div class="card">
<div class="card-body">
<h3 class="card-title p-20"><?php echo $modificacion['numero'].'° Modificacion '; ?></h3>
<?php if(permiso('obras') || permiso('admin')){ ?>
<a class="i-dt-list" onclick="editar_modificacion(<?php echo (int)$modificacion['idmodificaciones'];?>)" data-toggle="tooltip" title="Editar datos"><i class="fa fa-edit"></i> Editar dato</a>
<?php } ?>
<div class="d-flex flex-row">
  <div class="p-3">
  <?php if(ifexist($modificacion['expediente'])){ echo '<label class="control-label text-muted" style="font-size:12px;">Tramite</label> <p>Expediente N° '.$modificacion['expediente'].'</p>';} ?>
  </div>
  <div class="p-3">
  <?php if(ifexist($modificacion['expediente'])){ echo '<label class="control-label text-muted" style="font-size:12px;">Movimientos del tramite</label> <p>'.utf8_encode($ul_mov_exp['tramite']); } if(!empty($ul_mov_exp['fecha'])){ echo ' desde '.format_date($ul_mov_exp['fecha']).'</p>';} ?>
  </div>
  </div>
<div class="d-flex flex-row">
  <div class="p-3">
  <label class="control-label text-muted" style="font-size:12px;">Estado del tramite</label>
<p><?php 
if($modificacion['estado'] == 0){ echo 'Sin definir';} 
if($modificacion['estado'] == 1){ echo 'Confeccion Inspeccion';}
if($modificacion['estado'] == 2){ echo 'Revision Dpto. II Obras por contrato';}
if($modificacion['estado'] == 3){ echo 'Autorizando Ing. Jefe';}
if($modificacion['estado'] == 4){ echo 'Encuadre Legal';}
if($modificacion['estado'] == 5){ echo 'Imputacion del gasto';}
if($modificacion['estado'] == 6){ echo 'Confeccionando resolucion';}
if($modificacion['estado'] == 7){ echo 'Resolucion aprobada';} ?></p>   
  </div>
  <div class="p-3">
<label class="control-label text-muted" style="font-size:12px;">Progreso del tramite</label>
<p> <?php if(!empty($modificacion['estado'])){ echo number_format($modificacion['estado']*100/7,2). ' %';}else{ echo '0 %';} ?></p>
  </div>

  <div class="p-3">
  <label class="control-label text-muted" style="font-size:12px;">Resolucion de aprobacion</label>
  <p><?php if(!empty($modificacion['resolucion_numero']) || $modificacion['resolucion_fecha'] != '0000-00-00'){  ?>
<?php if(!empty($modificacion['resolucion_numero'])){ echo 'Nº '.$modificacion['resolucion_numero'].' ';} if($modificacion['resolucion_fecha'] != '0000-00-00'){ echo 'Fecha '.$modificacion['resolucion_fecha']; } ?><?php } ?></p>
<?php if(!empty($modificacion['resolucion_archivo'])){ ?> 
<a target="_blank" href="../uploads/obras/<?php echo $obra['idobras']; ?>/Tramites/Modificaciones/<?php echo $modificacion['numero']; ?>/Resolucion/<?php echo $modificacion['resolucion_archivo']; ?>">Ver resolucion</a>
<?php }else{ echo 'Sin cargar resolucion'; } ?>
  </div>
  </div>  
  <div class="d-flex flex-row">
  <div class="p-3">
  <?php if(ifexist($modificacion['monto'])){ ?>
<label class="control-label text-muted" style="font-size:12px;">Monto de mayor gasto</label>
<p><?php echo '$ '.numero($modificacion['monto']); } ?></p>
  </div>
  <div class="p-3">
  <?php if(ifexist($modificacion['monto_final']) && $modificacion['monto_final'] != '0.00'){ ?>
<label class="control-label text-muted" style="font-size:12px;">Mayor gasto</label>
<?php $result_porc = ($modificacion['monto_final']*100/$obra['contrato_monto'])-100;
echo '<p>'.number_format($result_porc,2).' %</p>';
} ?>
  </div>
  <div class="p-3">
  <?php if(ifexist($modificacion['monto_final'])){ ?>
<label class="control-label text-muted" style="font-size:12px;">Monto final</label>
<?php echo '<p>$ '.numero($modificacion['monto_final']).'</p>'; } ?>
  </div>
  </div>

<?php if(ifexist($modificacion['descripcion'])){ ?>
  <div class="p-3">
<label class="control-label text-muted" style="font-size:12px;">Memoria</label>
<?php echo '<p>'.textarea($modificacion['descripcion']).'</p></div>'; } ?>
<?php if(ifexist($modificacion['observaciones'])){ ?>
  <div class="p-3">
<label class="control-label text-muted" style="font-size:12px;">Observaciones</label>
<?php echo '<p>'.textarea($modificacion['observaciones']).'</p></div>'; } ?>
<div class="p-3">
<?php
$cotizacion_obra = find_by_id('cotizaciones','idcotizaciones',$modificacion['idcotizaciones']);
if($cotizacion_obra){
?>
<label class="control-label text-muted" style="font-size:12px;">Cotizacion</label>
<a class="list-group-item" style="padding:15px; text-decoration: none; color:#00000080" onclick="ver_cotizacion(<?php echo $modificacion['idcotizaciones']; ?>)">
<span style="font-weight:500">Cotizacion <?php echo $cotizacion_obra['numero']; ?></span>
</a>
<?php } ?>
</div>
<div class="p-3">
<?php
$plan_obra = find_by_id('planes_de_trabajo','idplanes_de_trabajo',$modificacion['idplanes_de_trabajo']);
if($plan_obra){
?>
<label class="control-label text-muted" style="font-size:12px;">Plan de trabajo</label>
<a class="list-group-item" style="padding:15px; text-decoration: none; color:#00000080" onclick="ver_plan(<?php echo $modificacion['idplanes_de_trabajo']; ?>)">
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

$('.obra-modificaciones').owlCarousel({
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

function ver_plan(valor){
  var valor = valor;
  $.ajax({
  type: "POST",
  data: "id="+valor,
  url: "content/modals/ver_plan_de_trabajo.php",
  success: function(respuesta) {
  $('#modal-planillas').html(respuesta).appendTo('body');
  $('#ver_plan_de_trabajo').modal('show');
  }
  });
  }
  function ver_cotizacion(valor){
  var valor = valor;
  $.ajax({
  type: "POST",
  data: "id="+valor,
  url: "content/modals/ver_cotizacion.php",
  success: function(respuesta) {
  $('#modal-planillas').html(respuesta).appendTo('body');
  $('#ver_cotizacion').modal('show');
  }
  });
  }
</script>

