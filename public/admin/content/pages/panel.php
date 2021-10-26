<?php
require_once('../../includes/load.php');

// USUARIOS
$user = current_user();
$user_director = find_by_id('departamentos','iddireccion',$user['iddireccion']);
$user_departamento = find_by_id('departamentos','iddepartamentos',$user['iddepartamentos']);
$all_users = find_all_user_msj('users',$user['id']);

$today = getdate();
$hora=$today["hours"];
$avisos = all_notificaciones_activos();
$videos_tutoriales = find_all('tutoriales');
// HEADER
cabecera('Mi Escritorio'); 
?>

<div class="container">

  <div class="row ">
  <?php if ($user['login'] != NULL) { ?>
    <p class="titulo-bienvenida p-20">¡Bienvenido de nuevo,
      <?php echo $user['nombre'] ?>!
    </p>
  <?php }else{ ?>
    <p class="titulo-bienvenida p-20">¡Te damos la bienvenida,
      <?php echo $user['nombre'] ?>!
    </p>
  <?php } ?>
</div>

  <div class="row">
    <div class="col-lg-12col-md-12 col-sm-12 offset-md-3">
      <div class="row justify-content-md-center">

        <div class="col-lg-6 col-md-6 col-sm-12">

          <div class="card" style="border: 1px solid #00000040;">
            <div class="card-body mx-4">
            <h2>Consultar expediente DPV</h2>
              <form method="post" action="consultas">
                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                      <label>Puede realizar el seguimiento de expediente de Vialidad ingresando el numero del expediente y haga click en Consultar</label>
                        <input type="number" name="numero" style="background: #f0f0f0;height:38px;" class="form-control"
                          autocomplete="off" placeholder="" required>
                          <br><br>
                          <button type="submit" class="btn btn-dark btn-rounded" style="">Consultar</button>
                
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>

        </div>

        <div class="col-lg-6 col-md-6 col-sm-12">


          <div class="card" style="border: 1px solid #00000040;">
            <div class="card-body mx-4">
            <h2>Consultar informe de obra</h2>
              <div class="row">
                <div class="col-12"><label>Puede consultar el informe completo de las obras y proyectos, para esto debe ingresar en el buscador el titulo de obra o su numero de expediente y haga click en la opcion que corresponda.</label>
                  <br><br>
                    <input type="search" style="background: #f0f0f0;" class="form-control" aria-controls="1"
                      id="busqueda">
                  <br><br>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
      




    </div>
  </div>
  
  
  
  
  <?php 

if($user['iddepartamentos'] == 8){ include_once('paneles/construcciones/8.php') ;}  
  
  ?>
  <?php if(!permiso('observador')){ ?>
<div class="p-20">
<div class="owl-carousel accesos-directos">
<!-- inic ITEM -->
<div class="card"  style="border: 1px solid #00000040;height:100%;"> 
<div class="card-body mx-2">
<a href="tramites"><div class="text-dark" style="margin-left:20px;margin-right:20px;font-weight:700;"><i class="fa fa-file-alt fa-3x"></i><br><br><h5>Tramites</h5></div></a> 
</div>
</div>
<div class="card"  style="border: 1px solid #00000040;height:100%;"> 
<div class="card-body mx-2">
<a href="memorandums"><div class="text-dark" style="margin-left:20px;margin-right:20px;font-weight:700;"><i class="fa fa-book fa-3x"></i><br><br><h5>Memorandums</h5></div></a>
</div>
</div>
<div class="card"  style="border: 1px solid #00000040;height:100%;"> 
<div class="card-body mx-2">
<a href="recepciones"><div class="text-dark" style="margin-left:20px;margin-right:20px;font-weight:700;"><i class="fa fa-book fa-3x"></i><br><br><h5>Recepciones</h5></div></a>
</div>
</div>
<div class="card"  style="border: 1px solid #00000040;height:100%;"> 
<div class="card-body mx-2">
<a href="obras"><div class="text-dark" style="margin-left:20px;margin-right:20px;font-weight:700;"><i class="fa fa-snowplow fa-3x"></i><br><br><h5>Informes de obras</h5></div></a>
</div>
</div>
<div class="card"  style="border: 1px solid #00000040;height:100%;"> 
<div class="card-body mx-2">
<a href="flujo-obras"><div class="text-dark" style="margin-left:20px;margin-right:20px;font-weight:700;"><i class="fa fa-folder-open fa-3x"></i><br><br><h5>Flujo de obras</h5></div></a>
</div>
</div>
<div class="card"  style="border: 1px solid #00000040;height:100%;"> 
<div class="card-body mx-2">
<a href="certificados"><div class="text-dark" style="margin-left:20px;margin-right:20px;font-weight:700;"><i class="fa fa-folder-open fa-3x"></i><br><br><h5>Certificados de obras</h3></div></a>
</div>
</div>
<div class="card"  style="border: 1px solid #00000040;height:100%;"> 
<div class="card-body mx-2">
<a href="certificados-redeterminados"><div class="text-dark" style="margin-left:20px;margin-right:20px;font-weight:700;"><i class="fa fa-folder-open fa-3x"></i><br><br><h5>Cert. redeterminados</h5></div></a>
</div>
</div>
<!-- fin item -->
</div>
</div>
<?php } ?>
  
  
  
  
<ul class="nav nav-tabs" id="dashboard-tab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="tutoriales-tab" data-toggle="tab" href="#tutoriales" role="tab" aria-controls="tutoriales" aria-selected="true">ULTIMOS REGISTROS</a>
  </li>
