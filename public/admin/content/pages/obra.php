<?php
require_once('../../includes/load.php');
$obra_id=$_GET['id'];
$user = current_user();
$obra = find_by_id('obras','idobras',(int)$_GET['id']);  
if($obra['estado'] == 1){ redirect('proyecto?id='.$obra_id, false); }
require_once('../../includes/functions/obras.php');  
require_once('../../includes/functions/obras_items.php');  
require_once('../../includes/functions/certificados.php');  
require_once('../../includes/functions/cotizaciones.php');  
require_once('../../includes/functions/planes_de_trabajo.php');  
require_once('../../includes/functions/php_file_tree.php');   
require_once("../../includes/functions/map.php"); 
require_once('../../../uploads/files.php'); 
$ejecutados = all_oyp();
$certificados = certificados_obras($obra_id);


$certificados_adec = certificados_redeterminados_obras($obra_id);

if(!empty($obra['idplanes_de_trabajo']) && $obra['idplanes_de_trabajo'] != 0 && $obra['idplanes_de_trabajo'] != NULL){
    $certificados_plan = plan_oficial_obras($obra_id,$obra['idplanes_de_trabajo']);
    $certificados_multa = plan_oficial_obras($obra_id,$obra['idplanes_de_trabajo']);
    }
$ordenes = ordenes_de_servicio($obra_id);
$notas = notas_de_pedido($obra_id);
$all_user = all_usuarios();
$obra_bacheo = obra_bacheo($obra_id);
$inspeccion_informe = informes_inspeccion($obra_id);   
$inspeccion_asistencia = asistencias_inspeccion($obra_id);  
$inspectores = all_inspectores();

cabecera('Obra: '.$obra['nombre']);
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
$recepciones_obra = recepciones_obra($obra['idobras']);
$equipo_inspector = equipo_inspector($user['id'],$obra['idobras']);
$planes_de_trabajo = obra_mod_planes($obra['idobras']);
?>
<script>
function resultadoobra(id){
var id = id;
$('#info_obra').hide();
$.post("content/forms/certificado.php", {obra_id: id}, function(result){
$("#crear-certificado").html(result);
});
}
function editar_certificadoobra(id,obra){
var id = id;
var obra = obra;
$('#info_obra').hide();
$.post("content/forms/edit_certificado.php", {cert_id: id, obra_id: obra}, function(result){
$("#crear-certificado").html(result);
});
}
</script>
<div id="info_obra" style="display: none;">
<div class="container-fluid" >

<div class="row justify-content-center">
<div class="col-12">
<div class="d-flex flex-wrap p-b-30">
<div class="my-auto ml-3">

<h1 class="titulo-bienvenida">Informe de Obra</h1>
</div>
<div class="ml-auto my-auto mr-3">
<a class="i-dt-list btn btn-dark btn-warning btn-rounded" style="font-size:12px" onclick="estado_informe(<?php echo $obra['idobras']; ?>)" data-toggle="tooltip" title="Haga click para ver">Estado del informe</a>
</div>
</div>
</div>
</div>

<div class="card">
<ul class="nav nav-tabs customtab" role="tablist">

