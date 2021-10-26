<?php 
require_once('../../includes/load.php');
$obra_id = $_POST['obra_id'];
$obra = find_by_id('obras','idobras',$_POST['obra_id']);
    $modificaciones_obra =  modificaciones_de_obra($obra['idobras']);
    $ampliaciones_obra =  ampliaciones_de_obra($obra['idobras']);
    $neutralizaciones_obra =  neutralizaciones_de_obra($obra['idobras']);
    $recepciones_obra =  recepciones_obra($obra['nombre']);
    
$certificados = certificados_obras($obra_id);
$certificados_plan = plan_oficial_obras($obra_id);
$certificados_adec = certificados_redeterminados_obras($obra_id);
$certificados_multa = plan_oficial_obras($obra_id);
$mysqli = new mysqli('localhost', 'construcciones', 'm5WAuKDydqRKssAj', 'sac');
if(!$mysqli){  die("Connection failed: " . $mysqli->error);}

$query = sprintf("SELECT porcen_ejecutado FROM certificados_obras WHERE idobras = '{$obra_id}' AND estado =2 AND porcen_ejecutado > 0 ORDER BY idcertificados_obras ASC");
$result = $mysqli->query($query);

$query2 = sprintf("SELECT avance FROM obras_planoficial WHERE idobras = '{$obra_id}' AND idplanes_de_trabajo = '{$obra['idplanes_de_trabajo']}' AND avance > 0 ORDER BY idobras_planoficial ASC");
$result2 = $mysqli->query($query2);

$query3 = sprintf("SELECT numero FROM obras_planoficial WHERE idobras = '{$obra_id}' AND idplanes_de_trabajo = '{$obra['idplanes_de_trabajo']}' AND numero > 0 GROUP BY numero ORDER BY idobras_planoficial ASC");
$result3 = $mysqli->query($query3);

$numero = array();
$numero[] = 0;
$fecha = array();
$avanceplan = array();
$avanceplan[] = 0;
$avance = array();
$avance[] = 0;

while ($row = mysqli_fetch_array($result)){$avance[] = $row['porcen_ejecutado'];}
if (isset($numero)){while ($row = mysqli_fetch_array($result3)){$numero[] = $row['numero'];}}
if (isset($avanceplan)){while ($row = mysqli_fetch_array($result2)){$avanceplan[] = $row['avance'];}}
$result->close();
$result2->close();
$result3->close();
$mysqli->close();
    
?>
<div class="row justify-content-center" id="flujo-obra">
<div class="col-lg-12 col-md-12">

<div class="row justify-content-center">
<div class="col-10">
<div class="d-flex flex-wrap"><div class="ml-auto"><ul class="list-inline"><li><h6 class="text-muted"><a onclick="cancelar_ver()" class="dropdown-item a-icon" data-toggle="tooltip" title="Cancelar"><i class="fas fa-times fa-2x"></i> Cerrar</a></h6></li></ul></div></div>
</div>
</div>

<div class="row justify-content-center">
<div class="col-10">
<span class="titulo-bienvenida">Informe de Obra</span><br><br>
<div class="card">
<div class="card-body mx-4">
<div class="p-3">
<label class="control-label text-muted" style="font-size:12px;">Titulo de obra</label>
<h3><?php echo $obra['nombre']; ?></h3>
</div>
<div class="d-flex flex-row">
  <div class="p-3">
  <label class="control-label text-muted" style="font-size:12px;">Caja</label>
  <h3><?php echo $obra['numero']; ?></h3>
  </div>
  <div class="p-3">
  <label class="control-label text-muted" style="font-size:12px;">Expediente</label>
