<?php
require_once('../../includes/load.php');

$user = current_user();
$categorias = listar_categorias_activas($user['iddireccion'],$user['iddepartamentos']) ;
$producto = find_by_id('insumos','idinsumos',$_POST['id']);
 ?>
      <div class="row form-center" id="retirar_productos">
        <div class="col-lg-12 col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
              <div class="col-12">
                                        <div class="d-flex flex-wrap">
                                            <div>
                                                <h3 class="card-title">Retirar producto</h3>
                                                <h6 class="card-subtitle"><?php echo find_select('nombre','departamentos','iddepartamentos',$user['iddepartamentos']) ?> - <?php echo find_select('nombre','direcciones','iddireccion',$user['iddireccion']) ?></h6>
                                            </div>
                                            <div class="ml-auto">
                                                <ul class="list-inline">
                                                    <li>
                                                      <h6 class="text-muted"><a onclick="cancelar_retirar()" class="dropdown-item a-icon" data-toggle="tooltip" title="Cancelar"><i class="fas fa-times fa-2x"></i></a></h6>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                  </div>

            <hr class="m-t-0 m-b-0"></div>
          <div class="card-body">
            <form method="post" action="productos" id="form_retirar">
              <div class="row">
                      <div class="col-lg-7 col-md-7 col-sm-12">
                    <div class="form-group p-l-10 p-r-10">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="row title-form">
                      Informacion del producto
                      </div>
                      </div>
                      <input type="text" name="retirar_producto" value="<?php echo $producto['idinsumos']; ?>" hidden>
                      <div class="row p-t-20">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="md-form form-md">
                          <label class="control-label">Codigo / Referencia</label>
                          <input type="text" name="codigo" class="form-control" value="<?php echo $producto['codigo']; ?>">
                        </div>
                      </div>
                      </div> 
                      <div class="row p-t-10">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <div class="md-form form-md">
                            <label class="control-label">Nombre</label>
                            <input type="text" name="nombre" id="nombre" value="<?php echo $producto['nombre']; ?>" class="form-control" required readonly>
                          </div>
                        </div> 
                      </div>
                      <div class="row p-t-10">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="md-form form-md">
                          <label class="control-label">Descripcion</label>
                          <input type="text" name="descripcion" value="<?php echo $producto['descripcion']; ?>" class="form-control">
                        </div>
                      </div> 
                    </div>
                      <div class="row p-t-10">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="md-form form-md">
                          <label class="control-label">Categoria</label>
                    <select class="form-control custom-select" name="idcategorias" required>
                  <?php if(!empty($producto['idcategorias'])){ ?>
                  <optgroup label="Establecido">
                    <?php 
                    if(!empty($producto['idcategorias'])){ echo '<option value="'.$producto['idcategorias'].'" selected>'.find_select('nombre','categorias','idcategorias',$producto['idcategorias']).'</option>'; } 
                    ?>
                  </optgroup>
                  <optgroup label="Opciones ">
                    <?php foreach ($categorias as $categoria):?>
                        <option value="<?php echo $categoria['idcategorias']; ?>"><?php echo $categoria['nombre']; ?></option>
                      <?php endforeach; ?>
                  </optgroup>

                  <?php }elseif($producto['idcategorias'] == 0){ ?>
                    <option disabled selected>Debe asignar una categoria.</option>
                    <optgroup label="Opciones ">
                    <?php foreach ($categorias as $categoria):?>
                        <option value="<?php echo $categoria['idcategorias']; ?>"><?php echo $categoria['nombre']; ?></option>
                      <?php endforeach; ?>
                  </optgroup> 
                  <?php } ?>
                                    </select>

                    </select>
                    <?php if(empty($producto['idcategorias'])){ ?>
                    <?php  } ?><span class="help-block"><small>Cree una categoria haciendo <a href="categorias">click aqui.</a></small></span>
                        </div>    
                      </div> 
                    </div>
                      <div class="row p-t-10">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="md-form form-md">
                          <label class="control-label">Responsable del producto</label>
                          <input type="text" name="cargo" class="form-control" value="<?php echo $producto['cargo']; ?>" required>
                        </div>
                      </div> 
                    </div>
                      <div class="row p-t-10">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="md-form form-md">
                          <label class="control-label">Destino / Utilidad</label>
                          <input type="text" name="destino" class="form-control" required>
                        </div>
                      </div> 
                    </div>
                      <div class="row p-t-10">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="md-form form-md">
                          <label class="control-label">Fecha de salida</label>
                          <input type="date" name="fecha_salida" class="form-control" value="<?php echo date("Y-m-d");?>" required>
                        </div>
                      </div> 
                    </div>
                    </div>
                  </div>
                      <div class="col-lg-5 col-md-5 col-sm-12">
                      <div class="form-group p-r-10 p-l-10">
                         <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="row title-form">
                      Inventario
                      </div>
                    </div>
                      <div class="row p-t-20">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <div class="md-form form-md">
                            <label class="control-label">Unidad de medida</label>
                <select class="form-control custom-select" name="unidad" readonly required>
                  <?php if($producto['unidad'] == 'u'){ ?><option value="u" selected>u - Unidades</option><?php } ?>
                  <?php if($producto['unidad'] == 'm'){ ?><option value="m" selected>m - Metros</option><?php } ?>
                  <?php if($producto['unidad'] == 'm2'){ ?><option value="m2" selected>m2 - Metros ^2</option><?php } ?>
                  <?php if($producto['unidad'] == 'm3'){ ?><option value="m3" selected>m3 - Metros ^3</option><?php } ?>
                  <?php if($producto['unidad'] == 'km'){ ?><option value="km" selected>km - Kilometros</option><?php } ?>
                  <?php if($producto['unidad'] == 'g'){ ?><option value="g" selected>g - Gramos</option><?php } ?>
                  <?php if($producto['unidad'] == 'kg'){ ?><option value="kg" selected>kg - Kilogramos</option><?php } ?>
                  <?php if($producto['unidad'] == 'tn'){ ?><option value="tn" selected>Tn - Toneladas</option><?php } ?>
                  <?php if($producto['unidad'] == 'l'){ ?><option value="l" selected>l - Litros</option><?php } ?>
                </select>
                          </div>
                        </div> 
                      </div>
                      <div class="row p-t-20">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <div class="md-form form-md">
