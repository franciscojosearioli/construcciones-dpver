<?php
require_once('../../includes/load.php');
$obra_id=$_GET['id'];
$user = current_user();
$obra = find_by_id('obras','idobras',(int)$_GET['id']);  
if($obra['estado'] == 1){ redirect('proyecto?id='.$obra_id, false); }
require_once('../../includes/functions/obras.php');  
require_once('../../includes/functions/certificados.php');  
require_once('../../includes/functions/php_file_tree.php');   
require_once("../../includes/functions/map.php"); 
require_once('../../../uploads/files.php'); 
$ejecutados = obras_construcciones($user['iddepartamentos']);
$certificados = certificados_obras($obra_id);
$certificados_plan = plan_oficial_obras($obra_id);
$certificados_adec = certificados_redeterminados_obras($obra_id);
$certificados_multa = plan_oficial_obras($obra_id);
$ordenes = ordenes_de_servicio($obra_id);
$notas = notas_de_pedido($obra_id);
$all_user = all_usuarios();
$obra_bacheo = obra_bacheo($obra_id);
$inspeccion_informe = informes_inspeccion($obra_id);   
$inspeccion_asistencia = asistencias_inspeccion($obra_id);  
$inspectores = all_inspectores();
$mapa_puntos = obra_puntos($obra_id);
$mapa_lineas = obra_lineas($obra_id);
cabecera('Informe de obra');
$mysqli = new mysqli('localhost', 'construcciones', 'm5WAuKDydqRKssAj', 'sac');
if(!$mysqli){  die("Connection failed: " . $mysqli->error);}

$query = sprintf("SELECT avance FROM certificados WHERE idobras = '{$obra_id}' AND avance > 0 ORDER BY idcertificados ASC");
$result = $mysqli->query($query);

$query2 = sprintf("SELECT avance FROM plan_oficial WHERE idobras = '{$obra_id}' AND avance > 0 ORDER BY idplan_oficial ASC");
$result2 = $mysqli->query($query2);

$query3 = sprintf("SELECT numero FROM plan_oficial WHERE idobras = '{$obra_id}' AND numero > 0 GROUP BY numero ORDER BY idplan_oficial ASC");
$result3 = $mysqli->query($query3);

$numero = array();
$numero[] = 0;
$fecha = array();
$avanceplan = array();
$avanceplan[] = 0;
$avance = array();
$avance[] = 0;

