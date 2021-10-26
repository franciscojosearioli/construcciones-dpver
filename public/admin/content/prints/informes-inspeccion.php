<?php
$id=$_GET['id'];
$results = '';
require_once('../../includes/load.php');
$obra = find_by_id('obras','idobras',$id);  
$inspeccion_de_obra = informes_inspeccion($id);   
cabecera_print_vertical('Informe de Inspeccion de obra');
?>
<div class="row">
<div class="col-md-12">
  <center>
    <b>
      <h4>Informes de inspeccion: <?php echo $obra['nombre']; ?></h4>
    </b>
  </center>
</div>
<br>
<div class="table-responsive">
      <table class="table table-border" width="100%">
        <thead>
          <tr>
              <th class="theader" style="font-size:70%;" width="10%">Nº</th>
              <th class="theader" style="font-size:70%;" width="10%">Fecha</th>
              <th class="theader" style="font-size:70%;" width="10%">Informe</th>
              <th class="theader" style="font-size:70%;" width="10%">Personal</th>
              <th class="theader" style="font-size:70%;" width="10%">Autor</th>
              <th class="theader" style="font-size:70%;" width="10%">Subido el</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($inspeccion_de_obra as $ins):?>
           <tr>
              <td style="font-size:60%;"><?php echo clean($ins['numero']); ?></td>
              <td style="font-size:60%;"><?php echo clean($ins['asunto']); ?></td>
              <td style="font-size:60%;"><?php if(isset($ins['archivo_informe'])){ echo 'Cargado'; }else{ echo 'Sin cargar'; }  ?></td>
              <td style="font-size:60%;"><?php if(isset($ins['archivo_personal'])){ echo 'Cargado'; }else{ echo 'Sin cargar'; }  ?></td>
              <td style="font-size:60%;"><?php echo user_name($ins['registro_usuario']); ?></td>
              <td style="font-size:60%;"><?php echo format_date($ins['registro_fecha']); ?></td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
  </div>
  </div>
</body>
</html>