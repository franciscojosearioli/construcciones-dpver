<?php 
 $arrdeletemark = $conn->getCompaniesList($obra_id);
  $arrdeletestreet = $conn->getStreetsList($obra_id);
?>
<div class="modal fade" id="delete_mapa" tabindex="-1" role="dialog" aria-labelledby="delete_mapa_title" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100" id="delete_mapa_title">Eliminar en mapa</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <br />
        <ul class="nav md-pills nav-justified" id="mapatabdelete" role="tablist">
    <li class="nav-item">
      <a class="nav-link  waves-light active show" id="tab-rutasdelete" data-toggle="tab" href="#rutasdelete"
        role="tab" aria-controls="rutasdelete" aria-selected="true">Tramo</a>
    </li>
    <li class="nav-item">
      <a class="nav-link waves-light" id="tab-markerdelete" data-toggle="tab" href="#markerdelete" role="tab"
        aria-controls="markerdelete" aria-selected="false">Marcador</a>
    </li>
    </li>
  </ul>
  <div class="tab-content border-right border-bottom border-left rounded-bottom" id="mapatabContentdelete">
    <div class="tab-pane fade active show" id="rutasdelete" role="tabpanel" aria-labelledby="tab-rutasdelete">      
      <div class="modal-body">
          <div class="card-body">
              <center>   
                <h3>Tramo de obra</h3>
                <p>Seleccione el nombre del tramo para eliminar..</p>
              </center>
              <div class="form-group">
                <div class="row">
<div class="col-md-12">
  <form action="obra.php?id=<?php echo (int)$obra['id']; ?>" method="post">
<select name="tramo" class="browser-default custom-select"><option value="0" disabled selected>Seleccione un tramo</option><?php for($i=0;$i<count($arrdeletestreet);$i++) { print '<option value="'.$arrdeletestreet[$i]['id'].'">'.$arrdeletestreet[$i]['name'].'</option>'; } ?></select>
<center><br /><input type="submit" class="btn btn-danger btn-md" name="delete_ruta" value="Eliminar"></center>
        </form>
        </div>
            </div>
          </div>     
    </div></div></div>
        <div class="tab-pane fade" id="markerdelete" role="tabpanel" aria-labelledby="tab-markerdelete">
      <div class="modal-body">
          <div class="card-body">
              <center>
                <h3>Marcador de obra</h3>
                <p>Seleccione el nombre del marcador para eliminar.</p>
              </center>
                <form action="obra.php?id=<?php echo (int)$obra['id']; ?>" method="post">
<div class="row">
<div class="col-md-12">   
    <select name="marcador" class="browser-default custom-select"><option value="0" disabled selected>Seleccione un marcador</option><?php for( $i=0; $i < count($arrdeletemark); $i++) { print '<option value="'.$arrdeletemark[$i]['id'].'">'.$arrdeletemark[$i]['company'].'</option>'; } ?></select>
    <center><br /><input type="submit" class="btn btn-danger btn-md" name="delete_mark" value="Eliminar"></center>
</div></div>
        </form>
         </div>
        </div>
    </div>
  </div>
</div></div></div></div>


<?php $obra = find_by_id('obras','idobras',(int)$_GET['id']); 
?>
<div class="modal fade" id="add_mapa" tabindex="-1" role="dialog" aria-labelledby="add_mapa" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100" id="add_mapa">Agregar al mapa</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <br />
        <ul class="nav md-pills nav-justified" id="mapatab" role="tablist">
    <li class="nav-item">
      <a class="nav-link  waves-light active show" id="tab-rutas" data-toggle="tab" href="#rutas"
        role="tab" aria-controls="rutas" aria-selected="true">Tramo</a>
    </li>
    <li class="nav-item">
      <a class="nav-link waves-light" id="tab-marker" data-toggle="tab" href="#marker" role="tab"
        aria-controls="marker" aria-selected="false">Marcador</a>
    </li>
    </li>
  </ul>
  <div class="tab-content border-right border-bottom border-left rounded-bottom" id="mapatabContent">
    <div class="tab-pane fade active show" id="rutas" role="tabpanel" aria-labelledby="tab-rutas">      
      <div class="modal-body">
        <div class="row">
          <div class="card-body">
            <form method="post" action="obra.php?id=<?php echo (int)$obra['id']; ?>">
              <center>   <h3>Tramo de obra</h3>
  <p>Para dibujar una linea, debe crear marcadores haciendo click en el mapa, para visualizar la linea debe "actualizar linea", para borrar un solo marcador debe volver a hacer click en el.</p>
              </center>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-7">
  <div id="add_ruta" style="width: 100%; height: 400px"></div><br />
</div>
<div class="col-md-5">
  <form action="obra.php?id=<?php echo (int)$obra['id']; ?>" method="post">
Titulo del tramo
<input type="text" name="street" class="form-control form-control-lg"/>
<br>
<input type="button" class="btn btn-danger btn-sm" onclick="getGeoPoints();" value="Cargar coordenadas" />
       <input type="text" id="geo" name="geo" class="form-control form-control-lg" />
        <p>Debe cargar las coordenadas de los marcadores.</p>
                      <br>

  <input type="button" class="btn btn-danger btn-sm" onclick="drawStreet();" value="Actualizar linea" /> <input type="button" class="btn btn-warning btn-sm" onclick="resetStreet();" value="Borrar todo" />
  <hr>

       <input type="submit" class="btn btn-primary btn-sm" name="add_ruta" value="Guardar ruta">
                </div>
            </div>
          </div>     
        </form>
    </div></div></div></div>
        <div class="tab-pane fade" id="marker" role="tabpanel" aria-labelledby="tab-marker">
      <div class="modal-body">
        <div class="row">
          <div class="card-body">

              <center>   <h3>Marcador de obra</h3>
  <p>Arrastre y ubique el marcador en las coordenadas deseadas.</p>
              </center>
