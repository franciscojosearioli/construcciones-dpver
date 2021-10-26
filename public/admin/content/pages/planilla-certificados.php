<?php
require_once('../../includes/load.php');
$user = current_user();
$aprobados = all_certificados_obras();
$redeterminados = all_certificados_redeterminados_obras();
cabecera('Certificados de obras');
?>

<style type="text/css">
table {
  display: block;
  overflow-x: auto;
}

.static {
  position: absolute;
  background-color: white;
}

.first-col {
  padding-left: 74.5px!important;
  width: 100%;
}


</style>
      <div class="row">
        <div class="col-lg-12">
          <?php echo display_msg($msg); ?>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
              <div class="col-12">
                                        <div class="d-flex flex-wrap margin-dt">
                                            <div>
                                                <h3 class="card-title">Certificados en desarrollo</h3>
                                                <!--<h6 class="card-subtitle">Espere unos minutos hasta que cargue la planilla.</h6>
                                                <h6 class="card-subtitle">Deslice la planilla para ver mas información.</h6>-->
                                            </div>
                                        </div>
      <div class="table-responsive">
        <?php $year =  date('Y'); ?>
<table class="table">
  

<!--AÑO-->
  <tr>
  <th class="static"></th>
  <th class="first-col"></th>
  <th axis="year" class="text-center" colspan="36">2020</th>
  </tr>





<!--MESES-->    
  <tr>

    <th class="static"></th>
    <th class="first-col"></th>
    <th axis="month" class="text-center"  colspan="3">Enero</th>
    <th axis="month" class="text-center"  colspan="3">Febrero</th>
    <th axis="month" class="text-center"  colspan="3">Marzo</th>
    <th axis="month" class="text-center"  colspan="3">Abril</th>
    <th axis="month" class="text-center"  colspan="3">Mayo</th>
    <th axis="month" class="text-center"  colspan="3">Junio</th>
    <th axis="month" class="text-center"  colspan="3">Julio</th>
    <th axis="month" class="text-center"  colspan="3">Agosto</th>
    <th axis="month" class="text-center"  colspan="3">Septiembre</th>
    <th axis="month" class="text-center"  colspan="3">Octubre</th>
    <th axis="month" class="text-center"  colspan="3">Noviembre</th>
    <th axis="month" class="text-center"  colspan="3">Diciembre</th>
  </tr>

  <tr>
<td class="static">Caja</td>
<td class="first-col">Obra</td>

<!--Enero--> 
    <td axis="enero">CO</td>
    <td axis="enero">CP</td>
    <td axis="enero">CD</td>

<!--Febrero-->
    <td axis="co">CO</td>
    <td axis="CP">CP</td>
    <td axis="cd">CD</td>

 <!--Marzo-->

    <td axis="co">CO</td>
    <td axis="CP">CP</td>
    <td axis="cd">CD</td>

<!--Abril-->
    <td axis="co">CO</td>
    <td axis="CP">CP</td>
    <td axis="cd">CD</td>

<!--Mayo-->
    <td axis="co">CO</td>
    <td axis="CP">CP</td>
    <td axis="cd">CD</td>

<!--Junio-->
    <td axis="co">CO</td>
    <td axis="CP">CP</td>
    <td axis="cd">CD</td>

<!--Julio-->
    <td axis="co">CO</td>
    <td axis="CP">CP</td>
    <td axis="cd">CD</td>

<!--Agosto-->
    <td axis="co">CO</td>
    <td axis="CP">CP</td>
    <td axis="cd">CD</td>

<!--Septiembre-->
    <td axis="co">CO</td>
    <td axis="CP">CP</td>
    <td axis="cd">CD</td>

<!--Octubre-->
    <td axis="co">CO</td>
    <td axis="CP">CP</td>
    <td axis="cd">CD</td>

<!--Noviembre-->
    <td axis="co">CO</td>
    <td axis="CP">CP</td>
    <td axis="cd">CD</td>   

<!--Diciembre-->
    <td axis="co">CO</td>
    <td axis="CP">CP</td>
    <td axis="cd">CD</td> 
  </tr>





    <?php 
    $obras = obras_construcciones($user['iddepartamentos']);
    foreach($obras as $obra): ?>
  <tr>

    <td class="static"><?php echo $obra['numero'] ?></td>
    <td class="first-col"><?php echo $obra['nombre'] ?></td>
   <?php  $detalles = obras_construcciones($user['iddepartamentos']);
    foreach($detalles as $detalle): ?>
<!--Enero-->
    <td class="w-5" axis="co">v</td>
    <td class="w-5" axis="CP">x</td>
    <td class="w-5" axis="cd">x</td>   


<!--Febrero-->
    <td class="w-5" axis="co">v</td>
    <td class="w-5" axis="CP">x</td>
    <td class="w-5" axis="cd">x</td>


<!--Marzo-->
    <td class="w-5" axis="co">v</td>
    <td class="w-5" axis="CP">x</td>
    <td class="w-5" axis="cd">x</td>

<!--Abril-->
    <td class="w-5" axis="co">v</td>
    <td class="w-5" axis="CP">x</td>
    <td class="w-5" axis="cd">x</td>

<!--Mayo-->
    <td class="w-5" axis="co">v</td>
    <td class="w-5" axis="CP">x</td>
    <td class="w-5" axis="cd">x</td>

<!--Junio-->
    <td class="w-5" axis="co">v</td>
    <td class="w-5" axis="CP">x</td>
    <td class="w-5" axis="cd">x</td>

<!--Julio-->
    <td class="w-5" axis="co">v</td>
    <td class="w-5" axis="CP">x</td>
    <td class="w-5" axis="cd">x</td>

<!--Agosto-->
    <td class="w-5" axis="co">v</td>
    <td class="w-5" axis="CP">x</td>
    <td class="w-5" axis="cd">x</td>

<!--Septiembre-->
    <td class="w-5" axis="co">v</td>
    <td class="w-5" axis="CP">x</td>
    <td class="w-5" axis="cd">x</td>

<!--Octubre-->
    <td class="w-5" axis="co">v</td>
    <td class="w-5" axis="CP">x</td>
    <td class="w-5" axis="cd">x</td>

<!--Noviembre-->
    <td class="w-5" axis="co">v</td>
    <td class="w-5" axis="CP">x</td>
    <td class="w-5" axis="cd">x</td>

<!--Diciembre-->
    <td class="w-5" axis="co">v</td>
    <td class="w-5" axis="CP">x</td>
    <td class="w-5" axis="cd">x</td>
<?php endforeach; ?>  
  </tr>
<?php endforeach; ?>  
</table>
    </div>
  </div>
</div>
</div>
</div>
  <?php 
  pie(); ?>




  