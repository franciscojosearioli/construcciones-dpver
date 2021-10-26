 <?php 
if(isset($obra_id)){
$mapa_puntos = obra_puntos($obra_id);
$mapa_lineas = obra_lineas($obra_id);
}
if(isset($proyecto_id)){
$mapa_puntos = obra_puntos($proyecto_id);
$mapa_lineas = obra_lineas($proyecto_id);
}
 ?>
    <div id="mapa_eliminar">
      <div class="table-responsive">
          <ul class="nav nav-tabs customtab2 justify-content-center m-b-30" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" data-toggle="tab" href="#linea_eliminar" role="tab" aria-expanded="true">Tramo</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#marcador_eliminar" role="tab" aria-expanded="false">Marcador</a>
            </li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane p-20 active" id="linea_eliminar" role="tabpanel" aria-expanded="true">




            <form method="post" action="includes/functions/map.php?id=<?php echo $_GET['id']; ?>">
              <center>   <h3>Tramo de obra</h3>
  <p>Seleccione el nombre del tramo para eliminar..</p>
              </center>
              <div class="form-group p-20">
                <div class="row">
                  <div class="col-md-12">
  <select name="tramo" id="selectlinea" class="form-control custom-select" required>
    <option disabled selected>Seleccione un tramo</option>
    <?php for($i=0;$i<count($mapa_lineas);$i++) { print '<option value="'.$mapa_lineas[$i]['idmapa_linea'].'">'.$mapa_lineas[$i]['titulo'].'</option>'; } ?></select>
</div>
            </div>
              <hr>
                                                      <div class="row p-t-20 justify-content-center">
                          	 <button class="btn btn-danger waves-effect waves-light" onclick="cancelarform_mapa_eliminar()" type="button">Cancelar</button>&nbsp;
                            <button class="btn btn-info waves-effect waves-light" type="submit" name="delete_ruta">Eliminar</button>

                          </div>
          </div>     
                        </form>
                    </div>
<div class="tab-pane p-20" id="marcador_eliminar" role="tabpanel" aria-expanded="false">





           <form method="post" action="includes/functions/map.php?id=<?php echo $_GET['id']; ?>">
              <center>   <h3>Marcador de obra</h3>
  <p>Seleccione el nombre del marcador para eliminar.</p>
              </center>
              <div class="form-group p-20">
                <div class="row">
                  <div class="col-md-12">
    <select name="marcador" id="selectmark" class="form-control custom-select" required><option disabled selected>Seleccione un marcador</option><?php for( $i=0; $i < count($mapa_puntos); $i++) { print '<option value="'.$mapa_puntos[$i]['idmapa_punto'].'">'.$mapa_puntos[$i]['titulo'].'</option>'; } ?></select>
</div>
            </div>
              <hr>
                                                      <div class="row p-t-20 justify-content-center">
                          	 <button class="btn btn-danger waves-effect waves-light" onclick="cancelarform_mapa_eliminar()" type="button">Cancelar</button>&nbsp;
                            <button class="btn btn-info waves-effect waves-light" type="submit" name="delete_mark">Eliminar</button>

                          </div>
          </div>     
                        </form>

</div>

                </div>




      </div>
    </div>