</ul>      <div class="row">
    <p class="titulo-bienvenida p-10">
    </p>
  </div>
<div id="main">
  <div class="container">
<div class="accordion" id="faq">
                    <div class="card">
                        <div class="card-header" id="faqhead1">
                            <a href="#" class="btn btn-header-link" style="font-weight:700;color:#000;" data-toggle="collapse" data-target="#faq1"
                            aria-expanded="true" aria-controls="faq1">TRAMITES</a>
                        </div>

                        <div id="faq1" class="collapse" aria-labelledby="faqhead1" data-parent="#faq">
                            <div class="card-body">
          <div class="row">
    <p class="titulo-card-escritorio p-20">
   Ultimos tramites ingresados
    </p>
  </div>
<div class="p-20">
<div class="owl-carousel ultimos-tramites">
<!-- inic ITEM -->
<?php $ultimos_expedientes = ultimos_valores_tabla('tramites','','idtramites','10'); 
foreach($ultimos_expedientes as $row): 
$ultimo_log = ultimo_tramite_log($row['idtramites']);
$etiquetas = etiquetas_tramite($row["idtramites"]);
 ?>
<div class="card"  style="border: 1px solid #00000040;height:100%;"> 
<div class="card-body mx-2">
<label class="control-label text-muted" style="font-size:11px;">Numero de tramite</label>
<h4><a style="color:blue;" onclick="movs_expediente(<?php echo $row['numero']; ?>)" title="Ver movimientos"><?php echo $row['numero']; ?></a></h4>
<label class="control-label text-muted" style="font-size:11px;">Asunto</label>
<p><?php echo $row['asunto']; ?></p>
<label class="control-label text-muted" style="font-size:11px;">Tipo de tramite</label>
<h4><?php echo ucfirst($row['tipo']); ?></h4>
<label class="control-label text-muted" style="font-size:11px;">Fecha de ingreso</label>
<p><?php echo $row['fecha_inicio']; ?></p>
<label class="control-label text-muted" style="font-size:11px;">Ultimo movimiento</label>
<p><?php $ultimo_pase = ultimo_pase_tramite($row["idtramites"]); if(isset($ultimo_pase)){ echo $ultimo_pase['fecha']; }else{ echo $row['fecha_inicio']; } ?></p>

<label class="control-label text-muted" style="font-size:11px;">Etiquetas</label>
<h4><?php echo nombre_etiquetas($etiquetas); ?></h4>


</div><div class="card-footer">
<p><a href="tramite?id=<?php echo $row['numero']; ?>">Ver tramite</a></p>
</div>
</div>
<?php endforeach; ?>
<!-- fin item -->
</div>
</div>
<div class="row">
    <p class="titulo-card-escritorio p-20">
   Ultimos movimientos de tramites
    </p>
  </div>
<div class="p-20">
<div class="owl-carousel ultimos-tramites">
<!-- inic ITEM -->
<?php $ultimos_expedientes = ultimos_valores_tabla('tramites_movimientos','','idtramites_movimientos','10'); 
foreach($ultimos_expedientes as $row): 
$tramite = find_by_id('tramites','idtramites',$row['idtramites']);

$ultimo_log = ultimo_tramite_log($row['idtramites']);
$etiquetas = etiquetas_tramite($row["idtramites"]);
 ?>
