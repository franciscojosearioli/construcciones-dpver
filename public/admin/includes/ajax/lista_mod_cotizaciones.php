<?php 
require_once('../load.php');
$obra = $_POST['id'];
$cotizaciones = cotizaciones($obra);
?>

<div class="row p-t-10">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="md-form form-md">
                          <label class="control-label">Cotizacion a tramitar</label>

                          <select class="form-control cotizacion" name="cotizacion" style="height:80px;width:100%;" required>    
                            <option value="0" selected>Sin cotizacion</option>
                            <?php foreach($cotizaciones as $r): ?>    
                            <option value="<?php echo $r['idcotizaciones']; ?>">Numero <?php echo $r['numero']; ?></option>
                            <?php endforeach; ?>
                            </select>
                        </div>
                      </div>
                      </div> 
<script type="text/javascript">
$(document).ready(function () {
  $('.cotizacion').select2();
});
</script>