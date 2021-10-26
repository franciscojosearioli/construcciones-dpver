    <div id="mapa_agregar">
      <div class="card">
                                              <div class="card-body">
      <div class="table-responsive">
          <ul class="nav nav-tabs customtab2 justify-content-center m-b-30" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" data-toggle="tab" href="#linea" role="tab" aria-expanded="true">Tramo</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#marcador" role="tab" aria-expanded="false">Marcador</a>
            </li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane p-20 active" id="linea" role="tabpanel" aria-expanded="true">




            <form method="post" action="includes/functions/map.php?id=<?php echo $_GET['id']; ?>">
              <center>   <h3>Tramo de obra</h3>
  <p>Para dibujar una linea, debe crear marcadores haciendo click en el mapa, para visualizar la linea debe "actualizar linea", para borrar un solo marcador debe volver a hacer click en el.</p>
              </center>
              <div class="form-group p-20">
                <div class="row">
                  <div class="col-md-7">
  <div id="add_ruta" style="z-index:0;width: 100%; height: 500px"></div><br />
</div>


<div class="col-md-5">
	                <div class="row p-t-20">
                <div class="md-form form-md">
                  <label class="control-label">Titulo del tramo</label>
                  <input type="text" id="titulo" name="titulo" class="form-control" required>
                </div> 
</div>
	                <div class="row p-t-20">
                <div class="md-form form-md">
                  <label class="control-label">Descripcion</label>
                  <textarea name="descripcion" id="descripcion" class="form-control md-textarea" rows="2"></textarea>
                </div> 
</div>
                <div class="row p-t-20">
                <div class="md-form form-md">
                  <label class="control-label">Coordenadas de puntos</label>
                 <input type="text" id="geo" name="geo" class="form-control" required />

</div>
                </div> 
                                 <div class="row p-t-20">
                 <span class="p-10"><input type="button" class="btn btn-info btn-sm" onclick="getGeoPoints();" value="Cargar coordenadas" /></span>
             </div>
             <?php if(isset($obra['estado'])){ ?>
                <input type="text" name="estado" class="form-control" value="<?php echo $obra['estado'] ?>" hidden required />
              <?php } if(isset($p['estado'])){ ?>
                <input type="text" name="estado" class="form-control" value="<?php echo $p['estado'] ?>" hidden required />
              <?php } ?>
<div class="row">
	<span class="p-10"><input type="button" class="btn btn-danger btn-sm" onclick="drawStreet();" value="Actualizar linea" /></span>
	<span class="p-10"><input type="button" class="btn btn-warning btn-sm" onclick="resetStreet();" value="Borrar todo" /></span>
</div>


                </div>
            </div>
              <hr>
                                                      <div class="row p-t-20 justify-content-center">
                          	 <button class="btn btn-danger waves-effect waves-light" onclick="cancelarform_mapa_agregar()" type="button">Cancelar</button>&nbsp;
                            <button class="btn btn-info waves-effect waves-light" type="submit" name="add_ruta">Guardar</button>

                          </div>
          </div>     
                        </form>
                    </div>
<div class="tab-pane p-20" id="marcador" role="tabpanel" aria-expanded="false">





           <form method="post" action="includes/functions/map.php?id=<?php echo $_GET['id']; ?>">
              <center>   <h3>Marcador de obra</h3>
  <p>Arrastre y ubique el marcador en las coordenadas deseadas.</p>
              </center>
              <div class="form-group p-20">
                <div class="row">
                  <div class="col-md-7">
  <div id="add_marcador" style="z-index:0;width: 100%; height: 500px"></div><br />
</div>


<div class="col-md-5">
	                <div class="row p-t-20">
                <div class="md-form form-md">
                  <label class="control-label">Titulo del marcador</label>
                  <input type="text" id="titulo" name="titulo" class="form-control">
                </div> 
</div>
	                <div class="row p-t-20">
                <div class="md-form form-md">
                  <label class="control-label">Descripcion</label>
                  <textarea name="descripcion" id="descripcion" class="form-control md-textarea" rows="2"></textarea>
                </div> 
</div>
	                                  <div class="row p-t-20">
                  Informacion del marcador
                  <div class="row">
	                	<div class="col-6">
					<label class="control-label">&nbsp;</label>
                  <input type="text" id="lat" name="latitud" class="form-control" readonly>
                  <small class="form-control-feedback"> Latitud </small></div>
                  <div class="col-6"><label class="control-label">&nbsp;</label>
                  <input type="text" id="lng" name="longitud" class="form-control" readonly>
                  <small class="form-control-feedback"> Longitud </small></div>
                  <?php if(isset($obra['idtipo'])){ ?>
                <input type="text" name="tipo" class="form-control" value="<?php echo $obra['idtipo'] ?>" hidden required />
              <?php } if(isset($p['idtipo'])){ ?>
                <input type="text" name="tipo" class="form-control" value="<?php echo $p['idtipo'] ?>" hidden required />
              <?php } ?>
