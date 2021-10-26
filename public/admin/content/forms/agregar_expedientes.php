<?php 
require_once('../../includes/load.php');
$user = current_user();
$all_direcciones = find_all('direcciones');
$expediente = buscar_expediente($_POST['numero']);
$tramites_etiquetas = find_all_by_id('tramites_etiquetas','condicion',1);
$oyp = all_oyp();

?>
      <div class="row form-center" id="agregar_expedientes">
        <div class="col-lg-12 col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
              <div class="col-12">
                                        <div class="d-flex flex-wrap">
                                            <div>
                                                <h3 class="card-title">Agregar nuevo expediente</h3>
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
          <?php   
$busqueda= verif_expediente($_POST['numero']);
  if(!empty($busqueda['expediente'])){
    ?>
  <div class="row justify-content-center"> 
    <div class="form-group p-r-10 p-l-10">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="bg-danger p-20 text-white">
          <center>
    El expediente N <?php echo $_POST['numero']; ?> ya existe. Por favor cancele este formulario.
  </center>
  </div>
  </div>
  </div>
  </div>
<?php }else{ ?>  
            <form method="post" action="tramites" id="form_agregar_expediente">

              <div class="row">              
                      <div class="col-lg-7 col-md-7 col-sm-12">
                    <div class="form-group p-r-10 p-l-10">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="row title-form">
                      Informacion del tramite
                      </div>
                      </div>
                      <input type="text" name="add_expedientes" hidden>
                      <div class="row p-t-20">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <div class="md-form form-md">
                            <label class="control-label">Numero</label>
                            <input type="text" name="numero" class="form-control" value="<?php if(!empty($expediente["numero"])){ echo trim(utf8_encode($expediente["numero"]));}else{ echo trim($_POST['numero']); } ?>" readonly>
                          </div>
                        </div> 
                      </div>
                      <div class="row p-t-10">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="md-form form-md">
                          <label class="control-label">Asunto</label>
                          <textarea name="asunto" class="form-control md-textarea" rows="3" <?php if(!empty($expediente["asunto"])){ ?> readonly <?php } ?>><?php echo utf8_encode($expediente["asunto"]); ?></textarea>
                        </div>
                      </div> 
                    </div>
                      <div class="row p-t-10">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="md-form form-md">
                          <label class="control-label">Iniciador</label>
                          <input type="text" name="iniciador" class="form-control" value="<?php echo utf8_encode($expediente["iniciador"]); ?>" <?php if(!empty($expediente["iniciador"])){ ?> readonly <?php } ?>>
                        </div>
                      </div> 
                    </div>
                      <div class="row p-t-10">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="md-form form-md">
                          <label class="control-label">Fecha de inicio</label>
                          <input type="date" name="fecha_inicio" class="form-control" value="<?php echo utf8_encode($expediente["fechareg"]); ?>" <?php if(!empty($expediente["fechareg"])){ ?> readonly <?php } ?>>
                        </div>
                      </div>
                      </div>  



                <div class="row p-t-20">
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="md-form form-md">
                    <label class="control-label">Etiquetas del tramite</label>
                            <select class="form-control etiquetas" name="etiquetas[]" style="height:80px;width:100%;" required>    
                            <?php foreach($tramites_etiquetas as $e): ?>    
                            <option value="<?php echo $e['idtramites_etiquetas']; ?>"><?php echo $e['titulo']; ?></option>
                            <?php endforeach; ?>
                            </select>
                            <div id="result_etiquetas"></div>
                    </div>
                  </div>
                </div> 
                <div class="row p-t-20">
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="md-form form-md">
                    <label class="control-label">Obra relacionada al tramite</label>
                            <select class="form-control obra" name="obra[]" style="height:80px;width:100%;" required>    
                            <option value="0" selected>No interviene obra</option>
                            <?php foreach($oyp as $r): ?>    
                            <option value="<?php echo $r['idobras']; ?>"><?php echo $r['numero'].' - '.$r['expediente'].' - '.$r['nombre']; ?></option>
                            <?php endforeach; ?>
                            </select>
                            <div id="result_etiquetas"></div>
                    </div>
                  </div>
                </div> 



                            <div class="row p-t-20">
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="md-form form-md">

                      <label class="control-label">Prioridad del tramite</label>
                      <select class="form-control custom-select" name="prioridad" required>
                          <option value="1" selected>Urgente</option>
                          <option value="2">Alto</option>
                          <option value="3">Medio</option>
                          <option value="4">Bajo</option>
                      </select>
                    </div>
                  </div>
                </div> 



                <div class="row p-t-20 hide">
                  <div class="col-md-12">
                    <div class="md-form form-md">
                      <label class="control-label">Estado del tramite</label>
                      <select class="form-control custom-select" name="condicion" required >
                          <option value="1" selected>Activo</option>
                          <option value="0">Archivado</option>
                      </select>
                    </div>
                  </div>
                </div> 
                    </div>
                  </div>
                      <div class="col-lg-5 col-md-5 col-sm-12">
                      <div class="form-group p-r-10 p-l-10">
                         <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="row title-form">
                      Ingreso / Pase del tramite
                      </div>
                    </div>
                    <div class="row p-t-20">
                      <div class="col-12">
                        <label class="control-label">Realizar un pase</label>
                        <select class="form-control custom-select" name="iddireccion" id="select_direccion_pase" required>
                          <option selected disabled>Seleccione una direccion</option>
                          <?php foreach ($all_direcciones as $direccion ):?>
                            <option value="<?php echo $direccion['iddireccion'];?>"><?php echo ucwords($direccion['nombre']);?></option>
                          <?php endforeach;?>
                        </select>
                      </div> 
                    </div>
                    <div id="departamentos_pase"></div>
                      <div class="row p-t-10">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="md-form form-md">
                          <label class="control-label">Fecha del pase</label>
                          <input type="date" name="fecha_pase" class="form-control"  value="<?php echo date("Y-m-d");?>" required>
                        </div>
                      </div>
                      </div>
                      <div class="row p-t-10">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="md-form form-md">
                          <label class="control-label">Emisor del tramite</label>
                          <input type="text" name="emisor" class="form-control" required>
                        </div>
                      </div>
                      </div>
                      <div class="row p-t-10">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="md-form form-md">
                          <label class="control-label">Receptor del tramite</label>
                          <input type="text" name="receptor" class="form-control" required>
                        </div>
                      </div>
                      </div>
                <div class="row p-t-20">
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="md-form form-md">
                      <label class="control-label">Observaciones</label>
                      <textarea name="observaciones" class="form-control md-textarea" rows="2"></textarea>
                    </div>
                  </div>
                </div>
                  </div>
                </div>

</div>
            </form>
            <?php } ?>
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
<?php  if(empty($busqueda['expediente'])){ ?>
                                                        <h6 class="text-muted"><a onclick="submit_agregar_expediente();" class="dropdown-item a-icon" data-toggle="tooltip" title="Confirmar"><i class="fas fa-check fa-2x"></i></a></h6> 
                                                    <?php } ?></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                  </div>
            </div>
        </div>
      </div>    
    </div>

           
<script>
        $( "#select_direccion_pase" ).change(function() {
      var valor = $(this).val();
        $.post("includes/ajax/direccion-departamentos.php",  { valor: valor }).done(function(data) {
                    $('#departamentos_pase').html(data);
});
});
</script>
<script type="text/javascript">

$(document).ready(function () {
  $('.etiquetas').select2();
  $('.obra').select2();

});
  </script>