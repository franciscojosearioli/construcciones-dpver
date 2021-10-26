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
$cotizaciones = cotizaciones_obras($obra['idobras']);
$planes = planes_de_trabajo_obras($obra['idobras']);
foreach($ejecutados as $obra):
  if($obra['idobras'] == $obra_id){
    ?>
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12">
<div class="row justify-content-center">
<div class="col-lg-5 col-md-5 col-sm-12">
<div class="card">
<div class="card-body mx-4">  
<h3 class="card-title">Informacion de contrato</h3>
<label class="control-label text-muted" style="font-size:12px;">Tipo de contratacion</label>
                                            <p><?php echo $obra['tipo_contratacion']; ?></p>
                                            <label class="control-label text-muted" style="font-size:12px;">Aprobacion de pliegos</label>
                                            <p><?php if($obra['aprobacion_res_fecha'] != '0000-00-00'){ echo format_date($obra['aprobacion_res_fecha']); }else{'';} ?> <?php if(!empty($obra['aprobacion_res_num'])){ echo 'por Res. Nº'.$obra['aprobacion_res_num']; } else {echo '';} ?></p>
                                            <?php
          $allowed_extensions = array("pdf");
          echo php_file_tree("../../../uploads/obras/".$obra['idobras']."/Archivo/2-Resolucion aprobacion", "[link]", $allowed_extensions);
          ?>
                                            <label class="control-label text-muted" style="font-size:12px;">Adjudicacion de empresa</label>
                                            <p><?php if($obra['adjudicacion_res_fecha'] != '0000-00-00'){ echo format_date($obra['adjudicacion_res_fecha']); }else{'';} ?> <?php if(!empty($obra['adjudicacion_res_num'])){ echo 'por Res. Nº'.$obra['adjudicacion_res_num'];} else{echo '';} ?></p>
                                            <?php
          $allowed_extensions = array("pdf");
          echo php_file_tree("../../../uploads/obras/".$obra['idobras']."/Archivo/3-Resolucion adjudicacion", "[link]", $allowed_extensions);
          ?>
                                            <label class="control-label text-muted" style="font-size:12px;">Contratista</label>
                                            <p><?php echo $obra['contratista']; ?></p>
                                            <label class="control-label text-muted" style="font-size:12px;">Firma del contrato</label>
                                            <p><?php if($obra['contrato_fecha'] != '0000-00-00'){ echo format_date($obra['contrato_fecha']);} else { echo ''; } ?></p>
                                            <?php
          $allowed_extensions = array("pdf");
          echo php_file_tree("../../../uploads/obras/".$obra['idobras']."/Archivo/4-Contrato", "[link]", $allowed_extensions);
          ?>
                                            <?php if(!empty($obra['contrato_monto'])){ ?>
                                            <label class="control-label text-muted" style="font-size:12px;">Monto del contrato</label>
                                            <p><?php echo '$ '.numero($obra['contrato_monto']); ?></p>
                                        <?php }else{'';} ?>
                                        <label class="control-label text-muted" style="font-size:12px;">Acta de inicio</label>
                                            <p><?php if($obra['fecha_inicio'] != '0000-00-00'){ echo format_date($obra['fecha_inicio']); } else { echo ''; } ?></p>
                                            <?php
          $allowed_extensions = array("pdf");
          echo php_file_tree("../../../uploads/obras/".$obra['idobras']."/Archivo/5-Acta de inicio", "[link]", $allowed_extensions);
          ?>
          <!--<?php $carpeta = @scandir($_SERVER['DOCUMENT_ROOT']."/construcciones/public/uploads/Obras/".$obra['idobras']."/Archivo/4-Contrato");
          if (count($carpeta) > 2){
              echo 'no vacio';
          }else{ echo 'vacio'; }
          ?>-->
                                            <label class="control-label text-muted" style="font-size:12px;">Financiacion</label>
                                            <p><?php echo $obra['tipo_financiamiento']; ?></p>
                                            <label class="control-label text-muted" style="font-size:12px;">Finalizacion aproximada</label>
                                            <p><?php if($obra['fecha_fin_no_define'] == 0){
                                            if($obra['fecha_fin'] != '0000-00-00'){ echo format_date($obra['fecha_fin']);}}else{ echo 'No define';}
                                             ?></p>
                                             
</div>
</div>
                                        </div>
                                        <div class="col-lg-5 col-md-5 col-sm-12">
<div class="card">
<div class="card-body mx-4">  
<h3 class="card-title">Cotizacion</h3>
<?php if(!empty($obra['idcotizaciones'])){ 
    $cotizacion_obra = find_by_id('cotizaciones','idcotizaciones',$obra['idcotizaciones']);
    ?>
<label class="control-label text-muted" style="font-size:12px;">Vigente</label>
<a class="list-group-item" style="padding:15px; text-decoration: none; color:#00000080" >

<div class="d-flex flex-wrap">
<div class="my-auto ml-3" >
<span style="font-weight:500">Cotizacion <?php echo $cotizacion_obra['numero']; ?></span>
</div>
<div class="ml-auto my-auto mr-3">
    <span onclick="ver_cotizacion(<?php echo $obra['idcotizaciones']; ?>)">Ver</span> <?php if(permiso('admin') || permiso('obras')){ ?> |  
    <span onclick="editar_planilla_cotizacion(<?php echo $obra['idcotizaciones']; ?>)">Editar</span> | 
    <span onclick="eliminar_cotizacion(<?php echo $obra['idcotizaciones'];?>)" >Eliminar</span><?php } ?>
</div>
</div></a><br>
<?php }else{ ?>
<label class="control-label text-muted" style="font-size:12px;">Sin cargar</label>
<?php } foreach($cotizaciones as $c): 
 if($c['idcotizaciones'] != $obra['idcotizaciones']){   ?><hr><br>
<a class="list-group-item" style="padding:15px; text-decoration: none; color:#00000080" >
<div class="d-flex flex-wrap">
<div class="my-auto ml-3" >
<span style="font-weight:500">Cotizacion <?php echo $cotizacion_obra['numero']; ?></span>
</div>
<div class="ml-auto my-auto mr-3">
    <span onclick="ver_cotizacion(<?php echo $c['idcotizaciones']; ?>)">Ver</span>  <?php if(permiso('admin') || permiso('obras')){ ?> | 
    <span onclick="editar_planilla_cotizacion(<?php echo $c['idcotizaciones']; ?>)">Editar</span> | 
    <span onclick="eliminar_cotizacion(<?php echo $c['idcotizaciones'];?>)" >Eliminar</span><?php } ?>
</div>
</div>
</a><br>
<?php } endforeach ?>            
</div>
</div>

<div class="card">
<div class="card-body mx-4">  
<h3 class="card-title">Plan de trabajo</h3>
<?php if(!empty($obra['idplanes_de_trabajo'])){ 
    $plan_obra = find_by_id('planes_de_trabajo','idplanes_de_trabajo',$obra['idplanes_de_trabajo']);
    ?>
    
<label class="control-label text-muted" style="font-size:12px;">Vigente</label>
<a class="list-group-item" style="padding:15px; text-decoration: none; color:#00000080">
<div class="d-flex flex-wrap">
<div class="my-auto ml-3" >
<span style="font-weight:500">Plan <?php echo $plan_obra['numero']; ?></span>
</div>
<div class="ml-auto my-auto mr-3">
    <span onclick="ver_plan(<?php echo $obra['idplanes_de_trabajo']; ?>)">Ver</span><?php if(permiso('admin') || permiso('obras')){ ?> | 
    <span onclick="editar_planilla_plandetrabajo(<?php echo $obra['idplanes_de_trabajo']; ?>)">Editar</span> | 
    <span onclick="eliminar_plan(<?php echo $obra['idplanes_de_trabajo'];?>)" >Eliminar</span><?php } ?>
</div>
</div>
</a><br>
<?php }else{ ?>
<label class="control-label text-muted" style="font-size:12px;">Sin cargar</label>
<?php } foreach($planes as $p): 
 if($p['idplanes_de_trabajo'] != $obra['idplanes_de_trabajo']){   ?><hr><br>
<a class="list-group-item" style="padding:15px; text-decoration: none; color:#00000080" >
<div class="d-flex flex-wrap">
<div class="my-auto ml-3" >
<span style="font-weight:500">Plan <?php echo $p['numero']; ?></span>
</div>
<div class="ml-auto my-auto mr-3">
    <span onclick="ver_plan(<?php echo $p['idplanes_de_trabajo']; ?>)">Ver</span><?php if(permiso('admin') || permiso('obras')){ ?> | 
    <span onclick="editar_planilla_plandetrabajo(<?php echo $p['idplanes_de_trabajo']; ?>)">Editar</span> | 
    <span onclick="eliminar_plan(<?php echo $p['idplanes_de_trabajo'];?>)" >Eliminar</span><?php } ?>
</div>
</div>
</a><br>
<?php } endforeach ?>                                        
</div>
</div>
                                        </div>
</div>
</div></div>

                      <?php } endforeach; ?>
                      <script>
    function eliminar_plan(id){
        var id= id;
        setTimeout(function(){ window.location = "includes/functions/eliminar.php?id="+id+"&url=refresh&tipo=planilla-plandetrabajo"; }, 1000);
    }

    function eliminar_cotizacion(id){
        var id= id;
        setTimeout(function(){ window.location = "includes/functions/eliminar.php?id="+id+"&url=refresh&tipo=planilla-cotizacion"; }, 1000);
    }

$(document).ready(function(){
        init_php_file_tree();
    });
    
function ver_plan(valor){
  var valor = valor;
  $.ajax({
  type: "POST",
  data: "id="+valor,
  url: "content/modals/ver_plan_de_trabajo.php",
  success: function(respuesta) {
  $('#modal-planillas').html(respuesta).appendTo('body');
  $('#ver_plan_de_trabajo').modal('show');
  }
  });
  }
  function ver_cotizacion(valor){
  var valor = valor;
  $.ajax({
  type: "POST",
  data: "id="+valor,
  url: "content/modals/ver_cotizacion.php",
  success: function(respuesta) {
  $('#modal-planillas').html(respuesta).appendTo('body');
  $('#ver_cotizacion').modal('show');
  }
  });
  }

</script>