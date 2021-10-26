<?php
require_once('../../includes/load.php');

$user = current_user();
$plan = find_by_id('planes_de_trabajo','idplanes_de_trabajo',$_POST['id']); 


$obra = find_by_id('obras','idobras',$plan['idobras']);
$user = current_user();
$registro_fecha = make_date();
$planoficial_obras =  rows_planes_obras($plan['idobras'],$plan['idplanes_de_trabajo']);

?>
<div class="row justify-content-center" id="editar_planilla_planesdetrabajo">
<div class="row justify-content-center">
  <div class="col-10">
    <div class="card">
      <div class="card-body cards-titulo">
        <div class="d-flex flex-wrap">
          <div class="my-auto ml-3">
            Editar plan de trabajo
          </div>
          <div class="ml-auto my-auto mr-3">
            <a onclick="cancelar_editar()" title="Cerrar" data-toggle="tooltip"><i class="fas fa-times"></i></a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <form method="post" action="obra?id=<?php echo $obra['idobras']; ?>" id="form_editar">
          <input type="text" name="edit_plan_de_trabajo" hidden>
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
                      <input type="text" name="numero_plan" id="numero_plan" class="form-control" value="<?php echo $plan['numero'];?>" required>
                    </div>
                  </div> 
                  <div class="col-lg-7 col-md-7 col-sm-12">
                     <div class="md-form form-md">
                      <label class="control-label">Detalle</label>
                      <input type="text" name="detalle" id="detalle" class="form-control" value="<?php echo $plan['detalle'];?>" required>
                    </div>
                  </div> 
                  <div class="col-lg-3 col-md-3 col-sm-12">
                     <div class="md-form form-md">
                      <label class="control-label">Referencia</label>
                      <select class="form-control custom-select" name="referencia" required>
                      <optgroup label="Establecido">
                    <?php if($plan['referencia'] == NULL){ echo '<option selected disabled>Sin seleccionar</option>'; }
                    if($plan['referencia'] == 1){ echo '<option value="1" selected>Contrato</option>'; }
                    if($plan['referencia'] == 2){ echo '<option value="2" selected>Modificacion de obra</option>'; }
                    if($plan['referencia'] == 3){ echo '<option value="3" selected>Ampliacion de plazo</option>'; }
                    if($plan['referencia'] == 4){ echo '<option value="4" selected>Readecuacion</option>'; } 
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
<div class="col-12"><label>Planilla de plan de trabajo</label>
<div class="form-group">
  <input type="text" value="<?php echo $obra['idobras']; ?>" name="obra_id" hidden>
  <input type="text" value="<?php echo $plan['idplanes_de_trabajo']; ?>" name="plan_id" hidden>
    
<div class="card-body p-t-30" id="tabla_planoficial">

</div>





        <div class="p-20">
        <div class="table-responsive">  
<table class="table table-bordered no-wrap">
          <thead>
          <tr>
          <?php if(permiso('admin') || permiso('obras') || permiso('planoficial')){ ?><th></th><?php } ?>
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
          <?php if(permiso('admin') || permiso('obras')){ ?>
          <td class="text-center"><?php if(isset($planoficial_obras)){ ?><a class="i-dt-list" href="includes/functions/eliminar.php?id=<?php echo (int)$fila['idobras_planoficial'];?>&url=planes-de-trabajo&tipo=planoficial" data-toggle="tooltip" title="Eliminar"><i class="mdi mdi-close"></i></a><?php } ?></td>
          <?php } ?>
            <td >
            <input type="text" class="form-control" name="idplanes_de_trabajo[]" value="<?php echo $plan['idplanes_de_trabajo']; ?>" hidden>
            <input type="text" class="form-control" name="idobras_planoficial[]" value="<?php echo $fila['idobras_planoficial']; ?>" hidden>
            <input type="text" class="form-control" step="any" name="numero[]" value="<?php echo $fila['numero']; ?>" ></td>
            <td ><input type="text" class="form-control" step="any" name="monto[]" value="<?php echo $fila['monto']; ?>"></td>
            <td><input type="text" class="form-control" step="any" name="avance[]" value="<?php echo $fila['avance']; ?>"></td>
          </tr>
        <?php endforeach; ?>
<?php } ?>
 </tbody>




</table>
</div>
<?php if(permiso('admin') || permiso('obras')){ ?>
          <div class="row">
          <div class="col-lg-6 col-md-6"><div class="col-lg-4"><button type="button" id="addBotonFila" onClick="AgregarFila(<?php echo $plan['idplanes_de_trabajo']; ?>);" class="btn waves-effect waves-light btn-block btn-warning">+ Agregar fila </button></div></div>
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
function AgregarFila(plan){
  var obra = obra;
  var plan = plan;
    $("<tbody>").load("includes/ajax/Addplan.php?obra=<?php echo $obra['idobras']; ?>&plan=<?php echo $plan['idplanes_de_trabajo']; ?>", function() {
        $("#AddFilas").append($(this).html());

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
