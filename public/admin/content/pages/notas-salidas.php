<?php
require_once('../../includes/load.php');
$user = current_user();
$notas_departamento_salidas = notas_departamento_salidos($user['iddepartamentos']);
cabecera('Notas fuera de la direccion'); 
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
              <ul class="nav navbar-nav nav-flex-icons float-right">
                <li class="nav-item dropdown">
                  <a class="nav-link" id="navbarDropdownMenuLink-333" data-toggle="dropdown" aria-haspopup="true"
                  aria-expanded="false">
                  <i class="fas fa-chevron-down"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-default" aria-labelledby="navbarDropdownMenuLink-333">
                  <a title="Imprimir" class="dropdown-item" href="registro-notas">Imprimir</a>
                </div>
              </li>  
            </ul>
            <h3 class="card-title">Listado de Notas fuera de la direccion</h3>
            <h6 class="card-subtitle">Ubicados en el departamento</h6>
          </div>
          <div>
            <hr class="m-t-0 m-b-0">
          </div>
          <div class="card-body">
            <div class="table-responsive m-t-40">
              <table id="1" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                  <tr>   
                    <th class="w-5"></th>             
                    <th class="text-center"> # </th> 
                    <th class="text-center"> Prioridad </th>  
                    <th class="text-center"> Iniciador </th>
                    <th> Asunto </th>
                    <th class="text-center"> Ubicacion actual </th>
                    <th class="text-center"> Envia </th>
                    <th class="text-center"> Recibe </th>
                    <th class="text-center"> Observacion </th>    
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($notas_departamento_salidas as $nota):
                    ?>
                    <tr>
                      <td class="w-5"></td>
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
                      if($nota['iddepartamentos'] == 10){ echo 'SALIO DE LA DIRECCION'; } ?></b><?php echo ' desde el '.format_date($nota['fecha_pase']);?></td>
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
    <?php pie(); ?>