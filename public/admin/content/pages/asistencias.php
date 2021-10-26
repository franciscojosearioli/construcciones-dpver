<?php
require_once('../../includes/load.php');
require_once('../../includes/functions/php_file_tree.php');   
cabecera('Registro de asistencias');
$user = current_user();
$all_users = find_all_user_dpto((int)$user['iddepartamentos']);
$all_asistencias = all_asistencias();
 ?>
      <div class="row">
        <div class="col-lg-12">
          <?php echo display_msg($msg); ?>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
              <div class="col-12">
                                        <div class="d-flex flex-wrap margin-dt">
                                            <div>
                                                <h3 class="card-title">Listado de asistencias de Agentes en obra</h3>
                                                <h6 class="card-subtitle">Espere unos minutos hasta que cargue la planilla.</h6>
                                                <h6 class="card-subtitle">Deslice la planilla para ver mas información.</h6>
                                            </div>
                                        </div>
      <div class="table-responsive">
                <table id="all" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th></th>
                      <th class="text-center">Mes</th>
                      <th class="text-center">Autor</th>
                      <th class="text-center">Obra</th>
                      <th class="text-center">Archivos</th>
                      <th class="text-center">Subido el</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($all_asistencias as $asistencia):
                      $obra = find_by_id('obras','idobras',$asistencia['idobras']); ?>
                      <tr>
                        <td></td>
                        <td><?php echo $asistencia['fecha']; ?></td>
                        <td><?php echo inspector_name($asistencia['registro_usuario']); ?></td>
                        <td><?php echo '<a href="obra?id='.$obra['idobras'].'" target="_blank">'.$obra['nombre'].'</a>'; ?></td>
                        <td><?php
                        if(file_exists("../../../uploads/obras/".$obra['numero']."/Inspeccion/Asistencias/".$asistencia['numero'])){
                          $allowed_extensions = array("gif", "jpg", "jpeg", "png", "xls", "doc", "dwg", "pdf");
                          echo php_file_tree("../../../uploads/obras/".$obra['numero']."/Inspeccion/Asistencias/".$asistencia['numero'], "[link]", $allowed_extensions);
                        }
                        ?></td>
                        <td><?php echo format_date($obra['registro_fecha']); ?></td>
                      </tr>
                    <?php endforeach;?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th></th>
                      <th class="text-center">Mes</th>
                      <th class="text-center">Autor</th>
                      <th class="text-center">Obra</th>
                      <th class="text-center">Archivos</th>
                      <th class="text-center">Subido el</th>
                    </tr>
                  </tfoot>
                </table>
      </div>
    </div>
  </div>
</div>    
</div>
<?php pie(); ?>