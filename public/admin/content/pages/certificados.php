<?php
require_once('../../includes/load.php');
require_once('../../includes/functions/certificados.php');   
require_once('../../includes/functions/editar_certificados.php');  
cabecera('Certificados de obras');
$user = current_user();
$aprobados = all_certificados_obras();
$ultimos_certificados = ultimos_valores_tabla('certificados_obras','','idcertificados_obras','10');
?>
<div id="listar_certificados">
<?php if(!empty($ultimos_certificados)){ ?> 
<div class="row justify-content-center">
<div class="col-10">
<h3 class="titulo-bienvenida">Ultimos certificados de obras</h3><br>
</div></div>
<div class="row justify-content-center">
<div class="col-10">
<div class="owl-carousel certificados">
<!-- inic ITEM -->
<?php 
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
<p><?php echo $row['expediente']; ?></p>
<?php } ?>
<label class="control-label text-muted" style="font-size:11px;">Obra</label>
<p><?php echo $obra['numero'].' - '.$obra['expediente'].'<br>'.$obra['alias']; ?></p>
<a href="../uploads/Obras/<?php echo $obra['idobras']; ?>/Certificaciones/Certificados/<?php echo $row['archivo_copia']; ?>" target="_blank">Ver Certificado</a>
</div>
<div class="card-footer">
<p><a href="obra?id=<?php echo $obra['idobras']; ?>">Ver Informe de Obra</a></p>
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
<div class="d-flex flex-wrap p-b-30">
<div class="my-auto ml-3">
<h3 class="titulo-bienvenida">Certificados de obras</h3>
</div>
<div class="ml-auto my-auto mr-3">
  <?php if(permiso('admin') || permiso('certificaciones')){ ?>
<a id="btn_agregar" onclick="form_agregar(true)" title="Agregar nuevo" data-toggle="tooltip"
class="btn btn-warning btn-rounded btn-light"><i class="fas fa-plus"></i> Cargar nuevo</a>
<?php } ?>
</div>
</div>
</div>
</div>

<div class="row justify-content-center" id="listar_certificados">
<div class="col-10">
<div class="card">
<div class="card-body">

<div class="row">
<div class="col-12">

<ul class="nav nav-tabs customtab justify-content-center" role="tablist">
<li class="nav-item"><a class="nav-link active" data-toggle="tab" role="tab" aria-controls="certificados-confeccionados" href="certificados-confeccionados.php" data-target="#certificados-confeccionados">En confeccion</a></li>
<li class="nav-item"><a class="nav-link" data-toggle="tab" role="tab" aria-controls="certificados-emitidos" href="certificados-emitidos.php" data-target="#certificados-emitidos">Emitidos</a></li>      
<li class="nav-item"><a class="nav-link" data-toggle="tab" role="tab" aria-controls="certificados-aprobados" href="certificados-aprobados.php" data-target="#certificados-aprobados">Aprobados</a></li>
</ul>
<div class="tab-content">
<div class="tab-pane show active fade" role="tabpanel" id="certificados-confeccionados"></div>
<div class="tab-pane fade" id="certificados-emitidos" role="tabpanel" aria-expanded="false"> </div>
<div class="tab-pane fade" id="certificados-aprobados" role="tabpanel" aria-expanded="false"> </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<script>
$(document).ready(function() {
$('#certificaciones_tabs').show();
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
$.ajax({async: true,url:"certificados-confeccionados.php",success:function(tabdata){
$("#certificados-confeccionados").append(tabdata);
}});

});
</script>








<script type="text/javascript" src="includes/ajax/scripts/certificaciones.js"></script>

<script>
function editar_certificadoobra(id,obra){
var id = id;
var obra = obra;
$('#listar_certificados').hide();
$.post("content/forms/edit_certificado.php", {cert_id: id, obra_id: obra}, function(result){
$("#crear-certificado").html(result);
});
}
</script>
<?php 

require_once('../forms/agregar_certificado.php');
pie(); ?>