<?php 
require_once('../../includes/load.php');
$obra_id = $_POST['obra_id'];
$items_obras = listar_items_obras($obra_id);
$planoficial_obras = listar_planoficial_obras($obra_id);
$obra = find_by_id('obras','idobras',$_POST['obra_id']);
    $modificaciones_obra =  modificaciones_de_obra($obra['idobras']);
    $ampliaciones_obra =  ampliaciones_de_obra($obra['idobras']);
    $neutralizaciones_obra =  neutralizaciones_de_obra($obra['idobras']);
    $recepciones_obra =  recepciones_obra($obra['nombre']);
?>


<div class="row justify-content-center" id="cotizacion-de-obra">
<div class="col-10">
<div class="d-flex flex-wrap">
    <span class="titulo-bienvenida">Cotizacion de obra</span><div class="ml-auto"><ul class="list-inline"><li><h6 class="text-muted"><a onclick="cancelar_ver()" class="dropdown-item a-icon" data-toggle="tooltip" title="Cancelar"><i class="fas fa-times fa-2x"></i> Cerrar</a></h6></li></ul></div>
</div>

<div class="card">
<div class="card-body mx-4">
<h3><?php echo $obra['nombre']; ?></h3>
<p><a href="content/prints/planilla-cotizacion.php?id=<?php echo $obra_id;?>" style="padding-top: 20px;" target="_blank">Imprimir planilla de cotizacion</a></p>

<form method="post" action="cotizaciones.php?id=<?php echo $obra_id; ?>">
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
  <?php if(isset($items_obras)){  
    foreach ($items_obras as $item): ?>

          <tr>
          <?php if(permiso('admin') || permiso('certificaciones')){ ?>
          <td class="text-center"><?php if(isset($items_obras)){ ?><a class="i-dt-list" href="includes/functions/eliminar.php?id=<?php echo (int)$item['idobras_items'];?>&url=cotizaciones?id=<?php echo $obra_id; ?>&tipo=cotizacion" data-toggle="tooltip" title="Eliminar"><i class="mdi mdi-close"></i></a><?php } ?></td>
          <?php } ?>
            <td style="width: 12%">
            <input type="text" class="form-control" name="idobras_items[]" value="<?php echo $item['idobras_items']; ?>" hidden>
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
<?php } ?>
 </tbody>




</table>
</div>
<?php if(permiso('admin') || permiso('certificaciones')){ ?>
          <div class="row">
          <div class="col-lg-6 col-md-6"><div class="col-lg-4"><button type="button" id="addBotonItem" onClick="AgregarItem();" class="btn waves-effect waves-light btn-block btn-warning">+ Agregar item </button></div></div>
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
    </form>



</div>
</div>
</div>

<script>
    function AgregarItem(){
    $("<tbody>").load("includes/ajax/AddItems.php?id=<?php echo $obra_id; ?>", function() {
        $("#AddItems").append($(this).html());

    });  
}
function AgregarFila(){
    $("<tbody>").load("includes/ajax/Addplan.php?id=<?php echo $obra_id; ?>", function() {
        $("#AddFilas").append($(this).html());

    });  
}
</script>







