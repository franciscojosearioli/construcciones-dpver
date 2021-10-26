<?php 
require_once('../../includes/load.php');
$unidades_medidas = listar_unidades(); 
$obra_id = $_GET['obra'];
$cotiz_id = $_GET['cotiz'];

$user = current_user();
$registro_fecha  = make_date();

$insert = $db->query("INSERT INTO obras_items (idcotizaciones, idobras, item, sub_item, descripcion, unidad, cantidad_aprobada, precio_unitario, tipo, registro_usuario, registro_fecha) VALUES (".$cotiz_id.",".$obra_id.", '', '', '', '', '', '', '', '".$user['id']."', '".$registro_fecha."');");
     
if($insert){
  $ultimo_id = $db->insert_id(); 
logs($user['id'],"obras-cotizacion",$ultimo_id,"Agrego item a cotizacion de obra");
}

?>

<tr>
           <td></td><td style="width: 10%">
            <input type="text" class="form-control" name="idcotizaciones[]" value="<?php echo $cotiz_id; ?>" hidden>
            <input type="text" class="form-control" name="idobras_items[]" value="<?php echo $ultimo_id; ?>" hidden>
            <input type="text" class="form-control" name="item[]"></td>
            <td style="width: 5%"><input type="text" class="form-control" name="sub_item[]"></td>
            <td style="width: 35%"><input type="text" class="form-control" name="descripcion[]"></td>
            <td style="width: 10%"><select name="unidad[]" class="custom-select"><?php foreach($unidades_medidas as $u): ?>
            <option value="<?php echo $u['unidad'] ?>"><?php echo $u['unidad']; ?></option>

            <?php endforeach; ?>
              
            </select></td>
            <td style="width: 20%"><input type="number" class="form-control" name="cantidad_aprobada[]" step="any"></td>
            <td style="width: 20%"><input type="number" class="form-control" name="precio_unitario[]" step="any"></td>
            <td style="width: 20%"><select name="tipo[]" class="custom-select">
            <option value="Camino">Camino</option> 
            <option value="Puente">Puente</option>              
            </select></td>
          </tr>