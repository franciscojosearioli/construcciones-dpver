<?php
require_once('../../includes/load.php');
cabecera('Notas archivadas'); 
$user = current_user();
$notas_departamento_archivos = notas_departamento_archivos($user['iddepartamentos']);

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
                                                <h3 class="card-title">Listado de notas archivadas</h3>
                                                <h6 class="card-subtitle">Espere unos minutos hasta que cargue la planilla.</h6>
                                                <h6 class="card-subtitle">Deslice la planilla para ver mas información.</h6>
                                            </div>
                                            <div class="ml-auto">
                                                <ul class="list-inline">
                                                    <li>
                                                        <h6 class="text-muted"><a class="dropdown-item a-icon" title="Imprimir" data-toggle="tooltip" href="registro-notas"><i class="fas fa-print fa-2x"></i></a></h6> 
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
      <div class="table-responsive">
              <table id="lista_notas_archivo" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th> </th>
                    <th class="text-center">  </th>
                    <th class="text-center"> Prioridad </th>
                    <th class="text-center"> Registro </th>   
                    <th> Asunto </th>
                    <th class="text-center"> Iniciador </th>
                    <th class="text-center"> Ubicacion actual </th>
                    <th class="text-center"> Envia </th>
                    <th class="text-center"> Recibe </th>
                    <th class="text-center"> Observacion </th>            
                  </tr>
                </thead>

                <tfoot>
                  <tr>
                    <th> </th>
                    <th class="text-center">  </th>
                    <th class="text-center"> Prioridad </th>
                    <th class="text-center"> Registro </th>   
                    <th> Asunto </th>
                    <th class="text-center"> Iniciador </th>
                    <th class="text-center"> Ubicacion actual </th>
                    <th class="text-center"> Envia </th>
                    <th class="text-center"> Recibe </th>
                    <th class="text-center"> Observacion </th>            
                  </tr>
                </tfoot>


                <tbody>
                  <?php foreach ($notas_departamento_archivos as $nota): ?>
                    <tr>
                      <td class="w-5"></td>
                      <?php if($user['idpermisos'] <= 3 && $user['iddepartamentos'] != 10){ ?>
                        <td>
                          <a class="btn btn-sm btn-danger" href="includes/functions/restaurar.php?id=<?php echo (int)$nota['idnotas'];?>&url=archivo-notas&tipo=nota" data-toggle="tooltip" title="Restaurar"><i class="mdi mdi-backup-restore"></i></a>
                        </td>
                      <?php } ?>
                      <td class="text-center"><?php echo $nota['referencia']; ?></td>
                      <td class="text-center"> <?php
                      if($nota['prioridad'] == 1){ echo '<span class="btn btn-sm btn-danger" data-toggle="tooltip" title="Urgente" style="cursor:default;">Urgente</span>';}
                      if($nota['prioridad'] == 2){ echo '<span class="btn btn-sm btn-warning" data-toggle="tooltip" title="Alto" style="cursor:default;">Alta</span>';}
                      if($nota['prioridad'] == 3){ echo '<span class="btn btn-sm btn-info" data-toggle="tooltip" title="Medio" style="cursor:default;">Media</span>';}
                      if($nota['prioridad'] == 4){ echo '<span class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Bajo" style="cursor:default;">Baja</span>'; }
                      ?></td>
                      <td class="text-center"><?php echo $nota['iniciador']; ?></td>
                      <td class="text-center"><?php echo $nota['asunto']; ?></td>
                      <td class="text-center"><b><?php
                      if($nota['iddepartamentos'] == 1){ echo 'Administracion (Director)';}
                      if($nota['iddepartamentos'] == 2){ echo 'Mesa de entrada (Administrativo)';}
                      if($nota['iddepartamentos'] == 3){ echo 'Obras por Contrato';}
                      if($nota['iddepartamentos'] == 4){ echo 'Certificaciones y Costos';}
                      if($nota['iddepartamentos'] == 5){ echo 'Iluminacion';}
                      if($nota['iddepartamentos'] == 6){ echo 'Señalizacion y Seguridad Vial';}
                      if($nota['iddepartamentos'] == 7){ echo 'Bacheo'; }
                      if($nota['iddepartamentos'] == 8){ echo 'Inspector/Caja'; }         
                      if($nota['iddepartamentos'] == 10){ echo 'SALIO DE LA DIRECCION'; } ?></b><?php echo ' desde el '.ifdate($nota['fecha_pase']);?></td>
                      <td class="text-center"><?php echo $nota['emisor']; ?></td>
                      <td class="text-center"><?php echo $nota['receptor']; ?></td> 
                      <td class="text-center"><?php echo $nota['observaciones']; ?></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>    
    </div>
<script type="text/javascript" src="includes/ajax/scripts/notas.js"></script>
    <?php pie(); ?>