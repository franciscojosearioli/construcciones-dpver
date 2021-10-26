<?php 
require_once('../load.php');
$tipo = $_POST['tipo'];
$obra = $_POST['obra'];
$idcertificado_select = $_POST['certif_id'];
$user = current_user();
$actas_provisorias = actas_redeterminacion_provisorias($_POST['obra']);
$actas_definitivas = actas_redeterminacion_definitivas($_POST['obra']);


if($tipo == 'provisorio'){ ?>
<div class="row justify-content-center">
<div class="form-group col-6">
<hr>
<center><h5>Seleccione el acta de redeterminacion de precios</h5></center>
                            <input type="text" name="idobra" id="idobras" value="<?php echo $obra_id; ?>" hidden>
<select id="precios_redeterminacion" class="custom-select col-12">
	<option disabled selected>Seleccion acta de precios redeterminados</option>
	<?php foreach($actas_provisorias as $r){ ?>
		<option value="<?php echo $r['idredeterminaciones_actas'] ?>"><?php echo $r['titulo']; ?></option>
	<?php } ?>
</select>
                          </div>
            </div>
<?php 
}
if($tipo == 'definitivo'){ ?>
<div class="row justify-content-center">
<div class="form-group col-6">
<hr>
<center><h5>Seleccione el acta de redeterminacion de precios</h5></center>
                            <input type="text" name="idobra" id="idobras" value="<?php echo $obra_id; ?>" hidden>
<select id="precios_redeterminacion" class="custom-select col-12">
	<option disabled selected>Seleccion acta de precios redeterminados</option>
	<?php foreach($actas_definitivas as $r){ ?>
		<option value="<?php echo $r['idredeterminaciones_actas'] ?>"><?php echo $r['titulo']; ?></option>
	<?php } ?>
</select>
                          </div>
            </div>
<?php } ?>

<span id="resp_precios">
	<?php if($tipo == 'definitivo'){ ?>
	<div class="row justify-content-center">
<div class="form-group col-6">
<center>
	<button onclick="formulario_redeterminacion_definitiva(<?php echo $obra; ?>,<?php echo $idcertificado_select; ?>,'definitivo');" class="btn btn-dark">Redeterminar certificado</button>
	</center>
	</div></div>
<?php } ?>
	<?php if($tipo == 'provisorio'){ ?>	
	<div class="row justify-content-center">
<div class="form-group col-6">
<center>
	<button onclick="formulario_redeterminacion_definitiva(<?php echo $obra; ?>,<?php echo $idcertificado_select; ?>,'provisorio');" class="btn btn-dark">Redeterminar certificado</button>
	</center>
	</div></div>
<?php } ?>
</span>
<script>
	$(document).ready(function() {
		$('#resp_precios').hide();
			$('#precios_redeterminacion').on('change',function(){
		var acta = $('#precios_redeterminacion').val();
		$('#resp_precios').show();
	});
	});

function formulario_redeterminacion_provisoria(idobra,certificado,tipo){
  var idobra = idobra;
  var certificado = certificado;
  var tipo = tipo;
  var precios_camino = $('#precios_redeterminacion_camino').val();
  var precios_puente = $('#precios_redeterminacion_puente').val();
  $('#agregar_certificados').hide();
  $.post("content/forms/certificado_redeterminado.php", {obra_id: idobra, certificado_id: certificado, precios_camino: precios_camino, precios_puente: precios_puente, tipo: tipo}, function(result){
    $("#crear-certificado").html(result);
  });
}
function formulario_redeterminacion_definitiva(idobra,certificado,tipo){
  var idobra = idobra;
  var certificado = certificado;
  var tipo = tipo;
  var acta_red = $('#precios_redeterminacion').val();
  $('#agregar_certificados').hide();
  $.post("content/forms/certificado_redeterminado.php", {obra_id: idobra, certificado_id: certificado, precios: acta_red, tipo: tipo}, function(result){
    $("#crear-certificado").html(result);
  });
}
</script>