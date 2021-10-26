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
if($obra['estado'] != 3){
?>
<div class="row">
<div class="col-md-12">
  <center>
    <b>
      <h4>Informe de obra: <?php 
                        if($obra['estado'] == 0){ echo 'En ejecucion'; }
                        if($obra['estado'] == 3){ echo 'Finalizada'; }
                        if($obra['estado'] == 4){ echo 'Neutralizada'; }
                        if($obra['estado'] == 5){ echo 'Rescindida'; } ?></h4>
    </b>
  </center>
</div>
<br>
<div class="col-md-12">
<b>Obra:</b> <?php echo $obra['nombre']; ?><br />
<b>Descripcion:</b> <?php echo $obra['descripcion']; ?><br />
<b>Departamento:</b> <?php echo $obra['ubicacion']; ?><br />
<b>Longitud:</b> <?php if(!empty($obra['longitud'])){echo $obra['longitud'].' metros.';} else { echo ''; } ?><br />
<br>
<b>Nº Expediente:</b> <?php echo $obra['expediente']; ?><br />  
<b>Estado:</b> 
<?php 
                        if($obra['estado'] == 0){ echo 'En ejecucion'; }
                        if($obra['estado'] == 3){ echo 'Finalizada'; }
                        if($obra['estado'] == 4){ echo 'Neutralizada'; }
                        if($obra['estado'] == 5){ echo 'Rescindida'; } ?>
</div>
</div>
<br>
<div class="row">
<div class="col-md-12">
<b>Aprobacion de proyecto:</b> <?php if($obra['aprobacion_res_fecha'] != '0000-00-00'){ echo format_date($obra['aprobacion_res_fecha']); }else{'';} ?> <?php if(!empty($obra['aprobacion_res_num'])){ echo 'por Res. Nº'.$obra['aprobacion_res_num']; } else{echo '';} ?><br />
<b>Adjudicacion a empresa:</b> <?php if($obra['adjudicacion_res_fecha'] != '0000-00-00'){ echo format_date($obra['adjudicacion_res_fecha']); }else{'';} ?> <?php if(!empty($obra['adjudicacion_res_num'])){ echo 'por Res. Nº'.$obra['adjudicacion_res_num'];} else{echo '';} ?><br />
<b>Tipo de contratacion:</b> <?php echo $obra['tipo_contratacion']; ?><br />
<br>
<b>Contratista:</b> <?php echo $obra['contratista']; ?><br />
<b>Firma del contrato:</b> <?php if($obra['contrato_fecha'] != '0000-00-00'){ echo format_date($obra['contrato_fecha']); } else { echo ''; } ?><br />
<b>Acta de inicio de obra:</b> <?php if($obra['fecha_inicio'] != '0000-00-00'){ echo format_date($obra['fecha_inicio']); } else { echo ''; } ?><br />
</div>
</div>
<br>
<div class="row"> 
<div class="col-md-12">
<b>Presupuesto oficial:</b> <?php if(!empty($obra['proyecto_monto'])){ echo '$ '.numero($obra['proyecto_monto']); }else{'';} ?> <?php if(!empty($obra['proyecto_monto_fecha'])){ echo '('.$obra['proyecto_monto_fecha'].')'; }else{'';} ?><br />
<b>Plazo de garantia:</b> <?php echo $obra['plazo_garantia']; ?><br />
</div>
</div>
<br>
<div class="row">
<div class="col-md-12">
<b>Financiacion:</b> <?php echo $obra['tipo_financiamiento']; ?><br />
<b>Inspector de obra:</b> <?php echo inspector_name($obra['idinspector']); ?><br />
<?php if($obra['estado'] == 0){ ?>
<b>Finalizacion aproximada:</b> <?php if($obra['fecha_fin'] != '0000-00-00'){ echo format_date($obra['fecha_fin']); } else { echo ''; } ?><br />
<?php } ?>
</div>
</div>
<br>
<div class="row">
<div class="col-md-12">
            <center><b><h4>Montos y plazos de obra</h4></b></center>
<b>Monto de contrato:</b> <?php if(!empty($obra['contrato_monto'])){ echo '$ '.numero($obra['contrato_monto']);} ?><br />
<b>Plazo oficial:</b> <?php echo $obra['contrato_plazo']; ?><br /><br />
<b>Monto vigente:</b> <?php if(!empty($obra['monto_vigente'])){ echo '$ '.numero($obra['monto_vigente']);} ?><br />            
<b>Plazo vigente:</b> <?php echo $obra['plazo_vigente']; ?><br /><br />
<b>Monto actualizado:</b> <?php if(!empty($obra['monto_redeterminado'])){ echo '$ '.numero($obra['monto_redeterminado']);} ?><br />
<b>Actualizacion:</b> <?php echo $obra['info_redeterminacion']; ?><br />
  </div>
</div>
<br>
<?php if($obra['estado'] == 0){ ?>
    <div class="row">
    <div class="col-md-12">
      <center><b><h4>Avance de obra</h4></b></center>
<table class="table table-bordered">
  <thead>
  <tr>
    <th>Nº certificado</th>
    <th>Fecha</th>
    <th>Plazo transcurrido</th>
    <th>Obra ejecutada</th>
    <th>Porcentaje</th>
  </tr>
</thead>
<tbody>
  <tr>
    <td><?php echo $obra['certificado_numero']; ?></td>
    <td><?php echo $obra['certificado_fecha']; ?></td>
    <td><?php echo $obra['certificado_plazo']; ?></td>
    <td><?php if(!empty($obra['certificado_monto'])){ echo '$ '.numero($obra['certificado_monto']);} ?></td>
    <td><?php echo $obra['certificado_porcentaje'].' %'; ?></td>
</tr>
</tbody>
</table>
  </div>
  </div>
<?php } ?>
<?php if($obra['bacheo'] == 1){ ?>
  <br>

<center><b><h4>Tareas ejecutadas</h4></b></center>           
<div class="form-group">
  <div class="row">
    <div class="col-md-12">
        <table id="1" class="table table-striped" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th class="text-center"> Fecha </th>
                <th class="text-center"> Ubicacion </th>
                <th class="text-center"> Personal </th>
                <th class="text-center"> Riego (m3) </th>
                <th class="text-center"> Riego (Tn) </th>
                <th class="text-center"> Asfalto (m2) </th>
                <th class="text-center"> Asfalto (Tn) </th>
                <th class="text-center"> Proveedor </th>
                <th class="text-center"> Registro </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($obra_bacheo as $bacheo):?>
                <tr>
                  <td class="text-center"> <?php echo format_date($bacheo['fecha']); ?></td>
                  <td> <?php echo $bacheo['ubicacion']; ?></td>
                  <td> <?php echo $bacheo['personal']; ?></td>
                  <td class="text-center"> <?php echo $bacheo['riego-m3']; ?></td>
                  <td class="text-center"> <?php echo $bacheo['riego-tn']; ?></td>
                  <td class="text-center"> <?php echo $bacheo['asfalto-m2']; ?></td>
                  <td class="text-center"> <?php echo $bacheo['asfalto-tn']; ?></td>
                  <td> <?php echo $bacheo['proveedor']; ?></td>
                  <td class="text-center"> <?php echo format_date($bacheo['registro_fecha']).''.user_name($bacheo['registro_usuario']); ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
        </table>
  </div>
</div>
</div>
<?php } ?>
<br>
<div class="row">
<div class="col-md-12">
<?php if(!empty($obra['obs'])){ echo '<hr><b>Observaciones:</b><br> '.textarea($obra['observaciones']).'<hr>';} ?>
</div>
</div>
<div class="row">
<div class="col-md-12">
  <b>Memoria descriptiva:</b><br />
<?php echo textarea($obra['memoria_descriptiva']); ?>
</div>
</div>
<br>


<?php if(isset($modificaciones_de_obra)){
foreach($modificaciones_de_obra as $modificacion): 
 if(ifexist($modificacion['expediente'])){  $ul_mov_exp = ul_mov_exp($modificacion['expediente']); }
?>
<div class="form-group">
<div class="row">
<div class="col-12">
<b><?php echo $modificacion['numero'].'° Modificacion'; ?></b><br />
<?php echo '<b>Expediente N°</b> '.$modificacion['expediente'].'<br />'; ?>
<?php if(ifexist($modificacion['expediente'])){ echo '<b>Ubicacion del tramite:</b> '.format_date($ul_mov_exp['fecha']); ?> en <b><?php echo utf8_encode($ul_mov_exp['tramite']); }?></b><br />
<?php if(ifexist($modificacion['resolucion_numero'])){ echo 'Resolucion N° '.$modificacion['resolucion_numero'];}
if(ifexist($modificacion['resolucion_fecha'])){ echo ' el '.$modificacion['resolucion_fecha'];} ?><br />
<?php if(ifexist($modificacion['estado'])){ ?>
<b>Estado:</b> 
<?php if($modificacion['estado'] == 0){ echo 'Sin definir';} 
if($modificacion['estado'] == 1){ echo 'Confeccion Inspeccion';}
if($modificacion['estado'] == 2){ echo 'Revision Dpto. II Obras por contrato';}
if($modificacion['estado'] == 3){ echo 'Autorizando Ing. Jefe';}
if($modificacion['estado'] == 4){ echo 'Encuadre Legal';}
if($modificacion['estado'] == 5){ echo 'Imputacion del gasto';}
if($modificacion['estado'] == 6){ echo 'Confeccionando resolucion';}
if($modificacion['estado'] == 7){ echo 'Resolucion aprobada';} ?><br />
<b>Avance del tramite:</b> <?php if(!empty($modificacion['estado'])){ echo round($modificacion['estado']*100/7). ' %';}else{ echo '0 %';} ?><br />
<?php } ?>
<?php if(ifexist($modificacion['descripcion'])){ ?>
<b>Descripcion</b><br />
<?php echo textarea($modificacion['descripcion']); } ?>
</div>
</div>
</div>
<?php endforeach; } ?>
<?php if(isset($ampliaciones_de_obra)){
foreach($ampliaciones_de_obra as $ampliacion): 
 if(ifexist($ampliacion['expediente'])){  $ul_mov_exp = ul_mov_exp($ampliacion['expediente']);} ?>
<div class="form-group">
<div class="row">
<div class="col-12">
<b><?php echo $ampliacion['numero'].'° Ampliacion'; ?></b><br />
<?php echo '<b>Expediente N°</b> '.$ampliacion['expediente'].'<br />'; ?>
<?php if(ifexist($ampliacion['expediente'])){ echo '<b>Ubicacion del tramite:</b> '.format_date($ul_mov_exp['fecha']); ?> en <b><?php echo $ul_mov_exp['tramite']; }?></b><br />
<?php if(ifexist($ampliacion['resolucion_numero'])){ echo 'Resolucion N° '.$ampliacion['resolucion_numero'];}
if(ifexist($ampliacion['resolucion_fecha'])){ echo ' el '.$ampliacion['resolucion_fecha'];} ?><br />
<?php if(ifexist($ampliacion['estado'])){ ?>
<b>Estado:</b> 
<?php if($ampliacion['estado'] == 0){ echo 'Sin definir';} 
if($ampliacion['estado'] == 1){ echo 'Confeccion Inspeccion';}
if($ampliacion['estado'] == 2){ echo 'Revision Dpto. II Obras por contrato';}
if($ampliacion['estado'] == 3){ echo 'Autorizando Ing. Jefe';}
if($ampliacion['estado'] == 4){ echo 'Encuadre Legal';}
if($ampliacion['estado'] == 5){ echo 'Imputacion del gasto';}
if($ampliacion['estado'] == 6){ echo 'Confeccionando resolucion';}
if($ampliacion['estado'] == 7){ echo 'Resolucion aprobada';} ?><br />
<b>Avance del tramite:</b> <?php if(!empty($ampliacion['estado'])){ echo round($ampliacion['estado']*100/7). ' %';}else{ echo '0 %';} ?><br />
<?php } ?>
<?php if(ifexist($ampliacion['descripcion'])){ ?>
<b>Descripcion</b><br />
<?php echo textarea($ampliacion['descripcion']); } ?>
</div>
</div>
</div>
<?php endforeach; } ?>

<?php if(isset($neutralizaciones_de_obra)){
foreach($neutralizaciones_de_obra as $neutralizacion):
 if(ifexist($neutralizacion['expediente'])){  $ul_mov_exp = ul_mov_exp($neutralizacion['expediente']); } ?>
<div class="form-group">
<div class="row">
<div class="col-12">
<b><?php echo $neutralizacion['numero'].'° Neutralizacion'; ?></b><br />
<?php echo '<b>Expediente N°</b> '.$neutralizacion['expediente'].'<br />'; ?>
<?php if(ifexist($neutralizacion['expediente'])){ echo '<b>Ubicacion del tramite:</b> '.format_date($ul_mov_exp['fecha']); ?> en <b><?php echo $ul_mov_exp['tramite']; }?></b><br />
<?php if(ifexist($neutralizacion['resolucion_numero'])){ echo 'Resolucion N° '.$neutralizacion['resolucion_numero'];}
if(ifexist($neutralizacion['resolucion_fecha'])){ echo ' el '.$neutralizacion['resolucion_fecha'];} ?><br />
<?php if(ifexist($neutralizacion['estado'])){ ?>
<b>Estado:</b> 
<?php if($neutralizacion['estado'] == 0){ echo 'Sin definir';} 
if($neutralizacion['estado'] == 1){ echo 'Confeccion Inspeccion';}
if($neutralizacion['estado'] == 2){ echo 'Revision Dpto. II Obras por contrato';}
if($neutralizacion['estado'] == 3){ echo 'Autorizando Ing. Jefe';}
if($neutralizacion['estado'] == 4){ echo 'Encuadre Legal';}
if($neutralizacion['estado'] == 5){ echo 'Imputacion del gasto';}
if($neutralizacion['estado'] == 6){ echo 'Confeccionando resolucion';}
if($neutralizacion['estado'] == 7){ echo 'Resolucion aprobada';} ?><br />
<b>Avance del tramite:</b> <?php if(!empty($neutralizacion['estado'])){ echo round($neutralizacion['estado']*100/7). ' %';}else{ echo '0 %';} ?><br />
<?php } ?>
<?php if(ifexist($neutralizacion['descripcion'])){ ?>
<b>Descripcion</b><br />
<?php echo textarea($neutralizacion['descripcion']); } ?>
</div>
</div>
</div>
<?php endforeach; } ?> 
<?php }
if($obra['estado'] == 3){ ?>

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


<b>Plazo de garantia:</b> <?php echo $obra['plazo_garantia']; ?><br />
</div>
</div>
<br>

<div class="row">
<div class="col-md-12">
  <b>Memoria descriptiva:</b><br />
<?php echo textarea($obra['memoria_descriptiva_vigente']); ?>
</div>
</div>




  <?php } ?>
</body>
</html>