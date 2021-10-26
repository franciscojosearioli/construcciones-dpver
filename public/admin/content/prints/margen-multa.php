<?php
$id=$_GET['id'];
$results = '';
require_once('../../includes/load.php');
$obra = find_by_id('obras','idobras',$id);  
$certificados_multa = plan_oficial_obras($id);
cabecera_print_vertical('Multa de obra');
?>
<div class="row">
<div class="col-md-12">
  <center>
    <b>
      <h4>Margen de multa: <?php echo $obra['nombre']; ?>
      <br>
      <?php if(!empty($obra['valormulta'])){ ?><center><b>Corresponde al valor: <span style="color:#007bff;"><?php echo $obra['valormulta']; ?></span></b></center><?php } ?>
    </h4>
    </b>
  </center>
</div>
<br>
<div class="table-responsive">
      <table class="table table-border" width="100%">
        <thead>
          <tr>
              <th class="theader" style="font-size:70%;" width="10%">Nº</th>
              <th class="theader" style="font-size:70%;" width="10%">Porcentaje</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($certificados_multa as $c_multa):?>
           <tr>
              <td style="font-size:60%;"><?php echo clean($c_multa['numero']); ?></td>
              <td style="font-size:60%;"><?php $porcentaje_multa = $c_multa['avance'] * $obra['valormulta']; echo $porcentaje_multa; ?> %</td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
  </div>
  </div>
</body>
</html>