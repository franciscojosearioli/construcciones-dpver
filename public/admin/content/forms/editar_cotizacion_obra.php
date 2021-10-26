<?php
require_once('../../includes/load.php');
$unidades_medidas = listar_unidades(); 

$user = current_user();
$cotizacion = find_by_id('cotizaciones','idcotizaciones',$_POST['id']); 


$obra = find_by_id('obras','idobras',$cotizacion['idobras']);
$user = current_user();
$registro_fecha = make_date();
$items_obras = rows_cotizaciones_obras($cotizacion['idobras'],$cotizacion['idcotizaciones']);


?>
<div class="row justify-content-center" id="editar_planilla_cotizacion">
<div class="row justify-content-center">
  <div class="col-10">
    <div class="card">
      <div class="card-body cards-titulo">
        <div class="d-flex flex-wrap">
          <div class="my-auto ml-3">
            Editar cotizacion de obra
          </div>
          <div class="ml-auto my-auto mr-3">
            <a onclick="cancelar_editar()" title="Cerrar" data-toggle="tooltip"><i class="fas fa-times"></i></a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <form method="post" action="obra?id=<?php echo $obra['idobras']; ?>" id="form_editar">
          <input type="text" name="edit_cotizacion" hidden>
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
              <div class="form-group p-r-10 p-l-10">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="row title-form">
                    Informacion del acta y resolucion
                  </div>
                </div>
                <div class="row p-t-20">
                  <div class="col-lg-2 col-md-2 col-sm-12">
                     <div class="md-form form-md">
                      <label class="control-label">Numero</label>
                      <input type="text" name="numero_cotiz" id="numero_cotiz" class="form-control" value="<?php echo $cotizacion['numero'];?>" required>
                    </div>
                  </div> 
                  <div class="col-lg-7 col-md-7 col-sm-12">
                     <div class="md-form form-md">
                      <label class="control-label">Detalle</label>
                      <input type="text" name="detalle" id="detalle" class="form-control" value="<?php echo $cotizacion['detalle'];?>" required>
                    </div>
                  </div> 
                  <div class="col-lg-3 col-md-3 col-sm-12">
                     <div class="md-form form-md">
                      <label class="control-label">Referencia</label>
                      <select class="form-control custom-select" name="referencia" required>
                      <optgroup label="Establecido">
                    <?php if($cotizacion['referencia'] == NULL){ echo '<option selected disabled>Sin seleccionar</option>'; }
                    if($cotizacion['referencia'] == 1){ echo '<option value="1" selected>Contrato</option>'; }
                    if($cotizacion['referencia'] == 2){ echo '<option value="2" selected>Modificacion de obra</option>'; }
                    if($cotizacion['referencia'] == 4){ echo '<option value="4" selected>Readecuacion</option>'; } 
                    ?>
                  </optgroup>
                  <optgroup label="Opciones ">
                    <option value="1">Contrato</option>
                    <option value="2">Modificacion de obra</option>
                    <option value="4">Readecuacion</option>
                  </optgroup>
                      </select>
                    </div>
                  </div> 
                </div>
              </div>
              <div class="form-group p-r-10 p-l-10"> 
                <center><h3><?php echo $obra['nombre']; ?></h3></center>
<div class="row">
<div class="col-12"><label>Planilla de cotizacion</label>
<div class="form-group">
  <input type="text" value="<?php echo $obra['idobras']; ?>" name="obra_id" hidden>
  <input type="text" value="<?php echo $cotizacion['idcotizaciones']; ?>" name="cotiz_id" hidden>
    
<div class="card-body p-t-30" id="tabla_cotizacion">
</div>





        <div class="p-20">
        <div class="table-responsive">  
