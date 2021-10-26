<?php 
require_once('../../includes/load.php');
$obra_id=$_POST['obra_id'];
$cert_id=$_POST['cert_id'];
$tipo_red=$_POST['tipo_red'];
$user = current_user();
$obra = find_by_id('obras','idobras',(int)$_POST['obra_id']);  

$ultimo_provisorio = ultimo_acta_provisorio($obra_id);
$ultimo_definitivo = ultimo_acta_definitivo($obra_id);
if($tipo_red == 'provisorio'){ if(!empty($ultimo_provisorio)){ $items_obras = listar_precios_actas($obra_id,$cert_id,$ultimo_provisorio['idredeterminaciones_actas']); }else{ $items_obras = listar_restantes_certificados($obra_id,$cert_id); }}
if($tipo_red == 'definitivo'){ if(!empty($ultimo_definitivo)){ $items_obras = listar_precios_actas($obra_id,$cert_id,$ultimo_definitivo['idredeterminaciones_actas']); }else{ $items_obras = listar_restantes_certificados($obra_id,$cert_id); }}

?>
<?php if($tipo_red == "provisorio"){ ?>
  Indique un indice de precios a aplicar segun el tipo de item
  <div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12">Camino: <input type="number" name="valor_camino" min="1" id="items_camino" class="form-control"></div>
    <div class="col-lg-6 col-md-6 col-sm-12">Puente: <input type="number" name="valor_puente" min="1" id="items_puente" class="form-control"></div>
  </div>
<?php } ?>


        <div class="p-20">
        <div class="table-responsive">  
          <input type="text" name="idobras" hidden value="<?php echo $obra_id; ?>">
          <input type="text" name="tipo" value="<?php echo $tipo_red; ?>" hidden>
                    <input type="text" name="idobras_items_add" hidden>
<table class="table table-bordered no-wrap" id="tabla_acta_redeterminacion">
          <thead>
          <tr>
            <th>Item</th>
            <th>Sub-Item</th>
            <th>Descripcion</th>
            <th>Unidad</th>
            <th>Cantidades restantes</th>
            <th>Precios redeterminados definitivos</th>
            <th>Importe total</th>
            <!--<th>Tipo</th>-->
          </tr>
          </thead>
          



<tbody id="AddItems">
  <?php if(isset($items_obras)){ 
  

   ?>
<?php foreach ($items_obras as $item): ?>
    <?php if($item['unidad'] == 'No define'){ ?>
    <tr>
      <td><input value="<?php echo $item['idobras_items']; ?>" type="text" name="idobras_items[]" hidden><input type="text" class="form-control" name="item[]" value="<?php echo $item['item']; ?>" readonly></td>
      <td></td>
      <td><input type="text" class="form-control" name="descripcion[]" value="<?php echo $item['descripcion']; ?>" readonly></td>
      <td></td>
      <td></td>
      <td><input type="number" class="form-control" name="cantidad[]"  min="0.000" readonly hidden></td>
      <!--<td></td>-->
      <td>
              <input type="number" class="form-control" name="precio_unitario_fijo[]" step="any" readonly hidden>
              <input type="number" class="form-control" name="precio_unitario[]" step="any" readonly hidden></td>
      <td><input type="number" class="form-control" name="importe[]" step="any" readonly hidden></td>      
      <!--<td></td>-->
    </tr>
  <?php }else{ ?>
        <tr <?php if($tipo_red == 'definitivo'){ ?> id="trindi" <?php } ?><?php if($tipo_red == "provisorio"){if($item['tipo'] == 'Camino'){ ?>id="Camino"<?php }if($item['tipo'] == 'Puente'){ ?> id="Puente" <?php }} ?>>
            <td style="width: 10%">
            <input type="text" class="form-control" name="idobras_items[]" value="<?php echo $item['idobras_items']; ?>" hidden>
            <input type="text" class="form-control" name="item[]" value="<?php echo $item['item']; ?>" readonly></td>
            <td style="width: 8%"><input type="text" class="form-control" name="sub_item[]" value="<?php echo $item['sub_item']; ?>" readonly></td>

            <td style="width: 40%"><input type="text" class="form-control" name="descripcion[]" value="<?php echo $item['descripcion']; ?>" readonly></td>
            <td><?php echo $item['unidad']; ?></td>
            <td><input type="number" class="form-control" name="cantidad[]"  min="0.000" value="<?php echo $item['disponibles']; ?>" readonly></td>

            <td style="width: 18%">
              <?php if($tipo_red == 'provisorio'){ if(!empty($ultimo_provisorio)){ ?>
              <input type="number" class="form-control" name="precio_unitario_fijo[]" step="any" value="<?php echo $item['ultimo_precio']; ?>" readonly hidden>
              <input type="number" class="form-control" name="precio_unitario[]" step="any" value="<?php echo $item['ultimo_precio']; ?>" readonly>
              <?php }else{ ?>
              <input type="number" class="form-control" name="precio_unitario_fijo[]" step="any" value="<?php echo $item['precio_unitario']; ?>" readonly hidden>
              <input type="number" class="form-control" name="precio_unitario[]" step="any" value="<?php echo $item['precio_unitario']; ?>" readonly>
              <?php }} ?>
              <?php if($tipo_red == 'definitivo'){ ?><input type="number" class="form-control" name="precio_unitario[]" step="any" ><?php } ?>
              <input type="text" class="form-control" name="registro_usuario[]" value="<?php echo $user['id']; ?>" hidden>
            <input type="text" class="form-control" name="registro_fecha[]" value="<?php echo make_date(); ?>" hidden></td>

            <td><input type="number" class="form-control" name="importe[]" step="any" readonly></td>
            <!--<td style="width: 10%"><?php if($item['tipo'] == 'Camino'){ echo 'Camino'; } ?><?php if($item['tipo'] == 'Puente'){ echo 'Puente'; } ?></td>-->
          </tr>
        <?php } endforeach; ?>
<?php } ?>
 </tbody>

 <tfoot>
          <tr>           
            <th colspan="6">MONTO DE CONTRATO REDETERMINADO</th>
            <th colspan="2"><input type="number" class="form-control" id="sum_total" name="total_importe" readonly/></th>
          </tr>
 </tfoot>


