//Función que se ejecuta al inicio
function inicio(){
	form_agregar(false);
}

//Función mostrar/ocultar formulario
function form_agregar(flag)
{
	if (flag)
	{
		$("#listar_departamentos").hide();
		$("#agregar_departamentos").show();
		$("#btn_agregar").hide();
	}
	else
	{
		$("#listar_departamentos").show();
		$("#agregar_departamentos").hide();
		$("#btn_agregar").show();
	}
}

//Función cancelar formulario
function cancelar_agregar()
{
	form_agregar(false);
}


//Función enviar formulario
function submit_agregar()
{
	validar = $("#form_agregar").validate();
	if(validar){
	$('#form_agregar').submit();
	}
}


inicio();
