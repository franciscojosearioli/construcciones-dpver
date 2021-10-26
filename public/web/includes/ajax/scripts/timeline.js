
	
function editar_timeline(valor){
var valor = valor;
$.ajax({
type: "POST",
data: "id="+valor,
url: "content/modals/edit_timeline.php",
success: function(respuesta) {
$('#editar_timeline').html(respuesta).appendTo('body');
$('#edit_timeline').modal('show');
}
});
}

function eliminar_timeline(valor){
var valor = valor;
$.ajax({
type: "POST",
data: "id="+valor,
url: "content/modals/eliminar_timeline.php",
success: function(respuesta) {
$('#eliminar_timeline').html(respuesta).appendTo('body');
$('#elim_timeline').modal('show');
}
});
}
