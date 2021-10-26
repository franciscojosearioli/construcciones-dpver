<?php
require_once('../../includes/load.php');

$user = current_user();
$precio_item = find_by_id('certificados_precios','idcertificados_precios',$_POST['id']); 

?>
<div class="row form-center" id="editar_precios_items">
  <div class="col-lg-12 col-md-12">
    <div class="card">
      <div class="card-body cards-titulo">
        <div class="d-flex flex-wrap">
          <div class="my-auto ml-3">
            INDICE DE PRECIOS > Editar 
          </div>
          <div class="ml-auto my-auto mr-3">
            <a onclick="cancelar_editar()" title="Cerrar" data-toggle="tooltip"><i class="fas fa-times"></i></a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <form method="post" action="precios-items" id="form_editar">
          <input type="text" name="idcertificados_precios" value="<?php echo $precio_item['idcertificados_precios']; ?>" hidden>
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
              <div class="form-group p-r-10 p-l-10">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="row title-form">
                    Informacion general
                  </div>
                </div>
                <input type="text" name="editar_precio" hidden>
                <div class="row p-t-20">
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="md-form form-md">
                      <label class="control-label">Descripcion</label>
                      <input type="text" name="descripcion" class="form-control" value="<?php echo $precio_item['descripcion']; ?>" required>
                    </div>
                  </div> 
                </div>
                <div class="row p-t-20">
                  <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="md-form form-md">
                      <label class="control-label">Porcentaje</label>
                      <input type="text" name="valor" class="form-control" value="<?php echo $precio_item['valor']; ?>" required>
                    </div>
                  </div> 
                  <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="form-group">
                      <label>Tipo</label>
                      <select name="tipo" class="custom-select col-12" id="inlineFormCustomSelect">
                        <optgroup label="Establecido">
                    <?php if($precio_item['tipo'] == null){ ?>
            <option disabled selected>Sin definir</option>
                    <?php }else{ ?>
            <option value="<?php echo $precio_item['tipo']; ?>" selected><?php echo $precio_item['tipo']; ?></option>
          <?php } ?>
            </optgroup>
                  <optgroup label="Opciones ">
            <option value="Camino">Camino</option>
            <option value="Puente">Puente</option>
              </optgroup>
            </select>
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
                <h6 class="text-muted"><a onclick="cancelar_editar()" class="dropdown-item a-icon" data-toggle="tooltip" title="Cancelar"><i class="fas fa-times fa-2x"></i></a></h6>
              </div>
              <div class="ml-auto">
                <ul class="list-inline">
                  <li>
                    <h6 class="text-muted"><a onclick="submit_editar();" class="dropdown-item a-icon" data-toggle="tooltip" title="Confirmar"><i class="fas fa-check fa-2x"></i></a></h6> 
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