<?php if(permiso('admin') || permiso('inspeccion') && $obra['idinspector'] == $user['id'] || $equipo_inspector['idusuario'] == $user['id'] || permiso('obras') || permiso('certificaciones')){ ?>
<li class="nav-item">
<a class="nav-link" style="padding:10px 15px 10px 15px" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
Agregar
</a>
<div class="dropdown-menu dropdown-item-theme" aria-labelledby="dropdownMenuButton">
<?php 
if(permiso('admin')){ ?>
<a class="dropdown-item dropdown-item-theme" title="Cargar datos" onclick="resultadoobra(<?php echo $obra['idobras']; ?>)">Certificado de obra</a>
<a class="dropdown-item dropdown-item-theme" title="Cargar datos" id="texto"  data-toggle="modal" data-target="#add_informe_inspeccion" onclick="recibir(<?php echo $obra['numero']; ?>,<?php echo $obra['idobras']; ?>);">Informe de computo</a>
<a class="dropdown-item dropdown-item-theme" title="Cargar datos" id="texto"  data-toggle="modal" data-target="#add_personal_inspeccion" onclick="recibir(<?php echo $obra['numero']; ?>,<?php echo $obra['idobras']; ?>);">Asistencia de personal</a>
<a class="dropdown-item dropdown-item-theme" data-toggle="modal" data-target="#add_ordenes_de_servicio">Orden de servicio</a>
<a class="dropdown-item dropdown-item-theme" data-toggle="modal" data-target="#add_notas_de_pedido">Nota de pedido</a>
<!--<a class="dropdown-item dropdown-item-theme" data-toggle="modal" data-target="#add_foto_obra">Fotos de obra</a>-->
<a class="dropdown-item dropdown-item-theme" title="Cargar datos" data-toggle="modal" data-target="#add_files">Archivos de obra</a>
<a class="dropdown-item dropdown-item-theme" title="Cargar datos"  onclick="form_agregar_modificacion(true)">Modificacion de obra</a>
<a class="dropdown-item dropdown-item-theme" title="Cargar datos" onclick="form_agregar_ampliacion(true)">Ampliacion de plazo</a>
<a class="dropdown-item dropdown-item-theme" title="Cargar datos" onclick="form_agregar_neutralizacion(true)">Neutralizacion de obra</a>
<a class="dropdown-item dropdown-item-theme" title="Cargar datos" onclick="form_agregar_recepcion(true)">Recepcion de obra</a>
<a class="dropdown-item dropdown-item-theme" title="Cargar datos" onclick="form_agregar_mod_plandetrabajo(true)">Modif. plan de trabajo</a>
<!--<a class="dropdown-item dropdown-item-theme" data-toggle="modal" data-target="#modificaciones">Modificacion de obra</a>
<a class="dropdown-item dropdown-item-theme" data-toggle="modal" data-target="#ampliaciones">Ampliacion de obra</a>
<a class="dropdown-item dropdown-item-theme" data-toggle="modal" data-target="#neutralizaciones">Neutralizacion de obra</a>-->
<?php
}else{
if(permiso('inspeccion') && $obra['idinspector'] == $user['id'] || permiso('inspeccion') && $equipo_inspector['idusuario'] == $user['id']){ ?>
<a class="dropdown-item dropdown-item-theme" title="Cargar datos" onclick="resultadoobra(<?php echo $obra['idobras']; ?>)">Certificado de obra</a>
<a class="dropdown-item dropdown-item-theme" title="Cargar datos" id="texto"  data-toggle="modal" data-target="#add_informe_inspeccion" onclick="recibir(<?php echo $obra['numero']; ?>,<?php echo $obra['idobras']; ?>);">Informe de computo</a>
<a class="dropdown-item dropdown-item-theme" title="Cargar datos" id="texto"  data-toggle="modal" data-target="#add_personal_inspeccion" onclick="recibir(<?php echo $obra['numero']; ?>,<?php echo $obra['idobras']; ?>);">Asistencia de personal</a>
<a class="dropdown-item dropdown-item-theme" data-toggle="modal" data-target="#add_ordenes_de_servicio">Orden de servicio</a>
<a class="dropdown-item dropdown-item-theme" data-toggle="modal" data-target="#add_notas_de_pedido">Nota de pedido</a>
<!--<a class="dropdown-item dropdown-item-theme" data-toggle="modal" data-target="#add_foto_obra">Fotos de obra</a>-->
<?php }
if(permiso('certificaciones')){ ?>
<a class="dropdown-item dropdown-item-theme" title="Cargar datos" onclick="resultadoobra(<?php echo $obra['idobras']; ?>)">Certificado de obra</a>


<!--<a class="dropdown-item dropdown-item-theme" data-toggle="modal" data-target="#modificaciones">Modificacion de obra</a>
<a class="dropdown-item dropdown-item-theme" data-toggle="modal" data-target="#ampliaciones">Ampliacion de obra</a>
<a class="dropdown-item dropdown-item-theme" data-toggle="modal" data-target="#neutralizaciones">Neutralizacion de obra</a>-->
<?php }
if(permiso('obras')){ ?>

<a class="dropdown-item dropdown-item-theme" title="Cargar datos" data-toggle="modal" data-target="#add_files">Archivos de obra</a>

<a class="dropdown-item dropdown-item-theme" title="Cargar datos" onclick="form_agregar_modificacion(true)">Modificacion de obra</a>
<a class="dropdown-item dropdown-item-theme" title="Cargar datos" onclick="form_agregar_ampliacion(true)">Ampliacion de plazo</a>
<a class="dropdown-item dropdown-item-theme" title="Cargar datos" onclick="form_agregar_neutralizacion(true)">Neutralizacion de obra</a>
<a class="dropdown-item dropdown-item-theme" title="Cargar datos" onclick="form_agregar_mod_plandetrabajo(true)">Modif. plan de trabajo</a>
<a class="dropdown-item dropdown-item-theme" title="Cargar datos" onclick="form_agregar_recepcion(true)">Recepcion de obra</a>
<?php if(permiso('inspeccion')){?>
    <a class="dropdown-item dropdown-item-theme" title="Cargar datos" onclick="resultadoobra(<?php echo $obra['idobras']; ?>)">Certificado de obra</a>
<a class="dropdown-item dropdown-item-theme" title="Cargar datos" id="texto"  data-toggle="modal" data-target="#add_informe_inspeccion" onclick="recibir(<?php echo $obra['numero']; ?>,<?php echo $obra['idobras']; ?>);">Informe de computo</a>
<a class="dropdown-item dropdown-item-theme" title="Cargar datos" id="texto"  data-toggle="modal" data-target="#add_personal_inspeccion" onclick="recibir(<?php echo $obra['numero']; ?>,<?php echo $obra['idobras']; ?>);">Asistencia de personal</a>
<a class="dropdown-item dropdown-item-theme" data-toggle="modal" data-target="#add_ordenes_de_servicio">Orden de servicio</a>
<a class="dropdown-item dropdown-item-theme" data-toggle="modal" data-target="#add_notas_de_pedido">Nota de pedido</a>
<!--<a class="dropdown-item dropdown-item-theme" data-toggle="modal" data-target="#add_foto_obra">Fotos de obra</a>-->
<?php } }

} ?>
</div>
</li>

<?php } if(permiso('admin') || permiso('obras') || permiso('certificaciones')){ ?>
<?php if($user['iddepartamentos'] != 8){ ?>  
<li class="nav-item">
<a class="nav-link" style="padding:10px 15px 10px 15px" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
Editar
</a>
<div class="dropdown-menu dropdown-item-theme" aria-labelledby="dropdownMenuButton2">
<?php if(permiso('obras') || permiso('admin')){ ?>
<a class="dropdown-item dropdown-item-theme" data-toggle="modal" data-target="#edit_obra"> Informe de obra</a>
<a class="dropdown-item dropdown-item-theme" data-toggle="modal" data-target="#inspeccion_obras">Inspeccion designada</a>
<a class="dropdown-item dropdown-item-theme" data-toggle="modal" data-target="#montos_obra">Datos vigentes</a>
<?php }
if(permiso('certificaciones') || permiso('admin')){ ?>
<a class="dropdown-item dropdown-item-theme" data-toggle="modal" data-target="#datos_certificados">Datos certificados</a>
<a class="dropdown-item dropdown-item-theme" data-toggle="modal" data-target="#avance_obra">Avance de obra</a>
<?php } ?>
</div>
</li>
<?php }} ?>

