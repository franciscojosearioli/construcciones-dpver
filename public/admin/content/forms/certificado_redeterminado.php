<?php 
require_once('../../includes/load.php');
require_once('../../includes/functions/certificados_redeterminados.php');   
$obra_id = $_POST['obra_id'];
$certificado_id = $_POST['certificado_id'];
$actaprecios_id = $_POST['precios'];

if($_POST['precios_camino'] != 0){
$indices_camino = find_by_id('certificados_precios','idcertificados_precios',(int)$_POST['precios_camino']); 
}else{
  $indices_camino['valor'] = '0';
}

if($_POST['precios_puente'] != 0){
$indices_puente = find_by_id('certificados_precios','idcertificados_precios',(int)$_POST['precios_puente']); 
}else{
  $indices_puente['valor'] = '0';
}

$tipo = $_POST['tipo'];


$obra = find_by_id('obras','idobras',(int)$_POST['obra_id']); 
$certificado = find_by_id('certificados_obras','idcertificados_obras',(int)$_POST['certificado_id']); 


if($tipo == 'definitivo'){ $items = listar_items_nuevos_precios_stipo($certificado_id,$_POST['obra_id'],$_POST['precios'],2); }

if($tipo == 'provisorio'){ $items = listar_items_nuevos_precios_stipo($certificado_id,$_POST['obra_id'],$_POST['precios'],1); }


$planoficial = listar_planoficial_obras($obra_id); 
$descuentos = listar_descuentoscertificados();
    $modificaciones_de_obra =  modificaciones_de_obra($obra['idobras']);
    $ampliaciones_de_obra =  ampliaciones_de_obra($obra['idobras']);
