<?php 
require_once('../load.php');
$obra_id = $_POST['obra_id'];
$tipo = $_POST['tipo'];
$user = current_user();
$obra = find_by_id('obras','idobras',$obra_id);
$certificados = listar_certificados_idobras($obra_id);
/*$cantidades_restantes = listar_restantes_certificados($obra_id);*/
?>

<div class="row">
<div class="col-12">
<div class="form-group">
<select class="form-control" id="seleccion-disponibles">
	<option disabled selected>Seleccione una fecha de cantidades acumuladas</option>
	<?php foreach($certificados as $cr){ 
		if($cr['numero'] != 0){ ?>
		<option value="<?php echo $cr['idcertificados_obras'] ?>">
<?php if($cr['month'] == 1){ echo 'Enero'; } ?>
<?php if($cr['month'] == 2){ echo 'Febrero'; } ?>
<?php if($cr['month'] == 3){ echo 'Marzo'; } ?>
<?php if($cr['month'] == 4){ echo 'Abril'; } ?>
<?php if($cr['month'] == 5){ echo 'Mayo'; } ?>
<?php if($cr['month'] == 6){ echo 'Junio'; } ?>
<?php if($cr['month'] == 7){ echo 'Julio'; } ?>
<?php if($cr['month'] == 8){ echo 'Agosto'; } ?>
<?php if($cr['month'] == 9){ echo 'Septiembre'; } ?>
<?php if($cr['month'] == 10){ echo 'Octubre'; } ?>
<?php if($cr['month'] == 11){ echo 'Noviembre'; } ?>
<?php if($cr['month'] == 12){ echo 'Diciembre'; } ?>
<?php echo ' / '.$cr['year']; ?></option>
	<?php } } ?>	
</select>
</div>
</div>
</div>

<div id="seleccion-cert"></div>

<script>
	$('#seleccion-disponibles').on('change', function() {
		var idcertificado = $('#seleccion-disponibles').val();
		var obra = <?php echo $obra_id; ?>;
		var tipo = '<?php echo $tipo; ?>';
  $.post("content/forms/cotizacion-redeterminacion.php", { tipo_red: tipo, obra_id: obra, cert_id: idcertificado}, function(result){
    $("#seleccion-cert").html(result);
  });	
	});

</script>