<?php
$id=$_GET['id'];
$results = '';
require_once('../../includes/load.php');
$obra = find_by_id('obras','idobras',$id); 
$modificaciones_de_obra =  modificaciones_de_obra($id);
$ampliaciones_de_obra =  ampliaciones_de_obra($id);
$neutralizaciones_de_obra =  neutralizaciones_de_obra($id);
$recepcion_obra = recepciones_obra($obra['nombre']);
$fecha = make_date();
cabecera_print_vertical_doc('Informe-'.$obra['idobras'].'-'.$fecha);
?>
<div class="row">
<div class="col-md-12">
  <center>
    <b>
      <h4>Informe de obra</h4>
    </b>
  </center>
</div>
<br>
<div class="col-md-12">
<b>Obra:</b> <?php echo $obra['nombre']; ?><br />
<b>Tipo:</b> <?php echo $obra['descripcion']; ?><br />
<b>Departamentos/Localidades:</b> <?php echo $obra['ubicacion']; ?><br />
<?php if(!empty($obra['longitud'])){ ?><b>Longitud:</b> <?php echo $obra['longitud'].' metros.';} else { echo ''; ?><?php }  ?>
<br>
<b>Nº Expediente:</b> <?php echo $obra['expediente']; ?><br />  
</div>
</div>
<br>
<div class="row">
<div class="col-md-12">
<b>Aprobacion de proyecto:</b> <?php if($obra['aprobacion_res_fecha'] != NULL){ echo format_date($obra['aprobacion_res_fecha']); }else{'';} ?> <?php if(!empty($obra['aprobacion_res_num'])){ echo 'por Res. Nº'.$obra['aprobacion_res_num']; } else{echo '';} ?><br />
<b>Adjudicacion a empresa:</b> <?php if($obra['adjudicacion_res_fecha'] != NULL){ echo format_date($obra['adjudicacion_res_fecha']); }else{'';} ?> <?php if(!empty($obra['adjudicacion_res_num'])){ echo 'por Res. Nº'.$obra['adjudicacion_res_num'];} else{echo '';} ?><br />
<b>Tipo de contratacion:</b> <?php echo $obra['tipo_contratacion']; ?><br />
<br>
<b>Contratista:</b> <?php echo $obra['contratista']; ?><br />
<b>Firma del contrato:</b> <?php if($obra['contrato_fecha'] != NULL){ echo format_date($obra['contrato_fecha']); } else { echo ''; } ?><br />
<b>Acta de inicio de obra:</b> <?php if($obra['fecha_inicio'] != NULL){ echo format_date($obra['fecha_inicio']); } else { echo ''; } ?><br />
</div>
</div>
<br>
<div class="row"> 
<div class="col-md-12">
<b>Presupuesto oficial:</b> <?php if(!empty($obra['proyecto_monto'])){ echo '$ '.numero($obra['proyecto_monto']); }else{'';} ?> <?php if(!empty($obra['proyecto_monto_fecha'])){ echo '('.$obra['proyecto_monto_fecha'].')'; }else{'';} ?><br />
<b>Plazo de garantia:</b> <?php echo $obra['plazo_garantia']; ?><br />
</div>
</div>
<br>
<div class="row">
<div class="col-md-12">
<b>Financiacion:</b> <?php echo $obra['tipo_financiamiento']; ?><br />
<b>Inspector de obra:</b> <?php echo inspector_name($obra['idinspector']); ?><br />
<b>Estado de obra:</b> <?php 
                  if($obra['estado'] == 6){ echo 'A Iniciar'; }
                  if($obra['estado'] == 0){ echo 'En ejecucion'; }
                  if($obra['estado'] == 3 && $obra['recepcion'] == 0){ echo 'Finalizada sin recibir'; }
                  if($obra['estado'] == 3 && $obra['recepcion'] == 1){ echo 'En garantia'; }
                  if($obra['estado'] == 3 && $obra['recepcion'] == 2){ echo 'Finalizada definitiva'; }
                  if($obra['estado'] == 4){ echo 'Neutralizada'; }
                  if($obra['estado'] == 5){ echo 'Rescindida'; } ?><br />

