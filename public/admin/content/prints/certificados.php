<?php
$id=$_GET['id'];
$results = '';
require_once('../../includes/load.php');
$obra = find_by_id('obras','idobras',$id);  
$certificados = certificados_obras($id);
cabecera_print_vertical('Certificados de obra');
?>
<div class="row">
<div class="col-md-12">
  <center>
    <b>
      <h4>Certificados: <?php echo $obra['nombre']; ?></h4>
    </b>
  </center>
</div>
<br>
<div class="table-responsive">
      <table class="table table-border" width="100%">
        <thead>
          <tr>
              <th class="theader" style="font-size:70%;" width="10%">Nº</th>
              <th class="theader" style="font-size:70%;" width="10%">Fecha</th>
              <th class="theader" style="font-size:70%;" width="10%">Monto</th>
              <th class="theader" style="font-size:70%;" width="10%">Avance</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($certificados as $c):?>
           <tr>
              <td style="font-size:60%;"><?php echo clean($c['numero']); ?></td>
              <td style="font-size:60%;"><?php echo clean($c['fecha']); ?></td>
              <td style="font-size:60%;">$ <?php echo numero($c['manto']); ?></td>
              <td style="font-size:60%;"><?php echo clean($c['avance']); ?> %</td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
  </div>
  </div>
</body>
</html>