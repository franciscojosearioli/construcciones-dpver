<?php
require_once('../../includes/load.php');
require_once('../../includes/functions/obras.php');
$user = current_user();
$obras_construcciones = obras_contratadas();
cabecera('Informes de Obras');
?>
<div  id="listar_obras">
<div class="row justify-content-center">
         <div class="col-10">
              <div class="d-flex flex-wrap p-b-30">
              <div class="my-auto ml-3">
              
                  <h1 class="titulo-bienvenida">Informes de Obras</h1>
              </div>
              <div class="ml-auto my-auto mr-3">
<?php if(permiso('admin') || permiso('obras')){ ?>
             <a id="btn_agregar" onclick="form_agregar(true)" title="Agregar nuevo" data-toggle="tooltip" class="btn btn-warning btn-rounded btn-light"><i class="fas fa-plus"></i> Cargar nuevo</a>
                  <?php } ?>
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

            <!--<div class="card-body cards-titulo">
              <div class="d-flex flex-wrap">
                <div class="my-auto ml-3">
                  <p style="font-size:12px;font-weight:400;">Para consultar un informe de obra ingrese el titulo o alias, o numero de expediente y haga click en la opcion </p>
                  <span class="btn-light" style="display: inline-block;font-weight: 400;vertical-align: middle;-webkit-user-select: none;-moz-user-select: none;  -ms-user-select: none;  user-select: none;  border: 1px solid transparent; padding: .5rem .75rem;  font-size: 1rem;  line-height: 1.25;  border-radius: .25rem;  transition: all .15s ease-in-out; padding: 7px 12px; font-size: 14px; cursor: pointer;">
              <input type="search" style="background:#f0f0f0;width:350px;height:20px;min-height:20px;" class="form-control" aria-controls="1" id="busqueda">
              </span>
                </div>
                
              </div>
            </div>-->
            <div class="table-responsive" style="font-size: 11px;">
              <table id="all" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0"
                width="100%">
                <thead>
                  <tr>
                    <th></th>
                    <th class="text-center"> </th>
                    <th class="text-center"> Caja </th>
                    <th> Titulo de obra </th>
                    <th class="text-center"> Expediente </th>
                    <th class="text-center"> Estado </th>
                    <th class="text-center"> Avance de obra </th>
                    <!--<th class="text-center"> Ultimo certificado </th>-->
                    <th class="text-center"> Firma contrato </th>
                    <th class="text-center"> Acta de inicio </th>
                    <th class="text-center"> Monto vigente </th>
                    <th class="text-center"> Plazo vigente </th>
                    <th class="text-center"> Monto redeterminado </th>
                    <th class="text-center"> Redeterminacion </th>
                    <!--<th class="text-center"> Modificaciones </th>
         <th class="text-center"> Ampliaciones </th>
         <th class="text-center"> Neutralizaciones </th>-->
                    <th> Descripcion </th>
                    <th> Ubicacion </th>
                    <th class="text-center"> Contratista </th>
                    <?php if(permiso('admin') || permiso('obras')){ ?>
                    <th class="text-center"> Observaciones </th>
                    <?php } ?>
                  </tr>
                </thead>
                <tbody>
  <?php 
  foreach ($obras_construcciones as $obra):
  $modificaciones_de_obra =  modificaciones_de_obra($obra['idobras']);
  $ampliaciones_de_obra =  ampliaciones_de_obra($obra['idobras']);
  $neutralizaciones_de_obra =  neutralizaciones_de_obra($obra['idobras']);
  $ver_id=(int)$obra['idobras']; 
  ?>
                  <tr>
                    <td class="w-5"></td>
                    <td>
                      <a class="i-dt-list" href="obra?id=<?php echo (int)$obra['idobras'];?>" data-toggle="tooltip"
                        title="Ver informe de obra"><i class="fa fa-info"></i></a>

                        <a class="i-dt-list"
                        href="content/prints/informe-tecnico-obra.php?id=<?php echo $obra['idobras'] ?>" target="_blank"
                        data-toggle="tooltip" title="Imprimir"><i class="fas fa-print"></i></a>
                        <a class="i-dt-list"
                        href="content/prints/informe-tecnico-obra-doc.php?id=<?php echo $obra['idobras'] ?>" target="_blank"
                        data-toggle="tooltip" title="Descargar"><i class="fas fa-file-download"></i></a>
                      <?php if(permiso('admin') || permiso('obras')){ ?>
                      <!--<a class="i-dt-list" href="includes/functions/archivar.php?id=<?php echo (int)$obra['idobras'];?>&url=obras&tipo=obra" data-toggle="tooltip" title="Archivar" style="color:#1e88e5"><i class="mdi mdi-close"></i></a>-->
                      
                      <?php } ?>


                    </td>
                    <td class="text-center">
                      <?php if($obra['numero'] != 0){ echo ifexist($obra['numero']);} ?>
                    </td>

                    <td>
                      <?php if(!empty($obra['alias'])){ echo $obra['alias']; }else{ echo wordwrap($obra['nombre'], 40, "<br>" ,false);} ?>
                    <?php if(permiso('admin') || permiso('obras')){ ?><a class="i-dt-list" onclick="alias_obra(<?php echo (int)$obra['idobras']; ?>)"
                        data-toggle="tooltip" title="Modificar alias" style="color:#848484;font-size:11px;"><i class="fa fa-pen"></i></a>
                    
                    <?php } ?>
                    </td>
                    <td class="text-center">
                      <?php echo ifexist($obra['expediente']); ?>
                    </td>

                    <td class="text-center">
                      <?php 
           if($obra['estado'] == 6){ echo 'A iniciar'; }
           if($obra['estado'] == 0){ echo 'En ejecucion'; }
           if($obra['estado'] == 3 && $obra['recepcion'] == 0){ echo 'Finalizada sin recibir'; }
           if($obra['estado'] == 3 && $obra['recepcion'] == 1){ echo 'En garantia'; }
           if($obra['estado'] == 3 && $obra['recepcion'] == 2){ echo 'Finalizada definitiva'; }
           if($obra['estado'] == 4){ echo 'Neutralizada'; }
           if($obra['estado'] == 5){ echo 'Rescindida'; } ?>
                    </td>
                    <td class="text-center">
                      <?php if(ifexist($obra['certificado_porcentaje'])){ echo $obra['certificado_porcentaje'].' %'; } ?>
                    </td>
                    <!--<td class="text-center">
                      <?php if(ifexist($obra['certificado_numero'])){ echo 'Nº '.$obra['certificado_numero'].' a '.$obra['certificado_fecha'];}?>
                    </td>-->
                    <td class="text-center">
                      <?php echo ifdate($obra['contrato_fecha']); ?>
                    </td>
                    <td class="text-center">
                      <?php echo ifdate($obra['fecha_inicio']); ?>
                    </td>
                    <td class="text-center">
                      <?php 
           if(ifexist($obra['monto_vigente'])){ echo '$ '.numero($obra['monto_vigente']);
         }elseif(ifexist($obra['contrato_monto'])){
           echo '$ '.numero($obra['contrato_monto']);} 
           ?>
                    </td>
                    <td class="text-center">
                      <?php echo ifexist($obra['plazo_vigente']); ?>
                    </td>
                    <td class="text-center">
                      <?php if(ifexist($obra['monto_redeterminado'])){ echo '$ '.numero($obra['monto_redeterminado']); } ?>
                    </td>
                    <td class="text-center">
                      <?php echo ifexist($obra['info_redeterminacion']); ?>
                    </td>
                    <!--<td><?php if($modificaciones_de_obra > 0 ){
             foreach($modificaciones_de_obra as $mo):
               echo $mo['numero'].' ';
             endforeach; }else{ echo 'Sin tramitar';} ?></td>
           <td><?php if($ampliacioness_de_obra > 0 ){
             foreach($ampliaciones_de_obra as $ao):
               echo $ao['numero'].' ';
             endforeach; }else{ echo 'Sin tramitar';} ?></td>
           <td><?php if($neutralizaciones_de_obra > 0 ){
             foreach($neutralizaciones_de_obra as $no):
               echo $no['numero'].' ';
             endforeach; }else{ echo 'Sin tramitar';} ?></td>-->
                    <td>
                      <?php echo wordwrap(ifexist($obra['descripcion']), 40, "<br>" ,false); ?>
                    </td>
                    <td>
                      <?php echo ifexist($obra['ubicacion']); ?>
                    </td>
                    <td>
                      <?php echo ifexist($obra['contratista']); ?>
                    </td>

                    <?php if(permiso('admin') || permiso('obras')){ ?>
                    <td>
                      <?php echo wordwrap(substr(ifexist($obra['observaciones']), 0, 50), 40, "<br>" ,false).'...'; ?>
                    </td>
                    <?php } ?>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th></th>
                    <th class="text-center"> </th>
                    <th class="text-center"> Caja </th>
                    <th> Titulo </th>
                    <th class="text-center"> Expediente </th>
                    <th class="text-center"> Estado </th>
                    <th class="text-center"> Avance de obra </th>
                    <!--<th class="text-center"> Ultimo certificado </th>-->
                    <th class="text-center"> Firma contrato </th>
                    <th class="text-center"> Acta de inicio </th>
                    <th class="text-center"> Monto vigente </th>
                    <th class="text-center"> Plazo vigente </th>
                    <th class="text-center"> Monto redeterminado </th>
                    <th class="text-center"> Redeterminacion </th>
                    <!--<th class="text-center"> Modificaciones </th>
         <th class="text-center"> Ampliaciones </th>
         <th class="text-center"> Neutralizaciones </th>-->
                    <th> Descripcion </th>
                    <th> Ubicacion </th>
                    <th class="text-center"> Contratista </th>
                    <?php if(permiso('admin') || permiso('obras')){ ?>
                    <th class="text-center"> Observaciones </th>
                    <?php } ?>
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
</div>
<div id="alias_obra_ver"></div>
<script type="text/javascript" src="includes/ajax/scripts/obras.js"></script>

<?php 
//require_once('../modals/add_obra.php');
require_once('../forms/agregar_obra.php');
pie(); ?>