<?php
require_once('../../includes/load.php');
$obra_id=$_GET['id'];
$user = current_user();
$obra = find_by_id('obras','idobras',(int)$_GET['id']);  
if($obra['estado'] == 1){ redirect('proyecto?id='.$obra_id, false); }
require_once('../../includes/functions/obras.php');  
require_once('../../includes/functions/certificados.php');   
require_once('../../../uploads/files.php'); 
$ejecutados = all_oyp();
$certificados = certificados_obras($obra_id);
$inspeccion_certificados = certificados_inspeccion($obra_id);
$certificados_redeterminados = certificados_red_inspeccion($obra_id);
$certificados_plan = plan_oficial_obras($obra_id);
$certificados_adec = certificados_redeterminados_obras($obra_id);
$certificados_multa = plan_oficial_obras($obra_id);

$all_user = all_usuarios();
$obra_bacheo = obra_bacheo($obra_id);
$inspeccion_informe = informes_inspeccion($obra_id);   
$inspeccion_asistencia = asistencias_inspeccion($obra_id);  
$inspectores = all_inspectores();
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
foreach($ejecutados as $obra):
  if($obra['idobras'] == $obra_id){
    ?>

<div class="row justify-content-center">

<div class="col-lg-4 col-md-4 col-sm-12">
<div class="">
<div class="card">
<div class="card-body mx-4"> 
<h3 class="card-title">Montos y Plazos vigentes</h3> 
<?php if(permiso('admin') || permiso('certificacion') || permiso('obras')){ ?>
                    <div class="p-b-10"> <a href="" data-toggle="modal" data-target="#montos_obra" ><i class="fas fa-edit"></i> Editar datos</a></div>
                  <?php } ?>
<label class="control-label text-muted" style="font-size:12px;">Monto de contrato vigente a precios base </label>
<p><?php if(!empty($obra['monto_vigente'])){ echo '$ '.numero($obra['monto_vigente']); } ?></p>

<?php if(!empty($obra['idcotizaciones'])){ 
    $cotizacion_obra = find_by_id('cotizaciones','idcotizaciones',$obra['idcotizaciones']);
    ?>
<hr>
<label class="control-label text-muted" style="font-size:12px;">Según cotizacion vigente</label>
<a class="list-group-item" style="padding:15px; text-decoration: none; color:#00000080" >

<div class="d-flex flex-wrap">
<div class="my-auto ml-3" >
<span style="font-weight:500">Cotizacion <?php echo $cotizacion_obra['numero'].' | '.$cotizacion_obra['detalle']; ?></span>
</div>
<div class="ml-auto my-auto mr-3">
    <span onclick="ver_cotizacion(<?php echo $obra['idcotizaciones']; ?>)">Ver</span> <?php if(permiso('admin') || permiso('obras')){ ?> |  
    <span onclick="editar_planilla_cotizacion(<?php echo $obra['idcotizaciones']; ?>)">Editar</span> | 
    <span onclick="eliminar_cotizacion(<?php echo $obra['idcotizaciones'];?>)" >Eliminar</span><?php } ?>
</div>
</div></a><br>
<?php } ?>
<label class="control-label text-muted" style="font-size:12px;">Monto de contrato vigente a precios redeterminados </label>
<p><?php if(!empty($obra['monto_redeterminado'])){ echo '$ '.numero($obra['monto_redeterminado']); } ?></p>
<label class="control-label text-muted" style="font-size:12px;">Plazo de obra actualizado</label>
<p><?php echo $obra['plazo_vigente']; ?></p>
<label class="control-label text-muted" style="font-size:12px;">Acta de redeterminacion</label>
<p><?php echo $obra['info_redeterminacion']; ?></p>

</div>
</div>
<div class="card">
<div class="card-body mx-4"> 
<h3 class="card-title">Avance de obra</h3> 
<?php if(permiso('admin') || permiso('certificacion') || permiso('obras')){ ?>
                    <div class="p-b-10"> <a href="" data-toggle="modal" data-target="#avance_obra" ><i class="fas fa-edit"></i> Editar datos</a></div>
                  <?php } ?>
<label class="control-label text-muted" style="font-size:12px;">Numero de certificado </label>
<p><?php if(!empty($obra['certificado_numero'])){ echo $obra['certificado_numero']; } ?></p>
<label class="control-label text-muted" style="font-size:12px;">Fecha certificada</label>
<p><?php if(!empty($obra['certificado_fecha'])){ echo $obra['certificado_fecha']; } ?></p>
<label class="control-label text-muted" style="font-size:12px;">Porcentaje de avance</label>
<p><?php if(!empty($obra['certificado_porcentaje'])){ echo numero($obra['certificado_porcentaje']).' %'; } ?></p>
<label class="control-label text-muted" style="font-size:12px;">Monto ejecutado</label>
<p><?php if(!empty($obra['certificado_monto'])){ echo '$ '.numero($obra['certificado_monto']); } ?></p>
<label class="control-label text-muted" style="font-size:12px;">Plazo transcurrido</label>
<p><?php if(!empty($obra['certificado_plazo'])){ echo $obra['certificado_plazo']; } ?></p>
<?php if(!empty($obra['certificado_archivo'])){ ?><a href="../uploads/Obras/<?php echo $obra['idobras']; ?>/Certificacion/Ultimo/Certificado_<?php echo utf8_encode($obra['certificado_archivo']); ?>" target="_blank"><i class="fas fa-download"></i> <?php echo $obra['certificado_archivo']; ?></a><?php } ?>
</div>
</div>
<div class="card">
<div class="card-body mx-4">  
<h3 class="card-title">Especificaciones</h3>
<?php if(permiso('admin') || permiso('certificacion') || permiso('obras')){ ?><div class="p-b-10"> <a href="" data-toggle="modal" data-target="#datos_certificados" ><i class="fas fa-edit"></i> Editar datos</a></div><?php } ?>
<label class="control-label text-muted" style="font-size:12px;">Valor del margen de multa</label>
<p><?php if(!empty($obra['valormulta'])){  echo $obra['valormulta']; } ?> </p>

 <label class="control-label text-muted" style="font-size:12px;">Vencimiento de certificados</label>
                                            <p><?php if(!empty($obra['certificado_vencimiento'])){
                                             echo $obra['certificado_vencimiento'].' dias'; }
                                             ?></p>
                                             <?php if($obra['anticipo_financiero'] == 1){ ?>
                                             <label class="control-label text-muted" style="font-size:12px;">Anticipo financiero</label>
                <p> <?php $res_anticipo = ($obra['contrato_monto']*$obra['valor_anticipo_financiero'])/100; echo $obra['valor_anticipo_financiero'].' % ($ '.numero($res_anticipo).')'; ?></p>
                                          <?php } ?>
<!--
<?php if(permiso('admin') || permiso('certificacion') || permiso('obras')){ ?>
<div class="p-b-10"> <a href="" data-toggle="modal" data-target="#avance_obra" ><i class="fas fa-edit"></i> Editar datos</a></div>
<?php } ?>
<label class="control-label text-muted" style="font-size:12px;">Numero de certificado</label>
<p><?php echo $obra['certificado_numero']; ?></p>
<label class="control-label text-muted" style="font-size:12px;">Fecha del certificado</label>
<p><?php echo $obra['certificado_fecha']; ?></p>
<label class="control-label text-muted" style="font-size:12px;">Monto ejecutado a precios base</label>
<p><?php if(!empty($obra['certificado_monto'])){ echo '$ '.numero($obra['certificado_monto']); } ?></p>
<label class="control-label text-muted" style="font-size:12px;">Plazo acumulado transcurrido</label>
<p><?php echo $obra['certificado_plazo']; ?></p>
<label class="control-label text-muted" style="font-size:12px;">Porcentaje acumulado</label>
<p><?php echo $obra['certificado_porcentaje'].' %'; ?></p>


                  
<?php if($obra['registro_certificados_fecha'] != '0000-00-00' && !empty($obra['registro_certificados_fecha'])){
                      echo '<hr>
                  <span style="padding:20px;color:#000;">Actualizado el '.format_date($obra['registro_certificados_fecha']).'</span> '; } ?> -->
</div>
</div>

</div>
</div>

<div class="col-lg-8 col-md-8 col-sm-12">

<div class="card">
<div class="card-body">



<ul class="nav nav-pills m-b-30 justify-content-center" >
<li class=" nav-item"> <a href="#obra-inspeccion-certificados" class="nav-link active" data-toggle="pill">Certificados de obra</a> </li>
<li class=" nav-item"> <a href="#obra-inspeccion-cert-red" class="nav-link" data-toggle="pill">Certificados redeterminados</a> </li>
</ul>
<div class="tab-content br-n pn">
<div id="obra-inspeccion-certificados" class="tab-pane active" role="tabpanel">
<div class="card">
<div class="card-body">
<div class="p-20">

<?php if(permiso('inspeccion') && $obra['idinspector'] == $user['id'] || permiso('admin')){ ?>
  <div class="justify-content-center text-center p-20">
  <a class="btn btn-warning" title="Cargar datos" onclick="resultadoobra(<?php echo $obra['idobras']; ?>)">Confeccionar certificado de obra</a> 
</div>
<?php } ?>
<div class="table-responsive">
<table id="certificados" class="table table-striped" cellspacing="0" width="100%">
<thead>
<tr>
<th></th>
<th class="text-center" style="width: 10%;"> Nº </th>
<th class="text-center"> Estado </th>
<th class="text-center"> Expediente </th>
<th class="text-center"> Fecha de medicion </th>
<th class="text-center"> Importe </th>
<th class="text-center"> Certificado </th>
</tr>
</thead>
<tbody>
<?php foreach ($inspeccion_certificados as $i_certificado):?>
<tr>
<td><?php if($i_certificado['edita'] == 1){ ?><a onclick="editar_certificadoobra(<?php echo $i_certificado['idcertificados_obras']; ?>,<?php echo $obra['idobras']; ?>)">EDITAR</a><?php } ?></td>
<td class="text-center"> <?php if($i_certificado['numero'] == '0'){ echo 'ANTICIPO'; }else{ echo clean($i_certificado['numero']);} ?></td>
<td class="text-center"> <?php if($i_certificado['estado'] == 0){ echo 'Confeccionado'; }elseif($i_certificado['estado'] == 1){ echo 'Emitido' ; }elseif($i_certificado['estado'] == 2){ echo 'Aprobado'; }elseif($i_certificado['estado'] == 3){ echo 'En Revision'; }?> </td>
<td class="text-center"> <?php echo clean($i_certificado['expediente']); ?> </td>
<td class="text-center"> <?php if(!empty($i_certificado['fecha_medicion']) && $i_certificado['fecha_medicion'] != '0000-00-00'){ echo format_date($i_certificado['fecha_medicion']);} ?></td>
<td class="text-center"> <?php if(!empty($i_certificado['importe'])){ echo '$ '.numero($i_certificado['importe']); }else{ echo '$ 0,00'; } ?></td>
<td class="text-center"> <a href="../uploads/Obras/<?php echo $obra['idobras']; ?>/Certificaciones/Certificados/<?php echo $i_certificado['archivo_copia']; ?>" target="_blank">Ver Certificado</a></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
<div id="obra-inspeccion-cert-red" class="tab-pane" role="tabpanel">
<div class="card">
<div class="card-body">
<div class="p-20">
<div class="table-responsive">
<table id="certificados-redeterminados" class="table table-striped" cellspacing="0" width="100%">
<thead>
<tr>
<th></th>
<th class="text-center" style="width: 10%;"> Nº </th>
<th class="text-center"> Estado </th>
<th class="text-center"> Expediente </th>
<th class="text-center"> Fecha de medicion </th>
<th class="text-center"> Importe </th>
<th class="text-center"> Certificado </th>
</tr>
</thead>
<tbody>
<?php foreach ($certificados_redeterminados as $i_certificado):?>
<tr>
<td></td>
<td class="text-center"> <?php if($i_certificado['numero'] == '0'){ echo 'ANTICIPO'; }else{ echo clean($i_certificado['numero']);} ?></td>
<td class="text-center"> <?php if($i_certificado['estado'] == 0){ echo 'Confeccionado'; }elseif($i_certificado['estado'] == 1){ echo 'Emitido' ; }elseif($i_certificado['estado'] == 2){ echo 'Aprobado'; }elseif($i_certificado['estado'] == 3){ echo 'En Revision'; }?> </td>
<td class="text-center"> <?php echo clean($i_certificado['expediente']); ?> </td>
<td class="text-center"> <?php if(!empty($i_certificado['fecha_medicion']) && $i_certificado['fecha_medicion'] != '0000-00-00'){ echo format_date($i_certificado['fecha_medicion']);} ?></td>
<td class="text-center"> <?php if(!empty($i_certificado['importe'])){ echo '$ '.numero($i_certificado['importe']); }else{ echo '$ 0,00'; } ?></td>
<td class="text-center"> <a href="../uploads/Obras/<?php echo $obra['idobras']; ?>/Certificaciones/Redeterminados/<?php echo $i_certificado['archivo_copia']; ?>" target="_blank">Ver Certificado</a></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>

</div>
</div>
                                  
                                <div class="card p-20">
                                <div class="card-body mx-4">
                                
<h3 class="card-title">Curva de inversion</h3>
<?php if(!empty($obra['idplanes_de_trabajo'])){ 
    $plan_obra = find_by_id('planes_de_trabajo','idplanes_de_trabajo',$obra['idplanes_de_trabajo']);
    ?>
    
<label class="control-label text-muted" style="font-size:12px;">Según plan de trabajo vigente</label>
<a class="list-group-item" style="padding:15px; text-decoration: none; color:#00000080">
<div class="d-flex flex-wrap">
<div class="my-auto ml-3" >
<span style="font-weight:500">Plan <?php echo $plan_obra['numero'].' | '.$plan_obra['detalle']; ?></span>
</div>
<div class="ml-auto my-auto mr-3">
    <span onclick="ver_plan(<?php echo $obra['idplanes_de_trabajo']; ?>)">Ver</span><?php if(permiso('admin') || permiso('obras')){ ?> | 
    <span onclick="editar_planilla_plandetrabajo(<?php echo $obra['idplanes_de_trabajo']; ?>)">Editar</span> | 
    <span onclick="eliminar_plan(<?php echo $obra['idplanes_de_trabajo'];?>)" >Eliminar</span><?php } ?>
</div>
</div>
</a><br>
<?php } ?>
<p><a href="content/prints/curva-inversion.php?id=<?php echo $obra_id;?>" style="padding-top: 20px;" target="_blank">Imprimir curva de inversion</a></p>

<div class="table-responsive">
<canvas id="curva" width="100%" height="40%"></canvas>
</div>
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

<script type="text/javascript" src="includes/ajax/scripts/certificados.js"></script>
<script type="text/javascript" src="includes/assets/js/ajustes.js"></script>
                              <?php } endforeach; ?>
                              
                              <script>
  $(document).ready(funcion(){
    
  $('#certificados').DataTable({
    columnDefs: [ {
        "searchable": false,
        "orderable": false,
        "targets": 0
    } ],
    order: [],

    responsive: true,
//scrollY:        "500px",
scrollCollapse: true,
paging:         true
});
  $('#certificados-redeterminados').DataTable({
    columnDefs: [ {
        "searchable": false,
        "orderable": false,
        "targets": 0
    } ],
    order: [],

    responsive: true,
//scrollY:        "500px",
scrollCollapse: true,
paging:         true
});
  })
</script>