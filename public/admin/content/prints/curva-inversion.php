<?php 
$id=$_GET['id'];
require_once('../../includes/load.php');
$obra = find_by_id('obras','idobras',$id);  
$certificados = certificados_obras($id);
$certificados_plan = plan_oficial_obras($id);
$certificados_adec = certificados_redeterminados_obras($id);
$certificados_multa = plan_oficial_obras($id);
$mysqli = new mysqli('localhost', 'construcciones', 'm5WAuKDydqRKssAj', 'sac');
if(!$mysqli){  die("Connection failed: " . $mysqli->error);}

$query = sprintf("SELECT porcen_ejecutado FROM certificados_obras WHERE idobras = '{$id}' AND estado=2 AND porcen_ejecutado > 0 ORDER BY idcertificados_obras ASC");
$result = $mysqli->query($query);

$query2 = sprintf("SELECT avance FROM obras_planoficial WHERE idobras = '{$id}' AND avance > 0 ORDER BY idobras_planoficial ASC");
$result2 = $mysqli->query($query2);

$query3 = sprintf("SELECT numero FROM obras_planoficial WHERE idobras = '{$id}' AND numero > 0 GROUP BY numero ORDER BY idobras_planoficial ASC");
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
 <html lang="en-US">
 <head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="../../includes/assets/images/favicon.png" rel="shortcut icon" type="image/png">
    <title>Curva de Inversion</title>
    <link href="../../includes/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../includes/assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../../includes/assets/css/prints/horizontal-style.css" />   
    <link rel="stylesheet" href="../../includes/assets/css/prints/horizontal-print.css" media="print" />   
</head>
<body>
      <div class="hocultar">
        <div class="hocultarstyle"> 
            <div class="row">
              <div class="col-12">
                <center>
                  Este documento fue emitido desde el sistema administrativo de construcciones, la informacion esta sujetas a cambios colectivos.
                  <br>
                  <a onclick="window.print();">IMPRIMIR</a>
                </center>
    </div> 
    </div>
    </div>
    </div>
<div class="container">
  <div class="pagina">
<div class="header">
<div class="row p-20">
<div class="col-12">
      <div class="pull-left">
     <h4 style="font-size:100%;">
          <div class="pull-left m-r-10">
            <img src="../../includes/assets/images/logo-light-icon.png" >
          </div>
            <div class="pull-right"><b>DIRECCION PROVINCIAL DE VIALIDAD<br>DIRECCION DE CONSTRUCCIONES</b>
            </div>
          </h4>
      </div>
      <div class="pull-right"><br>
     <h4 style="font-size:90%;">Paraná, <?php echo format_date(date("d-m-Y")); ?></h4>
   </div>
</div>
</div>
</div>
 <div class="panel-body">
<div class="row">
<div class="col-12">
      <h4>OBRA: <?php echo $obra['nombre']; ?></h4>
      <h4>EXPEDIENTE: <?php echo $obra['expediente']; ?></h4>
  <!--<center>
    <b>
    </b>
    <br />
    Ultimo certificado: Nº <?php echo $obra['certificado_numero']; ?> de <?php echo $obra['certificado_fecha']; ?> con un monto de <?php echo '$ '.numero($obra['certificado_monto']); ?> y un avance del <?php echo $obra['certificado_porcentaje'].' %'; ?>
</center>-->
  <br />
</div>
</div>
<canvas id="curva" height="300vw" width="800vw" ></canvas>
  
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script>var ctx = document.getElementById('curva');var chart = new Chart(ctx, {type: 'line',data: {labels: <?php print json_encode($numero); ?>,datasets: [{label: "Certificados",fill:false,lineTension: 0,borderColor: 'rgb(249, 113, 113)',data: <?php print json_encode($avance); ?>,},{label: "Plan oficial",fill:false,lineTension: 0,borderColor: 'rgb(124, 213, 254)',data: <?php print json_encode($avanceplan); ?>,},{label: "Multa",fill:false,borderDash: [5,5],lineTension: 0,borderColor: 'rgb(216, 202, 215)',data: <?php print json_encode($multa); ?>,}]},options: {scales: {xAxes: [{ticks: {beginAtZero:true,suggestedMin:0}}],yAxes: [{ticks: {beginAtZero:true,min:0,max: 100}}]},tooltips: {enabled: true,mode: 'single',callbacks: {title: function (tooltipItem, data) {return "Certificado Nº " + data.labels[tooltipItem[0].index];},label: function(tooltipItems, data) {return "Avance: " + tooltipItems.yLabel + ' %';},footer: function (tooltipItem, data) { return ""; }}}}});</script>
</body>
</html>