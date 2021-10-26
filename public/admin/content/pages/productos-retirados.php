<?php
require_once('../../includes/load.php');
require_once('../../includes/functions/inventario.php');

$user = current_user();
$insumos_retirados = inventario_retirados($user['iddireccion'],$user['iddepartamentos']);

cabecera('Productos retirados');
?>
      <div class="row">
        <div class="col-lg-12">
          <?php echo display_msg($msg); ?>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
              <div class="col-12">
                                        <div class="d-flex flex-wrap margin-dt">
                                            <div>
                                                <h3 class="card-title">Listado de productos retirados (Sin stock)</h3>
                                                <h6 class="card-subtitle">Espere unos minutos hasta que cargue la planilla.</h6>
                                                <h6 class="card-subtitle">Deslice la planilla para ver mas información.</h6>
                                            </div>
                                        </div>
      <div class="table-responsive">
                <table id="all" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th class="w-5"></th>
                      <th>Nombre </th>
                      <th>Cargo </th>
                      <th>Destino </th>
                      <th>Fecha salida </th>
                      <th class="text-center">Unidad</th>
                      <th class="text-center">Cantidades</th>
                      <?php if(permiso('admin') || permiso('observador')){ ?>
                      <th class="text-center">Dependencia</th>
                    <?php } ?>
                      <th>Registrado</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($insumos_retirados as $insumo): ?>
                      <tr>
                        <td class="w-5"></td>
                        <td><?php echo clean(ucwords($insumo['nombre'])); ?></td>
                        <td><?php echo clean(ucwords($insumo['cargo'])); ?></td>
                        <td><?php echo clean(ucwords($insumo['destino'])); ?></td>
                        <td><?php if(!empty($insumo['fecha_salida']) && $insumo['fecha_salida'] != '0000-00-00'){ echo format_date($insumo['fecha_salida']);}else{ echo 'Sin definir';} ?></td>
                        <td class="text-center"><?php echo $insumo['unidad']; ?></td>
                        <td class="text-center"><?php echo numero_stock($insumo['unidad'],$insumo['cantidades']); ?></td>
                        <?php if(permiso('admin') || permiso('observador')){ ?>
                        <td class="text-center"> <?php echo find_select('nombre','departamentos','iddepartamentos',$insumo['iddepartamentos']) ?> </td>
                      <?php } ?>
                      <td><?php echo format_dyt($insumo['registro_fecha']); ?></td>
                    </tr>
                  <?php endforeach;?>
                </tbody>
                  <tfoot>
                    <tr>
                      <th class="w-5"></th>
                      <th>Nombre </th>
                      <th>Cargo </th>
                      <th>Destino </th>
                      <th>Fecha salida </th>
                      <th class="text-center">Unidad</th>
                      <th class="text-center">Cantidades</th>
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
    <?php 
    pie(); 
    ?>