<?php if(permiso('admin') || permiso('obras') || permiso('certificaciones')){ ?>
<li class="nav-item">
<a class="nav-link" style="padding:10px 15px 10px 15px" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
Planillas
</a>
<div class="dropdown-menu dropdown-item-theme" aria-labelledby="dropdownMenuButton2">
<?php if(permiso('certificaciones') || permiso('obras') || permiso('admin')){ ?>
<a class="dropdown-item dropdown-item-theme" title="Cargar datos" onclick="form_agregar_cotizacion(true)">Cotizacion</a>
<a class="dropdown-item dropdown-item-theme" title="Cargar datos" onclick="form_agregar_plandetrabajo(true)">Plan de trabajo</a>
<?php } ?>
</div>
</li>
<?php } ?>    
<li class="nav-item">
<a class="nav-link" style="padding:10px 15px 10px 15px" id="dropdownMenuButton3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
Imprimir
</a>
<div class="dropdown-menu dropdown-item-theme" aria-labelledby="dropdownMenuButton3">
<a class="dropdown-item dropdown-item-theme" target="_blank" href="<?php echo '/construcciones/public/admin/content/prints/informe-tecnico-obra.php?id='.$obra['idobras'];?>">Informe completo PDF</a>
<a class="dropdown-item dropdown-item-theme" target="_blank" href="<?php echo '/construcciones/public/admin/content/prints/informe-tecnico-obra-doc.php?id='.$obra['idobras'];?>">Informe completo WORD</a>
<a class="dropdown-item  dropdown-item-theme" target="_blank" href="<?php echo '/construcciones/public/admin/content/prints/ceremonial.php?id='.$obra['idobras'];?>">Informe ceremonial PDF</a>
<a class="dropdown-item  dropdown-item-theme" target="_blank" href="<?php echo '/construcciones/public/admin/content/prints/ceremonial-doc.php?id='.$obra['idobras'];?>">Informe ceremonial WORD</a>
<a class="dropdown-item  dropdown-item-theme" target="_blank" href="<?php echo '/construcciones/public/admin/content/prints/curva-inversion.php?id='.$obra['idobras'];?>">Avance y curva de obra</a>
</div>

