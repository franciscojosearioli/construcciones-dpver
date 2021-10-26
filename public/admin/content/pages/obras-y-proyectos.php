<?php
require_once('../../includes/load.php');
cabecera('Obras y Proyectos'); 
$mapa_puntos = all_puntos();
$mapa_lineas = all_lineas();
$oyps = all_oyp();
$user = current_user();

$conteo_proyectos = conteo_proyectos_construcciones('obras','idobras');

$conteo_proyectos_iluminacion = conteo_proyectos_iluminacion('obras','idobras');
$conteo_proyectos_senialamiento = conteo_proyectos_senialamiento('obras','idobras');
$conteo_bacheos = conteo_bacheos('obras_bacheos','idbacheos');

$conteo_obras = conteo_obras_construcciones('obras','idobras');
$conteo_obras_ejecutadas = conteo_obras_ejecutadas('obras','idobras');

$conteo_obras_finalizadas = conteo_obras_finalizadas('obras','idobras');
$conteo_obras_neutralizadas = conteo_obras_neutralizadas('obras','idobras');
$conteo_obras_rescindidas = conteo_obras_rescindidas('obras','idobras');

$conteo_obras_modificaciones = conteo_modificaciones('idmodificaciones');
$conteo_obras_ampliaciones = conteo_ampliaciones('idampliaciones');
$conteo_obras_neutralizaciones = conteo_neutralizaciones('idneutralizaciones');


?>         
<div class="row justify-content-center">
         <div class="col-10">
              <div class="d-flex flex-wrap p-b-30">
              <div class="my-auto ml-3">
              
                  <h1 class="titulo-bienvenida">Obras y Proyectos</h1>
              </div>
              <div class="ml-auto my-auto mr-3">
              </div>
              </div>
              </div>
         </div>
