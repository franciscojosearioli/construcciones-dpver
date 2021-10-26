<?php
require_once('../../includes/load.php');
require_once('../../includes/functions/proyectos.php');
cabecera('Proyectos archivados');
$user = current_user();
$proyectos = proyectos_construcciones_archivo($user['iddepartamentos']);
$c_proyectos = conteo_proyectos_construcciones_archivo('obras','idobras');
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
                                                <h3 class="card-title">Listado de proyectos archivados</h3>
                                                <h6 class="card-subtitle">Espere unos minutos hasta que cargue la planilla.</h6>
                                                <h6 class="card-subtitle">Deslice la planilla para ver mas información.</h6>
                                            </div>
                                        </div>
      <div class="table-responsive">
              <table id="listar_proyectos_archivo" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th class="w-5"></th>
                    <th class="text-center">  </th>
                    <?php if(permiso('observador') || permiso('admin') || permiso('señalamiento')){ ?>
                    <th> Nº </th>
                    <?php } ?>
                    <th> Titulo </th>
                    <th> Descripcion </th>
                    <th> Departamento </th>
                    <th class="text-center" > Expediente </th>
                    <th class="text-center" > Presupuesto </th>
                    <th class="text-center" > Plazo </th>
                    <th class="text-center" > Inicio del tramite </th>
                    <th>Ultimo movimiento</th>
                    <th class="text-center" > Estado del tramite </th>
                    <th class="text-center" > Avance del tramite </th>
                    <?php if(permiso('observador') || permiso('admin')){ ?>
                    <th class="text-center">Dependencia</th>
                    <?php } ?>
                  </tr>
                </thead>
                <tfoot>
                   <tr>
                    <th class="w-5"></th>
                    <th class="text-center">  </th>
                    <?php if(permiso('observador') || permiso('admin') || permiso('señalamiento')){ ?>
                    <th> Nº </th>
                    <?php } ?>
                    <th> Titulo </th>
                    <th> Descripcion </th>
                    <th> Departamento </th>
                    <th class="text-center" > Expediente </th>
                    <th class="text-center" > Presupuesto </th>
                    <th class="text-center" > Plazo </th>
                    <th class="text-center" > Inicio del tramite </th>
                    <th>Ultimo movimiento</th>
                    <th class="text-center" > Estado del tramite </th>
                    <th class="text-center" > Avance del tramite </th>
                    <?php if(permiso('observador') || permiso('admin')){ ?>
                    <th class="text-center">Dependencia</th>
                    <?php } ?>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>    
    </div>
<script type="text/javascript" src="includes/ajax/scripts/proyectos.js"></script>
    <?php pie(); ?>