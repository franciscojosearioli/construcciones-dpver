<div class="row justify-content-center hide" id="agregar_certificados">
<div class="row justify-content-center">
  <div class="col-8">
    <div class="card">

      <div class="card-body cards-titulo">
        <div class="d-flex flex-wrap">
          <div class="my-auto ml-3">
            Redeterminar certificado de obra
          </div>
          <div class="ml-auto my-auto mr-3">
            <a onclick="cancelar_agregar()" title="Cerrar" data-toggle="tooltip"><i class="fas fa-times"></i></a>
          </div>
        </div>
      </div>

      <div class="card-body">
        <div class="row" id="input_buscar">
          <div class="col-12">
            <label>Complete el nombre de la obra que fue certificada</label>
            <div class="form-group">
              <input type="search" style="background: #f0f0f0" class="form-control" aria-controls="1"
                id="busqueda-cert">
            </div>
          </div>
        </div>
      </div>
      
      <div id="listar-certificados"></div>
    </div>
  </div>
</div>
</div>

<div id="crear-certificado"></div>


<script>

function buscar_certificados(id){
  var id = id;
  $.post("includes/ajax/listar_certificados_obra.php", {obra_id: id}, function(result){
    $('#input_buscar').hide();
    $("#listar-certificados").html(result);
  });
}
$(document).ready(function(){
busquedaglobal = new Bloodhound({datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),queryTokenizer: Bloodhound.tokenizers.whitespace,remote: {url:'./includes/ajax/busqueda_global.php?key=%QUERY',wildcard: '%QUERY',filter: function (results) {return $.map(results, function (result) {return {value: result};});}}});

    busquedaglobal.initialize();

    $('#busqueda-cert').typeahead(null, {
    name: 'value',
    display: 'value',  
    source: busquedaglobal,
    limit:30,
    templates: {
    suggestion:  function(data) {
                    return '<div onclick="buscar_certificados('+data.value.idobras+')">'+ data.value.nombre +'</div>';
                }
    }

});

});
</script>
