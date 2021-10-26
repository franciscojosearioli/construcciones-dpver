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
$planoficial_obras = listar_planoficial_obras($obra_id);

if($_POST['form'] == 'agregar'){

$insert = $db->query("INSERT INTO planes_de_trabajo (idobras, numero, detalle, registro_usuario, registro_fecha) VALUES (".$obra_id.", '".$numero."', '".$detalle."', '".$user['id']."', '".$registro_fecha."');");
if($insert){
  $ultimo_id = $db->insert_id(); 
}
}
if($_POST['form'] == 'editar'){
    $ultimo_id = $db->insert_id(); 
  }

?>
<center><h3><?php echo $obra['nombre']; ?></h3></center>
<div class="row">
<div class="col-12"><label>Planilla de plan de trabajo</label>
<div class="form-group">
  <input type="text" value="<?php echo $obra['idobras']; ?>" name="obra_id" hidden>
  <input type="text" value="<?php echo $ultimo_id; ?>" name="plan_id" hidden>
    
<div class="card-body p-t-30" id="tabla_planoficial">
</div>





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
 </tbody>




</table>
</div>
<?php if(permiso('admin') || permiso('obras')){ ?>
          <div class="row">
          <div class="col-lg-6 col-md-6"><div class="col-lg-4"><button type="button" id="addBotonFila" onClick="AgregarFila(<?php echo $ultimo_id; ?>);" class="btn waves-effect waves-light btn-block btn-warning">+ Agregar fila </button></div></div>
          <div class="col-lg-6 col-md-6"></div>
      </div>  
    <?php } ?>
        </div>
        <?php if(permiso('admin') || permiso('obras')){ ?>
        <div class="row">
          <div class="col-lg-6 col-md-6"></div>
          <div class="col-lg-6 col-md-6"><div class="col-lg-3 col-md-4 pull-right"></div></div>
      </div>
    <?php } ?>
    <div class="d-flex flex-wrap">
                                            <div>
                                                <h6 class="text-muted"><a onclick="cancelar_agregar()" class="dropdown-item a-icon" data-toggle="tooltip" title="Cancelar"><i class="fas fa-times fa-2x"></i></a></h6>
                                            </div>
                                            <div class="ml-auto">
                                                <ul class="list-inline">
                                                    <li>
                                                        <h6 class="text-muted"><button type="submit" name="planoficial-form" class="btn waves-effect waves-light btn-block btn-info">Guardar</button><a onclick="submit_agregar();" class=" hide dropdown-item a-icon" data-toggle="tooltip" title="Confirmar"><i class="fas fa-check fa-2x"></i></a></h6> 
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
    $("<tbody>").load("includes/ajax/Addplan.php?obra=<?php echo $obra['idobras']; ?>&plan=<?php echo $ultimo_id; ?>", function() {
        $("#AddFilas").append($(this).html());

    });  
}
</script>