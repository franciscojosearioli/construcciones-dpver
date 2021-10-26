<?php
require_once('../../includes/load.php');
$get_id = $_POST['id'];
$data = find_by_id('tramites', 'idtramites', $get_id);
$expediente = tramites_movimientos($data['idtramites']);
$original = buscar_expediente(trim($data['numero']));
$user = current_user();
?>
<div class="modal" id="tramite_movimiento" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Movimientos del tramite</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body p-4">

            <div class="container">

        </div>
<div class="container">
                    <div class="card-body">
           <table class="table table-striped" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th> Fecha </th>
                <th> Pase </th>
                <th> Folios </th>
                <th> Norma </th>
                <th> Numero </th>
                <th> Observaciones </th>
              </tr>
            </thead>
            <tbody>
<?php foreach($expediente as $movimiento): ?>
                <tr>
                  <td><?php echo format_date($movimiento['fecha']); ?></td>
                  <td><?php echo find_select('nombre','departamentos','iddepartamentos',$movimiento['iddepartamentos']) ?> (<?php echo find_select('nombre','direcciones','iddireccion',$movimiento['iddireccion']) ?>)</td>
                  <td><?php echo $movimiento['folios']; ?></td>
                  <td><?php echo $movimiento['norma_tipo']; ?></td>
                  <td><?php echo $movimiento['norma_numero']; ?></td>
                  <td><?php echo $movimiento['observaciones']; ?></td>                  
                </tr>
<?php endforeach; ?>              
              </tbody>
            </table>


                            </div>
                          </div>    

            </div>
        </div>
    </div>
</div>