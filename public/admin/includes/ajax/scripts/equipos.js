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
		$("#listar_equipos").hide();
		$("#agregar_equipos").show();
		$("#btn_agregar").hide();
	}
	else
	{
		$("#listar_equipos").show();
		$("#agregar_equipos").hide();
		$("#btn_agregar").show();
	}
}

function form_editar(flag)
{
	if (flag)
	{
		$("#listar_equipos").hide();
		$("#editar_equipos").show();
	}
	else
	{
		$("#listar_equipos").show();
		$("#editar_equipos").hide();
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

function editar_equipo(valor){
var valor = valor;
$.ajax({
type: "POST",
data: "id="+valor,
url: "content/forms/editar_equipo.php",
success: function(respuesta) {
$('#listar_equipos').hide();
$('#editar_equipos').html(respuesta).show();
}
});
}
