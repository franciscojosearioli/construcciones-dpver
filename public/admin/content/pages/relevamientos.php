<?php
require_once('../../includes/load.php');
require_once('../../../uploads/files.php');
$user = current_user();
$relevamientos = relevamientos_construcciones($user['iddepartamentos']);
$conteo_relevamientos_construcciones = conteo_proyectos_construcciones('obras','idobras');
cabecera('Relevamientos');
?>
<div class="row justify-content-center">
         <div class="col-10">
              <div class="d-flex flex-wrap p-b-30">
              <div class="my-auto ml-3">
              
                  <h1 class="titulo-bienvenida">Relevamientos</h1>
              </div>
              <div class="ml-auto my-auto mr-3">
<?php if(permiso('admin') || permiso('obras')){ ?>
             <a id="btn_agregar" onclick="form_agregar(true)" title="Agregar nuevo" data-toggle="tooltip" class="btn btn-warning btn-rounded btn-light"><i class="fas fa-plus"></i> Cargar nuevo</a>
                  <?php } ?>
              </div>
              </div>
              </div>
              </div>
         <div class="row justify-content-center" id="relevamientos">
         <div class="col-8">
          <div class="card">
            <div class="card-body">
              <div class="row">
              <div class="col-12">
            <div class="table-responsive">
              <table id="lista_relevamientos" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th class="w-5"></th>
                    <?php if(permiso('admin') || permiso('obras') || permiso('proyectos') || permiso('relevamientos')){ ?>
                      <th class="w-5">  </th>
                    <?php } ?>
                    <th> Solicitud </th>
                    <th> Descripcion </th>
                    <th> Ubicacion </th>
                    <th> Archivo </th>                
                  </tr>
                </thead>

                <tfoot>
                  <tr>
                    <th class="w-5"></th>
                    <?php if(permiso('admin') || permiso('obras') || permiso('proyectos') || permiso('relevamientos')){ ?>
                      <th class="w-5">  </th>
                    <?php } ?>
                    <th> Solicitud </th>
                    <th> Descripcion </th>
                    <th> Ubicacion </th>
                    <th> Archivo </th>                
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
<div id="editar_relevamientos"></div>
<div id="eliminar_relevamientos"></div>
<script type="text/javascript" src="includes/ajax/scripts/relevamientos.js"></script>
<?php 
require_once('../forms/agregar_relevamientos.php');
pie(); ?>