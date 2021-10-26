<?php 
require_once('../load.php');
$obra_id = $_POST['obra_id'];
$obra = find_by_id('obras','idobras',$obra_id);
$user = current_user();
?>
<center><h3><?php echo $obra['nombre']; ?></h3></center>
<div class="row">
<div class="col-12"><label>Seleccione que tipo de redeterminacion corresponde</label>
<div class="form-group">
<select id="seleccion-tipo" class="form-control">
	<option disabled selected>Seleccione un tipo de certificado</option>
	<option value="provisorio">Provisorio</option>
	<option value="definitivo">Definitivo</option>	
</select>
</div>
</div>
</div>

<div id="seleccion-precios"></div>

<script>
	$('#seleccion-tipo').on('change', function() {
		var nametipo = $('#seleccion-tipo').val();
		var obra = <?php echo $obra_id; ?>;
		$.post("includes/ajax/cantidades_restantes.php", {tipo: nametipo, obra_id: obra}, function(result){
    $("#seleccion-precios").html(result);
});	
	});
</script>