<?php if($obra['estado'] == 0){ ?>
<b>Finalizacion aproximada:</b> <?php if($obra['fecha_fin'] != NULL){ echo format_date($obra['fecha_fin']); } else { echo ''; } ?><br />
<?php }elseif($obra['estado'] == 3){ ?>
<b>Finalizacion:</b> <?php if($obra['fecha_fin'] != NULL){ echo format_date($obra['fecha_fin']); } else { echo ''; } ?><br />
<?php } ?>
</div>
</div>
<br>
<div class="row">
<div class="col-md-12">
            <center><b><h4>Montos y plazos de obra</h4></b></center>
<b>Monto de contrato:</b> <?php if(!empty($obra['contrato_monto'])){ echo '$ '.numero($obra['contrato_monto']);} ?><br />
<b>Plazo oficial:</b> <?php echo $obra['proyecto_plazo']; ?><br /><br />
<b>Monto vigente:</b> <?php if(!empty($obra['monto_vigente'])){ echo '$ '.numero($obra['monto_vigente']);} ?><br />            
<b>Plazo vigente:</b> <?php echo $obra['plazo_vigente']; ?><br /><br />
<b>Monto actualizado:</b> <?php if(!empty($obra['monto_redeterminado'])){ echo '$ '.numero($obra['monto_redeterminado']);} ?><br />
<b>Actualizacion:</b> <?php echo $obra['info_redeterminacion']; ?><br />
  </div>
</div>
<br>
<?php if($obra['estado'] == 0){ ?>
    <div class="row">
    <div class="col-md-12">
      <center><b><h4>Avance de obra</h4></b></center>
<table class="table table-bordered">
  <thead>
  <tr>
    <th>Nº certificado</th>
    <th>Fecha</th>
    <th>Plazo transcurrido</th>
    <th>Obra ejecutada</th>
    <th>Porcentaje</th>
  </tr>
</thead>
<tbody>
  <tr>
    <td><?php echo $obra['certificado_numero']; ?></td>
    <td><?php echo $obra['certificado_fecha']; ?></td>
    <td><?php echo $obra['certificado_plazo']; ?></td>
    <td><?php if(!empty($obra['certificado_monto'])){ echo '$ '.numero($obra['certificado_monto']);} ?></td>
    <td><?php echo $obra['certificado_porcentaje'].' %'; ?></td>
</tr>
</tbody>
</table>
  </div>
  </div>
<?php } ?>
<br>
<div class="row">
<div class="col-md-12">
<?php if(!empty($obra['obs'])){ echo '<hr><b>Observaciones:</b><br> '.textarea($obra['observaciones']).'<hr>';} ?>
</div>
</div>

<?php if(!empty($obra['memoria_descriptiva_vigente'])){ ?>
<div class="row">
<div class="col-md-12">
  <b>Memoria descriptiva vigente:</b><br />
<?php echo textarea($obra['memoria_descriptiva_vigente']); ?>
</div>
</div>
<?php }else{ ?>
<div class="row">
<div class="col-md-12">
  <b>Memoria descriptiva:</b><br />
<?php echo textarea($obra['memoria_descriptiva']); ?>
</div>
</div>
<?php } ?>
<br>

