<?php
$id=$_GET['id'];
$results = '';
require_once('../../includes/load.php');
$obra = find_by_id('obras','idobras',$id);  
$ordenes = ordenes_de_servicio($id);
cabecera_print_vertical('Ordenes de servicio de obra');
?>
<div class="row">
<div class="col-md-12">
  <center>
    <b>
      <h4>Ordenes de Servicio: <?php echo $obra['nombre']; ?></h4>
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
          <?php foreach ($ordenes as $ord):?>
           <tr>
              <td style="font-size:60%;"><?php echo clean($ord['numero']); ?></td>
              <td style="font-size:60%;"><?php echo clean($ord['asunto']); ?></td>
              <td style="font-size:60%;"><?php if(isset($ord['archivo'])){ echo 'Cargado'; }else{ echo 'Sin cargar'; }  ?></td>
              <td style="font-size:60%;"><?php echo format_date($ord['registro_fecha']); ?></td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
  </div>
  </div>
</body>
</html>