?>
<div class="row justify-content-center" id="nuevo_certificados">
  <div class="col-11">
    <div class="card">

      <div class="card-body cards-titulo">
        <div class="d-flex flex-wrap">
          <div class="ml-auto my-auto mr-3">
            <a onclick="cancelar_certificado()" title="Cerrar" data-toggle="tooltip" style="color:red;"><i class="fas fa-times"></i> Cancelar</a>
          </div>
        </div>
      </div>
      <div class="card-body cards-titulo">   
         <center>
            PROVINCIA DE ENTRE RIOS<br>
            MINISTERIO DE PLANEAMIENTO, INFRAESTRUCTURA Y SERVICIOS<br>
            DIRECCIÓN PROVINCIAL DE VIALIDAD<br>
            CERTIFICADO DE OBRA POR CONTRATO
          </center>
      </div>
      <div class="card-body">
        <form method="post" action="certificados-redeterminados" id="form_agregar_certificado">
          <div class="row p-10">
            <div class="col-lg-7 col-md-7 col-sm-12">
              <div class="p-r-10 p-l-10">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="row">
                    EXPEDIENTE Nº: <?php echo $obra['expediente']; ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-12">
              <div class="p-r-10 p-l-10">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="row justify-content-center">
                    <center>
                    CERTIFICADO Nº: <input type="text" style="width:40px;" name="numero_certificado" min="0" readonly value="<?php echo $certificado['numero']; ?>">
                    <input type="text" name="tipo" hidden value="<?php echo $tipo; ?>"><input name="certificado_vencimiento" type="number" id="certificado_vencimiento" value="<?php echo $obra['certificado_vencimiento']; ?>" hidden>
                    </center>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row p-10">
            <div class="col-lg-12 col-md-12 col-sm-12">
              <div class="p-r-10 p-l-10">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="row justify-content-center">
                    <h3><center>
                    DENOMINACION: <?php echo $obra['nombre']; ?>
                    </center></h3>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row p-10">
            <div class="col-lg-7 col-md-7 col-sm-12">
              <div class="p-r-10 p-l-10">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="row">
                    APROBACION PROYECTO <?php if($obra['aprobacion_res_fecha'] != '0000-00-00' && $obra['aprobacion_res_fecha'] != NULL){ echo format_date($obra['aprobacion_res_fecha']); }else{'';} ?> RES. <?php if(!empty($obra['aprobacion_res_num'])){ echo $obra['aprobacion_res_num']; } else {echo '';} ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-12">
              <div class="p-r-10 p-l-10">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="row justify-content-center">
                    <center>
                    ADJUDICACION <?php if($obra['adjudicacion_res_fecha'] != '0000-00-00' && $obra['adjudicacion_res_fecha'] != NULL){ echo format_date($obra['adjudicacion_res_fecha']); }else{'';} ?> RES. <?php if(!empty($obra['adjudicacion_res_num'])){ echo $obra['adjudicacion_res_num'];} else{echo '';} ?>
                    </center>
                  </div>
                </div>
              </div>
            </div> 
          </div>
          <div div class="row p-10">
            <div class="col-lg-7 col-md-7 col-sm-12">
              <div class="p-r-10 p-l-10">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="row">
                    CONTRATISTA: <?php echo $obra['contratista']; ?>
                  </div>
                </div>
              </div>
            </div> 
            <div class="col-lg-5 col-md-5 col-sm-12">
              <div class="p-r-10 p-l-10">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="row justify-content-center">
                    <center>
                    FECHA COMIENZO OBRA: <?php if($obra['fecha_inicio'] != '0000-00-00' && $obra['fecha_inicio'] != NULL){ echo format_date($obra['fecha_inicio']); } else { echo ''; } ?>      
                    </center>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row p-10">
            <div class="col-lg-7 col-md-7 col-sm-12">
              <div class="p-r-10 p-l-10">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="row">
                    FECHA DE CONTRATO: <?php if($obra['contrato_fecha'] != '0000-00-00' && $obra['contrato_fecha'] != NULL){ echo format_date($obra['contrato_fecha']);} else { echo ''; } ?>
                  </div>
                </div>
              </div>
            </div> 

        </div>
        <div class="row p-10">
            <div class="col-lg-7 col-md-7 col-sm-12">
              <div class="p-r-10 p-l-10">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="row">
                    IMPORTE DE CONTRATO: <?php echo '$ '.numero($obra['monto_vigente']); /*
                    if(!empty($modificaciones_de_obra)){ foreach ($modificaciones_de_obra as $mod):
                      if(!empty($mod['resolucion_numero'])){
                      echo '<br>'.$mod['numero'].' MODIFICACION DE MONTO: $ '.$mod['monto_final']; 
                    }
                    endforeach ;}*/
                      ?>
                  </div>
                </div>
              </div>
            </div>
              
            </div> 
            <div class="row p-10">
            <div class="col-lg-7 col-md-7 col-sm-12">
              <div class="p-r-10 p-l-10">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="row">
                    PLAZO DE EJECUCION: <?php echo $obra['plazo_vigente'].' '; /*if(!empty($ampliaciones_de_obra)){ foreach($ampliaciones_de_obra as $amp): if(!empty($amp['resolucion_numero'])){ echo '+ '.$amp['plazo']; } endforeach; } */?>
                  </div>
                </div>
              </div>
            </div>
                           <div class="col-lg-5 col-md-5 col-sm-12">
              <div class="p-r-10 p-l-10">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="row justify-content-center">
                    <!--<center>
                    PLAZO TRANSCURRIDO: <?php echo $obra['certificado_plazo']; ?>       
                    </center>-->
                  </div>
                </div>
              </div>
            </div>  
            </div>
            <div class="row p-10">

          
             <div class="col-lg-7 col-md-7 col-sm-12">
               <div class="p-r-10 p-l-10">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="row">
                    FECHA DE MEDICION: <input type="date" name="fecha_medicion" value="<?php echo $certificado['fecha_medicion']; ?>" style="border:none;" readonly required>
                  </div>
                </div>
              </div>
            </div>  

              <?php if(empty($obra['certificado_vencimiento'])){ ?>
                <div class="col-lg-5 col-md-5 col-sm-12">
            <center>Falta vencimiento s/pliegos</center>
            </div><?php }else{ ?>  
            <div class="col-lg-5 col-md-5 col-sm-12">
              <div class="p-r-10 p-l-10">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="row justify-content-center">
                    <center>
                    CORRESPONDE AL MES DE 
                    <select style="width:85px;" name="month" id="month" required>
                      <option disabled selected>Seleccione un mes</option>
                      <option value="1">Enero</option>
                      <option value="2">Febrero</option>
                      <option value="3">Marzo</option>
                      <option value="4">Abril</option>
                      <option value="5">Mayo</option>
                      <option value="6">Junio</option>
                      <option value="7">Julio</option>
                      <option value="8">Agosto</option>
                      <option value="9">Septiembre</option>
                      <option value="10">Octubre</option>
                      <option value="11">Noviembre</option>
                      <option value="12">Diciembre</option>
                    </select> DE <input type="number" style="width:55px;" name="year" id="year" min="0" value="2021" required> 
                    </center>
                  </div>
                </div>
              </div>
            </div> 
          <?php } ?>
        </div>
           
            <br><br>
    <div class="table-responsive">
            
            <table class="table table-bordered" id="tabla_items">
  <thead>
    <tr>
      <th scope="col"></th>
      <th scope="col"></th>
      <th scope="col"></th>
      <th scope="col"></th>
      <th scope="col" ></th>
      <th scope="col" ></th>
      <th scope="col" ></th>
    </tr>
    <tr>
      <th colspan="2" scope="col">ITEM</th>
      <th rowspan="2" scope="col">DESIGNACION</th>
      <th rowspan="2" scope="col">UNIDAD DE MEDIDA</th>
      <th scope="col">PRESENTE CERTIFICADO</th>
      <th rowspan="2"scope="col" >PRECIO UNITARIO</th>
      <th rowspan="2"scope="col" >IMPORTE</th>
    </tr>    
  </thead>
  <tbody>
    <?php foreach($items as $item): ?>
    <?php if($item['unidad'] == 'No define'){ ?>
    <tr>
      <td><input value="<?php echo $item['idobras_items']; ?>" type="text" name="idobras_items[]" hidden><?php echo $item['item']; ?></td>
      <td></td>
      <td><?php echo $item['descripcion']; ?></td>
      <td></td>
      <td><input type="number" name="cantidad[]" value="0.000" hidden></td>
      <td><input type="number" name="precio_unitario_items[]" hidden ></td>
      <!--<td></td>-->
      <td><input type="number" hidden name="importe[]" value="0.000"></td>



      <td></td>
      <td></td>
      <!--<td></td>-->
      <td></td>
    </tr>
  <?php }else{ ?>
        <tr id="trindi">
      <td><input value="<?php echo $item['idobras_items']; ?>" type="text" name="idobras_items[]" hidden><?php echo $item['item']; ?></td>
      <td><?php echo $item['sub_item']; ?></td>
      <td><?php echo $item['descripcion']; ?></td>
      <td><?php echo $item['unidad']; ?></td>
      <td><input type="number" name="cantidad[]" style="width:80px;border:none;"  id="valor_nuevo_acumulado" value="<?php echo $item['cantidad']; ?>" readonly></td>
      <!--<?php 
      $valor_acumulado = consulta_valor_acumulado($item['idobras_items']);
      ?>
      <td><input type="number" disabled step="0.001" style="width:70px;" value="<?php echo $item['cantidad_acumulada']; ?>" name="valor_acumulado[]"><input type="number" disabled hidden step="0.001" name="cantidad_aprobada[]" value="<?php echo $item['cantidad_aprobada']; ?>"></td>
      <td><input type="number" disabled step="0.001" style="width:70px;" name="total_individual_acumulado[]" max="<?php echo $item['cantidad_aprobada']; ?>"></td>
      <td><input type="number" disabled step="0.001" name="cantidad_aprobada[]" value="<?php echo $item['cantidad_aprobada']; ?>"> </td>-->
<td><input type="number" readonly name="precio_unitario_items[]" value="<?php echo $item['precio_unitario']; ?>" style="border:none;"></td>
      <td><input type="number" readonly name="importe[]" class="importe" style="border:none;"><input type="number" disabled hidden name="importe_total[]" class="importe_total"></td>
    </tr>   
    <?php } endforeach; ?>
    <tr>
      <td><b><span stlye="font-weight:600;">TOTAL</span></b></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>

      <!--<td></td>-->

    
      <td><input type="number"  id="sum_total" name="total_importe" readonly style="border:none;"/></td>
    </tr>
  </tbody>
