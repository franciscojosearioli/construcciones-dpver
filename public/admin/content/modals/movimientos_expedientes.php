<?php
require_once('../../includes/load.php');
$get_id = $_POST['id'];
$data = find_by_id('expedientes', 'idexpedientes', $get_id);
$expediente = expedientes_movimientos(trim($data['expediente']));
$original = buscar_expediente(trim($data['expediente']));
$user = current_user();
?>
<div class="modal" id="expediente_movimiento" tabindex="-1" role="dialog" aria-hidden="true">
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
            <?php if(!empty($data['expediente'])){ ?><b><u>Expediente Nº:</u> <?php echo $data['expediente']; ?></b><?php }elseif(!empty($original['numero'])){ ?><b><u>Expediente Nº:</u> <?php echo $original['numero']; ?></b><?php } ?> 
            <?php if(!empty($data['asunto'])){ ?><hr><b><u>Asunto:</u> <?php echo $data['asunto']; ?></b><?php }elseif(!empty($original['asunto'])){ ?><hr><b><u>Asunto:</u> <?php echo utf8_encode($original['asunto']); ?></b><?php } ?>
            <?php if(!empty($data['iniciador'])){ ?><hr><b><u>Iniciador:</u> <?php echo $data['iniciador']; ?></b><?php }elseif(!empty($original['iniciador'])){ ?><hr><b><u>Iniciador:</u> <?php echo utf8_encode($original['iniciador']); ?></b><?php } ?>
            <?php if(!empty($data['fecha_inicio'])){ ?><hr><b><u>Fecha de inicio:</u> <?php echo format_date($data['fecha_inicio']); ?></b><?php }elseif(!empty($original['fechareg'])){ ?><hr><b><u>Fecha de inicio:</u> <?php echo format_date($original['fechareg']); ?></b><?php } ?>
          </ol>
        </div>
<div class="container">
                    <div class="card-body">
           <table class="table table-striped" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th> Fecha </th>
                <th> Ubicacion </th>
                <th> Observaciones </th>
                <th> Folios </th>
                <th> Norma </th>
                <th> Numero </th>
              </tr>
            </thead>
            <tbody>
<?php foreach($expediente as $movimiento): ?>
                <tr>
                  <td><?php echo format_date($movimiento['fecha']); ?></td>
                  <td><?php echo find_select('nombre','departamentos','iddepartamentos',$movimiento['iddepartamentos']) ?> (<?php echo find_select('nombre','direcciones','iddireccion',$movimiento['iddireccion']) ?>)</td>
                  <td><?php echo $movimiento['observaciones']; ?></td>
                  <td><?php echo $movimiento['folios']; ?></td>
                  <td><?php echo $movimiento['norma_tipo']; ?></td>
                  <td><?php echo $movimiento['norma_numero']; ?></td>
                </tr>
<?php endforeach; ?>              
              </tbody>
            </table>


                            </div>
                          </div>    

            </div>
            <div class="modal-footer">
                <a href="../includes/prints/movimientos_expedientes?id=<?php echo $get_id; ?>" target="_blank" class="btn btn-secondary" >Imprimir</a>
            </div>
        </div>
    </div>
</div>