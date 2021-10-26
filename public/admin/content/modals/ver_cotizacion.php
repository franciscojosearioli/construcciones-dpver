<?php
require_once('../../includes/load.php');
$get_id = $_POST['id'];
$user = current_user();
$cotizacion = find_by_id('cotizaciones','idcotizaciones',$get_id);
$obra = find_by_id('obras','idobras',$cotizacion['idobras']);
$items_obras = rows_cotizaciones_obras($cotizacion['idobras'],$cotizacion['idcotizaciones']);
?>
<div class="modal fade" id="ver_cotizacion" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Planilla de cotizacion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body p-4">

            <div class="container">
            </div>
<div class="container">
                    <div class="card-body">
                    <h4>Cotizacion N <?php echo $cotizacion['numero']; ?></h4>
                    <p>Detalle <?php echo $cotizacion['detalle']; ?></p>
            
                    <h5><?php echo $obra['nombre']; ?></h5>
                            </div>
                          </div>    
<table class="table table-striped" cellspacing="0" width="100%" id="tabla_cotizacion">
            <thead>
              <tr>
              <th>Item</th>
            <th>Sub-Item</th>
            <th>Descripcion</th>
            <th>Unidad</th>
            <th>Cantidades</th>
            <th>Precio unitario</th>
            <th>Tipo</th>
              </tr>
            </thead>
            <tbody> 
        <?php foreach ($items_obras as $item): 
   
   if($item['unidad'] == 'No define'){ ?>
    <tr>
      <td><?php echo $item['item']; ?></td>
      <td></td>
      <td><?php echo $item['descripcion']; ?></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
  <?php }else{ ?>
          <tr>
            <td style="width: 10%"><?php echo $item['item']; ?></td>
            <td style="width: 10%"><?php echo $item['sub_item']; ?></td>
            <td style="width: 40%"><?php echo $item['descripcion']; ?></td>
            <td style="width: 8%"><?php echo $item['unidad']; ?></td>
            <td style="width: 18%"><input type="number" readonly name="cantidad[]"  value="<?php echo $item['cantidad_aprobada']; ?>" hidden><?php echo $item['cantidad_aprobada']; ?></td>
            <td style="width: 18%"><input type="number" readonly name="precio_unitario_items[]" value="<?php echo $item['precio_unitario']; ?>" hidden ><input type="number" readonly name="importe[]" class="importe" hidden>$ <?php echo numero($item['precio_unitario']); ?></td>
            <td style="width: 18%"><?php echo $item['tipo']; ?></td>
          </tr>
        <?php } endforeach; ?>      
        <tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td>TOTAL</td>
      <td><input type="number"  id="sum_total" name="total_importe" style="border:none;" readonly/></td>
      <td></td>
        </tr> 
              </tbody>
            </table>
            </div>
        </div>
    </div>
</div>
<script>
  

</script>