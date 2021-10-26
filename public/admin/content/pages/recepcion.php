<?php
require_once('../../includes/load.php');
$recepcion = $_GET['id'];
if(!empty($recepcion)){ 
$recepcion = find_by_id('recepciones','idrecepciones',$recepcion);

if($recepcion['tipo'] == 'rp'){
$tipo_recep = 'Provisoria'; 
}elseif($recepcion['tipo'] == 'rd'){ 
$tipo_recep = 'Definitiva'; 
} 
cabecera('Recepcion '.$tipo_recep);
?>                       <div class="row">
    <p class="titulo-bienvenida p-20">
   Recepcion <?php 
if($recepcion['tipo'] == 'rp'){
echo 'Provisoria'; 
}elseif($recepcion['tipo'] == 'rd'){ 
echo 'Definitiva'; 
} ?>
    </p>
  </div>
     <div class="row justify-content-center" >
         <div class="col-10">
          <div class="card">
            <div class="card-body mx-4">
              <div class="d-flex flex-wrap p-b-30">
            
                         <div class="my-auto">
<label class="control-label text-muted" style="font-size:11px;">Tipo de tramite</label> 
<h3><?php if(isset($exp)){ echo $inicio_exp['tipo'];} ?></h3>
<label class="control-label text-muted" style="font-size:11px;">Numero del tramite</label> 
<h1><?php echo $exp; ?></h1>

<label class="control-label text-muted" style="font-size:11px;">Asunto del tramite</label> 
<h2><?php echo utf8_encode($inicio_exp['asunto']); ?></h2>
<label class="control-label text-muted" style="font-size:11px;">Iniciador del tramite</label> 
<h3>Iniciado por <?php echo utf8_encode($inicio_exp['iniciador']); ?> el <?php if(isset($exp)){ echo format_date($inicio_exp['fechareg']);} ?></h3>
<?php
if(ifexist($exp)){  
$ul_mov_exp = ul_mov_exp($exp); ?>
<label class="control-label text-muted" style="font-size:11px;">Ultimo movimiento del tramite</label> 
<h3><?php echo utf8_encode($ul_mov_exp['tramite']); if(!empty($ul_mov_exp['fecha'])){ echo ' desde '.format_date($ul_mov_exp['fecha']);} ?></h3>
  <?php } ?>


<h3>
<?php 

?>
</h3>
              </div>
              
              </div>
            </div></div></div>  </div>      
               <div class="row">
    <p class="titulo-bienvenida p-20">
   Movimientos del tramite
    </p>
  </div>
<div class="row justify-content-center" >
         <div class="col-10">
          <div class="card">
            <div class="card-body mx-4">              
                <div class="table-responsive">
                  <table id="all" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                      <th></th>
                        <th class='text-center' style='width: 10%;'> Fecha </th>
                        <th class='text-center' style='width: 50%;'> Ubicacion </th>
                        <th class='text-center' style='width: 10%;'> Nota </th>
                        <th class='text-center' style='width: 10%;'> Folios </th>
                        <th class='text-center' style='width: 10%;'> Norma </th>
                        <th class='text-center' style='width: 10%;'> Norma Nº </th>
                      </tr>
                    </thead>
                    <tbody>
                      
                    </tbody>
                    <tfoot>
                      <tr>
                      <th></th>
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
        <?php }  
pie(); ?>