<?php
require_once('../../includes/load.php');
$obras_construcciones_modificaciones = obras_construcciones_modificaciones($user['iddepartamentos']);
  $total = conteo_modificaciones('idmodificaciones');
  $total_monto = sumar_todo('monto','obras_modificaciones',1,'');
cabecera_print_horizontal('Planillas de modificaciones de obras');
?>
<div class="panel-body">
<div class="row">
<div class="col-md-12">
  <center>
    <b>
      <h4>Planillas de Modificaciones de obras</h4>
    </b>
  </center>
</div>
<br>
<div class="table-responsive">
      <table class="table table-border" width="100%">
        <thead>
          <tr>
              <th class="theader" style="font-size:70%;" width="10%">Nº Modificacion</th>
              <th class="theader" style="font-size:70%;" width="10%">Expediente</th>
              <th class="theader" style="font-size:70%;" width="10%">Titulo</th>
              <th class="theader" style="font-size:70%;" width="10%">Expediente madre</th>
              <th class="theader" style="font-size:70%;" width="10%">Contratista</th>
              <th class="theader" style="font-size:70%;" width="10%">Monto vigente</th>
              <th class="theader" style="font-size:70%;" width="10%">Estado del tramite</th>
              <th class="theader" style="font-size:70%;" width="10%">Avance del tramite</th>
              <th class="theader" style="font-size:70%;" width="10%">Resolucion</th>
              <th class="theader" style="font-size:70%;" width="10%">Ubicacion del tramite</th>
              <th class="theader" style="font-size:70%;" width="10%">Computo</th>
              <th class="theader" style="font-size:70%;" width="10%">Precios</th>
              <th class="theader" style="font-size:70%;" width="10%">Observaciones</th>
          </tr>
        </thead>
        <tbody>
                  <?php foreach ($obras_construcciones_modificaciones as $modificacion):
                    $ver_id=(int)$modificacion['idobras'];              
                    if(!empty($modificacion['expediente'])){ $ul_mov_exp = ul_mov_exp($modificacion['expediente']); }
                    ?>
           <tr>
              <td style="font-size:60%;"><?php if(!empty($modificacion['numero'])){ echo $modificacion['numero'];}else{echo '';} ?></td>
              <td style="font-size:60%;"><?php if(!empty($modificacion['expediente'])){ echo clean($modificacion['expediente']);}else{echo '';} ?></td>
              <td style="font-size:60%;"><?php echo clean($modificacion['nombre']); ?></td>
              <td style="font-size:60%;"><?php echo clean($modificacion['expediente_obra']); ?></td>
              <td style="font-size:60%;"><?php echo $modificacion['contratista']; ?></td>
              <td style="font-size:60%;"><?php if(!empty($modificacion['monto'])){ echo '$ '.numero($modificacion['monto']);}else{ echo '';} ?></td>
              <td style="font-size:60%;"><?php if(!isset($modificacion['estado'])){ echo 'No hay datos';} 
                        if($modificacion['estado'] == 1){ echo 'Confeccion Inspeccion';}
                        if($modificacion['estado'] == 2){ echo 'Revision Dpto. II Obras por contrato';}
                        if($modificacion['estado'] == 3){ echo 'Autorizando Ing. Jefe';}
                        if($modificacion['estado'] == 4){ echo 'Encuadre Legal';}
                        if($modificacion['estado'] == 5){ echo 'Imputacion del Gasto';}
                        if($modificacion['estado'] == 6){ echo 'Confeccionando Resolucion';}
                        if($modificacion['estado'] == 7){ echo 'Resolucion aprobada';}
                        ?></td>
              <td style="font-size:60%;"><?php if(isset($modificacion['estado'])){ echo round($modificacion['estado']*100/7).' %'; } else { echo '0 %';} ?></td> 
                  <td style="font-size:60%;"><?php if(!empty($modificacion['resolucion_fecha']) || !empty($modificacion['resolucion_numero'])){ 
                          echo $modificacion['resolucion_fecha'].' Resolucion Nº '.$modificacion['resolucion_numero'];} ?></td>
                          <td class="text-center"><?php if(!empty($modificacion['expediente'])){ echo format_date($ul_mov_exp['fecha']); ?> en <b><?php echo $ul_mov_exp['tramite']; }?></b></td>
                          <td style="font-size:60%;"><?php 
                        if($modificacion['computo_estado'] == 0){ echo '<span class="text-danger" data-toggle="tooltip" data-original-title="Sin recibir"><i class="mdi mdi-close"></i> Sin recibir</span>';} 
                        if($modificacion['computo_estado'] == 1){ echo '<span class="text-warning" data-toggle="tooltip" data-original-title="Recibido"><i class="mdi mdi-check"></i> Recibido</span>';}
                        if($modificacion['computo_estado'] == 2){ echo '<span class="text-warning" data-toggle="tooltip" title="" style="cursor:default;" data-original-title="Empresa"><i class="mdi mdi-clock"></i> Empresa</span>';}
                        if($modificacion['computo_estado'] == 3){ echo '<span class="text-success" data-toggle="tooltip" title="" style="cursor:default;" data-original-title="Aprobado"><i class="mdi mdi-check-all"></i> Aprobado</span>';}
                        if($modificacion['computo_fecha'] != '0000-00-00'){echo ' desde '.format_date($modificacion['computo_fecha']); } ?></td>
                          <td style="font-size:60%;"><?php 
                        if($modificacion['precios_estado'] == 0){ echo '<span class="text-danger" data-toggle="tooltip" title="" style="cursor:default;" data-original-title="Sin recibir"><i class="mdi mdi-close"></i> Sin recibir</span>';} 
                        if($modificacion['precios_estado'] == 1){ echo '<span class="text-warning" data-toggle="tooltip" title="" style="cursor:default;" data-original-title="Recibido"><i class="mdi mdi-check"></i> Recibido</span>';}
                        if($modificacion['precios_estado'] == 2){ echo '<span class="text-warning" data-toggle="tooltip" title="" style="cursor:default;" data-original-title="Empresa"><i class="mdi mdi-clock"></i> Empresa</span>';}
                        if($modificacion['precios_estado'] == 3){ echo '<span class="text-success" data-toggle="tooltip" title="" style="cursor:default;" data-original-title="Aprobado"><i class="mdi mdi-check-all"></i> Aprobado</span>';}
                        if($modificacion['precios_fecha'] != '0000-00-00'){echo ' desde '.format_date($modificacion['precios_fecha']); } ?></td>
                          <td style="font-size:60%;"><?php echo textarea($modificacion['observaciones']); ?></td>
          </tr>
        <?php endforeach; ?>
        </tbody>
          <!--<tfoot>
            <tr style="border-top:1px double #000; border-bottom: 1px solid #fff; border-left:1px solid #fff; border-right: 1px solid #fff;">
            <td colspan="2"><b>Total: <?php if($total['total'] > '1'){ echo $total['total'].' Modificaciones'; }else{ echo $total['total'].' Modificacion'; } ?></b> </td>
            <td colspan="3" style="text-align:right;">Total:</td>
            <td colspan="2" > <?php echo '$ '.numero($total_monto['total']);?></td>
            <td colspan="1" style="text-align:left;"></td>
            <td colspan="4" style="text-align:right;"></td>
          </tr>
        </tfoot>-->
      </table>
  </div>
</div>
</div>
</div>
</div>
</body>
</html>