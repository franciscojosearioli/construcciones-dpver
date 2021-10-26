<?php 
$obra = find_by_id('obras','idobras',$obra_id);

?>
<div class="row justify-content-center hide" id="agregar_cotizacion">
<?php if($obra_id){ ?>
  <div class="row justify-content-center">
  <div class="col-10">
    <div class="card">
      <div class="card-body cards-titulo">
        <div class="d-flex flex-wrap">
          <div class="my-auto ml-3">
            Nueva cotizacion de obra
          </div>
          <div class="ml-auto my-auto mr-3">
            <a onclick="cancelar_agregar()" title="Cerrar" data-toggle="tooltip"><i class="fas fa-times"></i></a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <form method="post" action="obra?id=<?php echo $obra_id; ?>" id="form_agregar">
          <input type="text" name="add_cotizacion" hidden>
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
              <div class="form-group p-r-10 p-l-10">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="row title-form">
                    Informacion del acta y resolucion
                  </div>
                </div>
                <div class="row p-t-20">
                  <div class="col-lg-2 col-md-2 col-sm-12">
                     <div class="md-form form-md">
                      <label class="control-label">Numero</label>
                      <input type="text" name="numero_cotiz" id="numero_cotiz" class="form-control" required>
                    </div>
                  </div> 
                  <div class="col-lg-7 col-md-7 col-sm-12">
                     <div class="md-form form-md">
                      <label class="control-label">Detalle</label>
                      <input type="text" name="detalle" id="detalle" class="form-control" required>
                    </div>
                  </div> 
                  <div class="col-lg-3 col-md-3 col-sm-12">
                     <div class="md-form form-md">
                      <label class="control-label">Referencia</label>
                      <select class="form-control custom-select" name="referencia" required>
                      <option value="1">Contrato</option>
                      <option value="2">Modificacion de obra</option>
                      <option value="4">Readecuacion</option>
                      </select>
                    </div>
                  </div> 
                </div>
              </div>
              <div class="form-group p-r-10 p-l-10">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="row title-form">
                    Obra
                  </div>
                </div>
                <div class="row p-t-20" >
                  <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                    <div class="md-form form-md"><a class="btn btn-warning" id="add_items_cotizacion" onclick="obra_cotizacion(<?php echo $obra['idobras']; ?>)">Agregar items a cotizacion</a>
                    </div>
                  </div> 
                </div>


<div id="planilla-cotizacion"></div>



              </div>
            </div>

          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php }else{ echo '<p class="text-white">Creando formulario, <a onclick="cancelar_agregar()"><u>haga click aqui para volver</u></a></p>'; } ?>
</div>

  <script>

function obra_cotizacion(id){
  var id = id;
  var form = 'agregar';
  var numero = $('#numero_cotiz').val();
  var expediente = $('#expediente').val();
  var detalle = $('#detalle').val();
  var estado = $('#estado').val();
  var n_reso = $('#n_reso').val();
  var f_reso = $('#f_reso').val();
  $.post("includes/ajax/cotizacion.php", {obra_id: id,form:form,numero:numero,detalle:detalle}, function(result){
    $('#add_items_cotizacion').hide();

    $("#planilla-cotizacion").html(result);
  });
}
</script>