<div class="card"  style="border: 1px solid #00000040;height:100%;"> 
<div class="card-body mx-2">
<label class="control-label text-muted" style="font-size:11px;">Numero de tramite</label>
<h4><a style="color:blue;" onclick="movs_expediente(<?php echo $tramite['numero']; ?>)" title="Ver movimientos"><?php echo $tramite['numero']; ?></a></h4>
<label class="control-label text-muted" style="font-size:11px;">Asunto</label>
<p><?php echo $tramite['asunto']; ?></p>
<label class="control-label text-muted" style="font-size:11px;">Tipo de tramite</label>
<h4><?php echo ucfirst($tramite['tipo']); ?></h4>
<label class="control-label text-muted" style="font-size:11px;">Ultimo movimiento</label>
<p><?php $ultimo_pase = ultimo_pase_tramite($tramite["idtramites"]); if(isset($ultimo_pase)){ echo $ultimo_pase['fecha']; }else{ echo $row['fecha_inicio']; } ?></p>

<label class="control-label text-muted" style="font-size:11px;">Etiquetas</label>
<h4><?php echo nombre_etiquetas($etiquetas); ?></h4>


</div><div class="card-footer">
<p><a href="tramite?id=<?php echo $tramite['numero']; ?>">Ver tramite</a></p>
</div>
</div>
<?php endforeach; ?>
<!-- fin item -->
</div>
</div>
<div class="row">
    <p class="titulo-card-escritorio p-20">
   Ultimas recepciones de obras
    </p>
  </div>
<div class="p-20">
<div class="owl-carousel ultimas-recepciones">
<!-- inic ITEM -->
<?php $ultimas_recepciones = ultimos_valores_tabla('recepciones','','idrecepciones','10'); 
foreach($ultimas_recepciones as $row): 
$recepcion = find_by_id('recepciones','idrecepciones',$row['idrecepciones']);
 ?>
<div class="card"  style="border: 1px solid #00000040;height:100%;"> 
<div class="card-body mx-2">
<h4><?php if($row['tipo'] == 'rp'){ echo 'Recepcion Provisoria'; }elseif($row['tipo'] == 'rd'){ echo 'Recepcion Definitiva'; } ?></h4>
<label class="control-label text-muted" style="font-size:11px;">Expediente</label>
<p><a style="color:blue;" onclick="movs_expediente(<?php echo $row['idexpedientes']; ?>)" title="Ver movimientos"><?php echo $row['idexpedientes']; ?></a></p>
<?php if($row['fecha_pedido'] != NULL && $row['fecha_pedido'] != '0000-00-00'){ ?>
<label class="control-label text-muted" style="font-size:11px;">Fecha de pedido</label> 
<p><?php echo format_date($row['fecha_pedido']); ?></p>
<?php } ?>  
<?php if(ifexist($r['idexpedientes'])){ ?>
<label class="control-label text-muted" style="font-size:11px;">Inicio del tramite</label> 
<p><?php echo ifdate($inicio_exp['fechareg']); ?></p>
<label class="control-label text-muted" style="font-size:11px;">Movimiento del tramite</label> 
<p><?php echo utf8_encode($ul_mov_exp['tramite']).' desde '.format_date($ul_mov_exp['fecha']); ?></p>
<?php } ?>            
<?php if(!empty($r['comision_agente1']) || !empty($r['comision_agente2']) || !empty($r['comision_agente3']) || !empty($r['comision_agente4'])){ ?>     
<label class="control-label text-muted" style="font-size:11px;">Comision de recepcion</label>                  
<?php 
if(!empty($r['comision_agente1'])){ echo '<p>'.$r['comision_agente1'].'</p>';}
if(!empty($r['comision_agente2'])){ echo '<p>'.$r['comision_agente2'].'</p>';} 
if(!empty($r['comision_agente3'])){ echo '<p>'.$r['comision_agente3'].'</p>'; } 
if(!empty($r['comision_agente4'])){ echo '<p>'.$r['comision_agente4'].'</p>'; } }
?>
<label class="control-label text-muted" style="font-size:11px;">Acta de recepcion</label>      
<p><?php if($r['recibido_estado'] == NULL){ echo 'Sin definir<br/>'; }
if($r['recibido_estado'] === '0'){ echo 'Sin recibir<br/>'; }
if($r['recibido_estado'] === '1'){ echo 'Recibido el '.ifdate($r['acta_resolucion_proyecto']).'<br/>'; } ?></p>
<?php if(!empty($r['acta_resolucion'])){ ?>
 <label class="control-label text-muted" style="font-size:11px;">Resolucion de recepcion</label> 
 <p> <?php echo $r['acta_resolucion']; if(!empty($r['acta_fecha'])){ echo ' con fecha '.ifdate($r['acta_fecha']);} ?></p>
<?php } ?>
<?php if(!empty($r['observaciones'])){ ?>
 <label class="control-label text-muted" style="font-size:11px;">Observaciones</label> 
  <p><?php echo textarea($r['observaciones']); ?> </p><?php  } ?>

