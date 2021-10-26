<?php
require_once('../../includes/load.php');
require_once('../../includes/functions/obras.php');
$user = current_user();
$obras_construcciones = obras_ejecucion_activas($user['iddireccion'],$user['iddepartamentos']);
cabecera('Obras en ejecución');
?>
<div class="row">
  <div class="col-lg-12">
    <?php echo display_msg($msg); ?>
  </div>
</div>

<div class="row justify-content-md-center">
<div class="col-lg-4 col-md-6 col-sm-12">

<div class="card" style="height:180px;">
<div class="header pt-2 b-header">
<div class="row d-flex justify-content-start">
<h5 class="deep-grey-text mx-5">EXPEDIENTES</h5>
</div>
</div>
<div class="card-body mx-4" >  

<form method="post" action="consultas">
<div class="row">
<div class="col-12">Ingrese un numero de expediente para ver todos sus movimientos
<div class="form-group">
<div class="input-group">
<input type="number" name="numero" style="background: #f0f0f0" class="form-control" autocomplete="off" placeholder="" required>
<div class="input-group-addon">
<button type="submit" class="btn-sm" style="border: none;background: none;"><i class='ti-search'></i></button>
</div>
</div>
</div>
</div>
</div>
</form>

</div>
</div>
</div>
<div class="col-lg-4 col-md-6 col-sm-12">
<div class="card" style="height:180px;">
<div class="header pt-2 b-header">
<div class="row d-flex justify-content-start">
<h5 class="deep-grey-text mx-5">OBRAS</h5>
</div>
</div>
<div class="card-body mx-4">  



<div class="row">
<div class="col-12">Escriba el nombre de la obra y seleccione el titulo
<div class="form-group">
<input type="search" style="background: #f0f0f0" class="form-control" aria-controls="1" id="busqueda">

</div>
</div>
</div>



</div>
</div>    

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
                <h3 class="card-title">Listado de obras activas</h3>
                <h6 class="card-subtitle">Espere unos minutos hasta que cargue la planilla.</h6>
                <h6 class="card-subtitle">Deslice la planilla para ver mas información.</h6>
              </div>
              <div class="ml-auto">
                <ul class="list-inline">
                  <?php if(permiso('admin') || permiso('obras')){ ?>
                    <li>
                      <h6 class="text-muted"><a class="dropdown-item a-icon" data-toggle="modal" data-target="#add_obra" title="Agregar nuevo"><i class="fas fa-plus fa-2x"></i></a></h6>  
                    </li>
                  <?php } ?>
                  <li>
                    <h6 class="text-muted">                <ul class="nav navbar-nav nav-flex-icons float-right">
                      <li class="nav-item dropdown">
                        <a id="navbarDropdownMenuLink-333" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="fas fa-print fa-2x"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right dropdown-default" aria-labelledby="navbarDropdownMenuLink-333">
                        <a title="Imprimir" class="dropdown-item" href="content/prints/obras-ejecucion.php" target="_blank">Imprimir: Ejecucion</a>
                        <a title="Imprimir" class="dropdown-item" href="content/prints/obras-finalizadas.php" target="_blank">Imprimir: Finalizadas</a>
                        <a title="Imprimir" class="dropdown-item" href="content/prints/obras.php" target="_blank">Imprimir: Todas</a>
                      </div>
                    </li>  
                  </ul>
                </h6>
              </li>
            </ul>
          </div>
        </div>
        <div class="table-responsive" style="font-size: 11px;">
          <table id="all" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th></th>
                <th class="text-center">  </th>
                <th class="text-center"> Nº </th>
              <?php if(permiso('admin') || permiso('obras')){ ?>
                 <th> Alias </th>
              <?php } ?>
                <th> Titulo </th>
                <th class="text-center"> Expediente </th>
                <th class="text-center"> Acta de inicio </th>
                <th class="text-center"> Plazo vigente </th>
                <th class="text-center"> Finalizacion aproximada </th>
                <th class="text-center"> Ampliaciones </th>
                <th class="text-center"> Monto vigente </th>
                <th class="text-center"> Modificaciones </th>
                <th class="text-center"> Monto redeterminado </th>
                <th class="text-center"> Redeterminacion </th>
                <th class="text-center"> Avance </th>
                <th class="text-center"> Ultimo certificado </th>
                <th class="text-center"> Neutralizaciones </th>
                <th class="text-center"> Presupuesto oficial </th>
                <th class="text-center"> Monto contrato </th>

                <th> Ubicacion </th>
                <th class="text-center"> Contratista </th>
                <th class="text-center"> Observaciones </th>
                <th class="text-center"> Estado </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($obras_construcciones as $obra):
    $modificaciones_de_obra =  modificaciones_de_obra($obra['idobras']);
    $ampliaciones_de_obra =  ampliaciones_de_obra($obra['idobras']);
    $neutralizaciones_de_obra =  neutralizaciones_de_obra($obra['idobras']);
                $ver_id=(int)$obra['idobras']; ?>
                <tr>
                  <td class="w-5"></td>
                  <td>
                    <a class="i-dt-list" href="obra?id=<?php echo (int)$obra['idobras'];?>" data-toggle="tooltip" title="Ver informe" style="color:#1e88e5"><i class="mdi mdi-information-variant"></i></a>



                    <a class="i-dt-list" href="includes/windows/imprimir_informe.php?id=<?php echo $obra['idobras'] ?>" target="_blank" data-toggle="tooltip" title="Imprimir" onclick="window.open(this.href, this.target, 'width=600,height=500'); return false;" style="color:#1e88e5"><i class="mdi mdi-printer"></i></a>



                    <?php if(permiso('admin') || permiso('obras')){ ?>
                      <a class="i-dt-list" href="includes/functions/archivar.php?id=<?php echo (int)$obra['idobras'];?>&url=obras&tipo=obra" data-toggle="tooltip" title="Archivar" style="color:#1e88e5"><i class="mdi mdi-close"></i></a>
                    <?php } ?>

                    <a class="i-dt-list" onclick="alias_obra(<?php echo (int)$obra['idobras']; ?>)" data-toggle="tooltip" title="Alias" style="color:#1e88e5"><i class="mdi mdi-alert-box"></i></a>
                  </td>
                  <td class="text-center"><?php if($obra['numero'] != 0){ echo ifexist($obra['numero']);} ?></td>
                  <?php if(permiso('admin') || permiso('obras')){ ?>
                  <td><?php echo ifexist($obra['nombre']); ?></td>
                <?php }else{ ?>
                  <td><?php echo ifexist($obra['alias']); ?></td>
                <?php } ?>
                  <td class="text-center"><?php echo ifexist($obra['expediente']); ?></td>
                  <td class="text-center"><?php echo ifdate($obra['fecha_inicio']); ?></td>

                  <td class="text-center"><?php echo ifexist($obra['plazo_vigente']); ?></td>

                  <td class="text-center"><?php echo ifdate($obra['fecha_fin']); ?></td>
                  <td><?php if($ampliacioness_de_obra > 0 ){
                    foreach($ampliaciones_de_obra as $ao):
                      echo $ao['numero'].' ';
                    endforeach; }else{ echo 'Sin tramitar';} ?></td>
                  <td class="text-center"><?php 
                  if(ifexist($obra['monto_vigente'])){ echo '$ '.numero($obra['monto_vigente']);
                }elseif(ifexist($obra['contrato_monto'])){
                  echo '$ '.numero($obra['contrato_monto']);} 
                  ?></td>
                  <td><?php if($modificaciones_de_obra > 0 ){
                    foreach($modificaciones_de_obra as $mo):
                      echo $mo['numero'].' ';
                    endforeach; }else{ echo 'Sin tramitar';} ?></td>
                  <td class="text-center"><?php if(ifexist($obra['monto_redeterminado'])){ echo '$ '.numero($obra['monto_redeterminado']); } ?></td>
                  <td class="text-center"><?php echo ifexist($obra['info_redeterminacion']); ?></td>
                  <td class="text-center"><?php if(ifexist($obra['certificado_numero'])){ echo $obra['certificado_porcentaje'].' %'; } ?></td>
                  <td class="text-center"><?php if(ifexist($obra['certificado_numero'])){ echo 'Nº '.$obra['certificado_numero'].' a '.$obra['certificado_fecha'];}?></td>
                  
                  
                  <td><?php if($neutralizaciones_de_obra > 0 ){
                    foreach($neutralizaciones_de_obra as $no):
                      echo $no['numero'].' ';
                    endforeach; }else{ echo 'Sin tramitar';} ?></td>