<h3><?php echo $obra['expediente']; ?></h3>
</div>
  <div class="p-3">
  <label class="control-label text-muted" style="font-size:12px;">Estado</label>
  <h3><?php 
                      if($obra['estado'] == 0){ echo 'En ejecucion'; }
                      if($obra['estado'] == 3 && $obra['finalizado'] == 0){ echo 'Finalizada sin recibir'; }
                      if($obra['estado'] == 3 && $obra['finalizado'] == 1){ echo 'Finalizada en garantia'; }
                      if($obra['estado'] == 3 && $obra['finalizado'] == 2){ echo 'Finalizada definitiva'; }
                      if($obra['estado'] == 4){ echo 'Neutralizada'; }
                      if($obra['estado'] == 5){ echo 'Rescindida'; } ?></h3>
  </div>
    <div class="p-3">
  <label class="control-label text-muted" style="font-size:12px;">Contratista</label>
  <h3><?php echo $obra['contratista']; ?></h3>
  </div>
    <div class="p-3">
  <label class="control-label text-muted" style="font-size:12px;">Inspector</label>
  <h3><?php echo inspector_name($obra['idinspector']); ?></h3>
  </div>
</div>

<div class="d-flex flex-row">
  <div class="p-3">
  <label class="control-label text-muted" style="font-size:12px;">Inicio de obra</label>
  <h3><?php echo format_date($obra['fecha_inicio']); ?></h3>
  </div>
  <div class="p-3">
  <label class="control-label text-muted" style="font-size:12px;">Plazo de ejecucion</label>
<h3><?php echo $obra['proyecto_plazo'];  ?></h3>
</div>
  <div class="p-3">
  <label class="control-label text-muted" style="font-size:12px;">Ultimo Plazo aprobado</label>
<h3><?php echo $obra['plazo_vigente'];  ?></h3>
</div>
</div>
<div class="d-flex flex-row">
  <div class="p-3">
  <label class="control-label text-muted" style="font-size:12px;">Monto de contrato</label>
<h3><?php if($obra['contrato_monto'] != NULL){ echo '$ '.numero($obra['contrato_monto']); } ?></h3>
</div>
  <div class="p-3">
  <label class="control-label text-muted" style="font-size:12px;">Monto modificado</label>
<h3><?php if($obra['monto_vigente'] != NULL){ echo '$ '.numero($obra['monto_vigente']); } ?></h3>
</div>
  <div class="p-3">
  <label class="control-label text-muted" style="font-size:12px;">Monto redeterminado</label>
<h3><?php if($obra['monto_redeterminado'] != NULL){ echo '$ '.numero($obra['monto_redeterminado']); } ?></h3>
</div>
  <div class="p-3">
  <label class="control-label text-muted" style="font-size:12px;">Acta de redeterminacion de precios</label>
<h3><?php echo $obra['info_redeterminacion']; ?></h3>
</div>
</div>
</div>
</div>
<span class="titulo-bienvenida">Inversion de obra</span><br>

<div class="row p-20">

<div class="col-lg-3">
<div class="card">
<div class="card-body mx-4"> 
<label class="control-label text-muted" style="font-size:12px;">Monto de contrato vigente a precios base </label>
<p><?php if(!empty($obra['monto_vigente'])){ echo '$ '.numero($obra['monto_vigente']); } else { echo "No hay datos"; } ?></p>
<label class="control-label text-muted" style="font-size:12px;">Monto de contrato vigente a precios redeterminados </label>
<p><?php if(!empty($obra['monto_redeterminado'])){ echo '$ '.numero($obra['monto_redeterminado']); } else { echo "No hay datos"; } ?></p>
<label class="control-label text-muted" style="font-size:12px;">Plazo de obra actualizado</label>
<p><?php echo $obra['plazo_vigente']; ?></p>
<label class="control-label text-muted" style="font-size:12px;">Detalles de redeterminacion</label>
<p><?php echo $obra['info_redeterminacion']; ?></p>
</div>
</div>
</div>

<div class="col-lg-6">
  <div class="card">
<div class="card-body mx-4">


<div class="table-responsive">
<canvas id="curva" width="100%" height="40%"></canvas>
</div>
</div>
</div>
</div>

</div>

