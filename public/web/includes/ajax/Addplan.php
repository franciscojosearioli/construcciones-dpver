
          <?php 
require_once('../../includes/load.php');
$obra_id = $_GET['obra'];
$plan_id = $_GET['plan'];

$user = current_user();
$registro_fecha  = make_date();

$insert = $db->query("INSERT INTO obras_planoficial (idplanes_de_trabajo, idobras, numero, monto, avance, registro_usuario, registro_fecha) VALUES (".$plan_id.", ".$obra_id.", '', '', '', '".$user['id']."', '".$registro_fecha."');");
if($insert){
  $ultimo_id = $db->insert_id(); 
logs($user['id'],"obras-plan",$ultimo_id,"Agrego fila a plan de trabajo");
}

?>

<tr>
           <td></td><td style="width: 30%">
            <input type="text" class="form-control" name="idplanes_de_trabajo[]" value="<?php echo $plan_id; ?>" hidden >
            <input type="text" class="form-control" name="idobras_planoficial[]" value="<?php echo $ultimo_id; ?>" hidden>
            <input type="number" class="form-control" name="numero[]"></td>
            <td style="width: 40%"><input type="text" class="form-control" name="monto[]"></td>
            <td style="width: 30%"><input type="text" class="form-control" name="avance[]"></td>
          </tr>