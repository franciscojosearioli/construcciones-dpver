//Función que se ejecuta al inicio
function inicio(){
	form_agregar_plan_oficial(false);
	form_editar_plan_oficial(false);
	form_agregar_certificado(false);
	form_editar_certificado(false);
	form_agregar_certificado_redeterminado(false);
	form_editar_certificado_redeterminado(false);
}

//Función mostrar/ocultar formulario
function form_agregar_plan_oficial(flag)
{
	if (flag)
	{
		$("#listar_plan_oficial").hide();
		$("#agregar_plan_oficial").show();
		$("#btn_agregar_plan_oficial").hide();
	}
	else
	{
		$("#listar_plan_oficial").show();
		$("#agregar_plan_oficial").hide();
		$("#btn_agregar_plan_oficial").show();
	}
}
function form_agregar_certificado(flag)
{
	if (flag)
	{
		$("#listar_certificado").hide();
		$("#agregar_certificado").show();
		$("#btn_agregar_certificado").hide();
	}
	else
	{
		$("#listar_certificado").show();
		$("#agregar_certificado").hide();
		$("#btn_agregar_certificado").show();
	}
}
function form_agregar_certificado_redeterminado(flag)
{
	if (flag)
	{
		$("#listar_certificado_redeterminado").hide();
		$("#agregar_certificado_redeterminado").show();
		$("#btn_agregar_certificado_redeterminado").hide();
	}
	else
	{
		$("#listar_certificado_redeterminado").show();
		$("#agregar_certificado_redeterminado").hide();
		$("#btn_agregar_certificado_redeterminado").show();
	}
}


function form_editar_plan_oficial(flag)
{
	if (flag)
	{
		$("#listar_plan_oficial").hide();
		$("#editar_plan_oficial").show();
		$("#btn_agregar_plan_oficial").hide();
	}
	else
	{
		$("#listar_plan_oficial").show();
		$("#editar_plan_oficial").hide();
		$("#btn_agregar_plan_oficial").show();
	}
}
function form_editar_certificado(flag)
{
	if (flag)
	{
		$("#listar_certificado").hide();
		$("#editar_certificado").show();
		$("#btn_agregar_certificado").hide();
	}
	else
	{
		$("#listar_certificado").show();
		$("#editar_certificado").hide();
		$("#btn_agregar_certificado").show();
	}
}
function form_editar_certificado_redeterminado(flag)
{
	if (flag)
	{
		$("#listar_certificado_redeterminado").hide();
		$("#editar_certificado_redeterminado").show();
		$("#btn_agregar_certificado_redeterminado").hide();
	}
	else
	{
		$("#listar_certificado_redeterminado").show();
		$("#editar_certificado_redeterminado").hide();
		$("#btn_agregar_certificado_redeterminado").show();
	}
}

//Función cancelar formulario
function cancelar_agregar_plan_oficial()
{
	form_agregar_plan_oficial(false);
}

function cancelar_editar_plan_oficial()
{
	form_editar_plan_oficial(false);
}

function cancelar_agregar_certificado()
{
	form_agregar_certificado(false);
}

function cancelar_editar_certificado()
{
	form_editar_certificado(false);
}

function cancelar_agregar_certificado_redeterminado()
{
	form_agregar_certificado_redeterminado(false);
}

function cancelar_editar_certificado_redeterminado()
{
	form_editar_certificado_redeterminado(false);
}

//Función enviar formulario
function submit_agregar_plan_oficial()
{
	validar = $("#form_agregar_plan_oficial").validate();
	if(validar){
	$('#form_agregar_plan_oficial').submit();
	}
}

function submit_editar_plan_oficial()
{
	validar = $("#form_editar_plan_oficial").validate();
	if(validar){
	$('#form_editar_plan_oficial').submit();
	}
}

function submit_agregar_certificado()
{
	validar = $("#form_agregar_certificado").validate();
	if(validar){
	$('#form_agregar_certificado').submit();
	}
}

function submit_editar_certificado()
{
	validar = $("#form_editar_certificado").validate();
	if(validar){
	$('#form_editar_certificado').submit();
	}
}

function submit_agregar_certificado_redeterminado()
{
	validar = $("#form_agregar_certificado_redeterminado").validate();
	if(validar){
	$('#form_agregar_certificado_redeterminado').submit();
	}
}

function submit_editar_certificado_redeterminado()
{
	validar = $("#form_editar_certificado_redeterminado").validate();
	if(validar){
	$('#form_editar_certificado_redeterminado').submit();
	}
}

inicio();

function editar_plan_oficial(obra,valor){
var valor = valor;
$.ajax({
type: "POST",
data: "obra="+obra+"&id="+valor,
url: "content/forms/editar_plan_oficial.php",
success: function(respuesta) {
$('#listar_plan_oficial').hide();
$("#btn_agregar_plan_oficial").hide();
$('#editar_plan_oficial').html(respuesta).show();
}
});
}

function eliminar_plan_oficial(obra,valor){
var valor = valor;
$.ajax({
type: "POST",
data: "obra="+obra+"&id="+valor,
url: "content/modals/eliminar_plan_oficial.php",
success: function(respuesta) {
$('#modal_eliminar_plan_oficial').html(respuesta).appendTo('body');
$('#eliminar_plan_oficial').modal('show');
}
});
}

function editar_certificado(obra,valor){
var valor = valor;
$.ajax({
type: "POST",
data: "obra="+obra+"&id="+valor,
url: "content/forms/editar_certificado.php",
success: function(respuesta) {
$('#listar_certificado').hide();
$("#btn_agregar_certificado").hide();
$('#editar_certificado').html(respuesta).show();
}
});
}

function eliminar_certificado(obra,valor){
var valor = valor;
$.ajax({
type: "POST",
data: "obra="+obra+"&id="+valor,
url: "content/modals/eliminar_certificado.php",
success: function(respuesta) {
$('#modal_eliminar_certificado').html(respuesta).appendTo('body');
$('#eliminar_certificado').modal('show');
}
});
}

function editar_certificado_redeterminado(obra,valor){
var valor = valor;
$.ajax({
type: "POST",
data: "obra="+obra+"&id="+valor,
url: "content/forms/editar_certificado_redeterminado.php",
success: function(respuesta) {
$('#listar_certificado_redeterminado').hide();
$("#btn_agregar_certificado_redeterminado").hide();
$('#editar_certificado_redeterminado').html(respuesta).show();
}
});
}

function eliminar_certificado_redeterminado(obra,valor){
var valor = valor;
$.ajax({
type: "POST",
data: "obra="+obra+"&id="+valor,
url: "content/modals/eliminar_certificado_redeterminado.php",
success: function(respuesta) {
$('#modal_eliminar_certificado_redeterminado').html(respuesta).appendTo('body');
$('#eliminar_certificado_redeterminado').modal('show');
}
});
}
