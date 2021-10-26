<?php
$id=$_GET['id'];
$results = '';
require_once('../../includes/load.php');
$obra = find_by_id('obras','idobras',$id);  
$items_obras = listar_items_obras($id);
cabecera_print_horizontal('Planilla de cotizacion');
?>
<div class="row justify-content-center">
<div class="text-center">
      Planilla de cotizacion
    <h4>OBRA: <?php echo $obra['nombre']; ?></h4>
</div>
</div>
<div class="row justify-content-center">

<div class="table-responsive" >  
<table class="table table-bordered no-wrap">
<thead>
          <tr>
            <th>Item</th>
            <th>Sub-Item</th>
            <th>Descripcion</th>
            <th>Unidad</th>
            <th>Cantidades</th>
            <th>Precio unitario</th>
          </tr>
</thead>
<tbody>
<?php if(isset($items_obras)){  
    foreach ($items_obras as $item): ?>

          <tr>
            <td style="width: 5%"><?php echo $item['item']; ?></td>
            <td style="width: 5%"><?php echo $item['sub_item']; ?></td>
            <td style="width: 30%"><?php echo $item['descripcion']; ?></td>
            <td style="width: 5%"><?php if($item['unidad'] != 'No define'){ echo $item['unidad']; } ?></td>
            <td style="width: 18%"><?php if($item['cantidad_aprobada'] != '0.000'){ echo $item['cantidad_aprobada']; } ?></td>
            <td style="width: 18%"><?php if($item['precio_unitario'] != '0.000'){ echo $item['precio_unitario']; } ?></td>
          </tr>
        <?php endforeach; ?>
<?php } ?>
</tbody>
</table>
</div>



</div>


