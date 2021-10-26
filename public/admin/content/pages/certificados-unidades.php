<?php
require_once('../../includes/load.php');
require_once('../../includes/functions/certificados.php');
cabecera('Unidades de items');
$user = current_user();
 ?>
 <div id="listar_unidades">
 <div class="row justify-content-center">
<div class="col-10">
<div class="d-flex flex-wrap p-b-30">
<div class="my-auto ml-3">
<h3 class="titulo-bienvenida">Unidades en items de obras</h3>
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
         <div class="row justify-content-center" >
         <div class="col-8">
          <div class="card">
            <div class="card-body">
              <div class="row">
              <div class="col-12">
      <div class="table-responsive">
              <table id="tabla_unidades" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th> </th>
  <?php  if(permiso('admin') || permiso('certificaciones')){ ?>
                    <th class="text-center">  </th>  <?php } ?>
                    <th> Titulo </th>         
                    <th class="text-center"> Unidad </th> 
                  </tr>
                </thead>

                <tfoot>
                  <tr>
                    <th> </th>
  <?php  if(permiso('admin') || permiso('certificaciones')){ ?>
                    <th class="text-center">  </th>  <?php } ?>
                    <th> Titulo </th>    
                    <th class="text-center"> Unidad </th>  
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
<div id="editar_unidades"></div>
<script type="text/javascript" src="includes/ajax/scripts/certificados_unidades.js"></script>
<?php 
require_once('../forms/agregar_unidad.php');
pie(); 
?>