<?php
require_once('../../includes/load.php');
$user = current_user();
$informes_inspeccion = all_informes_inspeccion();
cabecera('Informes de inspeccion');
$ultimos_informes = ultimos_valores_tabla('informes_inspeccion','','idinformes_inspeccion','10');
?>

<?php if(!empty($ultimos_informes)){ ?> 
<div class="row justify-content-center">
<div class="col-10">
<h3 class="titulo-bienvenida">Ultimos informes </h3><br>
</div></div>
<div class="row justify-content-center">
<div class="col-10">
<div class="owl-carousel informes-inspeccion">
<!-- inic ITEM -->
<?php 
foreach($ultimos_informes as $row): 
$obra = find_by_id('obras','idobras',$row['idobras']);  ?>
<div class="card"  style="border: 1px solid #00000040;height:100%;"> 
<div class="card-body mx-2">
<p>  INFORMES <?php if($row['numero'] != 0){ echo 'N° '.$row['numero']; } ?></p>
<?php if(isset($row['archivo'])){ echo '<p><a class="event-title" href="../uploads/Obras/'.$obra['idobras'].'/Inspeccion/Informes/'.$row['numero'].'/'.$row['archivo'].'" target="_blank">Ver informe de progreso</a></p>'; } ?>
<?php if(isset($row['archivo_personal'])){ '<a class="event-title" href="../uploads/Obras/'.$obra['idobras'].'/Inspeccion/Asistencias/'.$row['numero'].'/'.$row['archivo'].'" target="_blank">Planilla de asistencia mensual de personal</a><br>'; } ?>
</div>
<div class="card-footer">
  <p>OBRA: <?php echo substr(ifexist($obra['nombre']), 0, 40).'...'; ?></p>
  <p>EXPEDIENTE: <?php echo $obra['expediente']; ?></p>
  <p>N CAJA: <?php echo $obra['numero']; ?></p>
<a href="obra?id=<?php echo $row['idobras']; ?>" target="_blank" class="event-title">Ver informe de obra</a>
</div>
</div>
<?php endforeach; ?>
<!-- fin item -->
</div>
</div>
</div>
<?php } ?>

<div class="row justify-content-center">
<div class="col-10">
<h3 class="titulo-bienvenida">Informes de progreso mensual de obras</h3><br>
</div></div>

         <div class="row justify-content-center">
         <div class="col-10">
          <div class="card">
            <div class="card-body">
              <div class="row">
              <div class="col-12">
            <div class="table-responsive">
              <table id="listar_informes_inspeccion" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th></th>
                    <th class="text-center" > Certificado </th>
                    <th class="text-center" > Fecha de informe </th>
                    <th class="text-center" > Obra </th>
                    <th class="text-center" > Planilla de Computo </th>
                    <th class="text-center" > Planilla de Asistencia </th>
                  </tr>
                </thead>

                <tfoot>
                  <tr>
                    <th></th>
                    <th class="text-center" > Certificado </th>
                    <th class="text-center" > Fecha de informe </th>
                    <th class="text-center" > Obra </th>
                    <th class="text-center" > Planilla de Computo </th>
                    <th class="text-center" > Planilla de Asistencia </th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>    
    </div>
  </div>
</div>
    <script type="text/javascript" src="includes/ajax/scripts/informes_inspeccion.js"></script>
    <?php 
    pie(); ?>