</div><div class="card-footer">
<p><a href="recepcion?id=<?php echo $row['idrecepciones']; ?>">Ver recepcion</a></p>
</div>
</div>
<?php endforeach; ?>
<!-- fin item -->
</div>
</div>

                            </div>
                        </div>
                    </div>

                    <br>
                    <div class="card">
                        <div class="card-header" id="faqhead2">
                            <a href="#" class="btn btn-header-link collapsed" style="font-weight:700;color:#000;" data-toggle="collapse" data-target="#faq2"
                            aria-expanded="true" aria-controls="faq2">OBRAS</a>
                        </div>

                        <div id="faq2" class="collapse" aria-labelledby="faqhead2" data-parent="#faq">
                            <div class="card-body">
          <div class="row">
    <p class="titulo-card-escritorio p-20">
   Ultimas Obras contratadas
    </p>
  </div>
<div class="p-20">
<div class="owl-carousel ultimas-obras">
<!-- inic ITEM -->
<?php $ultimas_obras_contratadas = ultimos_valores_tabla('obras','WHERE estado=0','idobras','10');
foreach($ultimas_obras_contratadas as $row): ?>
<div class="card"  style="border: 1px solid #00000040;height:100%;"> 
<div class="card-body mx-2">
<label class="control-label text-muted" style="font-size:11px;">Titulo</label>
<p><?php echo substr(ifexist($row['nombre']), 0, 50).'...'; ?></p>
<label class="control-label text-muted" style="font-size:11px;">Expediente</label>
<p><a style="color:blue;" onclick="movs_expediente(<?php echo $row['expediente']; ?>)" title="Ver movimientos"><?php echo $row['expediente']; ?></a></p>
<label class="control-label text-muted" style="font-size:11px;">Estado</label>
<p><?php  if($row['estado'] == 0){ echo 'En ejecucion'; }
           if($row['estado'] == 3 && $row['recepcion'] == 0){ echo 'Finalizada sin recibir'; }
           if($row['estado'] == 3 && $row['recepcion'] == 1){ echo 'En garantia'; }
           if($row['estado'] == 3 && $row['recepcion'] == 2){ echo 'Finalizada definitiva'; }
           if($row['estado'] == 4){ echo 'Neutralizada'; }
           if($row['estado'] == 5){ echo 'Rescindida'; } ?></p>
</div>
<div class="card-footer">
<p><a href="obra?id=<?php echo $row['idobras']; ?>">Ver Informe de Obra</a></p>
</div>
</div>
<?php endforeach; ?>
<!-- fin item -->
</div>
</div>

   <div class="row">
    <p class="titulo-card-escritorio p-20">
   Ultimas Modificaciones de obras
    </p>
  </div>
<div class="p-20">
<div class="owl-carousel ultimas-modificaciones-obras">
<!-- inic ITEM -->
<?php $ultimas_modificaciones_obras = ultimos_valores_tabla('obras_modificaciones','','idmodificaciones','10');
foreach($ultimas_modificaciones_obras as $row): 
$obra = find_by_id('obras','idobras',$row['idobras']);  ?>
<div class="card"  style="border: 1px solid #00000040;height:280px;"> 
<div class="card-body mx-2">
<p><?php echo $row['numero']; ?>° Modificacion de obra</p>
<label class="control-label text-muted" style="font-size:11px;">Expediente</label>
<p><a style="color:blue;" onclick="movs_expediente(<?php echo $row['expediente']; ?>)" title="Ver movimientos"><?php echo $row['expediente']; ?></a></p>
<label class="control-label text-muted" style="font-size:11px;">Obra</label>
<p><?php echo substr(ifexist($obra['nombre']), 0, 50).'...'; ?></p>
</div>
<div class="card-footer">
<p><a href="obra?id=<?php echo $row['idobras']; ?>">Ver Informe de Obra</a></p>
</div>
</div>
<?php endforeach; ?>
<!-- fin item -->
</div>
</div>
<div class="row">
    <p class="titulo-card-escritorio p-20">
   Ultimas Ampliaciones de obras
    </p>
  </div>
