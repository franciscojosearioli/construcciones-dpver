<?php 
require_once('../../includes/load.php');

$user = current_user();
$redeterminacion_acta = find_by_id('redeterminaciones','idredeterminaciones_actas',$_POST['id']);
$obra = find_by_id('obras','idobras',$redeterminacion_acta['idobras']);



$items_obras = listar_items_obras_redeterminacion_id($obra['idobras'],$_POST['id']);


?>
<div class="row justify-content-center" id="ver_form_editar">
  <div class="col-10">
    <div class="card">
      <div class="card-body cards-titulo">
        <div class="d-flex flex-wrap">
          <div class="my-auto ml-3">
            ACTAS DE REDETERMINACIONES > Edicion
          </div>
          <div class="ml-auto my-auto mr-3">
            <a onclick="cancelar_editar()" title="Cerrar" data-toggle="tooltip"><i class="fas fa-times"></i></a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <form method="post" action="redeterminaciones-actas" id="form_editar">
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
              <div class="form-group p-r-10 p-l-10">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="row title-form">
                    Informacion de redeterminacion
                  </div>
                </div>
                <div class="row p-t-20">
                  <div class="col-lg-6 col-md-6 col-sm-6">
                     <div class="md-form form-md">
                      <label class="control-label">Titulo</label>
                      <input type="text" name="titulo" id="titulo" class="form-control" value="<?php echo $redeterminacion_acta['titulo']; ?>" required>
                    </div>
                  </div> 
                  <div class="col-lg-3 col-md-3 col-sm-3">
                     <div class="md-form form-md">
                      <label class="control-label">Numero resolucion</label>
                      <input type="text" name="n_reso" id="n_reso" class="form-control" value="<?php echo $redeterminacion_acta['numero_resolucion']; ?>" required>
                    </div>
                  </div> 
                  <div class="col-lg-3 col-md-3 col-sm-3">
                     <div class="md-form form-md">
                      <label class="control-label">Fecha resolucion</label>
                      <input type="date" name="f_reso" id="f_reso" class="form-control" value="<?php echo $redeterminacion_acta['fecha_resolucion']; ?>" required>
                    </div>
                  </div> 
                </div>
              </div>
              <div class="form-group p-r-10 p-l-10">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="row title-form">
                    Precios de Items de cotizacion
                  </div>
                </div>
                <input type="text" name="edit_redeterminacion" value="<?php echo $redeterminacion_acta['idredeterminaciones_actas']; ?>" hidden>
                <div class="row p-t-20">
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="md-form form-md">
                      <label class="control-label">Obra</label>
                      <h3><center><?php echo $obra['nombre']; ?></center></h3>
                    </div>
                  </div> 
                </div>
<?php if($redeterminacion_acta['tipo'] == '1'){ ?>
  Indique un indice de precios a aplicar segun el tipo de item
  <div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12">Camino: <input type="number" name="valor_camino" min="1" id="items_camino" value="<?php echo $redeterminacion_acta['camino']; ?>" class="form-control"></div>
    <div class="col-lg-6 col-md-6 col-sm-12">Puente: <input type="number" name="valor_puente" min="1" id="items_puente" value="<?php echo $redeterminacion_acta['puente']; ?>" class="form-control"></div>
  </div>
<?php } ?>
        <div class="p-20">
        <div class="table-responsive">  
          <input type="text" name="idobras" hidden value="<?php echo $obra['idobras']; ?>">
          <input type="text" name="idobras_items_edit" hidden>
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
            <th>Tipo</th>
          </tr>
          </thead>
          



<tbody>
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
      <td></td>
      <!--<td></td>-->
      <td></td>
      <td></td>      
      <td></td>
    </tr>
  <?php }else{ ?>
        <tr <?php if($redeterminacion_acta['tipo'] == "2"){ ?> id="trindi" <?php } ?><?php if($redeterminacion_acta['tipo'] == "1"){if($item['tipo'] == 'Camino'){ ?>id="Camino"<?php }if($item['tipo'] == 'Puente'){ ?> id="Puente" <?php }} ?>>
          <tr>
            <td style="width: 8%">
            <input type="text" class="form-control" name="idobras_items[]" value="<?php echo $item['idobras_items']; ?>" hidden>
            <input type="text" class="form-control" name="item[]" value="<?php echo $item['item']; ?>" readonly></td>
            <td style="width: 8%"><input type="text" class="form-control" name="sub_item[]" value="<?php echo $item['sub_item']; ?>" readonly></td>
            <td style="width: 40%"><input type="text" class="form-control" name="descripcion[]" value="<?php echo $item['descripcion']; ?>" readonly></td>
            <td><?php echo $item['unidad']; ?></td>
            <td><input type="number" class="form-control" name="cantidad[]"  min="0.000" value="<?php echo $item['disponibles']; ?>" readonly></td>

            <td style="width: 18%">
            <input type="number" class="form-control" name="precio_unitario[]" step="any" value="<?php echo $item['precio_unitario']; ?>" <?php if($redeterminacion_acta['tipo'] == '1'){ echo 'readonly'; } ?>>            
            <input type="text" class="form-control" name="registro_usuario[]" value="<?php echo $user['id']; ?>" hidden>
            <input type="text" class="form-control" name="registro_fecha[]" value="<?php echo make_date(); ?>" hidden></td>
            <td><input type="number" class="form-control" name="importe[]" step="any" readonly></td>
            <td style="width: 10%"><?php if($item['tipo'] == 'Camino'){ echo 'Camino'; } ?><?php if($item['tipo'] == 'Puente'){ echo 'Puente'; } ?></td>
          </tr>
        <?php } endforeach; ?>
