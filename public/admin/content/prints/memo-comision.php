<?php
$id=$_GET['id'];
$results = '';
require_once('../../includes/load.php');
$memorandum = find_by_id('memorandums','idmemorandums',$id);  

$agentes = find_by_id('memorandums_agentes','idmemorandums',$id);  
cabecera_print_memo(clean($memorandum['titulo']));
?>

<div class="row">
<div class="col-md-12">
<table class="table" >
<tbody>
  <tr>
    <td style="border:2px solid #000000;width:50%">Para informacion de <br /><br /> <b><?php echo find_select('nombre','departamentos','iddepartamentos',$memorandum["receptor"]); ?></b></td>
    <td style="border:2px solid #000000;width:50%">Producido por<br /><br /> <b><?php echo find_select('nombre','direcciones','iddireccion',$memorandum["emisor"]); ?></b> <br /><br />Paraná, <?php echo format_date_memorandum(date("d-m-Y")); ?></td>
</tr>
</tbody>
</table>
</div>
</div>
<?php if($memorandum['dias'] == NULL){ if($memorandum["fecha_inicio"] == $memorandum["fecha_fin"]){ ?>
<div class="row">
<div class="col-12" style="text-align: justify"><br/>
<span style="padding-left:150px">Por el presente se justifica que <?php $agentes_comision = obtener_user_memo($id); $cantidad_agentes = count($agentes_comision); if($cantidad_agentes <= 1){ ?>el Agente<?php }else{ ?>los Agentes<?php } ?></span> <?php foreach($agentes_comision as $ag){ echo user_nya($ag['agente']).', '; } if($cantidad_agentes <= 1){ ?>permanecerá<?php }else{ ?>permanecerán<?php } ?> en COMISION DE SERVICIOS el dia de la fecha, debiendole computar las horas correspondientes al adicional por Dedicacion Intensiva. 
<?php }else{ ?>
<div class="row">
<div class="col-12" style="text-align: justify"><br/>
<span style="padding-left:150px">Por el presente se justifica que <?php $agentes_comision = obtener_user_memo($id); $cantidad_agentes = count($agentes_comision); if($cantidad_agentes <= 1){ ?>el Agente<?php }else{ ?>los Agentes<?php } ?></span> <?php foreach($agentes_comision as $ag){ echo user_nya($ag['agente']).', '; } if($cantidad_agentes <= 1){ ?>permanecerá<?php }else{ ?>permanecerán<?php } ?> en COMISION DE SERVICIOS los dias comprendidos entre las fecha desde <?php echo date_memorandums($memorandum["fecha_inicio"]); ?> hasta <?php echo date_memorandums($memorandum["fecha_fin"]); ?>, debiendole computar las horas correspondientes al adicional por Dedicacion Intensiva. 
<?php } }else{ if($memorandum['dias'] == 1){ ?>  
<div class="row">
<div class="col-12" style="text-align: justify"><br/>
<span style="padding-left:150px">Por el presente se justifica que <?php $agentes_comision = obtener_user_memo($id); $cantidad_agentes = count($agentes_comision); if($cantidad_agentes <= 1){ ?>el Agente<?php }else{ ?>los Agentes<?php } ?></span> <?php foreach($agentes_comision as $ag){ echo user_nya($ag['agente']).', '; } if($cantidad_agentes <= 1){ ?>permanecerá<?php }else{ ?>permanecerán<?php } ?> en COMISION DE SERVICIOS el dia de la fecha, debiendole computar las horas correspondientes al adicional por Dedicacion Intensiva. 
<?php } if($memorandum['dias'] != 1){ ?>
<div class="row">
<div class="col-12" style="text-align: justify"><br/>
<span style="padding-left:150px">Por el presente se justifica que <?php $agentes_comision = obtener_user_memo($id); $cantidad_agentes = count($agentes_comision); if($cantidad_agentes <= 1){ ?>el Agente<?php }else{ ?>los Agentes<?php } ?></span> <?php foreach($agentes_comision as $ag){ echo user_nya($ag['agente']).', '; } if($cantidad_agentes <= 1){ ?>permanecerá<?php }else{ ?>permanecerán<?php } ?> en COMISION DE SERVICIOS los dias comprendidos entre las fecha desde <?php echo date_memorandums($memorandum["fecha_inicio"]); ?> hasta <?php $fecha_result = date("d-m-Y",strtotime($memorandum["fecha_inicio"]."- 1 days")); $fecha_result2 = date("d-m-Y",strtotime($fecha_result."+ ".$memorandum["dias"]." days")); echo date_memorandums($fecha_result2); ?>, debiendole computar las horas correspondientes al adicional por Dedicacion Intensiva. 
<?php } ?>
<?php } ?>
</div>
</div>