<div class="row p-10" style="border:1px solid #000;font-size: 24px; background:#f0f0f0;">
                <?php echo 'Stock: '.numero_stock($producto['unidad'],$producto['cantidades']).' '.$producto['unidad']; ?>
                </div>
                        </div> 
                      </div>
                    </div>
                      <div class="row p-t-20">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <div class="md-form form-md">
                            <label class="control-label">Cantidades a retirar</label>
                            <input type="number" name="cantidades" class="form-control" pattern="^\d+(?:\.\d{1,2})?$" max="<?php echo $producto['cantidades']; ?>" required>
                          </div>
                        </div> 
                      </div>
                  </div>
                </div>
</div>
            </form>
          </div>
            <div class="card-body">
<hr class="m-t-0 m-b-0">
              <div class="row p-t-20">
              <div class="col-12">
                                        <div class="d-flex flex-wrap">
                                            <div>
                                                <h6 class="text-muted"><a onclick="cancelar_retirar()" class="dropdown-item a-icon" data-toggle="tooltip" title="Cancelar"><i class="fas fa-times fa-2x"></i></a></h6>
                                            </div>
                                            <div class="ml-auto">
                                                <ul class="list-inline">
                                                    <li>
                                                        <h6 class="text-muted"><a onclick="submit_retirar();" class="dropdown-item a-icon" data-toggle="tooltip" title="Confirmar"><i class="fas fa-check fa-2x"></i></a></h6> 
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                  </div>
            </div>
        </div>
      </div>    
    </div>