<div class="row justify-content-center">
  <div class="col-10">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-12">
            <div class="table-responsive" style="font-size: 11px;">
              <table id="all" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0"
                width="100%">
                <thead>
                  <tr>
                    <th></th>
                    <th class="text-center"> </th>
                    <th> Titulo </th>
                    <th class="text-center"> Expediente </th>
                    <th class="text-center"> Estado </th>
                    <th class="text-center"> Avance de obra </th>
                    <th class="text-center"> Ultimo certificado </th>
                    <th class="text-center"> Firma contrato </th>
                    <th class="text-center"> Acta de inicio </th>
                    <th class="text-center"> Monto vigente </th>
                    <th class="text-center"> Plazo vigente </th>
                    <th class="text-center"> Monto redeterminado </th>
                    <th class="text-center"> Redeterminacion </th>
                    <th> Descripcion </th>
                    <th> Ubicacion </th>
                    <th class="text-center"> Contratista </th>
                    <?php if(permiso('admin') || permiso('obras')){ ?>
                    <th class="text-center"> Observaciones </th>
                    <?php } ?>
                  </tr>
                </thead>
                <tbody>
  <?php 
  foreach ($oyps as $obra):
  $ver_id=(int)$obra['idobras']; 
  ?>
                  <tr>
                    <td class="w-5"></td>
                    <td>
                      <a class="i-dt-list" href="obra?id=<?php echo (int)$obra['idobras'];?>" data-toggle="tooltip"
                        title="Ver informe"><i class="fa fa-info"></i></a>

                        <a class="i-dt-list"
                        href="content/prints/informe-tecnico-obra.php?id=<?php echo $obra['idobras'] ?>" target="_blank"
                        data-toggle="tooltip" title="Imprimir"><i class="fas fa-print"></i></a>
                        <a class="i-dt-list"
                        href="content/prints/informe-tecnico-obra-doc.php?id=<?php echo $obra['idobras'] ?>" target="_blank"
                        data-toggle="tooltip" title="Descargar"><i class="fas fa-file-download"></i></a>
                    </td>
                    

                    <td>
                      <?php echo wordwrap($obra['nombre'], 40, "<br>" ,false); ?>
                    </td>
                    <td class="text-center">
                      <?php echo ifexist($obra['expediente']); ?>
                    </td>

                    <td class="text-center">
                      <?php 
           if($obra['estado'] == 6){ echo 'A Iniciar'; }
           if($obra['estado'] == 0){ echo 'En ejecucion'; }
           if($obra['estado'] == 3 && $obra['recepcion'] == 0){ echo 'Finalizada sin recibir'; }
           if($obra['estado'] == 3 && $obra['recepcion'] == 1){ echo 'En garantia'; }
           if($obra['estado'] == 3 && $obra['recepcion'] == 2){ echo 'Finalizada definitiva'; }
           if($obra['estado'] == 4){ echo 'Neutralizada'; }
           if($obra['estado'] == 5){ echo 'Rescindida'; } ?>
                    </td>
                    <td class="text-center">
                      <?php if(ifexist($obra['certificado_numero'])){ echo $obra['certificado_porcentaje'].' %'; } ?>
                    </td>
                    <td class="text-center">
                      <?php if(ifexist($obra['certificado_numero'])){ echo 'Nº '.$obra['certificado_numero'].' a '.$obra['certificado_fecha'];}?>
                    </td>
                    <td class="text-center">
                      <?php echo ifdate($obra['contrato_fecha']); ?>
                    </td>
                    <td class="text-center">
                      <?php echo ifdate($obra['acta_inicio']); ?>
                    </td>
                    <td class="text-center">
                      <?php 
           if(ifexist($obra['monto_vigente'])){ echo $obra['monto_vigente'];
         }elseif(ifexist($obra['contrato_monto'])){
           echo $obra['contrato_monto'];} 
           ?>
                    </td>
                    <td class="text-center">
                      <?php echo ifexist($obra['plazo_vigente']); ?>
                    </td>
                    <td class="text-center">
                      <?php if(ifexist($obra['monto_redeterminado'])){ echo '$ '.numero($obra['monto_redeterminado']); } ?>
                    </td>
                    <td class="text-center">
                      <?php echo ifexist($obra['info_redeterminacion']); ?>
                    </td>
                    <!--<td><?php if($modificaciones_de_obra > 0 ){
             foreach($modificaciones_de_obra as $mo):
               echo $mo['numero'].' ';
             endforeach; }else{ echo 'Sin tramitar';} ?></td>
           <td><?php if($ampliacioness_de_obra > 0 ){
             foreach($ampliaciones_de_obra as $ao):
               echo $ao['numero'].' ';
             endforeach; }else{ echo 'Sin tramitar';} ?></td>
           <td><?php if($neutralizaciones_de_obra > 0 ){
             foreach($neutralizaciones_de_obra as $no):
               echo $no['numero'].' ';
             endforeach; }else{ echo 'Sin tramitar';} ?></td>-->
                    <td>
                      <?php echo substr(ifexist($obra['descripcion']), 0, 25).'...'; ?>
                    </td>
                    <td>
                      <?php echo substr(ifexist($obra['ubicacion']), 0, 25).'...'; ?>
                    </td>
                    <td>
                      <?php echo substr(ifexist($obra['contratista']), 0, 25).'...'; ?>
                    </td>

                    <?php if(permiso('admin') || permiso('obras')){ ?>
                    <td>
                      <?php echo substr(ifexist($obra['observaciones']), 0, 50).'...'; ?>
                    </td>
                    <?php } ?>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th></th>
                    <th class="text-center"> </th>
                    <th> Titulo </th>
                    <th class="text-center"> Expediente </th>
                    <th class="text-center"> Estado </th>
                    <th class="text-center"> Avance de obra </th>
                    <th class="text-center"> Ultimo certificado </th>
                    <th class="text-center"> Firma contrato </th>
                    <th class="text-center"> Acta de inicio </th>
                    <th class="text-center"> Monto vigente </th>
                    <th class="text-center"> Plazo vigente </th>
                    <th class="text-center"> Monto redeterminado </th>
                    <th class="text-center"> Redeterminacion </th>
                    <!--<th class="text-center"> Modificaciones </th>
         <th class="text-center"> Ampliaciones </th>
         <th class="text-center"> Neutralizaciones </th>-->
                    <th> Descripcion </th>
                    <th> Ubicacion </th>
                    <th class="text-center"> Contratista </th>
                    <?php if(permiso('admin') || permiso('obras')){ ?>
                    <th class="text-center"> Observaciones </th>
                    <?php } ?>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div><!--
