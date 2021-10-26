<?php
require_once('../../includes/load.php');
cabecera('Cotizaciones de obras');
require_once('../../includes/functions/cotizaciones.php');  
$user = current_user();
$ultimas_cotizaciones = ultimos_valores_tabla('cotizaciones','','registro_fecha','10');
?>
<div id="buscar-obras">
<div id="buscar_planes">




<!--<div class="row justify-content-center">
  <div class="col-lg-6 col-md-6 col-sm-12 p-20">
    <div class="card">
    
      <div class="card-body cards-titulo">
        <div class="d-flex flex-wrap">
          <div class="my-auto ml-3">
            Consultar Cotizacion de obra
          </div>
        </div>
      </div>
      
      <div class="card-body">
<form method="post">
<div class="row">
<div class="col-12"><label>Para consultar una Cotizacion de obra debe ingresar titulo de la obra, numero del expediente, contratista adjudicado o ubicacion y luego seleccione la opcion</label>
<div class="form-group">

<input type="search" style="background: #f0f0f0" class="form-control" aria-controls="1" id="busqueda-obra">

</div>
</div>
</div>
</form>
</div>

</div>
</div>
</div>-->
<?php if(!empty($ultimas_cotizaciones)){ ?> 
<div class="row justify-content-center">
<div class="col-10">
<h3 class="titulo-bienvenida">Ultimas cotizaciones</h3><br>
</div></div>
<div class="row justify-content-center">
<div class="col-10">
<div class="owl-carousel ultimas-cotizaciones">
<!-- inic ITEM -->
<?php 
foreach($ultimas_cotizaciones as $row):  ?>
<div class="card"  style="border: 1px solid #00000040;height:100%;"> 
<div class="card-body mx-2">
<p>   <?php if(!empty($row['numero'])){
        echo 'Cotizacion '.$row['numero'];
        }else{ echo 'Sin completar';}  ?></p>
        <label class="control-label text-muted" style="font-size:11px;">Detalle</label>
        <p><?php  echo $row['detalle']; ?></p>
</div>
<div class="card-footer">
<a onclick="ver_cotizacion(<?php echo $row['idcotizaciones']; ?>)"><i class="fa fa-list-alt"></i> Ver planilla</a>
</div>
</div>
<?php endforeach; ?>
<!-- fin item -->
</div>
</div>
</div>
<?php } ?>

<div class="row justify-content-center">
<div class="col-10">
<div class="d-flex flex-wrap p-b-30">
<div class="my-auto ml-3">
<h3 class="titulo-bienvenida">Cotizaciones de obras</h3>
</div>
<div class="ml-auto my-auto mr-3">
<?php if(permiso('admin') || permiso('obras')){ ?>
  <a href="certificados-unidades" target="_blank" title="Agregar nuevo" data-toggle="tooltip" class="btn btn-warning btn-rounded btn-light text-dark">Unidades de items</a>
  <a id="btn_agregar" onclick="form_agregar(true)" title="Agregar nuevo" data-toggle="tooltip" class="btn btn-warning btn-rounded btn-light">Cargar nuevo</a>
                  <?php } ?>
</div>
</div>
</div>
</div>
         <div class="row justify-content-center">
         <div class="col-10">
          <div class="card">
            <div class="card-body">
              <div class="table-responsive">
              <table id="tabla_cotizaciones" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th> </th>
                    <th class="text-center">  </th>
                    <th class="text-center"> Numero </th>
                    <th class="text-center"> Detalle </th>   
                    <th class="text-center"> Obra </th>    
                  </tr>
                </thead>

                <tfoot>
                  <tr>
                    <th> </th>
                    <th class="text-center">  </th>
                    <th class="text-center"> Numero </th>
                    <th class="text-center"> Detalle </th>   
                    <th class="text-center"> Obra </th>                  
                  </tr>
                </tfoot>
            </table>
          </div>
    </div>    
  </div>
</div>
</div>
</div>
</div>

<div id="cotizaciones-obras"></div>
<div id="cotizaciones-obras-ver"></div>
<script>

function resultadoobra(id){
  var id = id;
  $('#buscar-obras').hide();
  $.post("content/forms/cotizacion-de-obra.php", {obra_id: id}, function(result){
    $("#cotizaciones-obras").html(result);
  });
}
$(document).ready(function(){
busquedaglobal = new Bloodhound({datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),queryTokenizer: Bloodhound.tokenizers.whitespace,remote: {url:'./includes/ajax/busqueda_obra.php?key=%QUERY',wildcard: '%QUERY',filter: function (results) {return $.map(results, function (result) {return {value: result};});}}});

    busquedaglobal.initialize();

    $('#busqueda-obra').typeahead(null, {
    name: 'value',
    display: 'value',  
    source: busquedaglobal,
    limit:30,
    templates: {
    suggestion:  function(data) {
    
    if(data.value.estado == 0){
                    return '<a style="text-decoration:none;font-size:11px;line-height: 1.5" onclick="resultadoobra('+data.value.idobras+')"><div>OBRA: '+ data.value.nombre.substring(0, 40) +'...<br>ESTADO: En ejecucion<br>EXPEDIENTE: '+data.value.expediente+'<br>CAJA: '+data.value.numero+'</div></a>'
    }if(data.value.estado == 4){
                    return '<a style="text-decoration:none;font-size:11px;line-height: 1.5" onclick="resultadoobra('+data.value.idobras+')"><div>OBRA: '+ data.value.nombre.substring(0, 40) +'...<br>ESTADO: Neutralizada<br>EXPEDIENTE: '+data.value.expediente+'<br>CAJA: '+data.value.numero+'</div></a>'
    }if(data.value.estado == 5){
                    return '<a style="text-decoration:none;font-size:11px;line-height: 1.5" onclick="resultadoobra('+data.value.idobras+')"><div>OBRA: '+ data.value.nombre.substring(0, 40) +'...<br>ESTADO: Rescindida<br>EXPEDIENTE: '+data.value.expediente+'<br>CAJA: '+data.value.numero+'</div></a>'
    }
    if(data.value.estado == 3){
     if(data.value.finalizado == 0){
                     return '<a style="text-decoration:none;font-size:11px;line-height: 1.5" onclick="resultadoobra('+data.value.idobras+')"><div>OBRA: '+ data.value.nombre.substring(0, 40) +'...<br>ESTADO: Finalizada sin recibir<br>EXPEDIENTE: '+data.value.expediente+'<br>CAJA: '+data.value.numero+'</div></a>'
     }if(data.value.finalizado == 1){
                     return '<a style="text-decoration:none;font-size:11px;line-height: 1.5" onclick="resultadoobra('+data.value.idobras+')"><div>OBRA: '+ data.value.nombre.substring(0, 40) +'...<br>ESTADO: Finalizada en garantia<br>EXPEDIENTE: '+data.value.expediente+'<br>CAJA: '+data.value.numero+'</div></a>'
     }if(data.value.finalizado == 2){
                     return '<a style="text-decoration:none;font-size:11px;line-height: 1.5" onclick="resultadoobra('+data.value.idobras+')"><div>OBRA: '+ data.value.nombre.substring(0, 40) +'...<br>ESTADO: Finalizada definitiva<br>EXPEDIENTE: '+data.value.expediente+'<br>CAJA: '+data.value.numero+'</div></a>'
     }
    }
    }
    }
});
});
</script>

<script type="text/javascript" src="includes/ajax/scripts/cotizaciones.js"></script>
<?php 
    require_once('../forms/agregar_cotizacion.php');
    
pie(); ?>