</li>

<li class="nav-item">
<a class="nav-link" style="padding:10px 15px 10px 15px" id="dropdownMenuButton4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
Ayuda
</a>
<div class="dropdown-menu dropdown-item-theme" aria-labelledby="dropdownMenuButton4">
<!--<a class="dropdown-item dropdown-item-theme" data-toggle="modal" data-target="#combinar_pdf">Combinar PDFs</a>-->
<a class="dropdown-item dropdown-item-theme" target="_blank" href="https://smallpdf.com/es/unir-pdf">Combinar PDFs</a>
</div>

</li>
</ul>
<div class="card-body p-b-0">
<div class="row p-r-20 p-l-20 p-b-20">  

<div class="col">
<label class="control-label text-muted" style="font-size:12px;">Titulo de obra</label>

<h3><?php echo $obra['nombre']; ?></h3></div></div>
<div class="row p-r-20 p-l-20">

<div class="col">
<label class="control-label text-muted" style="font-size:12px;">Estado de obra</label>
<h3><?php 
if($obra['estado'] == 0){ echo 'En ejecucion'; }
if($obra['estado'] == 3 && $obra['finalizado'] == 0){ echo 'Finalizada sin recibir'; }
if($obra['estado'] == 3 && $obra['finalizado'] == 1){ echo 'Finalizada en garantia'; }
if($obra['estado'] == 3 && $obra['finalizado'] == 2){ echo 'Finalizada definitiva'; }
if($obra['estado'] == 4){ echo 'Neutralizada'; }
if($obra['estado'] == 5){ echo 'Rescindida'; }
if($obra['estado'] == 6){ echo 'A Iniciar'; } ?></h3>
</div>

<div class="col">
<label class="control-label text-muted" style="font-size:12px;">Caja</label>
<h3><?php echo $obra['numero']; ?></h3>
</div>
<div class="col">
<label class="control-label text-muted" style="font-size:12px;">Expediente</label>
<h3><?php echo $obra['expediente']; ?></h3>
</div>
<div class="col">
<label class="control-label text-muted" style="font-size:12px;">Inicio de obra</label>
<h3><?php if($obra['fecha_inicio'] != '0000-00-00'){ echo format_date($obra['fecha_inicio']); } ?></h3>
</div>
<div class="col">
<label class="control-label text-muted" style="font-size:12px;">Fin de obra previsto</label>
<h3><?php if($obra['fecha_fin_no_define'] == 0){
if($obra['fecha_fin'] != '0000-00-00'){ echo format_date($obra['fecha_fin']);}}else{ echo 'Sin definir';}
?></h3>
</div>
<div class="col">
<label class="control-label text-muted" style="font-size:12px;">Contratista</label>
<h3><?php echo $obra['contratista']; ?></h3>
</div>             




<!--<h6 class="card-subtitle">desarrollando seccion.</h6>
<p class="text-muted">
<?php echo 'Informe de obra actualizado el '.format_date($obra['registro_fecha']).''.user_name($obra['registro_usuario']); ?><br/>
<?php if($obra['registro_certificados_fecha'] != '0000-00-00' && !empty($obra['registro_certificados_fecha'])){
echo 'Avance de obra actualizado el '.format_date($obra['registro_certificados_fecha']).''.user_name($obra['registro_certificados_usuario']); } ?> 
</p> .''.user_name($obra['registro_usuario']) -->
</div>

<div class="ml-auto ">
<ul class="list-inline">
<div class="d-flex flex-row ">
<div class="ml-auto my-auto">

