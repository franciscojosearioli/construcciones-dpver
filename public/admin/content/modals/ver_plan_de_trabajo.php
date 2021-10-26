<?php
require_once('../../includes/load.php');
$get_id = $_POST['id'];
$user = current_user();
$plan = find_by_id('planes_de_trabajo','idplanes_de_trabajo',$get_id);
$obra = find_by_id('obras','idobras',$plan['idobras']);
$planoficial_obras =  rows_planes_obras($plan['idobras'],$plan['idplanes_de_trabajo']);
?>
<div class="modal fade" id="ver_plan_de_trabajo" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Planilla de plan de trabajo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body p-4">

            <div class="container">

        </div>
<div class="container">
                    <div class="card-body">
                    <h4>Plan de trabajo N <?php echo $plan['numero']; ?></h4>
                    <p>Detalle <?php echo $plan['detalle']; ?></p>
                    <h5><?php echo $obra['nombre']; ?></h5>
                            </div>
                          </div>    
<table class="table table-striped" cellspacing="0" width="100%">
            <thead>
              <tr>
              <th>Numero</th>
            <th>Avance</th>
            <th>Monto</th>
              </tr>
            </thead>
            <tbody>
            <?php foreach ($planoficial_obras as $fila): ?>
            <tr>
            <td><?php echo $fila['numero']; ?></td>
            <td><?php echo $fila['avance']; ?> %</td>
            <td>$ <?php echo numero($fila['monto']); ?></td>
            </tr>         
            <?php endforeach; ?> 
              </tbody>
            </table>
            </div>
        </div>
    </div>
</div>