<?php
require_once('../../includes/load.php');
$user = current_user();
$oyp = all_oyp();
$data = find_by_id('obras_modificaciones','idmodificaciones',$_POST['id']);
$obra = find_by_id('obras','idobras',$data['idobras']);
?>
<div class="row form-center" id="editar_modificaciones">
        <div class="col-lg-12 col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
              <div class="col-12">
                                        <div class="d-flex flex-wrap">
                                            <div>
                                                <h3 class="card-title">Editar modificacion</h3>
                                            </div>
                                            <div class="ml-auto">
                                                <ul class="list-inline">
                                                    <li>
                                                      <h6 class="text-muted"><a onclick="cancelar_editar()" class="dropdown-item a-icon" data-toggle="tooltip" title="Cancelar"><i class="fas fa-times fa-2x"></i></a></h6>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                  </div>

            <hr class="m-t-0 m-b-0">
          </div>
          <div class="card-body">
            <form method="post" action="modificaciones" id="form_editar_modificacion" enctype="multipart/form-data">
              <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="form-group p-r-10 p-l-10">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="row title-form">
                      Informacion del tramite
                      </div>
                      </div>
                      <input type="text" name="editar_modificacion" value="<?php echo $data['idmodificaciones']; ?>" hidden>
                      <div class="row p-t-20">
                        <div class="col-lg-3 col-md-3 col-sm-12">
                          <div class="md-form form-md">
                            <label class="control-label">Numero</label>
                            <input type="number" name="numero" class="form-control" value="<?php echo $data['numero']; ?>" required>
                          </div>
                        </div> 
                        <div class="col-lg-3 col-md-3 col-sm-12">
                        <div class="md-form form-md">
                          <label class="control-label">Expediente</label>
                          <input type="number" name="expediente" class="form-control" value="<?php echo $data['expediente']; ?>" required>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="md-form form-md">
                          <label class="control-label">Estado</label>
                          <select class="form-control custom-select" name="estado" required>
                          <optgroup label="Establecido">
                    <?php if($data['estado'] == 0){ echo '<option value="0" selected>Sin definir</option>'; }
                    if($data['estado'] == 1){ echo '<option value="1" selected>1. Confeccion Inspeccion</option>';}
                    if($data['estado'] == 2){ echo '<option value="2" selected>2. Revision Dpto. II Obras por contrato</option>';}
                    if($data['estado'] == 3){ echo '<option value="3" selected>3. Autorizando Ing. Jefe</option>';}
                    if($data['estado'] == 4){ echo '<option value="4" selected>4. Encuadre Legal</option>';}
                    if($data['estado'] == 5){ echo '<option value="5" selected>5. Imputacion del gasto</option>';}
                    if($data['estado'] == 6){ echo '<option value="6" selected>6. Confeccionando resolucion</option>';}
                    if($data['estado'] == 7){ echo '<option value="7" selected>7. Resolucion aprobada</option>';} ?>
                  </optgroup>
                  <optgroup label="Opciones ">
                    <option value="1">1. Confeccion Inspeccion</option>
                    <option value="2">2. Revision Dpto. II Obras por contrato</option>
                    <option value="3">3. Autorizando Ing. Jefe</option>
                    <option value="4">4. Encuadre Legal</option>
                    <option value="5">5. Imputacion del Gasto</option>
                    <option value="6">6. Confeccionando Resolucion</option>
                    <option value="7">7. Resolucion aprobada</option>
                    </optgroup>
                </select>
                        </div>
                      </div>  
                      </div>
                      <div class="row p-t-10">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="md-form form-md">
                          <label class="control-label">Obra</label>
                          <select class="form-control obra" name="obra" style="height:80px;width:100%;" onchange="obra_planesycotizaciones();" required>    
                  <optgroup label="Establecido">
                            <option value="<?php echo $obra['idobras']; ?>" selected><?php echo $obra['numero'].' - '.$obra['expediente'].' - '.$obra['nombre']; ?></option>
                          </optgroup>
                  <optgroup label="Opciones ">
                            <?php foreach($oyp as $r): ?>    
                            <option value="<?php echo $r['idobras']; ?>"><?php echo $r['numero'].' - '.$r['expediente'].' - '.$r['nombre']; ?></option>
                            <?php endforeach; ?>
                            </optgroup>
                            </select>
                        </div>
                      </div>
                      </div> 
                    <div id="select-planes-de-trabajo"></div>
                    
                    <div id="select-cotizaciones"></div>
                    </div>
                  </div>
