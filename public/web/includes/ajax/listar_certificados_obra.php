<?php 
require_once('../load.php');
$obra_id = $_POST['obra_id'];
$user = current_user();
$obra = find_by_id('obras','idobras',$obra_id);
$certificados = listar_certificados_idobras($obra_id);
?>

<div class="row">
<div class="col-12">
<center><h3><b><?php echo $obra['nombre']; ?></b></h3></center>
</div>
</div>
<div class="row justify-content-center">


<div class="form-group col-6">
<hr>
<center><h5>Seleccione el certificado de obra para redeterminar</h5></center>
                            <input type="text" name="idobra" id="idobras" value="<?php echo $obra_id; ?>" hidden>
<select id="seleccion-certificado" class="custom-select col-12">
<option disabled selected>Seleccione un certificado</option>
<?php foreach($certificados as $c){ 
if($c['numero'] != 0){?>
	<option value="<?php echo $c['idcertificados_obras']; ?>" >Certifcado N <?php echo $c['numero']; ?></option>
<?php } } ?>
</select>
                          </div>
            </div>

<div id="tipo_redeterminacion"></div>
<script>
	$('#seleccion-certificado').on('change', function() {
		var idcertificado = $('#seleccion-certificado').val();
		var idobra = $('#idobras').val();
$.post("includes/ajax/tipo_redeterminacion.php", {obra_id2: idobra, certificado_id: idcertificado}, function(result){
    $("#tipo_redeterminacion").html(result);
  });
		
	});

</script>