<table class="table table-bordered no-wrap">
          <thead>
          <tr>
          <?php if(permiso('admin') || permiso('obras')){ ?><th></th><?php } ?>
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
          <?php if(permiso('admin') || permiso('obras')){ ?>
          <td class="text-center"><?php if(isset($items_obras)){ ?><a class="i-dt-list" href="includes/functions/eliminar.php?id=<?php echo (int)$item['idobras_items'];?>&url=cotizaciones&tipo=cotizacion" data-toggle="tooltip" title="Eliminar"><i class="mdi mdi-close"></i></a><?php } ?></td>
          <?php } ?>
            <td style="width: 12%">
            <input type="text" class="form-control" name="idobras_items[]" value="<?php echo $item['idobras_items']; ?>" hidden>
            <input type="text" class="form-control" name="item[]" value="<?php echo $item['item']; ?>" <?php if(!permiso('admin') && !permiso('obras')){ echo 'disabled'; } ?>></td>
            <td style="width: 10%"><input type="text" class="form-control" name="sub_item[]" value="<?php echo $item['sub_item']; ?>" <?php if(!permiso('admin') && !permiso('obras')){ echo 'disabled'; } ?>></td>
            <td style="width: 40%"><input type="text" class="form-control" name="descripcion[]" value="<?php echo $item['descripcion']; ?>" <?php if(!permiso('admin') && !permiso('obras')){ echo 'disabled'; } ?>></td>
            <td style="width: 8%"><select name="unidad[]" class="custom-select" <?php if(!permiso('admin') && !permiso('obras')){ echo 'disabled'; } ?>>
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
              <input type="number" step="any" class="form-control" name="cantidad_aprobada[]" value="<?php echo $item['cantidad_aprobada']; ?>" <?php if($item['unidad'] == 'No define'){ echo 'hidden'; } ?> <?php if(!permiso('admin') && !permiso('obras')){ echo 'disabled'; } ?>></td>
            <td style="width: 18%"><input type="number" class="form-control" name="precio_unitario[]" step="any" value="<?php echo $item['precio_unitario']; ?>" <?php if(!permiso('admin') && !permiso('obras')){ echo 'disabled'; } ?> <?php if($item['unidad'] == 'No define'){ echo 'hidden'; } ?>>            <input type="text" class="form-control" name="registro_usuario[]" value="<?php echo $user['id']; ?>" hidden>
            <input type="text" class="form-control" name="registro_fecha[]" value="<?php echo make_date(); ?>" hidden></td>
            <td style="width: 18%"> <select name="tipo[]" <?php if($item['unidad'] == 'No define'){ echo 'hidden'; } ?> class="custom-select" <?php if(!permiso('admin') && !permiso('obras')){ echo 'disabled'; } ?>>
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
<?php if(permiso('admin') || permiso('obras')){ ?>
          <div class="row">
          <div class="col-lg-6 col-md-6"><div class="col-lg-4"><button type="button" id="addBotonItem" onClick="AgregarItem(<?php echo $cotizacion['idcotizaciones']; ?>);" class="btn waves-effect waves-light btn-block btn-warning">+ Agregar fila </button></div></div>
          <div class="col-lg-6 col-md-6"></div>
      </div>  
    <?php } ?>
        </div>
        <?php if(permiso('admin') || permiso('obras')){ ?>
        <div class="row">
          <div class="col-lg-6 col-md-6"></div>
          <div class="col-lg-6 col-md-6"><div class="col-lg-3 col-md-4 pull-right hide"><button type="submit" name="planoficial-form" class="btn waves-effect waves-light btn-block btn-info">Guardar</button></div></div>
      </div>
    <?php } ?>
    <div class="d-flex flex-wrap">
                                            <div>
                                                <h6 class="text-muted"><a onclick="cancelar_editar()" class="dropdown-item a-icon" data-toggle="tooltip" title="Cancelar"><i class="fas fa-times fa-2x"></i></a></h6>
                                            </div>
                                            <div class="ml-auto">
                                                <ul class="list-inline">
                                                    <li>
                                                        <h6 class="text-muted"><button type="submit" class="dropdown-item a-icon" data-toggle="tooltip" title="Confirmar"><i class="fas fa-check fa-2x"></i></button></h6> 
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
    </div>






