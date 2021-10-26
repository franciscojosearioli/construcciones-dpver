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
    $modificaciones_de_obra =  modificaciones_de_obra($obra['idobras']);
    $ampliaciones_de_obra =  ampliaciones_de_obra($obra['idobras']);
    $neutralizaciones_de_obra =  neutralizaciones_de_obra($obra['idobras']);
    ?>
<!--<div class="card"><?php if(permiso('admin') || permiso('obras')){ ?>
                                  <div class="justify-content-center text-center  p-20">Editar: 
                                  <a data-toggle="modal" data-target="#edit_obra" href="">informe de obra</a> 
                                  <span style="border-right:1px solid #dee2e6;padding-left: 10px">&nbsp;</span>
                                  Agregar o Editar: 
                                  <a data-toggle="modal" data-target="#modificaciones" href="" style="padding-left: 10px;">Modificacion de obra</a>
                                  <span style="border-right:1px solid #dee2e6;padding-left: 10px">&nbsp;</span>
                                  <a data-toggle="modal" data-target="#ampliaciones" href="" style="padding-left: 10px;">Ampliacion de plazo de obra</a>
                                  <span style="border-right:1px solid #dee2e6;padding-left: 10px">&nbsp;</span>
                                  <a data-toggle="modal" data-target="#neutralizaciones" href="" style="padding-left: 10px;">Neutralizacion de obra</a>
                                </div>
                                <?php } ?>
                                </div>-->
                                
                                      <!--<div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                          <div class="text-center" style="background-color: #e1e1e1;padding:10px;">
                                            <label class="control-label text-muted" style="font-size:12px;">Expediente</label>
                                            <h4><?php echo $obra['expediente']; ?></h4>
                                          </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                          <div class="text-center" style="background-color: #e1e1e1;padding:10px;">
                                            <label class="control-label text-muted" style="font-size:12px;">Caja / Archivo</label>
                                            <h4><?php echo ifexist($obra['numero']); ?></h4>
                                          </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                          <div class="text-center" style="background-color: #e1e1e1;padding:10px;">
                                            <label class="control-label text-muted" style="font-size:12px;">Estado</label>
                                            <h4><?php 
                      if($obra['estado'] == 0){ echo 'En ejecucion'; }
                      if($obra['estado'] == 3 && $obra['finalizado'] == 0){ echo 'Finalizada sin recibir'; }
                      if($obra['estado'] == 3 && $obra['finalizado'] == 1){ echo 'Finalizada en garantia'; }
                      if($obra['estado'] == 3 && $obra['finalizado'] == 2){ echo 'Finalizada definitiva'; }
                      if($obra['estado'] == 4){ echo 'Neutralizada'; }
                      if($obra['estado'] == 5){ echo 'Rescindida'; } ?></h4>
                                          </div>
                                        </div>
                                      </div>  -->
<div class="row justify-content-center">
<div class="col-lg-10 col-md-10 col-sm-12">
                                           <div class="row">
<?php include('../../content/forms/agregar_mapa.php');
include('../../content/forms/eliminar_mapa.php');
?>
</div>
</div>
</div>
                                      <div class="row justify-content-center"  id="vista_mapa_obra">
                                        <div class="col-lg-8 col-md-8 col-sm-12">
                                        <h3 class="titulo-bienvenida p-20">
   Generalidades de obra
    </h3>

                                            <div class="card">
                                              <div class="card-body">
                                              <div class="p-3">
                                            <label class="control-label text-muted" style="font-size:12px;">Descripcion</label>
                                            <p><?php echo $obra['descripcion']; ?></p>
                                            </div>
                                              <div class="d-flex flex-row">
                                              <div class="p-3">
                                            <label class="control-label text-muted" style="font-size:12px;">Localidades / Departamentos</label>
                                            <p><?php echo $obra['ubicacion']; ?></p>
                                            </div>
                                            <?php if(!empty($obra['longitud'])){echo '<div class="p-3"><label class="control-label text-muted" style="font-size:12px;">Longitud </label><p>'.$obra['longitud'].' metros</p></div>';} else { echo ''; } ?>
                                            </div>
                                            <div class="d-flex flex-row">
                                              <div class="p-3">
  <label class="control-label text-muted" style="font-size:12px;">Presupuesto oficial del proyecto</label>
<p><?php if(!empty($obra['proyecto_monto'])){ echo '$ '.numero($obra['proyecto_monto']); }else{'';} ?><?php if(!empty($obra['proyecto_monto_fecha'])){ echo ' | '.$obra['proyecto_monto_fecha']; }else{'';} ?></p>
</div>
  <div class="p-3">
  <label class="control-label text-muted" style="font-size:12px;">Plazo de Garantia</label>
  <p><?php echo $obra['plazo_garantia']; ?></p>
  </div>
<div class="p-3">
  <label class="control-label text-muted" style="font-size:12px;">Plazo de ejecucion de obra</label>
<p><?php echo $obra['proyecto_plazo']; ?></p>
  </div>
<div class="p-3">
  <label class="control-label text-muted" style="font-size:12px;">Plazo de ejecucion actualizado</label>
