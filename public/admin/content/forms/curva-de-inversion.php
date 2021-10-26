<?php 
require_once('../../includes/load.php');
$obra_id = $_POST['obra_id'];
$obra = find_by_id('obras','idobras',$_POST['obra_id']);
    $modificaciones_obra =  modificaciones_de_obra($obra['idobras']);
    $ampliaciones_obra =  ampliaciones_de_obra($obra['idobras']);
    $neutralizaciones_obra =  neutralizaciones_de_obra($obra['idobras']);
    $recepciones_obra =  recepciones_obra($obra['nombre']);
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


<div class="row justify-content-center" id="curva-de-inversion">
<div class="col-10">
<div class="d-flex flex-wrap">
    <span class="titulo-bienvenida">Curva de inversion</span><div class="ml-auto"><ul class="list-inline"><li><h6 class="text-muted"><a onclick="cancelar_ver()" class="dropdown-item a-icon" data-toggle="tooltip" title="Cancelar"><i class="fas fa-times fa-2x"></i> Cerrar</a></h6></li></ul></div>
</div>

<div class="card">
<div class="card-body mx-4">
<h3><?php echo $obra['nombre']; ?></h3>
<p><a href="content/prints/curva-inversion.php?id=<?php echo $obra_id;?>" style="padding-top: 20px;" target="_blank">Imprimir curva de inversion</a></p>
<div class="table-responsive">
<canvas id="curva" width="100%" height="40%"></canvas>
</div>
</div>
</div>
</div>



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










