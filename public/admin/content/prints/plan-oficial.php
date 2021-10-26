<?php
$id=$_GET['id'];
$results = '';
require_once('../../includes/load.php');
$obra = find_by_id('obras','idobras',$id);  
$certificados_plan = plan_oficial_obras($id);
cabecera_print_vertical('Plan oficial de obra');
?>
<div class="row">
<div class="col-md-12">
  <center>
    <b>
      <h4>Plan oficial: <?php echo $obra['nombre']; ?></h4>
    </b>
  </center>
</div>
<br>
<div class="table-responsive">
      <table class="table table-border" width="100%">
        <thead>
          <tr>
              <th class="theader" style="font-size:70%;" width="10%">Nº</th>
              <th class="theader" style="font-size:70%;" width="10%">Avance</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($certificados_plan as $c_plan):?>
           <tr>
              <td style="font-size:60%;"><?php echo clean($c_plan['numero']); ?></td>
              <td style="font-size:60%;"><?php echo clean($c_plan['avance']); ?> %</td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
  </div>
  </div>
</body>
</html>