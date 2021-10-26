<?php
require_once('../../includes/load.php');
$exp = $_POST['numero'];
$data = find_by_id('tramites', 'numero', $exp);
$pases_expediente = pases_expediente($exp);
$inicio_exp = buscar_expediente($exp);
$user = current_user();
?>
<div class="modal" id="movs-expedientes" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-full" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Movimientos del expediente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body p-4">

            <div class="container">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <b><u>Expediente Nº:</u> <?php echo $exp; ?></b> 
            <hr><b><u>Asunto:</u> <?php echo $data['asunto']; ?></b>
            <hr><b><u>Iniciador:</u> <?php echo $data['iniciador']; ?></b>
            <hr><b><u>Fecha de inicio:</u> <?php echo format_date($data['fecha_inicio']); ?></b>
          </ol>
        </div>
<div class="container">
                    <div class="card-body">
                    <table id="all" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                      <th></th>
                      <th></th>
                        <th class='text-center' style='width: 10%;'> Fecha </th>
                        <th class='text-center' style='width: 50%;'> Ubicacion </th>
                        <th class='text-center' style='width: 10%;'> Nota </th>
                        <th class='text-center' style='width: 10%;'> Folios </th>
                        <th class='text-center' style='width: 10%;'> Norma </th>
                        <th class='text-center' style='width: 10%;'> Norma Nº </th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($pases_expediente as $pases_exp): ?>
                        <tr>
                        <td></td>
                        <td></td>
                          <td><b><?php echo format_date($pases_exp['fecha']); ?></b></td>
                          <td><b><?php echo utf8_encode($pases_exp['tramite']); ?></b></td>
                          <td><b><?php echo utf8_encode($pases_exp['nota']); ?></b></td>
                          <td><b><?php echo utf8_encode($pases_exp['nfolios']); ?></b></td>
                          <td><b><?php echo utf8_encode($pases_exp['norma_tipo']); ?></b></td>
                          <td><center><b><?php echo utf8_encode($pases_exp['norma_nro']); ?></b></center></td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                      <tr>
                      <th></th>
                      <th></th>
                        <th class='text-center' style='width: 10%;'> Fecha </th>
                        <th class='text-center' style='width: 50%;'> Ubicacion </th>
                        <th class='text-center' style='width: 10%;'> Nota </th>
                        <th class='text-center' style='width: 10%;'> Folios </th>
                        <th class='text-center' style='width: 10%;'> Norma </th>
                        <th class='text-center' style='width: 10%;'> Norma Nº </th>
                      </tr>
                    </tfoot>
                  </table>


                            </div>
                          </div>    

            </div>
        </div>
    </div>
</div>