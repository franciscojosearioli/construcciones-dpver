<?php $obra = find_by_id('obras','idobras',(int)$_GET['id']);
$inspectores = all_inspectores();
  $equipo_inspector = usuarios_inspector($obra['idinspector']);

$inspector_asignado = find_by_id('users','id',(int)$obra['idinspector']);


$equipo_asignado = all_equipo_inspector($obra['idinspector'],$obra['idobras']);

?>

<div class="modal fade" id="inspeccion_obras" tabindex="-1" role="dialog" aria-labelledby="inspeccion_obras" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100" id="inspeccion_obras">Inspeccion de obra</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<form method="post" action="obra?id=<?php echo $obra['idobras'];?>">
      <div class="modal-body">
        <div class="form-group p-20">
          <div class="row p-20">
                <div class="col-md-6">
                    <div class="md-form form-md">
                      <label class="control-label">Inspector <i class="fas fa-question-circle" data-toggle="tooltip" title="Inspector de obra"></i></label>
                      <select class="form-control inspectores" name="inspector" style="height:80px;width:100%;">
                  <optgroup label="Establecido">
                    <?php if($obra['idinspector'] != '0' && $obra['idinspector'] != NULL){ ?>
                        <option selected value="<?php echo $obra['idinspector']; ?>" selected ><?php echo $inspector_asignado['nombre'].' '.$inspector_asignado['apellido']; ?></option>
                        <?php }else{ echo '<option selected value="0">No se ha designado inspector</option>'; } ?>
                  </optgroup>
                  <optgroup label="Opciones ">
                        <option value="0">No se ha designado inspector</option>
                      <?php foreach ($inspectores as $i):?>
                        <option value="<?php echo $i['id']; ?>"><?php echo $i['apellido'].' '.$i['nombre']; ?></option>
                      <?php endforeach; ?>
                  </optgroup>
                </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="md-form form-md">
                      <label class="control-label">Equipo de inspector <i class="fas fa-question-circle" data-toggle="tooltip" title="Personal de inspeccion"></i></label>
                      <select class="form-control equipo_inspectores" name="equipo_inspectores[]" style="height:80px;width:100%;" multiple>
                  <optgroup label="Establecido">\
                  <?php foreach($equipo_asignado as $ea): 
$user_equipo = find_by_id('users','id',(int)$ea['idusuario']); ?>
                            <option value="<?php echo $ea['idusuario']; ?>" selected><?php echo $user_equipo['apellido'].' '.$user_equipo['nombre']; ?></option>
                            <?php endforeach; ?>
                  </optgroup>
                  <optgroup label="Opciones ">
                      <?php foreach ($equipo_inspector as $e):?>
                        <option value="<?php echo $e['id']; ?>"><?php echo $e['apellido'].' '.$e['nombre']; ?></option>
                      <?php endforeach; ?>
                  </optgroup>
                </select>
                    </div>
                  </div>
                </div>
              <input type="text" name="idobras" value="<?php echo $obra['idobras'];?>" hidden>
        </div>
      </div>
      <div class="modal-footer">
        <button name="designacion_inspeccion" class="btn btn-info waves-effect waves-light">Actualizar</button>
      </div>
    </form>
    </div>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function () {
  $('.inspectores').select2();
  $('.equipo_inspectores').select2();
});
</script>