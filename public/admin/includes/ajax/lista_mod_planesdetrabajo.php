<?php 
require_once('../load.php');
$obra = $_POST['id'];
$planes = planes_de_trabajo($obra);
?>

<div class="row p-t-10">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="md-form form-md">
                        <?php echo $data['idplanes_de_trabajo']; ?>
                          <label class="control-label">Plan de trabajo a tramitar</label>
                          <select class="form-control plan" name="plan-de-trabajo" style="height:80px;width:100%;" required>    
                            <option value="0" selected>Sin plan de trabajo</option>
                            <?php foreach($planes as $r): ?>    
                            <option value="<?php echo $r['idplanes_de_trabajo']; ?>">Numero <?php echo $r['numero']; ?></option>
                            <?php endforeach; ?>
                            </select>
                        </div>
                      </div>
                      </div> 
<script type="text/javascript">
$(document).ready(function () {
  $('.plan').select2();
});
</script>