</table>
      </div>
      <hr>
<div class="row justify-content-center">
      <div class="col-8">
      <div class="card-body cards-titulo">   
         <center>
            DESCUENTOS
          </center>
    </div>
<br>

    <div class="table-responsive">
    <table class="table table-bordered">
<thead>
    <tr>
      <th scope="col"></th>
      <th scope="col">DESCRIPCION</th>
      <th scope="col">VALOR</th>
      </tr>
</thead>
<tbody>
<?php foreach($descuentos as $desc): ?>
<tr>
<td class="text-center"><input type="checkbox" id="checkbox_descuento_<?php echo $desc['idcertificados_descuentos']; ?>" class="filled-in" name="descuento_aplica[]" value="<?php echo $desc['idcertificados_descuentos']; ?>"><label for="checkbox_descuento_<?php echo $desc['idcertificados_descuentos']; ?>"></label></td>
<td><?php echo $desc['descripcion']; ?></td>
<td><?php echo $desc['valor']; ?> %</td>
</tr>
<?php endforeach; ?>
  </tbody>
</table>
</div>
</div>
</div>

      <hr>
      <div class="card-body cards-titulo">   
         <center>
            FECHA DE VENCIMIENTO: <input type="date" name="fecha_vencimiento" id="fecha_vencimiento" style="border:none;" >
          </center>
    </div>
