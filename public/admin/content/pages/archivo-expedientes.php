<?php
require_once('../../includes/load.php');
cabecera('Expedientes archivados'); 
$user = current_user();
$expedientes_departamento_archivos = expedientes_departamento_archivos($user['iddepartamentos']);


?>
      <div class="row">
        <div class="col-lg-12">
          <?php echo display_msg($msg); ?>
        </div>
      </div>
<div class="row" id="listar_expedientes">
  <div class="col-12">
     <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-12">
<h3 class="card-title">Consulta de expedientes</h3>
<form method="post" action="consultas">
<div class="row">
<div class="col-12">
<div class="form-group">
<div class="input-group">
<input type="number" name="numero" style="background: #f0f0f0" class="form-control" autocomplete="off" placeholder="Ingrese un numero de expediente para ver todos sus movimientos" required>
<div class="input-group-addon">
<input type="submit" class="btn btn-info btn-sm" value="Consultar">
</div>
</div>
</div>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
                 
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-12">
            <div class="d-flex flex-wrap margin-dt">
              <div>
                <h3 class="card-title">Listado de expedientes archivados</h3>
                <h6 class="card-subtitle">Espere unos minutos hasta que cargue la planilla.</h6>
                <h6 class="card-subtitle">Deslice la planilla para ver mas información.</h6>
              </div>
              <div class="ml-auto">                                              
                                                <ul class="list-inline">
                                                    <li>
                                                        <h6 class="text-muted"><a class="dropdown-item a-icon" title="Imprimir" data-toggle="tooltip" href="registro-expedientes"><i class="fas fa-print fa-2x"></i></a></h6> 
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
      <div class="table-responsive">
              <table id="lista_expedientes_archivo" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                  <th class="text-center">  </th>
                  <th class="text-center">  </th>
                  <th class="text-center"> Prioridad </th>  
                  <th class="text-center"> Expediente </th>
                  <th> Asunto </th>
                  <th class="text-center"> Ubicacion </th>
                  <th class="text-center"> Envia </th>
                  <th class="text-center"> Recibe </th>
                  <th class="text-center"> Observacion </th>                  
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th class="text-center">  </th>
                  <th class="text-center">  </th>
                  <th class="text-center"> Prioridad </th>  
                  <th class="text-center"> Expediente </th>
                  <th> Asunto </th>
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
</div>
</div>




<div id="editar_expedientes"></div>
<div id="observaciones_expediente"></div>
<div id="pases_expedientes"></div>
<div id="movimientos_expedientes"></div>
<div id="eliminar_expedientes"></div>
<script type="text/javascript" src="includes/ajax/scripts/expedientes.js"></script>
    <?php 
    require_once('../forms/localizar_expedientes.php');
    pie(); ?>