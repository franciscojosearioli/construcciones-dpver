<?php
require_once('../../includes/load.php');
require_once('../../includes/functions/proveedores.php');

$user = current_user();
$proveedores = listar_proveedores($user['iddireccion'],$user['iddepartamentos']);

cabecera('Proveedores');
?>
<div class="row">
  <div class="col-lg-12">
    <?php echo display_msg($msg); ?>
  </div>
</div>
<div class="row" id="proveedores">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-12">
            <div class="d-flex flex-wrap margin-dt">
              <div>
                <h3 class="card-title">Listado de proveedores registrados</h3>
                <h6 class="card-subtitle">Espere unos minutos hasta que cargue la planilla.</h6>
                <h6 class="card-subtitle">Deslice la planilla para ver mas información.</h6>
              </div>
              <div class="ml-auto">
                <ul class="list-inline">
                  <?php if(permiso('admin') || permiso('proveedores')){ ?>
                    <li>
                      <h6 class="text-muted"><a class="dropdown-item a-icon" id="btn_agregar" onclick="form_agregar(true)" data-toggle="tooltip" title="Agregar nuevo"><i class="fas fa-plus fa-2x"></i></a></h6> 
                    </li>
                  <?php } ?>
                </ul>
              </div>
            </div>
            <div class="table-responsive">
              <table id="all" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th class="w-5"></th>
                    <?php if(permiso('admin') || permiso('proveedores')){ ?>
                      <th class="text-center">  </th>
                    <?php } ?>
                    <th> Nombre </th>  
                    <th> CUIT </th>  
                    <th class="text-center"> Direccion </th>
                    <th class="text-center"> Telefono </th>
                    <th class="text-center"> Localidad </th>                  
                    <?php if(permiso('admin') || permiso('observador')){ ?>
                      <th class="text-center">Dependencia</th>
                    <?php } ?>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($proveedores as $proveedor):
                    ?>
                    <tr>
                      <td class="w-5"></td>

                      <td><a class="i-dt-list" onclick="ver_contactos(<?php echo $proveedor['idproveedores']; ?>)" data-toggle="tooltip" title="Ver contacto"><i class="mdi mdi-account"></i></a>
                        <?php if(permiso('admin') || permiso('proveedores')){ ?>
                          <a class="i-dt-list" onclick="editar_proveedor(<?php echo $proveedor['idproveedores']; ?>)" data-toggle="tooltip" title="Editar datos"><i class="mdi mdi-pencil"></i></a>
                        <?php } ?>
                      </td>
                      <td><?php echo $proveedor['nombre']; ?></td>
                      <td><?php echo $proveedor['cuit']; ?></td>
                      <td class="text-center"><?php echo $proveedor['direccion']; ?></td>
                      <td class="text-center"><?php echo $proveedor['telefono']; ?></td> 
                      <td class="text-center"><?php echo $proveedor['localidad']; ?></td>
                      <?php if(permiso('admin') || permiso('observador')){ ?>
                        <td class="text-center"><?php echo find_select('nombre','departamentos','iddepartamentos',$proveedor['iddepartamentos']) ?></td>
                      <?php } ?>

                    </tr>
                  <?php endforeach; ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th class="w-5"></th>
                    <?php if(permiso('admin') || permiso('proveedores')){ ?>
                      <th class="text-center">  </th>
                    <?php } ?>
                    <th> Nombre </th>  
                    <th> CUIT </th>  
                    <th class="text-center"> Direccion </th>
                    <th class="text-center"> Telefono </th>
                    <th class="text-center"> Localidad </th>                  
                    <?php if(permiso('admin') || permiso('observador')){ ?>
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
<div id="editar_proveedores"></div>
<div id="proveedor_contacto"></div>
<script type="text/javascript" src="includes/ajax/scripts/proveedores.js"></script>
<?php 
require_once('../forms/agregar_proveedores.php');
pie(); 
?>