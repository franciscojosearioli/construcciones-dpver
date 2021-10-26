</div>
<footer class="footer">
<?php $version= ultima_version(); ?>
<div class="d-flex flex-wrap">
© Dirección Provincial de Vialidad de Entre Ríos
<div class="ml-auto">
<a href="ajustes">Version <?php echo $version['numero']; ?></a> 
</div>
</div>
</footer>
</div>
</div>
<script src="includes/assets/js/breadcrumbs.js"></script>
<script src="includes/ajax/scripts/usuarios-movimientos.js"></script>
<script src="includes/assets/plugins/bootstrap/js/popper.min.js"></script>
<script src="includes/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="includes/assets/js/jquery.slimscroll.js"></script>
<script src="includes/assets/js/waves.js"></script>
<script src="includes/assets/js/sidebarmenu.js"></script>
<script src="includes/assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
<script src="includes/assets/plugins/sparkline/jquery.sparkline.min.js"></script>
<script src="includes/assets/js/custom.js"></script>
<script src="includes/assets/plugins/chartist-js/dist/chartist.min.js"></script>
<script src="includes/assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js"></script>
<script src="includes/assets/plugins/echarts/echarts-all.js"></script>
<script src="includes/assets/plugins/dropify/dist/js/dropify.min.js"></script>
<script src="includes/assets/plugins/dropzone-master/dist/dropzone.js"></script>
<script src="includes/assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>
<script src="includes/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="includes/assets/plugins/datatables/dataTables.select.min.js"></script>
<script src="includes/assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
<script src="includes/assets/plugins/datatables-buttons/dataTables.buttons.min.js"></script>
<script src="includes/assets/plugins/datatables-buttons/buttons.flash.min.js"></script>
<script src="includes/assets/plugins/datatables-buttons/buttons.html5.min.js"></script>
<script src="includes/assets/plugins/datatables-buttons/buttons.print.min.js"></script>
<script src="includes/assets/plugins/datatables-buttons/buttons.colVis.min.js"></script>
<script src="includes/assets/plugins/jszip/jszip.min.js"></script>
<script src="includes/assets/plugins/file_tree/js/php_file_tree.js" type="text/javascript"></script>
<script src="includes/assets/plugins/typeahead/js/typeahead.js"></script>  
<script src="includes/assets/plugins/wizard/jquery.steps.min.js"></script>
<script src="includes/assets/plugins/wizard/jquery.validate.min.js"></script>
<script src="includes/assets/plugins/sweetalert/sweetalert.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="includes/assets/plugins/owl-carousel2/owl.carousel.min.js"></script>
<script src="includes/assets/js/ajustes.js"></script>
<div id="movs_tramites"></div>
<script>
function movs_expediente(valor){
var valor = valor;
$.ajax({
type: "POST",
data: "numero="+valor,
url: "content/modals/movs_expediente.php",
success: function(respuesta) {
$('#movs_tramites').html(respuesta).appendTo('body');
$('#movs-expedientes').modal('show');
}
});
}
$(document).ready(function(){
busquedaglobal = new Bloodhound({datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),queryTokenizer: Bloodhound.tokenizers.whitespace,remote: {url:'./includes/ajax/busqueda_obra.php?key=%QUERY',wildcard: '%QUERY',filter: function (results) {return $.map(results, function (result) {return {value: result};});}}});
busquedaglobal.initialize();
$('#busqueda').typeahead(null, {
name: 'value',
display: 'value',
source: busquedaglobal,
limit:30,
templates: {
suggestion:  function(data) {
if(data.value.estado == 1){
return '<a style="text-decoration:none;font-size:11px;line-height: 1.5" href="proyecto?id='+data.value.idobras+'"><div>PROYECTO: '+ data.value.nombre.substring(0, 40) +'...<br>ESTADO: En proyecto<br>EXPEDIENTE: '+data.value.expediente+'</div></a>'
}else{
if(data.value.estado == 0){
return '<a style="text-decoration:none;font-size:11px;line-height: 1.5" href="obra?id='+data.value.idobras+'"><div>OBRA: '+ data.value.nombre.substring(0, 40) +'...<br>ESTADO: En ejecucion<br>EXPEDIENTE: '+data.value.expediente+'<br>CAJA: '+data.value.numero+'</div></a>'
}if(data.value.estado == 4){
return '<a style="text-decoration:none;font-size:11px;line-height: 1.5" href="obra?id='+data.value.idobras+'"><div>OBRA: '+ data.value.nombre.substring(0, 40) +'...<br>ESTADO: Neutralizada<br>EXPEDIENTE: '+data.value.expediente+'<br>CAJA: '+data.value.numero+'</div></a>'
}if(data.value.estado == 5){
return '<a style="text-decoration:none;font-size:11px;line-height: 1.5" href="obra?id='+data.value.idobras+'"><div>OBRA: '+ data.value.nombre.substring(0, 40) +'...<br>ESTADO: Rescindida<br>EXPEDIENTE: '+data.value.expediente+'<br>CAJA: '+data.value.numero+'</div></a>'
}
if(data.value.estado == 3){
if(data.value.finalizado == 0){
return '<a style="text-decoration:none;font-size:11px;line-height: 1.5" href="obra?id='+data.value.idobras+'"><div>OBRA: '+ data.value.nombre.substring(0, 40) +'...<br>ESTADO: Finalizada sin recibir<br>EXPEDIENTE: '+data.value.expediente+'<br>CAJA: '+data.value.numero+'</div></a>'
}if(data.value.finalizado == 1){
return '<a style="text-decoration:none;font-size:11px;line-height: 1.5" href="obra?id='+data.value.idobras+'"><div>OBRA: '+ data.value.nombre.substring(0, 40) +'...<br>ESTADO: Finalizada en garantia<br>EXPEDIENTE: '+data.value.expediente+'<br>CAJA: '+data.value.numero+'</div></a>'
}if(data.value.finalizado == 2){
return '<a style="text-decoration:none;font-size:11px;line-height: 1.5" href="obra?id='+data.value.idobras+'"><div>OBRA: '+ data.value.nombre.substring(0, 40) +'...<br>ESTADO: Finalizada definitiva<br>EXPEDIENTE: '+data.value.expediente+'<br>CAJA: '+data.value.numero+'</div></a>'
}
}
}
}
}
});
});
</script>
<?php 
//require_once('../modals/ayuda_datatables.php'); 
//require_once('../menu/menu-derecho.php');
?>
<!--<script type="text/javascript">$(document).ready(function(){console.clear();});</script>-->
</body>
</html>