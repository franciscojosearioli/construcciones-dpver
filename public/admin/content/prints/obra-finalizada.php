<?php
$id=$_GET['id'];
$results = '';
require_once('../../includes/load.php');
$obra = find_by_id('obras','idobras',$id);  
$obra_bacheo = obra_bacheo($id);
$modificaciones_de_obra =  modificaciones_de_obra($id);
$ampliaciones_de_obra =  ampliaciones_de_obra($id);
$neutralizaciones_de_obra =  neutralizaciones_de_obra($id);
cabecera_print_vertical('Informe de Obra');
 ?>

<!-- OBRA FINALIZADA -->


<div class="row">
<div class="col-md-12">
  <center>
    <b>
      <h4>Informe de obra: Finalizada</h4>
    </b>
  </center>
</div>
<br>
<div class="col-md-12">
<b>Obra:</b> <?php echo $obra['nombre']; ?><br />
<b>Descripcion:</b> <?php echo $obra['descripcion']; ?><br />
<b>Departamento:</b> <?php echo $obra['ubicacion']; ?><br />
<b>Longitud:</b> <?php if(!empty($obra['longitud'])){echo $obra['longitud'].' metros.';} else { echo ''; } ?><br />
<b>Fecha de inicio:</b> <?php echo format_date($obra['fecha_inicio']); ?><br />
<b>Fecha de contrato:</b> <?php echo format_date($obra['contrato_fecha']); ?><br />
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


<?php if(!empty($obra['plazo_garantia'])){ ?><b>Plazo de garantia:</b> <?php echo $obra['plazo_garantia']; ?><br /><?php } ?>
</div>
</div>
<br>

<div class="row">
<div class="col-md-12">
  <b>Memoria descriptiva:</b><br />
<?php echo textarea($obra['memoria_descriptiva_vigente']); ?>
</div>
</div>





</body>
</html>