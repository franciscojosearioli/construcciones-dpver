<?php
require_once('../../includes/load.php');
require_once('../../includes/functions/tramites-etiquetas.php');
cabecera('Etiquetas de tramites');
$user = current_user();
 ?>
          <div id="listar_etiquetas_tramites">
         <div class="row justify-content-center">
<div class="col-10">
<div class="d-flex flex-wrap p-b-30">
<div class="my-auto ml-3">
<h3 class="titulo-bienvenida">Etiquetas de tramites</h3>
</div>
<div class="ml-auto my-auto mr-3">
  <?php if(permiso('admin') || permiso('tramites')){ ?>
<a id="btn_agregar_etiqueta" onclick="form_agregar_etiquetas(true)" title="Agregar nuevo" data-toggle="tooltip"
class="btn btn-warning btn-rounded btn-light"><i class="fas fa-plus"></i> Cargar nuevo</a>
<?php } ?>
</div>
</div>
</div>
</div>
         <div class="row justify-content-center" >
         <div class="col-8">
          <div class="card">
            <div class="card-body">
              <div class="row">
              <div class="col-12">
      <div class="table-responsive">
              <table id="tabla_tramites_etiquetas" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th> </th>
                    <th class="text-center">  </th>
                    <th> Titulo </th>         
                    <th class="text-center"> Descripcion </th> 
                  </tr>
                </thead>

                <tfoot>
                  <tr>
                    <th> </th>
                    <th class="text-center">  </th>
                    <th> Titulo </th>    
                    <th class="text-center"> Descripcion </th>  
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
<div id="editar_etiquetas"></div>
<script type="text/javascript" src="includes/ajax/scripts/tramites-etiquetas.js"></script>
<?php 
require_once('../forms/agregar_etiqueta_tramite.php');
pie(); 
?>