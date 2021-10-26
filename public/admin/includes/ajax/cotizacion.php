<?php 
require_once('../load.php');
$obra_id = $_POST['obra_id'];
$numero = $_POST['numero'];
$expediente = $_POST['expediente'];
$estado = $_POST['estado'];
$n_reso = $_POST['n_reso'];
$f_reso = $_POST['f_reso'];
$detalle = $_POST['detalle'];
$obra = find_by_id('obras','idobras',$obra_id);
$user = current_user();
$registro_fecha = make_date();

$items_obras = listar_items_obras($obra_id);

  $insertar = $db->query("INSERT INTO cotizaciones (idobras, numero, detalle, registro_usuario, registro_fecha) VALUES (".$obra_id.", '".$numero."', '".$detalle."', '".$user['id']."', '".$registro_fecha."');");
    $ultimo_id = $db->insert_id(); 




?>
<center><h3><?php echo $obra['nombre']; ?></h3></center>
<div class="row">
<div class="col-12"><label>Planilla de cotizacion</label>
<div class="form-group">
  <input type="text" value="<?php echo $obra['idobras']; ?>" name="obra_id" hidden>
  <input type="text" value="<?php echo $ultimo_id; ?>" name="cotiz_id" hidden>


<div class="card-body p-t-30" id="tabla_cotizacion">
  </div>
        <div class="p-20">
        <div class="table-responsive">  
<table class="table table-bordered no-wrap">
          <thead>
          <tr>
          <?php if(permiso('admin') || permiso('certificaciones')){ ?><th></th><?php } ?>
            <th>Item</th>
            <th>Sub-Item</th>
            <th>Descripcion</th>
            <th>Unidad</th>
            <th>Cantidades</th>
            <th>Precio unitario</th>
            <th>Tipo</th>
          </tr>
          </thead>
          



<tbody id="AddItems">
  <!--<?php if(isset($items_obras)){  
    foreach ($items_obras as $item): ?>

          <tr>
          <?php if(permiso('admin') || permiso('certificaciones')){ ?>
          <td class="text-center"><?php if(isset($items_obras)){ ?><a class="i-dt-list" href="includes/functions/eliminar.php?id=<?php echo (int)$item['idobras_items'];?>&url=obra?id=<?php echo $_GET['id']; ?>&tipo=cotizacion" data-toggle="tooltip" title="Eliminar"><i class="mdi mdi-close"></i></a><?php } ?></td>
          <?php } ?>
            <td style="width: 12%">
            <input type="text" class="form-control" name="idcotizaciones[]" value="idcotizaciones">
            <input type="text" class="form-control" name="idobras_items[]" value="<?php echo $item['idobras_items']; ?>">
            <input type="text" class="form-control" name="item[]" value="<?php echo $item['item']; ?>" <?php if(!permiso('admin') && !permiso('certificaciones')){ echo 'disabled'; } ?>></td>
            <td style="width: 10%"><input type="text" class="form-control" name="sub_item[]" value="<?php echo $item['sub_item']; ?>" <?php if(!permiso('admin') && !permiso('certificaciones')){ echo 'disabled'; } ?>></td>
            <td style="width: 40%"><input type="text" class="form-control" name="descripcion[]" value="<?php echo $item['descripcion']; ?>" <?php if(!permiso('admin') && !permiso('certificaciones')){ echo 'disabled'; } ?>></td>
            <td style="width: 8%"><select name="unidad[]" class="custom-select" <?php if(!permiso('admin') && !permiso('certificaciones')){ echo 'disabled'; } ?>>
                  <optgroup label="Establecido">
            <option value="<?php echo $item['unidad']; ?>" selected><?php echo $item['unidad']; ?></option>
            </optgroup>
                  <optgroup label="Opciones ">
            <?php foreach($unidades_medidas as $u): ?>
            <option value="<?php echo $u['unidad'] ?>"><?php echo $u['unidad']; ?></option>
            <?php endforeach; ?>
              </optgroup>
            </select></td>
            <td style="width: 18%">
              <input type="number" step="0.001" class="form-control" name="cantidad_aprobada[]" value="<?php echo $item['cantidad_aprobada']; ?>" <?php if($item['unidad'] == 'No define'){ echo 'hidden'; } ?> <?php if(!permiso('admin') && !permiso('certificaciones')){ echo 'disabled'; } ?>></td>
            <td style="width: 18%"><input type="number" class="form-control" name="precio_unitario[]" step="any" value="<?php echo $item['precio_unitario']; ?>" <?php if(!permiso('admin') && !permiso('certificaciones')){ echo 'disabled'; } ?> <?php if($item['unidad'] == 'No define'){ echo 'hidden'; } ?>>            <input type="text" class="form-control" name="registro_usuario[]" value="<?php echo $user['id']; ?>" hidden>
            <input type="text" class="form-control" name="registro_fecha[]" value="<?php echo make_date(); ?>" hidden></td>
            <td style="width: 18%"> <select name="tipo[]" <?php if($item['unidad'] == 'No define'){ echo 'hidden'; } ?> class="custom-select" <?php if(!permiso('admin') && !permiso('certificaciones')){ echo 'disabled'; } ?>>
                  <optgroup label="Establecido">
                    <?php if($item['tipo'] == null){ ?>
            <option disabled selected>Sin definir</option>
                    <?php }else{ ?>
            <option value="<?php echo $item['tipo']; ?>" selected><?php echo $item['tipo']; ?></option>
          <?php } ?>
            </optgroup>
                  <optgroup label="Opciones ">
            <option value="Camino">Camino</option>
            <option value="Puente">Puente</option>
              </optgroup>
            </select></td>
          </tr>
        <?php endforeach; ?>
<?php } ?>-->
 </tbody>




</table>
</div>
<?php if(permiso('admin') || permiso('certificaciones')){ ?>
          <div class="row">
          <div class="col-lg-6 col-md-6"><div class="col-lg-4"><button type="button" id="addBotonItem" onClick="AgregarItem(<?php echo $ultimo_id; ?>);" class="btn waves-effect waves-light btn-block btn-warning">+ Agregar item </button></div></div>
          <div class="col-lg-6 col-md-6"></div>
      </div>  
    <?php } ?>
        </div>
        <?php if(permiso('admin') || permiso('certificaciones')){ ?>
        <div class="row">
          <div class="col-lg-6 col-md-6"></div>
          <div class="col-lg-6 col-md-6"><div class="col-lg-3 col-md-4 pull-right"><button type="submit" name="cotizacion-items-form" class="btn waves-effect waves-light btn-block btn-info">Guardar</button></div></div>
      </div>
    <?php } ?>
    </div>

</div>
</div>
</div>

<script>
  function AgregarItem(cotiz){
    var cotiz = cotiz;
    $("<tbody>").load("includes/ajax/AddItems.php?obra=<?php echo $obra['idobras']; ?>&cotiz=<?php echo $ultimo_id; ?>", function() {
        $("#AddItems").append($(this).html());

    });  
}
</script>