<div class="p-20">
<div class="owl-carousel ultimas-ampliaciones-obras">
<!-- inic ITEM -->
<?php $ultimas_ampliaciones_obras = ultimos_valores_tabla('obras_ampliaciones','','idampliaciones','10');
foreach($ultimas_ampliaciones_obras as $row): 
$obra = find_by_id('obras','idobras',$row['idobras']);  ?>
<div class="card"  style="border: 1px solid #00000040;height:280px;"> 
<div class="card-body mx-2">
<p><?php echo $row['numero']; ?>° Ampliacion de plazo</p>
<label class="control-label text-muted" style="font-size:11px;">Expediente</label>
<p><a style="color:blue;" onclick="movs_expediente(<?php echo $row['expediente']; ?>)" title="Ver movimientos"><?php echo $row['expediente']; ?></a></p>
<label class="control-label text-muted" style="font-size:11px;">Obra</label>
<p><?php echo substr(ifexist($obra['nombre']), 0, 50).'...'; ?></p>
</div>
<div class="card-footer">
<p><a href="obra?id=<?php echo $row['idobras']; ?>">Ver Informe de Obra</a></p>
</div>
</div>
<?php endforeach; ?>
<!-- fin item -->
</div>
</div>
<div class="row">
    <p class="titulo-card-escritorio p-20">
   Ultimas Neutralizaciones de obras
    </p>
  </div>
<div class="p-20">
<div class="owl-carousel ultimas-neutralizaciones-obras">
<!-- inic ITEM -->
<?php $ultimas_neutralizaciones_obras = ultimos_valores_tabla('obras_neutralizaciones','','idneutralizaciones','10');
foreach($ultimas_neutralizaciones_obras as $row): 
$obra = find_by_id('obras','idobras',$row['idobras']);  ?>
<div class="card"  style="border: 1px solid #00000040;height:280px;"> 
<div class="card-body mx-2">
<p><?php echo $row['numero']; ?>° Neutralizacion de obra</p>
<label class="control-label text-muted" style="font-size:11px;">Expediente</label>
<p><a style="color:blue;" onclick="movs_expediente(<?php echo $row['expediente']; ?>)" title="Ver movimientos"><?php echo $row['expediente']; ?></a></p>
<label class="control-label text-muted" style="font-size:11px;">Obra</label>
<p><?php echo substr(ifexist($obra['nombre']), 0, 50).'...'; ?></p>
</div>
<div class="card-footer">
<p><a href="obra?id=<?php echo $row['idobras']; ?>">Ver Informe de Obra</a></p>
</div>
</div>
<?php endforeach; ?>
<!-- fin item -->
</div>
</div>
              <div class="row">
    <p class="titulo-card-escritorio p-20">
   Eventos recientes
    </p>
  </div>
<div class="p-20">
<div class="owl-carousel eventos-obras">
<!-- inic ITEM -->
<?php $ultimos_eventos_obras = ultimos_eventos('obra','10');
foreach($ultimos_eventos_obras as $row): 
$obra = find_by_id('obras','idobras',$row['dato']);  ?>
<div class="card"  style="border: 1px solid #00000040;height:280px;"> 
<div class="card-body mx-2">
<label class="control-label text-muted" style="font-size:11px;">Evento</label>
<p><?php echo $row['evento']; ?></p>
<label class="control-label text-muted" style="font-size:11px;">Fecha</label>
<p><?php echo $row['fecha']; ?></p>
</div>
<div class="card-footer">
<p><?php echo substr(ifexist($obra['nombre']), 0, 50).'...'; ?></p>
<p><a href="obra?id=<?php echo $row['dato']; ?>">Ver Informe de Obra</a></p>
</div>
</div>
<?php endforeach; ?>
<!-- fin item -->
</div>
</div>
                            </div>
                        </div>
                    </div><br>
                    <div class="card">
                        <div class="card-header" id="faqhead3">
                            <a href="#" class="btn btn-header-link collapsed" style="font-weight:700;color:#000;" data-toggle="collapse" data-target="#faq3"
                            aria-expanded="true" aria-controls="faq3">CERTIFICADOS</a>
                        </div>

                        <div id="faq3" class="collapse" aria-labelledby="faqhead3" data-parent="#faq">
                            <div class="card-body">
          <div class="row">
    <p class="titulo-card-escritorio p-20">
   Ultimos Certificados de Obras
    </p>
  </div>
