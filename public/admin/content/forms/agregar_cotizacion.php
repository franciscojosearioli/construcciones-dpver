<div class="row justify-content-center hide" id="ver_form_agregar">
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
        <form method="post" action="cotizaciones" id="form_agregar">
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
                <div class="row p-t-20">
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="md-form form-md">
                      <label class="control-label">Complete el nombre de la obra</label>
                      <input type="search"  class="form-control" aria-controls="1" id="busqueda_redeter">
                    </div>
                  </div> 
                </div>


<div id="planilla-cotizacion"></div>



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
    $('#busqueda_redeter').hide();
    $('.tt-hint').hide();

    $("#planilla-cotizacion").html(result);
  });
}



$(document).ready(function(){
busquedaglobal = new Bloodhound({datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),queryTokenizer: Bloodhound.tokenizers.whitespace,remote: {url:'./includes/ajax/busqueda_obra.php?key=%QUERY',wildcard: '%QUERY',filter: function (results) {return $.map(results, function (result) {return {value: result};});}}});

    busquedaglobal.initialize();

    $('#busqueda_redeter').typeahead(null, {
    name: 'value',
    display: 'value',  
    source: busquedaglobal,
    limit:30,
    templates: {
    suggestion:  function(data) {
        if(data.value.estado == 0){
                    return '<a style="text-decoration:none;font-size:11px;line-height: 1.5" onclick="obra_cotizacion('+data.value.idobras+')"><div>OBRA: '+ data.value.nombre.substring(0, 40) +'...<br>ESTADO: En ejecucion<br>EXPEDIENTE: '+data.value.expediente+'<br>CAJA: '+data.value.numero+'</div></a>'
    }if(data.value.estado == 4){
                    return '<a style="text-decoration:none;font-size:11px;line-height: 1.5" onclick="obra_cotizacion('+data.value.idobras+')"><div>OBRA: '+ data.value.nombre.substring(0, 40) +'...<br>ESTADO: Neutralizada<br>EXPEDIENTE: '+data.value.expediente+'<br>CAJA: '+data.value.numero+'</div></a>'
    }if(data.value.estado == 5){
                    return '<a style="text-decoration:none;font-size:11px;line-height: 1.5" onclick="obra_cotizacion('+data.value.idobras+')"><div>OBRA: '+ data.value.nombre.substring(0, 40) +'...<br>ESTADO: Rescindida<br>EXPEDIENTE: '+data.value.expediente+'<br>CAJA: '+data.value.numero+'</div></a>'
    }
    if(data.value.estado == 3){
     if(data.value.finalizado == 0){
                     return '<a style="text-decoration:none;font-size:11px;line-height: 1.5" onclick="obra_cotizacion('+data.value.idobras+')"><div>OBRA: '+ data.value.nombre.substring(0, 40) +'...<br>ESTADO: Finalizada sin recibir<br>EXPEDIENTE: '+data.value.expediente+'<br>CAJA: '+data.value.numero+'</div></a>'
     }if(data.value.finalizado == 1){
                     return '<a style="text-decoration:none;font-size:11px;line-height: 1.5" onclick="obra_cotizacion('+data.value.idobras+')"><div>OBRA: '+ data.value.nombre.substring(0, 40) +'...<br>ESTADO: Finalizada en garantia<br>EXPEDIENTE: '+data.value.expediente+'<br>CAJA: '+data.value.numero+'</div></a>'
     }if(data.value.finalizado == 2){
                     return '<a style="text-decoration:none;font-size:11px;line-height: 1.5" onclick="obra_cotizacion('+data.value.idobras+')"><div>OBRA: '+ data.value.nombre.substring(0, 40) +'...<br>ESTADO: Finalizada definitiva<br>EXPEDIENTE: '+data.value.expediente+'<br>CAJA: '+data.value.numero+'</div></a>'
     }
    }
                }
    }

});

});
</script>