</table>
</div>
</div>
<?php 
if($tipo_red == 'definitivo'){ 
  ?>
<script type="text/javascript">
$(document).ready(function(){  
  $('input[name="precio_unitario[]"]').on( 'change', function(){   
  
    var disponible = [];
    var precio_unitario = [];
    var importe = [];
    var suma_importe = 0;
    var input_importe = '';

    $('#tabla_acta_redeterminacion').find('tr#trindi').each(function(i) {
      var row_disponible = [];
      var row_precio_unitario = [];
      var row_importe = [];

      var row_importe_total = [];
      var input_total_acum = '';
      //var input_importe = '';
      var flag = false;
      $(this).each(function() {
        var input_disponible = $(this).find('input[name="cantidad[]"]');
        var input_precio_unitario = $(this).find('input[name="precio_unitario[]"]');
        input_importe = $(this).find('input[name="importe[]"]');
		    input_importe_total = $(this).find('input[name="importe_total[]"]');
		//suma_importe = input_importe.val() + suma_importe;
        var suma = '';
        



                   if (input_disponible[0]) {
                       flag = true;
                       row_disponible.push(input_disponible.val());
                   } else {
                   row_disponible.push($(this).text() );
                   }



                   if (input_precio_unitario[0]) {
                       flag = true;
                       row_precio_unitario.push(input_precio_unitario.val());
                    
                   } else {
                   row_precio_unitario.push($(this).text() );
                   }
                   
                   
                  if (input_importe[0]) {
                      flag = true;
                      row_importe.push(input_importe.val());
                   
                   } 

                  if (input_importe_total[0]) {
                      flag = true;
                      row_importe_total.push(input_importe_total.val());
                   
                   } 
                    
                   if (flag) {   
                 disponible.push(row_disponible);
                 precio_unitario.push(row_precio_unitario);
                 importe.push(row_importe);
                // importe_total.push(row_importe_total);

               }
               
               
               
               
                 });
                 

                input_importe.val(parseFloat(disponible[i])*parseFloat(precio_unitario[i]));

               // input_importe_total.val(parseFloat(cantidades_aprobadas[i])*parseFloat(precio_unitario[i]));
                

    }); //FINAL $('#tabla_items').find('tr#trindi').each(function(i) {  
  
  $('#tabla_acta_redeterminacion').find('td').each(function() {      
    input_importe = parseFloat($(this).find('input[name="importe[]"]').val())||0;
    suma_importe = input_importe + suma_importe;     
    
  });

  $('#sum_total').val(suma_importe);

  });

});

</script>
<?php } if($tipo_red == 'provisorio'){ ?>

  <script type="text/javascript">
$(document).ready(function(){  //SI EL DOCUMENTO ESTA LISTO

  $('#items_camino').on( 'change', function(){   // SI CAMBIO VALOR EN CAMPO INDICE CAMINO
  
    var disponible = [];
    var precio_unitario = [];
    var precio_unitario_fijo = [];
    var importe = [];
    var suma_importe = 0;
    var input_disponible = '';
    var input_importe = '';
    var input_precio_unitario = '';
    var input_precio_unitario_fijo = '';
    var indice = $('#items_camino').val();

    $('#tabla_acta_redeterminacion').find('tr#Camino').each(function(i) { // RECORRO FILAS
      var row_disponible = [];
      var row_precio_unitario = [];
      var row_precio_unitario_fijo = [];
      var row_importe = [];
      var row_importe_total = [];
      var flag = false;

      $(this).each(function() { //RECORRO COLUMNA
        input_disponible = $(this).find('input[name="cantidad[]"]');
        input_precio_unitario_fijo = $(this).find('input[name="precio_unitario_fijo[]"]');
        input_precio_unitario = $(this).find('input[name="precio_unitario[]"]');
        input_importe = $(this).find('input[name="importe[]"]');
		    input_importe_total = $(this).find('input[name="importe_total[]"]');
        var suma = '';
        
                   if (input_disponible[0]) {
                       flag = true;
                       row_disponible.push(input_disponible.val());
                   } else {
                   row_disponible.push($(this).text() );
                   }


                   if (input_precio_unitario_fijo[0]) {
                       flag = true;
                       row_precio_unitario_fijo.push(input_precio_unitario_fijo.val());
                    
                   } 

                   if (input_precio_unitario[0]) {
                       flag = true;
                       suma = parseFloat(input_precio_unitario_fijo.val())*parseFloat(indice);
                       row_precio_unitario.push(suma);
                    
                   } 
                   
                   
                   if (input_importe[0]) {
                    flag = true;
                    row_importe.push(input_importe.val());
                 
                 } 

                  if (input_importe_total[0]) {
                      flag = true;
                      row_importe_total.push(input_importe_total.val());
                   
                   } 
                    
                   if (flag) {   
                 disponible.push(row_disponible);
                 precio_unitario.push(row_precio_unitario);
                 precio_unitario_fijo.push(row_precio_unitario_fijo);
                 importe.push(row_importe);

               }
               
               
               
               
                 });
                 

                input_precio_unitario.val(parseFloat(indice)*parseFloat(precio_unitario_fijo[i]));
              input_importe.val(parseFloat(disponible[i])*parseFloat(precio_unitario[i]));
                

    }); //FINAL $('#tabla_items').find('tr#trindi').each(function(i) {  
  
  $('#tabla_acta_redeterminacion').find('td').each(function() {      
    input_importe = parseFloat($(this).find('input[name="importe[]"]').val())||0;
    suma_importe = input_importe + suma_importe;     
    
  });

  $('#sum_total').val(suma_importe);

  });

  $('#items_puente').on( 'change', function(){   // SI CAMBIO VALOR EN CAMPO INDICE CAMINO
  
  var disponible = [];
  var precio_unitario = [];
  var precio_unitario_fijo = [];
  var importe = [];
  var suma_importe = 0;
  var input_disponible = '';
  var input_importe = '';
  var input_precio_unitario = '';
  var input_precio_unitario_fijo = '';
  var indice = $('#items_puente').val();

  $('#tabla_acta_redeterminacion').find('tr#Puente').each(function(i) { // RECORRO FILAS
    var row_disponible = [];
    var row_precio_unitario = [];
    var row_precio_unitario_fijo = [];
    var row_importe = [];
    var row_importe_total = [];
    var flag = false;

    $(this).each(function() { //RECORRO COLUMNA
      input_disponible = $(this).find('input[name="cantidad[]"]');
      input_precio_unitario_fijo = $(this).find('input[name="precio_unitario_fijo[]"]');
      input_precio_unitario = $(this).find('input[name="precio_unitario[]"]');
      input_importe = $(this).find('input[name="importe[]"]');
      input_importe_total = $(this).find('input[name="importe_total[]"]');
      var suma = '';
      
                 if (input_disponible[0]) {
                     flag = true;
                     row_disponible.push(input_disponible.val());
                 } else {
                 row_disponible.push($(this).text() );
                 }



                 if (input_precio_unitario_fijo[0]) {
                       flag = true;
                       row_precio_unitario_fijo.push(input_precio_unitario_fijo.val());
                    
                   } 

                   if (input_precio_unitario[0]) {
                       flag = true;
                       suma = parseFloat(input_precio_unitario_fijo.val())*parseFloat(indice);
                       row_precio_unitario.push(suma);
                    
                   } 
                 
                 
                if (input_importe[0]) {
                    flag = true;
                    row_importe.push(input_importe.val());
                 
                 } 

                if (input_importe_total[0]) {
                    flag = true;
                    row_importe_total.push(input_importe_total.val());
                 
                 } 
                  
                 if (flag) {   
               disponible.push(row_disponible);
               precio_unitario.push(row_precio_unitario);
               precio_unitario_fijo.push(row_precio_unitario_fijo);
               importe.push(row_importe);

             }
             
             
             
             
               });
               

               input_precio_unitario.val(parseFloat(indice)*parseFloat(precio_unitario_fijo[i]));
              input_importe.val(parseFloat(disponible[i])*parseFloat(precio_unitario[i]));

              

  }); //FINAL $('#tabla_items').find('tr#trindi').each(function(i) {  

$('#tabla_acta_redeterminacion').find('td').each(function() {      
  input_importe = parseFloat($(this).find('input[name="importe[]"]').val())||0;
  suma_importe = input_importe + suma_importe;     
  
});

$('#sum_total').val(suma_importe);

});



});

</script>
<?php } ?>