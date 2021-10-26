<?php
require_once('../../includes/load.php');
require_once('../../includes/functions/redeterminaciones.php');
cabecera('Actualizaciones de precios');
$user = current_user();

?>
<div id="listar_redeterminaciones_actas">
<div class="row justify-content-center">
<div class="col-10">
<div class="d-flex flex-wrap p-b-30">
<div class="my-auto ml-3">
<h3 class="titulo-bienvenida">Actas de redeterminaciones de precios</h3>
</div>
<div class="ml-auto my-auto mr-3">
  <?php if(permiso('admin') || permiso('certificaciones')){ ?>
<a id="btn_agregar" onclick="form_agregar(true)" title="Agregar nuevo" data-toggle="tooltip"
class="btn btn-warning btn-rounded btn-light"><i class="fas fa-plus"></i> Cargar nuevo</a>
<?php } ?>
</div>
</div>
</div>
</div>
         <div class="row justify-content-center">
         <div class="col-8">
          <div class="card">
            <div class="card-body">
              <div class="row">
              <div class="col-12">
      <div class="table-responsive">
       <table id="tabla_redeterminaciones_actas" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%"
       >
        <thead>
          <tr>
            <th></th>
            <th class="text-center"> </th>
            <th> Acta </th>
            <th> Monto contrato actualizado </th>
            <th> Obra </th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th></th>
            <th class="text-center"> </th>
            <th> Acta </th>
            <th> Monto contrato actualizado </th>
            <th> Obra </th>
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
  <div id="editar_redeterminacion_acta"></div>
<script type="text/javascript" src="includes/ajax/scripts/redeterminaciones.js"></script>
  <?php 
    require_once('../forms/agregar_redeterminacion_acta.php');
  pie(); ?>