<?php if(!empty($modificaciones_obra)){ ?> 
<span class="titulo-bienvenida">Modificaciones</span><br>
<div class="d-flex flex-row">
<?php foreach($modificaciones_obra as $m): ?>
  <div class="p-3">
  <div class="card">
<div class="card-body mx-4">
<h3><?php echo $m['numero']; ?> Modificacion</h3>
<label class="control-label text-muted" style="font-size:12px;">Expediente</label>
<h3><?php echo $m['expediente']; ?></h3>
<label class="control-label text-muted" style="font-size:12px;">Monto vigente</label>
<h3><?php if($m['monto_final'] != NULL){ echo '$ '.numero($m['monto_final']); } ?></h3>
</div>
</div>
</div>
<?php endforeach; ?>
</div>
<?php } ?>
<?php if(!empty($ampliaciones_obra)){ ?> 
<span class="titulo-bienvenida">Ampliaciones</span><br>
<div class="d-flex flex-row">
<?php foreach($ampliaciones_obra as $a): ?>
  <div class="p-3">
  <div class="card">
<div class="card-body mx-4">
<h3><?php echo $a['numero']; ?> Ampliacion</h3>
<label class="control-label text-muted" style="font-size:12px;">Expediente</label>
<h3><?php echo $a['expediente']; ?></h3>
<label class="control-label text-muted" style="font-size:12px;">Plazo vigente</label>
<h3><?php if($a['plazo_final'] != NULL){ echo $a['plazo_final']; } ?></h3>
</div>
</div>
</div>
<?php endforeach; ?>
</div>
<?php } ?>
<?php if(!empty($neutralizaciones_obra)){ ?> 
<span class="titulo-bienvenida">Neutralizaciones</span><br>
<div class="d-flex flex-row">
<?php foreach($neutralizaciones_obra as $n): ?>
  <div class="p-3">
  <div class="card">
<div class="card-body mx-4">
<h3><?php echo $n['numero']; ?> Neutralizacion</h3>
<label class="control-label text-muted" style="font-size:12px;">Expediente</label>
<h3><?php echo $n['expediente']; ?></h3>
<?php if($n['observaciones']){ ?>
<label class="control-label text-muted" style="font-size:12px;">Observacion</label>
<h3><?php echo textarea($n['observaciones']);  ?></h3>
  <?php } ?>
</div>
</div>
</div>
<?php endforeach; ?>
</div>
<?php } ?>








<?php if(!empty($recepciones_obra)){ ?> 
<span class="titulo-bienvenida">Recepciones</span><br>
<div class="d-flex flex-row">
<?php foreach($recepciones_obra as $r): ?>
  <div class="p-3">
  <div class="card">
<div class="card-body mx-4">
<h3>Recepcion <?php if($r['tipo'] = 'rp'){ echo 'Provisoria';}elseif($r['tipo'] = 'rd'){ echo 'Definitiva'; } ?></h3>
<label class="control-label text-muted" style="font-size:12px;">Expediente</label>
<h3><?php echo $r['idexpedientes']; ?></h3>
</div>
</div>
</div>
<?php endforeach; ?>
</div>
<?php } ?>



<?php
$multa = array();
$multa[] = 0;
foreach ($certificados_multa as $c_mul):
  $multa[] = ($c_mul['avance'] * $obra['valormulta']);
endforeach;
?>
<script>
  var ctx = document.getElementById('curva');var chart = new Chart(ctx, {type: 'line',data: {labels: <?php print json_encode($numero); ?>,datasets: [{label: "Certificados",fill:false,lineTension: 0,borderColor: 'rgb(249, 113, 113)',data: <?php print json_encode($avance); ?>,},{label: "Plan oficial",fill:false,lineTension: 0,borderColor: 'rgb(124, 213, 254)',data: <?php print json_encode($avanceplan); ?>,},{label: "Multa",fill:false,borderDash: [5,5],lineTension: 0,borderColor: 'rgb(216, 202, 215)',data: <?php print json_encode($multa); ?>,}]},options: {scales: {xAxes: [{ticks: {beginAtZero:true,suggestedMin:0}}],yAxes: [{ticks: {beginAtZero:true,min:0,max: 100}}]},tooltips: {enabled: true,mode: 'single',callbacks: {title: function (tooltipItem, data) {return "Certificado Nº " + data.labels[tooltipItem[0].index];},label: function(tooltipItems, data) {return "Avance: " + tooltipItems.yLabel + ' %';},footer: function (tooltipItem, data) { return ""; }}}}});
</script>


</div>
</div>
</div>



</div>
</div>
</div>

</div>
</div>
