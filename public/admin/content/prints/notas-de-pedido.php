<?php
$id=$_GET['id'];
$results = '';
require_once('../../includes/load.php');
$obra = find_by_id('obras','idobras',$id);  
$notas = notas_de_pedido($id);
cabecera_print_vertical('Notas de pedido de obra');
?>
<div class="row">
<div class="col-md-12">
  <center>
    <b>
      <h4>Notas de pedido: <?php echo $obra['nombre']; ?></h4>
    </b>
  </center>
</div>
<br>
<div class="table-responsive">
      <table class="table table-border" width="100%">
        <thead>
          <tr>
              <th class="theader" style="font-size:70%;" width="10%">Nº</th>
              <th class="theader" style="font-size:70%;" width="10%">Asunto</th>
              <th class="theader" style="font-size:70%;" width="10%">Archivo</th>
              <th class="theader" style="font-size:70%;" width="10%">Fecha</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($notas as $not):?>
           <tr>
              <td style="font-size:60%;"><?php echo clean($not['numero']); ?></td>
              <td style="font-size:60%;"><?php echo clean($not['asunto']); ?></td>
              <td style="font-size:60%;"><?php if(isset($not['archivo'])){ echo 'Cargado'; }else{ echo 'Sin cargar'; }  ?></td>
              <td style="font-size:60%;"><?php echo format_date($not['registro_fecha']); ?></td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
  </div>
  </div>
</body>
</html>