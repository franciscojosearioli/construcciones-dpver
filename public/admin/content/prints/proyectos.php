<?php
require_once('../../includes/load.php');
$user = current_user();
$proyectos = proyectos_construcciones($user['iddepartamentos']);
  $total = conteo_proyectos_construcciones('obras','idobras');
  $total_monto_proyecto = sumar_todo('proyecto_monto','obras',1,'AND idtipo = 0');
  $total_monto_contrato = sumar_todo('contrato_monto','obras',1,'AND idtipo = 0');
cabecera_print_horizontal('Planillas de proyectos');
?>
<div class="panel-body">
<div class="row">
<div class="col-md-12">
  <center>
    <b>
      <h4>Planillas de proyectos</h4>
    </b>
  </center>
</div>
<br>
<div class="table-responsive">
      <table class="table table-border" width="100%">
        <thead>
          <tr>
            <?php if($user['idroles'] == 1 || $user['iddepartamentos'] == 6 || $user['iddepartamentos'] == 5){ ?>
              <th class="theader" style="font-size:70%;" width="10%">Nº de proyecto</th>
            <?php } ?>
              <th class="theader" style="font-size:70%;" width="10%">Titulo</th>
              <th class="theader" style="font-size:70%;" width="10%">Descripcion</th>
              <th class="theader" style="font-size:70%;" width="10%">Departamento</th>
              <th class="theader" style="font-size:70%;" width="10%">Expediente</th>
              <th class="theader" style="font-size:70%;" width="10%">Presupuesto</th>
              <th class="theader" style="font-size:70%;" width="10%">Plazo</th>
              <th class="theader" style="font-size:70%;" width="10%">Inicio del tramite</th>
              <th class="theader" style="font-size:70%;" width="10%">Ultimo movimiento</th>
              <th class="theader" style="font-size:70%;" width="10%">Estado del tramite</th>
              <th class="theader" style="font-size:70%;" width="10%">Avance del tramite</th>
          </tr>
        </thead>
        <tbody>
                  <?php foreach ($proyectos as $proyecto):
                    $inicio_exp = buscar_expediente($proyecto['expediente']);                
                    $ul_mov_exp = ul_mov_exp($proyecto['expediente']);
                    ?>
           <tr>
            <?php if($user['idroles'] == 1 || $user['iddepartamentos'] == 6 || $user['iddepartamentos'] == 5){ ?>
            <td style="font-size:60%;"><?php echo ifexist($proyecto['numero']);?></td>
          <?php } ?>
              <td style="font-size:60%;"><?php echo ifexist($proyecto['nombre']);?></td>
              <td style="font-size:60%;"><?php echo ifexist($proyecto['descripcion']); ?></td>
              <td style="font-size:60%;"><?php echo ifexist($proyecto['ubicacion']); ?></td>
              <td style="font-size:60%;"><?php echo ifexist($proyecto['expediente']); ?></td>
              <td style="font-size:60%;"><?php if(!empty($proyecto['proyecto_monto'])){ echo '$ '.numero($proyecto['proyecto_monto']);} ?></td>
              <td style="font-size:60%;"><?php echo ifexist($proyecto['proyecto_plazo']); ?></td>
              <td style="font-size:60%;"><?php if(ifexist($inicio_exp['fechareg'])){ echo format_date($inicio_exp['fechareg']);} ?></td>
              <td style="font-size:60%;"><?php if(ifexist($ul_mov_exp['fecha']) && ifexist($ul_mov_exp['tramite']) ){ echo '<b>'.format_date($ul_mov_exp['fecha']).'</b> en <b>'.$ul_mov_exp['tramite'].'</b>';} ?></td> 
                  <td style="font-size:60%;"><?php if(!isset($proyecto['estado'])){ echo 'No hay datos';} 
                      if($proyecto['estado'] == 1){ echo 'Relevando y confeccionando proyecto y pliegos';}
                      if($proyecto['estado'] == 2){ echo 'Autorizando proyecto';}
                      if($proyecto['estado'] == 3){ echo 'Visando pliegos (Encuadre legal)';}
                      if($proyecto['estado'] == 4){ echo 'Reserva preventiva';}
                      if($proyecto['estado'] == 5){ echo 'Tomado conocimiento';}
                      if($proyecto['estado'] == 6){ echo 'Conf. proyecto de resolución llamado / Desig. Comision de est. / Aprobado de res.';}
                      if($proyecto['estado'] == 7){ echo 'Cursado de invitacion y plazo de preparacion de ofertas';}
                      if($proyecto['estado'] == 8){ echo 'Apertura de ofertas y armado de expediente';}
                      if($proyecto['estado'] == 9){ echo 'Desglasando la garantia de oferta';}
                      if($proyecto['estado'] == 10){ echo 'Designacion comision de estudio y resolucion';}
                      if($proyecto['estado'] == 11){ echo 'Aprob. Res. de designacion';}
                      if($proyecto['estado'] == 12){ echo 'Comision de estudios';}
                      if($proyecto['estado'] == 13){ echo 'Reserva definitiva';}
                      if($proyecto['estado'] == 14){ echo 'Confeccionando proyecto de resolucion de adjudicacion y aprobacion';}
                      if($proyecto['estado'] == 15){ echo 'Notificacion al adjudicatario';}
                      if($proyecto['estado'] == 16){ echo 'Solicitando gtia. contractual, notif. de perdedores, devol. de gtia.';}
                      if($proyecto['estado'] == 17){ echo 'Redactando contrato';}
                      if($proyecto['estado'] == 18){ echo 'Sellando contrato';}
                      if($proyecto['estado'] == 19){ echo 'Designando inspeccion / Confeccion acta de inicio';}
                      if($proyecto['estado'] == 20){ echo 'En ejecucion';}
                      ?></td>
              <td style="font-size:60%;"><?php 
                      $porcentaje = $proyecto['estado']*100/20;
                      if(isset($proyecto['estado'])){ echo $porcentaje.' %'; } else { echo '0 %';} ?></td>
          </tr>
        <?php endforeach; ?>
        </tbody>
          <tfoot>
            <tr style="border-top:1px double #000; border-bottom: 1px solid #fff; border-left:1px solid #fff; border-right: 1px solid #fff;">
            <td colspan="3"><b>Total: <?php if($total['total'] > '1'){ echo $total['total'].' Proyectos'; }else{ echo $total['total'].' Proyecto'; } ?></b> </td>
            <td colspan="1" style="text-align:right;">Total:</td>
            <td colspan="2" > <?php echo '$ '.numero($total_monto_proyecto['total']);?></td>
            <td colspan="1" style="text-align:left;"></td>
            <td colspan="2" style="text-align:right;"></td>
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