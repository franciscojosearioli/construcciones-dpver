<?php 
require_once('../load.php');
$obra_id = $_POST['obra_id2'];
$certificado_id = $_POST['certificado_id'];
$user = current_user();
?>
<div class="row justify-content-center">


<div class="form-group col-6">
<hr>
<center><h5>Seleccione el tipo de redeterminacion</h5></center>
                            <input type="text" name="idobra" id="idobras" value="<?php echo $obra_id; ?>" hidden>
<select id="seleccion-tipo" class="custom-select col-12">
	<option disabled selected>Seleccione un tipo de certificado</option>
	<option value="provisorio">Provisorio</option>
	<option value="definitivo">Definitivo</option>
</select>
                          </div>
            </div>

<div id="seleccion-precios"></div>

<script>
	$('#seleccion-tipo').on('change', function() {
		var nametipo = $('#seleccion-tipo').val();
		var obra_id3 = $('#idobras').val();
		var cert_id = <?php echo $certificado_id; ?>;
  $.post("includes/ajax/listar_precios_redeterminacion.php", {tipo: nametipo, obra: obra_id3, certif_id: cert_id}, function(result){
    $("#seleccion-precios").html(result);
  });	
	});
</script>