<div class="row justify-content-center">
  <div class="col-10">
<div class="row">
<div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">Estado de obras</h3>
                                <h6 class="card-subtitle">Contratadas</h6>
                                <canvas id="obrasporcontrato" width="100%" height="60%"></canvas>
                            </div>
                                <div>
                                <hr class="m-t-0 m-b-0">
                            </div>
                                <div class="card-body text-center">
                                    <ul class="list-inline">
                                        <li>
                                          <h6 class="text-muted text-info"><span style="color:#19b5fe;">Ejecucion</span></h6>
                                             </li>|
                                        <li>
                                          <h6 class="text-muted text-success"><span style="color:#ec644b;">Finalizadas</span></h6>
                                             </li>|
                                             <li>
                                          <h6 class="text-muted text-success"><span style="color:#FFCE56;">Neutralizadas</span></h6>
                                             </li>|
                                             <li>
                                          <h6 class="text-muted text-success"><span style="color:#bdc3c7;">Rescindidas</span></h6>
                                             </li>
                                    </ul>
                                </div>
                        </div>
                        </div>
                        
<div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">Obras por Contrato</h3>
                                <h6 class="card-subtitle">Departamento técnico</h6>
                                <canvas id="proyectos" width="100%" height="60%"></canvas>
                              </div>
                                <div>
                                <hr class="m-t-0 m-b-0">
                            </div>
                                <div class="card-body text-center">
                                    <ul class="list-inline">
                                        <li>
                                          <h6 class="text-muted text-info"><a href="proyectos" style="text-decoration: none; color:#19b5fe;">Proyectos</a></h6>
                                             </li>|
                                        <li>
                                          <h6 class="text-muted text-success"><a href="modificaciones" style="text-decoration: none; color:#3fc380;">Modificaciones</a></h6>
                                             </li>|
                                             <li>
                                          <h6 class="text-muted text-success"><a href="ampliaciones" style="text-decoration: none; color:#FFCE56;">Ampliaciones</a></h6>
                                             </li>|
                                             <li>
                                          <h6 class="text-muted text-success"><a href="neutralizaciones" style="text-decoration: none; color:#bdc3c7;">Neutralizaciones</a></h6>
                                             </li>
                                    </ul>
                                </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
                    -->




         <div class="row justify-content-center">


         <div class="col-lg-3 col-md-3 col-sm-12">
          <div class="card">
            <div class="card-body">
                <div class="card-body cards-titulo">
              <div class="d-flex flex-wrap">
              <div class="my-auto ml-3">
                <h2><b>Referencias</b></h2>
              </div>
            </div>
            </div>
            <div class="card-body">
            <p style="font-size:14px;color:#d5ce00;">♦ Proyectos de obras</p>
                           <p style="font-size:14px;color:#0cce1a;">♦ Obras en ejecucion</p>
                           <p style="font-size:14px;color:#ce0c0c;">♦ Obras finalizadas</p>
                           <p style="font-size:14px;color:#8d8d8d;">♦ Obras neutralizadas</p>
                           <p style="font-size:14px;color:#8d8d8d;">♦ Obras canceladas</p>        
                           <p style="font-size:14px;"><img src="includes/assets/plugins/leaflet/css/images/construcciones.png" width="20px"><span style="padding-left:15px;color:#8d8d8d">Obras varias</span></p>
                           <!--<p style="font-size:14px;"><img src="includes/assets/plugins/leaflet/css/images/iluminacion.png" width="20px"><span style="padding-left:15px;">Iluminacion</span></p>
                           <p style="font-size:14px;"><img src="includes/assets/plugins/leaflet/css/images/senialamiento.png" width="20px"><span style="padding-left:15px;">Señalamiento</span></p>-->
                    </div>
                    </div>
                    </div>
                    </div>





         <div class="col-lg-7 col-md-7 col-sm-12">
          <div class="card">
            <div class="card-body">
                <div class="card-body cards-titulo">
              <div class="d-flex flex-wrap">
              <div class="my-auto ml-3">
                <h1><b>Mapa de obras y proyectos</b></h1>
              </div>
            </div>
            </div>
            <div class="card-body">
     		<div id="mapa" style="border-radius:20px;width: 100%; height: 450px"></div>
            </div>
