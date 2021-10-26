<?php
$id=$_GET['id'];
$results = '';
require_once('../../includes/load.php');
$obra = find_by_id('obras','idobras',$id);  
$certificados_adec = certificados_redeterminados_obras($id);
cabecera_print_vertical('Certificados redeterminados de obra');
?>
<div class="row">
<div class="col-md-12">
  <center>
    <b>
      <h4>Certificados redeterminados: <?php echo $obra['nombre']; ?></h4>
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
              <th class="theader" style="font-size:70%;" width="10%">Provisorio</th>
              <th class="theader" style="font-size:70%;" width="10%">Definitivo</th>
              <th class="theader" style="font-size:70%;" width="10%">Adecuacion</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($certificados_adec as $c_adec):?>
           <tr>
              <td style="font-size:60%;"><?php echo clean($c_adec['numero']); ?></td>
              <td style="font-size:60%;"><?php echo clean($c_adec['fecha']); ?></td>
              <td style="font-size:60%;"><?php if(!empty($c_adec['monto_provisorio'])){ echo '$ '.numero($c_adec['monto_provisorio']);} ?></td>
              <td style="font-size:60%;"><?php if(!empty($c_adec['monto_definitivo'])){ echo '$ '.numero($c_adec['monto_definitivo']);} ?></td>
              <td style="font-size:60%;"><?php echo clean($c_adec['informacion']); ?></td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
  </div>
  </div>
</body>
</html>