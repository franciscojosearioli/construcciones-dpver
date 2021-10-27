<?php
require_once('../../includes/load.php');
$obra_id=$_GET['id'];
$user = current_user();
$obra = find_by_id('obras','idobras',(int)$_GET['id']);  
if($obra['estado'] == 1){ redirect('proyecto?id='.$obra_id, false); }
require_once('../../includes/functions/obras.php');  
require_once('../../includes/functions/php_file_tree.php');   
require_once('../../../uploads/files.php'); 
$ejecutados = all_oyp();
$actividades = actividad_obra($obra['idobras']);
foreach($ejecutados as $obra):
  if($obra['idobras'] == $obra_id){
    ?>
    <div class="p-20">
<div class="row justify-content-center">
<div class="col-lg-9 col-md-9 col-sm-12">


<div class="row">
<div class="col-lg-6 col-md-6 col-sm-12">
<h3 class="titulo-bienvenida p-20">
   Archivos de obra
    </h3>
<div class="card">
<div class="card-body mx-4">
            <div class="table-responsive" >
          <?php
          $allowed_extensions = array("gif", "jpg", "jpeg", "png", "xls", "doc", "dwg", "pdf");
          echo php_file_tree("../../../uploads/obras/".$obra['idobras']."/Archivo", "[link]", $allowed_extensions);
          ?>
        </div>
        
      </div>
        </div>
      </div>

      <div class="col-lg-6 col-md-6 col-sm-12">
<?php if(is_dir("../../../uploads/obras/".$obra['idobras']."/Tramites")){ ?>
  <h3 class="titulo-bienvenida p-20">
   Tramites de obra
    </h3>
<div class="card">
<div class="card-body mx-4">
            <div class="table-responsive" >
          <?php
          $allowed_extensions = array("gif", "jpg", "jpeg", "png", "xls", "doc", "dwg", "pdf");
          echo php_file_tree("../../../uploads/obras/".$obra['idobras']."/Tramites", "[link]", $allowed_extensions);
          ?>
        </div>
        
      </div>
        </div>
        <?php } ?>
      </div>      
        </div>
      </div>


      <div class="col-lg-3 col-md-3 col-sm-12">
        <h3 class="titulo-bienvenida p-20">
   Actividades de obra
    </h3>
        <div class="card">
<div class="card-body">
<?php if(!empty($actividades)){ ?>
<div class="list-group usuarios_movimientos scrollbar-ripe-malinka">
<?php 
foreach ($actividades as $a): ?>
  <?php if(!empty($a['memoria'])){ ?>
<a class="list-group-item" style="padding-bottom: 5px;" data-toggle="modal" data-target="#registro_memoria">
 <?php echo $a['evento']; ?> (Haga click para ver)
<p style="color:#00000080;font-size: 11px;">               
<span style="float:right;"><?php echo format_dyt($a['fecha']).''.user_name($a['idusuarios']);; ?></span>
</p>
</a>

<div class="modal fade" id="registro_memoria" tabindex="-1" role="dialog" aria-labelledby="registro_memoria" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100" id="registro_memoria">Evento de obra</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">          
<p style="color:#00000080;font-size: 11px;">               
Antecedente de memoria descriptiva
</p>
      <?php echo textarea($a['memoria']); ?>
      </div>
      <div class="modal-footer">
      Fecha de actualizacion: <?php echo format_dyt($a['fecha']).''.user_name($a['idusuarios']);; ?>
      </div>
    </div>
  </div>
</div>
<?php }else{ ?>
<a class="list-group-item" style="padding-bottom: 5px;" >
<?php echo $a['evento']; ?>                
<p style="color:#00000080;font-size: 11px;">               
<span style="float:right;"><?php echo format_dyt($a['fecha']).''.user_name($a['idusuarios']); ?></span>
</p>
</a>
<?php } endforeach;
}else{
echo '<div class="list-group">No se ha registrado actividad.'; }
?>
</div>
</div>
</div>

      </div>
                                </div>
                                <?php } endforeach; ?></div>
<script>
$(document).ready(function(){
        init_php_file_tree();
    });
</script>