</div>
</div>
</div>

</div>
                        
<script>
var map_obra = L.map('mapa').invalidateSize(true).setView( [-32.287132632616355, -59.23828124999999], 7 );
L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiZnJhbmNpc2Nvam9zZWFyaW9saSIsImEiOiJjandhajByNDIwYWx0M3lrZGtkdHR6bGxtIn0.wVbgor3CUTqqfxbuxlzFmA', {attribution: '',fullscreenControl: true,maxZoom: 20,minZoom:6,id: 'mapbox/streets-v11',accessToken: 'pk.eyJ1IjoiZnJhbmNpc2Nvam9zZWFyaW9saSIsImEiOiJjandhajByNDIwYWx0M3lrZGtkdHR6bGxtIn0.wVbgor3CUTqqfxbuxlzFmA'}).addTo(map_obra);
map_obra.addControl(new L.Control.Fullscreen());

var puntos = <?php echo json_encode($mapa_puntos) ?>;
var lineas = <?php echo json_encode($mapa_lineas) ?>;

$(document).ready(function() {
    add_punto();
    add_linea();
});

function add_punto() {

var construcciones = L.icon({
    iconUrl: 'includes/assets/plugins/leaflet/css/images/construcciones.png',
    iconSize: [10, 15]
});
var senialamiento = L.icon({
    iconUrl: 'includes/assets/plugins/leaflet/css/images/construcciones.png',
    iconSize: [10, 15]
});
var iluminacion = L.icon({
    iconUrl: 'includes/assets/plugins/leaflet/css/images/construcciones.png',
    iconSize: [10, 15]

});

    for(var i=0; i<puntos.length; i++) {

if(puntos[i]['tipo'] == 0){
var marker = L.marker( [puntos[i]['latitud'], puntos[i]['longitud']], {icon: construcciones});
}
if(puntos[i]['tipo'] == 1){
var marker = L.marker( [puntos[i]['latitud'], puntos[i]['longitud']], {icon: iluminacion});
}
if(puntos[i]['tipo'] == 2){
var marker = L.marker( [puntos[i]['latitud'], puntos[i]['longitud']], {icon: senialamiento});
}

var idobras = puntos[i]['idobras'];

var contenido = "<b>" + puntos[i]['titulo'] + "</b><hr>Descripcion: "+puntos[i]['descripcion']+"<br><div id='respuesta'></div><hr><div class='row'><div class='col-6'><button id='vermas' class='btn btn-info' onclick='vermas("+idobras+")'>Ver mas</button></div><div class='col-6'><span class='pull-right'><a class='btn btn-info text-white' href='obra?id="+idobras+"'>Ver obra</a></span></div></div>";

var opciones = {
  minWidth: '300',
  maxWidth: '300',
  className: 'custom',
  closeButton: true,
  autoClose: false
}
        marker.bindPopup(contenido, opciones);
        marker.addTo(map_obra);

}}

function stringToGeoPoints( geo ) {
    var linesPin = geo.split(",");
    var linesLat = new Array();
    var linesLng = new Array();
    for(i=0; i < linesPin.length; i++) {
        if(i % 2) {
            linesLat.push(linesPin[i]);
        }else{
            linesLng.push(linesPin[i]);
        }
    }
    var latLngLine = new Array();
    for(i=0; i<linesLng.length;i++) {
        latLngLine.push( L.latLng( linesLat[i], linesLng[i]));
    }
    return latLngLine;
}

