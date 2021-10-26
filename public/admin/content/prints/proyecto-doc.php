<?php
$id=$_GET['id'];
$results = '';
require_once('../../includes/load.php');
$proyecto = find_by_id('obras','idobras',$id);  
cabecera_print_vertical_doc(clean($proyecto['nombre']));
?>
<div class="row">
<div class="col-md-12">
  <center>
    <b>
      <h4>Informe de Proyecto</h4>
    </b>
  </center>

<br>
<b>Obra:</b> <?php echo $proyecto['nombre']; ?><br />
<?php if(!empty($proyecto['descripcion'])){ echo '<b>Descripcion:</b> '.$proyecto['descripcion'];} ?><br />
<?php if(!empty($proyecto['ubicacion'])){ echo '<b>Departamento:</b> '.$proyecto['ubicacion'];} ?><br />
<?php if(!empty($proyecto['longitud'])){ echo '<b>Longitud:</b> '.$proyecto['longitud'].' metros.<br />';} ?>
<b>Nº Expediente:</b> <?php echo $proyecto['expediente']; ?><br />  
<b>Estado del tramite:</b> <?php if(!isset($proyecto['tramite']) || $proyecto['tramite'] == 0){ echo 'No establecido';} 
                  if($proyecto['tramite'] == 1){ echo 'Relevando y confeccionando proyecto y pliegos';}
                  if($proyecto['tramite'] == 2){ echo 'Autorizando proyecto';}
                  if($proyecto['tramite'] == 3){ echo 'Visando pliegos (Encuadre legal)';}
                  if($proyecto['tramite'] == 4){ echo 'Reserva preventiva';}
                  if($proyecto['tramite'] == 5){ echo 'Tomado conocimiento';}
                  if($proyecto['tramite'] == 6){ echo 'Conf. proyecto de resolución llamado / Desig. Comision de est. / Aprobado de res.';}
                  if($proyecto['tramite'] == 7){ echo 'Cursado de invitacion y plazo de preparacion de ofertas';}
                  if($proyecto['tramite'] == 8){ echo 'Apertura de ofertas y armado de expediente';}
                  if($proyecto['tramite'] == 9){ echo 'Desglasando la garantia de oferta';}
                  if($proyecto['tramite'] == 10){ echo 'Designacion comision de estudio y resolucion';}
                  if($proyecto['tramite'] == 11){ echo 'Aprob. Res. de designacion';}
                  if($proyecto['tramite'] == 12){ echo 'Comision de estudios';}
                  if($proyecto['tramite'] == 13){ echo 'Reserva definitiva';}
                  if($proyecto['tramite'] == 14){ echo 'Confeccionando proyecto de resolucion de adjudicacion y aprobacion';}
                  if($proyecto['tramite'] == 15){ echo 'Notificacion al adjudicatario';}
                  if($proyecto['tramite'] == 16){ echo 'Solicitando gtia. contractual, notif. de perdedores, devol. de gtia.';}
                  if($proyecto['tramite'] == 17){ echo 'Redactando contrato';}
                  if($proyecto['tramite'] == 18){ echo 'Sellando contrato';}
                  if($proyecto['tramite'] == 19){ echo 'Designando inspeccion / Confeccion acta de inicio';}
                  if($proyecto['tramite'] == 20){ echo 'En ejecucion';}
                  ?><br />
<b>Avance del tramite:</b> <?php echo $proyecto['tramite']*100/20; ?> %
<br>
<?php if(!empty($proyecto['proyecto_monto'])){ echo '<b>Presupuesto oficial:</b> $ '.numero($proyecto['proyecto_monto']);} ?> <?php if(!empty($proyecto['proyecto_monto_fecha'])){ echo '('.$proyecto['proyecto_monto_fecha'].')'; } ?><br />
<?php if(!empty($proyecto['proyecto_plazo'])){ echo '<b>Plazo de obra:</b> '.$proyecto['proyecto_plazo'];} ?><br />
<?php if($proyecto['idtipo'] == 0){ ?>
<?php if(!empty($proyecto['plazo_garantia'])){ echo '<b>Plazo de garantia:</b> '.$proyecto['plazo_garantia'];} ?><br />
<?php } ?>

<?php if($proyecto['idtipo'] == 0){ ?>
<br>
<?php if($proyecto['aprobacion_res_fecha'] != '0000-00-00'){ echo '<b>Aprobacion de proyecto:</b> '.format_date($proyecto['aprobacion_res_fecha']); }else{'';} ?> <?php if(!empty($proyecto['aprobacion_res_num'])){ echo 'por Res. Nº'.$proyecto['aprobacion_res_num']; } else{echo '';} ?><br />
<?php if($proyecto['adjudicacion_res_fecha'] != '0000-00-00'){ echo '<b>Adjudicacion a empresa:</b> '.format_date($proyecto['adjudicacion_res_fecha']); }else{'';} ?> <?php if(!empty($proyecto['adjudicacion_res_num'])){ echo 'por Res. Nº'.$proyecto['adjudicacion_res_num'];} else{echo '';} ?><br />
<?php if(!empty($proyecto['tipo_contratacion'])){ echo '<b>Tipo de contratacion:</b> '.$proyecto['tipo_contratacion'];} ?><br />
<?php if(!empty($proyecto['tipo_financiamiento'])){  echo '<b>Financiacion:</b> '.$proyecto['tipo_financiamiento'];} ?><br />
<br>
<?php if(!empty($proyecto['contratista'])){ echo '<b>Contratista:</b> '.$proyecto['contratista'];} ?><br />
<?php if($proyecto['contrato_fecha'] != '0000-00-00'){ echo '<b>Firma del contrato:</b> '.format_date($proyecto['contrato_fecha']); } else { echo ''; } ?><br />
<?php if($proyecto['fecha_inicio'] != '0000-00-00'){ echo '<b>Acta de inicio de obra:</b> '.format_date($proyecto['fecha_inicio']); } else { echo ''; } ?><br />

<br>
<?php if(!empty($proyecto['contrato_monto'])){ echo '<b>Monto de contrato:</b> $ '.numero($proyecto['contrato_monto']);} ?><br />
<?php if(!empty($proyecto['contrato_plazo'])){ echo '<b>Plazo oficial:</b> '.$proyecto['contrato_plazo'];} ?><br />
<br>
<?php } ?>
<?php if(!empty($proyecto['observaciones'])){ echo '<b>Observaciones:</b><br> '.textarea($proyecto['observaciones']);} ?>
<br>
<?php if(!empty($proyecto['memoria_descriptiva'])){ echo '<b>Memoria descriptiva:</b><br />'.textarea($proyecto['memoria_descriptiva']);} ?>
  
</div>
</div>
</body>
</html>