<p><?php echo $obra['plazo_vigente']; ?></p>
  </div>
  </div>
  <?php if(!empty($obra['contrato_monto'])){ ?>
<div class="d-flex flex-row">
<div class="p-3">
<label class="control-label text-muted" style="font-size:12px;">Monto de contrato</label>
<p><?php echo '$ '.numero($obra['contrato_monto']); ?></p>
</div>
<?php if(!empty($obra['monto_vigente'])){ ?>
<div class="p-3">
<label class="control-label text-muted" style="font-size:12px;">Monto de contrato vigente a precios base</label>
<p><?php echo '$ '.numero($obra['monto_vigente']); ?></p>
  </div>
  <?php } ?>
  
  <?php if(!empty($obra['monto_vigente'])){ ?>
<div class="p-3">
<label class="control-label text-muted" style="font-size:12px;">Monto de contrato vigente a precios redeterminados</label>
<p><?php echo '$ '.numero($obra['monto_redeterminado']); if(!empty($obra['info_redeterminacion'])){ echo ' | '.$obra['info_redeterminacion']; } ?></p>
  </div>
  <?php } ?>
  
  <?php if(permiso('admin') || permiso('certificacion') || permiso('obras')){ ?>
                    <div class="p-3"> <a href="" data-toggle="modal" data-target="#montos_obra" ><i class="fas fa-edit"></i> Editar montos y plazos</a></div>
                  <?php } ?>
  </div>
<?php } ?>
  <div class="p-3">
                                            <label class="control-label text-muted" style="font-size:12px;">Memoria descriptiva</label>
                                            <p><?php if(!empty($obra['memoria_descriptiva_vigente'])){ echo $obra['memoria_descriptiva_vigente']; }else{ echo $obra['memoria_descriptiva']; } ?></p>
                                            </div>
                                            <div class="p-3">
                                            <?php if(!empty($obra['observaciones'])){ ?>
                                                <blockquote class="blockquote">
                                            <label class="control-label text-muted" style="font-size:12px;">Observaciones</label>
                                                <p style="font-size:12px;"><?php echo textarea($obra['observaciones']); ?></p><?php } ?> 
                                                </blockquote> </div>
                                                <footer class="blockquote-footer">Informe actualizado el <cite><?php echo format_date($obra['registro_fecha']); ?></cite></footer>     
                                            
                                          
                                          </div>
                                        </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12">
    <h3 class="titulo-bienvenida p-20">
   Ubicacion de obra
    </h3>
                                            <div class="card">
                                              <div class="card-body">
                                        <div>
<div class="table-responsive">
          <div id="map_obra" style="z-index:0;width: 100%; height: 400px"></div>
          <?php if(permiso('admin') || permiso('obras')){ ?>
                                  <div class="p-20 justify-content-center text-center">
                                  <h3>Modificar Lineas o Marcadores  en el mapa</h3>
                                  <a class="btn btn-warning mx-4" id="btnagregar_mapa_agregar" onclick="form_mapa_agregar(true)">Agregar</a> 
                                  <a class="btn btn-warning mx-4" id="btnagregar_mapa_eliminar" onclick="form_mapa_eliminar(true)" style="padding-left: 10px;">Eliminar</a>
                                  </div>
<?php } ?>
        </div>                                  </div>

<script>
  $(document).ready(function() {
  var map_obra = L.map('map_obra').invalidateSize(true).setView( [-32.287132632616355, -59.23828124999999], 7 );L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiZnJhbmNpc2Nvam9zZWFyaW9saSIsImEiOiJjandhajByNDIwYWx0M3lrZGtkdHR6bGxtIn0.wVbgor3CUTqqfxbuxlzFmA', {attribution: '',fullscreenControl: true,maxZoom: 20,minZoom:6,id: 'mapbox/streets-v11',accessToken: 'pk.eyJ1IjoiZnJhbmNpc2Nvam9zZWFyaW9saSIsImEiOiJjandhajByNDIwYWx0M3lrZGtkdHR6bGxtIn0.wVbgor3CUTqqfxbuxlzFmA'}).addTo(map_obra);map_obra.addControl(new L.Control.Fullscreen());$(document).ready(function() {add_punto();add_linea();});function add_punto() {for(var i=0; i<puntos.length; i++) {var marker = L.marker( [puntos[i]['latitud'], puntos[i]['longitud']]).addTo(map_obra);marker.bindPopup( "<b>" + puntos[i]['titulo']+"</b>");}}function stringToGeoPoints( geo ) {var linesPin = geo.split(",");var linesLat = new Array();var linesLng = new Array();for(i=0; i < linesPin.length; i++) {if(i % 2) {linesLat.push(linesPin[i]);}else{linesLng.push(linesPin[i]);}}var latLngLine = new Array();for(i=0; i<linesLng.length;i++) {latLngLine.push( L.latLng( linesLat[i], linesLng[i]));}return latLngLine;}function add_linea() {for(var i=0; i < lineas.length; i++) {var polyline = L.polyline( stringToGeoPoints(lineas[i]['georeferencia']), { color: lineas[i]['color']}).addTo(map_obra);polyline.bindPopup( "<b>" + lineas[i]['titulo']);   }}var puntos = <?php echo json_encode($mapa_puntos) ?>;var lineas = <?php echo json_encode($mapa_lineas) ?>;
});
</script>

<script type="text/javascript" src="includes/ajax/scripts/mapa.js"></script>
</div>
                                        
                                        </div>
                                        </div>
                                        
                                        </div>
                                      </div>
                                      
<?php } endforeach; ?>