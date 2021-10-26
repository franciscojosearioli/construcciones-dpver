<?php
require_once('../../includes/load.php');
$user = current_user();
$relevamientos = relevamientos_construcciones($user['iddepartamentos']);
  $total = conteo_id_activos('relevamientos','idrelevamientos');
cabecera_print_horizontal('Planillas de relevamientos');
?>
<div class="panel-body">
<div class="row">
<div class="col-md-12">
  <center>
    <b>
      <h4>Planillas de relevamientos</h4>
    </b>
  </center>
</div>
<br>
<div class="table-responsive">
      <table class="table table-border" width="100%">
        <thead>
          <tr>
              <th class="theader" style="font-size:70%;" width="10%">Expediente</th>
              <th class="theader" style="font-size:70%;" width="10%">Nota</th>
              <th class="theader" style="font-size:70%;" width="10%">Titulo</th>
              <th class="theader" style="font-size:70%;" width="10%">Ubicacion</th>
              <th class="theader" style="font-size:70%;" width="10%">Archivo</th>
          </tr>
        </thead>
        <tbody>
                  <?php foreach ($relevamientos as $relevamiento): ?>
           <tr>
              <td style="font-size:60%;"><?php echo ifexist($relevamiento['expediente']);?></td>
              <td style="font-size:60%;"><?php echo ifexist($relevamiento['nota']); ?></td>
              <td style="font-size:60%;"><?php echo ifexist($relevamiento['nombre']); ?></td>
              <td style="font-size:60%;"><?php echo ifexist($relevamiento['ubicacion']); ?></td>
              <td style="font-size:60%;"><?php if(!empty($relevamiento['archivo'])){ echo 'Subido'; }else{ echo 'Sin cargar';} ?></td>
          </tr>
        <?php endforeach; ?>
        </tbody>
          <tfoot>
            <tr style="border-top:1px double #000; border-bottom: 1px solid #fff; border-left:1px solid #fff; border-right: 1px solid #fff;">
            <td colspan="5"><b>Total: <?php if($total['total'] > '1'){ echo $total['total'].' Relevamientos'; }else{ echo $total['total'].' Relevamiento'; } ?></b> </td>
          </tr>
        </tfoot>
      </table>
  </div>
</div>
</div>
</div>
</div>
</body>
</html>