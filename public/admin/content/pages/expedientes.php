<?php
require_once('../../includes/load.php');
require_once('../../includes/functions/expedientes.php');
cabecera('Expedientes');
$user = current_user();
$expedientes_departamento = expedientes_departamento($user['iddireccion'],$user['iddepartamentos']);
?>
<div class="row justify-content-center">
         <div class="col-10">
              <div class="d-flex flex-wrap p-b-30">
              <div class="my-auto ml-3">
              <form method="post" action="consultas"> 
              <span class="btn-light" style="display: inline-block;font-weight: 400;text-align: center;vertical-align: middle;-webkit-user-select: none;-moz-user-select: none;  -ms-user-select: none;  user-select: none;  border: 1px solid transparent; padding: .5rem .75rem;  font-size: 1rem;  line-height: 1.25;  border-radius: .25rem;  transition: all .15s ease-in-out; padding: 7px 12px; font-size: 14px; cursor: pointer;">
              Consultar movimientos del expediente N:
              <input type="number" name="numero" style="background: #f0f0f0;width:120px;height:20px;min-height:20px; " class="form-control" autocomplete="off" placeholder="" required>
              <button type="submit" class="btn-sm" style="border: none;background: none;"><i class='ti-search'></i></button>
              </span>
              </form>
              </div>
              <div class="ml-auto my-auto mr-3">
                  <?php if(permiso('admin')){ ?>
             <a id="btn_agregar" onclick="form_agregar(true)" title="Agregar nuevo" data-toggle="tooltip" class="btn btn-light"><i class="fas fa-plus"></i> Cargar nuevo</a>
                  <?php } ?>
              </div>
              </div>
              </div>
         </div>
         <div class="row justify-content-center" id="listar_expedientes">
         <div class="col-10">
          <div class="card">
            <div class="card-body">
              <div class="row">
              <div class="col-12">
                <div class="card-body cards-titulo">
              <div class="d-flex flex-wrap p-b-30">
              <div class="my-auto ml-3">
                <h1><b>Expedientes</b></h1>
              </div>
            </div>
            </div>          
          <div class="table-responsive">
            <table id="lista_expedientes" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
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