<div class="p-20">
<div class="owl-carousel ultimos-certificados">
<!-- inic ITEM -->
<?php $ultimos_certificados = ultimos_valores_tabla('certificados_obras','','idcertificados_obras','10');
foreach($ultimos_certificados as $row): 
$obra = find_by_id('obras','idobras',$row['idobras']);  ?>
<div class="card"  style="border: 1px solid #00000040;height:100%;"> 
<div class="card-body mx-2">
<p>   <?php if($row['numero'] == 0){
        echo 'Anticipo financiero';
        
        }else{
        echo 'Certificado N° '.$row['numero'];
        } ?></p>
<label class="control-label text-muted" style="font-size:11px;">Estado</label>
<p><?php if($row['estado'] == 0){ echo 'Confeccionado'; }elseif($row['estado'] == 1){ echo 'Emitido' ; }elseif($row['estado'] == 2){ echo 'Aprobado'; }elseif($row['estado'] == 3){ echo 'En Revision'; }?></p>
<?php if(!empty($row['expediente'])){ ?>
<label class="control-label text-muted" style="font-size:11px;">Expediente</label>
<p><a style="color:blue;" onclick="movs_expediente(<?php echo $row['expediente']; ?>)" title="Ver movimientos"><?php echo $row['expediente']; ?></a></p>
<?php } ?>
<label class="control-label text-muted" style="font-size:11px;">Obra</label>
<p><?php echo $obra['numero'].' - '.$obra['expediente'].'<br>'.$obra['alias']; ?></p>
<p><a href="obra?id=<?php echo $obra['idobras']; ?>">Ver Informe de Obra</a></p>
</div>
<div class="card-footer">
<a href="../uploads/Obras/<?php echo $obra['idobras']; ?>/Certificaciones/Certificados/<?php echo $row['archivo_copia']; ?>" target="_blank">Ver Certificado</a>
</div>
</div>
<?php endforeach; ?>
<!-- fin item -->
</div>
</div>

                            </div>
                        </div>
                    </div><br>                    
                    <div class="card">
                        <div class="card-header" id="faqhead4">
                            <a href="#" class="btn btn-header-link collapsed" style="font-weight:700;color:#000;" data-toggle="collapse" data-target="#faq4"
                            aria-expanded="true" aria-controls="faq4">REDETERMINACIONES</a>
                        </div>

                        <div id="faq4" class="collapse" aria-labelledby="faqhead4" data-parent="#faq">
                            <div class="card-body">
          <div class="row">
    <p class="titulo-card-escritorio p-20">
   Ultimos Certificados Redeterminados
    </p>
  </div>
<div class="p-20">
<div class="owl-carousel ultimos-certificados-redeterminados">
<!-- inic ITEM -->
<?php $ultimos_certificados_redeterminados = ultimos_valores_tabla('certificados_obras_redeterminados','','idcertificados_obras_redeterminados','10');
foreach($ultimos_certificados_redeterminados as $row): 
$obra = find_by_id('obras','idobras',$row['idobras']);  ?>
<div class="card"  style="border: 1px solid #00000040;height:220px;"> 
<div class="card-body mx-2">
<p>   <?php        echo 'Certificado N° '.$row['numero'];
        ?></p>
<label class="control-label text-muted" style="font-size:11px;">Expediente</label>
<p><a style="color:blue;" onclick="movs_expediente(<?php echo $row['expediente']; ?>)" title="Ver movimientos"><?php echo $row['expediente']; ?></a></p>
</div>
<div class="card-footer">
<p>Ver informe completo</p>
</div>
</div>
<?php endforeach; ?>
<!-- fin item -->
</div>
</div>
              <div class="row">
    <p class="titulo-card-escritorio p-20">
   Ultimos Precios Aprobados
    </p>
  </div>
