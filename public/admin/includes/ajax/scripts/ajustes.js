//Función que se ejecuta al inicio
function inicio(){
	form_version(false);
	form_changelog(false);
}

//Función mostrar/ocultar formulario
function form_version(flag)
{
	if (flag)
	{
		$("#version").hide();
		$("#agregar_version").show();
		$("#btn_version").hide();
		$("#btn_changelog").hide();
	}
	else
	{
		$("#version").show();
		$("#agregar_version").hide();
		$("#btn_version").show();
		$("#btn_changelog").show();
	}
}
function form_changelog(flag)
{
	if (flag)
	{
		$("#version").hide();
		$("#agregar_changelog").show();
		$("#btn_version").hide();
		$("#btn_changelog").hide();
	}
	else
	{
		$("#version").show();
		$("#agregar_changelog").hide();
		$("#btn_version").show();
		$("#btn_changelog").show();
	}
}


//Función cancelar formulario
function cancelar_agregar()
{
	form_version(false);
	form_changelog(false);
}


//Función enviar formulario
function submit_version()
{
	validar = $("#form_version").validate();
	if(validar){
	$('#form_version').submit();
	}
}
function submit_changelog()
{
	validar = $("#form_changelog").validate();
	if(validar){
	$('#form_changelog').submit();
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

function editar_categoria(valor){
var valor = valor;
$.ajax({
type: "POST",
data: "id="+valor,
url: "content/forms/editar_categoria.php",
success: function(respuesta) {
$('#categorias').hide();
$('#editar_categorias').html(respuesta).show();
}
});
}

function eliminar_categoria(valor){
var valor = valor;
$.ajax({
type: "POST",
data: "id="+valor,
url: "content/modals/eliminar_categoria.php",
success: function(respuesta) {
$('#eliminar_categorias').html(respuesta).appendTo('body');
$('#eliminar_categoria').modal('show');
}
});
}