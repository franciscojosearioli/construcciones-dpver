<?php
require_once('../../includes/load.php');
require_once('../../includes/functions/empresas.php');
cabecera('Representantes de empresas');
$user = current_user();
 ?>
 <div id="listar_empresas_contactos">
<div class="row justify-content-center">
<div class="col-10">
<div class="d-flex flex-wrap p-b-30">
<div class="my-auto ml-3">
<h3 class="titulo-bienvenida">Contactos de empresas</h3>
</div>
<div class="ml-auto my-auto mr-3">
  <?php if(permiso('admin') || permiso('obras')){ ?>
<a id="btn_agregar" onclick="form_agregar(true)" title="Agregar nuevo" data-toggle="tooltip"
class="btn btn-warning btn-rounded btn-light"><i class="fas fa-plus"></i> Cargar nuevo</a>
<?php } ?>
</div>
</div>
</div>
</div>
<div class="row justify-content-center">
  <div class="col-10">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-12">
      <div class="table-responsive">
              <table id="tabla_empresas_contactos" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th> </th>
                    <?php if(permiso('admin') || permiso('agenda')){ ?>
                    <th class="text-center">  </th>  
                    <?php } ?>
                    <th> Nombre completo </th>     
                    <th> Correo electronico </th>
                    <th> Telefono </th>
                    <th> Empresa </th>    
                    <th> Cargo </th>                
                  </tr>
                </thead>

                <tfoot>
                  <tr>
                    <th> </th>
                    <?php if(permiso('admin') || permiso('agenda')){ ?>
                    <th class="text-center">  </th>  
                    <?php } ?>
                    <th> Nombre completo </th>     
                    <th> Correo electronico </th>
                    <th> Telefono </th>
                    <th> Empresa </th>     
                    <th> Cargo </th> 
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
<div id="editar_empresas_contactos"></div>
<script type="text/javascript" src="includes/ajax/scripts/empresas.js"></script>
<?php 
require_once('../forms/agregar_contacto_empresa.php');
pie(); 
?>



