<?php
$id=$_GET['id'];
$results = '';
require_once('../../includes/load.php');
$obra = find_by_id('obras','idobras',$id);  
$planoficial_obras = listar_planoficial_obras($id);
cabecera_print_horizontal('Planilla de plan de trabajo');
?>
<div class="row justify-content-center">
<div class="text-center">
      Planilla de plan de trabajo
    <h4>OBRA: <?php echo $obra['nombre']; ?></h4>
</div>
</div>
<div class="row justify-content-center">

<div class="table-responsive" >  
<table class="table table-bordered no-wrap">
<thead>
          <tr>
            <th>Numero</th>
            <th>Monto</th>
            <th>Avance</th>
          </tr>
</thead>
<tbody>
<?php if(isset($planoficial_obras)){  
 foreach ($planoficial_obras as $fila): ?>

          <tr>
            <td style="width: 5%"><?php echo $fila['numero']; ?></td>
            <td style="width: 5%"><?php echo $fila['monto']; ?></td>
            <td style="width: 30%"><?php echo $fila['avance']; ?></td>
          </tr>
        <?php endforeach; ?>
<?php } ?>
</tbody>
</table>
</div>



</div>

