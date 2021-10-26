<?php
$id=$_GET['id'];
$results = '';
require_once('../../../../includes/load.php');
$obra = find_by_id('obras','idobras',$id);  
$obra_bacheo = obra_bacheo($id);
$modificaciones_de_obra =  modificaciones_de_obra($id);
$ampliaciones_de_obra =  ampliaciones_de_obra($id);
$neutralizaciones_de_obra =  neutralizaciones_de_obra($id);

$ejecutados = obras_construcciones($user['iddepartamentos']);
$fecha = make_date();
cabecera_print_vertical_doc('Informe_Ceremonial-'.$obra['idobras'].'-'.$fecha);
if($obra['estado'] == 1){ ?>
<!-- PROYECTO -->
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
<b>Descripcion:</b> <?php echo $obra['descripcion']; ?><br />
<b>Departamento:</b> <?php echo $obra['ubicacion']; ?><br />
<b>Longitud:</b> <?php if(!empty($obra['longitud'])){echo $obra['longitud'].' metros.';} else { echo ''; } ?><br />
</div>
</div>
<div class="row">
<div class="col-md-12">



<b>Plazo de garantia:</b> <?php echo $obra['plazo_garantia']; ?><br />
</div>
</div>
<br>


<div class="row">
<div class="col-md-12">
<div style="font-size: 16px;">
<u>Ultimo certificado aprobado</u><br/ >
<b>N°:</b> <?php echo $obra['plazo_garantia']; ?><br />

<b>Fecha:</b> <?php echo $obra['plazo_garantia']; ?><br />

<b>Porcentaje:</b> <?php echo $obra['plazo_garantia']; ?><br />

<b>Monto ejecutado:</b> <?php echo $obra['plazo_garantia']; ?><br />

<b>Plazo transcurrido:</b> <?php echo $obra['plazo_garantia']; ?><br />

</div>
</div>
</div>
<br>
<div class="col-md-12">
  <b>Memoria descriptiva:</b><br />
<?php echo textarea($obra['memoria_descriptiva']); ?>
</div>
<!-- PROYECTO -->
<?php }else{ 
 ?>
<!-- OBRA -->
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
<b>Descripcion:</b> <?php echo $obra['descripcion']; ?><br />
<b>Departamento:</b> <?php echo $obra['ubicacion']; ?><br />
<b>Longitud:</b> <?php if(!empty($obra['longitud'])){echo $obra['longitud'].' metros.';} else { echo ''; } ?><br />
<b>Estado:</b> 
<?php 
                  if($obra['estado'] == 6){ echo 'A Iniciar<br />'; }
if($obra['estado'] == 0){ echo 'En ejecucion <br />'; }
if($obra['estado'] == 3 && $obra['finalizado'] == 0){ echo 'Finalizada sin recibir<br />'; }
if($obra['estado'] == 3 && $obra['finalizado'] == 1){ echo 'Finalizada en garantia<br />'; }
if($obra['estado'] == 3 && $obra['finalizado'] == 2){ echo 'Finalizada definitiva<br />'; }
if($obra['estado'] == 4){ echo 'Neutralizada <br />'; }
if($obra['estado'] == 5){ echo 'Rescindida <br />'; } ?>
<b>Fecha de contrato:</b> <?php echo format_date($obra['contrato_fecha']); ?><br />
<b>Fecha de inicio de obra:</b> <?php echo format_date($obra['fecha_inicio']); ?><br />
<?php if($obra['fecha_fin'] != '0000-00-00'){  ?>
<b>Fecha de fin de obra:</b> <?php echo format_date($obra['fecha_fin']); ?><br />
<?php } ?>

</div>
</div>
<div class="row">
<div class="col-md-12">
<b>Contratista:</b> <?php echo $obra['contratista']; ?><br />
<b>Monto de contrato:</b> <?php echo '$ '.numero($obra['contrato_monto']); ?><br />
<b>Inversion total:</b> 
<?php if(!empty($obra['monto_redeterminado'])){ echo '$ '.numero($obra['monto_redeterminado']);} else { echo '$ '.numero($obra['contrato_monto']); } ?><br />
<b>Plazo de obra:</b> 


<?php if(!empty($obra['plazo_vigente'])){ echo $obra['plazo_vigente']; } else { echo $obra['contrato_plazo']; } ?><br />


<b>Plazo de garantia:</b> <?php echo $obra['plazo_garantia']; ?><br />
</div>
</div>
<br>
<?php if($obra['estado'] != 3 ){ ?>
<div class="row">
<div class="col-md-12">
<div style="font-size: 14px;">
<center><b>Ultimo certificado aprobado</b></center><br/ >
<b>N°:</b> <?php echo $obra['certificado_numero']; ?><br />

<b>Fecha:</b> <?php echo $obra['certificado_fecha']; ?><br />

<b>Porcentaje:</b> <?php if(!empty($obra['certificado_porcentaje'])){ echo $obra['certificado_porcentaje'].' %';}else{ echo '0 %'; } ?><br />

<b>Monto ejecutado:</b> <?php echo '$ '.numero($obra['certificado_monto']); ?><br />

<b>Plazo transcurrido:</b> <?php echo $obra['certificado_plazo']; ?><br />

</div>
</div>
</div>
<?php } ?><br/>
<div class="col-md-12">
<center><b>Memoria descriptiva:</b></center><br />
<?php echo textarea($obra['memoria_descriptiva_vigente']); ?>
</div>
<!-- OBRA -->
<?php } ?>
</body>
</html>