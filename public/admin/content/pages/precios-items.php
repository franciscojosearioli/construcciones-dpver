<?php
require_once('../../includes/load.php');
require_once('../../includes/functions/certificados.php');
cabecera('Precios de Items');
$user = current_user();
$aprobados = all_certificados_obras();

?>
         <div class="row justify-content-center" id="listar_precios_items">
        <div class="col-8">
          <div class="card">
                <div class="card-body cards-titulo">
            <div class="d-flex flex-wrap">
              <div class="my-auto ml-3">
                INDICE DE PRECIOS
              </div>
              <div class="ml-auto my-auto mr-3">
              <a id="btn_agregar" onclick="form_agregar(true)" title="Agregar nuevo" data-toggle="tooltip"><i class="fas fa-plus"></i></a>
              </div>
            </div>
           </div>
          </div>
        </div>
          <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
              <div class="col-12">
                                        <div class="d-flex flex-wrap margin-dt">
                                            <div>
                                                <h3 class="card-title">Listado de indice de precios registrados</h3>
                                                <h6 class="card-subtitle">Espere unos minutos hasta que cargue la planilla.</h6>
                                                <h6 class="card-subtitle">Deslice la planilla para ver mas información.</h6>
                                            </div>
                                        </div>
      <div class="table-responsive">
       <table id="tabla_precios_items" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%"
       >
        <thead>
          <tr>
            <th></th>
  <?php  if(permiso('admin') || permiso('certificacion')){ ?>
            <th class="text-center"> </th> <?php } ?>
            <th> Descripcion </th>
            <th> Valor </th>
            <th> Tipo </th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th></th>
  <?php  if(permiso('admin') || permiso('certificacion')){ ?>
            <th class="text-center"> </th> <?php } ?>
            <th> Descripcion </th>
            <th> Valor </th>
            <th> Tipo </th>
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
  <div id="editar_precios"></div>
  <div id="ver-items"></div>
<script type="text/javascript" src="includes/ajax/scripts/precios_items.js"></script>
  <?php 
    require_once('../forms/agregar_precios_items.php');
  pie(); ?>