<?php } ?>
 </tbody>
 <tfoot>
          <tr>
            <th colspan="6">MONTO DE CONTRATO REDETERMINADO</th>
            <th colspan="2"><input type="number"  id="sum_total" name="total_importe" readonly/></th>
          </tr>
 </tfoot>



</table>
</div>
        </div>

              </div>
            </div>

          </div>
        </form>
      </div>
            <div class="card-body">
<hr class="m-t-0 m-b-0">
              <div class="row p-t-20">
              <div class="col-12">
                                        <div class="d-flex flex-wrap">
                                            <div>
                                                <h6 class="text-muted"><a onclick="cancelar_editar()" class="dropdown-item a-icon" data-toggle="tooltip" title="Cancelar"><i class="fas fa-times fa-2x"></i></a></h6>
                                            </div>
                                            <div class="ml-auto">
                                                <ul class="list-inline">
                                                    <li>
                                                        <h6 class="text-muted"><a onclick="submit_editar();" class="dropdown-item a-icon" data-toggle="tooltip" title="Confirmar"><i class="fas fa-check fa-2x"></i></a></h6> 
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                  </div>
            </div>  
    </div>
  </div>
</div>

<?php 
if($redeterminacion_acta['tipo'] == "2"){ 
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
<?php } if($redeterminacion_acta['tipo'] == "1"){ ?>

  <script type="text/javascript">
$(document).ready(function(){  //SI EL DOCUMENTO ESTA LISTO

  var indice_camino = $('#items_camino').val();
  var indice_puente = $('#items_puente').val();

  $('#items_camino').on( 'change', function(){   // SI CAMBIO VALOR EN CAMPO INDICE CAMINO
    indice_camino = $('#items_camino').val();
  });

  $('#items_puente').on( 'change', function(){   // SI CAMBIO VALOR EN CAMPO INDICE CAMINO
    indice_puente = $('#items_puente').val();
  });

    var disponible = [];
    var precio_unitario = [];
    var precio_unitario_fijo = [];
    var importe = [];
    var suma_importe = 0;
    var input_disponible = '';
    var input_importe = '';
    var input_precio_unitario = '';
    var input_precio_unitario_fijo = '';

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
                       suma = parseFloat(input_precio_unitario_fijo.val())*parseFloat(indice_camino);
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
                 

                input_precio_unitario.val(parseFloat(indice_camino)*parseFloat(precio_unitario_fijo[i]));
              input_importe.val(parseFloat(disponible[i])*parseFloat(precio_unitario[i]));
                

    }); //FINAL $('#tabla_items').find('tr#trindi').each(function(i) {  


  
  var disponible = [];
  var precio_unitario = [];
  var precio_unitario_fijo = [];
  var importe = [];
  var suma_importe = 0;
  var input_disponible = '';
  var input_importe = '';
  var input_precio_unitario = '';
  var input_precio_unitario_fijo = '';

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
                       suma = parseFloat(input_precio_unitario_fijo.val())*parseFloat(indice_puente);
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
               

               input_precio_unitario.val(parseFloat(indice_puente)*parseFloat(precio_unitario_fijo[i]));
              input_importe.val(parseFloat(disponible[i])*parseFloat(precio_unitario[i]));

              

  }); //FINAL $('#tabla_items').find('tr#trindi').each(function(i) {  

$('#tabla_acta_redeterminacion').find('td').each(function() {      
  input_importe = parseFloat($(this).find('input[name="importe[]"]').val())||0;
  suma_importe = input_importe + suma_importe;     
  
});

$('#sum_total').val(suma_importe);



});

</script>
<?php } ?>