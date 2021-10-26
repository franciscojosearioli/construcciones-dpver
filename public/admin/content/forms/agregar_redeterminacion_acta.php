<div class="row justify-content-center hide" id="ver_form_agregar">
<div class="row justify-content-center">
  <div class="col-10">
    <div class="card">
      <div class="card-body cards-titulo">
        <div class="d-flex flex-wrap">
          <div class="my-auto ml-3">
            Complete para cargar acta de redeterminacion de precios
          </div>
          <div class="ml-auto my-auto mr-3">
            <a onclick="cancelar_agregar()" title="Cerrar" data-toggle="tooltip"><i class="fas fa-times"></i></a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <form method="post" action="redeterminaciones-actas" id="form_agregar">
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
                      <label class="control-label">Numero del expediente</label>
                      <input type="text" name="expediente" id="expediente" class="form-control" >
                    </div>
                  </div> 
                  <div class="col-lg-6 col-md-6 col-sm-12">
                     <div class="md-form form-md">
                      <label class="control-label">Titulo del expediente</label>
                      <input type="text" name="nuevo_titulo" id="titulo" class="form-control" required>
                    </div>
                  </div> 
                  <div class="col-lg-2 col-md-2 col-sm-12">
                     <div class="md-form form-md">
                      <label class="control-label">Numero de resolucion</label>
                      <input type="text" name="n_reso" id="n_reso" class="form-control" required>
                    </div>
                  </div> 
                  <div class="col-lg-2 col-md-2 col-sm-12">
                     <div class="md-form form-md">
                      <label class="control-label">Fecha de resolucion</label>
                      <input type="date" name="f_reso" id="f_reso" class="form-control" required>
                    </div>
                  </div> 
                </div>
              </div>
              <div class="form-group p-r-10 p-l-10">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="row title-form">
                    Informacion de cotizacion de obra
                  </div>
                </div>
                <input type="text" name="add_redeterminacion" hidden>
                <div class="row p-t-20">
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="md-form form-md">
                      <label class="control-label">Complete el nombre de la obra</label>
                      <input type="search"  class="form-control" aria-controls="1" id="busqueda_redeter">
                    </div>
                  </div> 
                </div>


<div id="seleccion-tipo-cert"></div>



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
  $.post("includes/ajax/tipo_acta.php", {obra_id: id}, function(result){
    $('#busqueda_redeter').hide();
    $('.tt-hint').hide();

    $("#seleccion-tipo-cert").html(result);
  });
}



$(document).ready(function(){
busquedaglobal = new Bloodhound({datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),queryTokenizer: Bloodhound.tokenizers.whitespace,remote: {url:'./includes/ajax/busqueda_global.php?key=%QUERY',wildcard: '%QUERY',filter: function (results) {return $.map(results, function (result) {return {value: result};});}}});

    busquedaglobal.initialize();

    $('#busqueda_redeter').typeahead(null, {
    name: 'value',
    display: 'value',  
    source: busquedaglobal,
    limit:30,
    templates: {
    suggestion:  function(data) {
                    return '<div onclick="obra_cotizacion('+data.value.idobras+')">'+ data.value.nombre +'</div>'
                }
    }

});

});
</script>
