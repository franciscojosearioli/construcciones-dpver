<?php 
require_once('../../includes/load.php');
$obra_id = $_POST['obra_id'];
$planoficial_obras = listar_planoficial_obras($obra_id);
$obra = find_by_id('obras','idobras',$_POST['obra_id']);
    $modificaciones_obra =  modificaciones_de_obra($obra['idobras']);
    $ampliaciones_obra =  ampliaciones_de_obra($obra['idobras']);
    $neutralizaciones_obra =  neutralizaciones_de_obra($obra['idobras']);
    $recepciones_obra =  recepciones_obra($obra['nombre']);
?>


<div class="row justify-content-center" id="plan-de-trabajo">
<div class="col-10">
<div class="d-flex flex-wrap">
    <span class="titulo-bienvenida">Plan de trabajo</span><div class="ml-auto"><ul class="list-inline"><li><h6 class="text-muted"><a onclick="cancelar_ver()" class="dropdown-item a-icon" data-toggle="tooltip" title="Cancelar"><i class="fas fa-times fa-2x"></i> Cerrar</a></h6></li></ul></div>
</div>

<div class="card">
<div class="card-body mx-4">
<h3><?php echo $obra['nombre']; ?></h3>
<p><a href="content/prints/planilla-plandetrabajo.php?id=<?php echo $obra_id; ?>" style="padding-top: 20px;" target="_blank">Imprimir plan de trabajo</a></p>

<form method="post" action="planes-de-trabajo.php?id=<?php echo $obra_id; ?>">

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
          <td class="text-center"><?php if(isset($planoficial_obras)){ ?><a class="i-dt-list" href="includes/functions/eliminar.php?id=<?php echo (int)$fila['idobras_planoficial'];?>&url=obra?id=<?php echo $obra_id; ?>&tipo=planoficial" data-toggle="tooltip" title="Eliminar"><i class="mdi mdi-close"></i></a><?php } ?></td>
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