<td><?php echo '$ '.numero($obra['proyecto_monto']); 
if(!empty($obra['proyecto_monto_fecha'])){ echo ' ('.$obra['proyecto_monto_fecha'].')'; }?></td>
<td><?php echo '$ '.numero($obra['contrato_monto']); ?></td>
                  <td><?php echo ifexist($obra['ubicacion']); ?></td>
                  <td class="text-center"><?php echo ifexist($obra['contratista']); ?></td>
                  <td><?php echo $obra['observaciones']; ?></td>
                  <td class="text-center"><?php 
                  if($obra['estado'] == 0){ echo 'En ejecucion'; }
                  if($obra['estado'] == 3 && $obra['recepcion'] == 0){ echo 'Finalizada sin recibir'; }
                  if($obra['estado'] == 3 && $obra['recepcion'] == 1){ echo 'En garantia'; }
                  if($obra['estado'] == 3 && $obra['recepcion'] == 2){ echo 'Finalizada definitiva'; }
                  if($obra['estado'] == 4){ echo 'Neutralizada'; }
                  if($obra['estado'] == 5){ echo 'Rescindida'; } ?></td>
              </tr>   
            <?php endforeach; ?>
          </tbody>
          <tfoot>
            <tr>
                <th></th>
                <th class="text-center">  </th>
                <th class="text-center"> Nº </th>
                <?php if(!permiso('admin')){ ?>
                <th> Titulo </th>
              <?php }else{ ?>
                 <th> Alias </th>
                <?php } ?>
                <th class="text-center"> Expediente </th>
                <th class="text-center"> Acta de inicio </th>
                <th class="text-center"> Plazo vigente </th>
                <th class="text-center"> Finalizacion aproximada </th>
                <th class="text-center"> Ampliaciones </th>
                <th class="text-center"> Monto vigente </th>
                <th class="text-center"> Modificaciones </th>
                <th class="text-center"> Monto redeterminado </th>
                <th class="text-center"> Redeterminacion </th>
                <th class="text-center"> Avance </th>
                <th class="text-center"> Ultimo certificado </th>
                <th class="text-center"> Neutralizaciones </th>
                <th class="text-center"> Presupuesto oficial </th>
                <th class="text-center"> Monto contrato </th>

                <th> Ubicacion </th>
                <th class="text-center"> Contratista </th>
                <th class="text-center"> Observaciones </th>
                <th class="text-center"> Estado </th>
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

<div id="alias_obra_ver"></div>
<script type="text/javascript" src="includes/ajax/scripts/obras.js"></script>
<?php 
require_once('../modals/add_obra.php');
pie(); ?>