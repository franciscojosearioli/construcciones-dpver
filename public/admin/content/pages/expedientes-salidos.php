<?php
require_once('../../includes/load.php');

cabecera('Expedientes fuera de la direccion'); 
$user = current_user();
$expedientes_departamento_salidos = expedientes_departamento_salidos($user['iddepartamentos']);

?>
      <div class="row">
        <div class="col-lg-12">
          <?php echo display_msg($msg); ?>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12 col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
              <div class="col-12">
                                        <div class="d-flex flex-wrap">
                                            <div>
                                                <h3 class="card-title">Listado de expedientes fuera de la direccion</h3>
                                                <h6 class="card-subtitle"><?php echo find_select('nombre','direcciones','iddireccion',$user['iddireccion']) ?></h6>
                                            </div>
                                            <div class="ml-auto">
                                                <ul class="list-inline">

                                                    <li>
                                                        <h6 class="text-muted"><a class="dropdown-item a-icon" title="Imprimir" data-toggle="tooltip" href="registro-expedientes"><i class="fas fa-print fa-2x"></i></a></h6> 
                                                    </li>
                                                    <!--<li>
                                                        <h6 class="text-muted"><i class="fas fa-ellipsis-v font-16"></i></h6> 
                                                    </li>-->
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                  </div>

            <hr class="m-t-0 m-b-0"></div>
          <div class="card-body">
            <div class="table-responsive m-t-40">
              <table id="1" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                  <tr> 
                    <th class="w-5"></th>               
                    <th class="text-center"> Prioridad </th>
                    <th class="text-center"> Expediente </th>
                    <th> Asunto </th>
                    <th class="text-center"> Iniciador </th>
                    <th class="text-center"> Ubicacion </th>
                    <th class="text-center"> Envia </th>
                    <th class="text-center"> Recibe </th>
                    <th class="text-center"> Observacion </th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($expedientes_departamento_salidos as $expediente):
                    $buscar_expediente = buscar_expediente($expediente['expediente']); ?>
                    <tr>
                      <td class="w-5"></td>
                      <td class="text-center"> <?php
                      if($expediente['prioridad'] == 1){ echo '<span class="btn btn-sm btn-danger" data-toggle="tooltip" title="Urgente" style="cursor:default;">Urgente</span>';}
                      if($expediente['prioridad'] == 2){ echo '<span class="btn btn-sm btn-warning" data-toggle="tooltip" title="Alto" style="cursor:default;">Alta</span>';}
                      if($expediente['prioridad'] == 3){ echo '<span class="btn btn-sm btn-info" data-toggle="tooltip" title="Medio" style="cursor:default;">Media</span>';}
                      if($expediente['prioridad'] == 4){ echo '<span class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Bajo" style="cursor:default;">Baja</span>'; }
                      ?></td>
                      <td class="text-center"> <?php echo clean($expediente['expediente']); ?></td>
                      <td> <?php if(!empty($expediente['asunto'])){ echo utf8_encode($expediente['asunto']); }else{ echo utf8_encode($buscar_expediente['asunto']);} ?></td>
                      <td class="text-center"> <b><?php if(ifexist($expediente['iniciador']) && ifexist($expediente['fecha_inicio'])){ echo utf8_encode($expediente['iniciador']).'</b> el '.format_date($expediente['fecha_inicio']); }else{echo utf8_encode($buscar_expediente['iniciador']).'</b> el '.format_date($buscar_expediente['fechareg']); } ?></td>
                      <td class="text-center"> <b><?php
                      if($expediente['iddepartamentos'] == 1){ echo 'Administracion';}
                      if($expediente['iddepartamentos'] == 2){ echo 'Dpto. Administrativo';}
                      if($expediente['iddepartamentos'] == 3){ echo 'Obras por Contrato';}
                      if($expediente['iddepartamentos'] == 4){ echo 'Certificaciones y Costos';}
                      if($expediente['iddepartamentos'] == 5){ echo 'Iluminacion';}
                      if($expediente['iddepartamentos'] == 6){ echo 'Señalizacion y Seguridad Vial';}
                      if($expediente['iddepartamentos'] == 7){ echo 'Bacheo'; }
                      if($expediente['iddepartamentos'] == 10){ echo 'Salio de la direccion'; }
                      ?></b><?php echo ' el '.format_date($expediente['fecha_pase']); ?></td>
                      <td class="text-center"><?php echo $expediente['emisor']; ?></td>
                      <td class="text-center"><?php echo $expediente['receptor']; ?></td> 
                      <td class="text-center"><?php echo $expediente['observaciones']; ?></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
                <tfoot>
                  <tr> 
                    <th class="w-5"></th>               
                    <th class="text-center"> Prioridad </th>
                    <th class="text-center"> Expediente </th>
                    <th> Asunto </th>
                    <th class="text-center"> Iniciador </th>
                    <th class="text-center"> Ubicacion </th>
                    <th class="text-center"> Envia </th>
                    <th class="text-center"> Recibe </th>
                    <th class="text-center"> Observacion </th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>    
    </div>
    <?php pie(); ?>