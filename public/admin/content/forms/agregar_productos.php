<?php
require_once('../../includes/load.php');

$user = current_user();
$categorias = listar_categorias_activas($user['iddireccion'],$user['iddepartamentos']) ;

 ?>
      <div class="row form-center hide" id="agregar_productos">
        <div class="col-lg-12 col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
              <div class="col-12">
                                        <div class="d-flex flex-wrap">
                                            <div>
                                                <h3 class="card-title">Agregar nuevo producto</h3>
                                                <h6 class="card-subtitle"><?php echo find_select('nombre','departamentos','iddepartamentos',$user['iddepartamentos']) ?> - <?php echo find_select('nombre','direcciones','iddireccion',$user['iddireccion']) ?></h6>
                                            </div>
                                            <div class="ml-auto">
                                                <ul class="list-inline">
                                                    <li>
                                                      <h6 class="text-muted"><a onclick="cancelar_agregar()" class="dropdown-item a-icon" data-toggle="tooltip" title="Cancelar"><i class="fas fa-times fa-2x"></i></a></h6>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                  </div>

            <hr class="m-t-0 m-b-0"></div>
          <div class="card-body">
            <form method="post" action="productos" id="form_agregar">
              <div class="row">
                      <div class="col-lg-7 col-md-7 col-sm-12">
                    <div class="form-group p-l-10 p-r-10">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="row title-form">
                      Informacion del producto
                      </div>
                      </div>
                      <input type="text" name="agregar_productos" hidden>
                      <div class="row p-t-20">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="md-form form-md">
                          <label class="control-label">Codigo / Referencia</label>
                          <input type="text" name="codigo" class="form-control">
                        </div>
                      </div>
                      </div> 
                      <div class="row p-t-10">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <div class="md-form form-md">
                            <label class="control-label">Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" required>
                          </div>
                        </div> 
                      </div>
                      <div class="row p-t-10">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="md-form form-md">
                          <label class="control-label">Descripcion</label>
                          <input type="text" name="descripcion" class="form-control" required>
                        </div>
                      </div> 
                    </div>
                      <div class="row p-t-10">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="md-form form-md">
                          <label class="control-label">Categoria</label>
                    <select class="form-control custom-select" name="idcategorias" required>
                        
                      <?php 
                      if(!empty($categorias)){ ?>
                      <option disabled selected>Seleccione una categoria</option>
                        <?php
                      foreach ($categorias as $categoria):?>
                        <option value="<?php echo $categoria['idcategorias']; ?>"><?php echo $categoria['nombre']; ?></option>
                      <?php endforeach; 
                    }else{
                      ?>
                      <option disabled selected>No hay categorias creadas.</option>
                      <?php
                    }
                      ?>
                    </select>
                    <?php if(empty($categorias)){ ?>
                    <?php  } ?><span class="help-block"><small>Cree una categoria haciendo <a href="categorias">click aqui.</a></small></span>
                        </div>    
                      </div> 
                    </div>
                      <div class="row p-t-10">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="md-form form-md">
                          <label class="control-label">Responsable del producto</label>
                          <input type="text" name="cargo" class="form-control" required>
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
                <select class="form-control custom-select" name="unidad" required>
                  <option disabled selected>Seleccione una opcion</option>
                  <option value="u">u - Unidades</option>
                  <option value="m">m - Metros</option>
                  <option value="m2">m2 - Metros ^2</option>
                  <option value="m3">m3 - Metros ^3</option>
                  <option value="km">km - Kilometros</option>
                  <option value="g">g - Gramos</option>
                  <option value="kg">kg - Kilogramos</option>
                  <option value="kg">Tn - Toneladas</option>
                  <option value="l">l - Litros</option>
                </select>
                          </div>
                        </div> 
                      </div>
                      <div class="row p-t-20">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <div class="md-form form-md">
                            <label class="control-label">Cantidades</label>
                            <input type="number" name="cantidades" class="form-control" pattern="^\d+(?:\.\d{1,2})?$" required>
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
                                                <h6 class="text-muted"><a onclick="cancelar_agregar()" class="dropdown-item a-icon" data-toggle="tooltip" title="Cancelar"><i class="fas fa-times fa-2x"></i></a></h6>
                                            </div>
                                            <div class="ml-auto">
                                                <ul class="list-inline">
                                                    <li>
                                                        <h6 class="text-muted"><a onclick="submit_agregar();" class="dropdown-item a-icon" data-toggle="tooltip" title="Confirmar"><i class="fas fa-check fa-2x"></i></a></h6> 
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