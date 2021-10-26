<?php
require_once('../../includes/load.php');
require_once('../../includes/functions/notas.php');
$user = current_user();
$all_notas = listar_notas($user['iddireccion'],$user['iddepartamentos']);
cabecera('Presentaciones');
?>
<div class="row justify-content-center">
         <div class="col-10">
              <div class="d-flex flex-wrap p-b-30">
              <div class="my-auto ml-3">
              </div>
              <div class="ml-auto my-auto mr-3">
                  <?php if(permiso('admin')){ ?>
             <a id="btn_agregar" onclick="form_agregar(true)" title="Agregar nuevo" data-toggle="tooltip" class="btn btn-light"><i class="fas fa-plus"></i> Cargar nuevo</a>
                  <?php } ?>
              </div>
              </div>
              </div>
         </div>
         <div class="row justify-content-center" id="listar_notas">
         <div class="col-10">
          <div class="card">
            <div class="card-body">
              <div class="row">
              <div class="col-12">
                <div class="card-body cards-titulo">
              <div class="d-flex flex-wrap p-b-30">
              <div class="my-auto ml-3">
                <h1><b>Presentaciones</b></h1>
              </div>
            </div>
            </div>   
      <div class="table-responsive">
              <table id="lista_notas" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
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
            </table>
          </div>
        </div>
      </div>
    </div>    
  </div>
</div>
</div>
      <div id="editar_notas"></div>
      <div id="observaciones_notas"></div>
      <div id="pases_notas"></div>
      <div id="eliminar_notas"></div>
<script type="text/javascript" src="includes/ajax/scripts/notas.js"></script>
    <?php 
     require_once('../forms/agregar_notas.php');
    pie(); 
    ?>