</div>
</div>
</div>
<script>
  function AgregarItem(cotiz){
    var cotiz = cotiz;
    $("<tbody>").load("includes/ajax/AddItems.php?obra=<?php echo $obra['idobras']; ?>&cotiz=<?php echo $cotizacion['idcotizaciones']; ?>", function() {
        $("#AddItems").append($(this).html());

    });  
}
</script>



              </div>
            </div>

          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>

  <script>

function obra_plan(id){
  var id = id;
  var form = 'editar';
  var numero = $('#numero_plan').val();
  var expediente = $('#expediente').val();
  var estado = $('#estado').val();
  var n_reso = $('#n_reso').val();
  var f_reso = $('#f_reso').val();


  $.post("includes/ajax/plan_de_trabajo.php", {obra_id: id,form:form,numero:numero,expediente:expediente,estado:estado,n_reso:n_reso,f_reso:f_reso}, function(result){
    $('#busqueda_redeter').hide();
    $('.tt-hint').hide();

    $("#planilla-plan").html(result);
  });
  }



$(document).ready(function(){
busquedaglobal = new Bloodhound({datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),queryTokenizer: Bloodhound.tokenizers.whitespace,remote: {url:'./includes/ajax/busqueda_obra.php?key=%QUERY',wildcard: '%QUERY',filter: function (results) {return $.map(results, function (result) {return {value: result};});}}});

    busquedaglobal.initialize();

    $('#busqueda_redeter').typeahead(null, {
    name: 'value',
    display: 'value',  
    source: busquedaglobal,
    limit:30,
    templates: {
    suggestion:  function(data) {
        if(data.value.estado == 0){
                    return '<a style="text-decoration:none;font-size:11px;line-height: 1.5" onclick="obra_plan('+data.value.idobras+')"><div>OBRA: '+ data.value.nombre.substring(0, 40) +'...<br>ESTADO: En ejecucion<br>EXPEDIENTE: '+data.value.expediente+'<br>CAJA: '+data.value.numero+'</div></a>'
    }if(data.value.estado == 4){
                    return '<a style="text-decoration:none;font-size:11px;line-height: 1.5" onclick="obra_plan('+data.value.idobras+')"><div>OBRA: '+ data.value.nombre.substring(0, 40) +'...<br>ESTADO: Neutralizada<br>EXPEDIENTE: '+data.value.expediente+'<br>CAJA: '+data.value.numero+'</div></a>'
    }if(data.value.estado == 5){
                    return '<a style="text-decoration:none;font-size:11px;line-height: 1.5" onclick="obra_plan('+data.value.idobras+')"><div>OBRA: '+ data.value.nombre.substring(0, 40) +'...<br>ESTADO: Rescindida<br>EXPEDIENTE: '+data.value.expediente+'<br>CAJA: '+data.value.numero+'</div></a>'
    }
    if(data.value.estado == 3){
     if(data.value.finalizado == 0){
                     return '<a style="text-decoration:none;font-size:11px;line-height: 1.5" onclick="obra_plan('+data.value.idobras+')"><div>OBRA: '+ data.value.nombre.substring(0, 40) +'...<br>ESTADO: Finalizada sin recibir<br>EXPEDIENTE: '+data.value.expediente+'<br>CAJA: '+data.value.numero+'</div></a>'
     }if(data.value.finalizado == 1){
                     return '<a style="text-decoration:none;font-size:11px;line-height: 1.5" onclick="obra_plan('+data.value.idobras+')"><div>OBRA: '+ data.value.nombre.substring(0, 40) +'...<br>ESTADO: Finalizada en garantia<br>EXPEDIENTE: '+data.value.expediente+'<br>CAJA: '+data.value.numero+'</div></a>'
     }if(data.value.finalizado == 2){
                     return '<a style="text-decoration:none;font-size:11px;line-height: 1.5" onclick="obra_plan('+data.value.idobras+')"><div>OBRA: '+ data.value.nombre.substring(0, 40) +'...<br>ESTADO: Finalizada definitiva<br>EXPEDIENTE: '+data.value.expediente+'<br>CAJA: '+data.value.numero+'</div></a>'
     }
    }
                }
    }

});

});
</script>
