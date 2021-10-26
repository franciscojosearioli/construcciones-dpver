<?php
require_once('../../includes/load.php');
$obras_construcciones_neutralizaciones = obras_construcciones_neutralizaciones($user['iddepartamentos']);
  $total = conteo_neutralizaciones('idneutralizaciones');
cabecera_print_horizontal('Planillas de neutralizaciones de obras');
?>
<div class="panel-body">
<div class="row">
<div class="col-md-12">
  <center>
    <b>
      <h4>Planillas de Neutralizaciones de obras</h4>
    </b>
  </center>
</div>
<br>
<div class="table-responsive">
      <table class="table table-border" width="100%">
        <thead>
          <tr>
              <th class="theader" style="font-size:70%;" width="10%">Nº Neutralizacion</th>
              <th class="theader" style="font-size:70%;" width="10%">Expediente</th>
              <th class="theader" style="font-size:70%;" width="10%">Titulo</th>
              <th class="theader" style="font-size:70%;" width="10%">Expediente madre</th>
              <th class="theader" style="font-size:70%;" width="10%">Contratista</th>
              <th class="theader" style="font-size:70%;" width="10%">Monto vigente</th>
              <th class="theader" style="font-size:70%;" width="10%">Estado del tramite</th>
              <th class="theader" style="font-size:70%;" width="10%">Avance del tramite</th>
              <th class="theader" style="font-size:70%;" width="10%">Resolucion</th>
              <th class="theader" style="font-size:70%;" width="10%">Ubicacion del tramite</th>
          </tr>
        </thead>
        <tbody>
                  <?php foreach ($obras_construcciones_neutralizaciones as $neutralizacion):
                    $ver_id=(int)$neutralizacion['idobras'];              
                    if(!empty($neutralizacion['expediente'])){ $ul_mov_exp = ul_mov_exp($neutralizacion['expediente']); }
                    ?>
           <tr>
              <td style="font-size:60%;"><?php if(!empty($neutralizacion['numero'])){ echo $neutralizacion['numero'];}else{echo '';} ?></td>
              <td style="font-size:60%;"><?php if(!empty($neutralizacion['expediente'])){ echo clean($neutralizacion['expediente']);}else{echo '';} ?></td>
              <td style="font-size:60%;"><?php echo clean($neutralizacion['nombre']); ?></td>
              <td style="font-size:60%;"><?php echo clean($neutralizacion['expediente_obra']); ?></td>
              <td style="font-size:60%;"><?php echo $neutralizacion['contratista']; ?></td>
              <td style="font-size:60%;"><?php if(!empty($neutralizacion['monto'])){ echo '$ '.numero($neutralizacion['monto']);}else{ echo '';} ?></td>
              <td style="font-size:60%;"><?php if(!isset($neutralizacion['estado'])){ echo 'No hay datos';} 
                        if($neutralizacion['estado'] == 1){ echo 'Confeccion Inspeccion';}
                        if($neutralizacion['estado'] == 2){ echo 'Revision Dpto. II Obras por contrato';}
                        if($neutralizacion['estado'] == 3){ echo 'Autorizando Ing. Jefe';}
                        if($neutralizacion['estado'] == 4){ echo 'Encuadre Legal';}
                        if($neutralizacion['estado'] == 5){ echo 'Imputacion del Gasto';}
                        if($neutralizacion['estado'] == 6){ echo 'Confeccionando Resolucion';}
                        if($neutralizacion['estado'] == 7){ echo 'Resolucion aprobada';}
                        ?></td>
              <td style="font-size:60%;"><?php if(isset($neutralizacion['estado'])){ echo round($neutralizacion['estado']*100/7).' %'; } else { echo '0 %';} ?></td> 
                  <td style="font-size:60%;"><?php if(!empty($neutralizacion['resolucion_fecha']) || !empty($neutralizacion['resolucion_numero'])){ 
                          echo $neutralizacion['resolucion_fecha'].' Resolucion Nº '.$neutralizacion['resolucion_numero'];} ?></td>
                          <td class="text-center"><?php if(!empty($neutralizacion['expediente'])){ echo format_date($ul_mov_exp['fecha']); ?> en <b><?php echo $ul_mov_exp['tramite']; }?></b></td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
  </div>
</div>
</div>
</div>
</div>
</body>
</html>