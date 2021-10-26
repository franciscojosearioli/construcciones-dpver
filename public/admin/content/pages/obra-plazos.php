<?php
require_once('../../includes/load.php');
$obra_id=$_GET['id'];
$user = current_user();
$obra = find_by_id('obras','idobras',(int)$_GET['id']);  
if($obra['estado'] == 1){ redirect('proyecto?id='.$obra_id, false); }
require_once('../../includes/functions/obras.php');  
require_once('../../../uploads/files.php'); 
$ejecutados = all_oyp();
$certificados = certificados_obras($obra_id);
$ordenes = ordenes_de_servicio($obra_id);
$notas = notas_de_pedido($obra_id);
$all_user = all_usuarios();
$obra_bacheo = obra_bacheo($obra_id);
$inspeccion_informe = informes_inspeccion($obra_id);   
$inspeccion_asistencia = asistencias_inspeccion($obra_id);  
$inspectores = all_inspectores();
$obra_timeline = obra_timeline($obra_id);
foreach($ejecutados as $obra):
  if($obra['idobras'] == $obra_id){
    $modificaciones_de_obra =  modificaciones_de_obra($obra['idobras']);
    $ampliaciones_de_obra =  ampliaciones_de_obra($obra['idobras']);
    $neutralizaciones_de_obra =  neutralizaciones_de_obra($obra['idobras']);
    ?>
<div class="p-20" >
<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12">
<div class="card">
<div class="card-body p-t-30">
        <div class="p-20">
        

<style>
.grid-container {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
  grid-gap: 5px;
  justify-items: left;
  align-items: initial;
}

.grid-item1 {
  background: #7eff7e;
  text-align: center;
  border: #bfbfbf 3px solid;
  width: 150px;
  height: 100px;
}


</style>

<!--contar cantidad de modificaciones y ordenar segun el numero de mayor a menor
contar amplaciones
contar neutralizaciones
contrar modificaciones de planes de trabajo-->

<p>Monto vigente: <?php echo '$ '.numero($obra['monto_vigente']); ?></p>
<p>plazo vigente: <?php echo $obra['plazo_vigente']; ?></p>
<table>
<thead></thead>
<tbody>
<tr>
<td>
<div class="grid-container">
  <div class="grid-item1"><div>Inicio de obra</div><br>
  <?php echo '$ '.numero($obra['contrato_monto']); ?><br>
  <?php echo $obra['proyecto_plazo']; ?>  
  </div>
</td>
</tr>

</tbody>
</table>
</div>












        </div>
      </div>
    </div>
  </div>
</div>
</div>










<?php 
} endforeach;
?>
