<?php
require_once('../../includes/load.php');
  $results =  obras_construcciones_finalizadas();
  $total = conteo_obras_finalizadas('obras','idobras');
  $total_monto_actualizado = sumar_todo('monto_redeterminado','obras',1,'AND idtipo = 0');
  $total_monto_ejecutado = sumar_todo('certificado_monto','obras',1,'AND idtipo = 0');
cabecera_print_horizontal('Planillas de obras');
?>
<div class="panel-body">
<div class="row">
<div class="col-md-12">
  <center>
    <b>
      <h4>Planillas de obras: Finalizadas</h4>
    </b>
  </center>
</div>
<br>
<div class="table-responsive">
      <table class="table table-border" width="100%">
        <thead>
          <tr>
              <th class="theader" style="font-size:70%;" width="10%">Titulo</th>
              <th class="theader" style="font-size:70%;" width="10%">Descripcion</th>
              <th class="theader" style="font-size:70%;" width="10%">Dpto.</th>
              <th class="theader" style="font-size:70%;" width="10%">Contratista</th>
              <th class="theader" style="font-size:70%;" width="10%">Monto vigente</th>
              <th class="theader" style="font-size:70%;" width="10%">Monto actualizado</th>
              <th class="theader" style="font-size:70%;" width="10%">Plazo vigente</th>
              <th class="theader" style="font-size:70%;" width="10%">Inicio</th>
              <th class="theader" style="font-size:70%;" width="10%">Certificado</th>
              <th class="theader" style="font-size:70%;" width="10%">Monto ejecutado</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($results as $p): ?>
           <tr>
              <td style="font-size:60%;"><?php echo ifexist($p['nombre']);?></td>
              <td style="font-size:60%;"><?php echo ifexist($p['descripcion']);?></td>
              <td style="font-size:60%;"><?php echo ifexist($p['ubicacion']);?></td>
              <td style="font-size:60%;"><?php echo ifexist($p['contratista']);?></td>
              <td style="font-size:60%;"><?php 
                  if(ifexist($p['monto_vigente'])){ echo '$ '.numero($p['monto_vigente']);
                }elseif(ifexist($p['contrato_monto'])){
                  echo '$ '.numero($p['contrato_monto']);} 
                  ?></td>
              <td style="font-size:60%;"><?php 
                  if(ifexist($p['monto_redeterminado'])){ echo '$ '.numero($p['monto_redeterminado']);}
                  ?></td>
              <td style="font-size:60%;"><?php 
                  if(ifexist($p['plazo_vigente'])){ echo $p['plazo_vigente'];
                }elseif(ifexist($p['contrato_plazo'])){
                  echo $p['contrato_plazo'];} 
                  ?></td>
              <td style="font-size:60%;"><?php echo ifexist($p['fecha_inicio']); ?></td>
              <td style="font-size:60%;"><?php if(ifexist($p['certificado_numero'])){ echo 'Nº '.$p['certificado_numero'].' a '.$p['certificado_porcentaje'].' % <br>('.$p['certificado_fecha'].')';}?></td>
              <td style="font-size:60%;"><?php 
                  if(!empty($p['certificado_monto'])){ echo '$ '.numero($p['certificado_monto']);
                }else{
                  echo 'No hay datos';} 
                  ?></td> 
          </tr>
        <?php endforeach; ?>
        </tbody>
          <!--<tfoot>
            <tr style="border-top:1px double #000; border-bottom: 1px solid #fff; border-left:1px solid #fff; border-right: 1px solid #fff;">
            <td colspan="3"><b>Total: <?php if($total['total'] > '1'){ echo $total['total'].' Obras'; }else{ echo $total['total'].' Obra'; } ?></b> </td>
            <td colspan="1" style="text-align:right;">Total:</td>
            <td colspan="2" > <?php echo '$ '.numero($total_monto_actualizado['total']);?></td>
            <td colspan="1" style="text-align:left;"></td>
            <td colspan="1" style="text-align:right;">Total:</td>
            <td colspan="2" style="text-align:left;"><?php echo '$ '.numero($total_monto_ejecutado['total']);?></td>
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