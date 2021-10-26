<?php
require_once('../../includes/load.php');
cabecera('Consultas');

$dato = trim($_POST['buscador']);

$dato_length = strlen($dato);


if(is_numeric($dato)){

if(is_numeric($dato) && $dato_length == 6){

$expediente = buscar_expediente($dato);
if($dato == $expediente['numero']){
logs(0,"consulta",0,"Consulto Expediente N° ".$expediente['numero']);
$tramite = find_by_id('tramites','numero',$expediente['numero']);
$pases_tramite = tramites_movimientos($tramite['idtramites']);
$pases_expediente = pases_expediente($expediente['numero']);
$pases_construcciones = tramites_movimientos($tramite['idtramites']);
?>
<div class="d-lg-flex half justify-content-center">
    <div class="bg order-1 order-md-2 ocultar-div" style="background-color: #e1e1e150;">
        <div>
      <div class="container" id="content-login">
        <div class="row align-items-center justify-content-center">
          <div class="col-10">
    <div class="table-responsive">
    <h3>Movimientos</h3>
                  <table id="all" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th class='text-center' style='width: 10%;'> Fecha </th>
                        <th class='text-center' style='width: 50%;'> Ubicacion </th>
                        <th class='text-center' style='width: 10%;'> Nota </th>
                        <th class='text-center' style='width: 10%;'> Folios </th>
                        <th class='text-center' style='width: 10%;'> Norma </th>
                        <th class='text-center' style='width: 10%;'> Norma Nº </th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($pases_expediente as $pases_exp): ?>
                        <tr>
                          <td style="font-size:12px" ><b><?php echo format_date($pases_exp['fecha']); ?></b></td>
                          <td style="font-size:12px" ><b><?php echo utf8_encode($pases_exp['tramite']); ?></b></td>
                          <td style="font-size:12px" ><b><?php echo utf8_encode($pases_exp['nota']); ?></b></td>
                          <td style="font-size:12px" ><b><?php echo utf8_encode($pases_exp['nfolios']); ?></b></td>
                          <td style="font-size:12px" ><b><?php echo utf8_encode($pases_exp['norma_tipo']); ?></b></td>
                          <td style="font-size:12px" ><center><b><?php echo utf8_encode($pases_exp['norma_nro']); ?></b></center></td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th class='text-center' style='width: 10%;'> Fecha </th>
                        <th class='text-center' style='width: 50%;'> Ubicacion </th>
                        <th class='text-center' style='width: 10%;'> Nota </th>
                        <th class='text-center' style='width: 10%;'> Folios </th>
                        <th class='text-center' style='width: 10%;'> Norma </th>
                        <th class='text-center' style='width: 10%;'> Norma Nº </th>
                      </tr>
                    </tfoot>
                  </table>
              </div>
    </div>
    </div>
    </div>
    </div>
</div>
    <div class="">
      <div class="container" id="content-login">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-7">

<label class="control-label text-muted" style="font-size:11px;">Tipo de tramite</label> 
<h4><?php echo $expediente['tipo']; ?></h4>
<label class="control-label text-muted" style="font-size:11px;">Numero del tramite</label> 
<h1><?php echo $expediente['numero']; ?></h1>
<label class="control-label text-muted" style="font-size:11px;">Asunto del tramite</label> 
<h3><?php echo utf8_encode($expediente['asunto']); ?></h3>
<label class="control-label text-muted" style="font-size:11px;">Iniciador del tramite</label> 
<h4>Iniciado por <?php echo utf8_encode($expediente['iniciador']); ?> el <?php if(isset($expediente)){ echo format_date($expediente['fechareg']);} ?></h4>
<?php
if(ifexist($expediente)){  
$ul_mov_exp = ul_mov_exp($expediente['numero']); ?>
<label class="control-label text-muted" style="font-size:11px;">Ultimo movimiento del tramite</label> 
<h4><?php echo utf8_encode($ul_mov_exp['tramite']); if(!empty($ul_mov_exp['fecha'])){ echo ' desde '.format_date($ul_mov_exp['fecha']);} ?></h4>
  <?php } ?>
<?php
if(ifexist($expediente)){  
$ul_mov_tramite = ul_mov_tramite($tramite['idtramites']); 
if(!empty($ul_mov_tramite)){?>
<label class="control-label text-muted" style="font-size:11px;">Ultimo movimiento del tramite en Construcciones</label> 
<h3><?php  echo find_select('nombre','departamentos','iddepartamentos',$ul_mov_tramite['iddepartamentos']); if(!empty($ul_mov_tramite['fecha'])){ echo ' desde '.format_date($ul_mov_tramite['fecha']);}}else{echo ''; ?></h3>
  <?php }} if(!empty($tramite['observaciones'])){ ?>
<label class="control-label text-muted" style="font-size:11px;">Observaciones</label> 
<h4><?php  echo $tramite['observaciones'];?></h4>
<?php } ?>
        <hr>
            <a style="text-decoration:none;" href="../../">Haga click aqui para regresar</a>
          </div>
        </div>
      </div>   
    </div>
  </div>
<?php 

}else{ 
logs(0,"consulta",0,"Consulto: ".$dato);
?> 
<div class="d-lg-flex half justify-content-center">
    <div class="bg order-1 order-md-2 ocultar-div" style="background-color: url('includes/assets/images/fondo.jpg');">
        
</div>
    <div class="contents order-2 order-md-1">
      <div class="container" id="content-login">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-7">
            <h3>No se encontraron resultados.</h3>
            <a style="text-decoration:none;" href="../../">Haga click aqui para regresar</a>
          </div>
        </div>
      </div>   
    </div>
  </div>

<?php }

}else{
logs(0,"consulta",0,"Consulto: ".$dato);
?>
<div class="d-lg-flex half justify-content-center">
    <div class="bg order-1 order-md-2 ocultar-div" style="background-image: url('includes/assets/images/fondo.jpg');">
        
</div>
    <div class="contents order-2 order-md-1">
      <div class="container" id="content-login">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-7">
            <h3>No se encontraron resultados.</h3>
            <a style="text-decoration:none;" href="../../">Haga click aqui para regresar</a>
          </div>
        </div>
      </div>   
    </div>
  </div>
<?php
}

}elseif(is_string($dato)){
logs(0,"consulta",0,"Consulto: ".$dato);

?>
<div class="d-lg-flex half justify-content-center">
    <div class="bg order-1 order-md-2 ocultar-div" style="background-image: url('includes/assets/images/fondo.jpg');">
        
</div>
    <div class="contents order-2 order-md-1">
      <div class="container" id="content-login">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-7">
            <h3>No se encontraron resultados.</h3>
            <a style="text-decoration:none;" href="../../">Haga click aqui para regresar</a>
          </div>
        </div>
      </div>   
    </div>
  </div>
<?php 
}

?>

<?php 
pie(); ?>
<!--
si es numerico detecta si tiene 6 numeros y busca un expediente, si el expediente tiene un tag de modificacion busca en la tabla de modificaciones el numero de la modificacion para obtener los datos y asi los demas tags

si el numero ingresado coincide con una obra cargada que lleve directamente a la informacion de la obra 

si no es numero busca la relacion en la base  de datos a travez de like en los campos titulo de obra, y lleva a la obra

la pagina de presentacion de una obra seria de un lado la informacion y del otro el mapa con la ubicacion de esa obra

la pagina de presentacion de un tramite seria de un lado la informacion principal y del otro los movimientos

la pagina de una modificacion muestra de un lado la informacion de la modificacion y del otro los movimientos


sino la busqueda no coincide en nuestros registros-->