</div>
</div>

                </div>
            </div>
              <hr>
                                                      <div class="row p-t-20 justify-content-center">
                          	 <button class="btn btn-danger waves-effect waves-light" onclick="cancelarform_mapa_agregar()" type="button">Cancelar</button>&nbsp;
                            <button class="btn btn-info waves-effect waves-light" type="submit" name="add_mark">Guardar</button>

                          </div>
          </div>     
                        </form>

</div>

                </div>



                </div>
      </div>
      </div>
    </div>

  <script>$('#add_ruta').css('cursor', 'pointer');var add_ruta = L.map( 'add_ruta' ).setView( [-32.287132632616355, -59.23828124999999], 7 );var polyLine;var draggableStreetMarkers = new Array();L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiZnJhbmNpc2Nvam9zZWFyaW9saSIsImEiOiJjandhajByNDIwYWx0M3lrZGtkdHR6bGxtIn0.wVbgor3CUTqqfxbuxlzFmA', {attribution: '',fullscreenControl: true,maxZoom: 20,minZoom:6,id: 'mapbox/streets-v11',accessToken: 'pk.eyJ1IjoiZnJhbmNpc2Nvam9zZWFyaW9saSIsImEiOiJjandhajByNDIwYWx0M3lrZGtkdHR6bGxtIn0.wVbgor3CUTqqfxbuxlzFmA'}).addTo(add_ruta);add_ruta.addControl(new L.Control.Fullscreen());function resetStreet() {if(polyLine != null) {add_ruta.removeLayer( polyLine );}for(i=0; i< draggableStreetMarkers.length; i++) {add_ruta.removeLayer( draggableStreetMarkers[i] );}draggableStreetMarkers = new Array();}function addMarkerStreetPoint( latLng ) {var streetMarker = L.marker( [latLng.lat, latLng.lng], { draggable: true, zIndexOffset: 900}).addTo(add_ruta);streetMarker.arrayId = draggableStreetMarkers.length;draggableStreetMarkers.push( streetMarker );}function drawStreet() {if(polyLine != null) {add_ruta.removeLayer( polyLine );}var latLngStreets = new Array();for(i=0; i < draggableStreetMarkers.length; i++) {if(draggableStreetMarkers[i]!="") {latLngStreets.push( L.latLng( draggableStreetMarkers[ i ].getLatLng().lat, draggableStreetMarkers[ i ].getLatLng().lng));}}if(latLngStreets.length > 1) {polyLine = L.polyline( latLngStreets, {color: 'red'} ).addTo(add_ruta);}if(polyLine != null) {add_ruta.fitBounds( polyLine.getBounds() );}}function getGeoPoints() {var points = new Array();for(var i=0; i < draggableStreetMarkers.length; i++) {if(draggableStreetMarkers[i] != "") {points[i] =  draggableStreetMarkers[ i ].getLatLng().lng + "," + draggableStreetMarkers[ i ].getLatLng().lat;}}$('#geo').val(points.join(','));}$(document).ready(function() {add_ruta.on('click', function(e) {addMarkerStreetPoint( e.latlng );});});</script>
     <script>$('#add_marcador').css('cursor', 'pointer');var add_marcador = L.map('add_marcador').setView([-32.287132632616355, -59.23828124999999], 7);L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiZnJhbmNpc2Nvam9zZWFyaW9saSIsImEiOiJjandhajByNDIwYWx0M3lrZGtkdHR6bGxtIn0.wVbgor3CUTqqfxbuxlzFmA', {attribution: '',fullscreenControl: true,maxZoom: 20,minZoom:6,id: 'mapbox/streets-v11',accessToken: 'pk.eyJ1IjoiZnJhbmNpc2Nvam9zZWFyaW9saSIsImEiOiJjandhajByNDIwYWx0M3lrZGtkdHR6bGxtIn0.wVbgor3CUTqqfxbuxlzFmA'}).addTo(add_marcador);add_marcador.addControl(new L.Control.Fullscreen());function putDraggable() {draggableMarker = L.marker([ add_marcador.getCenter().lat, add_marcador.getCenter().lng], {draggable:true, zIndexOffset:900}).addTo(add_marcador);draggableMarker.on('dragend', function(e) {$("#lat").val(this.getLatLng().lat);$("#lng").val(this.getLatLng().lng);});}$(document).ready(function() {putDraggable();});</script>