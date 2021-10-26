<?php
require_once('../../includes/load.php');
$obra_id=$_GET['id'];
$user = current_user();
$obra = find_by_id('obras','idobras',(int)$_GET['id']);  
if($obra['estado'] == 1){ redirect('proyecto?id='.$obra_id, false); }
$ejecutados = all_oyp();
$all_user = all_usuarios();
$lab_suelo = ensayos_suelo($obra_id);
$lab_hormigon = ensayos_hormigon($obra_id);
$lab_asfalto = ensayos_asfalto($obra_id);
foreach($ejecutados as $obra):
  if($obra['idobras'] == $obra_id){

    ?>
<div class="card p-20">
<ul class="nav nav-pills m-b-30 justify-content-center" >
<li class="nav-item"> <a href="#laboratorio-suelo" class="nav-link active" data-toggle="pill">Suelo</a> </li>
<li class="nav-item"> <a href="#laboratorio-hormigon" class="nav-link" data-toggle="pill">Hormigon</a> </li>
<li class="nav-item"> <a href="#laboratorio-asfalto" class="nav-link" data-toggle="pill">Asfalto</a> </li>
</ul>
  <div class="tab-content br-n pn">
<div id="laboratorio-suelo" class="tab-pane active" role="tabpanel">
<div class="card">
<div class="card-body">
<div class="p-20">
<?php if(permiso('admin') || permiso('laboratorio')){ ?>
  <a class="btn btn-warning" data-toggle="modal" data-target="#add_laboratorio_suelo">Cargar datos</a> 
<?php } ?>
<div class="table-responsive">
<table class="table table-striped" cellspacing="0" width="100%">
<thead>
<tr>
  <th></th>
<th class="text-center" style="width: 10%;"> Fecha </th>
<th class="text-center"> Descripcion </th>
<th class="text-center"> Archivo </th>
<th class="text-center"> Registro </th>
</tr>
</thead>
<tbody>
<?php foreach($lab_suelo as $l): ?>
<tr>
  <td></td>
  <td><?php echo $l['fecha']; ?></td>
  <td><?php echo $l['descripcion']; ?></td>
  <td><?php echo $l['archivo']; ?></td>
  <td><?php echo format_date($l['registro_fecha']).' '.user_name($l['registro_usuario']); ?></td>
</tr>
<?php endforeach; ?>
</tbody>
<tfoot>
<tr>
  <th></th>
<th class="text-center" style="width: 10%;"> Fecha </th>
<th class="text-center"> Descripcion </th>
<th class="text-center"> Archivo </th>
<th class="text-center"> Registro </th>
</tr>
</tfoot>
</table>
</div>
</div>
</div>
</div>
</div>
<div id="laboratorio-hormigon" class="tab-pane" role="tabpanel">
<div class="card">
<div class="card-body">
<div class="p-20">
<?php if(permiso('admin') || permiso('laboratorio')){ ?>
  <a class="btn btn-warning" data-toggle="modal" data-target="#add_laboratorio_hormigon">Cargar datos</a> 
<?php } ?>
<div class="table-responsive">
<table  class="table table-striped" cellspacing="0" width="100%">
<thead>
<tr>
  <th></th>
<th class="text-center" style="width: 10%;"> Fecha </th>
<th class="text-center"> Descripcion </th>
<th class="text-center"> Archivo </th>
<th class="text-center"> Registro </th>
</tr>
</thead>
<tbody>
<?php foreach($lab_hormigon as $l): ?>
<tr>
  <td></td>
  <td><?php echo $l['fecha']; ?></td>
  <td><?php echo $l['descripcion']; ?></td>
  <td><?php echo $l['archivo']; ?></td>
  <td><?php echo format_date($l['registro_fecha']).' '.user_name($l['registro_usuario']); ?></td>
</tr>
<?php endforeach; ?>
</tbody>
<tfoot>
<tr>
  <th></th>
<th class="text-center" style="width: 10%;"> Fecha </th>
<th class="text-center"> Descripcion </th>
<th class="text-center"> Archivo </th>
<th class="text-center"> Registro </th>
</tr>
</tfoot>
</table>
</div>
</div>
</div>
</div>
</div>
<div id="laboratorio-asfalto" class="tab-pane" role="tabpanel">
<div class="card">
<div class="card-body">
<div class="p-20">
<?php if(permiso('admin') || permiso('laboratorio')){ ?>
  <a class="btn btn-warning" data-toggle="modal" data-target="#add_laboratorio_asfalto">Cargar datos</a> 
<?php } ?>
<div class="table-responsive">
<table class="table table-striped" cellspacing="0" width="100%">
<thead>
<tr>
  <th></th>
<th class="text-center" style="width: 10%;"> Fecha </th>
<th class="text-center"> Descripcion </th>
<th class="text-center"> Archivo </th>
<th class="text-center"> Registro </th>
</tr>
</thead>
<tbody>
<?php foreach($lab_asfalto as $l): ?>
<tr>
  <td></td>
  <td><?php echo $l['fecha']; ?></td>
  <td><?php echo $l['descripcion']; ?></td>
  <td><?php echo $l['archivo']; ?></td>
  <td><?php echo format_date($l['registro_fecha']).' '.user_name($l['registro_usuario']); ?></td>
</tr>
<?php endforeach; ?>
</tbody>
<tfoot>
<tr>
  <th></th>
<th class="text-center" style="width: 10%;"> Fecha </th>
<th class="text-center"> Descripcion </th>
<th class="text-center"> Archivo </th>
<th class="text-center"> Registro </th>
</tr>
</tfoot>
</table>
</div>
</div>
</div>
</div>
</div>
</div>


</div>
<script type="text/javascript" src="includes/assets/js/ajustes.js"></script>
<?php } endforeach; ?>
