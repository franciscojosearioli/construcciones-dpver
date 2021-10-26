
//Función que se ejecuta al inicio
function inicio(){
	form_consultas(false);
}

//Función mostrar/ocultar formulario
function form_consultas(flag)
{
	if (flag)
	{
		$("#content-login").hide();
		$("#form-consultas").show();
		$("#consultar").hide();
	}
	else
	{
		$("#content-login").show();
		$("#form-consultas").hide();
		$("#consultar").show();
	}
}

//Función cancelar formulario
function cancelar_consultas()
{
	form_consultas(false);
}

inicio();