<?php if(isset($modificaciones_de_obra)){
foreach($modificaciones_de_obra as $modificacion): 
 if(ifexist($modificacion['expediente'])){  $ul_mov_exp_mod = ul_mov_exp($modificacion['expediente']); }
?>
<div class="form-group">
<div class="row">
<div class="col-12">
      <center>
    <b>
      <h4><?php echo $modificacion['numero'].'° Modificacion'; ?></h4>
    </b>
  </center>
<?php echo '<b>Expediente N°</b> '.$modificacion['expediente'].'<br />'; ?>
<?php if(ifexist($modificacion['expediente'])){ echo '<b>Ubicacion del tramite:</b> '.format_date($ul_mov_exp_mod['fecha']); ?> en <b><?php echo utf8_encode($ul_mov_exp_mod['tramite']); }?></b><br />
<?php if(ifexist($modificacion['resolucion_numero'])){ echo 'Resolucion N° '.$modificacion['resolucion_numero'];}
if($modificacion['resolucion_fecha'] != NULL){ echo ' el '.$modificacion['resolucion_fecha'];} ?><br />
<?php if(ifexist($modificacion['estado'])){ ?>
<b>Estado:</b> 
<?php if($modificacion['estado'] == 0){ echo 'Sin definir';} 
if($modificacion['estado'] == 1){ echo 'Confeccion Inspeccion';}
if($modificacion['estado'] == 2){ echo 'Revision Dpto. II Obras por contrato';}
if($modificacion['estado'] == 3){ echo 'Autorizando Ing. Jefe';}
if($modificacion['estado'] == 4){ echo 'Encuadre Legal';}
if($modificacion['estado'] == 5){ echo 'Imputacion del gasto';}
if($modificacion['estado'] == 6){ echo 'Confeccionando resolucion';}
if($modificacion['estado'] == 7){ echo 'Resolucion aprobada';} ?><br />
<b>Avance del tramite:</b> <?php if(!empty($modificacion['estado'])){ echo round($modificacion['estado']*100/7). ' %';}else{ echo '0 %';} ?><br />
<?php } ?>
<b>Monto de mayor gasto:</b> <?php echo '$ '.numero($modificacion['monto']);  ?> <br />
<b>Monto final:</b> <?php echo '$ '.numero($modificacion['monto_final']);  ?><br />
<?php if(ifexist($modificacion['descripcion'])){ ?>
<b>Descripcion de modificacion</b><br />
<?php echo $modificacion['descripcion']; } ?>
</div>
</div>
</div>
<?php endforeach; } ?>
<?php if(isset($ampliaciones_de_obra)){
foreach($ampliaciones_de_obra as $ampliacion): 
 if(ifexist($ampliacion['expediente'])){  $ul_mov_exp_amp = ul_mov_exp($ampliacion['expediente']);} ?>
<div class="form-group">
<div class="row">
<div class="col-12">
      <center>
    <b>
      <h4><?php echo $ampliacion['numero'].'° Ampliacion'; ?></h4>
    </b>
  </center>
<?php echo '<b>Expediente N°</b> '.$ampliacion['expediente'].'<br />'; ?>
<?php if(ifexist($ampliacion['expediente'])){ echo '<b>Ubicacion del tramite:</b> '.format_date($ul_mov_exp_amp['fecha']); ?> en <b><?php echo utf8_encode($ul_mov_exp_amp['tramite']); }?></b><br />
<?php if(ifexist($ampliacion['resolucion_numero'])){ echo 'Resolucion N° '.$ampliacion['resolucion_numero'];}
if($ampliacion['resolucion_fecha'] != NULL){ echo ' el '.$ampliacion['resolucion_fecha'];} ?><br />
<?php if(ifexist($ampliacion['estado'])){ ?>
<b>Estado:</b> 
<?php if($ampliacion['estado'] == 0){ echo 'Sin definir';} 
if($ampliacion['estado'] == 1){ echo 'Confeccion Inspeccion';}
if($ampliacion['estado'] == 2){ echo 'Revision Dpto. II Obras por contrato';}
if($ampliacion['estado'] == 3){ echo 'Autorizando Ing. Jefe';}
if($ampliacion['estado'] == 4){ echo 'Encuadre Legal';}
if($ampliacion['estado'] == 5){ echo 'Imputacion del gasto';}
if($ampliacion['estado'] == 6){ echo 'Confeccionando resolucion';}
if($ampliacion['estado'] == 7){ echo 'Resolucion aprobada';} ?><br />
<b>Avance del tramite:</b> <?php if(!empty($ampliacion['estado'])){ echo round($ampliacion['estado']*100/7). ' %';}else{ echo '0 %';} ?><br />
<?php } ?>
<?php if(!empty($ampliacion['plazo'])){ ?><b>Plazo a tramitar:</b> <?php echo $ampliacion['plazo'];  ?> <br /><?php } ?>
<?php if(!empty($ampliacion['plazo_final'])){ ?><b>Plazo final:</b> <?php echo $ampliacion['plazo_final'];  ?><br /><?php } ?>
<?php if(ifexist($ampliacion['descripcion'])){ ?>
<b>Descripcion de la ampliacion</b><br />
<?php echo textarea($ampliacion['descripcion']); } ?>
</div>
</div>
</div>
<?php endforeach; } ?>



