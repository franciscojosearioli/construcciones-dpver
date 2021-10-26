<?php
require_once('../../includes/load.php');
$exp = $_POST['numero'];
if(!empty($exp)){ 
$inicio_exp = buscar_expediente($exp);
$pases_expediente = pases_expediente($exp);
cabecera('Movimientos del expediente N: '.$inicio_exp['numero']);
if(!empty($inicio_exp)){
?>                       <div class="row">
    <p class="titulo-bienvenida p-20">
   Tramite
    </p>
  </div>
     <div class="row justify-content-center" >
         <div class="col-lg-7 col-md-7 col-sm-12">
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

              </div>
              

              </div>

            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12">
        <div class="card">
            <div class="card-body mx-4 text-center">
            <form method="post" action="consultas"> 
<div><button type="submit" class="btn-sm" style="border: 1px solid #000;background: none;margin-bottom:15px;">Nueva consulta</button> </div>
<i class='ti-search'></i> <input type="number" name="numero" style="background: #fff;width:100px;height:20px;min-height:20px; border:none;" class="form-control" autocomplete="off" value="<?php echo $exp; ?>" required>

</form>  
            </div>
          </div>
            
          <div class="row">
    <p class="titulo-bienvenida p-20">
   Injerencias en tramite
    </p>
  </div>
  <div class="card">
            <div class="card-body mx-4">
<label class="control-label text-muted" style="font-size:11px;">Adjunto al tramite</label> 
<h3>N ___ el ___</h3>
<label class="control-label text-muted" style="font-size:11px;">Desgloso al tramite</label> 
<h3>N ___ el ___</h3>
            </div>
          </div>
</div>
      
      </div>      
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
                      <?php foreach ($pases_expediente as $pases_exp): ?>
                        <tr>
                        <td></td>
                          <td><b><?php echo format_date($pases_exp['fecha']); ?></b></td>
                          <td><b><?php echo utf8_encode($pases_exp['tramite']); ?></b></td>
                          <td><b><?php echo utf8_encode($pases_exp['nota']); ?></b></td>
                          <td><b><?php echo utf8_encode($pases_exp['nfolios']); ?></b></td>
                          <td><b><?php echo utf8_encode($pases_exp['norma_tipo']); ?></b></td>
                          <td><center><b><?php echo utf8_encode($pases_exp['norma_nro']); ?></b></center></td>
                        </tr>
                      <?php endforeach; ?>
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
        <?php }else{ ?>  
            <div class="row justify-content-center">
         <div class="col-8">
              <div class="d-flex flex-wrap p-b-30">
              <div class="my-auto ml-3">
              <form method="post" action="consultas"> 
              <span title="Agregar nuevo" data-toggle="tooltip" class="btn-light" style="display: inline-block;font-weight: 400;text-align: center;vertical-align: middle;-webkit-user-select: none;-moz-user-select: none;  -ms-user-select: none;  user-select: none;  border: 1px solid transparent; padding: .5rem .75rem;  font-size: 1rem;  line-height: 1.25;  border-radius: .25rem;  transition: all .15s ease-in-out; padding: 7px 12px; font-size: 14px; cursor: pointer;">
              Consultar movimientos del expediente N:
              <input type="number" name="numero" style="background: #f0f0f0;width:120px;height:20px;min-height:20px; " class="form-control" autocomplete="off" value="<?php echo $exp; ?>" required>
              <button type="submit" class="btn-sm" style="border: none;background: none;"><i class='ti-search'></i></button>
              </span>
              </form>
              </div>
              <div class="ml-auto my-auto mr-3">
              <a href="javascript:history.back();" title="Volver a la pagina anterior" data-toggle="tooltip" class="btn btn-light"><i class="ti-back-left"></i> Volver a la pagina anterior</a>
              </div>
              </div>
              </div>
         </div>
            <div class="row justify-content-center">
         <div class="col-10">
          <div class="card">
            <div class="card-body">
              <div class="row">
              <div class="col-12">
                <div class="card-body cards-titulo">
              <div class="d-flex flex-wrap">
              <div class="my-auto ml-3">
                <p>El expediente no existe o aun no se han actualizado los datos, en este caso debe esperar y se vera actualizado en las proximas horas, por favor vuelva a intentarlo.</p>
              </div>
            </div>
            </div>
            </div>
          </div>
        </div>             
        </div>
          </div>
        </div>   
          <?php } }
pie(); ?>