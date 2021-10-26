//Función que se ejecuta al inicio
function inicio(){
	form_agregar(false);
	form_editar(false);
}

//Función mostrar/ocultar formulario
function form_agregar(flag)
{
	if (flag)
	{
		$("#notificaciones").hide();
		$("#add_notificacion").show();
		$("#btn_agregar").hide();
	}
	else
	{
		$("#notificaciones").show();
		$("#add_notificacion").hide();
		$("#btn_agregar").show();
	}
}

function form_editar(flag)
{
	if (flag)
	{
		$("#notificaciones").hide();
		$("#editar_notificacion").show();
	}
	else
	{
		$("#notificaciones").show();
		$("#editar_notificacion").hide();
	}
}

//Función cancelar formulario
function cancelar_agregar()
{
	form_agregar(false);
}

function cancelar_editar()
{
	form_editar(false);
}

//Función enviar formulario
function submit_agregar()
{
	validar = $("#form_agregar").validate();
	if(validar){
	$('#form_agregar').submit();
	}
}

function submit_editar()
{
	validar = $("#form_editar").validate();
	if(validar){
	$('#form_editar').submit();
	}
}

inicio();

function editar_notificacion(valor){
var valor = valor;
$.ajax({
type: "POST",
data: "id="+valor,
url: "content/forms/editar_notificacion.php",
success: function(respuesta) {
$('#notificaciones').hide();
$('#editar_notificaciones').html(respuesta).show();
}
});
}