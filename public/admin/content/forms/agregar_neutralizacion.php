<?php
require_once('../../includes/load.php');
$user = current_user();
$oyp = all_oyp();
?>

<div class="row form-center hide" id="agregar_neutralizacion">
        <div class="col-lg-12 col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
              <div class="col-12">
                                        <div class="d-flex flex-wrap">
                                            <div>
                                                <h3 class="card-title">Agregar nueva neutralizacion</h3>
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
            <form method="post" action="neutralizaciones" id="form_agregar" enctype="multipart/form-data">
              <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="form-group p-r-10 p-l-10">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="row title-form">
                      Informacion del tramite
                      </div>
                      </div>
                      <input type="text" name="agregar_neutralizacion" hidden>
                      <div class="row p-t-20">
                          
                        <div class="col-lg-3 col-md-3 col-sm-12">
                          <div class="md-form form-md">
                            <label class="control-label">Numero</label>
                            <input type="number" name="numero" class="form-control" required>
                          </div>
                        </div> 
                        <div class="col-lg-3 col-md-3 col-sm-12">
                        <div class="md-form form-md">
                          <label class="control-label">Expediente</label>
                          <input type="number" name="expediente" class="form-control" required>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="md-form form-md">
                          <label class="control-label">Estado</label>
                          <select class="form-control custom-select" name="estado" required>
                  <option selected disabled>Seleccione un estado</option>
                    <option value="1">1. Confeccion Inspeccion</option>
                    <option value="2">2. Revision Dpto. II Obras por contrato</option>
                    <option value="3">3. Autorizando Ing. Jefe</option>
                    <option value="4">4. Encuadre Legal</option>
                    <option value="5">5. Imputacion del Gasto</option>
                    <option value="6">6. Confeccionando Resolucion</option>
                    <option value="7">7. Resolucion aprobada</option>
                </select>
                        </div>
                      </div>  
                      </div>

                      <div class="row p-t-10">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="md-form form-md">
                          <label class="control-label">Obra</label>
                          <select class="form-control obra" name="obra" style="height:80px;width:100%;" required>    
                            <option value="0" selected>No interviene obra</option>
                            <?php foreach($oyp as $r): ?>    
                            <option value="<?php echo $r['idobras']; ?>"><?php echo $r['numero'].' - '.$r['expediente'].' - '.$r['nombre']; ?></option>
                            <?php endforeach; ?>
                            </select>
                        </div>
                      </div>
                      </div> 
                    </div>
                  </div>
</div>


<div class="row">
                      <div class="col-lg-6 col-md-6 col-sm-12">
                      <div class="form-group p-r-10 p-l-10">
                         <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="row title-form">
                      Resolucion de aprobacion
                      </div>
                    </div>
                    <div class="row p-t-20">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                          <div class="md-form form-md">
                            <label class="control-label">Numero</label>
                            <input type="number" name="resolucion_numero" class="form-control">
                          </div>
                        </div> 
                        <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="md-form form-md">
                          <label class="control-label">Fecha</label>
                          <input type="date" name="resolucion_fecha" class="form-control">
                        </div>
                      </div>
                      </div>
                    <div class="row p-t-20">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                        <label class="control-label">Archivo</label>
                        <input type="file" name="resolucion_archivo" class="dropify-es" />
                        </div> 
                      </div>
                  </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="form-group p-r-10 p-l-10">
                         <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="row title-form">
                      Detalles del tramite
                      </div>
                    </div>
                    <div class="row p-t-20">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                          <div class="md-form form-md">
                            <label class="control-label">Inicio de neutralizacion</label>
                          <input type="date" name="fecha_inicio" class="form-control" required>
                          </div>
                        </div> 
                        <div class="col-lg-6 col-md-6 col-sm-12">
                          <div class="md-form form-md">
                            <label class="control-label">Reinicio de obra</label>
                          <input type="date" name="fecha_reinicio" class="form-control">
                          </div>
                        </div> 
                      </div>
                  </div> 
                      <div class="form-group p-r-10 p-l-10">
                         <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="row title-form">
                      Archivos del tramite
                      </div>
                    </div>
                    <div class="row p-t-20">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                        <input type="file" name="archivos_tramite[]" class="dropify-es" />
                        </div> 
                      </div>
                      <div class="row p-t-10">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="md-form form-md">
                          <label class="control-label">Observaciones</label>
                          <input type="text" name="observaciones" class="form-control">
                        </div>
                      </div>
                      </div> 
                  </div>
                </div>
</div>



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
                                                        <h6 class="text-muted"><button type="submit" class="dropdown-item a-icon" data-toggle="tooltip" title="Confirmar"><i class="fas fa-check fa-2x"></i></button></h6> 
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
            </form>
                                    </div>
                                  </div>
            </div>
        </div>
      </div>    
    </div>
    <script type="text/javascript">
$(document).ready(function () {
  $('.obra').select2();
});

  </script>