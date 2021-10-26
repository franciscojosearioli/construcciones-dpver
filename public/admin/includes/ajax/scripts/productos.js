//Función que se ejecuta al inicio
function inicio(){
	form_agregar(false);
	form_retirar(false);
}

//Función mostrar/ocultar formulario
function form_agregar(flag)
{
	if (flag)
	{
		$("#productos").hide();
		$("#agregar_productos").show();
		$("#btn_agregar").hide();
	}
	else
	{
		$("#productos").show();
		$("#agregar_productos").hide();
		$("#btn_agregar").show();
	}
}

function form_retirar(flag)
{
	if (flag)
	{
		$("#productos").hide();
		$("#retirar_productos").show();
	}
	else
	{
		$("#productos").show();
		$("#retirar_productos").hide();
	}
}

//Función cancelar formulario
function cancelar_agregar()
{
	form_agregar(false);
}

function cancelar_retirar()
{
	form_retirar(false);
}


//Función enviar formulario
function submit_agregar()
{
	validar = $("#form_agregar").validate();
	if(validar){
	$('#form_agregar').submit();
	}
}

function submit_retirar()
{
	validar = $("#form_retirar").validate();
	if(validar){
	$('#form_retirar').submit();
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

function retirar_producto(valor){
	$('#retirar_productos').hide();
var valor = valor;
$.ajax({
type: "POST",
data: "id="+valor,
url: "content/forms/retirar_productos.php",
success: function(respuesta) {
$('#productos').hide();
$('#retirar_productos').html(respuesta).show();
}
});
}