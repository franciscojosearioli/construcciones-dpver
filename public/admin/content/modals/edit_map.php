<?php $obra = find_by_id('obras',(int)$_GET['id']); 
?>
<div class="modal fade" id="edit_mapa" tabindex="-1" role="dialog" aria-labelledby="edit_mapa" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title w-100" id="edit_mapa">Agregar al mapa</h4>
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
  <div id="map" style="width: 100%; height: 400px"></div><br />
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
  <div id="map2" style="width: 100%; height: 400px"></div>
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
  <script>
    $('#map').css('cursor', 'pointer');
   var map = L.map( 'map' ).setView( [-32.287132632616355, -59.23828124999999], 7 );
   var polyLine;
   var draggableStreetMarkers = new Array();

L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoiZnJhbmNpc2Nvam9zZWFyaW9saSIsImEiOiJjandhajByNDIwYWx0M3lrZGtkdHR6bGxtIn0.wVbgor3CUTqqfxbuxlzFmA', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 12,
    id: 'mapbox.streets-satellite',
    accessToken: 'pk.eyJ1IjoiZnJhbmNpc2Nvam9zZWFyaW9saSIsImEiOiJjandhajByNDIwYWx0M3lrZGtkdHR6bGxtIn0.wVbgor3CUTqqfxbuxlzFmA'
   }).addTo(map);
   
   function resetStreet() {
    if(polyLine != null) {
     map.removeLayer( polyLine );
    }
    for(i=0; i< draggableStreetMarkers.length; i++) {
     map.removeLayer( draggableStreetMarkers[i] );
    }
    draggableStreetMarkers = new Array();
   }
   
   function addMarkerStreetPoint( latLng ) {
    var streetMarker = L.marker( [latLng.lat, latLng.lng], { draggable: true, zIndexOffset: 900}).addTo(map);

    streetMarker.arrayId = draggableStreetMarkers.length;

    streetMarker.on('click', function() {
     map.removeLayer( draggableStreetMarkers[ this.arrayId ]);
     draggableStreetMarkers[ this.arrayId ] = "";
    });

    draggableStreetMarkers.push( streetMarker );
   }
   
   function drawStreet() {
    if(polyLine != null) {
     map.removeLayer( polyLine );
    }

    var latLngStreets = new Array();

    for(i=0; i < draggableStreetMarkers.length; i++) {
     if(draggableStreetMarkers[i]!="") {
      latLngStreets.push( L.latLng( draggableStreetMarkers[ i ].getLatLng().lat, draggableStreetMarkers[ i ].getLatLng().lng));
     }
    }

    if(latLngStreets.length > 1) {
     // create a red polyline from an array of LatLng points
     polyLine = L.polyline( latLngStreets, {color: 'red'} ).addTo(map);
    }

    if(polyLine != null) {
     // zoom the map to the polyline
     map.fitBounds( polyLine.getBounds() );
    }
   }
   
   function getGeoPoints() {
    var points = new Array();
    for(var i=0; i < draggableStreetMarkers.length; i++) {
     if(draggableStreetMarkers[i] != "") {
      points[i] =  draggableStreetMarkers[ i ].getLatLng().lng + "," + draggableStreetMarkers[ i ].getLatLng().lat;
     }
    }
    $('#geo').val(points.join(','));
   }
   
   $( document ).ready(function() {
    map.on('click', function(e) {
     addMarkerStreetPoint( e.latlng );
    });
   });
  </script>

   <script>
     $('#map2').css('cursor', 'pointer');   
  var map2 = L.map('map2').setView([-32.287132632616355, -59.23828124999999], 7);
L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoiZnJhbmNpc2Nvam9zZWFyaW9saSIsImEiOiJjandhajByNDIwYWx0M3lrZGtkdHR6bGxtIn0.wVbgor3CUTqqfxbuxlzFmA', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 12,
    id: 'mapbox.streets-satellite',
    accessToken: 'pk.eyJ1IjoiZnJhbmNpc2Nvam9zZWFyaW9saSIsImEiOiJjandhajByNDIwYWx0M3lrZGtkdHR6bGxtIn0.wVbgor3CUTqqfxbuxlzFmA'
}).addTo(map2);

   
  function putDraggable() {
   /* create a draggable marker in the center of the map */
   draggableMarker = L.marker([ map.getCenter().lat, map.getCenter().lng], {draggable:true, zIndexOffset:900}).addTo(map2);
   
   /* collect Lat,Lng values */
   draggableMarker.on('dragend', function(e) {
    $("#lat").val(this.getLatLng().lat);
    $("#lng").val(this.getLatLng().lng);
   });
  }
   
  $( document ).ready(function() {
   putDraggable();
  });
 </script>