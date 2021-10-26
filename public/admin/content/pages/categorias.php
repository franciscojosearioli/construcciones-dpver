<?php
require_once('../../includes/load.php');
require_once('../../includes/functions/categorias.php');

cabecera('Categorias');
$user = current_user();
$categorias = listar_categorias($user['iddireccion'],$user['iddepartamentos']);

?>
      <div class="row">
        <div class="col-lg-12">
          <?php echo display_msg($msg); ?>
        </div>
      </div>
      <div class="row" id="categorias">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
              <div class="col-12">
                                        <div class="d-flex flex-wrap margin-dt">
                                            <div>
                                                <h3 class="card-title">Listado de categorias de productos</h3>
                                                <h6 class="card-subtitle">Espere unos minutos hasta que cargue la planilla.</h6>
                                                <h6 class="card-subtitle">Deslice la planilla para ver mas información.</h6>
                                            </div>
                                            <div class="ml-auto">
                                                <ul class="list-inline">
                                                  <?php if(permiso('admin') || permiso('categorias')){ ?>
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
                    <?php if(permiso('admin') || permiso('categorias')){ ?>
                      <th class="text-center">  </th>
                    <?php } ?>
                    <th> Nombre </th>
                    <th> Estado </th>                  
            <?php if(permiso('admin') || permiso('observador')){  ?>
              <th class="text-center">Dependencia</th>
            <?php } ?>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($categorias as $categoria):
                    ?>
                    <tr>
                      <td class="w-5"></td>
                    
                      
                    <?php if(permiso('admin') || permiso('categorias')){ ?>
                      <td>
                      <a class="i-dt-list" onclick="editar_categoria(<?php echo $categoria['idcategorias']; ?>)" data-toggle="tooltip" title="Editar datos"><i class="mdi mdi-pencil"></i></a>
                      <a class="i-dt-list" onclick="eliminar_categoria(<?php echo $categoria['idcategorias']; ?>)" data-toggle="tooltip" title="Eliminar"><i class="fa fa-times"></i></a>
                    
                      </td><?php } ?>
                      <td><?php echo $categoria['nombre']; ?></td>
                      <td><?php if($categoria['condicion'] == 1 ){ ?><span class="label label-success">Activa</span><?php }else{ ?><span class="label label-danger">Inactiva</span><?php } ?></td>
                      <?php if(permiso('admin') || permiso('observador')){ ?>
              <td class="text-center"><?php echo find_select('nombre','departamentos','iddepartamentos',$categoria['iddepartamentos']) ?> (<?php echo find_select('nombre','direcciones','iddireccion',$categoria['iddireccion']) ?>)</td>
            <?php } ?>
                      
                    </tr>
                  <?php endforeach; ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th class="w-5"></th>
                    <?php if($user['idpermisos'] <= 3){ ?>
                      <th class="text-center">  </th>
                    <?php } ?>
                    <th> Nombre </th>   
                    <th> Estado </th>                  
            <?php if($user['idroles'] == 1 || $user['idroles'] == 3){ ?>
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
    <div id="editar_categorias"></div>
    <div id="eliminar_categorias"></div>
<script type="text/javascript" src="includes/ajax/scripts/categorias.js"></script>
    <?php 
     require_once('../forms/agregar_categorias.php');
    pie(); 
    ?>