</div>

<div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="form-group p-r-10 p-l-10">
                         <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="row title-form">
                      Detalles del tramite
                      </div>
                    </div>
                    <div class="row p-t-20">
                        <div class="col-lg-8 col-md-8 col-sm-12">
                          <div class="md-form form-md">
                            <label class="control-label">Memoria</label>
                            <textarea class="form-control" name="memoria" rows="15" required><?php echo $data['descripcion']; ?></textarea>
                          </div>
                        </div> 
                        <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="row p-t-20">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                          <div class="md-form form-md">
                            <label class="control-label">Computos</label>
                            <select class="form-control custom-select" name="computo_estado" required>
                            <optgroup label="Establecido">
                    <?php if($obra['computo_estado'] == 0){ echo '<option value="0" selected>Sin definir</option>'; }
                    if($data['computo_estado'] == 1){ echo '<option value="1" selected>Recibido</option>';}
                    if($data['computo_estado'] == 2){ echo '<option value="2" selected>Empresa</option>';}
                    if($data['computo_estado'] == 3){ echo '<option value="3" selected>Aprobado</option>';} ?>
                  </optgroup>
                  <optgroup label="Opciones ">
                    <option value="0">Sin definir</option>
                    <option value="1">Recibido</option>
                    <option value="2">Empresa</option>
                    <option value="3">Aprobado</option>
                    </optgroup>
                </select>
                          </div>
                        </div> 
                        <div class="col-lg-6 col-md-6 col-sm-12">
                          <div class="md-form form-md">
                            <label class="control-label">&nbsp;</label>
                          <input type="date" name="computo_fecha" class="form-control"  value="<?php echo $data['computo_fecha']; ?>">
                          </div>
                        </div> 
                      </div>
                      <div class="row p-t-20">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                          <div class="md-form form-md">
                            <label class="control-label">Precios</label>
                            <select class="form-control custom-select" name="precios_estado" required> 
                  <optgroup label="Establecido">
                    <?php if($data['precios_estado'] == 0){ echo '<option value="0" selected>Sin definir</option>'; }
                    if($data['precios_estado'] == 1){ echo '<option value="1" selected>Recibido</option>';}
                    if($data['precios_estado'] == 2){ echo '<option value="2" selected>Empresa</option>';}
                    if($data['precios_estado'] == 3){ echo '<option value="3" selected>Aprobado</option>';} ?>
                  </optgroup>
                  <optgroup label="Opciones ">
                    <option value="0">Sin definir</option>
                    <option value="1">Recibido</option>
                    <option value="2">Empresa</option>
                    <option value="3">Aprobado</option>
                    </optgroup>
                </select>
                          </div>
                        </div> 
                        <div class="col-lg-6 col-md-6 col-sm-12">
                          <div class="md-form form-md">
                            <label class="control-label">&nbsp;</label>
                          <input type="date" name="precios_fecha" class="form-control"  value="<?php echo $data['precios_fecha']; ?>">
                          </div>
                        </div> 
                      </div>
                      <div class="row p-t-20">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <div class="md-form form-md">
                            <label class="control-label">Mayor gasto</label>
                          <input type="number" name="mayor_gasto" class="form-control"  value="<?php echo $data['monto']; ?>" required>
                          </div>
                        </div> 
                      </div>
                      <div class="row p-t-20">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <div class="md-form form-md">
                            <label class="control-label">Monto final</label>
                          <input type="number" name="monto_final" class="form-control" value="<?php echo $data['monto_final']; ?>" required>
                          </div>
                        </div> 
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
                            <input type="number" name="resolucion_numero" class="form-control" value="<?php echo $data['resolucion_numero']; ?>">
                          </div>
                        </div> 
                        <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="md-form form-md">
                          <label class="control-label">Fecha</label>
                          <input type="date" name="resolucion_fecha" class="form-control" value="<?php echo $data['resolucion_fecha']; ?>">
                        </div>
                      </div>
                      </div>
                    <div class="row p-t-20">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <label class="control-label">Archivo</label>
                          <input type="file" name="resolucion_archivo" class="dropify-es" id="input-file-now-custom-1" 
  <?php if(!empty($data['resolucion_archivo'])){ ?> data-default-file="<?php echo '../../../uploads/Obras/'.$obra['idobras'].'/Tramites/Modificaciones/'.$data['numero'].'/Resolucion/'.$data['resolucion_archivo']; ?>" <?php } ?> />
                        </div> 
                      </div>
                  </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                      <div class="form-group p-r-10 p-l-10">
                         <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="row title-form">
                      Archivos del tramite
                      </div>
                    </div>
                    <div class="row p-t-20">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                        <input type="file" name="archivos_tramite[]" class="dropify-es" multiple />
                        </div> 
                    
                      </div>
                      <div class="row p-t-10">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="md-form form-md">
                          <label class="control-label">Observaciones</label>
                          <input type="text" name="observaciones" class="form-control"  value="<?php echo $data['observaciones']; ?>">
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
                                                <h6 class="text-muted"><a onclick="cancelar_editar()" class="dropdown-item a-icon" data-toggle="tooltip" title="Cancelar"><i class="fas fa-times fa-2x"></i></a></h6>
                                            </div>
                                            <div class="ml-auto">
                                                <ul class="list-inline">
                                                    <li>
                                                        <h6 class="text-muted"><a  onclick="submit_editar_modificacion()" class="dropdown-item a-icon" data-toggle="tooltip" title="Confirmar"><i class="fas fa-check fa-2x"></i></a></h6> 
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
            </form>
                                  </div>
            </div>
        </div>
      </div>    
    </div>

    <script type="text/javascript">