</div>
</div>
<!--<li>
<h6 class="text-muted"><a class="dropdown-item a-icon" href="includes/windows/imprimir_informe.php?id=<?php echo $obra['idobras'] ?>" target="_blank" data-toggle="tooltip" title="Imprimir" onclick="window.open(this.href, this.target, 'width=600,height=500'); return false;"><i class="fas fa-print fa-2x"></i></a></h6>  
</li>-->
</ul>
</div>
</div>
<!-- Nav tabs -->
<ul class="nav nav-tabs customtab justify-content-center" role="tablist">


<li class="nav-item"><a class="nav-link active" data-toggle="tab" role="tab" aria-controls="obra-informe" href="obra-informe.php?id=<?php echo $obra_id; ?>" data-target="#obra-informe">MEMORIA</a></li>
<!--<li class="nav-item"><a class="nav-link" data-toggle="tab" role="tab" aria-controls="obra-plazos" href="obra-plazos.php?id=<?php echo $obra_id; ?>" data-target="#obra-plazos">DESARROLLO</a></li>-->
<?php if(!empty($modificaciones_de_obra)){ ?>
<li class="nav-item"><a class="nav-link" data-toggle="tab" role="tab" aria-controls="obra-modificaciones" href="obra-modificaciones.php?id=<?php echo $obra_id; ?>" data-target="#obra-modificaciones">MODIFICACIONES</a></li>
<?php } ?>
<?php if(!empty($ampliaciones_de_obra)){ ?>
<li class="nav-item"><a class="nav-link" data-toggle="tab" role="tab" aria-controls="obra-ampliaciones" href="obra-ampliaciones.php?id=<?php echo $obra_id; ?>" data-target="#obra-ampliaciones">AMPLIACIONES</a></li>
<?php } ?>
<?php if(!empty($neutralizaciones_de_obra)){ ?>
<li class="nav-item"><a class="nav-link" data-toggle="tab" role="tab" aria-controls="obra-neutralizaciones" href="obra-neutralizaciones.php?id=<?php echo $obra_id; ?>" data-target="#obra-neutralizaciones">NEUTRALIZACIONES</a></li>
<?php } ?>
<?php if(!empty($planes_de_trabajo)){ ?>
<li class="nav-item"><a class="nav-link" data-toggle="tab" role="tab" aria-controls="obra-planes" href="obra-mod-planes.php?id=<?php echo $obra_id; ?>" data-target="#obra-planes">PLANES DE TRABAJO</a></li>
<?php } ?>
<!--<li class="nav-item"><a class="nav-link" data-toggle="tab" role="tab" aria-controls="obra-resumen" href="obra-resumen.php?id=<?php echo $obra_id; ?>" data-target="#obra-resumen">PRECIOS DE ITEMS</a></li>-->

<li class="nav-item"><a class="nav-link" data-toggle="tab" role="tab" aria-controls="obra-contrato" href="obra-contrato.php?id=<?php echo $obra_id; ?>" data-target="#obra-contrato">CONTRATACION</a></li>

<li class="nav-item"><a class="nav-link" data-toggle="tab" role="tab" aria-controls="obra-certificacion" href="obra-certificacion.php?id=<?php echo $obra_id; ?>" data-target="#obra-certificacion">INVERSION</a></li>


<?php if(!empty($recepciones_obra)){ ?>
<li class="nav-item"><a class="nav-link" data-toggle="tab" role="tab" aria-controls="obra-recepcion" href="obra-recepcion.php?id=<?php echo $obra_id; ?>" data-target="#obra-recepcion">RECEPCION</a></li>
<?php } ?>
<li class="nav-item"><a class="nav-link" data-toggle="tab" role="tab" aria-controls="obra-inspeccion" href="obra-inspeccion.php?id=<?php echo $obra_id; ?>" data-target="#obra-inspeccion">INSPECCION</a></li>

<!--<li class="nav-item"><a class="nav-link" data-toggle="tab" role="tab" aria-controls="obra-laboratorio" href="obra-laboratorio.php?id=<?php echo $obra_id; ?>" data-target="#obra-laboratorio">LABORATORIO</a></li>-->

<li class="nav-item"><a class="nav-link" data-toggle="tab" role="tab" aria-controls="obra-archivos" href="obra-archivos.php?id=<?php echo $obra_id; ?>" data-target="#obra-archivos">ARCHIVOS</a></li>
</ul>

</div>
<!-- Tab panes -->
<div class="tab-content">

