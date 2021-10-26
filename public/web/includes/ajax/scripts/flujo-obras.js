//Función que se ejecuta al inicio
function inicio(){
	form_ver(false);
}

//Función mostrar/ocultar formulario
function form_ver(flag)
{
	if (flag)
	{
		$("#listar-obras").hide();
		$("#flujo-obra").show();
	}
	else
	{
		$("#listar-obras").show();
		$("#flujo-obra").hide();
	}
}


function cancelar_ver()
{
	form_ver(false);
}

inicio();
