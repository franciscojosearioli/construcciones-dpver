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
		$("#categorias").hide();
		$("#add_categorias").show();
		$("#btn_agregar").hide();
	}
	else
	{
		$("#categorias").show();
		$("#add_categorias").hide();
		$("#btn_agregar").show();
	}
}

function form_editar(flag)
{
	if (flag)
	{
		$("#categorias").hide();
		$("#editar_categorias").show();
	}
	else
	{
		$("#categorias").show();
		$("#editar_categorias").hide();
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