<?php
require_once('../../includes/load.php');
require_once('../../includes/functions/inventario.php');
$user = current_user();
$insumos_disponibles = inventario_disponibles($user['iddireccion'],$user['iddepartamentos']);
cabecera('Productos');
?>
<div class="row">
  <div class="col-lg-12">
    <?php echo display_msg($msg); ?>
  </div>
</div>
<div class="row" id="productos">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-12">
            <div class="d-flex flex-wrap margin-dt">
              <div>
                <h3 class="card-title">Listado de productos disponibles (En stock)</h3>
                <h6 class="card-subtitle">Espere unos minutos hasta que cargue la planilla.</h6>
                <h6 class="card-subtitle">Deslice la planilla para ver mas información.</h6>
              </div>
              <div class="ml-auto">
                <ul class="list-inline">
                  <?php if(permiso('admin') || permiso('productos')){ ?>
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
                    <th class="text-center" style="width: 5%;"> </th>
                    <th> Nombre </th>
                    <th class="text-center">Unidad</th>
                    <th class="text-center">Cantidades</th>
                    <th> Descripcion </th>
                    <th> Categoria </th>
                    <th> Cargo </th>
                    <?php if(permiso('admin') || permiso('observador')){ ?>
                      <th class="text-center">Dependencia</th>
                    <?php } ?>
                    <th>Registro</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($insumos_disponibles as $insumo): ?>
                    <tr>
                      <td class="w-5"></td>

                      <td><a class="i-dt-list" onclick="ver_producto(<?php echo $insumo['idinsumos']; ?>)" data-toggle="tooltip" title="Ver producto"><i class="mdi mdi-information-variant"></i></a>
                        <?php if(permiso('admin') || permiso('productos')){ ?>
                          <a class="i-dt-list" onclick="retirar_producto(<?php echo $insumo['idinsumos']; ?>)" data-toggle="tooltip" title="Retirar producto"><i class="mdi mdi-arrow-top-right"></i></a>
                        <?php } ?>
                      </td>
                      <td><?php echo clean(ucwords($insumo['nombre'])); ?></td>
                      <td class="text-center"><?php echo $insumo['unidad']; ?></td>
                      <td class="text-center"><?php echo numero_stock($insumo['unidad'],$insumo['cantidades']); ?></td>
                      <td><?php echo clean($insumo['descripcion']); ?></td>
                      <td><?php echo find_select('nombre','categorias','idcategorias',$producto['idcategorias']) ?></td>
                      <td><?php echo clean(ucwords($insumo['cargo'])); ?></td>
                      <?php if(permiso('admin') || permiso('observador')){ ?>
                        <td class="text-center"> <?php echo find_select('nombre','departamentos','iddepartamentos',$insumo['iddepartamentos']) ?>  
                      </td>
                    <?php } ?>
                    <td><?php echo format_date($insumo['registro_fecha']); ?></td>
                  </tr>
                <?php endforeach;?>
              </tbody>
              <tfoot>
                <tr>
                  <th class="w-5"></th>
                  <th class="text-center" style="width: 5%;"> </th>
                  <th> Nombre </th>
                  <th class="text-center">Unidad</th>
                  <th class="text-center">Cantidades</th>
                  <th> Descripcion </th>
                  <th> Categoria </th>
                  <th> Cargo </th>
                  <?php if(permiso('admin') || permiso('observador')){ ?>
                    <th class="text-center">Dependencia</th>
                  <?php } ?>
                  <th>Registrado</th>
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
<div id="retirar_productos"></div>
<div id="productos_info"></div>
<script type="text/javascript" src="includes/ajax/scripts/productos.js"></script>
<?php 
require_once('../forms/agregar_productos.php');
pie(); 
?>