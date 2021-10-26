<?php
require_once('../../includes/load.php');
require_once('../../includes/functions/proyectos.php');
$user = current_user();
$proyectos = proyectos_construcciones($user['iddepartamentos']);
$c_proyectos = conteo_proyectos_construcciones('obras','idobras');
cabecera('Proyectos de obras');
?>
<div id="proyectos">
         <div class="row justify-content-center">
<div class="col-10">
<div class="d-flex flex-wrap p-b-30">
<div class="my-auto ml-3">
<h3 class="titulo-bienvenida">Proyectos de obras</h3>
</div>
<div class="ml-auto my-auto mr-3">
  <?php if(permiso('admin') || permiso('obras') || permiso('proyectos')){ ?>
<a id="btn_agregar" onclick="form_agregar(true)" title="Agregar nuevo" data-toggle="tooltip"
class="btn btn-warning btn-rounded btn-light"><i class="fas fa-plus"></i> Cargar nuevo</a>
<?php } ?>
</div>
</div>
</div>
</div>
         
         <div class="row justify-content-center" >
         <div class="col-10">
          <div class="card">
            <div class="card-body">
              <div class="row">
              <div class="col-12">
            <div class="table-responsive">
              <table id="listar_proyectos" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th></th>
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
                    <!--<th class="text-center" > Inicio del tramite </th>
                    <th>Ultimo movimiento</th>-->
                    <th class="text-center" > Estado del tramite </th>
                    <th class="text-center" > Avance del tramite </th>
                    <?php if(permiso('observador') || permiso('admin')){ ?>
                      <th class="text-center">Dependencia</th>
                    <?php } ?>
                  </tr>
                </thead>

                <tfoot>
                  <tr>
                    <th></th>
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
                    <!--<th class="text-center" > Inicio del tramite </th>
                    <th>Ultimo movimiento</th>-->
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
  </div>
</div>
</div>
    <script type="text/javascript" src="includes/ajax/scripts/proyectos.js"></script>
    <?php 
    require_once('../forms/agregar_proyecto.php');
    pie(); ?>