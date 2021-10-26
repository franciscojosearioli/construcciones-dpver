<?php 
require_once('../../includes/load.php');
cabecera('Registro de actividades');
$user = current_user();
$actividades = usuarios_actividades();
?>
<div class="row justify-content-center">
  <div class="col-8">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-12">
            <div class="d-flex flex-wrap margin-dt">
              <div>
                <h3 class="card-title">Registros del dia </h3>
              </div>
          </div>
<div class="card card-signin">
<div class="card-body mx-4">
<?php if(!empty($actividades)){ ?>
<div class="list-group usuarios_movimientos scrollbar-ripe-malinka">
<?php 
foreach ($actividades as $a): 
?>
<div class="list-group-item" style="padding-bottom: 5px;" >
<p><?php if($a['idusuarios'] != 0){ echo user_name_mensajes($a['idusuarios']).': '.$a['evento']; } else { echo 'Visitante: '.$a['evento']; }?></p>
<p>
<?php if($a['tipo'] == 'proyecto'){ $obra = find_by_id('obras','idobras',$a['dato']); ?><a href="proyecto?id=<?php echo $obra['idobras']; ?>" target="_blank">Ver proyecto</a><?php } ?>  
<?php if($a['tipo'] == 'obra'){ $obra = find_by_id('obras','idobras',$a['dato']); ?><a href="obra?id=<?php echo $obra['idobras']; ?>" target="_blank">Ver obra</a><?php } ?>  
<?php if($a['tipo'] == 'modificacion'){ $obra = find_by_id('obras','idobras',$a['dato']); ?><a href="obra?id=<?php echo $obra['idobras']; ?>" target="_blank">Ver obra</a><?php } ?>  
<?php if($a['tipo'] == 'ampliacion'){ $obra = find_by_id('obras','idobras',$a['dato']); ?><a href="obra?id=<?php echo $obra['idobras']; ?>" target="_blank">Ver obra</a><?php } ?>  
<?php if($a['tipo'] == 'neutralizacion'){ $obra = find_by_id('obras','idobras',$a['dato']); ?><a href="obra?id=<?php echo $obra['idobras']; ?>" target="_blank">Ver obra</a><?php } ?>  
<?php if($a['tipo'] == 'obras-cotizacion'){ $fila_coti = find_by_id('obras_items','idobras_items',$a['dato']); ?><a href="obra?id=<?php echo $fila_coti['idobras']; ?>" target="_blank">Ver obra</a><?php } ?>  
<?php if($a['tipo'] == 'obras-plan'){ $fila_plan = find_by_id('obras_planoficial','idobras_planoficial',$a['dato']); ?><a href="obra?id=<?php echo $fila_plan['idobras']; ?>" target="_blank">Ver obra</a><?php } ?>  
<?php if($a['tipo'] == 'certificados_obras'){ $cert = find_by_id('certificados_obras','idcertificados_obras',$a['dato']); ?><a href="obra?id=<?php echo $cert['idobras']; ?>" target="_blank">Ver obra</a><?php } ?>  
<?php if($a['tipo'] == 'expediente' || $a['tipo'] == 'nota' || $a['tipo'] == 'presentacion'){ $tramite = find_by_id('tramites','idtramites',$a['dato']); ?><a href="tramite?id=<?php echo $tramite['numero']; ?>" target="_blank">Ver tramite</a><?php } ?>
<?php if($a['tipo'] == 'obras-recepciones'){ $fila = find_by_id('recepciones','idrecepciones',$a['dato']); ?><a href="obra?id=<?php echo $fila['idobras']; ?>" target="_blank">Ver obra</a> <?php } ?>

<?php if($a['tipo'] == 'obras-ampliaciones'){ ?><a href="obra?id=<?php echo $a['dato']; ?>" target="_blank">Ver obra</a> <?php } ?>
<?php if($a['tipo'] == 'obras-modificaciones'){ ?><a href="obra?id=<?php echo $a['dato']; ?>" target="_blank">Ver obra</a> <?php } ?>

<?php if($a['tipo'] == 'obras-neutralizaciones'){ ?><a href="obra?id=<?php echo $a['dato']; ?>" target="_blank">Ver obra</a> <?php } ?>
<?php if($a['tipo'] == 'obras-planes'){ ?><a href="obra?id=<?php echo $a['dato']; ?>" target="_blank">Ver obra</a> <?php } ?>


<?php if($a['tipo'] == 'obras-archivos'){ $obra = find_by_id('obras','idobras',$a['dato']); ?><a href="obra?id=<?php echo $obra['idobras']; ?>" target="_blank">Ver obra</a><?php } ?>  
<?php if($a['tipo'] == 'inspeccion-nota'){ ?><a href="obra?id=<?php echo $a['dato']; ?>" target="_blank">Ver obra</a><?php } ?>  
<?php if($a['tipo'] == 'inspeccion-orden'){  ?><a href="obra?id=<?php echo $a['dato']; ?>" target="_blank">Ver obra</a><?php } ?>  
<?php if($a['tipo'] == 'inspeccion-asistencia'){  ?><a href="obra?id=<?php echo $a['dato']; ?>" target="_blank">Ver obra</a><?php } ?>  
<?php if($a['tipo'] == 'obra-avance'){  ?><a href="obra?id=<?php echo $a['dato']; ?>" target="_blank">Ver obra</a><?php } ?>  
</p>
<p style="color:#00000080;font-size: 11px;">               
<span style="float:right;">  Ip: <?php echo $a['ip']; ?> - Fecha: <?php echo format_dyt($a['fecha']); ?></span>
</p>
</div>
<?php endforeach;
}else{
echo '<div class="list-group">No se ha registrado actividad.</div>'; }
?>
</div>
</div>     
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php 
pie(); ?>