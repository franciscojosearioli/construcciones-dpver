<?php 
$proyecto_id =$_GET['id'];
require_once('../../includes/load.php');
require_once('../../includes/functions/proyectos.php');  
require_once("../../includes/functions/map.php"); 
$user = current_user();
$proyectos_construcciones = proyectos($proyecto_id);   
$inspectores = all_inspectores();
$mapa_puntos = obra_puntos($proyecto_id);
$mapa_lineas = obra_lineas($proyecto_id);
foreach($proyectos_construcciones as $p):
  if($p['idobras'] == $proyecto_id){
    cabecera('Proyecto: '.$p['nombre']);
    $inicio_exp = buscar_expediente($p['expediente']);                
    $ul_mov_exp = ul_mov_exp($p['expediente']);
    ?>
<div class="container-fluid" id="vista_mapa_obra">
<div class="card">
<ul class="nav nav-tabs customtab" role="tablist">
  <?php if(permiso('admin') || permiso('proyectos')){ ?>
  <li class="nav-item">
  <a class="nav-link" style="padding:10px 15px 10px 15px" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Editar
  </a>
  <div class="dropdown-menu dropdown-item-theme" aria-labelledby="dropdownMenuButton2">
    <a class="dropdown-item dropdown-item-theme" data-toggle="modal" data-target="#edit_proyecto"> Informe de proyecto</a>
  </div>
</li>
  <li class="nav-item">
  <a class="nav-link" style="padding:10px 15px 10px 15px" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Mapa
  </a>
  <div class="dropdown-menu dropdown-item-theme" aria-labelledby="dropdownMenuButton2">
    <a class="dropdown-item dropdown-item-theme" id="btnagregar_mapa_agregar" onclick="form_mapa_agregar(true)"> Agregar</a>
    <a class="dropdown-item dropdown-item-theme" id="btnagregar_mapa_eliminar" onclick="form_mapa_eliminar(true)"> Eliminar</a>
  </div>
</li>
<?php } ?>
  <li class="nav-item">
  <a class="nav-link" style="padding:10px 15px 10px 15px" id="dropdownMenuButton3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Imprimir
  </a>
  <div class="dropdown-menu dropdown-item-theme" aria-labelledby="dropdownMenuButton3">
    <a class="dropdown-item dropdown-item-theme" target="_blank" href="<?php echo '/construcciones/public/admin/content/prints/proyecto.php?id='.$p['idobras'];?>">Informe tecnico</a>
  </div>

</li>
  <li class="nav-item">
  <a class="nav-link" style="padding:10px 15px 10px 15px" id="dropdownMenuButton4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Ayuda
  </a>
  <div class="dropdown-menu dropdown-item-theme" aria-labelledby="dropdownMenuButton4">
    <a class="dropdown-item dropdown-item-theme" data-toggle="modal" data-target="#combinar_pdf">Combinar PDFs</a>
    <a class="dropdown-item dropdown-item-theme" target="_blank" href="https://smallpdf.com/es/unir-pdf">SmallPDF</a>
  </div>

</li>
</ul>
            <div class="d-flex flex-wrap margin-dt">
              <div class="card-body p-b-0">
                <h4 class="card-title"><?php echo $p['nombre']; ?></h4>
                Expediente: <span class="badge badge-secondary"><?php echo $p['expediente']; ?></span>
                Ubicacion: <span class="badge badge-secondary"><?php echo $p['ubicacion']; ?></span>
                Estado: <span class="badge badge-secondary">En proyecto</span>
              <br><br>
              </div>
              <div class="ml-auto ">
          </div>
        </div>
        <div class="row  p-20">
        <div class="col-lg-7 col-md-7 col-sm-12">
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-12">
                      <?php if($user['idroles'] == 1 || $user['iddepartamentos'] == 6 || $user['iddepartamentos'] == 5){ ?><b>Nº Proyecto:</b> <?php echo $p['numero']; ?><br /><?php } ?>
                      <b>Proyecto:</b> <?php echo $p['nombre']; ?><br />
                      <b>Descripcion:</b> <?php echo $p['descripcion']; ?><br />
                      <b>Departamento:</b> <?php echo $p['ubicacion']; ?><br />
                      <?php if(!empty($p['longitud'])){echo  '<b>Longitud: </b>'.$p['longitud'].' metros.';} else { echo ''; } ?>
                      </div>  </div>  </div>  
                      
                      <div class="form-group">
                  <div class="row">
                    <div class="col-md-12">
                      <?php if(!empty($p['proyecto_monto'])){ echo '<b>Presupuesto oficial: </b>$ '.numero($p['proyecto_monto']); }else{'';} ?> <?php if(!empty($p['proyecto_monto_fecha'])){ echo '('.$p['proyecto_monto_fecha'].')<br />'; }else{echo '<br />';} ?>
                      <?php if(!empty($p['proyecto_plazo'])){ echo '<b>Plazo oficial: </b>'.$p['proyecto_plazo'].'<br />'; } ?>
                      <?php if(!empty($p['plazo_garantia'])){echo  '<b>Plazo de garantia: </b>'.$p['plazo_garantia'].'<br />';} else { echo ''; } ?>
                    </div>   
                    <div class="col-md-12">
                      <?php 
                      if(!empty($p['aprobacion_res_num']) || $p['aprobacion_res_fecha'] != '0000-00-00'){ echo '<b>Aprobacion: </b>'; }
                      if(!empty($p['aprobacion_res_num'])){ echo 'Nº '.$p['aprobacion_res_num'];} else {echo ''; }
                      if($p['aprobacion_res_fecha'] != '0000-00-00'){ echo ' el '.ifdate($p['aprobacion_res_fecha']).'<br />'; } else { echo ''; } ?>
                      <?php 
                      if(!empty($p['adjudicacion_res_num']) || $p['adjudicacion_res_fecha'] != '0000-00-00'){ echo '<b>Adjudicacion: </b>'; }
                      if(!empty($p['adjudicacion_res_num'])){ echo 'Nº '.$p['adjudicacion_res_num'];} 
                      else{ echo ''; }
                      if($p['adjudicacion_res_fecha'] != '0000-00-00'){ echo ' el '.ifdate($p['adjudicacion_res_fecha']).'<br />'; } else { echo ''; }
                      ?>
                      <?php if(!empty($p['contratista'])){ echo '<b>Contratista: </b>'.$p['contratista'].'<br />'; } else { echo ''; } ?>
                    </div>    
                    <div class="col-md-12">
                      <?php if(!empty($p['tipo_financiamiento'])){ echo '<b>Fuente financiamiento: </b>'.$p['tipo_financiamiento'].'<br />'; } else { echo ''; } ?>
                      <?php if(!empty($p['tipo_contratacion'])){ echo '<b>Tipo de contratacion: </b>'.$p['tipo_contratacion'].'<br />'; } else { echo ''; } ?>
                    </div>  
                    <div class="col-md-12">
                      <?php if($p['contrato_fecha'] != '0000-00-00'){ echo '<b>Firma de contrato: </b>'.ifdate($p['contrato_fecha']).'<br />'; } else { echo ''; } ?>
                      <?php if(!empty($p['contrato_monto'])){ echo '<b>Monto contrato: </b>$ '.numero($p['contrato_monto']).'<br />'; } else { echo ''; } ?>
                      <?php if(!empty($p['plazo_vigente'])){ echo '<b>Plazo vigente: </b>'.$p['plazo_vigente'].'<br />'; } else { echo ''; } ?>
                    </div>
                    <div class="col-md-12">
                      <?php if(!empty($p['observaciones'])){ echo '<b>Observaciones:</b><br />'.textarea($p['observaciones']);} else { echo ''; } ?><br>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-12">
                      <b>Memoria descriptiva:</b><br />
                      <?php echo textarea($p['memoria_descriptiva']); ?><br>
                    </div>
                  </div>
                </div>    
                <?php if(!empty($p['expediente'])){ ?>
                  <div class="form-group" style="border-left: 3px solid #000; background: #e0e0e030;">
                    <div class="row p-20"> 
                      <div class="col-md-12">
                        <center><b>TRAMITE</b></center>
                        <?php if(!empty($p['expediente'])){ echo '<b>Nº Expediente: </b>'.$p['expediente'].'<br />';}else{ echo '';} ?>
                        <?php if(ifexist($ul_mov_exp['fecha']) && ifexist($ul_mov_exp['tramite']) ){ echo '<b>Ubicacion actual:</b> '.utf8_encode($ul_mov_exp['tramite']).' el '.ifdate($ul_mov_exp['fecha']).'<br />';}else{ echo '';} ?>
                        <?php if(ifexist($inicio_exp['fechareg']) && ifexist($inicio_exp['iniciador'])){ echo '<b>Iniciador por:</b> '.utf8_encode($inicio_exp['iniciador']).' el '.ifdate($inicio_exp['fechareg']).'<br />';} else{ echo '';} ?>
                        <b>Estado del tramite: </b><?php if(!isset($p['tramite']) || $p['tramite'] == 0){ echo 'No establecido';} 
                        if($p['tramite'] == 1){ echo 'Relevando y confeccionando proyecto y pliegos';}
                        if($p['tramite'] == 2){ echo 'Autorizando proyecto';}
                        if($p['tramite'] == 3){ echo 'Visando pliegos (Encuadre legal)';}
                        if($p['tramite'] == 4){ echo 'Reserva preventiva';}
                        if($p['tramite'] == 5){ echo 'Tomado conocimiento';}
                        if($p['tramite'] == 6){ echo 'Conf. proyecto de resolución llamado / Desig. Comision de est. / Aprobado de res.';}
                        if($p['tramite'] == 7){ echo 'Cursado de invitacion y plazo de preparacion de ofertas';}
                        if($p['tramite'] == 8){ echo 'Apertura de ofertas y armado de expediente';}
                        if($p['tramite'] == 9){ echo 'Desglasando la garantia de oferta';}
                        if($p['tramite'] == 10){ echo 'Designacion comision de estudio y resolucion';}
                        if($p['tramite'] == 11){ echo 'Aprob. Res. de designacion';}
                        if($p['tramite'] == 12){ echo 'Comision de estudios';}
                        if($p['tramite'] == 13){ echo 'Reserva definitiva';}
                        if($p['tramite'] == 14){ echo 'Confeccionando proyecto de resolucion de adjudicacion y aprobacion';}
                        if($p['tramite'] == 15){ echo 'Notificacion al adjudicatario';}
                        if($p['tramite'] == 16){ echo 'Solicitando gtia. contractual, notif. de perdedores, devol. de gtia.';}
                        if($p['tramite'] == 17){ echo 'Redactando contrato';}
                        if($p['tramite'] == 18){ echo 'Sellando contrato';}
                        if($p['tramite'] == 19){ echo 'Designando inspeccion / Confeccion acta de inicio';}
                        if($p['tramite'] == 20){ echo 'En ejecucion';}
                        ?><br><b>Avance del tramite:</b> <?php echo $p['tramite']*100/20; ?> %
                      </div>
                    </div>     
            <div class="card-footer-custom">
              <small class="text-muted"><?php echo 'Información actualizada el '.ifdate($p['registro_fecha']).user_name($p['registro_usuario']); ?></small>
            </div>  
                  </div>
                <?php } ?>
                  </div>
                
        <div class="col-lg-4 col-md-4 col-sm-12">
        
        <div id="map_obra" style="width: 100%; height: 400px"></div>
                </div>
                                        
        </div>
        </div>
        
                      
                      
                      
        
        </div></div>
    
    
<?php include('../../includes/ajax/AddMapa.php');
include('../../includes/ajax/DeleteMapa.php');
?>
<br>
<script type="text/javascript" src="includes/ajax/scripts/mapa.js"></script>
<script>
  var map_obra = L.map('map_obra').invalidateSize(true).setView( [-32.287132632616355, -59.23828124999999], 7 );
L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiZnJhbmNpc2Nvam9zZWFyaW9saSIsImEiOiJjandhajByNDIwYWx0M3lrZGtkdHR6bGxtIn0.wVbgor3CUTqqfxbuxlzFmA', {attribution: '',fullscreenControl: true,maxZoom: 20,minZoom:6,id: 'mapbox/streets-v11',accessToken: 'pk.eyJ1IjoiZnJhbmNpc2Nvam9zZWFyaW9saSIsImEiOiJjandhajByNDIwYWx0M3lrZGtkdHR6bGxtIn0.wVbgor3CUTqqfxbuxlzFmA'}).addTo(map_obra);map_obra.addControl(new L.Control.Fullscreen());$(document).ready(function() {add_punto();add_linea();});
function add_punto() {
  for(var i=0; i<puntos.length; i++) {

    var marker = L.marker( [puntos[i]['latitud'], puntos[i]['longitud']]);
var idobras = puntos[i]['idobras'];

var contenido = "<b>" + puntos[i]['titulo'] + "</b><hr>Descripcion: "+puntos[i]['descripcion'];

var opciones = {
  minWidth: '300',
  maxWidth: '300',
  className: 'custom',
  closeButton: true,
  autoClose: false
}
        marker.bindPopup(contenido, opciones);
        marker.addTo(map_obra);

}}function stringToGeoPoints( geo ) {var linesPin = geo.split(",");var linesLat = new Array();var linesLng = new Array();for(i=0; i < linesPin.length; i++) {if(i % 2) {linesLat.push(linesPin[i]);}else{linesLng.push(linesPin[i]);}}var latLngLine = new Array();for(i=0; i<linesLng.length;i++) {latLngLine.push( L.latLng( linesLat[i], linesLng[i]));}return latLngLine;}function add_linea() {
  for(var i=0; i < lineas.length; i++) {
    var polyline = L.polyline( stringToGeoPoints(lineas[i]['georeferencia']), { color: lineas[i]['color']});
var idobras = lineas[i]['idobras'];
  
var polyline = L.polyline( stringToGeoPoints(lineas[i]['georeferencia']), { color: lineas[i]['color']});

var contenido = "<b>" + lineas[i]['titulo'] + "</b><hr>Descripcion: "+lineas[i]['descripcion'];

var opciones = {
  minWidth: '300',
  maxWidth: '300',
  className: 'custom',
  closeButton: true,
  autoClose: false
}

    polyline.bindPopup(contenido, opciones);
    polyline.addTo(map_obra);
    }}var puntos = JSON.parse( '<?php echo json_encode($mapa_puntos) ?>' );var lineas = <?php echo json_encode($mapa_lineas) ?>;
</script>
  <?php
}
endforeach;
?>
<?php 
require_once('../modals/edit_proyecto.php');
pie(); ?>