<div class="tab-pane show active fade" role="tabpanel" id="obra-informe"></div>
<div class="tab-pane fade" role="tabpanel" id="obra-modificaciones"></div>
<div class="tab-pane fade" role="tabpanel" id="obra-ampliaciones"></div>
<div class="tab-pane fade" role="tabpanel" id="obra-neutralizaciones"></div>
<div class="tab-pane fade" role="tabpanel" id="obra-planes"></div>
<div class="tab-pane fade" id="obra-resumen" role="tabpanel" aria-expanded="false">
</div>
<div class="tab-pane fade" id="obra-certificacion" role="tabpanel" aria-expanded="false">
</div>
<div class="tab-pane fade" id="obra-plazos" role="tabpanel" aria-expanded="false">
</div>
<div class="tab-pane fade" id="obra-contrato" role="tabpanel" aria-expanded="false">
</div>
<div class="tab-pane fade" id="obra-recepcion" role="tabpanel" aria-expanded="false">
</div>
<div class="tab-pane fade" id="obra-inspeccion" role="tabpanel" aria-expanded="false">
</div>
<div class="tab-pane fade" id="obra-laboratorio" role="tabpanel" aria-expanded="false">
</div>
<div class="tab-pane fade" id="obra-archivos" role="tabpanel" aria-expanded="false">
</div>
<div class="tab-pane fade" id="obra-ubicacion" role="tabpanel" aria-expanded="false">
</div>
</div>
</div>
</div>




<?php } endforeach; ?>
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
<div id="crear-certificado"></div>
<div id="estado_del_informe"></div>
<div id="modal-planillas"></div>
<div id="editar_modificaciones"></div>
<div id="editar_ampliaciones"></div>
<div id="editar_neutralizaciones"></div>
<div id="editar_recepciones"></div>
<div id="editar_mod_plandetrabajo"></div>
<div id="editar_cotizacion"></div>
<div id="editar_plandetrabajo"></div>
<script type="text/javascript" src="includes/ajax/scripts/certificados.js"></script>
<script>
$(document).ready(function() {
$('#info_obra').show();
var contentResult;

$("a[data-toggle='tab']").on("show.bs.tab", function (e) {
if ( e.relatedTarget ) {
$( $(e.relatedTarget).data("target") ).empty();
}
var url = $(e.target).attr("href");
var $tabTarget = $( $(e.target).data("target") );
$.get( url, function( result ) {
$tabTarget.html(result);
});
$( $(e.relatedTarget).data("target") ).removeClass('active');
});


});

$(document).ready(function(){
$.ajax({url:"obra-informe.php?id=<?php echo $obra_id; ?>",success:function(tabdata){
$("#obra-informe").append(tabdata);
}});

});
</script>
<script type="text/javascript" src="includes/ajax/scripts/informes_obras.js"></script>
<?php 
require_once('../forms/agregar_modificacion_obra.php');
require_once('../forms/agregar_ampliacion_obra.php');
require_once('../forms/agregar_neutralizacion_obra.php');
require_once('../forms/agregar_recepcion_obra.php');
require_once('../forms/agregar_cotizacion_obra.php');
require_once('../forms/agregar_plan_de_trabajo_obra.php');
require_once('../forms/agregar_mod_plandetrabajo_obra.php');
require_once('../modals/add_files.php');
require_once('../modals/edit_obra.php');
require_once('../modals/modificaciones.php');
require_once('../modals/ampliaciones.php');
require_once('../modals/neutralizaciones.php');
require_once('../modals/avance_obra.php');
require_once('../modals/combinar_pdf.php');
require_once('../modals/montos_obra.php');
require_once('../modals/config_obra.php');
require_once('../modals/valor_multa.php');
require_once('../modals/plan_oficial.php');
require_once('../modals/certificados_aprobados.php');
require_once('../modals/certificados_redeterminados.php');
require_once('../modals/flujo_de_obra.php');
require_once('../modals/add_notas_de_pedido.php');
require_once('../modals/add_ordenes_de_servicio.php');
require_once('../modals/add_foto_obra.php');
require_once('../modals/add_informe_inspeccion.php');
require_once('../modals/add_personal_inspeccion.php');
require_once('../modals/datos_certificados.php');
//require_once('../modals/add_laboratorio_suelo.php');
//require_once('../modals/add_laboratorio_hormigon.php');
//require_once('../modals/add_laboratorio_asfalto.php');
require_once('../modals/add_ensayo_inspeccion.php');
require_once('../modals/inspeccion_obras.php');
/*require_once('../modals/add_bacheo.php');*/

pie(); ?>
