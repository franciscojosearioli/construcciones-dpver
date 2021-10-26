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
		$("#listar_rd").hide();
		$("#agregar_rd").show();
		$("#btn_agregar").hide();
	}
	else
	{
		$("#listar_rd").show();
		$("#agregar_rd").hide();
		$("#btn_agregar").show();
	}
}

function form_editar(flag)
{
	if (flag)
	{
		$("#listar_rd").hide();
		$("#editar_rd").show();
	}
	else
	{
		$("#listar_rd").show();
		$("#editar_rd").hide();
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

function editar_rd(valor){
var valor = valor;
$.ajax({
type: "POST",
data: "id="+valor,
url: "content/forms/editar_rd.php",
success: function(respuesta) {
$('#listar_rd').hide();
$('#editar_rd').html(respuesta).show();
}
});
}

function movimiento_rd(valor){
var valor = valor;
$.ajax({
type: "POST",
data: "id="+valor,
url: "content/modals/movimientos_rd.php",
success: function(respuesta) {
$('#movimientos_recepciones').html(respuesta).appendTo('body');
$('#movimientos_rd').modal('show');
}
});
}