<br>

<input name="idobras" value="<?php echo $obra_id; ?>" hidden>

<input name="id_acta" value="<?php echo $_POST['precios']; ?>" hidden>
        
      </div>
      <div class="card-body cards-titulo">
        <div class="d-flex flex-wrap">
          <div class="ml-auto my-auto mr-3">
            <a onclick="submit_agregar_certificado()" title="Confirmar" data-toggle="tooltip" style="color:green;"><i class="fas fa-check"></i> Confirmar</a>
          </div>
        </div>
      </div>

    </div>
</div>
</div>
</form>
<script>



  function submit_agregar_certificado()
{
    $('#form_agregar_certificado').submit();

}



function confirmar_certificado(){
swal({
  title: "Confirmar",
  text: "Si continua Se procedera a crear el certificado",
  buttons: true,
})
  .then((willDelete) => {
if (willDelete) {
    swal("Se ha creado un nuevo certificado de obra.", {
    icon: "success",
    });
  } else {
    swal("Los cambios permanecen.");
  }
});
}
function cancelar_certificado(){
swal({
  title: "Esta seguro?",
  text: "Si continua se perderan todos los cambios",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
  .then((willDelete) => {
if (willDelete) {
    swal("Se han perdido todos los cambios", {
    });
        location.reload();
  } else {
    swal("Los cambios permanecen.");
  }
});
}

  /** 
  FUNCION SUMA (CADA VEZ QUE SE AGREGA UN VALOR EN COLUMNA "PRESENTE CERTIFICADO") 
  **/



$(document).ready(function(){



$(document).ready(function(){ 
    var cantidad = [];
    var cantidades_aprobadas = [];
    var acumulado = [];
    var total_acum = [];
    var precio_unitario = [];
    var importe = [];
    var importe_total = [];
    
  var suma_importe = 0;
  var input_importe = '';
  var suma_importe_total = 0;
  var input_importe_total = '';
var input_cantidades_aprobadas = '';

  
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
    $('#tabla_items').find('tr#trindi').each(function(i) {
      var row_cantidad = [];
      var row_cantidades_aprobadas = [];
      var row_acumulado = [];
      var row_total_acum = [];
      var row_precio_unitario = [];
      var row_importe = [];

      var row_importe_total = [];
      var input_total_acum = '';
      //var input_importe = '';
      var flag = false;
      $(this).each(function() {
        var input_cantidad = $(this).find('input[name="cantidad[]"]');
       input_cantidades_aprobadas = $(this).find('input[name="cantidad_aprobada[]"]');
        var input_acumulado = $(this).find('input[name="valor_acumulado[]"]');
         input_total_acum = $(this).find('input[name="total_individual_acumulado[]"]');
        var input_precio_unitario = $(this).find('input[name="precio_unitario_items[]"]');
        input_importe = $(this).find('input[name="importe[]"]');
        input_importe_total = $(this).find('input[name="importe_total[]"]');
    //suma_importe = input_importe.val() + suma_importe;
        var suma = '';
        
                   if (input_acumulado[0]) {
                       flag = true;
                       row_acumulado.push(input_acumulado.val());
                    
                   } else {
                   row_acumulado.push($(this).text() );
                   }
                   


                   if (input_cantidad[0]) {
                       flag = true;
                       row_cantidad.push(input_cantidad.val());

                   } else {
                   row_cantidad.push($(this).text() );
                   }
                   if (input_cantidades_aprobadas[0]) {
                     if (input_cantidades_aprobadas.val() > 0) {
                       flag = true;
                       row_cantidades_aprobadas.push(input_cantidades_aprobadas.val());
                     }
                   } else {
                   row_cantidad.push($(this).text() );
                   }

                   if (input_total_acum[0]) {
                       flag = true;
                       suma = parseFloat(input_cantidad.val()) + parseFloat(input_acumulado.val());
                       row_total_acum.push(suma);
                    
                   } else {
                   row_total_acum.push($(this).text() );
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
                 cantidades_aprobadas.push(row_cantidades_aprobadas);
                 acumulado.push(row_acumulado);
                 total_acum.push(row_total_acum);
                 precio_unitario.push(row_precio_unitario);
                 importe.push(row_importe);
                 importe_total.push(row_importe_total);

               }
               
               
               
               
                 });
                 

                input_total_acum.val(total_acum[i]); 

                input_importe.val(parseFloat(cantidad[i])*parseFloat(precio_unitario[i]));

                input_importe_total.val(parseFloat(cantidad[i])*parseFloat(precio_unitario[i]));
                

    }); //FINAL $('#tabla_items').find('tr#trindi').each(function(i) {  
  
  $('#tabla_items').find('td').each(function() {      
    input_importe = parseFloat($(this).find('input[name="importe[]"]').val())||0;
    suma_importe = input_importe + suma_importe;     
    
  });

  $('#sum_total').val(suma_importe);
  //$('#obra_ejecutada').val(suma_importe);
            //$('#sum_total').html(suma_importe);  

/*
  $('#tabla_items').find('td').each(function() {      
      input_importe_total = parseFloat($(this).find('input[name="importe_total[]"]').val())||0;
      suma_importe_total = input_importe_total + suma_importe_total;     
  });


  $('#monto_total_aprobado').val(suma_importe_total);
            //$('#sum_total').html(suma_importe);  
            var valor_mont_contr = $('#monto_total_aprobado').val();
var valor_obra_ejec = $('#obra_ejecutada').val();
var porc_obra_ejec = '';

if(valor_obra_ejec != ''){
 porc_obra_ejec = (valor_obra_ejec*100)/valor_mont_contr;
 $('#porc_obra_ejecutada').val(porc_obra_ejec);
}
*/

  });





});











$('input[name="month"]').on( 'change', function(){ 
 
  var month = $("#month").val();
  var year = $("#year").val();
  var dias = $("#certificado_vencimiento").val();

  if(month == month){
    var summonth = parseFloat(month)+1; 

  }
  if(summonth < 10){
    summonth = '0'+summonth;
  }
  if(month != null || year != null){

  if(month < 10){
    month = '0'+month;
  }

  var fecha = year+'-'+summonth+'-01';

        $.ajax({
            type: 'POST',
            url: 'includes/ajax/fecha_vencimiento.php',
            data: "fecha=" + fecha +"&dias=" + dias,
            success: function(data) {
                $('#fecha_vencimiento').val(data);
            }
        });
  }
});

/*
$('input[name="numero_certificado"]').on( 'change', function(){ 

  var numero = $('input[name="numero_certificado"]').val();

        $.ajax({
            type: 'POST',
            url: 'includes/ajax/monto_planoficial.php',
            data: "numero=" + numero +"&idobras=" + <?php echo $obra_id; ?>,
            success: function(data) {
                $('#monto_planoficial').val(data);
            }
        });
                $.ajax({
            type: 'POST',
            url: 'includes/ajax/avance_planoficial.php',
            data: "numero=" + numero +"&idobras=" + <?php echo $obra_id; ?>,
            success: function(data) {
                $('#avance_planoficial').val(data);
            }
        });
});
$(document).ready(function() {
  
$('input[name="cantidad[]"]').on( 'change', function(){ 
  var obra_ejec = $('#porc_obra_ejecutada').val();
  var obra_prev = $('#avance_planoficial').val();




        $.ajax({
            type: 'POST',
            url: 'includes/ajax/atraso_adelanto.php',
            data: "obra_ejec=" + obra_ejec +"&obra_prev=" + obra_prev,
            success: function(data) {
                $('#atraso_adelanto').val(data);
            }
        });
});

});
   $('input').on( 'change', function(){ 
 
var month = $("#month").val();
var year = $("#year").val();


if(month != null || year != null){
var fecha_creada = year+'-'+month+'-'+'01';
var fecha_venc = new Date(fecha_creada);
var dias_venc = 60; // Número de días a agregar
fecha_venc.setDate(fecha_venc.getDate() + dias_venc);
fecha_venc.format.date(fecha_venc, "yyyy-MM-dd");


$('#fecha_vencimiento').val(fecha_creada);

console.log(month,year,fecha_venc)*/

</script>

