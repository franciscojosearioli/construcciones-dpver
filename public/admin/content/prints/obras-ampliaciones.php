<?php
require_once('../../includes/load.php');
$obras_construcciones_ampliaciones = obras_construcciones_ampliaciones($user['iddepartamentos']);
  $total = conteo_ampliaciones('idampliaciones');
cabecera_print_horizontal('Planillas de ampliaciones de obras');
?>
<div class="panel-body">
<div class="row">
<div class="col-md-12">
  <center>
    <b>
      <h4>Planillas de Ampliaciones de obras</h4>
    </b>
  </center>
</div>
<br>
<div class="table-responsive">
      <table class="table table-border" width="100%">
        <thead>
          <tr>
              <th class="theader" style="font-size:70%;" width="10%">Nº Ampliacion</th>
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
                  <?php foreach ($obras_construcciones_ampliaciones as $ampliacion):
                    $ver_id=(int)$ampliacion['idobras'];              
                    if(!empty($ampliacion['expediente'])){ $ul_mov_exp = ul_mov_exp($ampliacion['expediente']); }
                    ?>
           <tr>
              <td style="font-size:60%;"><?php if(!empty($ampliacion['numero'])){ echo $ampliacion['numero'];}else{echo '';} ?></td>
              <td style="font-size:60%;"><?php if(!empty($ampliacion['expediente'])){ echo clean($ampliacion['expediente']);}else{echo '';} ?></td>
              <td style="font-size:60%;"><?php echo clean($ampliacion['nombre']); ?></td>
              <td style="font-size:60%;"><?php echo clean($ampliacion['expediente_obra']); ?></td>
              <td style="font-size:60%;"><?php echo $ampliacion['contratista']; ?></td>
              <td style="font-size:60%;"><?php if(!empty($ampliacion['monto'])){ echo '$ '.numero($ampliacion['monto']);}else{ echo '';} ?></td>
              <td style="font-size:60%;"><?php if(!isset($ampliacion['estado'])){ echo 'No hay datos';} 
                        if($ampliacion['estado'] == 1){ echo 'Confeccion Inspeccion';}
                        if($ampliacion['estado'] == 2){ echo 'Revision Dpto. II Obras por contrato';}
                        if($ampliacion['estado'] == 3){ echo 'Autorizando Ing. Jefe';}
                        if($ampliacion['estado'] == 4){ echo 'Encuadre Legal';}
                        if($ampliacion['estado'] == 5){ echo 'Imputacion del Gasto';}
                        if($ampliacion['estado'] == 6){ echo 'Confeccionando Resolucion';}
                        if($ampliacion['estado'] == 7){ echo 'Resolucion aprobada';}
                        ?></td>
              <td style="font-size:60%;"><?php if(isset($ampliacion['estado'])){ echo round($ampliacion['estado']*100/7).' %'; } else { echo '0 %';} ?></td> 
                  <td style="font-size:60%;"><?php if(!empty($ampliacion['resolucion_fecha']) || !empty($ampliacion['resolucion_numero'])){ 
                          echo $ampliacion['resolucion_fecha'].' Resolucion Nº '.$ampliacion['resolucion_numero'];} ?></td>
                          <td class="text-center"><?php if(!empty($ampliacion['expediente'])){ echo format_date($ul_mov_exp['fecha']); ?> en <b><?php echo $ul_mov_exp['tramite']; }?></b></td>
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