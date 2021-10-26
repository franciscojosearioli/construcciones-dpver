<?php
require_once('../../includes/load.php');
$user = current_user();
$recepciones_definitivas_construcciones = recepciones_definitivas_construcciones($user['iddepartamentos']);
$total = conteo_recepciones_definitivas('recepciones_definitivas','idrecepciones_definitivas');
cabecera_print_horizontal('Planillas de recepciones definitivas');
?>
<div class="panel-body">
<div class="row">
<div class="col-md-12">
  <center>
    <b>
      <h4>Planillas de recepciones definitivas</h4>
    </b>
  </center>
</div>
<br>
<div class="table-responsive">
      <table class="table table-border" width="100%">
        <thead>
          <tr>
              <th class="theader" style="font-size:70%;" width="10%">Expediente</th>
              <th class="theader" style="font-size:70%;" width="10%">Obra</th>
              <th class="theader" style="font-size:70%;" width="10%">Expediente Obra</th>
              <th class="theader" style="font-size:70%;" width="10%">Fecha pedido</th>
              <th class="theader" style="font-size:70%;" width="10%">Resolucion de integrantes</th>
              <th class="theader" style="font-size:70%;" width="10%">Integrantes</th>
              <th class="theader" style="font-size:70%;" width="10%">Acta / Resolucion</th>
              <th class="theader" style="font-size:70%;" width="10%">Observaciones</th>
          </tr>
        </thead>
        <tbody>
                    <?php foreach ($recepciones_definitivas_construcciones as $recepcion):
                      $obra = find_by_name($recepcion['nombre_obras']);
                      ?>
           <tr>
              <td style="font-size:60%;"><?php echo ifexist($recepcion['expediente']);?></td>
              <td style="font-size:60%;"><?php 
                        if(!empty($recepcion['obra'])){ echo $recepcion['obra']; } else{ echo $obra['nombre']; } ?></td>
              <td style="font-size:60%;"><?php if(!empty($recepcion['expediente_obra'])){ echo $recepcion['expediente_obra']; } else { echo $obra['expediente']; }  ?></td>
              <td style="font-size:60%;"><?php echo format_date($recepcion['fecha_pedido']); ?></td>
              <td style="font-size:60%;"><?php if(!empty($recepcion['integrantes_resolucion_num']) || !empty($recepcion['integrantes_resolucion_fecha'])){ ?><b>Nº <?php echo $recepcion['integrantes_resolucion_num']; ?></b> el <b><?php echo format_date($recepcion['integrantes_resolucion_fecha']); ?></b><?php } ?></td>
              <td style="font-size:60%;"><?php echo str_replace(PHP_EOL,', ',$recepcion['integrantes']); ?></td>
              <td style="font-size:60%;"><?php if(!empty($recepcion['acta_resolucion']) || !empty($p['acta_fecha'])){ ?><b>Nº <?php echo $recepcion['acta_resolucion']; ?></b> el <b><?php echo format_date($recepcion['acta_fecha']); ?></b><?php } ?></td>
              <td style="font-size:60%;"><?php echo $recepcion['observaciones']; ?></td>
          </tr>
        <?php endforeach; ?>
        </tbody>
          <!--<tfoot>
            <tr style="border-top:1px double #000; border-bottom: 1px solid #fff; border-left:1px solid #fff; border-right: 1px solid #fff;">
            <td colspan="5"><b>Total: <?php if($total['total'] > '1'){ echo $total['total'].' Recepciones'; }else{ echo $total['total'].' Recepcion'; } ?></b> </td>
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