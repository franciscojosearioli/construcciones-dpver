<?php
require_once('../../includes/load.php');
$obra_id=$_GET['id'];
$user = current_user();
$obra = find_by_id('obras','idobras',(int)$_GET['id']);  
if($obra['estado'] == 1){ redirect('proyecto?id='.$obra_id, false); }
require_once('../../includes/functions/obras.php');  
require_once('../../includes/functions/certificados.php');  
require_once('../../includes/functions/php_file_tree.php');   
require_once("../../includes/functions/map.php"); 
require_once('../../../uploads/files.php'); 
$ejecutados = all_oyp();
$ordenes = ordenes_de_servicio($obra_id);
$ensayos = ensayos_laboratorio($obra_id);
$notas = notas_de_pedido($obra_id);
$all_user = all_usuarios();
$obra_bacheo = obra_bacheo($obra_id);
$inspeccion_certificados = certificados_inspeccion($obra_id);
$certificados_redeterminados = certificados_red_inspeccion($obra_id);
$inspeccion_informe = informes_inspeccion($obra_id);   
$inspeccion_asistencia = asistencias_inspeccion($obra_id);  
$inspectores = all_inspectores();
$equipo_asignado = all_equipo_inspector($obra['idinspector'],$obra['idobras']);
foreach($ejecutados as $obra):
if($obra['idobras'] == $obra_id){
?>
<div class="p-20">



<div class="row">
<div class="col-lg-4 col-md-4 col-sm-12">
<div class="card">
<div class="card-body p-t-30">
<div class="row p-l-20 p-r-20 p-b-20">
<div class="col-lg-12 col-md-12">
<p>Inspector designado:</p>
<?php if($obra['idinspector'] != 0){
$usuario_a_cargo = usuarios_a_cargo($obra['idinspector']); 
$usuarios_responsable = usuarios_responsable($obra['idinspector']); ?>
<a href="usuario.php?id=<?php echo $obra['idinspector'] ?>" class="list-group-item" style="padding:15px; text-decoration: none; color:#00000080" >
<span style="font-weight:500"><?php echo inspector_name($obra['idinspector']); ?></span>
</a>
<?php }else{ ?> No se ha designado inspector <?php } ?>
<br>
<?php if(!empty($equipo_asignado)){  ?>
<p>Personal de inspeccion:</p>
<?php 
foreach($equipo_asignado as $u): 
$user_equipo = find_by_id('users','id',(int)$u['idusuario']); ?>
<a href="usuario.php?id=<?php echo $u['idusuario'] ?>" class="list-group-item" style="padding:15px; text-decoration: none; color:#00000080" >
<span style="font-weight:500"><?php echo $user_equipo['apellido'].' '.$user_equipo['nombre']; ?></span>
</a>
<?php endforeach; } ?>
</div>
</div>
</div>
</div>
<div class="card">
<div class="card-body p-t-30">
<div class="row p-l-20 p-r-20 p-b-20">
<div class="col-lg-12 col-md-12">

<p>Contratista adjudicada:</p>

<?php if(!empty($obra['contratista'])){ ?>
<a class="list-group-item" style="padding:15px; text-decoration: none; color:#00000080" >
<span style="font-weight:500"><?php echo $obra['contratista']; ?></span>
</a>
<?php }else{ ?> No se ha designado contratista <?php } ?>
<br>

<!--<p>Responsable tecnico </p>

<p>Responsable legal</p>-->

</div>
</div>
</div>
</div>
<div class="card">
<div class="card-body">
<div class="p-20">
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12">
<p>Archivos de inspeccion</p>
            <div class="table-responsive">
          <?php
          $allowed_extensions = array("gif", "jpg", "jpeg", "png", "xls", "doc", "dwg", "pdf");
          echo php_file_tree("../../../uploads/obras/".$obra['idobras']."/Inspeccion", "[link]", $allowed_extensions);
          ?>
        </div>
      </div>
</div>
</div>
</div></div>



</div>
<div class="col-lg-8 col-md-8 col-sm-12">


<!--<div class="card">
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
<table id="certificados-inspeccion" class="table table-striped" cellspacing="0" width="100%">
<thead>
<tr>
<th></th>
<th class="text-center" style="width: 10%;"> Nº </th>
<th class="text-center"> Expediente </th>
<th class="text-center"> Fecha de medicion </th>
<th class="text-center"> Importe </th>
</tr>
</thead>
<tbody>
<?php foreach ($inspeccion_certificados as $i_certificado):?>
<tr>
<td><?php if($i_certificado['edita'] == 1){ ?><a onclick="editar_certificadoobra(<?php echo $i_certificado['idcertificados_obras']; ?>,<?php echo $obra['idobras']; ?>)">EDITAR</a><?php } ?></td>
<td class="text-center"> <?php if($i_certificado['numero'] == '0'){ echo 'ANTICIPO'; }else{ echo clean($i_certificado['numero']);} ?></td>
<td class="text-center"> <?php echo clean($i_certificado['expediente']); ?> </td>
<td class="text-center"> <?php if(!empty($i_certificado['fecha_medicion']) && $i_certificado['fecha_medicion'] != '0000-00-00'){ echo format_date($i_certificado['fecha_medicion']);} ?></td>
<td class="text-center"> <?php if(!empty($i_certificado['importe'])){ echo '$ '.numero($i_certificado['importe']); }else{ echo '$ 0,00'; } ?></td>
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
<table id="certificados-red-inspeccion" class="table table-striped" cellspacing="0" width="100%">
<thead>
<tr>
<th></th>
<th class="text-center" style="width: 10%;"> Nº </th>
<th class="text-center"> Expediente </th>
<th class="text-center"> Fecha de medicion </th>
<th class="text-center"> Importe </th>
</tr>
</thead>
<tbody>
<?php foreach ($certificados_redeterminados as $i_certificado):?>
<tr>
<td></td>
<td class="text-center"> <?php if($i_certificado['numero'] == '0'){ echo 'ANTICIPO'; }else{ echo clean($i_certificado['numero']);} ?></td>
<td class="text-center"> <?php echo clean($i_certificado['expediente']); ?> </td>
<td class="text-center"> <?php if(!empty($i_certificado['fecha_medicion']) && $i_certificado['fecha_medicion'] != '0000-00-00'){ echo format_date($i_certificado['fecha_medicion']);} ?></td>
<td class="text-center"> <?php if(!empty($i_certificado['importe'])){ echo '$ '.numero($i_certificado['importe']); }else{ echo '$ 0,00'; } ?></td>
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
</div>-->











<div class="card">
<div class="card-body">
<ul class="nav nav-pills m-b-30 justify-content-center" >
<li class="nav-item"> <a href="#obra-inspeccion-informe" class="nav-link active" data-toggle="pill">Informes de progreso mensual</a> </li>
<li class="nav-item"> <a href="#obra-inspeccion-asistencia" class="nav-link" data-toggle="pill">Planillas de asistencias mensuales</a> </li>
<li class="nav-item"> <a href="#obra-inspeccion-ensayos" class="nav-link" data-toggle="pill">Ensayos de laboratorios</a> </li>
</ul>
<div class="tab-content br-n pn">


<div id="obra-inspeccion-informe" class="tab-pane active" role="tabpanel">
<div class="card">
<div class="card-body">
<div class="p-20">
<?php if(permiso('inspeccion') && $obra['idinspector'] == $user['id'] || permiso('admin')){ ?>
  <div class="justify-content-center text-center p-20">
<a data-toggle="modal" data-target="#add_informe_inspeccion" class="btn btn-warning" onclick="recibir(<?php echo $obra['numero']; ?>,<?php echo $obra['idobras']; ?>);">Cargar informe</a> 
</div>
<?php } ?>
<div class="table-responsive">
<table id="informes-inspeccion" class="table table-striped" cellspacing="0" width="100%">
<thead>
<tr>
<th class="text-center" style="width: 10%;"> Nº </th>
<th class="text-center"> Fecha del informe </th>
<th class="text-center"> Informe de progreso </th>
</tr>
</thead>
<tbody>
<?php foreach ($inspeccion_informe as $i_informe):?>
<tr>
<td class="text-center"> <?php echo clean($i_informe['numero']); ?></td>
<td class="text-center"> <?php echo clean($i_informe['fecha']); ?></td>
<td class="text-center"> 
<a href="../uploads/Obras/<?php echo $obra['idobras']; ?>/Inspeccion/Informes/<?php echo $i_informe['numero']; ?>/<?php echo $i_informe['archivo']; ?>" target="_blank">Ver informe</a>
</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>




<div id="obra-inspeccion-asistencia" class="tab-pane" role="tabpanel">
<div class="card">
<div class="card-body">
<div class="p-20">
<?php if(permiso('inspeccion') && $obra['idinspector'] == $user['id'] || permiso('admin')){ ?>
<div class="justify-content-center text-center p-20">
<a data-toggle="modal" class="btn btn-warning" data-target="#add_personal_inspeccion" onclick="recibir(<?php echo $obra['numero']; ?>,<?php echo $obra['idobras']; ?>);">Cargar planilla</a> 
</div>
<?php } ?>
<div class="table-responsive">
<table id="asistencia-inspeccion" class="table table-striped" cellspacing="0" width="100%">
<thead>
<tr>
<th class="text-center" style="width: 10%;"> Nº </th>
<th class="text-center"> Fecha de planilla </th>
<th class="text-center"> Planilla de asistencias </th>
</tr>
</thead>
<tbody>
<?php foreach ($inspeccion_asistencia as $i_asistencia):?>
<tr>
<td class="text-center"> <?php echo clean($i_asistencia['numero']); ?></td>
<td class="text-center"> <?php echo clean($i_asistencia['fecha']); ?></td>
<td class="text-center"> 
<a href="../uploads/Obras/<?php echo $obra['idobras']; ?>/Inspeccion/Asistencias/<?php echo $i_asistencia['numero']; ?>/<?php echo $i_asistencia['archivo']; ?>" target="_blank">Ver archivo</a>
</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>

<div id="obra-inspeccion-ensayos" class="tab-pane" role="tabpanel">
<div class="card">
<div class="card-body">
<div class="p-20">
<?php if(permiso('inspeccion') && $obra['idinspector'] == $user['id'] || permiso('admin')){ ?>
<div class="justify-content-center text-center p-20">
<a class="btn btn-warning" data-toggle="modal" data-target="#add_ensayo_inspeccion">Cargar ensayo</a> 
</div>
<?php } ?>
<div class="table-responsive">
<table id="ensayos-inspeccion" class="table table-striped" cellspacing="0" width="100%">
<thead>
<tr>
<th class="text-center" style="width: 10%;"> Fecha </th>
<th class="text-center"> Asunto </th>
<th class="text-center"> Tipo </th>
</tr>
</thead>
<tbody>
<?php foreach ($ensayos as $e):?>
<tr>
<td class="text-center"> <?php echo format_date($e['fecha']); ?></td>
<td class="text-center"> <?php echo clean($e['descripcion']); ?></td>
<td class="text-center"> <a href="../uploads/Obras/<?php echo $obra['idobras']; ?>/Inspeccion/Ensayos/<?php echo $e['archivo']; ?>" target="_blank">Ver archivo</a></td>
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





<div class="card">
<div class="card-body">

<ul class="nav nav-pills m-b-30 justify-content-center" >
<li class="nav-item"> <a href="#obra-inspeccion-ordenes" class="nav-link active" data-toggle="pill">Ordenes de servicio</a> </li>
<li class="nav-item"> <a href="#obra-inspeccion-notas" class="nav-link" data-toggle="pill">Notas de pedido</a> </li>
</ul>
<div class="tab-content br-n pn">
<div id="obra-inspeccion-ordenes" class="tab-pane active" role="tabpanel">
<div class="card">
<div class="card-body">
<div class="p-20">
<?php if(permiso('inspeccion') && $obra['idinspector'] == $user['id'] || permiso('admin')){ ?>
<div class="justify-content-center text-center p-20">
<a data-toggle="modal" class="btn btn-warning" data-target="#add_ordenes_de_servicio">Cargar orden de servicio</a> 
</div>
<?php } ?>
<div class="table-responsive">
<table id="ordenes" class="table table-striped" cellspacing="0" width="100%">
<thead>
<tr>
<th class="text-center" style="width: 10%;"> Nº </th>
<th class="text-center" style="width: 10%;"> Asunto </th>
<th class="text-center" style="width: 10%;"> Orden de servicio </th>
</tr>
</thead>
<tbody>
<?php foreach ($ordenes as $ord):?>
<tr>
<td class="text-center"> <?php echo clean($ord['numero']); ?></td>
<td class="text-center"> <?php echo clean($ord['asunto']); ?></td>
<td class="text-center"> <a href="../uploads/Obras/<?php echo $obra['idobras']; ?>/Inspeccion/Ordenes/<?php echo $ord['archivo']; ?>" target="_blank">Ver archivo</a></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>

<div id="obra-inspeccion-notas" class="tab-pane" role="tabpanel">
<div class="card">
<div class="card-body">
<div class="p-20">
<?php if(permiso('inspeccion') && $obra['idinspector'] == $user['id'] || permiso('admin')){ ?>
<div class="justify-content-center text-center p-20">
<a data-toggle="modal" class="btn btn-warning" data-target="#add_notas_de_pedido">Cargar nota de pedido</a> 
</div>
<?php } ?>
<div class="table-responsive">
<table id="notas" class="table table-striped" cellspacing="0" width="100%">
<thead>
<tr>
<th class="text-center" style="width: 10%;"> Nº </th>
<th class="text-center" style="width: 10%;"> Asunto </th>
<th class="text-center" style="width: 10%;"> Nota de pedido </th>
</tr>
</thead>
<tbody>
<?php foreach ($notas as $not):?>
<tr>
<td class="text-center"> <?php echo clean($not['numero']); ?></td>
<td class="text-center"> <?php echo clean($not['asunto']); ?></td>
<td class="text-center"> <a href="../uploads/Obras/<?php echo $obra['idobras']; ?>/Inspeccion/Notas/<?php echo $not['archivo']; ?>" target="_blank">Ver archivo</a></td>
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







</div>
<?php } endforeach; ?>

<script type="text/javascript" src="includes/assets/js/ajustes.js"></script></div>

<script>
$(document).ready(function(){
        init_php_file_tree();

        
        $('#certificados-red-inspeccion').DataTable({
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
    $('#ensayos-inspeccion').DataTable({
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
    });
</script>