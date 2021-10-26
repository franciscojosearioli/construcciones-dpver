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
		$("#listar_usuarios").hide();
		$("#agregar_usuarios").show();
		$("#btn_agregar").hide();
	}
	else
	{
		$("#listar_usuarios").show();
		$("#agregar_usuarios").hide();
		$("#btn_agregar").show();
	}
}

function form_editar(flag)
{
	if (flag)
	{
		$("#listar_usuarios").hide();
		$("#editar_usuarios").show();
	}
	else
	{
		$("#listar_usuarios").show();
		$("#editar_usuarios").hide();
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

function ver_producto(valor){
var valor = valor;
$.ajax({
type: "POST",
data: "id="+valor,
url: "content/modals/productos_info.php",
success: function(respuesta) {
$('#productos_info').html(respuesta).appendTo('body');
$('#producto_info').modal('show');
}
});
}

function editar_usuario(valor){
	$('#editar_usuarios').hide();
var valor = valor;
$.ajax({
type: "POST",
data: "id="+valor,
url: "content/forms/editar_usuario.php",
success: function(respuesta) {
$('#listar_usuarios').hide();
$('#editar_usuarios').html(respuesta).show();
}
});
}