function add_linea() {
    for(var i=0; i < lineas.length; i++) {

var idobras = lineas[i]['idobras'];

if(lineas[i]['estado'] == 0 ){
var polyline = L.polyline( stringToGeoPoints(lineas[i]['georeferencia']), { weight: 3, color: 'lightgreen'});
}
if(lineas[i]['estado'] == 1 ){
var polyline = L.polyline( stringToGeoPoints(lineas[i]['georeferencia']), { weight: 3, color: 'yellow'});
}
if(lineas[i]['estado'] == 2 ){
var polyline = L.polyline( stringToGeoPoints(lineas[i]['georeferencia']), { weight: 3, color: 'red'});
}
if(lineas[i]['estado'] == 3 ){
var polyline = L.polyline( stringToGeoPoints(lineas[i]['georeferencia']), { weight: 3, color: 'red'});
}
if(lineas[i]['estado'] == 4 ){
var polyline = L.polyline( stringToGeoPoints(lineas[i]['georeferencia']), { weight: 3, color: '#fff'});
}
if(lineas[i]['estado'] == 5 ){
var polyline = L.polyline( stringToGeoPoints(lineas[i]['georeferencia']), { weight: 3, color: '#000'});
}

var contenido = "<b>" + lineas[i]['titulo'] + "</b><hr>Descripcion: "+lineas[i]['descripcion']+"<br><div id='respuesta'></div><hr><div class='row'><div class='col-6'><button id='vermas' class='btn btn-info' onclick='vermas("+idobras+")'>Ver mas</button></div><div class='col-6'><span class='pull-right'><a class='btn btn-info text-white' href='obra?id="+idobras+"'>Ver obra</a></span></div></div>";

var opciones = {
  minWidth: '300',
  maxWidth: '300',
  className: 'custom',
  closeButton: true,
  autoClose: false
}

    polyline.bindPopup(contenido, opciones);
    polyline.addTo(map_obra);

}}

function vermas(id){
   $.ajax({
        url: "content/popup/mapa_linea.php",
        type: "POST",
        data: {id : id }
    }).done(function(data){
           $("#respuesta").html(data);
           $("#vermas").hide();
    }); 
}
$(window).on("load", function(){
    $('#vermas').click();
});
$('.leaflet-bottom').hide();
</script>           
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script>
var config2 = {
  type: 'horizontalBar',
  data: {
    labels: [' En ejecucion', ' Finalizadas', ' Neutralizadas', ' Rescindidas'],
    datasets: [{
      label: "Obras",
      data: [<?php  echo $conteo_obras_ejecutadas['total']; ?>,<?php echo $conteo_obras_finalizadas['total']; ?>,<?php  echo $conteo_obras_neutralizadas['total']; ?>,<?php  echo $conteo_obras_rescindidas['total']; ?>], 
      fill: false,
        backgroundColor: [
                  "#3fc380",
                  "#ec644b",
                  "#FFCE56",
                  "#bdc3c7",
             ]
    }]
  },
  options: {
    legend: {
      display: false
    },
            scales: {
        yAxes: [{
            ticks: {
                beginAtZero: true
            }
        }]
    }
  }
};
var config3 = {
  type: 'horizontalBar',
  data: {
    labels: [' Proyectos', ' Modificaciones', ' Ampliaciones', ' Neutralizaciones'],
    datasets: [{
      label: "Cantidad",
      data: [<?php  echo $conteo_proyectos['total']; ?>,<?php echo $conteo_obras_modificaciones['total']; ?>,<?php echo $conteo_obras_ampliaciones['total']; ?>,<?php echo $conteo_obras_neutralizaciones['total']; ?>], 
      fill: false,
        backgroundColor: [
                  "#19b5fe",
                  "#3fc380",
                  "#FFCE56",
                  "#bdc3c7",
             ]
    }]
  },
  options: {
    legend: {
      display: false
    },
        scales: {
        yAxes: [{
            ticks: {
                beginAtZero: true
            }
        }]
    }
  }
};

var obrasporcontrato = document.getElementById("obrasporcontrato").getContext("2d");
var proyectos = document.getElementById("proyectos").getContext("2d");
new Chart(obrasporcontrato, config2);
new Chart(proyectos, config3);
</script>
</div>
</div>
<script type="text/javascript">
        $( "#select_direccion" ).change(function() {
      var valor = $(this).val();
        $.post("includes/ajax/direccion-departamentos.php",  { valor: valor }).done(function(data) {
                    $('#departamentos').html(data);
});
});
</script>
<?php pie(); ?>