while ($row = mysqli_fetch_array($result)){$avance[] = $row['avance'];}
if (isset($numero)){while ($row = mysqli_fetch_array($result3)){$numero[] = $row['numero'];}}
if (isset($avanceplan)){while ($row = mysqli_fetch_array($result2)){$avanceplan[] = $row['avance'];}}
$result->close();
$result2->close();
$result3->close();
$mysqli->close();
foreach($ejecutados as $obra):
  if($obra['idobras'] == $obra_id){
    $modificaciones_de_obra =  modificaciones_de_obra($obra['idobras']);
    $ampliaciones_de_obra =  ampliaciones_de_obra($obra['idobras']);
    $neutralizaciones_de_obra =  neutralizaciones_de_obra($obra['idobras']);
    ?>
          <div class="row">
            <div class="col-lg-12">
              <?php echo display_msg($msg); ?>
            </div>
          </div>
          <?php if($user['iddepartamentos'] == 8 && $user['idpermisos'] <= 3){ ?>
            <div class="row"> 
              <div class="col-lg-12 col-md-12">
                <div class="card border-top-left border-top-right border-bottom-left border-bottom-right">
                  <div class="card-body">
                    <h3 class="card-title">Unir y comprimir documentos</h3>
                    <div class="form-group">
                      <a href="https://smallpdf.com/es/unir-pdf">Ingresar haciendo click aqui</a>
                    </div>
                  </div>
                </div>
              </div>  
            </div>          
            <div class="row"> 
              <div class="col-12">
                <div class="alert alert-primary" role="alert">
                  <div class="row p-10 justify-content-center">
                    <h2><b>CARGA DE DATOS</b></h2>
                  </div>
                  <div class="row text-center">
                    <div class="col-sm-12 col-md-12 col-lg-3 p-10">
                      <a title="Cargar datos" id="texto" class="btn btn-md btn-info waves-effect waves-light text-white" data-toggle="modal" data-target="#add_informe_inspeccion" onclick="recibir(<?php echo $obra['numero']; ?>,<?php echo $obra['idobras']; ?>);">Certificado</a>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-3 p-10">
                      <a title="Cargar datos" id="texto" class="btn btn-md btn-info waves-effect waves-light text-white" data-toggle="modal" data-target="#add_personal_inspeccion" onclick="recibir(<?php echo $obra['numero']; ?>,<?php echo $obra['idobras']; ?>);">Asistencia</a>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-3 p-10">
                      <a class="btn btn-md btn-info waves-effect waves-light text-white" data-toggle="modal" data-target="#add_notas_de_pedido">Nota de pedido</a>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-3 p-10">
                      <a class="btn btn-md btn-info waves-effect waves-light text-white" data-toggle="modal" data-target="#add_ordenes_de_servicio">Orden de servicio</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
        <div class="container-fluid">
          <div class="bg-white justify-content-center card">
<ul class="nav flex-column flex-sm-row  nav-tabs customtab " role="tablist">
                                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#informe" role="tab"><span class="hidden-sm-up"><i class="ti-file mr-2"></i> INFORME</span> <span class="hidden-xs-down"><i class="ti-file mr-2"></i> INFORME</span></a></li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#obra" role="tab"><span class="hidden-sm-up"><i class="ti-bookmark-alt mr-2"></i> OBRA</span> <span class="hidden-xs-down"><i class="ti-bookmark-alt mr-2"></i> OBRA</span></a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#estadisticas" role="tab"><span class="hidden-sm-up"><i class="ti-bar-chart  mr-2"></i> ESTADISTICA</span> <span class="hidden-xs-down"><i class="ti-bar-chart  mr-2"></i> ESTADISTICA</span></a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#contratacion" role="tab"><span class="hidden-sm-up"><i class="ti-money mr-2"></i> CONTRATACION</span> <span class="hidden-xs-down"><i class="ti-money mr-2"></i> CONTRATACION</span></a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#inversion" role="tab"><span class="hidden-sm-up"><i class="ti-money mr-2"></i> INVERSION</span> <span class="hidden-xs-down"><i class="ti-money mr-2"></i> INVERSION</span></a> </li>                  
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#archivos" role="tab"><span class="hidden-sm-up"><i class="ti-folder mr-2"></i> ARCHIVOS</span> <span class="hidden-xs-down"><i class="ti-folder mr-2"></i> ARCHIVOS</span></a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#inspeccion" role="tab"><span class="hidden-sm-up"><i class="ti-briefcase mr-2"></i> INSPECCION</span> <span class="hidden-xs-down"><i class="ti-briefcase mr-2"></i> INSPECCION</span></a> </li>

                                    <li class="nav-item dropdown">
    <a class="nav-link " data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="ti-more-alt"></i></a>
    <div class="dropdown-menu">
      <a class="dropdown-item" data-toggle="tab" href="#ubicacion" role="tab">UBICACION</a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" data-toggle="tab" href="#" role="tab">2</a>
    </div>
  </li>
                                </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="informe" role="tabpanel">
                                  <?php if(permiso('admin') || permiso('obras')){ ?>
                                  <div class="justify-content-center text-center" style="border-bottom: 1px solid #dee2e6; padding:5px;">
                                  <a data-toggle="modal" data-target="#edit_obra" href="">Editar informe</a> 
                                  <span style="border-right:1px solid #dee2e6;padding-left: 10px">&nbsp;</span>
                                  <a data-toggle="modal" data-target="#modificaciones" href="" style="padding-left: 10px;">Modificaciones</a>
                                  <span style="border-right:1px solid #dee2e6;padding-left: 10px">&nbsp;</span>
                                  <a data-toggle="modal" data-target="#ampliaciones" href="" style="padding-left: 10px;">Ampliaciones</a>
                                  <span style="border-right:1px solid #dee2e6;padding-left: 10px">&nbsp;</span>
                                  <a data-toggle="modal" data-target="#neutralizaciones" href="" style="padding-left: 10px;">Neutralizaciones</a>
                                  <span style="border-right:1px solid #dee2e6;padding-left: 10px">&nbsp;</span>
                                  <a data-toggle="modal" data-target="#config_obra" href="" style="padding-left: 10px;">Ajustes</a>
                                </div>
                                <?php } ?>
                                    <div class="p-20">
                                      <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                          <div class="p-20 text-center" style="background-color: #e1e1e1;">
                                            <label class="control-label text-muted" style="font-size:12px;">Expediente</label>
                                            <h4><?php echo $obra['expediente']; ?></h4>
                                          </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                          <div class="p-20 text-center" style="background-color: #e1e1e1;">
                                            <label class="control-label text-muted" style="font-size:12px;">Caja / Archivo</label>
                                            <h4><?php echo ifexist($obra['numero']); ?></h4>
                                          </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                          <div class="p-20 text-center" style="background-color: #e1e1e1;">
                                            <label class="control-label text-muted" style="font-size:12px;">Estado</label>
                                            <h4><?php 
                      if($obra['estado'] == 0){ echo 'En ejecucion'; }
                      if($obra['estado'] == 3){ echo 'Finalizada'; }
                      if($obra['estado'] == 4){ echo 'Neutralizada'; }
                      if($obra['estado'] == 5){ echo 'Rescindida'; } ?></h4>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-lg-8 col-md-8 col-sm-12">
                                          <div class="p-20">
                                            <label class="control-label text-muted" style="font-size:12px;">Nombre</label>
                                            <h3><?php echo $obra['nombre']; ?></h3>
                                            <label class="control-label text-muted" style="font-size:12px;">Memoria descriptiva</label>
                                            <p><?php echo textarea($obra['memoria_descriptiva']); ?></p>
                                            <?php if(!empty($obra['observaciones'])){ ?>
                                            <label class="control-label text-muted" style="font-size:12px;">Observacion</label>
                                            <p><?php echo textarea($obra['observaciones']); ?></p>
                                          <?php } ?>
                                          </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                          <div class="p-20">
                                            <label class="control-label text-muted" style="font-size:12px;">Descripcion</label>
                                            <p><?php echo $obra['descripcion']; ?></p>
                                            <label class="control-label text-muted" style="font-size:12px;">Ubicacion</label>
                                            <p><?php echo $obra['ubicacion']; ?></p>
                                            <?php if(!empty($obra['longitud'])){echo '<label class="control-label text-muted" style="font-size:12px;">Longitud</label><p>'.$obra['longitud'].' metros.</p>';} else { echo ''; } ?>
                                            <label class="control-label text-muted" style="font-size:12px;">Presupuesto del proyecto</label>
                                            <p><?php if(!empty($obra['proyecto_monto'])){ echo '$ '.numero($obra['proyecto_monto']); }else{'';} ?> <?php if(!empty($obra['proyecto_monto_fecha'])){ echo '('.$obra['proyecto_monto_fecha'].')'; }else{'';} ?></p>
                                            <label class="control-label text-muted" style="font-size:12px;">Plazo de obra del proyecto</label>
                                            <p><?php echo $obra['proyecto_plazo']; ?></p>
                                            <label class="control-label text-muted" style="font-size:12px;">Plazo de Garantia de obra</label>
                                            <p><?php echo $obra['plazo_garantia']; ?></p>
                                          </div>
                                        </div>
                                      </div>
                                        <hr>

<div class="row p-20">
  <div class="col-12">
<?php if(isset($modificaciones_de_obra)){
                      foreach($modificaciones_de_obra as $modificacion): 
                        if(ifexist($modificacion['expediente'])){  $ul_mov_exp = ul_mov_exp($modificacion['expediente']); }
                        ?>
                              <table class="table table-hover" width="100%">
                                <thead>
                                  <tr>
                                    <th class="f-20">
                                      <b><?php echo $modificacion['numero'].'° Modificacion'; ?></b>
                                    </th>
                                  </tr>
                                  <tr>
                                    <th>
                                      <?php echo 'Expediente N°<b> '.$modificacion['expediente'].'</b>'; ?>
                                    </th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td>
                                      <?php if(ifexist($modificacion['expediente'])){ echo 'Ubicacion actual  <b>'.utf8_encode($ul_mov_exp['tramite']).'</b> desde '.format_date($ul_mov_exp['fecha']);} ?>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td> <u>Estado del tramite:</u> <b>
                                      <?php if($modificacion['estado'] == 0){ echo 'Sin definir';} 
                                      if($modificacion['estado'] == 1){ echo 'Confeccion Inspeccion';}
                                      if($modificacion['estado'] == 2){ echo 'Revision Dpto. II Obras por contrato';}
                                      if($modificacion['estado'] == 3){ echo 'Autorizando Ing. Jefe';}
                                      if($modificacion['estado'] == 4){ echo 'Encuadre Legal';}
                                      if($modificacion['estado'] == 5){ echo 'Imputacion del gasto';}
                                      if($modificacion['estado'] == 6){ echo 'Confeccionando resolucion';}
                                      if($modificacion['estado'] == 7){ echo 'Resolucion aprobada';} ?></b>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>
                                      <u>Avance:</u><b> <?php if(!empty($modificacion['estado'])){ echo round($modificacion['estado']*100/7). ' %';}else{ echo '0 %';} ?></b>
                                    </td>
                                  </tr>  
                                  <?php if(!empty($modificacion['resolucion_numero']) || $modificacion['resolucion_fecha'] != '0000-00-00'){  ?>
                                    <tr>
                                      <td>
                                        <u>Resolucion:</u><b> <?php if(!empty($modificacion['resolucion_numero'])){ echo 'Nº '.$modificacion['resolucion_numero'].' ';} if($modificacion['resolucion_fecha'] != '0000-00-00'){ echo 'Fecha '.$modificacion['resolucion_fecha']; } ?></b>
                                      </td>
                                    </tr> 
                                  <?php } else{ echo '<tr><td><u>Resolucion:</u> No aprobado</td></tr>'; } ?>
                                  <tr>
                                    <td>
                                      <?php if(ifexist($modificacion['descripcion'])){ ?>
                                        <b><u>Descripción</u></b><br /><br />
                                        <?php echo textarea($modificacion['descripcion']); } ?>
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
                        <?php endforeach; } ?>
                      </div></div>
<div class="row p-20">
    <div class="col-12">
<?php if(isset($ampliaciones_de_obra)){
                          foreach($ampliaciones_de_obra as $ampliacion): 
                            if(ifexist($ampliacion['expediente'])){  $ul_mov_exp = ul_mov_exp($ampliacion['expediente']);} ?>
                            
                                  <table class="table table-hover">
                                    <thead>
                                      <tr>
                                        <th class="f-20">
                                          <b><?php echo $ampliacion['numero'].'° Ampliacion'; ?></b>
                                        </th>
                                      </tr>
                                      <tr>
                                        <th>
                                          <?php echo 'Expediente N°<b> '.$ampliacion['expediente'].'</b>'; ?>
                                        </th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td>
                                          <?php if(ifexist($ampliacion['expediente'])){ echo 'Ubicacion actual  <b>'.utf8_encode($ul_mov_exp['tramite']).'</b> desde '.format_date($ul_mov_exp['fecha']);} ?>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td> <u>Estado del tramite:</u> <b>
                                          <?php if($ampliacion['estado'] == 0){ echo 'Sin definir';} 
                                          if($ampliacion['estado'] == 1){ echo 'Confeccion Inspeccion';}
                                          if($ampliacion['estado'] == 2){ echo 'Revision Dpto. II Obras por contrato';}
                                          if($ampliacion['estado'] == 3){ echo 'Autorizando Ing. Jefe';}
                                          if($ampliacion['estado'] == 4){ echo 'Encuadre Legal';}
                                          if($ampliacion['estado'] == 5){ echo 'Imputacion del gasto';}
                                          if($ampliacion['estado'] == 6){ echo 'Confeccionando resolucion';}
                                          if($ampliacion['estado'] == 7){ echo 'Resolucion aprobada';} ?></b>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td>
                                          <u>Avance:</u><b> <?php if(!empty($ampliacion['estado'])){ echo round($ampliacion['estado']*100/7). ' %';}else{ echo '0 %';} ?></b>
                                        </td>
                                      </tr>
                                      <?php if(!empty($ampliacion['resolucion_numero']) || $ampliacion['resolucion_fecha'] != '0000-00-00'){  ?>
                                        <tr>
                                          <td>
                                            <u>Resolucion:</u><b> <?php if(!empty($ampliacion['resolucion_numero'])){ echo 'Nº '.$ampliacion['resolucion_numero'].' ';} if($ampliacion['resolucion_fecha'] != '0000-00-00'){ echo 'Fecha '.$ampliacion['resolucion_fecha']; } ?></b>
                                          </td>
                                        </tr> 
                                      <?php } else{ echo '<tr><td><u>Resolucion:</u> No aprobado</td></tr>'; } ?>
                                      <tr>
                                        <td>
                                          <?php if(ifexist($ampliacion['plazo'])){ ?>
                                            <b><u>Plazo:</u></b>
                                            <?php echo $ampliacion['plazo']; } ?>
                                          </td>
                                        </tr>
                                      <tr>
                                        <td>
                                          <?php if(ifexist($ampliacion['descripcion'])){ ?>
                                            <b><u>Descripción</u></b><br /><br />
                                            <?php echo textarea($ampliacion['descripcion']); } ?>
                                          </td>
                                        </tr>
                                      </tbody>
                                    </table>
                            <?php endforeach; } ?>
                          </div></div>
<div class="row p-20">
    <div class="col-12">
<?php if(isset($neutralizaciones_de_obra)){
                              foreach($neutralizaciones_de_obra as $neutralizacion):
                                if(ifexist($neutralizacion['expediente'])){  $ul_mov_exp = ul_mov_exp($neutralizacion['expediente']); } ?>
                                      <table class="table table-hover " width="100%">
                                        <thead>
                                          <tr>
                                            <th class="f-20">
                                              <b><?php echo $neutralizacion['numero'].'° Neutralizacion'; ?></b>
                                            </th>
                                          </tr>
                                          <tr>
                                            <th>
                                              <?php echo 'Expediente N°<b> '.$neutralizacion['expediente'].'</b>'; ?>
                                            </th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td>
                                              <?php if(ifexist($neutralizacion['expediente'])){ echo 'Ubicacion actual  <b>'.utf8_encode($ul_mov_exp['tramite']).'</b> desde '.format_date($ul_mov_exp['fecha']);} ?>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td> <u>Estado del tramite:</u> <b>
                                              <?php if($neutralizacion['estado'] == 0){ echo 'Sin definir';} 
                                              if($neutralizacion['estado'] == 1){ echo 'Confeccion Inspeccion';}
                                              if($neutralizacion['estado'] == 2){ echo 'Revision Dpto. II Obras por contrato';}
                                              if($neutralizacion['estado'] == 3){ echo 'Autorizando Ing. Jefe';}
                                              if($neutralizacion['estado'] == 4){ echo 'Encuadre Legal';}
                                              if($neutralizacion['estado'] == 5){ echo 'Imputacion del gasto';}
                                              if($neutralizacion['estado'] == 6){ echo 'Confeccionando resolucion';}
                                              if($neutralizacion['estado'] == 7){ echo 'Resolucion aprobada';} ?></b>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td>
                                              <u>Avance:</u><b> <?php if(!empty($neutralizacion['estado'])){ echo round($neutralizacion['estado']*100/7). ' %';}else{ echo '0 %';} ?></b>
                                            </td>
                                          </tr>      
                                          <?php if(!empty($neutralizacion['resolucion_numero']) || $neutralizacion['resolucion_fecha'] != '0000-00-00'){  ?>
                                            <tr>
                                              <td>
                                                <u>Resolucion:</u><b> <?php if(!empty($neutralizacion['resolucion_numero'])){ echo 'Nº '.$neutralizacion['resolucion_numero'].' ';} if($neutralizacion['resolucion_fecha'] != '0000-00-00'){ echo 'Fecha '.$neutralizacion['resolucion_fecha']; } ?></b>
                                              </td>
                                            </tr> 
                                          <?php } else{ echo '<tr><td><u>Resolucion:</u> No aprobado</td></tr>'; } ?>
                                          <tr>
                                            <td>
                                              <?php if(ifexist($neutralizacion['descripcion'])){ ?>
                                                <b><u>Descripción</u></b><br /><br />
                                                <?php echo textarea($neutralizacion['descripcion']); } ?>
                                              </td>
                                            </tr>
                                          </tbody>
                                        </table>
                                <?php endforeach; } ?> 
</div></div><br>

<hr>
<div class="row p-20">
<small class="text-muted"><?php echo 'Información actualizada el '.format_date($obra['registro_fecha']).''.user_name($obra['registro_usuario']); ?></small></div>


                                      </div>
                                </div>
                                <div class="tab-pane p-20" id="obra" role="tabpanel">
                                
                                    <div class="p-20">
                                      <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                          <div class="p-20 text-center" style="background-color: #e1e1e1;">
                                            <label class="control-label text-muted" style="font-size:12px;">Expediente</label>
                                            <h4><?php echo $obra['expediente']; ?></h4>
                                          </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                          <div class="p-20 text-center" style="background-color: #e1e1e1;">
                                            <label class="control-label text-muted" style="font-size:12px;">Caja / Archivo</label>
                                            <h4><?php echo ifexist($obra['numero']); ?></h4>
                                          </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                          <div class="p-20 text-center" style="background-color: #e1e1e1;">
                                            <label class="control-label text-muted" style="font-size:12px;">Estado</label>
                                            <h4><?php 
                      if($obra['estado'] == 0){ echo 'En ejecucion'; }
                      if($obra['estado'] == 3){ echo 'Finalizada'; }
                      if($obra['estado'] == 4){ echo 'Neutralizada'; }
                      if($obra['estado'] == 5){ echo 'Rescindida'; } ?></h4>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                <?php if($obra['bacheo'] == 1){ ?>

                            <ul class="nav navbar-nav nav-flex-icons float-right">
                              <li class="nav-item dropdown">
                                <a id="navbarDropdownMenuLink-333" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                Opciones
                              </a>
                              <div class="dropdown-menu dropdown-menu-right dropdown-default" aria-labelledby="navbarDropdownMenuLink-333">
                                <?php if(permiso('admin') || permiso('bacheo')){ ?>
                                  <a class="dropdown-item" data-toggle="modal" data-target="#add_bacheo"> Agregar</a>
                                <?php } ?>
                                <a class="dropdown-item" href="#" target="_blank">Imprimir</a>
                              </div>
                            </li>  
                          </ul>
                        <div class="table-responsive">
                          <table id="all" class="table table-striped" cellspacing="0" width="100%">
                            <thead>
                              <tr>
                                <th class="w-5"></th>
                                <th class="text-center"> Fecha </th>
                                <th class="text-center"> Ubicacion </th>
                                <th class="text-center"> Personal </th>
                                <th class="text-center"> Riego (m3) </th>
                                <th class="text-center"> Riego (Tn) </th>
                                <th class="text-center"> Asfalto (m2) </th>
                                <th class="text-center"> Asfalto (Tn) </th>
                                <th class="text-center"> Proveedor </th>
                                <th class="text-center"> Registro </th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php foreach ($obra_bacheo as $bacheo):?>
                                <tr>
                                  <td class="w-5"></td>
                                  <td class="text-center"> <?php echo format_date($bacheo['fecha']); ?></td>
                                  <td> <?php echo $bacheo['ubicacion']; ?></td>
                                  <td> <?php echo $bacheo['personal']; ?></td>
                                  <td class="text-center"> <?php echo $bacheo['riego-m3']; ?></td>
                                  <td class="text-center"> <?php echo $bacheo['riego-tn']; ?></td>
                                  <td class="text-center"> <?php echo $bacheo['asfalto-m2']; ?></td>
                                  <td class="text-center"> <?php echo $bacheo['asfalto-tn']; ?></td>
                                  <td> <?php echo $bacheo['proveedor']; ?></td>
                                  <td class="text-center"> <?php echo format_date($bacheo['registro_fecha']).''.user_name($bacheo['registro_usuario']); ?></td>
                                </tr>
                              <?php endforeach; ?>
                            </tbody>
                          </table>
                        </div>
        <?php } ?>


                              </div>
                                <div class="tab-pane p-20" id="estadisticas" role="tabpanel">
                                  <a data-toggle="collapse" data-parent="#accordion_curva" href="#collapse_curva" aria-expanded="true"
            aria-controls="collapse_curva" class="text-white pull-right">
            Opciones
          </a>
          <ul class="nav navbar-nav nav-flex-icons float-right">
            <li class="nav-item dropdown">
              <a id="navbarDropdownMenuLink-333" data-toggle="dropdown" aria-haspopup="true"
              aria-expanded="false">
              Opciones
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-default" aria-labelledby="navbarDropdownMenuLink-333">
              <a class="dropdown-item" href="content/prints/curva-inversion.php?id=<?php echo $obra_id;?>" target="_blank">Imprimir</a>
            </div>
          </li>  
        </ul>
                                  <div class="table-responsive">
        <canvas id="curva" width="100%" height="40%"></canvas>
      </div><hr>
      <div class="bg-white justify-content-center card text-center">
<ul class="nav flex-column flex-sm-row  nav-tabs customtab " role="tablist">
                                <li class="nav-item"> 
                                  <a class="nav-link active" data-toggle="tab" href="#plan_oficial" role="tab">
                                    <span class="hidden-sm-up">PLAN OFICIAL</span>
                                    <span class="hidden-xs-down">PLAN OFICIAL</span>
                                   </a>
                                 </li>
                                 <li class="nav-item"> 
                                  <a class="nav-link" data-toggle="tab" href="#margen_multa" role="tab">
                                    <span class="hidden-sm-up">MULTA</span>
                                    <span class="hidden-xs-down">MULTA</span>
                                   </a>
                                 </li>
                                 <li class="nav-item"> 
                                  <a class="nav-link" data-toggle="tab" href="#certificados_aprob" role="tab">
                                    <span class="hidden-sm-up">CERTIFICADOS</span>
                                    <span class="hidden-xs-down">CERTIFICADOS</span>
                                   </a>
                                 </li>
                                 <li class="nav-item"> 
                                  <a class="nav-link" data-toggle="tab" href="#certificados_redet" role="tab">
                                    <span class="hidden-sm-up">REDETERMINACIONES</span>
                                    <span class="hidden-xs-down">REDETERMINACIONES</span>
                                   </a>
                                 </li>
                                </ul>
                                <div class="tab-content">
                                <div class="tab-pane p-20 active" id="plan_oficial" role="tabpanel">
                                  <ul class="nav navbar-nav nav-flex-icons float-right">
            <li class="nav-item dropdown">
              <a id="navbarDropdownMenuLink-333" data-toggle="dropdown" aria-haspopup="true"
              aria-expanded="false">
              Opciones
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-default" aria-labelledby="navbarDropdownMenuLink-333">
              <?php if(permiso('admin') || permiso('certificacion')){ ?>
                <a class="dropdown-item"  id="btn_agregar_plan_oficial" onclick="form_agregar_plan_oficial(true)">Cargar nuevo</a>
                <div class="dropdown-divider"></div>
              <?php } ?>
              <a class="dropdown-item" href="content/prints/plan-oficial.php?id=<?php echo $obra_id;?>" target="_blank">Imprimir</a>
            </div>
          </li>  
        </ul>
<div id="listar_plan_oficial">
        <table id="plan-oficial" class="table table-striped" cellspacing="0" width="100%">
          <thead>
            <tr>
              <?php if(permiso('admin') || permiso('certificacion')){ ?>
                <th class="w-5">  </th>
              <?php } ?>
              <th class="text-center" style="width: 10%;"> Nº </th>
              <th class="text-center" style="width: 10%;"> Avance </th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($certificados_plan as $c_plan):?>
              <tr>
                <?php if(permiso('admin') || permiso('certificacion')){ ?>
                  <td class="text-right"> 
                    <a class="btn btn-sm btn-secondary" onclick="editar_plan_oficial(<?php echo $obra_id; ?>,<?php echo $c_plan['idplan_oficial']; ?>)" data-toggle="tooltip" title="Editar datos"><i class="mdi mdi-pencil"></i></a>
                    <a class="btn btn-sm btn-danger text-white" onclick="eliminar_plan_oficial(<?php echo $obra_id; ?>,<?php echo $c_plan['idplan_oficial']; ?>)" data-toggle="tooltip" title="Eliminar"><i class="fa fa-times"></i></a>
                  </td>
                <?php } ?>               
                <td class="text-center"> <?php echo clean($c_plan['numero']); ?></td>
                <td class="text-center"> <?php echo clean($c_plan['avance']); ?> %</td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <div id="editar_plan_oficial"></div>
      <?php require_once('../forms/agregar_plan_oficial.php'); ?>
                                </div>
                                <div class="tab-pane p-20" id="margen_multa" role="tabpanel">
                                  <ul class="nav navbar-nav nav-flex-icons float-right">
            <li class="nav-item dropdown">
              <a id="navbarDropdownMenuLink-333" data-toggle="dropdown" aria-haspopup="true"
              aria-expanded="false">
              Opciones
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-default" aria-labelledby="navbarDropdownMenuLink-333">
              <?php if(permiso('admin') || permiso('certificacion')){ ?>
                <a class="dropdown-item" data-toggle="modal" data-target="#valor_multa">Cargar valor</a>
                <div class="dropdown-divider"></div>
              <?php } ?>
              <a class="dropdown-item" href="content/prints/margen-multa.php?id=<?php echo $obra_id;?>" target="_blank">Imprimir</a>
            </div>
          </li>  
        </ul>
                                  <?php if(!empty($obra['valormulta'])){ ?><center><b>Corresponde al valor: <span style="font-size: 18px;color:#007bff;"><?php echo $obra['valormulta']; ?></span></b></center><?php } ?>
        <table id="margen-multa" class="table table-striped" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th class="text-center"> Nº </th>
              <th class="text-center"> Porcentaje </th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($certificados_multa as $c_mul):?>
              <tr>
                <td class="text-center"> <?php echo clean($c_mul['numero']); ?></td>
                <td class="text-center"> <?php $porcentaje_multa = $c_mul['avance'] * $obra['valormulta']; echo $porcentaje_multa; ?> %</td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
                                </div>
                                <div class="tab-pane p-20" id="certificados_aprob" role="tabpanel">
                                  <div id="listar_certificado">
                                    <ul class="nav navbar-nav nav-flex-icons float-right">
        <li class="nav-item dropdown">
          <a id="navbarDropdownMenuLink-333" data-toggle="dropdown" aria-haspopup="true"
          aria-expanded="false">
          Opciones
        </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-default" aria-labelledby="navbarDropdownMenuLink-333">
          <?php if(permiso('admin') || permiso('certificacion')){ ?>
            <a class="dropdown-item"  id="btn_agregar_certificado" onclick="form_agregar_certificado(true)">Cargar nuevo</a>
            <div class="dropdown-divider"></div>
          <?php } ?>
          <a class="dropdown-item" href="content/prints/certificados.php?id=<?php echo $obra_id;?>" target="_blank">Imprimir</a>
        </div>
      </li>  
    </ul>
    
    <div class="table-responsive">
      <table id="certificados" class="table table-striped" cellspacing="0" width="100%">
        <thead>
          <tr>
            <?php if(permiso('admin') || permiso('certificacion')){ ?>
              <th class="w-5">  </th>
            <?php } ?>
            <th class="text-center" style="width: 10%;"> Expediente </th>
            <th class="text-center" style="width: 10%;"> Nº </th>
            <th class="text-center" style="width: 10%;"> Fecha </th>
            <th class="text-center" style="width: 10%;"> Monto </th>
            <th class="text-center" style="width: 10%;"> Avance </th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($certificados as $c):?>
            <tr>
              <?php if(permiso('admin') || permiso('certificacion')){ ?>
                <td class="text-right"> 
                  <a class="btn btn-sm btn-secondary" onclick="editar_certificado(<?php echo $obra_id; ?>,<?php echo $c['idcertificados']; ?>)" data-toggle="tooltip" title="Editar datos"><i class="mdi mdi-pencil"></i></a>
                    <a class="btn btn-sm btn-danger text-white" onclick="eliminar_certificado(<?php echo $obra_id; ?>,<?php echo $c['idcertificados']; ?>)" data-toggle="tooltip" title="Eliminar"><i class="fa fa-times"></i></a>
                </td>
              <?php } ?> 
              <td class="text-center"> <?php if(!empty($c['expediente']) && $c_adec['expediente'] != 0){ echo $c['expediente'];} ?></td>
              <td class="text-center"> <?php echo clean($c['numero']); ?></td>
              <td class="text-center"> <?php echo $c['fecha']; ?></td>
              <td class="text-center"> $ <?php echo numero($c['monto']); ?></td>
              <td class="text-center"> <?php echo clean($c['avance']); ?> %</td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
      <div id="editar_certificado"></div>
      <?php require_once('../forms/agregar_certificados.php'); ?>
                                </div>
                                <div class="tab-pane p-20" id="certificados_redet" role="tabpanel">
                                  <div id="listar_certificado_redeterminado">
                                    <ul class="nav navbar-nav nav-flex-icons float-right">
        <li class="nav-item dropdown">
          <a id="navbarDropdownMenuLink-333" data-toggle="dropdown" aria-haspopup="true"
          aria-expanded="false">
          Opciones
        </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-default" aria-labelledby="navbarDropdownMenuLink-333">
          <?php if(permiso('admin') || permiso('certificacion')){ ?>
            <a class="dropdown-item"  id="btn_agregar_certificado_redeterminado" onclick="form_agregar_certificado_redeterminado(true)">Cargar nuevo</a>
            <div class="dropdown-divider"></div>
          <?php } ?>
          <a class="dropdown-item" href="content/prints/certificados-redeterminados.php?id=<?php echo $obra_id;?>" target="_blank">Imprimir</a>
        </div>
      </li>  
    </ul>
    <div class="table-responsive">
      <table id="certificados-redeterminados" class="table table-striped" cellspacing="0" width="100%">
        <thead>
          <tr>
            <?php if(permiso('admin') || permiso('certificacion')){ ?>
              <th class="w-5">  </th>
            <?php } ?>
            <th class="text-center" style="width: 10%;"> Expediente </th>
            <th class="text-center" style="width: 10%;"> Nº </th>
            <th class="text-center" style="width: 10%;"> Fecha </th>
            <th class="text-center" style="width: 10%;"> Provisorio </th>
            <th class="text-center" style="width: 10%;"> Definitivo </th>
            <th class="text-center" style="width: 10%;"> A Precios de </th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($certificados_adec as $c_adec):?>
            <tr>
              <?php if(permiso('admin') || permiso('certificacion')){ ?>
                <td class="text-right"> 
                  <a class="btn btn-sm btn-secondary" onclick="editar_certificado_redeterminado(<?php echo $obra_id; ?>,<?php echo $c_adec['idcertificados_redeterminados']; ?>)" data-toggle="tooltip" title="Editar datos"><i class="mdi mdi-pencil"></i></a>
                    <a class="btn btn-sm btn-danger text-white" onclick="eliminar_certificado_redeterminado(<?php echo $obra_id; ?>,<?php echo $c_adec['idcertificados_redeterminados']; ?>)" data-toggle="tooltip" title="Eliminar"><i class="fa fa-times"></i></a>
                  
                </td>
              <?php } ?>  
              <td class="text-center"> <?php if(!empty($c_adec['expediente']) && $c_adec['expediente'] != 0){ echo $c_adec['expediente'];} ?></td>
              <td class="text-center"> <?php echo clean($c_adec['numero']); ?></td>
              <td class="text-center"> <?php echo $c_adec['fecha']; ?></td>
              <td class="text-center"> <?php if(!empty($c_adec['monto_provisorio'])){ echo '$ '.numero($c_adec['monto_provisorio']);} ?></td>
              <td class="text-center"> <?php if(!empty($c_adec['monto_definitivo'])){ echo '$ '.numero($c_adec['monto_definitivo']);} ?></td>
              <td class="text-center"> <?php echo clean($c_adec['informacion']); ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
      <div id="editar_certificado_redeterminado"></div>
      <?php require_once('../forms/agregar_certificado_redeterminado.php'); ?>
                                </div>

                              </div>
                              </div>
                                </div>

                                
 <div class="tab-pane p-20" id="contratacion" role="tabpanel">                           
  <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-12"></div>
            <div class="col-lg-8 col-md-8 col-sm-12">       
<center><b>CONTRATACION</b></center>
                      <b>Tipo de contratacion:</b> <?php echo $obra['tipo_contratacion']; ?><br />
                      <b>Aprobacion de proyecto:</b> <?php if($obra['aprobacion_res_fecha'] != '0000-00-00'){ echo format_date($obra['aprobacion_res_fecha']); }else{'';} ?> <?php if(!empty($obra['aprobacion_res_num'])){ echo 'por Res. Nº'.$obra['aprobacion_res_num']; } else {echo '';} ?><br />
                      <b>Adjudicacion a empresa:</b> <?php if($obra['adjudicacion_res_fecha'] != '0000-00-00'){ echo format_date($obra['adjudicacion_res_fecha']); }else{'';} ?> <?php if(!empty($obra['adjudicacion_res_num'])){ echo 'por Res. Nº'.$obra['adjudicacion_res_num'];} else{echo '';} ?><br />
                      <b>Contratista:</b> <?php echo $obra['contratista']; ?><br />
                      <b>Firma del contrato:</b> <?php if($obra['contrato_fecha'] != '0000-00-00'){ echo format_date($obra['contrato_fecha']);} else { echo ''; } ?><br />
                      <?php if(!empty($obra['contrato_monto'])){ echo '<b>Monto de contrato:</b> $ '.numero($obra['contrato_monto']).'<br />'; }else{'';} ?>
                      <b>Acta de inicio de obra:</b> <?php if($obra['fecha_inicio'] != '0000-00-00'){ echo format_date($obra['fecha_inicio']); } else { echo ''; } ?><br />
                      <b>Financiacion:</b> <?php echo $obra['tipo_financiamiento']; ?><br />
                      <b>Inspector de obra:</b> <?php echo inspector_name($obra['idinspector']); ?><br />
                      <b>Finalizacion aproximada:</b> <?php if($obra['fecha_fin'] != '0000-00-00'){ echo format_date($obra['fecha_fin']); } else { echo ''; } ?><br />
                    </div>
            <div class="col-lg-2 col-md-2 col-sm-12"></div>
                    </div>
                </div>


                                <div class="tab-pane p-20" id="inversion" role="tabpanel">
                                  <div class="form-group quote-sac">
                  <?php if(permiso('admin') || permiso('certificacion')){ ?>
                    <div class="text-right p-r-30 p-t-10"> <a href="" data-toggle="modal" data-target="#montos_obra" ><i class="fas fa-edit"></i> Editar datos</a></div>
                  <?php } ?>
                  <div class="row p-20">
                    <div class="col-md-12">
                      <center><b>MONTOS Y PLAZOS</b></center>
                      
                      <?php if(!empty($obra['monto_vigente'])){ echo '<b>Monto de obra:</b> $ '.numero($obra['monto_vigente']).'<br />'; }else{'';} ?>
                      <?php if(!empty($obra['plazo_vigente'])){ echo '<b>Plazo de obra vigente:</b> '.$obra['plazo_vigente'].'<br />'; }else{'';} ?>
                      <?php if(!empty($obra['monto_redeterminado'])){ echo '<b>Monto contrato redeterminado:</b> $ '.numero($obra['monto_redeterminado']).'<br />'; }else{'';} ?>
                      <?php if(!empty($obra['info_redeterminacion'])){ echo '<b>Información de redeterminación:</b> '.$obra['info_redeterminacion'].'<br />';}else{'';} ?>
                    </div>
                  </div>
                  <hr>
                  <?php if(permiso('admin') || permiso('certificacion')){ ?>
                    <div class="text-right p-r-30 p-t-10"> <a href="" data-toggle="modal" data-target="#avance_obra" ><i class="fas fa-edit"></i> Editar datos</a></div>
                  <?php } ?>
                  <div class="row p-20">
                    <div class="col-md-12">
                      <center><b>AVANCE DE OBRA</b></center>
                      <?php if(!empty($obra['certificado_numero'])){ echo '<b>Nº certificado:</b> '.$obra['certificado_numero'].'<br />'; }else{'';} ?>
                      <?php if(!empty($obra['certificado_fecha'])){ echo '<b>Fecha del certificado:</b> '.$obra['certificado_fecha'].'<br />'; }else{'';} ?>
                      <?php if(!empty($obra['certificado_plazo'])){ echo '<b>Plazo transcurrido:</b> '.$obra['certificado_plazo'].'<br />'; }else{'';} ?>
                      <?php if(!empty($obra['certificado_monto'])){ echo '<b>Obra ejecutada:</b> $ '.numero($obra['certificado_monto']).'<br />'; }else{'';} ?>
                      <?php if(!empty($obra['certificado_porcentaje'])){ echo '<b>Porcentaje:</b> '.$obra['certificado_porcentaje'].' %<br />';}else{'';} ?>
                      <?php if(!empty($obra['certificado_archivo'])){ ?><center><a href="../uploads/Obras/<?php echo $obra['numero']; ?>/Certificacion/Ultimo/Certificado_<?php echo $obra['certificado_archivo']; ?>" target="_blank"><i class="fas fa-download"></i> <?php echo $obra['certificado_archivo']; ?></a></center><?php } ?>
                    </div>
                  </div>
                  <hr>
                  <span style="padding:20px;color:#000;">
                    <?php if($obra['registro_certificados_fecha'] != '0000-00-00'){
                      echo 'Actualizado el '.format_date($obra['registro_certificados_fecha']).''.user_name($obra['registro_certificados_usuario']); } ?></span>
                    </div> 
                                </div>




                                <div class="tab-pane p-20" id="archivos" role="tabpanel">
              <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-12"></div>
            <div class="col-lg-8 col-md-8 col-sm-12">
              <?php if(permiso('admin') || permiso('obras')){ ?>
          
            <ul class="nav navbar-nav nav-flex-icons float-right">
              <li class="nav-item dropdown">
                <a id="navbarDropdownMenuLink-333" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                Opciones
              </a>
              <div class="dropdown-menu dropdown-menu-right dropdown-default" aria-labelledby="navbarDropdownMenuLink-333">
                <a class="dropdown-item" data-toggle="modal" data-target="#add_files">Subir archivos</a>
              </div>
            </li>  
          </ul>
          <?php } ?>
            <div class="table-responsive p-20" style="background-color: #f9f9f9">
          <?php
          $allowed_extensions = array("gif", "jpg", "jpeg", "png", "xls", "doc", "dwg", "pdf");
          echo php_file_tree("../../../uploads/obras/".$obra['numero'], "[link]", $allowed_extensions);
          ?>
        </div>
      </div>
      <div class="col-lg-2 col-md-2 col-sm-12"></div>
                                </div>
                            </div>
<div class="tab-pane p-20" id="inspeccion" role="tabpanel">
  Informes 
<ul class="nav navbar-nav nav-flex-icons float-right">
            <li class="nav-item dropdown">
              <a id="navbarDropdownMenuLink-333" data-toggle="dropdown" aria-haspopup="true"
              aria-expanded="false">
              Opciones
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-default" aria-labelledby="navbarDropdownMenuLink-333">
              <?php if(permiso('admin') || permiso('inspeccion')){ ?>
                <a class="dropdown-item" data-toggle="modal" data-target="#add_informe_inspeccion" onclick="recibir(<?php echo $obra['numero']; ?>,<?php echo $obra['idobras']; ?>);">Cargar nuevo</a>
                <div class="dropdown-divider"></div>
              <?php } ?>
            </div>
          </li>  
        </ul>
<div class="table-responsive">
          <table id="informes-inspeccion" class="table table-striped" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th class="text-center" style="width: 10%;"> Nº </th>
                <th class="text-center"> Fecha </th>
                <th class="text-center"> Informe </th>
                <th class="text-center"> Registro </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($inspeccion_informe as $i_informe):?>
                <tr>
                  <td class="text-center"> <?php echo clean($i_informe['numero']); ?></td>
                  <td class="text-center"> <?php echo clean($i_informe['fecha']); ?></td>
                  <td class="text-center"> <?php echo $i_informe['archivo']; ?></td>
                  <td class="text-center"> <?php echo format_date($i_informe['registro_fecha']).' '.user_name($i_informe['registro_usuario']); ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
<hr>
Ordenes
<ul class="nav navbar-nav nav-flex-icons float-right">
            <li class="nav-item dropdown">
              <a id="navbarDropdownMenuLink-333" data-toggle="dropdown" aria-haspopup="true"
              aria-expanded="false">
              Opciones
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-default" aria-labelledby="navbarDropdownMenuLink-333">
              <?php if(permiso('admin') || permiso('inspeccion')){ ?>
                <a class="dropdown-item" data-toggle="modal" data-target="#add_ordenes_de_servicio">Cargar nuevo</a>
                <div class="dropdown-divider"></div>
              <?php } ?>
              <a class="dropdown-item" href="content/prints/ordenes-de-servicio.php?id=<?php echo $obra_id;?>" target="_blank">Imprimir</a>
            </div>
          </li>  
        </ul>
<div class="table-responsive">
          <table id="ordenes" class="table table-striped" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th class="text-center" style="width: 10%;"> Nº </th>
                <th class="text-center" style="width: 10%;"> Asunto </th>
                <th class="text-center" style="width: 10%;"> Archivo </th>
                <th class="text-center" style="width: 10%;"> Fecha </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($ordenes as $ord):?>
                <tr>
                  <td class="text-center"> <?php echo clean($ord['numero']); ?></td>
                  <td class="text-center"> <?php echo clean($ord['asunto']); ?></td>
                  <td class="text-center"> <a href="../uploads/Obras/<?php echo $obra['numero']; ?>/Inspeccion/Ordenes/<?php echo $ord['archivo']; ?>" target="_blank"><?php echo 'Orden_de_servicio_'.$ord['numero']; ?></a></td>
                  <td class="text-center"> <?php echo format_date($ord['registro_fecha']); ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
<hr>
Notas
<ul class="nav navbar-nav nav-flex-icons float-right">
        <li class="nav-item dropdown">
          <a id="navbarDropdownMenuLink-333" data-toggle="dropdown" aria-haspopup="true"
          aria-expanded="false">
          Opciones
        </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-default" aria-labelledby="navbarDropdownMenuLink-333">
          <?php if(permiso('admin') || permiso('inspeccion')){ ?>
            <a class="dropdown-item" data-toggle="modal" data-target="#add_notas_de_pedido">Cargar nuevo</a>
            <div class="dropdown-divider"></div>
          <?php } ?>
          <a class="dropdown-item" href="content/prints/notas-de-pedido.php?id=<?php echo $obra_id;?>" target="_blank">Imprimir</a>
        </div>
      </li>  
    </ul>
    <div class="table-responsive">
      <table id="notas" class="table table-striped" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th class="text-center" style="width: 10%;"> Nº </th>
            <th class="text-center" style="width: 10%;"> Asunto </th>
            <th class="text-center" style="width: 10%;"> Archivo </th>
            <th class="text-center" style="width: 10%;"> Fecha </th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($notas as $not):?>
            <tr>
              <td class="text-center"> <?php echo clean($not['numero']); ?></td>
              <td class="text-center"> <?php echo clean($not['asunto']); ?></td>
              <td class="text-center"> <a href="../uploads/Obras/<?php echo $obra['numero']; ?>/Inspeccion/Notas/<?php echo $not['archivo']; ?>" target="_blank"><?php echo 'Nota_de_pedido_'.$not['numero']; ?></a></td>
              <td class="text-center"> <?php echo format_date($not['registro_fecha']); ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <hr>
Asistencias
  <ul class="nav navbar-nav nav-flex-icons float-right">
        <li class="nav-item dropdown">
          <a id="navbarDropdownMenuLink-333" data-toggle="dropdown" aria-haspopup="true"
          aria-expanded="false">
          Opciones
        </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-default" aria-labelledby="navbarDropdownMenuLink-333">
          <?php if(permiso('admin') || permiso('inspeccion')){ ?>
            <a class="dropdown-item" data-toggle="modal" data-target="#add_personal_inspeccion" onclick="recibir(<?php echo $obra['numero']; ?>,<?php echo $obra['idobras']; ?>);">Cargar nuevo</a>
            <div class="dropdown-divider"></div>
          <?php } ?>
        </div>
      </li>  
    </ul>
      <div class="table-responsive">
      <table id="asistencia-inspeccion" class="table table-striped" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th class="text-center" style="width: 10%;"> Nº </th>
            <th class="text-center"> Fecha </th>
            <th class="text-center"> Informe </th>
            <th class="text-center"> Registro </th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($inspeccion_asistencia as $i_asistencia):?>
            <tr>
              <td class="text-center"> <?php echo clean($i_asistencia['numero']); ?></td>
              <td class="text-center"> <?php echo clean($i_asistencia['fecha']); ?></td>
              <td class="text-center"> <?php echo $i_asistencia['archivo']; ?></td>
              <td class="text-center"> <?php echo format_date($i_asistencia['registro_fecha']).' '.user_name($i_asistencia['registro_usuario']); ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>


</div>

<div class="tab-pane p-20" id="ubicacion" role="tabpanel">
                                  <div id="vista_mapa_obra">
                                    <?php if(permiso('admin') || permiso('obras')){ ?><a data-toggle="collapse" data-parent="#accordion_mapa" href="#collapse_mapa" aria-expanded="true"
            aria-controls="collapse_mapa" class="text-white pull-right">
            Opciones
          </a>
          
            <ul class="nav navbar-nav nav-flex-icons float-right">
              <li class="nav-item dropdown">
                <a id="navbarDropdownMenuLink-333" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                Opciones
              </a>
              <div class="dropdown-menu dropdown-menu-right dropdown-default" aria-labelledby="navbarDropdownMenuLink-333">
                <a class="dropdown-item" id="btnagregar_mapa_agregar" onclick="form_mapa_agregar(true)"> Agregar</a>
                <a class="dropdown-item" id="btnagregar_mapa_eliminar" onclick="form_mapa_eliminar(true)"> Eliminar</a>
              </div>
            </li>  
          </ul>
        <?php } ?>
<div class="table-responsive">
          <div id="map_obra" style="width: 100%; height: 400px"></div>
        </div>                                  </div>
        <?php include('../../includes/ajax/AddMapa.php');
include('../../includes/ajax/DeleteMapa.php');
?>

                                </div>



                          </div></div></div>

<?php
$multa = array();
$multa[] = 0;
foreach ($certificados_multa as $c_mul):
  $multa[] = ($c_mul['avance'] * $obra['valormulta']);
endforeach;
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script><script>var ctx = document.getElementById('curva');var chart = new Chart(ctx, {type: 'line',data: {labels: <?php print json_encode($numero); ?>,datasets: [{label: "Certificados",fill:false,lineTension: 0,borderColor: 'rgb(249, 113, 113)',data: <?php print json_encode($avance); ?>,},{label: "Plan oficial",fill:false,lineTension: 0,borderColor: 'rgb(124, 213, 254)',data: <?php print json_encode($avanceplan); ?>,},{label: "Multa",fill:false,borderDash: [5,5],lineTension: 0,borderColor: 'rgb(216, 202, 215)',data: <?php print json_encode($multa); ?>,}]},options: {scales: {xAxes: [{ticks: {beginAtZero:true,suggestedMin:0}}],yAxes: [{ticks: {beginAtZero:true,min:0,max: 100}}]},tooltips: {enabled: true,mode: 'single',callbacks: {title: function (tooltipItem, data) {return "Certificado Nº " + data.labels[tooltipItem[0].index];},label: function(tooltipItems, data) {return "Avance: " + tooltipItems.yLabel + ' %';},footer: function (tooltipItem, data) { return ""; }}}}});</script>
<script>var map_obra = L.map('map_obra').invalidateSize(true).setView( [-32.287132632616355, -59.23828124999999], 7 );L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoiZnJhbmNpc2Nvam9zZWFyaW9saSIsImEiOiJjandhajByNDIwYWx0M3lrZGtkdHR6bGxtIn0.wVbgor3CUTqqfxbuxlzFmA', {attribution: '',fullscreenControl: true,maxZoom: 20,minZoom:6,id: 'mapbox.streets-satellite',accessToken: 'pk.eyJ1IjoiZnJhbmNpc2Nvam9zZWFyaW9saSIsImEiOiJjandhajByNDIwYWx0M3lrZGtkdHR6bGxtIn0.wVbgor3CUTqqfxbuxlzFmA'}).addTo(map_obra);map_obra.addControl(new L.Control.Fullscreen());$(document).ready(function() {add_punto();add_linea();});function add_punto() {for(var i=0; i<puntos.length; i++) {var marker = L.marker( [puntos[i]['latitud'], puntos[i]['longitud']]).addTo(map_obra);marker.bindPopup( "<b>" + puntos[i]['titulo']+"</b>");}}function stringToGeoPoints( geo ) {var linesPin = geo.split(",");var linesLat = new Array();var linesLng = new Array();for(i=0; i < linesPin.length; i++) {if(i % 2) {linesLat.push(linesPin[i]);}else{linesLng.push(linesPin[i]);}}var latLngLine = new Array();for(i=0; i<linesLng.length;i++) {latLngLine.push( L.latLng( linesLat[i], linesLng[i]));}return latLngLine;}function add_linea() {for(var i=0; i < lineas.length; i++) {var polyline = L.polyline( stringToGeoPoints(lineas[i]['georeferencia']), { color: lineas[i]['color']}).addTo(map_obra);polyline.bindPopup( "<b>" + lineas[i]['titulo']);   }}var puntos = <?php echo json_encode($mapa_puntos) ?>;var lineas = <?php echo json_encode($mapa_lineas) ?>;</script>
<?php } endforeach; ?>
<script type="text/javascript" src="includes/ajax/scripts/mapa.js"></script>
<script type="text/javascript">
  function recibir($caja,$idobra){
    var caja = $caja;
    var idobra = $idobra; 
    $("#caja").val(caja);        
    $("#idobra").val(idobra);   
    $("#caja2").val(caja);        
    $("#idobra2").val(idobra);            
  } 


  function confirmar(){
    var numero = $("#numero_informe").val();
    var fecha = $("#fecha_informe").val();
    var archivo_informe = $("#archivo_informe").val();    
    var archivo_personal = $("#archivo_personal").val();
    $("#confirmar_numero").html(numero);                      
    $("#confirmar_fecha").html(fecha);
    $("#confirmar_numero2").html(numero);                      
    $("#confirmar_fecha2").html(fecha);
    $("#confirmar_informe").html(archivo_informe.replace(/^.*\\/, "Informe_"));              
    $("#confirmar_personal").html(archivo_personal.replace(/^.*\\/, "Personal_"));       
  }   
</script>
<div id="modal_eliminar_plan_oficial"></div>
<div id="modal_eliminar_certificado"></div>
<div id="modal_eliminar_certificado_redeterminado"></div>
<script type="text/javascript" src="includes/ajax/scripts/certificados.js"></script>
<?php 
require_once('../modals/add_files.php');
require_once('../modals/edit_obra.php');
require_once('../modals/modificaciones.php');
require_once('../modals/ampliaciones.php');
require_once('../modals/neutralizaciones.php');
require_once('../modals/avance_obra.php');
require_once('../modals/montos_obra.php');
require_once('../modals/config_obra.php');
require_once('../modals/valor_multa.php');
require_once('../modals/plan_oficial.php');
require_once('../modals/certificados_aprobados.php');
require_once('../modals/certificados_redeterminados.php');
require_once('../modals/flujo_de_obra.php');
require_once('../modals/add_notas_de_pedido.php');
require_once('../modals/add_ordenes_de_servicio.php');
require_once('../modals/add_informe_inspeccion.php');
require_once('../modals/add_personal_inspeccion.php');
require_once('../modals/add_bacheo.php');
pie(); ?>
