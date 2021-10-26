<?php
require_once('../../includes/load.php');
$obra_id=$_GET['id'];
$user = current_user();
$obra = find_by_id('obras','idobras',(int)$_GET['id']);  
if($obra['estado'] == 1){ redirect('proyecto?id='.$obra_id, false); }
require_once('../../includes/functions/obras.php');  
require_once('../../../uploads/files.php'); 
$unidades_medidas = listar_unidades();
$items_obras = listar_items_obras($obra_id);
$planoficial_obras = listar_planoficial_obras($obra_id);
$ejecutados = all_oyp();
$certificados = certificados_obras($obra_id);
$ordenes = ordenes_de_servicio($obra_id);
$notas = notas_de_pedido($obra_id);
$all_user = all_usuarios();
$obra_bacheo = obra_bacheo($obra_id);
$inspeccion_informe = informes_inspeccion($obra_id);   
$inspeccion_asistencia = asistencias_inspeccion($obra_id);  
$inspectores = all_inspectores();
$obra_timeline = obra_timeline($obra_id);
foreach($ejecutados as $obra):
  if($obra['idobras'] == $obra_id){
    $modificaciones_de_obra =  modificaciones_de_obra($obra['idobras']);
    $ampliaciones_de_obra =  ampliaciones_de_obra($obra['idobras']);
    $neutralizaciones_de_obra =  neutralizaciones_de_obra($obra['idobras']);
    ?>
<div class="row justify-content-center">
  <div class="col-lg-12 col-md-12 col-sm-12">
<div class="card card-signin p-20">
<div class="row justify-content-center">
  <div class="col-6"><center><button class="btn waves-effect waves-light btn-info" id="cotiz">Cotizacion</button></center></div>
     <div class="col-6"><center><button class="btn waves-effect waves-light btn-info" id="planofi">Plan de trabajo</button></center></div>
    
</div>

<div class="card-body p-t-30" id="tabla_cotizacion">
  <div class="text-center"><h3>Cotizacion </h3>
  <a href="content/prints/planilla-cotizacion.php?id=<?php echo $obra_id;?>" target="_blank">Imprimir planilla de cotizacion</a>
  </div>
<form method="post" action="obra.php?id=<?php echo (int)$_GET['id']; ?>">
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
          <td class="text-center"><?php if(isset($items_obras)){ ?><a class="i-dt-list" href="includes/functions/eliminar.php?id=<?php echo (int)$item['idobras_items'];?>&url=obra?id=<?php echo $_GET['id']; ?>&tipo=cotizacion" data-toggle="tooltip" title="Eliminar"><i class="mdi mdi-close"></i></a><?php } ?></td>
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



<div class="card-body p-t-30" id="tabla_planoficial">

<div class="text-center"><h3>Plan de trabajo</h3>

<a href="content/prints/planilla-plandetrabajo.php?id=<?php echo $obra_id;?>" target="_blank">Imprimir planilla de plan de trabajo</a>
<form method="post" action="obra.php?id=<?php echo (int)$_GET['id']; ?>">

        <div class="p-20">
        <div class="table-responsive">  
<table class="table table-bordered no-wrap">
          <thead>
          <tr>
          <?php if(permiso('admin') || permiso('certificaciones') || permiso('planoficial')){ ?><th></th><?php } ?>
            <th>Numero</th>
            <th>Monto</th>
            <th>Avance</th>
          </tr>
          </thead>
          



<tbody id="AddFilas">
  <?php if(isset($planoficial_obras)){ 
  

   ?>
<?php foreach ($planoficial_obras as $fila): ?>

          <tr>
          <?php if(permiso('admin') || permiso('certificaciones')){ ?>
          <td class="text-center"><?php if(isset($planoficial_obras)){ ?><a class="i-dt-list" href="includes/functions/eliminar.php?id=<?php echo (int)$fila['idobras_planoficial'];?>&url=obra?id=<?php echo $_GET['id']; ?>&tipo=planoficial" data-toggle="tooltip" title="Eliminar"><i class="mdi mdi-close"></i></a><?php } ?></td>
          <?php } ?>
            <td style="width: 30%">
            <input type="text" class="form-control" name="idobras_planoficial[]" value="<?php echo $fila['idobras_planoficial']; ?>" hidden>
            <input type="text" class="form-control" name="numero[]" value="<?php echo $fila['numero']; ?>" ></td>
            <td style="width: 40%"><input type="text" class="form-control" name="monto[]" value="<?php echo $fila['monto']; ?>"></td>
            <td style="width: 30%"><input type="text" class="form-control" name="avance[]" value="<?php echo $fila['avance']; ?>"></td>
          </tr>
        <?php endforeach; ?>
<?php } ?>
 </tbody>




</table>
</div>
<?php if(permiso('admin') || permiso('certificaciones')){ ?>
          <div class="row">
          <div class="col-lg-6 col-md-6"><div class="col-lg-4"><button type="button" id="addBotonFila" onClick="AgregarFila();" class="btn waves-effect waves-light btn-block btn-warning">+ Agregar fila </button></div></div>
          <div class="col-lg-6 col-md-6"></div>
      </div>  
    <?php } ?>
        </div>
        <?php if(permiso('admin') || permiso('certificaciones')){ ?>
        <div class="row">
          <div class="col-lg-6 col-md-6"></div>
          <div class="col-lg-6 col-md-6"><div class="col-lg-3 col-md-4 pull-right"><button type="submit" name="planoficial-form" class="btn waves-effect waves-light btn-block btn-info">Guardar</button></div></div>
      </div>
    <?php } ?>
    </form>
    </div>

  </div>  
</div>
</div>

<script type="text/javascript">

$(document).ready(function() {
  
  $('#tabla_planoficial').hide();
$('#cotiz').click(function() {
  $('#tabla_cotizacion').show();
  $('#tabla_planoficial').hide();
});  
$('#planofi').click(function() {
  $('#tabla_cotizacion').hide();
  $('#tabla_planoficial').show();
});  

});

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
<?php 
} endforeach;
?>