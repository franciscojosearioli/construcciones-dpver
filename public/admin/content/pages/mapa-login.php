<?php
require_once('../../includes/load.php');
cabecera_funciones('Mapa'); 
$mapa_puntos = all_puntos();
$mapa_lineas = all_lineas();
$oyps = all_oyp();
$user = current_user();

?>


<div class="row justify-content-center">
<div id="mapa" style="width: 500px; height: 500px"></div>
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

var contenido = "<b>" + lineas[i]['titulo'] + "</b><hr>Descripcion: "+lineas[i]['descripcion']+"<br><div id='respuesta'></div><hr><div class='row'><div class='col-6'><button id='vermas' class='btn btn-info' onclick='vermas("+idobras+")'>Ver mas</button></div><div class='col-6'></div></div>";

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
<?php pie_funciones(); ?>