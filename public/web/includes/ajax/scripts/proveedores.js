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
		$("#proveedores").hide();
		$("#add_proveedores").show();
		$("#btn_agregar").hide();
	}
	else
	{
		$("#proveedores").show();
		$("#add_proveedores").hide();
		$("#btn_agregar").show();
	}
}

function form_editar(flag)
{
	if (flag)
	{
		$("#proveedores").hide();
		$("#editar_proveedores").show();
	}
	else
	{
		$("#proveedores").show();
		$("#editar_proveedores").hide();
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

function ver_contactos(valor){
var valor = valor;
$.ajax({
type: "POST",
data: "id="+valor,
url: "content/modals/proveedores_contactos.php",
success: function(respuesta) {
$('#proveedor_contacto').html(respuesta).appendTo('body');
$('#contacto').modal('show');
}
});
}

function editar_proveedor(valor){
var valor = valor;
$.ajax({
type: "POST",
data: "id="+valor,
url: "content/forms/editar_proveedor.php",
success: function(respuesta) {
$('#proveedores').hide();
$('#editar_proveedores').html(respuesta).show();
}
});
}