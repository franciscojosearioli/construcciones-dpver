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
      <td><input type="number" name="cantidad[]" value="0.000" hidden></td>
      <td><input type="number" name="precio_unitario_items[]" hidden ></td>
      <td><input type="number" hidden name="importe[]" value="0.000"></td>
    </tr>
  <?php }else{ ?>
          <tr>
            <td style="width: 10%"><?php echo $item['item']; ?></td>
            <td style="width: 10%"><?php echo $item['sub_item']; ?></td>
            <td style="width: 40%"><?php echo $item['descripcion']; ?></td>
            <td style="width: 8%"><?php echo $item['unidad']; ?></td>
            <td style="width: 18%"><input type="number" readonly name="cantidad[]"  value="<?php echo $item['cantidad_aprobada']; ?>" ><?php echo $item['cantidad_aprobada']; ?></td>
            <td style="width: 18%"><input type="number" readonly name="precio_unitario_items[]" value="<?php echo $item['precio_unitario']; ?>"  >$ <?php echo numero($item['precio_unitario']); ?></td>
            <td style="width: 18%"><?php echo $item['tipo']; ?><input type="number" readonly name="importe[]" class="importe" ></td>
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
  
  $(document).ready(function(){



$(document).ready(function(){ 
    var cantidad = [];
    var precio_unitario = [];
    var importe = [];
    var importe_total = [];
    
  var suma_importe = 0;
  var input_importe = '';
  var suma_importe_total = 0;
  var input_importe_total = '';

  
  /*$('#tabla_items').find('tr#trindi').each(function() {
               var row = [];
               var flag = false;
               $(this).children().each(function() {
                   input_importe = $(this).find("input[name='importe[]']");
                   suma_importe = input_importe.val() + suma_importe;
               });             
              
  });
  $('#sum_total').html(suma_importe);
  */
    $('#tabla_cotizacion').find('tr#trindi').each(function(i) {
      var row_cantidad = [];
      var row_precio_unitario = [];
      var row_importe = [];

      var row_importe_total = [];
      //var input_importe = '';
      var flag = false;
      $(this).each(function() {
        var input_cantidad = $(this).find('input[name="cantidad[]"]');
        var input_precio_unitario = $(this).find('input[name="precio_unitario_items[]"]');
         input_importe = $(this).find('input[name="importe[]"]');
         input_importe_total = $(this).find('input[name="importe_total[]"]');
    //suma_importe = input_importe.val() + suma_importe;
        var suma = '';
                          


                   if (input_cantidad[0]) {
                       flag = true;
                       row_cantidad.push(input_cantidad.val());

                   } else {
                   row_cantidad.push($(this).text() );
                   }

                   if (input_precio_unitario[0]) {
                       flag = true;
                       row_precio_unitario.push(input_precio_unitario.val());
                    
                   } else {
                   row_precio_unitario.push($(this).text() );
                   }
                   
                   
                  if (input_importe[0]) {
                      flag = true;
                      suma = parseFloat(input_cantidad.val()) * parseFloat(input_precio_unitario.val());
                       row_importe.push(suma);
                    
                   } else {
                   row_importe.push($(this).text() );
                   
                   } 

                  if (input_importe_total[0]) {
                      flag = true;
                      row_importe_total.push(input_importe_total.val());
                   
                   } 
                    
                   if (flag) {   
                 cantidad.push(row_cantidad);
                 precio_unitario.push(row_precio_unitario);
                 importe.push(row_importe);
                 importe_total.push(row_importe_total);

               }
               
               
               
               
                 });
                 

                input_cantidad.val(cantidad[i]); 

                input_importe.val(parseFloat(cantidad[i])*parseFloat(precio_unitario[i]));

                input_importe_total.val(parseFloat(cantidad[i])*parseFloat(precio_unitario[i]));
                

    }); //FINAL $('#tabla_items').find('tr#trindi').each(function(i) {  
  
  $('#tabla_cotizacion').find('td').each(function() {      
    input_importe = parseFloat($(this).find('input[name="importe[]"]').val())||0;
    suma_importe = input_importe + suma_importe;     
    
  });

  $('#sum_total').val(suma_importe);

  });





});
</script>