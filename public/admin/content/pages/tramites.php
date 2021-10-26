<?php
require_once('../../includes/load.php');
require_once('../../includes/functions/tramites.php');
cabecera('Tramites');
$user = current_user();
$expedientes_departamento = expedientes_departamento($user['iddireccion'],$user['iddepartamentos']);
?>
<div  id="listar_tramites">
<div class="row justify-content-center">
<div class="col-12">
<div class="d-flex flex-wrap p-b-30">
<div class="my-auto ml-3">
<h3 class="titulo-bienvenida">Tramites</h3>
</div>
<div class="ml-auto my-auto mr-3">
</div>
</div>
</div>
</div>
         <div class="row justify-content-center">
         <div class="col-12">
          <div class="card">
          
<?php if(permiso('admin') || permiso('tramites')){ ?>
          <ul class="nav nav-tabs customtab" role="tablist">
  <li class="nav-item">
  <a class="nav-link" style="padding:10px 15px 10px 15px" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Agregar
  </a>
  <div class="dropdown-menu dropdown-item-theme" aria-labelledby="dropdownMenuButton2">
    <a class="dropdown-item dropdown-item-theme" id="btn_agregar_notas" onclick="form_agregar_nota(true)" title="Agregar nuevo" data-toggle="tooltip">Presentacion / Nota</a>
    <a class="dropdown-item dropdown-item-theme" id="btn_agregar_expedientes" onclick="form_agregar(true)" title="Agregar nuevo" data-toggle="tooltip" >Expediente</a>
  </div>
</li>
  <li class="nav-item">
  <a href="tramites-etiquetas" class="nav-link" style="padding:10px 15px 10px 15px" aria-expanded="false">
   Etiquetas de tramites
  </a>
  </li> 
</ul>
<?php } ?>
            <div class="card-body">    
          <div class="table-responsive">
            <table id="lista_tramites" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th class="text-center">  </th>
                  <th class="text-center">  </th>
                  <th class="text-center"> Tipo </th>  
                  <th class="text-center"> Numero </th>
                  <th style="max-width:30%">Asunto </th>
                  <th class="text-center"> Ingreso </th>
                  <th class="text-center"> Ultimo movimiento </th>
                  <th class="text-center"> Etiquetas </th>
                  <th class="text-center"> Observacion </th>                  
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th class="text-center">  </th>
                  <th class="text-center">  </th>
                  <th class="text-center"> Tipo </th>  
                  <th class="text-center"> Numero </th>
                  <th style="max-width:30%"> Asunto </th>
                  <th class="text-center"> Ingreso </th>
                  <th class="text-center"> Ultimo movimiento </th>
                  <th class="text-center"> Etiquetas </th>
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
<div id="editar_expedientes"></div>
<div id="editar_notas"></div>
<div id="tramites_observaciones"></div>
<div id="pases_tramites"></div>
<div id="movimientos_tramites"></div>
<div id="eliminar_expedientes"></div>
<?php 
require_once('../forms/localizar_expedientes.php');
     require_once('../forms/agregar_notas.php');
?>

<script type="text/javascript" src="includes/ajax/scripts/tramites.js"></script>
<?php
pie(); ?>