<div class="p-20">
<div class="owl-carousel ultimos-certificados-redeterminados">
<!-- inic ITEM -->
<?php $ultimos_precios_actualizados = ultimos_valores_tabla('redeterminaciones','','idredeterminaciones_actas','10');
foreach($ultimos_precios_actualizados as $row): 
$obra = find_by_id('obras','idobras',$row['idobras']);  ?>
<div class="card"  style="border: 1px solid #00000040;height:220px;"> 
<div class="card-body mx-2">
<p>   <?php        echo ' N° '.$row['numero'];
        ?></p>
<label class="control-label text-muted" style="font-size:11px;">Expediente</label>
<p><a style="color:blue;" onclick="movs_expediente(<?php echo $row['expediente']; ?>)" title="Ver movimientos"><?php echo $row['expediente']; ?></a></p>
</div>
<div class="card-footer">
<p>Ver informe completo</p>
</div>
</div>
<?php endforeach; ?>
<!-- fin item -->
</div>
</div>
                            </div>
                        </div>
                    </div>
                </div>
    </div>
  </div>
  <br><br>
<ul class="nav nav-tabs" id="dashboard-tab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="tutoriales-tab" data-toggle="tab" href="#tutoriales" role="tab" aria-controls="tutoriales" aria-selected="true">TUTORIALES GENERALES</a>
  </li>
</ul>
<div class="tab-content" id="dashboard-tab-content">  
  <div class="tab-pane fade show active" id="tutoriales" role="tabpanel" aria-labelledby="tutoriales-tab">
      <div class="row">
    <p class="titulo-bienvenida p-20">
    </p>
  </div>
<div class="container">
<div class="row">
<div class="col-12">
<div id="events" class="event-list owl-carousel owl-loaded owl-drag">
<div class="owl-stage-outer">
<div class="owl-stage">  
<?php foreach($videos_tutoriales as $tuto): 
?>  
<div class="owl-item " style="width: 350px;">
<div class="event-item">
<span style="font-size: 14px;font-weight:700;"><?php echo $tuto['titulo']; ?></span><br><br>
<video src="../uploads/Tutoriales/<?php echo $tuto['archivo']; ?>" width="100%" height="150px" controls ></video>
<!--<div class="event-schedule">
<svg viewBox="0 0 24 24" width="24" height="24" style="color:#E0B226; stroke-width: 3px;" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1 event-icon"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg>
<span class="event-day"></span>-->
<div class="event-month-time"><br>
<span><?php echo $tuto['descripcion']; ?></span>
</div>
<!--</div>
<a  target="_blank" class="event-title">Ver documento pdf</a>
<a target="_blank" class="event-title">Ver obra</a>-->
<p class="event-content"></p>

</div>
</div>
<?php endforeach; ?>
</div>
</div>
</div>
<div class="owl-dots disabled"></div>
</div>
</div>
</div>  
  </div>

</div>
  
  <?php foreach($avisos as $aviso): ?>
  <script>
    $.notify({
      // options
      icon: '<?php echo $aviso['icon']; ?>',
      title: '<?php echo $aviso['asunto']; ?>',
      message: '<?php echo $aviso['mensaje']; ?>',
      url: '<?php echo $aviso['url']; ?>',
      target: '_blank'
    }, {
      // settings
      element: 'body',
      position: null,
      type: "info",
      allow_dismiss: true,
      newest_on_top: false,
      showProgressbar: false,
      placement: {
        from: "bottom",
        align: "right"
      },
      offset: 20,
      spacing: 10,
      z_index: 1031,
      delay: 5000,
      timer: 1500,
      url_target: '_blank',
      mouse_over: null,
      animate: {
        enter: 'animated fadeInDown',
        exit: 'animated fadeOutUp'
      },
      onShow: null,
      onShown: null,
      onClose: null,
      onClosed: null,
      icon_type: 'class',
      template: '<div data-notify="container" class="col-xl-3 col-lg-3 col-md-4 col-sm-11 col-11 alert alert-{0}" role="alert">' +
        '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
        '<span data-notify="icon"></span> ' +
        '<span data-notify="title" style="font-weight:800px;font-size:14px;">{1}</span><hr style="margin-top:5px;margin-bottom:10px;"> ' +
        '<span data-notify="message">{2}</span>' +
        '<div class="progress" data-notify="progressbar">' +
        '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
        '</div>' +
        '<a href="{3}" target="{4}" data-notify="url"></a>' +
        '</div>'
    });
  </script>
  
  <?php endforeach; ?>
  <script type="text/javascript" src="includes/ajax/scripts/escritorio.js"></script>
  <?php pie(); ?>