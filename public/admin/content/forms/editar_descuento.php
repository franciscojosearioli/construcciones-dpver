<?php
require_once('../../includes/load.php');

$user = current_user();
$descuento = find_by_id('certificados_descuentos','idcertificados_descuentos',$_POST['id']); 

?>
<div class="row form-center" id="ver_form_editar">
  <div class="col-lg-12 col-md-12">
    <div class="card">
      <div class="card-body cards-titulo">
        <div class="d-flex flex-wrap">
          <div class="my-auto ml-3">
            DESCUENTOS > Editar 
          </div>
          <div class="ml-auto my-auto mr-3">
            <a onclick="cancelar_editar()" title="Cerrar" data-toggle="tooltip"><i class="fas fa-times"></i></a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <form method="post" action="certificados-descuentos" id="form_editar">
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
              <div class="form-group p-r-10 p-l-10">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="row title-form">
                    Informacion general 
                  </div>
                </div>
                <input type="text" name="editar_descuento" value="<?php echo $descuento['idcertificados_descuentos']; ?>" hidden>
                <div class="row p-t-20">
                  <div class="col-lg-8 col-md-8 col-sm-8">
                    <div class="md-form form-md">
                      <label class="control-label">Descripcion</label>
                      <input type="text" name="descripcion" class="form-control" value="<?php echo $descuento['descripcion']; ?>" required>
                    </div>
                  </div> 
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="md-form form-md">
                      <label class="control-label">Porcentaje</label>
                      <input type="number" name="valor" class="form-control" value="<?php echo $descuento['valor']; ?>" required>
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