<div class="row">
                  <div class="col-md-7">                        
  <div id="add_marcador" style="width: 100%; height: 400px"></div>
</div>
<div class="col-md-5">   
  <form action="obra.php?id=<?php echo (int)$obra['id']; ?>" method="post">
   <table cellpadding="5" cellspacing="0" border="0">
    <tbody>
     <tr align="left" valign="top">
      <td align="left" valign="top">Titulo</td>
      <td align="left" valign="top"><input type="text" name="company" class="form-control form-control-lg" /></td>
     </tr>
     <tr align="left" valign="top">
      <td align="left" valign="top">Latitud</td>
      <td align="left" valign="top"><input id="lat" type="text" name="latitude" class="form-control form-control-lg" /></td>
     </tr>
     <tr align="left" valign="top">
      <td align="left" valign="top">Longitud</td>
      <td align="left" valign="top"><input id="lng" type="text" name="longitude" class="form-control form-control-lg" /></td>
     </tr>
    <tr align="left" valign="top">
     <td align="left" valign="top"></td>
     <td align="left" valign="top"><input type="submit" class="btn btn-primary btn-sm" name="add_mark" value="Guardar"></td>
    </tr>
   </tbody>
  </table>
</div></div>
         </div></div>
        </form>

        </div>
    </div>
  </div>
</div>

  <script>$('#add_ruta').css('cursor', 'pointer');var add_ruta = L.map( 'add_ruta' ).setView( [-32.287132632616355, -59.23828124999999], 7 );var polyLine;var draggableStreetMarkers = new Array();L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoiZnJhbmNpc2Nvam9zZWFyaW9saSIsImEiOiJjandhajByNDIwYWx0M3lrZGtkdHR6bGxtIn0.wVbgor3CUTqqfxbuxlzFmA', {attribution: '',fullscreenControl: true,maxZoom: 20,id: 'mapbox.streets-satellite',accessToken: 'pk.eyJ1IjoiZnJhbmNpc2Nvam9zZWFyaW9saSIsImEiOiJjandhajByNDIwYWx0M3lrZGtkdHR6bGxtIn0.wVbgor3CUTqqfxbuxlzFmA'}).addTo(add_ruta);add_ruta.addControl(new L.Control.Fullscreen());function resetStreet() {if(polyLine != null) {add_ruta.removeLayer( polyLine );}for(i=0; i< draggableStreetMarkers.length; i++) {add_ruta.removeLayer( draggableStreetMarkers[i] );}draggableStreetMarkers = new Array();}function addMarkerStreetPoint( latLng ) {var streetMarker = L.marker( [latLng.lat, latLng.lng], { draggable: true, zIndexOffset: 900}).addTo(add_ruta);streetMarker.arrayId = draggableStreetMarkers.length;draggableStreetMarkers.push( streetMarker );}function drawStreet() {if(polyLine != null) {add_ruta.removeLayer( polyLine );}var latLngStreets = new Array();for(i=0; i < draggableStreetMarkers.length; i++) {if(draggableStreetMarkers[i]!="") {latLngStreets.push( L.latLng( draggableStreetMarkers[ i ].getLatLng().lat, draggableStreetMarkers[ i ].getLatLng().lng));}}if(latLngStreets.length > 1) {polyLine = L.polyline( latLngStreets, {color: 'red'} ).addTo(add_ruta);}if(polyLine != null) {add_ruta.fitBounds( polyLine.getBounds() );}}function getGeoPoints() {var points = new Array();for(var i=0; i < draggableStreetMarkers.length; i++) {if(draggableStreetMarkers[i] != "") {points[i] =  draggableStreetMarkers[ i ].getLatLng().lng + "," + draggableStreetMarkers[ i ].getLatLng().lat;}}$('#geo').val(points.join(','));}$(document).ready(function() {add_ruta.on('click', function(e) {addMarkerStreetPoint( e.latlng );});});</script>
   <script>$('#add_marcador').css('cursor', 'pointer');var add_marcador = L.map('add_marcador').setView([-32.287132632616355, -59.23828124999999], 7);L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoiZnJhbmNpc2Nvam9zZWFyaW9saSIsImEiOiJjandhajByNDIwYWx0M3lrZGtkdHR6bGxtIn0.wVbgor3CUTqqfxbuxlzFmA', {attribution: '',fullscreenControl: true,maxZoom: 20,id: 'mapbox.streets-satellite',accessToken: 'pk.eyJ1IjoiZnJhbmNpc2Nvam9zZWFyaW9saSIsImEiOiJjandhajByNDIwYWx0M3lrZGtkdHR6bGxtIn0.wVbgor3CUTqqfxbuxlzFmA'}).addTo(add_marcador);add_marcador.addControl(new L.Control.Fullscreen());function putDraggable() {draggableMarker = L.marker([ add_marcador.getCenter().lat, add_marcador.getCenter().lng], {draggable:true, zIndexOffset:900}).addTo(add_marcador);draggableMarker.on('dragend', function(e) {$("#lat").val(this.getLatLng().lat);$("#lng").val(this.getLatLng().lng);});}$(document).ready(function() {putDraggable();});</script>