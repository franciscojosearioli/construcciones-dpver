<?php
require_once('../../includes/load.php');
$obra_id=$_GET['id'];
$user = current_user();
$obra = find_by_id('obras','idobras',(int)$_GET['id']);  
if($obra['estado'] == 1){ redirect('proyecto?id='.$obra_id, false); }
require_once('../../includes/functions/obras.php');  
require_once("../../includes/functions/map.php"); 
require_once('../../../uploads/files.php'); 
$ejecutados = all_oyp();
$all_user = all_usuarios();
$mapa_puntos = obra_puntos($obra_id);
$mapa_lineas = obra_lineas($obra_id);
foreach($ejecutados as $obra):
  if($obra['idobras'] == $obra_id){

    ?>
<div class="card p-20">
<div id="vista_mapa_obra">
                                      <?php if(permiso('admin') || permiso('obras')){ ?>
                                  <div class="justify-content-center text-center  p-b-10" style="border-bottom: 1px solid #dee2e6; margin-bottom: 20px;">
                                  <a class="btn btn-warning" id="btnagregar_mapa_agregar" onclick="form_mapa_agregar(true)">Agregar</a> 
                                  <a class="btn btn-warning" id="btnagregar_mapa_eliminar" onclick="form_mapa_eliminar(true)" style="padding-left: 10px;">Eliminar</a>
                                  </div>
                                <?php } ?>



<div class="table-responsive">
          <div id="map_obra" style="width: 100%; height: 400px"></div>
        </div>                                  </div>
        <?php include('../../content/forms/agregar_mapa.php');
include('../../content/forms/eliminar_mapa.php');
?>
<script>
  $(document).ready(function() {
  var map_obra = L.map('map_obra').invalidateSize(true).setView( [-32.287132632616355, -59.23828124999999], 7 );L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiZnJhbmNpc2Nvam9zZWFyaW9saSIsImEiOiJjandhajByNDIwYWx0M3lrZGtkdHR6bGxtIn0.wVbgor3CUTqqfxbuxlzFmA', {attribution: '',fullscreenControl: true,maxZoom: 20,minZoom:6,id: 'mapbox/streets-v11',accessToken: 'pk.eyJ1IjoiZnJhbmNpc2Nvam9zZWFyaW9saSIsImEiOiJjandhajByNDIwYWx0M3lrZGtkdHR6bGxtIn0.wVbgor3CUTqqfxbuxlzFmA'}).addTo(map_obra);map_obra.addControl(new L.Control.Fullscreen());$(document).ready(function() {add_punto();add_linea();});function add_punto() {for(var i=0; i<puntos.length; i++) {var marker = L.marker( [puntos[i]['latitud'], puntos[i]['longitud']]).addTo(map_obra);marker.bindPopup( "<b>" + puntos[i]['titulo']+"</b>");}}function stringToGeoPoints( geo ) {var linesPin = geo.split(",");var linesLat = new Array();var linesLng = new Array();for(i=0; i < linesPin.length; i++) {if(i % 2) {linesLat.push(linesPin[i]);}else{linesLng.push(linesPin[i]);}}var latLngLine = new Array();for(i=0; i<linesLng.length;i++) {latLngLine.push( L.latLng( linesLat[i], linesLng[i]));}return latLngLine;}function add_linea() {for(var i=0; i < lineas.length; i++) {var polyline = L.polyline( stringToGeoPoints(lineas[i]['georeferencia']), { color: lineas[i]['color']}).addTo(map_obra);polyline.bindPopup( "<b>" + lineas[i]['titulo']);   }}var puntos = <?php echo json_encode($mapa_puntos) ?>;var lineas = <?php echo json_encode($mapa_lineas) ?>;
});
</script>
<?php } endforeach; ?>
<script type="text/javascript" src="includes/ajax/scripts/mapa.js"></script></div>