$(document).ready(function () {
  $('.obra').select2();
  var id = $('.obra').val();

  if(id != 0){

$.post("includes/ajax/lista_mod_planesdetrabajo.php", {id: id}, function(result){

$("#select-planes-de-trabajo").html(result);

}); 
$.post("includes/ajax/lista_mod_cotizaciones.php", {id: id}, function(result){

$("#select-cotizaciones").html(result);
});

  }
});

$(document).ready(function() {
    $('.dropify').dropify();
    $('.dropify-es').dropify({
        messages: {
            default: 'Arrastre y suelte el archivo, o haga click aqui',
            replace: 'Arrastre y suelte el archivo, o haga click aqui para reemplazar',
            remove: 'Eliminar',
            error: 'El archivo es demasiado grande'
        }
    });
    var drEvent = $('#input-file-events').dropify();
    drEvent.on('dropify.beforeClear', function(event, element) {
        return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
    });
    drEvent.on('dropify.afterClear', function(event, element) {
        alert('File deleted');
    });
    drEvent.on('dropify.errors', function(event, element) {
        console.log('Has Errors');
    });
    var drDestroy = $('#input-file-to-destroy').dropify();
    drDestroy = drDestroy.data('dropify')
    $('#toggleDropify').on('click', function(e) {
        e.preventDefault();
        if (drDestroy.isDropified()) {
            drDestroy.destroy();
        } else {
            drDestroy.init();
        }
    })
});
function obra_planesycotizaciones(){
  var id = $('.obra').val();

  $.post("includes/ajax/lista_mod_planesdetrabajo.php", {id: id}, function(result){

    $("#select-planes-de-trabajo").html(result);
  });
  
  $.post("includes/ajax/lista_mod_cotizaciones.php", {id: id}, function(result){

$("#select-cotizaciones").html(result);
});
  }
  </script>