<?php if(isset($neutralizaciones_de_obra)){
foreach($neutralizaciones_de_obra as $neutralizacion):
 if(ifexist($neutralizacion['expediente'])){  $ul_mov_exp = ul_mov_exp($neutralizacion['expediente']); } ?>
<div class="form-group">
<div class="row">
<div class="col-12">
    <center>
    <b>
      <h4><?php echo $neutralizacion['numero'].'° Neutralizacion'; ?></h4>
    </b>
  </center>
<?php echo '<b>Expediente N°</b> '.$neutralizacion['expediente'].'<br />'; ?>
<?php if(ifexist($neutralizacion['expediente'])){ echo '<b>Ubicacion del tramite:</b> '.format_date($ul_mov_exp['fecha']); ?> en <b><?php echo utf8_encode($ul_mov_exp['tramite']); }?></b><br />
<?php if(ifexist($neutralizacion['resolucion_numero'])){ echo 'Resolucion N° '.$neutralizacion['resolucion_numero'];}
if($neutralizacion['resolucion_fecha'] != NULL){ echo ' el '.$neutralizacion['resolucion_fecha'];} ?><br />
<?php if(ifexist($neutralizacion['estado'])){ ?>
<b>Estado:</b> 
<?php if($neutralizacion['estado'] == 0){ echo 'Sin definir';} 
if($neutralizacion['estado'] == 1){ echo 'Confeccion Inspeccion';}
if($neutralizacion['estado'] == 2){ echo 'Revision Dpto. II Obras por contrato';}
if($neutralizacion['estado'] == 3){ echo 'Autorizando Ing. Jefe';}
if($neutralizacion['estado'] == 4){ echo 'Encuadre Legal';}
if($neutralizacion['estado'] == 5){ echo 'Imputacion del gasto';}
if($neutralizacion['estado'] == 6){ echo 'Confeccionando resolucion';}
if($neutralizacion['estado'] == 7){ echo 'Resolucion aprobada';} ?><br />
<b>Avance del tramite:</b> <?php if(!empty($neutralizacion['estado'])){ echo round($neutralizacion['estado']*100/7). ' %';}else{ echo '0 %';} ?><br />
<?php } ?>

<?php if(!empty($neutralizacion['fecha_inicio'])){ ?><b>Fecha de neutralizacion:</b> <?php echo format_date($neutralizacion['fecha_inicio']);  ?> <br /><?php } ?>
<?php if(!empty($neutralizacion['fecha_reinicio'])){ ?><b>Fecha de reinicio de obra:</b> <?php echo format_date($neutralizacion['fecha_reinicio']);  ?><br /><?php } ?>

<?php if(ifexist($neutralizacion['descripcion'])){ ?>
<b>Descripcion de la neutralizacion</b><br />
<?php echo textarea($neutralizacion['descripcion']); } ?>
</div>
</div>
</div>
<?php endforeach; } ?> 



<?php if(!empty($recepcion_obra)){
foreach($recepcion_obra as $rp): ?>
<div class="form-group">
<div class="row">
<div class="col-12">
    <center>
    <b>
      <h4>Recepcion <?php 
if($rp['tipo'] == 'rp'){
echo 'Provisoria'; 
}elseif($rp['tipo'] == 'rd'){ 
echo 'Definitiva'; 
} ?></h4>
    </b>
  </center><u>Nº expediente:</u> <?php echo $rp['idexpedientes']; ?><br/>

<u>Integrantes de comision:</u> <?php 
if(!empty($rp['comision_agente1'])){ echo $rp['comision_agente1'].', ';} 
if(!empty($rp['comision_agente2'])){ echo $rp['comision_agente2'].', ';} 
if(!empty($rp['comision_agente3'])){ echo $rp['comision_agente3']; } ?>
<br/>
<u>Informe/Acta:</u> 
<?php 
if($rp['recibido_estado'] == NULL){ echo 'Sin definir<br/>'; }
if($rp['recibido_estado'] === '0'){ echo 'Sin recibir<br/>'; }
if($rp['recibido_estado'] === '1'){ echo 'Recibido<br/>'; } ?>
<?php if(!empty($rp['acta_resolucion'])){ echo '<u>Resolucion:</u> '.$rp['acta_resolucion'].'<br/>'; } ?>
<?php if(!empty($rp['acta_fecha'])){ echo '<u>Fecha de aprobacion:</u> '.ifdate($rp['acta_fecha']).'<br/>'; } ?>
<?php if(!empty($rp['observaciones'])){ echo '<u>Observaciones:</u><br/>'.textarea($rp['observaciones']); } ?>
</p>
</div>
</div></div>
                                <?php endforeach; } ?> 
